<?php
/**
 * WpImportFormProcess.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    17.02.13
 */

namespace Flame\Blog\Components\Imports\WordPress\Forms;

use Flame\Utils\Strings;
use Nette\InvalidArgumentException;

class WpImportFormProcess extends \Nette\Object
{

	/** @var string */
	private $baseDir;

	/** @var string */
	private $imageDir;

	/** @var \Flame\Addons\WordPress\PostsImporter */
	private $postImporter;

	/** @var \Flame\Blog\Model\Posts\PostManager */
	private $postManager;

	/**
	 * @param \Flame\Blog\Model\Posts\PostManager $postManager
	 */
	public function injectPostManager(\Flame\Blog\Model\Posts\PostManager $postManager)
	{
		$this->postManager = $postManager;
	}

	/**
	 * @param \Flame\Addons\WordPress\PostsImporter $postImporter
	 */
	public function injectPostImporter(\Flame\Addons\WordPress\PostsImporter $postImporter)
	{
		$this->postImporter = $postImporter;
	}

	/**
	 * @param $baseDir
	 * @param string $imagesDir
	 */
	public function __construct($baseDir, $imagesDir = '/media/download')
	{
		$this->baseDir = (string) $baseDir;
		$this->imageDir = (string) $imagesDir;
	}

	/**
	 * @param $values
	 * @return bool
	 * @throws \Nette\InvalidArgumentException
	 */
	public function import($values)
	{

		$this->createDirForImages();

		if(!$values->file->isOk()){
			throw new InvalidArgumentException('Uploaded file is not valid. '. $values->file->getError());
		}else{
			$posts = $this->postImporter->convert($values->file->getTemporaryFile());

			if(count($posts)){
				foreach($posts as $post){
					$this->createPost($post);
				}
			}

			return true;
		}
	}

	/**
	 * @return string
	 */
	protected function getImagesDirPath()
	{
		if(Strings::endsWith($this->baseDir, DIRECTORY_SEPARATOR) or
			Strings::startsWith($this->imageDir, DIRECTORY_SEPARATOR)){
			return $this->baseDir . $this->imageDir;
		}else{
			return $this->baseDir . DIRECTORY_SEPARATOR . $this->imageDir;
		}
	}

	/**
	 * @return bool
	 */
	private function createDirForImages()
	{
		return \Flame\Tools\Files\FileSystem::mkDir($this->getImagesDirPath());
	}

	/**
	 * @param $data
	 * @return \Flame\Blog\Entity\Posts\Post
	 */
	private function createPost($data)
	{
		$prepared = array(
			'public' => false,
			'content' => ''
		);
		if(isset($data['name']))
			$prepared['title'] = $data['name'];
		if(isset($data['content']))
			$prepared['content'] = $data['content'];
		if(isset($data['status']) and $data['status'] == 'publish')
			$prepared['public'] = true;

		if(isset($data['images'][1]) and count($data['images'][1])){
			foreach($data['images'][1] as $imageUrl){
				$this->downloadImage($imageUrl);
				$prepared['content'] = str_replace($imageUrl, $this->getNewImageUrl($imageUrl), $prepared['content']);
			}
		}
		return $this->postManager->create($prepared);
	}

	/**
	 * @param $url
	 * @return int
	 */
	private function downloadImage($url)
	{
		if($file = @file_get_contents($url)){
			return $this->saveImage(Strings::getLastPiece($url, '/'), $file);
		}
	}

	/**
	 * @param $name
	 * @param $file
	 * @return int
	 */
	private function saveImage($name, $file)
	{
		return file_put_contents($this->getImagesDirPath() . DIRECTORY_SEPARATOR . $name, $file);
	}

	/**
	 * @param $imageUrl
	 * @return string
	 */
	private function getNewImageUrl($imageUrl)
	{
		$name = Strings::getLastPiece($imageUrl, '/');
		if(Strings::endsWith($this->imageDir, '/')){
			return $this->imageDir . $name;
		}else{
			return $this->imageDir . '/' . $name;
		}
	}
}
