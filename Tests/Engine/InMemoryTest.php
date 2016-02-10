<?php

namespace Naroga\SearchBundle\Tests\Engine;

use Naroga\SearchBundle\Engine\InMemory;

class InMemoryTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd() {
        $engine = new InMemory();
        $engine->add('pedro', 'my name is pedro cordeiro');
        var_dump($engine->memory);
    }
}
