<?php
/*

Plugin Name: TinyMCE MailTo
Description: Adds a button to the visual editor which converts the selected text into a mailto link.
Version: 1.0.1
Author: Colebridge Communications
Author URI: http://colebridge.org/

TinyMCE MailTO. Adds a button to the visual editor which converts the selected text into a mailto link.
Copyright (C) 2011 David Rapson, Colebridge Communications

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>./copyleft/gpl.html


*/

function tinymce_mailto_addbuttons()
{

  // Don't bother doing this stuff if the current user lacks permissions
  if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
    if ( get_user_option('rich_editing') == 'true') {
      add_filter("mce_external_plugins", "add_tinymce_mailto_plugin");
      add_filter('mce_buttons', 'register_tinymce_mailto_buttons');
    }
  }

}


function register_tinymce_mailto_buttons($buttons)
{
  array_push($buttons, "separator", "mailto");
  return $buttons;
}


// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_tinymce_mailto_plugin($plugin_array)
{

  $plugin_name = preg_replace('/\.php/','',basename(__FILE__));
  $plugin_array['mailto'] = WP_PLUGIN_URL .'/'.$plugin_name.'/mce/mailto/editor_plugin.dev.js';
  return $plugin_array;
}
add_action('init', 'tinymce_mailto_addbuttons');