<?php

namespace TASoft\Core\Collection;


class SortDescriptor
{
    private $key = 'key';
    private $ascending = true;
    private $comparisonMethod = 'compare';

    public function __construct(string $key, bool $ascending = true, string $comparison = 'compare')
    {
        $this->key = $key;
        $this->ascending = $ascending;
        $this->comparisonMethod = $comparison;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return bool
     */
    public function isAscending(): bool
    {
        return $this->ascending;
    }

    /**
     * @return string
     */
    public function getComparisonMethod(): string
    {
        return $this->comparisonMethod;
    }
}