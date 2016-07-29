<?php

/**
 * @file
 * Definition of the 'columns' panel style.
 */

// Plugin definition
$plugin = array(
  'title' => t('Columns'),
  'description' => t('The default panel rendering style; displays each pane with a separator.'),
  'render region' => 'panels_columns_style_render_region',
  'settings form' => 'panels_columns_style_settings_form',
);

/**
 * Render callback.
 *
 * @ingroup themeable
 */
function ebi_framework_panels_columns_style_render_region($vars) {
  // $display = $vars['display'];
  // $region_id = $vars['region_id'];
  $panes = $vars['panes'];
  $settings = $vars['settings'];

  $output = '';
//  $output .= '<div class="region region-' . $vars['region_id'] . '">';
  $output .= '<div class="panel-separator columns ' . $settings['columns-medium'] . '">'.implode('</div><div class="panel-separator columns ' . $settings['columns-medium'] . '">', $panes).'</div>';
  // $output .= implode('<div class="panel-separator columns medium-6">test</div>', $vars['panes']);
//  $output .= '</div>';
  return $output;
}

function medium_screen_sizes() {
  return array(
      '' => t('- Not specified -'),
      'medium-1' => t('Medium 1 column'),
      'medium-2' => t('Medium 2 columns'),
      'medium-3' => t('Medium 3 columns'),
      'medium-4' => t('Medium 4 columns'),
      'medium-5' => t('Medium 5 columns'),
      'medium-6' => t('Medium 6 columns'),
      'medium-7' => t('Medium 7 columns'),
      'medium-8' => t('Medium 8 columns'),
      'medium-9' => t('Medium 9 columns'),
      'medium-10' => t('Medium 10 columns'),
      'medium-11' => t('Medium 11 columns'),
      'medium-12' => t('Medium 12 columns'),
    );
}

/**
 * Settings form callback.
 */
function panels_columns_style_settings_form($style_settings) {
  $form['columns-medium'] = array(
    '#type' => 'select',
    '#title' => t('Column width for medium size screens'),
    '#default_value' => (isset($style_settings['columns-mediumbackground'])) ? $style_settings['columns-medium'] : FALSE,
    '#options' => medium_screen_sizes(),
  );

  return $form;
}


