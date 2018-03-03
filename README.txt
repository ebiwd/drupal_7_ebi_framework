ABOUT
----------------------------------
This Drupal theme integrate the Foundation Framework v1.2 for Drupal 7.

That theme implementation has been paired down, removing some features that are uneeded for EMBL-EBI sites and has been updated to use Foundation 6.

Originally forked on: 2016-01-08

USING THIS THEME
----------------------------------
Do not edit this theme directly, but create a Drupal sub theme: https://www.drupal.org/node/225125

- You can load path-specific custom CSS in the theme settings under "Styles and Scripts"
- If you need compatibility with the old compliance theme, load the /EBI-Framework/css/compliance-legacy-compatibility.css on any needed pages

MODULES
-------
- To use the Foundation JS, you'll need jQuery Update
- For responsive blocks, install the block_class module (no need to modifyl block.tpl.php) and add your CSS grid classes (medium-4, small-10, etc.) in the block admin page


TINYMCE
-------
To integrate this theme with TinyMCE, configure your editor profile in Drupal by:
1) Under "Editor CSS" select "Define CSS"
2) Under "CSS path", use: https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/css/ebi-global.css, https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/libraries/foundation-6/css/foundation.css, https://ebi.emblstatic.net/web_guidelines/EBI-Framework/v1.2/css/ebi-global-drupal.css