<?php

declare(strict_types=1);

namespace Inc\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ExampleWidget extends Widget_base
{
    public static $slug = 'mentorstarter-examplewidget';

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        // wp_register_style( 'awesomesauce', plugins_url( '/assets/css/awesomesauce.css', ELEMENTOR_AWESOMESAUCE ), array(), '1.0.0' );
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
        return ['general'];
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
                // 'tab' => Controls_Manager::TAB_CONTENT,
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
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('title', 'none');
        $this->add_inline_editing_attributes('description', 'basic');
        $this->add_inline_editing_attributes('content', 'advanced'); ?>
		<h2 <?php echo $this->get_render_attribute_string('title'); ?><?php echo wp_kses($settings['title'], []); ?></h2>
		<div <?php echo $this->get_render_attribute_string('description'); ?><?php echo wp_kses($settings['description'], []); ?></div>
		<div <?php echo $this->get_render_attribute_string('content'); ?><?php echo wp_kses($settings['content'], []); ?></div>
		<?php
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
        ?>
		<#
		view.addInlineEditingAttributes( 'title', 'none' );
		view.addInlineEditingAttributes( 'description', 'basic' );
		view.addInlineEditingAttributes( 'content', 'advanced' );
		#>
		<h2 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
		<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
		<div {{{ view.getRenderAttributeString( 'content' ) }}}>{{{ settings.content }}}</div>
		<?php
    }
}
