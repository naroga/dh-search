<?php

namespace Naroga\SearchBundle\Search;

use Naroga\SearchBundle\Engine\EngineInterface;

/**
 * Class Search
 * @package Naroga\SearchBundle\Search
 */
class Search
{
    /** @var EngineInterface */
    private $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Adds a new file.
     *
     * @param string $name
     * @param string $content
     */
    public function add(string $name, string $content)
    {
        $this->engine->add($name, $content);
    }

    /**
     * Searches for a file.
     *
     * @param string $expression
     * @return array
     */
    public function search(string $expression) : array
    {
        return $this->engine->search($expression);
    }
}
