<?php
/**
 * Created by PhpStorm.
 * User: jawad
 * Date: 6/11/2016
 * Time: 1:15 PM
 */

namespace Zainab\SimpleContact\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Zainab\SimpleContact\Models\SimpleContact as simpleContactModel;
class MessageReport extends ReportWidgetBase
{

    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'zainab.simplecontact::lang.widget.properties_title',
                'default'           => 'Contact Us Messages',
                'type'              => 'string',
            ],
            'chart' => [
                'title' => 'zainab.simplecontact::lang.widget.properties_chart',
                'type'        => 'dropdown',
                'default'     => 'chart-bar',
                'options'     => [
                    'chart-bar'=> e(trans('zainab.simplecontact::lang.widget.properties_chart_option_bar')),
                    'chart-pie'=> e(trans('zainab.simplecontact::lang.widget.properties_chart_option_pie'))
                ]
            
            ]
        ];
    }
    
    public function render()
    {
        $vars = [
            'title' => $this->property('title','Contact Us Messages'),
            'chart_type' => $this->property('chart', "chart-bar"),
            'new_messages' => simpleContactModel::where('is_new', true)->count(),
            'replied_messages' => simpleContactModel::where('is_replied', true)->count(),
            'total_messages' => simpleContactModel::count()
        ];
        
        return $this->makePartial('widget',$vars);
    }
}