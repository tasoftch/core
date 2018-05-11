<?php

namespace TASoft\Core\Collection;


interface EqualClassInterface
{
    public function isEqualTo(object $object): bool;
}