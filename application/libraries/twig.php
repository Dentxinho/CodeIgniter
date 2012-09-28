<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Twig
{

	const TWIG_CONFIG_FILE = "twig";

	protected $_template_dir;
	protected $_cache_dir;

	private $_CI;
	private $_twig_env;

	/**
	 * Constructor
	 *
	 */
	function __construct($debug = FALSE)
	{
		$this->_CI =& get_instance();
		$this->_CI->config->load(self::TWIG_CONFIG_FILE);

		// set include path for twig
		ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'libraries/twig/lib/Twig/');
		require_once (string) "Autoloader" . EXT;

		// register autoloader
		log_message('debug', "Twig Autoloader Loaded");
		Twig_Autoloader::register();

		// init paths
		$this->_template_dir = $this->_CI->config->item('template_dir');
		$this->_cache_dir = $this->_CI->config->item('cache_dir');

		// load environment
		$loader = new Twig_Loader_Filesystem($this->_template_dir);

		$this->_twig_env = new Twig_Environment($loader, array('cache' => $this->_cache_dir,
															   'autoescape' => FALSE,
															   'debug' => $debug,));

		if ($debug)
		{
			$this->_twig_env->addExtension(new Twig_Extension_Debug());
		}

		$this->_twig_env->registerUndefinedFunctionCallback(function($name) {
			return new Twig_Function_Function($name);
		});

		$this->add_global('CI', $this->_CI);
	}

    public function add_global($name, $obj)
    {
        $this->_twig_env->addGlobal($name, $obj);
    }

	public function add_function($name, $is_safe=FALSE)
	{
        if($is_safe)
        {
            $this->_twig_env->addFunction($name, new Twig_Function_Function($name, array('is_safe' => array('html'))));
        }
        else
        {
            $this->_twig_env->addFunction($name, new Twig_Function_Function($name));
        }
	}

	public function render($template, $data = array())
	{
		$template = $this->_twig_env->loadTemplate($template);
		return $template->render($data);
	}

	public function display($template, $data = array())
	{
		$template = $this->_twig_env->loadTemplate($template);
		/* elapsed_time and memory_usage */
		if (ENVIRONMENT == 'development')
		{
			$data['elapsed_time'] = $this->_CI->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end');
			$memory = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2) . 'MB';
			$data['memory_usage'] = $memory;
		}

		$template->display($data);
	}

}