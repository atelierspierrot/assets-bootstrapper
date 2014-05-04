<?php

// --------------------------------
// the css
$_template->getTemplateObject('CssTag')->set(array(
    "
/* Sidebar modules for boxing content */
aside {
    width: 30%;
    margin: 15px;
    padding: 15px;
    background-color: #f5f5f5;
    border-radius: 4px;
}
aside p:last-child,
aside ul:last-child,
aside ol:last-child {
    margin-bottom: 0;
}
    "
));

// --------------------------------
// the content
if (empty($content)) $content = '<p>Test content</p>';

if (!isset($public_sources)) $public_sources = true;
$url_sources = "http://github.com/atelierspierrot/templatengine";
$host_sources_name = "GitHub";
$host_sources_home = "http://github.com/";

?>

<?php if ($public_sources) : ?>
<aside class="pull-right">
    <div class="info">
        <p><span class="fa fa-github"></span>&nbsp;<a href="<?php echo $url_sources; ?>">See online on <?php echo $host_sources_name; ?></a></p>
        <p class="comment small">The sources of this package are hosted on <a href="<?php echo $host_sources_home; ?>"><?php echo $host_sources_name; ?></a>. To follow sources updates, report a bug or read opened bug tickets and any other information, please see the link above.</p>
    </div>
    <p class="credits" id="user_agent"></p>
</aside>
<?php endif; ?>

<?php echo $content; ?>

