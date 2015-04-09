<?php

/** @var $this \OC\Route\Router */

$this->create('videos_index', '/')
	->actionInclude('videos/index.php');
