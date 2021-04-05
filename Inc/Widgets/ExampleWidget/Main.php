<?php

declare(strict_types=1);

namespace Inc\Widgets\ExampleWidget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Main extends Widget_base
{
    public static $slug = 'mentorstarter-examplewidget';

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
    }

    public function get_name()
    {
        return self::$slug;
    }

    public function get_title()
    {
        return __('Mentor Starter Widget', self::$slug);
    }

    public function get_icon()
    {
        return 'fa fa-info';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', MENTORSTARTER_TEXTDOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', MENTORSTARTER_TEXTDOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => __('Title', MENTORSTARTER_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', MENTORSTARTER_TEXTDOMAIN),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Description', MENTORSTARTER_TEXTDOMAIN),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Content', MENTORSTARTER_TEXTDOMAIN),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Content', MENTORSTARTER_TEXTDOMAIN),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        //load render view to show widget output on frontend/website.
        require 'RenderView.php';
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _content_template()
    {
        //load editor view to show widget output on elementor editor for live editing.
        require_once 'EditorView.php';
    }
}
