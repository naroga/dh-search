<?php

namespace Naroga\SearchBundle\Tests\Engine;

use JMS\Serializer\Serializer;
use Naroga\SearchBundle\Engine\ElasticSearch;

/**
 * Class ElasticSearchTest
 * @package Naroga\SearchBundle\Tests\Engine
 */
class ElasticSearchTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {

        $clientMock = $this->getMock(GuzzleHttp\Client::class);
        $clientMock->expects($this->any())->method('post')->will($this->returnValue(
            json_encode(['created' => true, '_id' => 123])
        ));

        $elasticSearch = new ElasticSearch(
            'localhost:9200',
            'file',
            JMS\Serializer\SerializerBuilder::create()->build(),
            $clientMock
        );
    }
}
