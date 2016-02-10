<?php

namespace Naroga\SearchBundle\Engine;

/**
 * Class InMemorySearch
 * @package Naroga\SearchBundle\Engine
 */
class InMemory implements EngineInterface
{
    public $memory = [];

    /**
     * @inheritDoc
     */
    public function add(string $name, string $content)
    {
        $this->memory[] = ['name' => $name, 'content' => $content];
    }

    /**
     * @inheritDoc
     */
    public function search(string $expression) : array
    {
        $keywords = array_filter(preg_split("/[\s*|\.*|,*]/", $expression));
        //TODO: make a way to allow for composite expressions (like "OR", "-", quote aggregation and others, like google).
        //Won't do it in this version because there is no time (and it's kinda out of scope). Folks from DJH are waiting.
        foreach ($this->filters as $filter) {
            $keywords = $filter->filter($keywords);
        }

        $hits = [];

        //Should've avoided this nested loop. However, this is kind of a mockup class, and will
        //never be used in production. This is why I'll leave this performing as O(n**2).
        foreach ($this->memory as $data) {
            $localHit = ['obj' => new File($data['name'], $data['content']), 'hits' => 0];
            foreach ($this->keywords as $keyword) {
                if (strpos($data['content'], $keyword) !== false) {
                    $localHit['hits']++;
                }
            }
            if ($localHit['hits'] > 0) {
                $hits[] = $localHit;
            }
        }

        array_usort($hits, function ($a, $b) {
            return $a['hits'] <=> $b['hits'];
        });

        return $hits;
    }
}
