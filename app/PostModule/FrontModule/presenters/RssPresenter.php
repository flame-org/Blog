<?php
/**
 * RssPresenter.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    17.02.13
 */

namespace Flame\Blog\FrontModule;

class RssPresenter extends FrontPresenter
{

	/**
	 * @autowire
	 * @var \Flame\Blog\Entity\Posts\PostFacade
	 */
	protected $postFacade;

	/**
	 * @autowire
	 * @var \Flame\Blog\Entity\Settings\SettingFacade
	 */
	protected $settingFacade;

	/**
	 * @autowire
	 * @var \Flame\Addons\RssFeed\IRssControlFactory
	 */
	protected $rssControlFactory;

	public function renderDefault() {
		/* @var \Flame\Addons\RssFeed\RssControl */
		$rss = $this["rssFeed"];

		// properties
		$rss->title = $this->settingFacade->getSettingValue('projectName') ?: 'TITLE';
		$rss->description = $this->settingFacade->getSettingValue('projectDesc') ?: 'DESC';
		$rss->link = $this->link("//:Front:Post:");
		$rss->setChannelProperty("lastBuildDate", time());
		// je možno použít odpovídající metody setTitle, setDescription, setLink
		// pro úpravu vlastností kanálu lze využít událost $onPrepareProperties

		$items = $this->postFacade->getLastPublic($this->settingFacade->getSettingValue('maxRssItems') ?: 25);

		// úprava, lze také využít události $onPrepareItem
		if(count($items)){
			$mdParser = $this->createMarkdownParser();
			foreach ($items as &$item) {
				if($item instanceof \Flame\Blog\Entity\Posts\Post){
					$item = $item->toArray();
					$item["link"] = $this->link("//:Front:Post:detail", array(
						'id' => $item["id"],
						'slug' => \Flame\Utils\Strings::webalize($item['title']))
					);
					$item['content'] = $mdParser->transform($item['content']);
					$item['pubDate'] = $item['date'];
					unset($item["id"], $item['date']);
				}
			}
		}


		$rss->items = $items;
	}

	/**
	 * @return \Flame\Addons\RssFeed\RssControl
	 */
	protected function createComponentRssFeed() {
		return $this->rssControlFactory->create();
	}

	/**
	 * @return \Michelf\MarkdownExtra
	 */
	private function createMarkdownParser()
	{
		return new \Michelf\MarkdownExtra;
	}


}
