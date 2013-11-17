<?php

/**
 * ownCloud - Videos App
 *
 * @author Frank Karlitschek
 * @copyright 2011 Frank Karlitschek karlitschek@kde.org
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

\OCP\User::checkLoggedIn();
\OCP\JSON::checkAppEnabled('videos');
\OCP\App::setActiveNavigationEntry( 'videos_index' );

\OCP\Util::addStyle( 'videos', 'style' );
\OCP\Util::addScript( 'videos', 'app' );
\OCP\Util::addScript( 'videos/3rdparty', 'masonry.pkgd' );

\OCP\Util::addStyle( 'files_videoviewer', 'style' );
\OCP\Util::addStyle( 'files_videoviewer', 'mediaelementplayer' );
\OCP\Util::addscript( 'files_videoviewer', 'viewer');

$manager = new VideosManager();
$videos = $manager->getVideos();
$tmpl = new \OCP\Template('videos', 'videos', 'user');
$tmpl->assign('videos', $videos);
$tmpl->printPage();


