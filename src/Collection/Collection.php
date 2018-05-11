<?php

namespace TASoft\Core\Collection;


abstract class Collection
{
    const ORDERED_DESCENDING = -1;
    const ORDERED_SAME = 0;
    const ORDERED_ASCENDING = 1;

    public static function objectsAreEqual($object1, $object2): bool {
        if(is_object($object1)) {
            if($object1 instanceof EqualInterface)
                return $object1->isEqual($object2);

            if(is_string($object2) && $object1 instanceof EqualStringInterface)
                return $object1->isEqualToString($object2);

            if($object1 instanceof EqualClassInterface && get_class($object1) == get_class($object2))
                return $object1->isEqualTo($object2);
        }
        return $object1 == $object2;
    }

    public static function contains(array $collection, $value): bool {
        $contains = false;

        static::enumerateWithCallback($collection, function($k, $v, &$s) use (&$contains, $value) {
            if(static::objectsAreEqual($value, $v)) {
                $contains = true;
                $s = true;
            }
        });
        return $contains;
    }


    public static function findKeyOf(array $collection, $value) {
        $key = NULL;

        static::enumerateWithCallback($collection, function($k, $val, &$stop) use (&$key, $value) {
            if(static::objectsAreEqual($value, $val)) {
                $key = $k;
                $stop = true;
            }
        });
        return $key;
    }

    public static function findKeysOf(array $collection, $values) {
        if(!is_array($values))
            $values = [$values];

        $keys = [];
        static::enumerateWithCallback($collection, function($k, $val) use (&$keys, $values) {
            if(static::contains($values, $val)) {
                $keys[] = $k;
            }
        });
        return $keys;
    }

    /**
     * @param iterable $collection
     * @param callable $callback Signature: function($key, $value, &$stop): void
     */
    public static function enumerateWithCallback(iterable $collection, callable $callback) {
        foreach($collection as $key => $value) {
            $stop = false;
            $callback($key, $value, $stop);
            if($stop)
                break;
        }
    }

    public static function sortCollection(array &$collection, array $sortDescriptors) {
        usort($collection, function($a, $b) use ($sortDescriptors) {
            if(is_object($a)) {
                foreach($sortDescriptors as $desc) {
                    /** @var SortDescriptor $desc */
                    $mthd = $desc->getComparisonMethod();
                    $result = 0;

                    if(method_exists($a, $mthd))
                        $result = $a->$mthd($b);
                    if($result != self::ORDERED_SAME)
                        return $result;
                }
                return self::ORDERED_SAME;
            }
            return $a <=> $b;
        });
    }
}