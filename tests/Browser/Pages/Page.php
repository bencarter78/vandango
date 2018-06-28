<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Page as BasePage;

abstract class Page extends BasePage
{
    /**
     * Get the global element shortcuts for the site.
     *
     * @return array
     */
    public static function siteElements()
    {
        return [
            '@show' => 'i[class=fa-search]',
            '@edit' => 'a[name=edit]',
            '@delete' => 'i[class=fa-trash]',
        ];
    }
}
