<?php

namespace Flame\Blog\FrontModule;

/**
 * Sign in/out presenters.
 */
class SignPresenter extends FrontPresenter
{

	/**
	 * @autowire
	 * @var \Flame\Blog\FrontModule\Forms\Sign\ISignInFormFactory
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
		$form->onSuccess[] = $this->lazyLink(':Back:Post:');
		return $form;
	}

}
