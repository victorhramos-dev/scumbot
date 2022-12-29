/**
 * Return filtered base href
 *
 * @return  object
 */
function getComposedFullPath(targetUri)
{
    var baseHref = document.querySelector('base').href;

    var lastBaseChar = baseHref.substr(baseHref.length - 1);

    if (lastBaseChar == '/') {
        var baseHref = baseHref.slice(0, -1);
    }

    firstUriChar = targetUri.slice(0, 1);

    if (firstUriChar == '/') {
        targetUri = targetUri.slice(0, 1);
    }

    return baseHref + '/' + targetUri;
}


/**
 * Open Media Modal
 *
 * @return  object
 */
function openMediaModal(fileType)
{
    $('#ajaxMediaModal').remove();

    $('body').append('<div class="modal primary fade" id="ajaxMediaModal"><div class="modal-dialog modal-lg"><div class="modal-content"></div></div></div>');

    $.ajax({
        url: getComposedFullPath('admin/cms/media/modal'),
        type: 'GET',
        dataType: 'html',
        data: {'filetype' : fileType},
        success: function(data) {
            $('#ajaxMediaModal .modal-content').html(data);

            $('#ajaxMediaModal').modal().on('hidden.bs.modal', function(e) {
                $(e.currentTarget).remove();
            });
        }
    });
}