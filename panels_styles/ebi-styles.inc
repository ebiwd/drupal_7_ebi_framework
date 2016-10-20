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

function foreground_colors() {
  return array(
      '' => t('- Default -'),
      'ebi-color' => t('EBI Petrol color'),
      'services-color' => t('Services color'),
      'research-color' => t('Research color'),
      'training-color' => t('Training color'),
      'industry-color' => t('Industry color'),
      'elixir-color' => t('ELIXIR color'),
      'white-color' => t('White color'),
      'secondary-color' => t('Secondary color'),
    );
}

function spacing_units() {
  return array(
      '' => t('- Default -'),
      'none' => t('none'),
      'xsmall' => t('xsmall'),
      'small' => t('small'),
      'medium' => t('medium'),
      'large' => t('large'),
      'xlarge' => t('xlarge'),
    );
}

/**
 * Renders the pane content.
 */
function theme_ebi_framework_ebi_styles_style_render_pane(&$vars) {
  // passing CSS is super tricky with panels, and doing it reliably with the theme cache
  // This approach is based off the below and has proved the most reliable:
  // https://www.drupal.org/node/1875172

  // Process any user opptions
  $customBody = ebi_framework_preprocess_panels_pane($vars);

  // Face out $vars
  $content = $vars['content'];
  $pane = $vars['pane'];
  $display = $vars['display'];

  if (!empty($content)) {
    // Attach any rednered content
    $content->css_class = join(' ',$vars['classes_array']);
    $content->title = $vars['content']->title;
    $content->content = $vars['content']->content;

    // redner the output -- this is where things would otherwise go wrong with drupal theme caching
    $output = theme('panels_pane', array('content' => $content, 'pane' => $pane, 'display' => $display));

    return $output;
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
    '#options' => foreground_colors(),
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

  $form['intro-unit'] = array(
    '#type' => 'checkbox',
    '#title' => t('Intro unit'),
    '#default_value' => (isset($style_settings['intro-unit'])) ? $style_settings['intro-unit'] : FALSE,
  );

  $form['spacing'] = array(
    '#type' => 'fieldset',
    '#title' => t('Spacing'),
    // '#description' => t('Show this panel\'s title as a label.'),
    '#collapsible' => TRUE,
    '#collapsed' => (isset($style_settings['spacing']['enable-spacing'])) ? !$style_settings['spacing']['enable-spacing'] : TRUE,
  );

  $form['spacing']['enable-spacing'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable custom spacing'),
    '#default_value' => (isset($style_settings['spacing']['enable-spacing'])) ? $style_settings['spacing']['enable-spacing'] : FALSE,
  );

  $form['spacing']['padding-top'] = array(
    '#type' => 'select',
    '#title' => t('Padding top'),
    '#default_value' => (isset($style_settings['spacing']['padding-top'])) ? $style_settings['spacing']['padding-top'] : FALSE,
    '#options' => spacing_units(),
  );
  $form['spacing']['padding-right'] = array(
    '#type' => 'select',
    '#title' => t('Padding right'),
    '#default_value' => (isset($style_settings['spacing']['padding-right'])) ? $style_settings['spacing']['padding-right'] : FALSE,
    '#options' => spacing_units(),
  );
  $form['spacing']['padding-bottom'] = array(
    '#type' => 'select',
    '#title' => t('Padding bottom'),
    '#default_value' => (isset($style_settings['spacing']['padding-bottom'])) ? $style_settings['spacing']['padding-bottom'] : FALSE,
    '#options' => spacing_units(),
  );
  $form['spacing']['padding-left'] = array(
    '#type' => 'select',
    '#title' => t('Padding left'),
    '#default_value' => (isset($style_settings['spacing']['padding-left'])) ? $style_settings['spacing']['padding-left'] : FALSE,
    '#options' => spacing_units(),
  );

  $form['spacing']['margin-top'] = array(
    '#type' => 'select',
    '#title' => t('Margin top'),
    '#default_value' => (isset($style_settings['spacing']['margin-top'])) ? $style_settings['spacing']['margin-top'] : FALSE,
    '#options' => spacing_units(),
  );
  $form['spacing']['margin-right'] = array(
    '#type' => 'select',
    '#title' => t('Margin right'),
    '#default_value' => (isset($style_settings['spacing']['margin-right'])) ? $style_settings['spacing']['margin-right'] : FALSE,
    '#options' => spacing_units(),
  );
  $form['spacing']['margin-bottom'] = array(
    '#type' => 'select',
    '#title' => t('Margin bottom'),
    '#default_value' => (isset($style_settings['spacing']['margin-bottom'])) ? $style_settings['spacing']['margin-bottom'] : FALSE,
    '#options' => spacing_units(),
  );
  $form['spacing']['margin-left'] = array(
    '#type' => 'select',
    '#title' => t('Margin left'),
    '#default_value' => (isset($style_settings['spacing']['margin-left'])) ? $style_settings['spacing']['margin-left'] : FALSE,
    '#options' => spacing_units(),
  );

  $form['links'] = array(
    '#type' => 'fieldset',
    '#title' => t('Links'),
    // '#description' => t('Show this panel\'s title as a label.'),
    '#collapsible' => TRUE,
    '#collapsed' => (isset($style_settings['links']['no-underline'])) ? !$style_settings['links']['no-underline'] : TRUE,
  );

  $form['links']['no-underline'] = array(
    '#type' => 'checkbox',
    '#title' => t('Do not underline links'),
    '#default_value' => (isset($style_settings['links']['no-underline'])) ? $style_settings['links']['no-underline'] : FALSE,
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
    // '#description' => t('Show this panel\'s title as a label.'),
    '#collapsible' => TRUE,
    '#collapsed' => (isset($style_settings['title-label']['enabled'])) ? !$style_settings['title-label']['enabled'] : TRUE,
  );

  $form['title-label']['enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show this panel\'s title as a label'),
    '#default_value' => (isset($style_settings['title-label']['enabled'])) ? $style_settings['title-label']['enabled'] : FALSE,
  );

  $form['title-label']['color'] = array(
    '#type' => 'select',
    '#title' => t('Label color'),
    '#default_value' => (isset($style_settings['title-label']['color'])) ? $style_settings['title-label']['color'] : FALSE,
    '#options' => foreground_colors(),
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

//  debug:
//  print_r($vars);
//  print_r($vars['pane']->subtype);

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

      if(isset($vars['pane']->style['settings']['intro-unit'])) {
        if(($vars['pane']->style['settings']['intro-unit']) === 1) {
          $vars['classes_array'][] = 'intro-unit';
        }
      }

      // Custom spacing
      if(isset($vars['pane']->style['settings']['spacing']['enable-spacing'])) {
        if(($vars['pane']->style['settings']['spacing']['enable-spacing']) === 1) {
          if($vars['pane']->style['settings']['spacing']['margin-top'] != '') {
            $vars['classes_array'][] = 'margin-top-' . $vars['pane']->style['settings']['spacing']['margin-top'];
          }
          if($vars['pane']->style['settings']['spacing']['margin-right'] != '') {
            $vars['classes_array'][] = 'margin-right-' . $vars['pane']->style['settings']['spacing']['margin-right'];
          }
          if($vars['pane']->style['settings']['spacing']['margin-bottom'] != '') {
            $vars['classes_array'][] = 'margin-bottom-' . $vars['pane']->style['settings']['spacing']['margin-bottom'];
          }
          if($vars['pane']->style['settings']['spacing']['margin-left'] != '') {
            $vars['classes_array'][] = 'margin-left-' . $vars['pane']->style['settings']['spacing']['margin-left'];
          }

          if($vars['pane']->style['settings']['spacing']['padding-top'] != '') {
            $vars['classes_array'][] = 'padding-top-' . $vars['pane']->style['settings']['spacing']['padding-top'];
          }
          if($vars['pane']->style['settings']['spacing']['padding-right'] != '') {
            $vars['classes_array'][] = 'padding-right-' . $vars['pane']->style['settings']['spacing']['padding-right'];
          }
          if($vars['pane']->style['settings']['spacing']['padding-bottom'] != '') {
            $vars['classes_array'][] = 'padding-bottom-' . $vars['pane']->style['settings']['spacing']['padding-bottom'];
          }
          if($vars['pane']->style['settings']['spacing']['padding-left'] != '') {
            $vars['classes_array'][] = 'padding-left-' . $vars['pane']->style['settings']['spacing']['padding-left'];
          }
        }
      }

      // PREVIOUS STYLE WITH IMAGE UNDERNEATH
      // if(isset($vars['pane']->style['settings']['promo-image'])) {
      //   if(($vars['pane']->style['settings']['promo-image']) === 1) {
      //     $vars['classes_array'][] = 'promo-image';

      //     $vars['content'] = strip_tags($vars['content'],'<a><img>'); // only img and a tags, please

      //     // if has a link, insert title into that space
      //     if (strpos($vars['content'],'</a>') != 0) {
      //       $vars['content'] = str_replace('</a>', '<p>'.$vars['title'].'</p></a>', $vars['content']);
      //     }

      //     $vars['title'] = '';
      //   }
      // }

      if(isset($vars['pane']->style['settings']['promo-image'])) {

        if(($vars['pane']->style['settings']['promo-image']) === 1) {

          $vars['classes_array'][] = 'with-overlay';

          $vars['content']->content = strip_tags($vars['content']->content,'<a><img>'); // only IMG and A tags, please

          // if has a link, insert title into that space
          if (strpos($vars['content']->content,'</a>') != 0) {
            $vars['content']->content = str_replace('</a>', '<div class="caption"><div class="inner">' . $vars['content']->title.'</div></div></a>', $vars['content']->content);
          }

          $vars['content']->title = '';
        }
      }

      // Link underlines
      if(isset($vars['pane']->style['settings']['links']['no-underline'])) {
        if(($vars['pane']->style['settings']['links']['no-underline']) === 1) {
          $vars['classes_array'][] = 'no-underline';
        }
      }

      // Customise the label
      if(isset($vars['pane']->style['settings']['title-label']['enabled'])) {
        if(($vars['pane']->style['settings']['title-label']['enabled']) === 1) {
          $vars['content']->content = '<p class="label ' . $vars['pane']->style['settings']['title-label']['color'] . '">' . $vars['content']->title . '</p>' . $vars['content']->content;
          $vars['content']->title = '';
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
