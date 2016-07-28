<!--.page -->
<div role="document" class="page">

  <!--.l-header -->
  <div data-sticky-container>
    <div id="local-masthead" data-sticky data-sticky-on="large" data-top-anchor="180" data-btm-anchor="300000">
      <header role="banner" class="l-header">

        <div id="global-masthead" class="clearfix">
          <!--This has to be one line and no newline characters-->
          <a href="//www.ebi.ac.uk/" title="Go to the EMBL-EBI homepage"><span class="ebi-logo"></span></a>

          <nav>
            <div class="row">
              <ul id="global-nav" class="menu">
                <!-- set active class as appropriate -->
                <li id="home-mobile" class=""><a href="//www.ebi.ac.uk"></a></li>
                <li id="home" class="<?php print $variables['active_in_global_nav']['home']; ?>"><a href="//www.ebi.ac.uk"><i class="icon icon-generic" data-icon="H"></i> EMBL-EBI</a></li>
                <li id="services" class="<?php print $variables['active_in_global_nav']['services']; ?>"><a href="//www.ebi.ac.uk/services"><i class="icon icon-generic" data-icon="("></i> Services</a></li>
                <li id="research" class="<?php print $variables['active_in_global_nav']['research']; ?>"><a href="//www.ebi.ac.uk/research"><i class="icon icon-generic" data-icon=")"></i> Research</a></li>
                <li id="training"  class="<?php print $variables['active_in_global_nav']['training']; ?>"><a href="//www.ebi.ac.uk/training"><i class="icon icon-generic" data-icon="t"></i> Training</a></li>
                <li id="about" class="<?php print $variables['active_in_global_nav']['about']; ?>"><a href="//www.ebi.ac.uk/about"><i class="icon icon-generic" data-icon="i"></i> About us</a></li>
                <li id="search">
                  <a href="#" data-toggle="search-global-dropdown"><i class="icon icon-functional" data-icon="1"></i> <span class="show-for-small-only">Search</span></a>
                  <div id="search-global-dropdown" class="dropdown-pane" data-dropdown data-options="closeOnClick:true;">
                    <form id="global-search" name="global-search" action="/ebisearch/search.ebi" method="GET">
                      <fieldset>
                        <div class="input-group">
                          <input type="text" name="query" id="global-searchbox" class="input-group-field" placeholder="Search all of EMBL-EBI">
                          <div class="input-group-button">
                            <input type="submit" name="submit" value="Search" class="button">
                            <input type="hidden" name="db" value="allebi" checked="checked">
                            <input type="hidden" name="requestFrom" value="global-masthead" checked="checked">
                          </div>
                        </div>
                      </fieldset> 
                    </form>
                  </div>
                </li>
                <li class="float-right show-for-medium embl-selector">
                  <button class="button float-right" type="button" data-toggle="embl-dropdown">Hinxton</button>
                  <!-- The dropdown menu will be programatically added by script.js -->
                </li>
                <!-- The dropdown menu will be programatically added by script.js -->
                <!-- Temporary variant while RWD is still in dev. -->
                <!-- <li class="float-right show-for-medium embl-selector">
                  <a href="//www.ebi.ac.uk" style="display: inline-block; background: no-repeat 4px 50% url('//khawkins98.github.io/EBI-Framework//images/logos/EMBL-EBI/EMBL_EBI_Logo_white.svg'); padding-left: 95px; background-size: 105px; height: 31px;"></a>
                </li> -->
              </ul>
            </div>
          </nav>

        </div>


        <div class="masthead row">

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
            <h1><a href="<?php print $variables['local_title_path'] ?>" title="Back to <?php print $variables['local_title']; ?>"><?php print $variables['local_title']; ?></a></h1>
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
              <?php print ($alt_secondary_menu); ?>
              <?php if ($alt_user_menu): ?>
                  <?php print $alt_user_menu; ?>
              <?php endif; ?>
            </nav> <!-- /#main-menu -->
          <?php endif; ?>


<!--
          <nav>
            <ul class="dropdown menu float-left" data-description="navigational">
              <li><a href="#test">About</a></li>
              <li class="active"><a href="#">Generic</a></li>
              <li><a href="#">Generic</a></li>
              <li><a href="#">Generic</a></li>
            </ul>
            <ul class="menu dropdown float-right" data-dropdown-menu data-description="functional">
              <li class="functional"><a href="#"><i class="icon icon-generic" data-icon="d"></i> Share this</a>
                <ul class="menu js">
                  <li><a href="#">Item 1A Loooong</a></li>
                  <li>
                    <a href='#'> Item 1 sub</a>
                    <ul class='menu'>
                      <li><a href='#'>Item 1 subA</a></li>
                      <li><a href='#'>Item 1 subB</a></li>
                      <li>
                        <a href='#'> Item 1 sub</a>
                        <ul class='menu'>
                          <li><a href='#'>Item 1 subA</a></li>
                          <li><a href='#'>Item 1 subB</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href='#'> Item 1 sub</a>
                        <ul class='menu'>
                          <li><a href='#'>Item 1 subA</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">Item 1B</a></li>
                </ul>

            </ul>
          </nav>

          -->
          <!-- /local-nav -->

        </div>

      </header>
    </div>
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
  <main role="main" class="row l-main">
    
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
  </section>
  <!--/.footer-columns-->

  <!--.l-footer -->
  <footer id="global-footer" class="l-footer panel row" role="contentinfo">
    <nav id="global-nav-expanded"></nav>

    <div id="ebi-footer-meta"></div>
    <?php if (!empty($page['footer'])): ?>
      <div class="footer columns">
        <?php print render($page['footer']); ?>
      </div>
    <?php endif; ?>

  </footer>
  <!--/.l-footer -->

</div>
<!--/.page -->
