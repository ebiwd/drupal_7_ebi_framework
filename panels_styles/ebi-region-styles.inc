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
  'render region' => 'ebi_framework_panels_ebi_style_render_region',
  'settings form' => 'panels_ebi_style_settings_form',
);

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

function grid_sizes() {
  return array(
      '' => t('- Not specified -'),
      '1' => t('1 up'),
      '2' => t('2 up'),
      '3' => t('3 up'),
      '4' => t('4 up'),
      '5' => t('5 up'),
      '6' => t('6 up'),
      '7' => t('7 up'),
      '8' => t('8 up'),
    );
}

/**
 * Settings form callback.
 */
function panels_ebi_style_settings_form($style_settings) {

  // Column grid
  $form['columns'] = array(
    '#type' => 'fieldset',
    '#title' => t('Responsive columns for panels'),
    // '#description' => t(''),
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

  // Tiling grid
  $form['tiling'] = array(
    '#type' => 'fieldset',
    '#title' => t('Layout panels into a grid'),
    // '#description' => t(''),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['tiling']['tiles-small'] = array(
    '#type' => 'select',
    '#title' => t('Small screens'),
    '#description' => t('Tiles per row for small size screens'),
    '#default_value' => (isset($style_settings['tiling']['tiles-small'])) ? $style_settings['tiling']['tiles-small'] : FALSE,
    '#options' => grid_sizes(),
  );

  $form['tiling']['tiles-medium'] = array(
    '#type' => 'select',
    '#title' => t('Large screens'),
    '#description' => t('Tiles per row for medium size screens'),
    '#default_value' => (isset($style_settings['tiling']['tiles-medium'])) ? $style_settings['tiling']['tiles-medium'] : FALSE,
    '#options' => grid_sizes(),
  );

  $form['tiling']['tiles-large'] = array(
    '#type' => 'select',
    '#title' => t('Large screens'),
    '#description' => t('Tiles per row for large size screens'),
    '#default_value' => (isset($style_settings['tiling']['tiles-large'])) ? $style_settings['tiling']['tiles-large'] : FALSE,
    '#options' => grid_sizes(),
  );

  return $form;
}

/**
 * Render callback.
 *
 * @ingroup themeable
 */
function theme_ebi_framework_panels_ebi_style_render_region($vars) {
  // $display = $vars['display'];
  // $region_id = $vars['region_id'];
  $panes = $vars['panes'];
  $settings = $vars['settings'];
  $output = '';
  $renderedClasses = 'panel-separator ';
  $classesColumns = '';

  // Site editor defined options
  // to do: these all get output whether or not individually set, no tech issue but messy
  if (($settings['columns']['columns-large'] >= 1) || ($settings['columns']['columns-large'] >= 1) || ($settings['columns']['columns-large'] >= 1)) {
    $classesColumns .= 'columns large-' . $settings['columns']['columns-large'] . ' medium-' . $settings['columns']['columns-medium'] . ' small-' . $settings['columns']['columns-small'];
  }
  if (($settings['tiling']['tiles-large'] >= 1) || ($settings['tiling']['tiles-large'] >= 1) || ($settings['tiling']['tiles-large'] >= 1)) {
    $classesTiles = ' row large-up-' . $settings['tiling']['tiles-large'] . ' medium-up-' . $settings['tiling']['tiles-medium'] . ' small-up-' . $settings['tiling']['tiles-small'];
    $classesColumns .= 'column';
  }

  // Combine all options
  $renderedClasses .= $classesColumns . ' ';

  $output .= '<div class="region region-' . $vars['region_id'] . $classesTiles . '">';
  $output .= '<div class="' . $renderedClasses . '">'.implode('</div><div class="' . $renderedClasses . '">', $panes).'</div>';
  $output .= '</div>';
  return $output;
}
