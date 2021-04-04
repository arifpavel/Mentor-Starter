<?php

declare(strict_types=1);

namespace Inc\Base;

use Elementor\Plugin;

class InitElementorWidgets
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
        add_action('elementor/widgets/widgets_registered', [$this, 'loadWidgets']);
    }

    /* getWidgets
     * Get all the widgets to pass into elementor.
     * @author Arif Pavel
     * @since 31 Mar 21
     * @version v1.0.0
     * @param mixed
     * @return array
    */
    public static function getWidgets()
    {
        return [
            \Inc\Widgets\ExampleWidget::class,
        ];
    }

    /* loadWidgets
     * Load custom widgets into elementor widget library.
     * @author Arif Pavel
     * @since 31 Mar 21
     * @version v1.0.0
     * @param mixed
     * @return null
    */
    public function loadWidgets()
    {
        foreach (self::getWidgets() as $widget) {
            // Let Elementor know about our widget
            Plugin::instance()->widgets_manager->register_widget_type(new $widget());
        }
    }
}
