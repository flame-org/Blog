<?php

namespace Flame\Blog\FrontModule;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends FrontPresenter
{

	/**
	 * @autowire
	 * @var \Flame\Blog\Components\Posts\IPostControlFactory
	 */
	protected $postControlFactory;

	/**
	 * @return \Flame\Blog\Components\Posts\PostControl
	 */
	protected function createComponentPost()
	{
		return $this->postControlFactory->create();
	}

}
