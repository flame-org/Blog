<?php

namespace DoctrineSandbox\FrontModule;

/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	/**
	 * @autowire
	 * @var \DoctrineSandbox\FrontModule\Forms\Sign\ISignInFormFactory
	 */
	protected $signInFormFactory;

	public function startup()
	{
		parent::startup();

		if($this->getUser()->isLoggedIn()){
			$this->flashMessage('You are login yet.');
			$this->redirect('Homepage:');
		}
	}

	/**
	 * @return Forms\Sign\SignInForm
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->signInFormFactory->create();
		$form->onSuccess[] = $this->lazyLink('Homepage:');
		return $form;
	}

}
