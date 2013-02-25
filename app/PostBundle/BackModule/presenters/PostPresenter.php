<?php
/**
 * PostPresenter.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\BackModule;

class PostPresenter extends BackPresenter
{

	/**
	 * @var \Flame\Blog\PostBundle\Entity\Posts\Post
	 */
	private $post;

	/**
	 * @autowire
	 * @var \Flame\Blog\PostBundle\Components\Posts\IPostControlFactory
	 */
	protected $postControlFactory;

	/**
	 * @autowire
	 * @var \Flame\Blog\PostBundle\Entity\Posts\PostFacade
	 */
	protected $postFacade;

	/**
	 * @return \Flame\Blog\PostBundle\Components\Posts\PostControl
	 */
	protected function createComponentPost()
	{
		return $this->postControlFactory->create($this->post);
	}

	/**
	 * @param null $id
	 */
	public function actionUpdate($id = null)
	{
		$this->post = $this->postFacade->getOne($id);
	}

	/**
	 * @param null $id
	 */
	public function actionDetail($id = null)
	{
		$this->post = $this->postFacade->getOne($id);
		if($this->post)
			$this->flashMessage('Temporary post preview');
	}

}
