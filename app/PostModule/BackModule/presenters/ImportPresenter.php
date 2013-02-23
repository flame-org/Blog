<?php
/**
 * ImportPresenter.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    17.02.13
 */

namespace Flame\Blog\BackModule;

class ImportPresenter extends BackPresenter
{

	/**
	 * @autowire
	 * @var \Flame\Blog\PostModule\Components\Imports\WordPress\IWpImportControlFactory
	 */
	protected $wpImportControlFactory;

	/**
	 * @return \Flame\Blog\PostModule\Components\Imports\WordPress\WpImportControl
	 */
	protected function createComponentWpImport()
	{
		return $this->wpImportControlFactory->create();
	}

}
