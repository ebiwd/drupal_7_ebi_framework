<?php

  // Some useful custom EBI page variables
  $is_admin = (strpos($classes, 'role-administrator') !== FALSE || strpos($classes, 'user-1') !== FALSE);
  $is_authenticated = (strpos($classes, 'role-authenticated-user') !== FALSE || strpos($classes, 'user-1') !== FALSE);
  $is_prod = in_array($_SERVER['HTTP_HOST'], array('www.ebi.ac.uk', 'intranet.ebi.ac.uk', 'staff.ebi.ac.uk', 'content.ebi.ac.uk', 'tsc.ebi.ac.uk'), TRUE);

  // rabbit hole for disallowed pages
  if (!$is_authenticated && preg_match('#^/+(group/)#sm', request_uri())) {
    header("HTTP/1.0 404 Not Found");
    exit();
  }


// WE MIGHT NEED THIS, but let's not assume...
  if (! function_exists('ebi_framework_tidy')) {
    function ebi_framework_tidy($buffer, $is_admin, $is_prod) {
      $local_server = str_replace('.', '\.', $_SERVER['HTTP_HOST']);
      // remove http protcol from: from www.ebi links
  //    $buffer = preg_replace('#(href|src)\s*=\s*(["\'])https?:(//www\.ebi\.ac\.uk)#sm', '$1=$2$3', $buffer);
  //    $buffer = preg_replace('#(url)\s*\(\s*(["\']?)https?:(//www\.ebi\.ac\.uk)#sm', '$1($2$3', $buffer);
  //    $buffer = preg_replace('#(url)\s*\(\s*(["\']?)(https?:)?//frontier\.ebi\.ac\.uk/?#sm', '$1($2/', $buffer);
      // remove http protcol from: from local domain links
      $buffer = preg_replace("#(href|src)\s*=\s*([\"'])https?:(//{$local_server})#sm", '$1=$2$3', $buffer);
  //    $buffer = preg_replace("#(url)\s*\(\s*([\"']?)https?:(//{$local_server})#sm", '$1($2$3', $buffer);

      if (!$is_prod) {
        $buffer = str_replace('//www.ebi.ac.uk', '//wwwdev.ebi.ac.uk', $buffer);
      }
      $buffer = preg_replace('#(local|global)_(nav)#sm', '$1-$2', $buffer);
      $buffer = preg_replace('#(grid)-(\d+)#sm', '$1_$2', $buffer);

      if (strpos($buffer, 'key-not-found-in-xml') !== FALSE) {
        $buffer = ''; // clear original content
        drupal_not_found(); // display not found page
      }

      return $buffer;
    }
  }
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?>
<!DOCTYPE html>
<!-- Sorry no IE7 support! -->
<!-- @see http://foundation.zurb.com/docs/index.html#basicHTMLMarkup -->

<!--[if IE 8]><html class="no-js lt-ie9" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>"> <!--<![endif]-->
<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print preg_replace('#http:#Usm', '', $styles); ?>
  <?php print (ebi_framework_tidy($scripts, $is_admin, $is_prod)); ?>

  <!-- If you have custom icon, replace these as appropriate.
       You can generate them at realfavicongenerator.net -->
  <link rel="icon" type="image/x-icon" href="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/favicon.ico" />
  <link rel="icon" type="image/png" href="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="192×192" href="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/android-chrome-192x192.png" /> <!-- Android (192px) -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/apple-icon-114x114.png" /> <!-- For iPhone 4 Retina display (114px) -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/apple-icon-72x72.png" /> <!-- For iPad (72px) -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/apple-icon-144x144.png" /> <!-- For iPad retinat (144px) -->
  <link rel="apple-touch-icon-precomposed" href="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/apple-icon-57x57.png" /> <!-- For iPhone (57px) -->
  <link rel="mask-icon" href="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/safari-pinned-tab.svg" color="#ffffff" /> <!-- Safari icon for pinned tab -->
  <meta name="msapplication-TileColor" content="#2b5797" /> <!-- MS Icons -->
  <meta name="msapplication-TileImage" content="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/images/logos/EMBL-EBI/favicons/mstile-144x144.png" />

  <!-- <meta name="ebi-localmasthead-color" content="#241a00">  -->
  <!-- <meta name="ebi-localmasthead-image" content="https://ebi.emblstatic.net/web_guidelines/EBI-Framework/images/backgrounds/training-yellow-2.jpg"> -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div class="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <header id="masthead-black-bar" class="clearfix masthead-black-bar">
    <nav class="row">
      <ul id="global-nav" class="menu">
        <!-- set active class as appropriate -->
        <li class="home-mobile"><a href="//www.ebi.ac.uk"></a></li>
        <li class="home <?php print $variables['active_in_global_nav']['home']; ?>"><a href="//www.ebi.ac.uk">EMBL-EBI</a></li>
        <li class="services <?php print $variables['active_in_global_nav']['services']; ?>"><a href="//www.ebi.ac.uk/services">Services</a></li>
        <li class="research <?php print $variables['active_in_global_nav']['research']; ?>"><a href="//www.ebi.ac.uk/research">Research</a></li>
        <li class="training <?php print $variables['active_in_global_nav']['training']; ?>"><a href="//www.ebi.ac.uk/training">Training</a></li>
        <li class="about <?php print $variables['active_in_global_nav']['about']; ?>"><a href="//www.ebi.ac.uk/about">About us</a></li>
        <li class="search">
          <a href="#" data-toggle="search-global-dropdown"><span class="show-for-small-only">Search</span></a>
          <div id="search-global-dropdown" class="dropdown-pane" data-dropdown data-options="closeOnClick:true;">
          <!-- The dropdown menu will be programatically added by script.js -->
          </div>
        </li>
        <li class="float-right show-for-medium embl-selector">
          <button class="button float-right" type="button" data-toggle="embl-dropdown">Hinxton</button>
          <!-- The dropdown menu will be programatically added by script.js -->
        </li>
      </ul>
    </nav>
  </header>
  <?php print (ebi_framework_tidy($page_top, $is_admin, $is_prod)); ?>
  <?php print (ebi_framework_tidy($page, $is_admin, $is_prod)); ?>
  <?php print (ebi_framework_tidy($page_bottom, $is_admin, $is_prod)); ?>
  <?php print _ebi_framework_add_reveals(); ?>

  <script>
  (function ($, Drupal, window, document, undefined) {
    // invoke foundation
    $(document).foundation();
    // ivoke our modifications
    $(document).foundationExtendEBI();
  })(jQuery, Drupal, this, this.document);
  </script>
</body>
</html>
