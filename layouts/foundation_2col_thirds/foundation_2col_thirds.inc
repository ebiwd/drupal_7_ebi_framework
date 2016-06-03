<?php

/**
 * Implements hook_panels_layouts()
 */
function ebi_framework_foundation_2col_thirds_panels_layouts() {
  $items['foundation_2col_thirds'] = array(
    'title' => t('Foundation: stacked 2 column row with thirds'),
    'category' => t('Foundation: 2'),
    'icon' => 'foundation_2col_thirds.png',
    'theme' => 'foundation_2col_thirds',
    //'admin css' => '../foundation_panels_admin.css',
    'regions' => array(
      'top' => t('Top'),
      'left' => t('Left 8 cols'),
      'right' => t('Right 4 cols'),
      'left-middle-8' => t('Left middle 8 cols'),
      'right-middle-4' => t('Right middle 4 cols'),
      'left-4' => t('Left 4 cols'),
      'right-8' => t('Right 8 cols'),
      'bottom' => t('Bottom'),
    ),
  );
  return $items;
}

