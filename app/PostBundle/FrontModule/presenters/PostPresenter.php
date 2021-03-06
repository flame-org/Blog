<?php
/**
 * PostPresenter.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\FrontModule;

use Flame\Utils\Strings;

class PostPresenter extends FrontPresenter
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
	 * @param null $id
	 * @param null $slug
	 */
	public function actionDetail($id = null, $slug = null)
	{
		if($this->post = $this->postFacade->getOnePublic($id)){
			$this->protectPostDuplicity($slug, $this->post);
			$this->postFacade->increaseViews($this->post);
		}
	}

	public function renderDetail()
	{
		if($this->post) $this->template->title = $this->post->getTitle();
	}

	/**
	 * @return \Flame\Blog\PostBundle\Components\Posts\PostControl
	 */
	protected function createComponentPost()
	{
		return $this->postControlFactory->create($this->post);
	}

	private function protectPostDuplicity($slug, \Flame\Blog\PostBundle\Entity\Posts\Post $post)
	{
		if($slug != Strings::webalize($post->getTitle())){
			$this->redirect('this', array('id' => $post->getId(), 'slug' => Strings::webalize($post->getTitle())));
		}
	}
}
