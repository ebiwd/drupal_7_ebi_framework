<?php
/**
 * @file
 * Template for a 3 column panel layout.
 *
 * This template provides a three column 23%-33%-33% panel display layout, with
 * additional areas for the top and the bottom.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['top']: Content in the top row.
 *   - $content['left']: Content in the left column.
 *   - $content['middle']: Content in the middle column.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<?php !empty($css_id) ? print '<div id="' . $css_id . '">' : ''; ?>
  <?php if ($content['top']): ?>
    <div class="row">
      <div class="small-12 columns analytics-content-intro">
			  <?php print $content['top']; ?>
      </div>
		</div>
  <?php endif ?>

  <div class="row">
    <div class="small-12 medium-4 columns analytics-content-left">
      <?php print $content['left']; ?>
    </div>
    <div class="small-12 medium-4 columns analytics-content-main">
      <?php print $content['middle']; ?>
    </div>
    <div class="small-12 medium-4 columns analytics-content-right">
      <?php print $content['right']; ?>
    </div>
  </div>

  <?php if ($content['bottom']): ?>
    <div class="row">
      <div class="small-12 columns analytics-content-footer">
			  <?php print $content['bottom']; ?>
      </div>
    </div>
  <?php endif ?>
<?php !empty($css_id) ? print '</div>' : ''; ?>
