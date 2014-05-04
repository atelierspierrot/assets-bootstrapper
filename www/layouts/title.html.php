<?php

use Library\Helper\Html as HtmlHelper;

// --------------------------------
// the content
if (empty($content)) $content = 'Test title';
if (!is_array($content)) $content = array($content);

?>
<header role="banner" class="page-header">
        <h1>
            <?php echo isset($content['title']) ? $content['title'] : $content[0]; ?>
            <?php if (isset($content['subheader'])) : ?>
                <small><?php echo $content['subheader']; ?></small>
            <?php endif; ?>
        </h1>
    <?php if (isset($content['slogan'])) : ?>
        <div class="hat"><?php echo $content['slogan']; ?></div>
    <?php endif; ?>
</header>
