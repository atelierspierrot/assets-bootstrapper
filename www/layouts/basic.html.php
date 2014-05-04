<?php

//_use('jquery');
//_use('jquery-cdn');
//_use('font-awesome');
_use('bootstrap');

if (!isset($merge_css)) $merge_css = false;
if (!isset($minify_css)) $minify_css = false;
if (!isset($merge_js)) $merge_js = false;
if (!isset($minify_js)) $minify_js = false;

// --------------------------------
// the "classic" assets web accessible directory
if (empty($assets)) {
    $assets = $_template->getAssetsLoader()->getAssetsWebPath();
    //trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__.'/../'), '/');
}
if (strlen($assets)) {
    $assets = rtrim($assets, '/').'/';
}

// --------------------------------
// METAS
$old_metas = $_template->getTemplateObject('MetaTag')->get();
$_template->getTemplateObject('MetaTag')->reset();

// => charset and others
$_template->getTemplateObject('MetaTag')
	->add('charset', 'utf-8')
	->add('X-UA-Compatible', 'IE=edge,chrome=1', true, 'IE')
	->add('viewport', 'width=device-width, initial-scale=1');

// => description
if (!empty($meta_description)) {
	$_template->getTemplateObject('MetaTag')
		->add('description', $meta_description);
}

// => keywords
if (!empty($meta_keywords)) {
	$_template->getTemplateObject('MetaTag')
		->add('keywords', $meta_keywords);
}

// => author
if (!empty($author)) {
	$_template->getTemplateObject('MetaTag')
		->add('author', $author);
}

// => generator
if (!empty($app_name) && !empty($app_version)) {
	$_template->getTemplateObject('MetaTag')
		->add('generator', $app_name.(!empty($app_version) ? ' '.$app_version : ''));
}

// => + old ones
$_template->getTemplateObject('MetaTag')->set($old_metas);

// ------------------
// LINKS
$old_links = $_template->getTemplateObject('LinkTag')->get();
$_template->getTemplateObject('LinkTag')->reset();

// => favicon.ico
if (file_exists($assets.'icons/favicon.ico')) {
	$_template->getTemplateObject('LinkTag')
		->add( array(
			'rel'=>'icon',
			'href'=>$assets.'icons/favicon.ico',
			'type'=>'image/x-icon'
		) )
		->add( array(
			'rel'=>'shortcut icon',
			'href'=>$assets.'icons/favicon.ico',
			'type'=>'image/x-icon'
		) );
}

// the followings are taken from <http://mathiasbynens.be/notes/touch-icons>
// => For third-generation iPad with high-resolution Retina display: apple-touch-icon-144x144-precomposed.png
if (file_exists($assets.'icons/apple-touch-icon-144x144-precomposed.png')) {
	$_template->getTemplateObject('LinkTag')
		->add( array(
			'rel'=>'apple-touch-icon-precomposed',
			'href'=>$assets.'icons/apple-touch-icon-144x144-precomposed.png',
			'sizes'=>'144x144'
		) );
}
// => For iPhone with high-resolution Retina display: apple-touch-icon-114x114-precomposed.png
if (file_exists($assets.'icons/apple-touch-icon-114x114-precomposed.png')) {
	$_template->getTemplateObject('LinkTag')
		->add( array(
			'rel'=>'apple-touch-icon-precomposed',
			'href'=>$assets.'icons/apple-touch-icon-114x114-precomposed.png',
			'sizes'=>'114x114'
		) );
}
// => For first- and second-generation iPad: apple-touch-icon-72x72-precomposed.png
if (file_exists($assets.'icons/apple-touch-icon-72x72-precomposed.png')) {
	$_template->getTemplateObject('LinkTag')
		->add( array(
			'rel'=>'apple-touch-icon-precomposed',
			'href'=>$assets.'icons/apple-touch-icon-72x72-precomposed.png',
			'sizes'=>'72x72'
		) );
}
// => For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: apple-touch-icon-precomposed.png
if (file_exists($assets.'icons/apple-touch-icon-precomposed.png')) {
	$_template->getTemplateObject('LinkTag')
		->add( array(
			'rel'=>'apple-touch-icon-precomposed',
			'href'=>$assets.'icons/apple-touch-icon-precomposed.png'
		) );
}

// => + old ones
$_template->getTemplateObject('LinkTag')->set($old_links);

// ------------------
// TITLE
$old_titles = $_template->getTemplateObject('TitleTag')->get();
$_template->getTemplateObject('TitleTag')->reset();

// => $title
if (!empty($title)) {
	$_template->getTemplateObject('TitleTag')
		->add( $title );
}
// => + old ones
$_template->getTemplateObject('TitleTag')->set($old_titles);
// => meta_title last
if (!empty($meta_title)) {
	$_template->getTemplateObject('TitleTag')
		->add( $meta_title );
}

// --------------------------------
// the content
if (empty($content)) $content = '<p>Test content</p>';

//echo '<pre>';var_dump($_template->getTemplateObject('CssFile'));exit('yo');
//echo '<pre>';var_dump($_template);exit('yo');

?><!DOCTYPE html>
<html lang="en">
<head>
<?php
echo
	$_template->getTemplateObject('MetaTag')->write("\n\t\t %s "),
	$_template->getTemplateObject('TitleTag')->write("\n\t\t %s "),
	$_template->getTemplateObject('LinkTag')->write("\n\t\t %s ");

if (true===$minify_css)
	echo $_template->getTemplateObject('CssFile')->minify()->writeMinified("\n\t\t %s ");
elseif (true===$merge_css)
	echo $_template->getTemplateObject('CssFile')->merge()->writeMerged("\n\t\t %s ");
else
	echo $_template->getTemplateObject('CssFile')->write("\n\t\t %s ");

if (true===$minify_js)
	echo $_template->getTemplateObject('JavascriptFile', 'jsfiles_header')->minify()->writeMinified("\n\t\t %s ");
elseif (true===$merge_js)
	echo $_template->getTemplateObject('JavascriptFile', 'jsfiles_header')->merge()->writeMerged("\n\t\t %s ");
else
	echo $_template->getTemplateObject('JavascriptFile', 'jsfiles_header')->write("\n\t\t %s ");

_echo("\n");
?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<a id="top"></a>
<a href="#content" class="sr-only">Skip to main content</a>

<?php foreach($_template->getPageStructure() as $item) : ?>
    <?php if (isset($$item) && $item==='menu') : ?>

        <?php
            $item_layout = $item.'.html.php';
            $item_template = $_template->getTemplate($item_layout);
            if (empty($item_template)) {
                $item_template = $_template->getTemplate('layouts/'.$item_layout);
            }

            if (!empty($item_template)) :
                _render($item_template, array(
                    'content'=>$$item
                ));
            else :
        ?>
        <div id="<?php _getid($item); ?>" class="structure-<?php echo $item; ?>">

            <?php if (is_array($$item)) : ?>
            <ul>
                <?php foreach($$item as $var=>$val) : ?>
                <li><a href="<?php echo $var; ?>"><?php echo $val; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php else : ?>
                <?php echo $$item; ?>
            <?php endif; ?>

        </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>

<div class="container" id="content">
<?php foreach($_template->getPageStructure() as $item) : ?>
    <?php if (isset($$item) && !in_array($item, array('menu','footer'))) : ?>

        <?php
            $item_layout = $item.'.html.php';
            $item_template = $_template->getTemplate($item_layout);
            if (empty($item_template)) {
                $item_template = $_template->getTemplate('layouts/'.$item_layout);
            }

            if (!empty($item_template)) :
                _render($item_template, array(
                    'content'=>$$item
                ));
            else :
        ?>
        <div id="<?php _getid($item); ?>" class="structure-<?php echo $item; ?>">

            <?php if (is_array($$item)) : ?>
            <ul>
                <?php foreach($$item as $var=>$val) : ?>
                <li><a href="<?php echo $var; ?>"><?php echo $val; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php else : ?>
                <?php echo $$item; ?>
            <?php endif; ?>

        </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
</div>

<?php foreach($_template->getPageStructure() as $item) : ?>
    <?php if (isset($$item) && $item==='footer') : ?>

        <?php
            $item_layout = $item.'.html.php';
            $item_template = $_template->getTemplate($item_layout);
            if (empty($item_template)) {
                $item_template = $_template->getTemplate('layouts/'.$item_layout);
            }

            if (!empty($item_template)) :
                _render($item_template, array(
                    'content'=>$$item
                ));
            else :
        ?>
        <div id="<?php _getid($item); ?>" class="structure-<?php echo $item; ?>">

            <?php if (is_array($$item)) : ?>
            <ul>
                <?php foreach($$item as $var=>$val) : ?>
                <li><a href="<?php echo $var; ?>"><?php echo $val; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php else : ?>
                <?php echo $$item; ?>
            <?php endif; ?>

        </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>

<?php
if (true===$minify_js)
	echo $_template->getTemplateObject('JavascriptFile', 'jsfiles_footer')->minify()->writeMinified("\n\t %s ");
elseif (true===$merge_js)
	echo $_template->getTemplateObject('JavascriptFile', 'jsfiles_footer')->merge()->writeMerged("\n\t\t %s ");
else
	echo $_template->getTemplateObject('JavascriptFile', 'jsfiles_footer')->write("\n\t %s ");

echo
	$_template->getTemplateObject('JavascriptTag')->write("%s"),
	$_template->getTemplateObject('CssTag')->write("%s"),
	"\n";
?>
<a id="bottom"></a>
</body>
</html>
