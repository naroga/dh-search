<?php

namespace Naroga\SearchBundle\Tests\Engine;

use Naroga\SearchBundle\Engine\InMemory;
use Naroga\SearchBundle\Entity\File;

class InMemoryTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd() {
        $engine = new InMemory();
        $engine->add('pedro', 'my name is pedro cordeiro');
        $data = $engine->memory;
        $this->assertEquals($data[0]['name'], 'pedro');
        $this->assertEquals($data[0]['content'], 'my name is pedro cordeiro');
    }

    public function testSearch() {
        $engine = new InMemory();
        $engine->add('pedro', 'my name is pedro cordeiro');
        $result = $engine->search('name cordeiro');
        $this->assertEquals(count($result), 1);
        $this->assertInstanceOf(File::class, $result[0]['obj']);
        $this->assertEquals(2, $result[0]['hits']);
        $engine->add('sandy', 'pedro has a wife called sandy santos');
        $result = $engine->search('pedro wife');
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
