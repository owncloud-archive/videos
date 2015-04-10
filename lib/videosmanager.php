<?php

/**
 * ownCloud - Videos App
 *
 * @author Frank Karlitschek
 * @copyright 2013 Frank Karlitschek frank@owncloud.org
 * @author Georg Ehrke
 * @copyright 2013 Georg Ehrke georg@owncloud.com
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either 
 * version 3 of the License, or any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *  
 * You should have received a copy of the GNU Lesser General Public 
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
namespace OCA\Videos;

use OC\Files\Filesystem;
use OC\Files\View;
use OC\Files\Cache\Cache;

class VideosManager {

	private $cache;
	private $fileview;

	private $videos;

	public function __construct($user=null) {
		if(is_null($user)) {
			$user = \OCP\User::getUser();
		}

		$root = $user . '/files/';
		list($storage, $internalPath) = Filesystem::resolvePath($root);

		$this->fileview = new View($root);
		$this->cache = new Cache($storage);
	}

	public function getVideos() {
		if(!empty($this->videos)) {
			return $this->videos;
		}

		$videos = $this->cache->searchByMime('video');

		foreach($videos as $video) {
			if(substr($video['path'], 0, 6) !== 'files/') {
				continue;
			}
			$url = substr($video['path'], 6);
			$entry = array(
				'url' => $url,
				'dir' => substr($url, 0, strlen($url) - strlen($video['name'])),
				'name' => $video['name'],
				'size' => $video['size'],
				'mtime' => $video['mtime'],
				'mime' => $video['mimetype'],
				'preview' => $this->getPreviewUrl($video['path']),
			);

			$this->videos[] = $entry;
		}

		return $this->videos;
	}

	private function getPreviewUrl($path) {
		$x = 200;
		$y = 113;
		$path = substr($path, 6);

		return \OCP\Util::linkToRoute( 'core_ajax_preview', array('x' => $x, 'y' => $y, 'file' => $path ));
	}
}
