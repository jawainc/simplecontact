<?php
namespace Zainab\SimpleContact\Models;

use Model;
use Cms\Classes\Theme;
use Cms\Classes\Page;
class Settings extends Model
{
        
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'zainab_simple_contact_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public function getRedirectToUrlOptions($keyValue = null){

        $currentTheme = Theme::getEditTheme();
        $allPages = Page::listInTheme($currentTheme, true);

        $pages = [];
        $pages[""] = "--Select--";

        foreach ($allPages as $pg) {
            $pages[$pg->url] = $pg->title;
        }

        return $pages;
    }
}