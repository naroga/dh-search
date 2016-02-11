<?php

namespace Naroga\SearchBundle\Tests\Search;

use Naroga\SearchBundle\Engine\ElasticSearch;
use Naroga\SearchBundle\Engine\InMemory;
use Naroga\SearchBundle\Entity\File;
use Naroga\SearchBundle\Search\Search;

/**
 * Class SearchTest
 * @package Naroga\SearchBundle\Tests\Search
 */
class SearchTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd() {
        $esMock = $this->getMockBuilder(ElasticSearch::class)
            ->disableOriginalConstructor()
            ->getMock();
        $esMock->expects($this->any())->method('add')->will($this->returnValue(
            '123'
        ));
        $search = new Search($esMock);
        $this->assertEquals($search->add(__DIR__ . '/file.txt'), '123');
    }

    /**
     * @expectedException \Naroga\SearchBundle\Exception\FileNotFoundException
     */
    public function testAddFails() {
        $esMock = $this->getMockBuilder(ElasticSearch::class)
            ->disableOriginalConstructor()
            ->getMock();
        $esMock->expects($this->any())->method('add')->will($this->returnValue(
            '123'
        ));
        $search = new Search($esMock);
        $this->assertEquals($search->add(__DIR__ . '/fileDoesntExist.txt'), '123');
    }
}