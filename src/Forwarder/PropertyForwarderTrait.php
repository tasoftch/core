<?php

namespace TASoft\Core\Forwarder;


trait PropertyForwarderTrait
{
    abstract protected function getObject(): ?object;

    public function __get($name)
    {
        return ($obj = $this->getObject()) ?  $obj->__get($name) : NULL;
    }

    public function __isset($name)
    {
        return ($obj = $this->getObject()) ?  $obj->__isset($name) : NULL;
    }

    public function __unset($name)
    {
        return ($obj = $this->getObject()) ?  $obj->__unset($name) : NULL;
    }

    public function __set($name, $value)
    {
        return ($obj = $this->getObject()) ?  $obj->__set($name, $value) : NULL;
    }
}