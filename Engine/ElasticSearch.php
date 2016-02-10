<?php

namespace Naroga\SearchBundle\Engine;

/**
 * Class ElasticSearch
 * @package Naroga\SearchBundle\Engine
 */
class ElasticEngine implements EngineInterface
{
    public function add(\string $name, \string $content)
    {

    }

    public function search(\string $expression) : array
    {
        return [];
    }
}
