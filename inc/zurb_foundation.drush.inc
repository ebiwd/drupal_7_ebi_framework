<?php
/**
 * @file
 * Contains functions only needed for drush integration.
 */

/**
 * Implementation of hook_drush_command().
 */
function ebi_framework_drush_command() {
  $items = array();

  $items['foundation-sub-theme'] = array(
    'description' => 'NOT SUPPORTED IN THIS VARIANT. Create a ZURB foundation sub-theme',
    'aliases' => array('fst'),
    'arguments' => array(
      'name'         => 'Your sub-theme name.',
    ),
    'options' => array(
      'machine_name' => 'A machine-readable name for your theme, optional. Machine name must be lowercase only, with underscores instead of spaces.',
      'description'  => 'Your sub-theme description.',
    ),
    'examples' => array(
      'drush fst "custom theme name"' => 'Create a sub-theme with the default options.',
      'drush fst "foo bar" "foo_bar" --description="My supersweet awesome theme"' => 'Create a sub-theme with additional options.',
    ),
  );

  return $items;
}

/**
 * Create a Zurb foundation sub-theme.
 */
function drush_ebi_framework_foundation_sub_theme($name) {
// not supported
}

/**
 * Internal helper: Replace strings in a file.
 */
function ebi_framework_file_str_replace($file_path, $find, $replace) {
  $file_contents = file_get_contents($file_path);
  $file_contents = str_replace($find, $replace, $file_contents);
  file_put_contents($file_path, $file_contents);
}

/**
 * Implements hook_drush_help().
 */
function ebi_framework_drush_help($section) {
  switch ($section) {
    case 'drush:foundation-sub-theme':
      return dt("Create a ZURB foundation custom sub-theme.");
  }
}
