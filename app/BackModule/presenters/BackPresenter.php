<?php
/**
 * BackPresenter.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\BackModule;

abstract class BackPresenter extends \Flame\Application\UI\SecuredPresenter
{

	/**
	 * @autowire
	 * @var \Flame\Addons\FlashMessages\IFlashMessageControlFactory
	 */
	protected $flashMessageControlFactory;

	/**
	 * @return \Flame\Addons\FlashMessages\FlashMessageControl
	 */
	protected function createComponentFlashMessage()
	{
		return $this->flashMessageControlFactory->create();
	}

}
