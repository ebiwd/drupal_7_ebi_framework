<?php
/**
 * Implements hook_form_FORM_ID_alter().
 */
function ebi_framework_form_system_theme_settings_alter(&$form, &$form_state) {
  if (!isset($form['ebi_framework'])) {
    $form['ebi_framework'] = array(
      '#type' => 'vertical_tabs',
      '#weight' => -10,
    );

    $jquery_version = variable_get('jquery_update_jquery_version', '1.5');

    if (!module_exists('jquery_update') || !version_compare($jquery_version, '1.7', '>=')) {
      drupal_set_message(t('!module was not found, or your version of jQuery does not meet the minimum version requirement. Zurb Foundation requires jQuery 1.7 or higher. Please install !module, or Zurb Foundation plugins may not work correctly.',
        array(
          '!module' => l(t('jQuery Update'), 'https://drupal.org/project/jquery_update', array('external' => TRUE, 'attributes' => array('target' => '_blank'))),
        )
      ), 'warning', FALSE);
    }

    /*
     * General Settings.
     */
    $form['ebi_framework']['general'] = array(
      '#type' => 'fieldset',
      '#title' => t('General Settings'),
    );

    $form['ebi_framework']['general']['theme_settings'] = $form['theme_settings'];
    unset($form['theme_settings']);

    $form['ebi_framework']['general']['logo'] = $form['logo'];
    unset($form['logo']);

    $form['ebi_framework']['general']['favicon'] = $form['favicon'];
    unset($form['favicon']);

    /*
     * Foundation Top Bar.
     */
    $form['ebi_framework']['topbar'] = array(
      '#type' => 'fieldset',
      '#title' => t('Foundation Top Bar'),
      '#description' => t('The Foundation Top Bar gives you a great way to display a complex navigation bar on small or large screens.'),
    );

    $form['ebi_framework']['topbar']['ebi_framework_top_bar_enable'] = array(
      '#type' => 'select',
      '#title' => t('Enable'),
      '#description' => t('If enabled, the site name and main menu will appear in a bar along the top of the page.'),
      '#options' => array(
        0 => t('Never'),
        1 => t('Always'),
        2 => t('Mobile only'),
      ),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_enable'),
    );

    /*
     * EBI Framework options.
     */
    $form['ebi_framework']['framework'] = array(
      '#type' => 'fieldset',
      '#title' => t('EBI Framework'),
      '#description' => t('Customise the implementation of the EBI theme.'),
    );

    $form['ebi_framework']['framework']['ebi_icon_font_version'] = array(
      '#type' => 'textfield',
      '#title' => t('Icon fonts version'),
      '#size' => 3,
      '#maxlength' => 3,
      '#required' => TRUE,
      '#default_value' => theme_get_setting('ebi_icon_font_version'),
      '#description' => t('Specify the version of the EBI Icon Fonts you would like to use; this theme was last tested with version 1.3 and should also be compatible with v1.1 and v1.2 For available versions, see: <a href="https://github.com/ebiwd/EBI-Icons-fonts">the EBI Icon Fonts page on GitHub</a>.'),
    );

    $form['ebi_framework']['framework']['ebi_framework_version'] = array(
      '#type' => 'textfield',
      '#title' => t('Framework version'),
      '#size' => 3,
      '#maxlength' => 3,
      '#required' => TRUE,
      '#default_value' => theme_get_setting('ebi_framework_version'),
      '#description' => t('Specify the version of the framework you would like to use; this theme was last tested with version 1.3 and is not compatible with earlier versions. For available versions, see: <a href="https://github.com/ebiwd/EBI-Framework">the framework page on GitHub</a>.'),
    );

    $form['ebi_framework']['framework']['ebi_framework_style'] = array(
      '#type' => 'checkbox',
      '#title' => t('Automatic styling'),
      '#required' => FALSE,
      '#default_value' => theme_get_setting('ebi_framework_style'),
      '#description' => t('By default we use EMBL-EBI colours and assign a pallette by path, such as /research /services, etc. To disable, uncheck this. You can then add custom CSS under "Styles and Scripts".'),
    );

    $form['ebi_framework']['framework']['ebi_framework_development_version'] = array(
      '#type' => 'select',
      '#title' => t('Use a development version?'),
      '#description' => t('If you want to use the dev.ebi.emblstatic.net version of the framework for testing and fonts, you can enable it here.'),
      '#options' => array(
        'production' => t('Production'),
        'dev' => t('Dev'),
      ),
      '#default_value' => theme_get_setting('ebi_framework_development_version'),
    );


    // Group the rest of the settings in a container to be able to quickly hide
    // them if the Top Bar isn't being used.
    $form['ebi_framework']['topbar']['container'] = array(
      '#type' => 'container',
      '#states' => array(
        'visible' => array(
          'select[name="ebi_framework_top_bar_enable"]' => array('!value' => '0'),
        ),
      ),
    );

    $form['ebi_framework']['topbar']['container']['ebi_framework_top_bar_grid'] = array(
      '#type' => 'checkbox',
      '#title' => t('Contain to grid'),
      '#description' => t('Check this for your top bar to be set to your grid width.'),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_grid'),
    );

    $form['ebi_framework']['topbar']['container']['ebi_framework_top_bar_sticky'] = array(
      '#type' => 'checkbox',
      '#title' => t('Sticky'),
      '#description' => t("Check this for your top bar to stick to the top of the screen when the user scrolls down. If you're using the Admin Menu module and have it set to 'Keep menu at top of page', you'll need to check this option to maintain compatibility."),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_sticky'),
    );

    $form['ebi_framework']['topbar']['container']['ebi_framework_top_bar_scrolltop'] = array(
      '#type' => 'checkbox',
      '#title' => t('Scroll to top on click'),
      '#description' => t('Jump to top when sticky nav menu toggle is clicked.'),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_scrolltop'),
      '#states' => array(
        'visible' => array(
          'input[name="ebi_framework_top_bar_sticky"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['ebi_framework']['topbar']['container']['ebi_framework_top_bar_is_hover'] = array(
      '#type' => 'checkbox',
      '#title' => t('Hover to expand menu'),
      '#description' => t('Set this to false to require the user to click to expand the dropdown menu.'),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_is_hover'),
    );

    // Menu settings.
    $form['ebi_framework']['topbar']['container']['menu'] = array(
      '#type' => 'fieldset',
      '#title' => t('Dropdown Menu'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );

    $form['ebi_framework']['topbar']['container']['menu']['ebi_framework_top_bar_menu_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Menu text'),
      '#description' => t('Specify text to go beside the mobile menu icon or leave blank for none.'),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_menu_text'),
    );

    $form['ebi_framework']['topbar']['container']['menu']['ebi_framework_top_bar_custom_back_text'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable custom back text'),
      '#description' => t('This is the text that appears to navigate back one level in the dropdown menu. Set this to false and it will pull the top level link name as the back text.'),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_custom_back_text'),
    );

    $form['ebi_framework']['topbar']['container']['menu']['ebi_framework_top_bar_back_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Custom back text'),
      '#description' => t('Define what you want your custom back text to be.'),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_back_text'),
      '#states' => array(
        'visible' => array(
          'input[name="ebi_framework_top_bar_custom_back_text"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['ebi_framework']['topbar']['container']['menu']['ebi_framework_top_bar_mobile_show_parent_link'] = array(
      '#type' => 'checkbox',
      '#title' => t('Repeat parent link on mobile'),
      '#description' => t('This provides an extra link for users to tap on the sub-menu for mobile'),
      '#default_value' => theme_get_setting('ebi_framework_top_bar_mobile_show_parent_link'),
    );

    /*
     * Tooltips.
     */
    $form['ebi_framework']['tooltips'] = array(
      '#type' => 'fieldset',
      '#title' => t('Tooltips'),
      '#collapsible' => TRUE,
    );

    $form['ebi_framework']['tooltips']['ebi_framework_tooltip_enable'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display form element descriptions in a tooltip'),
      '#default_value' => theme_get_setting('ebi_framework_tooltip_enable'),
    );

    $form['ebi_framework']['tooltips']['ebi_framework_tooltip_position'] = array(
      '#type' => 'select',
      '#title' => t('Tooltip position'),
      '#options' => array(
        'tip-top' => t('Top'),
        'tip-bottom' => t('Bottom'),
        'tip-right' => t('Right'),
        'tip-left' => t('Left'),
      ),
      '#default_value' => theme_get_setting('ebi_framework_tooltip_position'),
      '#states' => array(
        'visible' => array(
          'input[name="ebi_framework_tooltip_enable"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['ebi_framework']['tooltips']['ebi_framework_tooltip_mode'] = array(
      '#type' => 'select',
      '#title' => t('Display mode'),
      '#description' => t('You can either display the tooltip on the form element itself or on a "More information?" link below the element.'),
      '#options' => array(
        'element' => t('On the form element'),
        'text' => t('Below element on "More information?" text'),
      ),
      '#default_value' => theme_get_setting('ebi_framework_tooltip_mode'),
      '#states' => array(
        'visible' => array(
          'input[name="ebi_framework_tooltip_enable"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['ebi_framework']['tooltips']['ebi_framework_tooltip_text'] = array(
      '#type' => 'textfield',
      '#title' => t('More information text'),
      '#description' => t('Customize the tooltip trigger text.'),
      '#default_value' => theme_get_setting('ebi_framework_tooltip_text'),
      '#states' => array(
        'visible' => array(
          'input[name="ebi_framework_tooltip_enable"]' => array('checked' => TRUE),
          'select[name="ebi_framework_tooltip_mode"]' => array('value' => 'text'),
        ),
      ),
    );

    $form['ebi_framework']['tooltips']['ebi_framework_tooltip_touch'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable for touch devices'),
      '#description' => t("If you don't want tooltips to interfere with a touch event, you can disable them for those devices."),
      '#default_value' => theme_get_setting('ebi_framework_tooltip_touch'),
      '#states' => array(
        'visible' => array(
          'input[name="ebi_framework_tooltip_enable"]' => array('checked' => TRUE),
        ),
      ),
    );

    /*
     * Styles and Scripts.
     */
    $form['ebi_framework']['styles_scripts'] = array(
      '#type' => 'fieldset',
      '#title' => t('Styles and Scripts'),
      '#collapsible' => TRUE,
    );

    $form['ebi_framework']['styles_scripts']['ebi_framework_disable_core_css'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Drupal Core CSS'),
      '#description' => t('Removes all CSS files provided by Drupal Core. <strong>Warning:</strong> This can break things, use with caution.'),
      '#default_value' => theme_get_setting('ebi_framework_disable_core_css'),
    );

    /*
     * CSS by page Settings.
     */
    $form['ebi_framework']['styles_scripts']['css_by_page'] = array(
      '#type' => 'fieldset',
      '#title' => t('CSS by page'),
      '#description' => t('You can load custom CSS files on specific pages'),
      '#collapsible' => TRUE,
    );

    // Allow up to 10 custom rules
    for ($i=0; $i < 10; $i++) {
      $form['ebi_framework']['styles_scripts']['css_by_page'][$i] = array(
        '#type' => 'fieldset',
        '#title' => t('CSS rule '.($i+1)),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
      );

      $targetFile = 'ebi_framework_css_rules_file_'.$i;
      $targetRuleType = 'ebi_framework_css_rules_rule_type_'.$i;
      $targetCSSConditions = 'ebi_framework_css_rules_conditions_'.$i;

      $form['ebi_framework']['styles_scripts']['css_by_page'][$i][$targetFile] = array(
        '#type' => 'textfield',
        '#title' => t('CSS path '.($i+1)),
        '#size' => 40,
        '#maxlength' => 300,
        '#default_value' => theme_get_setting($targetFile),
        '#description' => t('The location of the CSS file you want to load'),
      );

      $form['ebi_framework']['styles_scripts']['css_by_page'][$i][$targetRuleType] = array(
        '#type' => 'radios',
        '#title' => t('Add the CSS on specific pages'),
        '#options' => array(
          CSS_INJECTOR_PAGES_NOTLISTED => t('Add on every page except the listed pages.'),
          CSS_INJECTOR_PAGES_LISTED => t('Add on only the listed pages.')
        ),
        '#default_value' => theme_get_setting($targetRuleType),
      );

      $form['ebi_framework']['styles_scripts']['css_by_page'][$i][$targetCSSConditions] = array(
        '#type' => 'textarea',
        '#title' => t('Pages'),
        '#rows' => 2,
        '#default_value' => theme_get_setting($targetCSSConditions),
        '#description' => t("Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are %blog for the blog page and %blog-wildcard for every personal blog. %front is the front page.", array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>')),
      );

      if (!theme_get_setting($targetFile)) {
        // end after adding one new row
        break;
      }
    }

    /*
     * Breadcrumb Settings.
     */
    $form['ebi_framework']['breadcrumb'] = array(
      '#type' => 'fieldset',
      '#title' => t('Breadcrumb Settings'),
      '#collapsible' => TRUE,
    );

    $form['ebi_framework']['breadcrumb']['ebi_framework_use_second_breadcrumb_in_header'] = array(
      '#type' => 'checkbox',
      '#title' => t('Use the parent breadcrumb structure as the localnav title'),
      '#description' => t('If enabled and there is a parent breadcumb, it will be used in the local title. This is appropriate for Research, Services, About, etc.'),
      '#default_value' => theme_get_setting('ebi_framework_use_second_breadcrumb_in_header'),
    );

    $form['ebi_framework']['breadcrumb']['ebi_framework_show_pagetitle_as_crumb'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show page title as last breadcrumb'),
      '#description' => t(''),
      '#default_value' => theme_get_setting('ebi_framework_show_pagetitle_as_crumb'),
    );

    $form['ebi_framework']['breadcrumb']['ebi_framework_strip_first_breadcrumb'] = array(
      '#type' => 'select',
      '#title' => t('Strip breadcrumb'),
      '#description' => t('How many levels of breadcrumbs do you want to strip from display?'),
      '#options' => array(
        '0' => t('None'),
        '1' => t('One (default)'),
        '2' => t('Two'),
        '3' => t('Three'),
        '4' => t('Four'),
      ),
      '#default_value' => theme_get_setting('ebi_framework_strip_first_breadcrumb'),
    );

    /*
     * Misc Settings.
     */
    $form['ebi_framework']['misc'] = array(
      '#type' => 'fieldset',
      '#title' => t('Misc Settings'),
      '#collapsible' => TRUE,
    );

    $form['ebi_framework']['misc']['ebi_framework_html_tags'] = array(
      '#type' => 'checkbox',
      '#title' => t('Prune HTML Tags'),
      '#default_value' => theme_get_setting('ebi_framework_html_tags'),
      '#description' => t('Prunes your <code>style</code>, <code>link</code>, and <code>script</code> tags as <a href="!link" target="_blank"> suggested by Nathan Smith</a>.', array('!link' => 'http://sonspring.com/journal/html5-in-drupal-7#_pruning')),
    );

    $form['ebi_framework']['misc']['ebi_framework_messages_modal'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display status messages in a modal'),
      '#description' => t('Check this to display Drupal status messages in a Zurb Foundation reveal modal.'),
      '#default_value' => theme_get_setting('ebi_framework_messages_modal'),
    );

    $form['ebi_framework']['misc']['ebi_framework_messages_modal_static'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display modal messages statically'),
      '#description' => t('Check this if you want the messages to show at the top of content and not hover. Requires modal messages to be enabled.'),
      '#default_value' => theme_get_setting('ebi_framework_messages_modal_static'),
    );

    $form['ebi_framework']['misc']['ebi_framework_pager_center'] = array(
      '#type' => 'checkbox',
      '#title' => t('Center pagers on screen'),
      '#description' => t('Uncheck this option to align pagers to the left. For more information on Foundation Pagers, please refer to the <a href="!link" target="_blank">documentation</a>.', array('!link' => 'http://foundation.zurb.com/docs/components/pagination.html')),
      '#default_value' => theme_get_setting('ebi_framework_pager_center'),
    );

  }
}
