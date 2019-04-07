<?php
namespace App\Library\Core\MVC;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Yaf\View_Interface;

class TemplateAdapter implements View_Interface
{
    protected $loader;

    protected $twig;

    protected $variables = [];

    public function __construct($templateDir, $options = [])
    {
        $this->loader = new FilesystemLoader($templateDir);
        $this->twig = new Environment($this->loader, $options);
    }

    /**
     * Assign values to View engine, then the value can access directly by name in template.
     *
     * @link http://www.php.net/manual/en/yaf-view-interface.assign.php
     *
     * @param string|array $name
     * @param mixed $value
     * @return bool
     */
    function assign($name, $value = null)
    {
        $this->variables[$name] = $value;
    }

    /**
     * Render a template and output the result immediately.
     *
     * @link http://www.php.net/manual/en/yaf-view-interface.display.php
     *
     * @param string $tpl
     * @param $tpl_vars
     * @return bool
     */
    function display($tpl, $tpl_vars = null)
    {
        echo $this->render($tpl, $tpl_vars);
    }

    /**
     * @link http://www.php.net/manual/en/yaf-view-interface.getscriptpath.php
     *
     * @return string
     */
    function getScriptPath()
    {
        return $this->loader->getPaths();
    }

    /**
     * Render a template and return the result.
     *
     * @link http://www.php.net/manual/en/yaf-view-interface.render.php
     *
     * @param string $tpl
     * @param $tpl_vars
     * @return string
     */
    function render($tpl, $tpl_vars = null)
    {
        if (is_array($tpl_vars)) {
            $this->variables = array_merge($this->variables, $tpl_vars);
        }

        return $this->twig->loadTemplate($tpl)->render($this->variables);
    }

    /**
     * Set the templates base directory, this is usually called by \Yaf\Dispatcher
     *
     * @link http://www.php.net/manual/en/yaf-view-interface.setscriptpath.php
     *
     * @param string $template_dir An absolute path to the template directory, by default, \Yaf\Dispatcher use application.directory . "/views" as this parameter.
     */
    function setScriptPath($template_dir)
    {
        $this->loader->setPaths($template_dir);
    }

}
