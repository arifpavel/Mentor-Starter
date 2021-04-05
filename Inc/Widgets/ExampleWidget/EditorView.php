<?php
/**
 * Editor View file.
 * this file contains codes to show content within elementor editor.
 */
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