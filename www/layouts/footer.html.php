<?php

use Library\Helper\Html as HtmlHelper;

// --------------------------------
// the css
$_template->getTemplateObject('CssTag')->set(array(
    "
/* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
#footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}
    "
));

// --------------------------------
// the content
if (empty($content)) $content = 'Test footer';
if (!is_array($content)) $content = array($content);

?>
<footer id="<?php _getid('footer'); ?>">
    <div class="container">
        <div class="text-muted pull-left">
            This page is <a href="" title="Check now online" id="html_validation">HTML5</a> & <a href="" title="Check now online" id="css_validation">CSS3</a> valid.
            <br />
            <?php echo isset($content['left']) ? $content['left'] : array_shift($content); ?>
        </div>
        <?php if (isset($content['right'])) : ?>
        <div class="text-muted pull-right">
            <?php echo $content['right']; ?>
        </div>
        <?php endif; ?>
    </div>
</footer>