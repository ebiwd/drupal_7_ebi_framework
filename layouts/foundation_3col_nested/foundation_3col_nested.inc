<?php

/**
 * Implements hook_panels_layouts()
 */
function ebi_framework_foundation_3col_nested_panels_layouts() {
  $items['foundation_3col_nested'] = array(
    'title' => t('Foundation: nested 3 column rows'),
    'category' => t('Foundation: 3'),
    'icon' => 'foundation_3col_nested.png',
    'theme' => 'foundation_3col_nested',
    //'admin css' => '../foundation_panels_admin.css',
    'regions' => array(
      'top' => t('Top'),
      'center' => t('Center'),
      'center-left' => t('Center left'),
      'center-right' => t('Center right'),
      'center-bottom-left' => t('Center bottom left'),
      'center-bottom-right' => t('Center bottom right'),
      'right' => t('Right'),
      'bottom' => t('Bottom'),
    ),
  );
  return $items;
}

