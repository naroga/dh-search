<?php

namespace Naroga\SearchBundle\Tests\Engine;

use Naroga\SearchBundle\Filter\RemovePrepositionsFilter;

class RemovePrepositionsFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter() {
        $filter = new RemovePrepositionsFilter();
        $result = $filter->filter(['my', 'name', 'for', 'is', 'pedro', 'to']);
        $this->assertEquals(in_array('to', $result), false);
        $this->assertEquals(in_array('for', $result), false);
        $this->assertEquals(in_array('my', $result), true);
        $this->assertEquals(in_array('name', $result), true);
        $this->assertEquals(in_array('is', $result), true);
        $this->assertEquals(in_array('pedro', $result), true);
    }

}
