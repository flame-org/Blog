<?php

/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	/**
	 * @var \DoctrineSandbox\Forms\Sign\ISignInFormFactory $signInFormFactory
	 */
	private $signInFormFactory;

	/**
	 * @param \DoctrineSandbox\Forms\Sign\ISignInFormFactory $signInFormFactory
	 */
	public function injectSignInFormFactory(\DoctrineSandbox\Forms\Sign\ISignInFormFactory $signInFormFactory)
	{
		$this->signInFormFactory = $signInFormFactory;
	}

	public function startup()
	{
		parent::startup();

		if($this->getUser()->isLoggedIn()){
			$this->flashMessage('You are login yet.');
			$this->redirect('Homepage:');
		}
	}

	/**
	 * @return \DoctrineSandbox\Forms\Sign\SignInForm|\Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->signInFormFactory->create();
		$form->onSuccess[] = $this->lazyLink('Homepage:');
		return $form;
	}

}
