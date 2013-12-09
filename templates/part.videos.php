<div id="videos-videoscontainer">
<?php
foreach($_['videos'] as $video) {
	print_unescaped($this->inc('part.video', array('video' => $video)));
}
?>
</div>
