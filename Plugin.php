<?php namespace Zainab\SimpleContact;

use System\Classes\PluginBase;
use Backend;
use Zainab\SimpleContact\Controllers\SimpleContact;
class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'zainab.simplecontact::lang.plugin.name',
            'description' => 'zainab.simplecontact::lang.plugin.description',
            'author'      => 'Jawad',
            'icon'        => 'icon-envelope'
        ];
    }

    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.Translate'];

    public function registerComponents()
    {
        return [
            'Zainab\SimpleContact\Components\SimpleContact' => 'simpleContact'
        ];
    }

    public function registerSettings()
    {
        return [
            'config' => [
                'label'       => 'Simple Contact',
                'icon'        => 'icon-envelope',
                'description' => 'Manage Settings.',
                'class'       => 'Zainab\SimpleContact\Models\Settings',
                'permissions' => ['zainab.simplecontact.manage_settings'],
                'order'       => 60
            ]
        ];
    }

    public function registerNavigation(){
        return [
            'main-menu-item' => [
                'label'       => 'zainab.simplecontact::lang.simplecontact.mainmenu',
                'url'         => Backend::url('zainab/simplecontact/simplecontact'),
                'icon'        => 'icon-envelope',
                'permissions' => ['zainab.simplecontact.inbox'],


                'sideMenu' => [
                    'side-menu-item' => [
                        'label'       => 'zainab.simplecontact::lang.simplecontact.submenu',
                        'icon'        => 'icon-inbox',
                        'url'         => Backend::url('zainab/simplecontact/simplecontact'),
                        'permissions' => ['zainab.simplecontact.inbox'],
                        'counter'     => SimpleContact::countUnreadMessages(),
                        'counterLabel' => 'Un-Read Messages'
                    ]

                ]

            ]
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'zainab.simplecontact::mail.reply' => 'Simple Contact -- reply message',
            'zainab.simplecontact::mail.auto-response' => 'Simple Contact -- auto response message',
            'zainab.simplecontact::mail.notification' => 'Simple Contact -- notification mail',
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Zainab\SimpleContact\ReportWidgets\MessageReport' => [
                'label'   => 'zainab.simplecontact::lang.widget.label',
                'context' => 'dashboard'
            ],
        ];
    }
}
