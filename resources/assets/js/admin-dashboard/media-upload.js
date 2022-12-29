// Handle media upload on post modal
$(document).find('.media-upload').each(function(index, elem) {
    var mediaImage = $(elem).find('.media-image');

    var mediaInput = $(elem).find('.media-input');
  
    var mediaDropper = $(elem).find('.media-dropper');

    var mediaDropperUri = $(mediaDropper).attr('data-uri');

    let myDropzone = new Dropzone(mediaDropper[0], {
        url : mediaDropperUri,
        method : 'post',
        autoQueue : true,
        uploadMultiple : false,
        autoProcessQueue : true,
        acceptedFiles : 'image/jpeg, image/png, image/bmp, image/webp',
        maxFiles : 1,
        parallelUploads : 1
    });

    myDropzone.on('success', function(file, response) {
        var _this = this;

        $(file.previewElement).fadeOut(400, function() {
            _this.removeFile(file);
        });

        let itemImage = document.createElement('img');
        itemImage.setAttribute('src', response.data.thumbs.square_small);

        mediaImage.html('');

        mediaImage.append(itemImage);

        mediaInput.val(response.data.id);
    });
});