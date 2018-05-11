<?php

namespace TASoft\Core\Forwarder;


trait MethodForwarderTrait
{
    abstract protected function getObject(): ?object;
    abstract protected static function getClass(): ?string;

    public function __call($name, $arguments)
    {
        return ($obj = $this->getObject()) ?  $obj->__call($name, $arguments) : NULL;
    }

    public static function __callStatic($name, $arguments)
    {
        return ($obj = static::getClass()) ?  $obj::__callStatic($name, $arguments) : NULL;
    }
}