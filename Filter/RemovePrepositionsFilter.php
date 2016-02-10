<?php

namespace Naroga\SearchBundle\Filter;

/**
 * Class RemovePrepositionsFilter
 * @package Naroga\SearchBundle\Filter
 */
class RemovePrepositionsFilter implements FilterInterface
{
    public function filter(array $input) : array
    {
        $prepositions = ["to", "from", "by", "for"]; //TODO: load this list from a cached yaml file or something.
        return array_filter($input, function ($item) use ($prepositions) {
            return !in_array($item, $prepositions);
        });
    }
}
