<?php

namespace Flame\Blog\FrontModule;

/**
 * Base presenter for all application presenters.
 */
abstract class FrontPresenter extends \Flame\Application\UI\Presenter
{

	/**
	 * @autowire
	 * @var \Flame\Addons\FlashMessages\IFlashMessageControlFactory
	 */
	protected $flashMessageControlFactory;

	/**
	 * @autowire
	 * @var \Flame\Blog\SettingModule\Entity\Settings\SettingFacade
	 */
	protected $settingFacade;

	/**
	 * @return \Flame\Blog\UserModule\Security\User
	 */
	public function getUser()
	{
		return parent::getUser();
	}

	/**
	 * @return \Flame\Addons\FlashMessages\FlashMessageControl
	 */
	protected function createComponentFlashMessage()
	{
		return $this->flashMessageControlFactory->create();
	}

	protected function beforeRender()
	{
		$this->template->title = $this->settingFacade->getOneByName('projectDesc');
	}
}
