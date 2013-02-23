<?php
/**
 * Test: Flame\Blog\Tests\Model\Posts\PostManager
 *
 * @testCase Flame\Blog\Tests\Model\Posts\PostManagerTest
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame\Blog\Tests\Model\Posts
 */
namespace Flame\Blog\Tests\Model\Posts;

use Tester\Assert;

$container = require_once __DIR__ . '/../../bootstrap.php';

class PostManagerTest extends \Flame\Tests\MockTestCase
{

	/** @var \Flame\Blog\Model\Posts\PostManager */
	private $postManager;

	public function setUp()
	{
		parent::setUp();

		$this->postManager = new \Flame\Blog\Model\Posts\PostManager;
	}

	public function testCreateValidateInput()
	{
		Assert::throws(function () {
			$this->postManager->create(array());
		}, 'Nette\InvalidArgumentException');

	}

	public function testCreate()
	{
		$data = array('public' => true, 'content' => '', 'title' => '');
		$postFacadeMock = $this->mockista->create('\Flame\Blog\Entity\Posts\PostFacade');
		$postFacadeMock->expects('save')
			->once();

		$this->postManager->injectPostFacade($postFacadeMock);
		$re = $this->postManager->create($data);
		Assert::true($re instanceof \Flame\Blog\Entity\Posts\Post);
	}

	public function testUpdateNotExistPost()
	{
		$id = 1;
		$postFacadeMock = $this->mockista->create('\Flame\Blog\Entity\Posts\PostFacade');
		$postFacadeMock->expects('getOne')
			->with($id)
			->once()
			->andReturn(null);

		$this->postManager->injectPostFacade($postFacadeMock);
		Assert::throws(function () use ($id) {
			$this->postManager->update($id, array());
		}, '\Nette\InvalidArgumentException');
	}

	public function testUpdateValidateInput()
	{
		$id = 1;
		$postFacadeMock = $this->mockista->create('\Flame\Blog\Entity\Posts\PostFacade');
		$postFacadeMock->expects('getOne')
			->with($id)
			->once()
			->andReturn(true);

		$this->postManager->injectPostFacade($postFacadeMock);
		Assert::throws(function () use ($id) {
			$this->postManager->update($id, array());
		}, '\Nette\InvalidArgumentException');
	}

	public function testUpdate()
	{
		$id = 1;
		$post = new \Flame\Blog\Entity\Posts\Post('', '');

		$postFacadeMock = $this->mockista->create('\Flame\Blog\Entity\Posts\PostFacade');
		$postFacadeMock->expects('getOne')
			->with($id)
			->once()
			->andReturn($post);
		$postFacadeMock->expects('save')
			->with($post)
			->once();

		$this->postManager->injectPostFacade($postFacadeMock);

		$result = $this->postManager->update($id, array('public' => true, 'content' => '', 'title' => ''));
		Assert::true($result instanceof \Flame\Blog\Entity\Posts\Post);
	}
}

run(new PostManagerTest($container));