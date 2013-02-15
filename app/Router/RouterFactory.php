<?php

namespace Flame\Blog\Router;

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		$router[] = new Route('index.php', ':Front:Homepage:default', Route::ONE_WAY);
		$router[] = new Route('back/<presenter>/<action>[/<id>]', array(
			'module' => 'Back',
			'presenter' => 'Wall',
			'action' => 'default',
			'id' => null
		));
		$router[] = new Route('<presenter>/<action>[/<id>][/<slug>]', array(
			'module' => 'Front',
			'presenter' => 'Post',
			'action' => 'default',
			'id' => null,
			'slug' => null
		));
		return $router;
	}

}
