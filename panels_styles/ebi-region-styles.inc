<?php

/*
 Todo:
   add support for:
   - accordians
   - slideshows
   - medium-up-2, et al
*/

/**
 * @file
 * Definition of the 'columns' panel style.
 */

// Plugin definition
$plugin = array(
  'title' => t('EBI Region styles'),
  'description' => t('The default panel rendering style; displays each pane with a separator.'),
  'render region' => 'panels_ebi_style_render_region',
  'settings form' => 'panels_ebi_style_settings_form',
);

/**
 * Render callback.
 *
 * @ingroup themeable
 */
function ebi_framework_panels_ebi_style_render_region($vars) {
  // $display = $vars['display'];
  // $region_id = $vars['region_id'];
  $panes = $vars['panes'];
  $settings = $vars['settings'];

  $renderedClasses = 'large-' . $settings['columns']['columns-large'] . ' medium-' . $settings['columns']['columns-medium'] . ' small-' . $settings['columns']['columns-small'];

  $output = '';
//  $output .= '<div class="region region-' . $vars['region_id'] . '">';
  $output .= '<div class="panel-separator columns ' . $renderedClasses . '">'.implode('</div><div class="panel-separator columns ' . $renderedClasses . '">', $panes).'</div>';
  // $output .= implode('<div class="panel-separator columns medium-6">test</div>', $vars['panes']);
//  $output .= '</div>';
  return $output;
}

function column_sizes() {
  return array(
      '' => t('- Not specified -'),
      '1' => t('1 column'),
      '2' => t('2 columns'),
      '3' => t('3 columns'),
      '4' => t('4 columns'),
      '5' => t('5 columns'),
      '6' => t('6 columns'),
      '7' => t('7 columns'),
      '8' => t('8 columns'),
      '9' => t('9 columns'),
      '10' => t('10 columns'),
      '11' => t('11 columns'),
      '12' => t('12 columns'),
    );
}

/**
 * Settings form callback.
 */
function panels_ebi_style_settings_form($style_settings) {

  $form['columns'] = array(
    '#type' => 'fieldset',
    '#title' => t('Responsive columns for panels'),
    // '#description' => t('Show this panel\'s title as a label.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['columns']['columns-small'] = array(
    '#type' => 'select',
    '#title' => t('Small screens'),
    '#description' => t('Column width of the panels for small size screens'),
    '#default_value' => (isset($style_settings['columns']['columns-small'])) ? $style_settings['columns']['columns-small'] : FALSE,
    '#options' => column_sizes(),
  );

  $form['columns']['columns-medium'] = array(
    '#type' => 'select',
    '#title' => t('Large screens'),
    '#description' => t('Column width of the panels for medium size screens'),
    '#default_value' => (isset($style_settings['columns']['columns-medium'])) ? $style_settings['columns']['columns-medium'] : FALSE,
    '#options' => column_sizes(),
  );

  $form['columns']['columns-large'] = array(
    '#type' => 'select',
    '#title' => t('Large screens'),
    '#description' => t('Column width of the panels for large size screens'),
    '#default_value' => (isset($style_settings['columns']['columns-large'])) ? $style_settings['columns']['columns-large'] : FALSE,
    '#options' => column_sizes(),
  );

  return $form;
}
