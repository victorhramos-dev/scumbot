/**
 * Remove empty navgroups
 *
 */
$(document).ready(function() {
    $('#sidenav-collapse-main').find('.navbar-nav').each(function() {
        var children = $(this).find('.nav-item').length;

        if (children == 0) {
            $(this).prev().remove();

            $(this).remove();
        }
    });
});

/**
 * Remove empty navgroups
 *
 */
$(document).ready(function() {
    $(document).on('click', '#main-menu-navigation button[data-toggle="modal"]', function(event) {
        event.preventDefault();

        alert('Clique');
    });
});


/**
 * Handle ajax modal body class
 *
 */
$(document).on('shown.bs.modal', '#ajaxModal', function() {
    $('body').addClass('ajax-modal-opened');

    var hasMediaModal = $('body').hasClass('media-modal-opened');

    if (hasMediaModal) {
        $('body').addClass('has-media-modal');

        var fileType = $('#ajaxMediaModal').find('input[name="filetype"]').val();

        if (fileType == 'media') {
            $('body').addClass('has-media-filetype');
        }

        $('#ajaxMediaModal').modal('hide');
    }

}).on('hidden.bs.modal', '#ajaxModal', function() {
    $('body').removeClass('ajax-modal-opened');

    var hasMediaModal = $('body').hasClass('has-media-modal');

    var hasMediaFileType = $('body').hasClass('has-media-filetype');

    if (hasMediaModal) {
        $('body').removeClass('has-media-modal');
        $('body').removeClass('has-media-filetype');

        if (hasMediaFileType) {
            openMediaModal('media');
        } else {
            openMediaModal('image');
        }
    }
});


/**
 * Handle media modal body class
 *
 */
$(document).on('show.bs.modal', '#ajaxMediaModal', function(event) {
    $('body').addClass('media-modal-opened');

}).on('hidden.bs.modal', '#ajaxMediaModal', function(event) {
    $('body').removeClass('media-modal-opened');
});


/**
 * Handle media modal feather icons
 *
 */
$(document).on('shown.bs.modal', '#ajaxModal', function(event) {
    if (window.feather) {
        feather.replace({
            width  : 14,
            height : 14
        });
    }
});


/**
 * Handle textarea autoexpand
 *
 */
$(document).ready(function() {
    $('.textarea-expandible').each(function() {
        var scrollHeight = this.scrollHeight + 10;

        if (scrollHeight <= 50) {
            scrollHeight = 50;
        }

        this.setAttribute('style', 'height:' + (scrollHeight) + 'px;overflow-y:hidden;');

    }).on('input', function() {
        var scrollHeight = this.scrollHeight + 10;

        if (scrollHeight <= 50) {
            scrollHeight = 50;
        }

        this.style.height = 'auto';
        this.style.height = (scrollHeight) + 'px';
    });
});


/**
 * Handle textarea autoexpand in ajax modal
 *
 */
$(document).on('content.bs.modal', '#ajaxModal', function() {
    $(this).find('.textarea-expandible').each(function() {
        var scrollHeight = this.scrollHeight + 10;

        if (scrollHeight <= 50) {
            scrollHeight = 50;
        }

        this.setAttribute('style', 'height:' + (scrollHeight) + 'px;overflow-y:hidden;');

    }).on('input', function() {
        var scrollHeight = this.scrollHeight + 10;

        if (scrollHeight <= 50) {
            scrollHeight = 50;
        }

        this.style.height = 'auto';
        this.style.height = (scrollHeight) + 'px';
    });
});


/**
 * Filter media
 *
 */
$(document).on('click', '#ajaxMediaModal .media-search .btn-filter-media', function(e) {
    e.preventDefault();

    var params = {
        search   : $('#ajaxMediaModal .media-search input[name="search"]').val(),
        filetype : $('#ajaxMediaModal .media-search input[name="filetype"]').val()
    };

    $.ajax({
        url: getComposedFullPath('admin/cms/media/modal'),
        type: 'GET',
        dataType: 'html',
        data: params,
        success: function(data) {
            $('#ajaxMediaModal .modal-content').html(data);
        }
    });
});


/**
 * Paginate media
 *
 */
$(document).on('click', '#ajaxMediaModal .media-pagination .pagination li a', function(e) {
    e.preventDefault();

    var link = $(this).attr('href');

    $.ajax({
        url: link,
        type: 'GET',
        dataType: 'html',
        success: function(data) {
            $('#ajaxMediaModal .modal-content').html(data);
        }
    });
});


/**
 * Inject media
 *
 */
$(document).on('click', '#ajaxMediaModal .media-holder .media-item a', function(e) {
    e.preventDefault();

    var dataLink = $(this).attr('data-link');

    window.filePickerCallback(dataLink);

    $('#ajaxMediaModal').modal('hide');
});


/**
 * Autocomplete Campaign
 *
 */
$(document).on('focus', '.campaign-autocomplete', function(event) {

    // Capture element
    var elem = $(this);

    // Get element container
    var container = $(elem).parents('.form-group-campaign').first();

    // Initialize autocomplete
    $(elem).autocomplete({
        minLength: 1,
        delay: 200,
        appendTo: container,
        source: function (request, response) {
            var requestUrl = getComposedFullPath('admin/business/campaigns/json/?search=' + request.term);

            $.getJSON(requestUrl, function (records) {
                results = $.map(records.data, function(item) {
                    return {
                        id: item.id,
                        value: item.title,
                        label: item.title,
                    };
                });

                response(results);
            });
        },
        search: function(event, ui) {
            $('input[name="campaign_id"]').val(0);
        },
        select: function (event, ui) {
            event.preventDefault();

            $('input[name="campaign_id"]').val(ui.item.id);

            $(event.target).val(ui.item.label);

            return true;
        }
    });
});


/**
 * Autocomplete Customer
 *
 */
$(document).on('focus', '.customer-autocomplete', function(event) {

    // Capture element
    var elem = $(this);

    // Get element container
    var container = $(elem).parents('.form-group-customer').first();

    // Initialize autocomplete
    $(elem).autocomplete({
        minLength: 1,
        delay: 200,
        appendTo: container,
        source: function (request, response) {
            var requestUrl = getComposedFullPath('admin/business/customers/json/?search=' + request.term);

            $.getJSON(requestUrl, function (records) {
                results = $.map(records.data, function(item) {
                    return {
                        id: item.id,
                        value: item.name,
                        label: item.id + ' - ' + item.name,
                    };
                });

                response(results);
            });
        },
        search: function(event, ui) {
            $('input[name="customer_id"]').val(0);
        },
        select: function (event, ui) {
            event.preventDefault();

            $('input[name="customer_id"]').val(ui.item.id);

            $(event.target).val(ui.item.label);

            return true;
        }
    });
});


/**
 * Autocomplete Partner
 *
 */
$(document).on('focus', '.partner-autocomplete', function(event) {

    // Capture element
    var elem = $(this);

    // Get element container
    var container = $(elem).parents('.form-group-partner').first();

    // Initialize autocomplete
    $(elem).autocomplete({
        minLength: 1,
        delay: 200,
        appendTo: container,
        source: function (request, response) {
            var requestUrl = getComposedFullPath('admin/business/partners/json/?search=' + request.term);

            $.getJSON(requestUrl, function (records) {
                results = $.map(records.data, function(item) {
                    return {
                        id: item.id,
                        value: item.name,
                        label: item.id + ' - ' + item.name,
                    };
                });

                response(results);
            });
        },
        search: function(event, ui) {
            $('input[name="partner_id"]').val(0);
        },
        select: function (event, ui) {
            event.preventDefault();

            $('input[name="partner_id"]').val(ui.item.id);

            $(event.target).val(ui.item.label);

            return true;
        }
    });
});


/**
 * Autocomplete Influencers
 *
 */
$(document).on('focus', '.partners-autocomplete', function(event) {

    // Capture element
    var elem = $(this);

    // Get element container
    var container = $(elem).parents('.form-group-partners').first();

    // Initialize autocomplete
    $(elem).autocomplete({
        minLength: 1,
        delay: 200,
        appendTo: container,
        source: function (request, response) {
            var requestUrl = getComposedFullPath('admin/business/partners/json/?search=' + request.term);

            $.getJSON(requestUrl, function (records) {
                results = $.map(records.data, function(item) {
                    return {
                        id: item.id,
                        value: item.name,
                        label: item.id + ' - ' + item.name,
                    };
                });

                response(results);
            });
        },
        search: function(event, ui) {
            // Do nothing
        },
        select: function (event, ui) {
            event.preventDefault();

            var wrapper = $(container).find('.list-group-partners').first();

            $(wrapper).find('[data-partner="' + ui.item.id + '"]').remove();

            var html  = '<li data-partner="' + ui.item.id + '" class="list-group-item">';
                    html += '<input type="hidden" name="partners[]" value="' + ui.item.id + '">';
                    html += ui.item.value;
                    html += '<button type="button" class="btn btn-icon btn-flat-danger btn-delete"><i data-feather="x-circle"></i></button>';
                html += '</li>';

            $(wrapper).append(html);

            if (window.feather) {
                feather.replace({
                    width  : 14,
                    height : 14
                });
            }

            $(elem).val('');

            return true;
        }
    });
});


/**
 * Remove Partners
 *
 */
$(document).on('click', '.form-group-partners .btn-delete', function(event) {
    event.preventDefault();

    var button = $(this);

    bootbox.dialog({
        message: 'Deseja remover este registro ?',
        buttons: {
            danger: {
                label: '<i class="fa fa-times"></i> Cancelar',
                className: "btn-danger",
                callback: function () {
                }
            },
            main: {
                label: '<i class="fa fa-check"></i> OK',
                className: "btn-primary",
                callback: function () {
                    button.parents('.list-group-item').first().remove();
                }
            }
        }
    });
});


/**
 * Handle document type change
 *
 */
$(document).on('change', '.form-group-document select', function(e) {
    var current = $(this).val();

    var wrapper = $(this).parents('.form-group-document').first();

    $(this).parents('.form-group-document').find('input').val('');

    $(this).parents('.form-group-document').find('input').removeClass('cpf');
    $(this).parents('.form-group-document').find('input').removeClass('rg');
    $(this).parents('.form-group-document').find('input').removeClass('cnh');
    $(this).parents('.form-group-document').find('input').removeClass('cnpj');
    $(this).parents('.form-group-document').find('input').removeClass('ie');
    $(this).parents('.form-group-document').find('input').removeClass('im');

    $(this).parents('.form-group-document').find('input').addClass(current);

    $(this).parents('.form-group-document').find('input').focus();
});


/**
 * Open Media Upload
 *
 */
$(document).on('click', '.media-wrapper .btn-upload', function() {
    $(this).parents('.media-wrapper').find('input[type="file"]').trigger('click');
});


/**
 * Clear Media
 *
 */
$(document).on('click', '.media-wrapper .btn-clear', function() {
    var button = this;

    bootbox.dialog({
        message: 'Tem certeza que deseja limpar esta imagem ?',
        buttons: {
            danger: {
                label: '<i class="fa fa-times"></i> Cancelar',
                className: "btn-danger",
                callback: function () {
                }
            },
            main: {
                label: '<i class="fa fa-check"></i> OK',
                className: "btn-primary",
                callback: function () {
                    $(button).parents('.media-wrapper').find('.media-image').removeAttr('style');

                    $(button).parents('.media-wrapper').find('input[type="file"]').val('');

                    $(button).parents('.media-wrapper').find('input[type="hidden"]').val('clear');
                }
            }
        }
    });
});


/**
 * Handle Media Picker
 *
 */
$(document).on('change', '.media-wrapper input[type="file"]', function() {
    var $input = this;

    if ($input.files && $input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $($input).parents('.media-wrapper').find('.media-image').attr('style', 'background-image: url(' + e.target.result + ');');

            $($input).parents('.media-wrapper').find('input[type="hidden"]').val('');
        };

        reader.readAsDataURL($input.files[0]);
    }
});


/**
 * Catch form input 'enter' on search form
 *
 */
$(document).on('click', '.navbar-search .input-group-prepend', function(e) {
    e.preventDefault();

    $(this).parents('form').submit();
});


/**
 * Catch form input 'enter' on search form
 *
 */
$(document).on('keyup', '.navbar-search input[type="search"]', function(e) {
    if(event.keyCode == 13) {
        e.preventDefault();

        $(this).parents('form').submit();
    }
});