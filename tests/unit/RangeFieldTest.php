<?php

namespace Firesphere\RangeField\Tests;

use Firesphere\RangeField\RangeField;
use SilverStripe\Dev\SapphireTest;

class RangeFieldTest extends SapphireTest
{
    public function testDefault()
    {
        $field = RangeField::create('Test', 'Test');
        $this->assertEquals([0], $field->getStart());
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
            50,
            25,
            75,
            ['min' => 25, '17%' => 33, '50%' => 50, '83%' => 66, 'max' => 75]
        );

        $rangeField->Field([]);

        $expected = [
            'start' => [50],
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

    public function testGetSetMin()
    {
        $field = RangeField::create('Test', 'Test');
        
        $field->setMin(10);
        
        $this->assertEquals([10], $field->getMin());
    }

    public function testGetSetMax()
    {
        $field = RangeField::create('Test', 'Test');
        
        $field->setMax(10);
        
        $this->assertEquals(10, $field->getMax());
    }
    
    public function testGetSetRange()
    {
        $field = RangeField::create('Test', 'Test');

        $this->assertEquals([], $field->getRange());

        $field->setRange([
            'min' => 25,
            '17%' => 33,
            '50%' => 50,
            '83%' => 66,
            'max' => 75
        ]);
        
        $this->assertEquals([
            'min' => 25,
            '17%' => 33,
            '50%' => 50,
            '83%' => 66,
            'max' => 75
        ], $field->getRange());
    }

    public function testGetSetDensity()
    {
        $field = RangeField::create('Test', 'Test');

        $this->assertEquals(4, $field->getDensity());

        $field->setDensity(10);
        
        $this->assertEquals(10, $field->getDensity());
    }

    public function testIsSetPips()
    {
        $field = RangeField::create('Test', 'Test');

        $this->assertTrue($field->isShowPips());

        $field->setShowPips(false);
        
        $this->assertFalse($field->isShowPips());
    }

    public function testGetSetStart()
    {
        $field = RangeField::create('Test', 'Test', [5, 25]);

        $this->assertEquals([5, 25], $field->getStart());

        $field = RangeField::create('Test', 'Test');

        $this->assertEquals([0], $field->getStart());

        $field->setStart(10);

        $this->assertEquals([10], $field->getStart());
    }
}
