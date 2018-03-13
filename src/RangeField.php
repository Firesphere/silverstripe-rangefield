<?php

namespace Firesphere\RangeField;

use SilverStripe\Core\Convert;
use SilverStripe\Forms\FormField;
use SilverStripe\View\Requirements;

/**
 * Class RangeField
 *
 * A rangefield gives the user the option to select a value from a range, or set a range
 * @todo support for multiple handles, it seems not to work
 * @package Firesphere\Rangefield\Forms
 */
class RangeField extends FormField
{

    /**
     * @var int
     */
    protected $min = 0;

    /**
     * @var int
     */
    protected $max = 100;

    /**
     * @var array
     */
    protected $range = [];

    /**
     * @var bool
     */
    protected $snap = false;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var int
     */
    protected $density = 4;

    /**
     * @var bool
     */
    protected $showPips = true;

    /**
     * @var int|bool
     */
    protected $step;

    /**
     * RangeField constructor.
     * @param string $name The internal field name, passed to forms.
     * @param null|string $title The human-readable field label.
     * @param mixed $value The value of the field.
     * @param int|array $min Lowest value of the range
     * @param int|array $max Highest value of the range
     * @param array $range Associative array with keys which determine the percentage point on the range
     *                     And values being the labels on the field
     */
    public function __construct($name, $title = null, $min = 0, $max = 100, $range = [], $value = null)
    {
        if (!is_array($min)) {
            $min = [$min];
        }
        if (!is_array($max)) {
            $max = [$max];
        }
        $this->min = $min;
        $this->max = $max;
        $this->range = $range;

        $this->setInputType('hidden');

        parent::__construct($name, $title, $value);
    }

    /**
     * @param array $properties
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function Field($properties = array())
    {
        Requirements::set_force_js_to_bottom(true);
        Requirements::javascript('firesphere/rangefield:client/dist/main.js');
        Requirements::css('firesphere/rangefield:client/dist/thirdparty/nouislider.min.css');

        $data = [
            'start' => $this->min,
            'snap'  => $this->snap,
            'range' => [
                'min' => min($this->min),
                'max' => max($this->max)
            ]
        ];
        if ($this->showPips) {
            $data['pips']  = [  // Show a scale with the slider
                'mode'    => 'steps',
                'stepped' => true,
                'density' => $this->density
            ];
        }

        if ($this->getStep()) {
            $data['step'] = $this->getStep();
        }

        if (count($this->range)) { // Update the range if we've gotten a forced range
            $data['range'] = $this->range;
        }

        $this->setData($data);

        $field = parent::Field($properties);


        Requirements::insertHeadTags("<script type='text/javascript'>
        var $this->name = " . Convert::array2json($data) . '</script>');

        return $field;
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

    /**
     * @return array
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param array $range
     */
    public function setRange($range)
    {
        $this->range = $range;
    }

    /**
     * @return bool
     */
    public function isSnap()
    {
        return $this->snap;
    }

    /**
     * @param bool $snap
     */
    public function setSnap($snap)
    {
        $this->snap = $snap;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


    /**
     * @return int
     */
    public function getDensity()
    {
        return $this->density;
    }

    /**
     * @param int $density
     */
    public function setDensity($density)
    {
        $this->density = $density;
    }

    /**
     * @return bool
     */
    public function isShowPips()
    {
        return $this->showPips;
    }

    /**
     * @param bool $showPips
     */
    public function setShowPips($showPips)
    {
        $this->showPips = $showPips;
    }

    /**
     * @return int
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param int $step
     */
    public function setStep($step)
    {
        $this->step = $step;
    }

}
