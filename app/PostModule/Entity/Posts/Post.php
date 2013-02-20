<?php
/**
 * Post.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\Entity\Posts;

use DateTime;

/**
 * @Entity(repositoryClass="\Flame\Doctrine\Model\Repository")
 */
class Post extends \Flame\Doctrine\Entity
{

	/**
	 * @Column(type="string", length=255)
	 */
	protected $title;

	/**
	 * @Column(type="text")
	 */
	protected $content;

	/**
	 * @Column(type="datetime")
	 */
	protected $date;

	/**
	 * @Column(type="integer", length=5)
	 */
	protected $views;

	/**
	 * @Column(type="boolean")
	 */
	protected $public;

	public function __construct($title, $content)
	{
		$this->title = (string) $title;
		$this->content = (string) $content;

		$this->date = new DateTime;
		$this->views = 0;
		$this->public = true;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = (string) $title;
		return $this;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setContent($content)
	{
		$this->content = (string) $content;
		return $this;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function setDate(DateTime $date)
	{
		$this->date = $date;
		return $this;
	}

	public function getViews()
	{
		return $this->views;
	}

	public function setViews($views)
	{
		$this->views = (int) $views;
		return $this;
	}

	public function getPublic()
	{
		return $this->public;
	}

	public function setPublic($public)
	{
		$this->public = (bool) $public;
		return $this;
	}

}
