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

	/** @var \Flame\Blog\Security\User */
	private $user;

	/**
	 * @param \Flame\Blog\Security\User $user
	 */
	public function injectUser(\Flame\Blog\Security\User $user)
	{
		$this->user = $user;
	}

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

	public function beforeRender()
	{
		$this->template->posts = $this->postFacade->getLast();
	}

	public function renderUpdate()
	{
		$this->template->setFile(__DIR__ . '/PostControlUpdate.latte')->render();
	}

	public function renderAdmin()
	{
		$this->template->posts = $this->postFacade->getLast();
		$this->template->setFile(__DIR__ . '/PostControlAdmin.latte')->render();
	}

	public function renderDetail()
	{
		if(!$this->post){
			$this->template->setFile(__DIR__ . '/PostControlNotFound.latte')->render();
		}else{
			$this->template->post = $this->post;
			$this->template->setFile(__DIR__ . '/PostControlDetail.latte')->render();
		}

	}

	/**
	 * @param null $id
	 */
	public function handleDelete($id = null)
	{
		if($this->user->isLoggedIn()){
			if($post = $this->postFacade->getOne($id)){
				$this->postFacade->delete($post);
			}else{
				$this->presenter->flashMessage('Post does not exist', 'error');
			}
		}else{
			$this->presenter->flashMessage('Access denied');
		}

		if($this->presenter->isAjax()){
			$this->invalidateControl('posts');
		}else{
			$this->redirect('this');
		}
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
