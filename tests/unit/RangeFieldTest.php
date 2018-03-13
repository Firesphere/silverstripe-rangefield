<?php

namespace Firesphere\RangeField\Tests;

use Firesphere\RangeField\RangeField;
use SilverStripe\Dev\SapphireTest;

class RangeFieldTest extends SapphireTest
{
    public function testDefault()
    {
        $field = RangeField::create('Test', 'Test');
        $this->assertEquals(0, $field->getMin());
        $this->assertEquals(100, $field->getMax());
        $this->assertFalse($field->isSnap());
        $this->assertEquals([], $field->getRange());
    }

    public function testRange()
    {
        $rangeField = RangeField::create(
            'TestInt',
            'Test',
            25,
            75,
            ['min' => 25, '17%' => 33, '50%' => 50, '83%' => 66, 'max' => 75]
        );

        $expected = [
            'start' => [25],
            'snap'  => true,
            'range' => [
                'min' => 25,
                '17%' => 33,
                '50%' => 50,
                '83%' => 66,
                'max' => 75
            ],
            'pips'  => [  // Show a scale with the slider
                'mode'    => 'steps',
                'stepped' => true,
                'density' => 4
            ]
        ];

        $this->assertEquals($expected, $rangeField->getData());
    }
}
