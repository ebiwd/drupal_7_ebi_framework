<?php
/**
 * @file
 * Template file for field_slideshow
 *
 *
 */
if (!isset($controls_position)) {
  $controls_position = "after";
}
if (!isset($pager_position)) {
  $pager_position = "after";
}
?>
<div id="field-slideshow-<?php print $slideshow_id; ?>-wrapper" class="field-slideshow-wrapper">
  <?php if (isset($breakpoints) && isset($breakpoints['mapping']) && !empty($breakpoints['mapping'])) {
    $style = 'height:' . $slides_max_height . 'px';
  } else {
    $style = 'width:' . $slides_max_width . 'px; height:' . $slides_max_height . 'px';
  } ?>
  <div class="<?php print $classes; ?>" style="<?php print $style; ?>">
    <?php foreach ($items as $num => $item) : ?>
      <div class="<?php print $item['classes']; ?>"<?php if ($num) : ?> style="display:none;"<?php endif; ?>>
        <?php print (empty($item['image']) ? render($item['rendered_entity']) : $item['image']); ?>
        <?php if (isset($item['caption']) && $item['caption'] != '') : ?>
          <div class="field-slideshow-caption">
            <span class="field-slideshow-caption-text"><?php print $item['caption']; ?></span>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <ul id="field-slideshow-<?php print $slideshow_id; ?>-controls" class="field-slideshow-controls pagination text-center" style="background-color: #c3c3c3;">
    <li><a href="#" class="prev">‹ <?php print t('Prev'); ?></a></li>
    <li><?php print(render($pager)); ?></li>
    <li><a href="#" class="next"><?php print t('Next'); ?> ›</a></li>
  </ul>
</div>
