<?php

namespace Naroga\SearchBundle\Engine;

use Doctrine\ORM\EntityManager;
use Naroga\SearchBundle\Entity\File;

/**
 * Class PDOSearch
 * @package Naroga\SearchBundle\Engine
 */
class PDOEngine implements EngineInterface
{
    /** @var EntityManager */
    private $entityManager;

    private $filters = [];

    /**
     * PDOSearch constructor.
     * @param EntityManager $entityManager Doctrine's entity manager.
     * @param array $filters Proprocessing filters, as callbacks.
     */
    public function __construct(EntityManager $entityManager, array $filters = [])
    {
        $this->entityManager = $entityManager;
        $this->filters = $filters;
    }

    /**
     * @inheritDoc
     */
    public function add(\string $name, \string $content)
    {
        $file = new File($name, $content);
        $this->entityManager->persist($file);
        $this->entityManager->flush($file);

    }

    /**
     * @inheritDoc
     */
    public function search(\string $expression) : array
    {
        $keywords = array_filter(preg_split("/[\s*|\.*|,*]/", $expression));
        //TODO: make a way to allow for composite expressions (like "OR", "-", quote aggregation and others, like google).
        //Won't do it in this version because there is no time (and it's kinda out of scope). Folks from DJH are waiting.
        foreach ($this->filters as $filter) {
            $keywords = $filter->filter($keywords);
        }

        $qBuilder = $this
            ->entityManager
            ->createQueryBuilder()
            ->select('file')
            ->from(File::class, 'file');

        foreach ($keywords as $keyword) {
            $i = $i ?? 1;
            if ($i == 1) {
                $qBuilder
                    ->where('file.content LIKE "%:keyword' . $i . '%"')
                    ->setParameter('keyword' . $i, $keyword)
                ;
            } else {
                $qBuilder
                    ->orWhere('file.content LIKE "%:keyword' . $i . '%"')
                    ->setParameter('keyword' . $i, $keyword)
                ;
            }
        }

        //TODO: post-process the result to sort by relevance (IE: the results that have the
        //most keywords appear first)
        return $qBuilder
            ->getQuery()
            ->getResult();
    }
}
