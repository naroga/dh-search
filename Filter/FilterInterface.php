<?php

namespace Naroga\SearchBundle\Filter;

interface FilterInterface
{
    /**
     * Filters an input array.
     *
     * @param array $input Input array.
     * @return array The result.
     */
    public function filter(array $input) : array;
}
