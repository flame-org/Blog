<?php
/**
 * PostControl.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\PostModule\Components\Posts;

class PostControl extends \Flame\Application\UI\Control
{

	/** @var int */
	private $itemsPerPage = 10;

	/** @var \Flame\Blog\PostModule\Entity\Posts\Post */
	private $post;

	/** @var \Flame\Blog\PostModule\Components\Posts\Forms\IPostFormFactory */
	private $postFormFactory;

	/** @var \Flame\Blog\PostModule\Entity\Posts\PostFacade */
	private $postFacade;

	/** @var \Flame\Blog\UserModule\Security\User */
	private $user;

	/** @var \Flame\Addons\VisualPaginator\IPaginatorFactory */
	private $paginatorFactory;

	/** @var \Flame\Blog\SettingModule\Entity\Settings\SettingFacade */
	private $settingFacade;

	/**
	 * @param \Flame\Blog\SettingModule\Entity\Settings\SettingFacade $settingFacade
	 */
	public function injectSettingFacade(\Flame\Blog\SettingModule\Entity\Settings\SettingFacade $settingFacade)
	{
		$this->settingFacade = $settingFacade;
	}

	/**
	 * @param \Flame\Addons\VisualPaginator\IPaginatorFactory $paginatorFactory
	 */
	public function injectPaginatorFactory(\Flame\Addons\VisualPaginator\IPaginatorFactory $paginatorFactory)
	{
		$this->paginatorFactory = $paginatorFactory;
	}

	/**
	 * @param \Flame\Blog\UserModule\Security\User $user
	 */
	public function injectUser(\Flame\Blog\UserModule\Security\User $user)
	{
		$this->user = $user;
	}

	/**
	 * @param \Flame\Blog\PostModule\Entity\Posts\PostFacade $postFacade
	 */
	public function injectPostFacade(\Flame\Blog\PostModule\Entity\Posts\PostFacade $postFacade)
	{
		$this->postFacade = $postFacade;
	}

	/**
	 * @param \Flame\Blog\PostModule\Components\Posts\Forms\IPostFormFactory $postFormFactory
	 */
	public function injectPostFormFactory(\Flame\Blog\PostModule\Components\Posts\Forms\IPostFormFactory $postFormFactory)
	{
		$this->postFormFactory = $postFormFactory;
	}

	/**
	 * @param \Flame\Blog\PostModule\Entity\Posts\Post $post
	 */
	public function __construct(\Flame\Blog\PostModule\Entity\Posts\Post $post = null)
	{
		$this->post = $post;
	}

	public function render()
	{

		if($setting = $this->settingFacade->getSettingValue('itemsPerPage'))
			$this->itemsPerPage = $setting;

		$posts = $this->postFacade->getLastPublic();
		$paginator = $this['paginator']->getPaginator();
		$paginator->itemsPerPage = $this->itemsPerPage;
		$paginator->itemCount = count($posts);

		if(is_array($posts) and count($posts))
			$posts = $this->getItemsPerPage($posts, $paginator->offset);

		$this->template->posts = $posts;

		$this->template->setFile(__DIR__ . '/templates/default.latte')->render();
	}

	public function renderUpdate()
	{
		$this->template->setFile(__DIR__ . '/templates/update.latte')->render();
	}

	public function renderAdmin()
	{
		$posts = $this->postFacade->getLast();

		$paginator = $this['paginator']->getPaginator();
		$paginator->itemsPerPage = $this->itemsPerPage;
		$paginator->itemCount = count($posts);

		if(is_array($posts) and count($posts))
			$posts = $this->getItemsPerPage($posts, $paginator->offset);

		$this->template->posts = $posts;

		$this->template->setFile(__DIR__ . '/templates/admin.latte')->render();
	}

	public function renderDetail()
	{
		if(!$this->post){
			$this->template->setFile(__DIR__ . '/templates/notFound.latte')->render();
		}else{
			$this->template->post = $this->post;
			$this->template->setFile(__DIR__ . '/templates/detail.latte')->render();
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

		$this->redirect('this');
	}

	/**
	 * @return Forms\PostForm
	 */
	protected function createComponentPostForm()
	{
		$defaults = array();
		if($this->post instanceof \Flame\Blog\PostModule\Entity\Posts\Post)
			$defaults = $this->post->toArray();

		$form = $this->postFormFactory->create($defaults);
		$form->onSuccess[] = $this->presenter->lazyLink('Post:');
		return $form;
	}

	/**
	 * @return \Flame\Addons\VisualPaginator\Paginator
	 */
	protected function createComponentPaginator()
	{
		return $this->paginatorFactory->create();
	}

	/**
	 * @param $posts
	 * @param $offset
	 * @return array
	 */
	private function getItemsPerPage(array &$posts, $offset)
	{
		return array_slice($posts, $offset, $this->itemsPerPage);
	}

}
