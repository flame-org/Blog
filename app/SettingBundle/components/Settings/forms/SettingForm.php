<?php
/**
 * SettingForm.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\SettingBundle\Components\Settings\Forms;

use Flame\Blog\SettingBundle\Entity\Settings\Setting;

class SettingForm extends \Flame\Blog\AppBundle\Application\UI\Form
{

	/** @var \Flame\Blog\SettingBundle\Model\Settings\SettingManager */
	private $settingManager;

	/**
	 * @param \Flame\Blog\SettingBundle\Model\Settings\SettingManager $settingManager
	 */
	public function injectSettingManager(\Flame\Blog\SettingBundle\Model\Settings\SettingManager $settingManager)
	{
		$this->settingManager = $settingManager;
	}

	/**
	 * @param array $availableSettings
	 * @param array $default
	 */
	public function __construct(array $availableSettings, array $default = array())
	{
		parent::__construct();

		$this->configure($availableSettings);
		$this->setDefaults($default);
		$this->onSuccess[] = $this->formSubmitted;
	}

	/**
	 * @param SettingForm $form
	 */
	public function formSubmitted(SettingForm $form)
	{
		try {
			$this->settingManager->update($form->getValues());
			$this->presenter->flashMessage('Done', 'success');
		}catch (\Nette\InvalidArgumentException $ex){
			$form->addError($ex->getMessage());
		}

	}

	/**
	 * @param array $availableSettings
	 */
	private function configure(array $availableSettings)
	{
		if(count($availableSettings)){
			foreach($availableSettings as $name => $type){
				if($type == Setting::BOOL){
					$this->addCheckbox($name, $name);
				}elseif($type == Setting::TEXT){
					$this->addTextArea($name, $name);
				}elseif($type == Setting::STRING){
					$this->addText($name, $name, 60, 255);
				}
			}

			$this->addSubmit('send', 'Update settings')
				->setAttribute('class', 'btn-primary');
		}else{
			$this->addError('Any avaiable settings');
		}
	}

}
