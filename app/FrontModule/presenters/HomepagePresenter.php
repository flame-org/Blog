<?php

namespace Flame\Blog\FrontModule;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends FrontPresenter
{

	/**
	 * @var \Flame\Blog\Entity\Posts\Post
	 */
	private $post;

	/**
	 * @autowire
	 * @var \Flame\Blog\Components\Posts\IPostControlFactory
	 */
	protected $postControlFactory;

	/**
	 * @autowire
	 * @var \Flame\Blog\Entity\Posts\PostFacade
	 */
	protected $postFacade;

	public function actionPost($id = null)
	{
		$this->post = $this->postFacade->getOne($id);
	}

	/**
	 * @return \Flame\Blog\Components\Posts\PostControl
	 */
	protected function createComponentPost()
	{
		return $this->postControlFactory->create($this->post);
	}

}
