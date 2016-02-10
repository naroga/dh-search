<?php

namespace Naroga\SearchBundle\Tests\Search;

use Naroga\SearchBundle\Engine\InMemory;
use Naroga\SearchBundle\Entity\File;
use Naroga\SearchBundle\Search\Search;

/**
 * Class SearchTest
 * @package Naroga\SearchBundle\Tests\Search
 */
class SearchTest extends \PHPUnit_Framework_TestCase
{
    public function testStack() {
        $search = new Search(new InMemory());
        $search->add('pedro', 'my name is pedro cordeiro');
        $result = $search->search('name cordeiro');
        $this->assertEquals(count($result), 1);
        $this->assertInstanceOf(File::class, $result[0]['obj']);
        $this->assertEquals(2, $result[0]['hits']);
        $search->add('sandy', 'pedro has a wife called sandy santos');
        $result = $search->search('pedro wife');
        $this->assertEquals(count($result), 2);
        $this->assertInstanceOf(File::class, $result[0]['obj']);
        $this->assertEquals($result[0]['obj']->getName(), 'pedro');
        $this->assertEquals($result[0]['obj']->getContent(), 'my name is pedro cordeiro');
        $this->assertEquals(1, $result[0]['hits']);
        $this->assertInstanceOf(File::class, $result[1]['obj']);
        $this->assertEquals($result[1]['obj']->getName(), 'sandy');
        $this->assertEquals(2, $result[1]['hits']);
    }
}