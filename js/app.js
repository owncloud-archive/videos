$(document).ready(function() {
	$('#videos-videoscontainer').masonry({
		itemselector: '.videos-video',
	});
});

$(document).ready(function() {
	$('.videos-video').click(function() {
		videoViewer.file = $(this).data('name');
		videoViewer.dir = $(this).data('dir');
		videoViewer.location = videoViewer.getMediaUrl($(this).data('name'));
		videoViewer.mime = $(this).data('mime');

		OC.addScript('files_videoviewer','mediaelement-and-player', function(){
			OC.addScript('files_videoviewer','mep-extra', videoViewer.showPlayer);
		});
	});
});
