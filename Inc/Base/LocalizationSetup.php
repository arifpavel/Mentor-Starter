<?php

declare(strict_types=1);

namespace Inc\Base;

class LocalizationSetup
{
    public function __construct()
    {
        $this->init();
    }

    /**
     * init.
     * init class methods
     * @author   Arif Pavel
     * @since   v1.0.0
     * @version   v1.0.0   Wednesday, Mar 31th, 2021.
     * @access   public
     * @return   void
     */
    public function init(): void
    {
        add_action('init', [$this, 'localizationSetup']);
    }

    /**
     * localizationSetup
     * loads plugin text-domain with language directory.
     *
     * @return void
     */
    public function localizationSetup(): void
    {
        load_plugin_textdomain(CHARTMENTOR_TEXTDOMAIN, false, CHARTMENTOR_PATH . '/languages/');
    }
}
