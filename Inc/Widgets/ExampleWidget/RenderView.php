<?php
/**
 * Render View file.
 * this file contains codes to show content on wordpress frontend/website.
 */
$settings = $this->get_settings_for_display();
$wpkses_allowed = [
];
$this->add_inline_editing_attributes('title', 'none');
$this->add_inline_editing_attributes('description', 'basic');
$this->add_inline_editing_attributes('content', 'advanced'); ?>
<h2 <?php echo $this->get_render_attribute_string('title'); ?>><?php echo wp_kses($settings['title'], []); ?></h2>
<div <?php echo $this->get_render_attribute_string('description'); ?>><?php echo wp_kses($settings['description'], []); ?></div>
<div <?php echo $this->get_render_attribute_string('content'); ?>><?php echo wp_kses_post($settings['content'], ['<img>']); ?></div>
<?php