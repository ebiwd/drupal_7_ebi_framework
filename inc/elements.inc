<?php
/**
 * Override drupal core messages with zurb foundation alert-box messages.
 * Customize the colors within the _settings.scss file.
 *
 * http://foundation.zurb.com/docs/elements.php#panelEx
 */
function ebi_framework_status_messages($variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'error' => t('Error message'),
    'status' => t('Status message'),
    'warning' => t('Warning message'),
  );

  $status_mapping = array(
    'error' => 'alert',
    'status' => 'success',
    'warning' => 'secondary'
  );

  $conditions = '';

  foreach (drupal_get_messages($display) as $type => $messages) {
    if (isset($status_mapping[$type])) {
      $output .= "<div class=\"alert-box $status_mapping[$type]\">\n";
      $conditions .= $status_mapping[$type] . ' ';
    }
    else {
      $output .= "<div class=\"alert-box\">\n";
    }

    if (!empty($status_heading[$type])) {
      $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
    }
    if (count($messages) > 1) {
      $output .= " <ul class=\"no-bullet\">\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }

    if(!theme_get_setting('ebi_framework_messages_modal')) 
      $output .= '<a href="#" class="close">&times;</a>';
    
    $output .= "</div>\n";
  }

  $static_display = '';
  if (theme_get_setting('ebi_framework_messages_modal_static')) {
    $static_display = 'static ';
  }

  if ($output != '' && theme_get_setting('ebi_framework_messages_modal')) {
    drupal_add_js('jQuery(document).ready(function(){jQuery(\'#status-messages\').foundation(\'open\')});',array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));
    $output = '<div id="status-messages" class="reveal callout ' . $static_display . $conditions . '" role="alertdialog" data-reveal data-overlay="false" data-close-on-click="false">'. $output;
    // unused options:
    // data-close-on-click="false"
    $output .= '<button class="close-button" data-close aria-label="Close reveal" type="button"><span aria-hidden="true">&times;</span></button>';
    $output .= "</div>";
  }

  return $output;
}
