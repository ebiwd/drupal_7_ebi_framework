<?php 

/**
 * @file
 * Custom panels color presets.
 */

// Plugin registrieren
$plugin = array(
  'title' => t('EBI Styles'),
  'description' => t('Styling options for EMBL-EBI patterns.'),
  'render pane' => 'ebi_framework_ebi_styles_style_render_pane',
  'pane settings form' => 'theme_ebi_framework_ebi_styles_settings_form',
  'category' => t('ebi_framework'),
);

function background_colors() {
  return array(
      '' => t('- Default -'),
      'ebi-background' => t('EBI Petrol background'),
      'services-background' => t('Services background'),
      'research-background' => t('Research background'),
      'training-background' => t('Training background'),
      'industry-background' => t('Industry background'),
      'elixir-background' => t('ELIXIR background'),
      'white-background' => t('White background'),
      'secondary-background' => t('Secondary background'),
    );
}

/**
 * Renders the pane content.
 */
function theme_ebi_framework_ebi_styles_style_render_pane($content) {
  if (!empty($content)) {
    return theme('panels_pane', $content);
  }
}

/**
 * Color preset settings form.
 */
function theme_ebi_framework_ebi_styles_settings_form($style_settings) {
  $form = array();
  $form['color'] = array(
    '#type' => 'select',
    '#title' => t('Color preset'),
    '#default_value' => (isset($style_settings['color'])) ? $style_settings['color'] : FALSE,
    '#options' => array(
      '' => t('- None -'),
      'ebi-color' => t('EBI Petrol'),
      'services-color' => t('Services'),
      'research-color' => t('Research'),
      'training-color' => t('Training'),
      'industry-color' => t('Industry'),
      'elixir-color' => t('ELIXIR'),
      'white-color' => t('White'),
      'secondary-color' => t('Secondary'),
    ),
  );

  $form['color-background'] = array(
    '#type' => 'select',
    '#title' => t('Background color'),
    '#default_value' => (isset($style_settings['color-background'])) ? $style_settings['color-background'] : FALSE,
    '#options' => background_colors(),
  );

  $form['callout-box'] = array(
    '#type' => 'checkbox',
    '#title' => t('Callout box'),
    '#default_value' => (isset($style_settings['callout-box'])) ? $style_settings['callout-box'] : FALSE,
  );

  $form['promo-image'] = array(
    '#type' => 'checkbox',
    '#title' => t('Promotional image'),
    '#description' => t('Show as a sidebar-style promotional image. You only need to add an image and, optionally, link it. The pane title will be added as text.'),
    '#default_value' => (isset($style_settings['promo-image'])) ? $style_settings['promo-image'] : FALSE,
  );

  $form['title-label'] = array(
    '#type' => 'fieldset',
    '#title' => t('Show title as a label'),
    '#description' => t('Show this panel\'s title as a label.'),
  );

  $form['title-label']['enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enabled'),
    '#default_value' => (isset($style_settings['title-label']['enabled'])) ? $style_settings['title-label']['enabled'] : FALSE,
  );

  $form['title-label']['color-background'] = array(
    '#type' => 'select',
    '#title' => t('Background color'),
    '#default_value' => (isset($style_settings['color-background'])) ? $style_settings['color-background'] : FALSE,
    '#options' => background_colors(),
  );


  $form['custom-classes'] = array(
    '#type' => 'textfield',
    '#title' => t('Special classes'),
    '#description' => t('There are many classes that will affect the apperance and not all are shown above, if there are some you\'d like to use, add them here. Do no include the \'.\' and seperate with spaces.'),
    '#default_value' => (isset($style_settings['custom-classes'])) ? $style_settings['custom-classes'] : FALSE,
  );

  return $form;
}

/**
 * Implements hook_preprocess_panels_pane().
 */
// TODO: this should be moved into it's own seperate include as we only get one of these functions, 
// but for active dev it's easier to use here...
function ebi_framework_preprocess_panels_pane(&$vars) {

  if(isset($vars['pane']->style['style'])) {
    if($vars['pane']->style['style'] === 'ebi-styles') {

      if(isset($vars['pane']->style['settings']['color'])) {
        $vars['classes_array'][] = $vars['pane']->style['settings']['color'];
      }

      if(isset($vars['pane']->style['settings']['color-background'])) {
        $vars['classes_array'][] = $vars['pane']->style['settings']['color-background'];
      }

      if(isset($vars['pane']->style['settings']['callout-box'])) {
        if(($vars['pane']->style['settings']['callout-box']) === 1) {
          $vars['classes_array'][] = 'callout';
        }
      }

      if(isset($vars['pane']->style['settings']['promo-image'])) {
        if(($vars['pane']->style['settings']['promo-image']) === 1) {
          $vars['classes_array'][] = 'promo-image';

          $vars['content'] = strip_tags($vars['content'],'<a><img>'); // only img and a tags, please

          // if has a link, insert title into that space
          if (strpos($vars['content'],'</a>') != 0) {
            $vars['content'] = str_replace('</a>', '<p>'.$vars['title'].'</p></a>', $vars['content']);
          }

          $vars['title'] = '';
        }
      }

      if(isset($vars['pane']->style['settings']['title-label']['enabled'])) {
        if(($vars['pane']->style['settings']['title-label']['enabled']) === 1) {
          $vars['content'] = '<p class="label ' . $vars['pane']->style['settings']['title-label']['color-background'] . '">' . $vars['title'] . '</p>' . $vars['content'];
          $vars['title'] = '';
        }
      }

      if(isset($vars['pane']->style['settings']['custom-classes'])) {
        $classesToAdd = explode(' ', $vars['pane']->style['settings']['custom-classes']);

        for ($i=0; $i < count($classesToAdd); $i++) { 
          $vars['classes_array'][] = $classesToAdd[$i];
        }
      }

    }
  }
  
}
