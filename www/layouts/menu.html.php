<?php

use Library\Helper\Html as HtmlHelper;

// --------------------------------
// the css
$_template->getTemplateObject('CssTag')->set(array(
    "
body { margin-top: 30px; }
    "
));

// --------------------------------
// the content
if (empty($content)) $content = '<p>Test content</p>';

$make_navigation_list_from_content = function(array $ctt, array $attrs)
{
    $str = '';
    foreach ($ctt as $var=>$val) {
        if (is_array($val)) {
            $str .= '<li><a href="#">'.$var.'</a>'
                .$make_navigation_list_from_content($val)
                .'</li>';
        } else {
            $str .= '<li><a href="'.$val.'">'.$var.'</a></li>';
        }
    }
    
    return '<ul'.(!empty($attrs) ? HtmlHelper::parseAttributes($attrs) : '').'>'.$str.'</ul>';
}

?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="collapse navbar-collapse">
<?php if (is_array($content)) : ?>
    <?php echo $make_navigation_list_from_content($content, array(
        'id'=>"navigation_menu", 'class'=>"nav navbar-nav",
    )); ?>
<?php else : ?>
    <?php echo $content; ?>
<?php endif; ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#bottom" title="Go to the bottom of the page"><span class="text">Go to bottom&nbsp;</span>&darr;</a></li>
                <li><a href="#top" title="Back to the top of the page"><span class="text">Back to top&nbsp;</span>&uarr;</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

