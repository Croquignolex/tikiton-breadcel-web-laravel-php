<?php 

namespace App\Utils;
 
class OrderStatus
{
    public $label;
    public $percentage;
    public $label_color;
    public $progress_bg_color;

    /**
     * OrderStatus constructor.
     * @param $label
     * @param $percentage
     * @param $label_color
     * @param $progress_bg_color
     */
    public function __construct($label, $percentage, $label_color, $progress_bg_color)
    {
        $this->percentage = $percentage;
        $this->label_color = $label_color;
        $this->label = trans('general.' . $label);
        $this->progress_bg_color = $progress_bg_color;
    }
}