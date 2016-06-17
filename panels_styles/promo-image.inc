<?php

/**
 * @file
 * Definition of the 'promo-image' panel style for EBI introduction paragraphs.
 */

// Plugin definition
$plugin = array(
  'title' => t('Promo image'),
  'description' => t('Promotional image box with title below image'),
  'render pane' => 'ebi_framework_promo_image_style_render_pane',
);

/**
* Render callback.
*
* @ingroup themeable
*/
function theme_ebi_framework_promo_image_style_render_pane($vars) {
  $content = $vars['content'];
  $pane = $vars['pane'];
  $display = $vars['display'];
  $title = $vars['content']->title;
/*   $settings = $vars['settings']; */

  if (empty($content->content)) {
    return;
  }

  $content->content = strip_tags($content->content,'<a><img>'); // only img and a tags, please
  // $content->content = preg_replace('/\s+/', '', $content->content); // whitespace = :(

  // if has a link, insert title into that space
  if (strpos($content->content,'</a>') != 0) {
    $content->content = str_replace('</a>', '<p>'.$title.'</p></a>', $content->content);
  }
  $output = '<div class="promo-image">';
  // $output .= theme('panels_pane', array('content' => $content, 'pane' => $pane, 'display' => $display));
  $output .=  $content->content;
  $output .= '</div>';

  return $output;
}
