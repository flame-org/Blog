<?php
/**
 * WpImportForm.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    17.02.13
 */

namespace Flame\Blog\PostModule\Components\Imports\WordPress\Forms;

class WpImportForm extends \Flame\Blog\AppModule\Application\UI\Form
{

	/** @var WpImportFormProcess */
	private $wpImportFormProcess;

	/**
	 * @param WpImportFormProcess $wpImportFormProcess
	 */
	public function injectWpImportFormProcess(WpImportFormProcess $wpImportFormProcess)
	{
		$this->wpImportFormProcess = $wpImportFormProcess;
	}

	public function __construct()
	{
		parent::__construct();

		$this->configure();
		$this->onSuccess[] = $this->formSubmitted;
	}

	/**
	 * @param WpImportForm $form
	 */
	public function formSubmitted(WpImportForm $form)
	{
		try {
			$this->wpImportFormProcess->import($form->getValues());
			$this->presenter->flashMessage('Imported', 'success');
		}catch (\Nette\InvalidArgumentException $ex){
			$form->addError($ex->getMessage());
		}
	}

	private  function configure()
	{
		$this->addUpload('file', 'XML file:')
			->addRule(self::FILLED);
		$this->addSubmit('send', 'Import data')
			->setAttribute('class', 'btn-primary');
	}

}
