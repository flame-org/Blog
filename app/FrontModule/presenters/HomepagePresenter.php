<?php

namespace Flame\Blog\FrontModule;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends FrontPresenter
{

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

}
