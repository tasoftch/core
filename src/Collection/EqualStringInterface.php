<?php

namespace TASoft\Core\Collection;


interface EqualStringInterface
{
    public function isEqualToString(string $string): bool;
}