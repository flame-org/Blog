<?php
/**
 * PostControl.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\Components\Posts;

class PostControl extends \Flame\Application\UI\Control
{

	/** @var \Flame\Blog\Entity\Posts\Post */
	private $post;

	/** @var \Flame\Blog\Components\Posts\Forms\IPostFormFactory */
	private $postFormFactory;

	/** @var \Flame\Blog\Entity\Posts\PostFacade */
	private $postFacade;

	/**
	 * @param \Flame\Blog\Entity\Posts\PostFacade $postFacade
	 */
	public function injectPostFacade(\Flame\Blog\Entity\Posts\PostFacade $postFacade)
	{
		$this->postFacade = $postFacade;
	}

	/**
	 * @param \Flame\Blog\Components\Posts\Forms\IPostFormFactory $postFormFactory
	 */
	public function injectPostFormFactory(\Flame\Blog\Components\Posts\Forms\IPostFormFactory $postFormFactory)
	{
		$this->postFormFactory = $postFormFactory;
	}

	/**
	 * @param \Flame\Blog\Entity\Posts\Post $post
	 */
	public function __construct(\Flame\Blog\Entity\Posts\Post $post = null)
	{
		$this->post = $post;
	}

	public function renderUpdate()
	{
		$this->template->setFile(__DIR__ . '/PostControlUpdate.latte')->render();
	}

	public function beforeRender()
	{
		$this->template->posts = $this->postFacade->getLast();
	}

	/**
	 * @return Forms\PostForm
	 */
	protected function createComponentPostForm()
	{
		$defaults = array();
		if($this->post instanceof \Flame\Blog\Entity\Posts\Post)
			$defaults = $this->post->toArray();

		$form = $this->postFormFactory->create($defaults);
		$form->onSuccess[] = $this->presenter->lazyLink('Post:');
		return $form;
	}

}
