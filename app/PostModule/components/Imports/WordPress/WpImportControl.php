<?php
/**
 * WpImporterControl.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    17.02.13
 */

namespace Flame\Blog\PostModule\Components\Imports\WordPress;

class WpImportControl extends \Flame\Application\UI\Control
{

	/** @var \Flame\Blog\PostModule\Components\Imports\WordPress\Forms\IWpImportFormFactory */
	private $wpImportFormFactory;

	/**
	 * @param \Flame\Blog\PostModule\Components\Imports\WordPress\Forms\IWpImportFormFactory $wpImportFormFactory
	 */
	public function injectWpImportFormFactory(\Flame\Blog\PostModule\Components\Imports\WordPress\Forms\IWpImportFormFactory $wpImportFormFactory)
	{
		$this->wpImportFormFactory = $wpImportFormFactory;
	}

	/**
	 * @return Forms\WpImportForm
	 */
	protected function createComponentWpImportForm()
	{
		$form = $this->wpImportFormFactory->create();
		$form->onSuccess[] = $this->presenter->lazyLink('this');
		return $form;
	}

}
