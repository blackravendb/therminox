<?php
$slider = new ZendX_JQuery_Form_Element_Slider('amount');
$slider->setLabel('Set Amount: ');
$slider->setJQueryParams(array('min' => 0, 'max' => 60, 'value' => 15));

