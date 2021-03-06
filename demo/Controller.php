<?php
/**
 */

use TemplateEngine\TemplateEngine;

use Assets\Loader as AssetsLoader;

use Library\Helper\Html as HtmlHelper;
use Library\Helper\Url as UrlHelper;

class Controller
{

    public $loader;
    public $template_engine;
    static $default_page_layout = 'layouts/layout.html.php';

    public function __construct()
    {
        $this->loader = AssetsLoader::getInstance(__DIR__.'/..', 'www', __DIR__, AssetsLoader::PRESETS_NO_CONFLICT);
/*
echo '<pre>';
var_export($loader);
var_export($loader->getAssetsPath());
var_export($loader->getAssetsWebPath());
exit('yo');
*/

        $this->template_engine = TemplateEngine::getInstance(TemplateEngine::THROW_ALL_ERRORS);
        $this->template_engine
            ->setPageLayout(self::$default_page_layout)
            ->guessFromAssetsLoader($this->loader)
            ->setLayoutsDir(__DIR__.'/../www/')
            ->setToTemplate('setCachePath', __DIR__.'/tmp' )
            ->setToTemplate('setAssetsCachePath', __DIR__.'/tmp' )
            ->setToView('setIncludePath', __DIR__.'/views' )
            ;
    }

    /**
     * Distributes the application actions
     */
    public function distribute()
    {
        $action = isset($_GET['page']) ? $_GET['page'] : 'index';
        $action_meth = $action.'Action';
        if (method_exists($this, $action_meth)) {
            $return = $this->{$action_meth}();
        } else {
            $return = $this->commonAction($action);
        }
        if (!is_array($return)) {
            throw new Exception(
                sprintf("Action '%s' must return an array!", $action)
            );
        }
        return $this->display($return);
    }

    /**
     */
    public function display(array $params, $view = null)
    {
        // request params settings
        $params = array_merge(array(
            'merge_css' => isset($_GET['merge_css']) ? (bool) $_GET['merge_css'] : false,
            'minify_css' => isset($_GET['minify_css']) ? (bool) $_GET['minify_css'] : false,
            'merge_js' => isset($_GET['merge_js']) ? (bool) $_GET['merge_js'] : false,
            'minify_js' => isset($_GET['minify_js']) ? (bool) $_GET['minify_js'] : false,
        ), $params);

        if (!isset($params['content']) && isset($params['output'])) {
            $params['content'] = $params['output'];
        }

        $title = 'Test of the Template Engine';
        if (isset($params['title'])) {
            $title = $params['title'];
        }
        $this->template_engine
            ->templateFallback('getTemplateObject', array('TitleTag'))
            ->add( $title );

        $title_block = array(
            'title'=> isset($params['title']) ? $params['title'] : $title,
            'subheader'=>isset($params['subheader']) ? $params['subheader'] : "The Bootstrap & Font-Awesome libraries ready to use with the atelierspierrot/assets-manager",
            'slogan'=>isset($params['slogan']) ? $params['slogan'] : "<p>These pages show and demonstrate the use and functionality of the <a href=\"http://github.com/atelierspierrot/assets-bootstrapper\">atelierspierrot/assets-bootstrapper</a> PHP package you just downloaded.</p>"
        );
        $params['title'] = $title_block;

        if (empty($params['menu'])) {
            $params['menu'] = array(
                'Home'              => UrlHelper::url(array('page'=>'index')),
                'Theme'             => UrlHelper::url(array('page'=>'theme')),
                'Typographic tests' => UrlHelper::url(array('page'=>'loremipsum')),
                'Off canvas'        => UrlHelper::url(array('page'=>'offcanvas')),
            );
        }

        $params['footer'] = array('right'=>'A test of footer');

//var_export($params); exit('yo');

        // this will display the layout on screen and exit
        $this->template_engine->renderLayout($view, $params, true, true);
    }

// ------------------------
// Actions
// ------------------------


    function indexAction()
    {
        return array(
            'content'   =>'Hello, if you see colors and styles on screen, your assets are loaded ;)',
            'title'     =>'Home',
            'subheader' => '',
            'slogan'    => '',
        );        
    }

    function loremipsumAction()
    {
        return array(
            'output'=> $this->template_engine->render(
                'loremipsum.htm'
            ),
            'title' => "Test of HTML(5) tags"
        );
    }

    function commonAction($action)
    {
        return array(
            'output'=> $this->template_engine->render(
                $action.'.htm'
            ),
            'title' => ucfirst(Library\Helper\Text::getHumanReadable($action)),
            'public_sources' => false
        );
    }

}

// Endfile