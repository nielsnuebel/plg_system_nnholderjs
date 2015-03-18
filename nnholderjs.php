<?php
/**
 * @version 1.0.0
 * @package NNHolderjs
 * @copyright 2015 Niels Nübel
 * @license This software is licensed under the MIT license: http://opensource.org/licenses/MIT
 * @link http://www.niels-nuebel.de
 */

defined('_JEXEC') or die;

/**
 * Plugin class for Login only with Username
 *
 * @since  3.1
 */
class plgSystemNNHolderjs extends JPlugin
{
	protected $app;

	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);

		$this->loadLanguage();
	}

	public function onAfterRender()
	{
		if ($this->app->isSite())
		{
			$file = 'default.php';

			@ob_start();
			$overridePath = FOFPlatform::getInstance()->getTemplateOverridePath('plg_system_nnholderjs', true);

			JLoader::import('joomla.filesystem.file');

			if (JFile::exists($overridePath . '/' . $file))
			{
				include_once $overridePath . '/' . $file;
			}
			else
			{
				include_once __DIR__ . '/tmpl/' . $file;
			}

			$html = @ob_get_clean();

			$body = $this->app->getBody();
			$body = str_replace('</body>', $html . '</body>', $body);
			$this->app->setBody($body);
		}
	}
}
