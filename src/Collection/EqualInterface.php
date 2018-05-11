<?php

namespace TASoft\Core\Collection;


interface EqualInterface
{
    public function isEqual($value): bool;
}