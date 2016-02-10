<?php

namespace Naroga\SearchBundle\Engine;

use Naroga\SearchBundle\Search\SearchInterface;

/**
 * Class ElasticSearch
 * @package Naroga\SearchBundle\Engine
 */
class ElasticSearch implements SearchInterface
{
    public function add(\string $name, \string $content)
    {
        // TODO: Implement add() method.
    }

    public function search(\string $expression) : array
    {
        // TODO: Implement search() method.
    }
}
