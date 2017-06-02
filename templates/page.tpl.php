<!--.page -->
<div id="content" role="document" class="page">

  <!--.l-header -->
  <div data-sticky-container>
    <header id="masthead" class="masthead" data-sticky data-sticky-on="large" data-top-anchor="content:top" data-btm-anchor="content:bottom">
      <div class="masthead-inner row">
        <?php if ($top_bar): ?>
          <!--.top-bar -->
          <?php if ($top_bar_classes): ?>
            <div class="<?php print $top_bar_classes; ?>">
          <?php endif; ?>
          <nav class="top-bar" data-topbar <?php print $top_bar_options; ?>>
            <ul class="title-area">
              <li class="name"><h1><?php print $linked_site_name; ?></h1></li>
              <li class="toggle-topbar menu-icon">
                <a href="#"><span><?php print $top_bar_menu_text; ?></span></a></li>
            </ul>
            <section class="top-bar-section">
              <?php if ($top_bar_main_menu) : ?>
                <?php print $top_bar_main_menu; ?>
              <?php endif; ?>
              <?php if ($top_bar_secondary_menu) : ?>
                <?php print $top_bar_secondary_menu; ?>
              <?php endif; ?>
            </section>
          </nav>
          <?php if ($top_bar_classes): ?>
            </div>
          <?php endif; ?>
          <!--/.top-bar -->
        <?php endif; ?>

        <!-- local-title -->
        <div class="columns medium-12" id="local-title">
          <?php if (!empty($page['local_title'])) : ?>
            <?php print render($page['local_title']); ?>
          <?php else: ?>
            <h1><a href="<?php print $variables['local_title_path'] ?>" title="Back to <?php print $variables['local_title']; ?>"><?php print $variables['local_title']; ?></a></h1>
          <?php endif; ?>
          <?php if (!empty($page['header'])): ?>
            <!--.l-header-region -->
            <section class="l-header-region row">
              <?php print render($page['header']); ?>
            </section>
            <!--/.l-header-region -->
          <?php endif; ?>
        </div>
        <!-- /local-title -->

        <!-- local-nav -->
        <?php if ($alt_main_menu): ?>
          <nav id="main-menu" class="navigation" role="navigation">
            <?php if (!empty($page['local_nav'])) : ?>
              <?php print render($page['local_nav']); ?>
            <?php else: ?>
              <?php print ($alt_secondary_menu); ?>
            <?php endif; ?>
            <?php if ($alt_user_menu): ?>
                <?php print $alt_user_menu; ?>
            <?php endif; ?>
          </nav> <!-- /#main-menu -->
        <?php endif; ?>
        <!-- /local-nav -->
      </div>
    </header>

  </div>
  <!--/.l-header -->

  <?php if (!empty($page['featured'])): ?>
    <!--.l-featured -->
    <section class="l-featured row">
      <div class="columns">
        <?php print render($page['featured']); ?>
      </div>
    </section>
    <!--/.l-featured -->
  <?php endif; ?>

  <?php if ($messages && !$ebi_framework_messages_modal): ?>
    <!--.l-messages -->
    <section class="l-messages row">
      <div class="columns">
        <?php if ($messages): print $messages; endif; ?>
      </div>
    </section>
    <!--/.l-messages -->
  <?php endif; ?>
  <?php if ($messages && $ebi_framework_messages_modal): print $messages; endif; ?>

  <?php if (!empty($page['help'])): ?>
    <!--.l-help -->
    <section class="l-help row">
      <div class="columns">
        <?php print render($page['help']); ?>
      </div>
    </section>
    <!--/.l-help -->
  <?php endif; ?>

  <?php if (!empty($breadcrumb)): ?>
    <!--.l-breadcrumb -->
    <div class="row">
      <div class="columns">
        <?php
        if ($breadcrumb): print $breadcrumb; endif;
        ?>
      </div>
    </div>
    <!--/.l-breadcrumb -->
  <?php endif; ?>


  <!--.l-main -->
  <main id="main-content-area" role="main" class="row l-main">

    <!-- .l-main region -->
    <div class="<?php print $main_grid; ?> main columns">
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlight panel callout">
          <?php print render($page['highlighted']); ?>
        </div>
      <?php endif; ?>

      <a id="main-content"></a>

      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
        <?php if (!empty($tabs2)): print render($tabs2); endif; ?>
      <?php endif; ?>

      <?php if ($title): ?>
        <?php print render($title_prefix); ?>
        <h2 id="page-title" class="title"><?php print $title; ?></h2>
        <?php print render($title_suffix); ?>
      <?php endif; ?>

      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>

      <?php print render($page['content']); ?>
    </div>
    <!--/.l-main region -->

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside role="complementary" class="<?php print $sidebar_first_grid; ?> sidebar-first columns sidebar">
        <?php print render($page['sidebar_first']); ?>
      </aside>
    <?php endif; ?>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside role="complementary" class="<?php print $sidebar_sec_grid; ?> sidebar-second columns sidebar">
        <?php print render($page['sidebar_second']); ?>
      </aside>
    <?php endif; ?>
  </main>
  <!--/.l-main -->

  <?php if (!empty($page['triptych_first']) || !empty($page['triptych_middle']) || !empty($page['triptych_last'])): ?>
    <!--.triptych-->
    <section class="l-triptych row">
      <div class="triptych-first medium-4 columns">
        <?php print render($page['triptych_first']); ?>
      </div>
      <div class="triptych-middle medium-4 columns">
        <?php print render($page['triptych_middle']); ?>
      </div>
      <div class="triptych-last medium-4 columns">
        <?php print render($page['triptych_last']); ?>
      </div>
    </section>
    <!--/.triptych -->
  <?php endif; ?>

  <!--.footer-columns -->
  <section class="row l-footer-columns">

    <?php if (!empty($page['footer_firstcolumn'])): ?>
      <div class="footer-first medium-3 columns">
        <?php print render($page['footer_firstcolumn']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($page['footer_secondcolumn'])): ?>
      <div class="footer-second medium-3 columns">
        <?php print render($page['footer_secondcolumn']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($page['footer_thirdcolumn'])): ?>
      <div class="footer-third medium-3 columns">
        <?php print render($page['footer_thirdcolumn']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($page['footer_fourthcolumn'])): ?>
      <div class="footer-fourth medium-3 columns">
        <?php print render($page['footer_fourthcolumn']); ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($page['footer'])): ?>
      <div class="footer columns">
        <?php print render($page['footer']); ?>
      </div>
    <?php endif; ?>
  </section>
  <!--/.footer-columns-->

  <!--.l-footer -->
  <footer>
    <div id="global-footer" class="global-footer">
      <nav id="global-nav-expanded" class="global-nav-expanded row">
        <!-- Footer will be automatically inserted by footer.js -->
      </nav>
      <section id="ebi-footer-meta" class="ebi-footer-meta row">
        <!-- Footer meta will be automatically inserted by footer.js -->
      </section>
    </div>
  </footer>
  <!--/.l-footer -->

</div>
<!--/.page -->
