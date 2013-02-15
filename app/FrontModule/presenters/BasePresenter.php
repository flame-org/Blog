<?php

namespace DoctrineSandbox\FrontModule;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Flame\Application\UI\Presenter
{

	/**
	 * @autowire
	 * @var \Flame\Addons\FlashMessages\IFlashMessageControlFactory
	 */
	protected $flashMessageControlFactory;

	/**
	 * @return \DoctrineSandbox\Security\User
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
}
