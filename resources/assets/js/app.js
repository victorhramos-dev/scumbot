/**
 * Funcoes Gerais do Javascript
 */
$(document).ready(function() {

    /**
     * Credit Card Mask Behavior
     *
     * @type  {Closure}
     */
    var cardMaskBehavior = function (val) {
        var cardLength = val.replace(/\D/g, '').length;

        if (cardLength == 16) {
            return '0000 0000 0000 0000';
        }

        if (cardLength == 15) {
            return '000 000000 0000009';
        }

        if (cardLength == 14) {
            return '00000 0000 000009';
        }

        return '0999 9999 9999 9999';
    };
    var cardMaskOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(cardMaskBehavior.apply({}, arguments), options);
        }
    };


    /**
     * Mask cc
     */
    $(document).on('focus', '.credit-card-number', function() {
        $(this).mask(cardMaskBehavior, cardMaskOptions);
    });


    /**
     * Phone Mask Behavior
     *
     * @type  {Closure}
     */
    var phoneMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    };
    var phoneMaskOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(phoneMaskBehavior.apply({}, arguments), options);
        }
    };


    /**
     * Mask phone
     */
    $(document).on('focus', '.phone', function() {
        $(this).mask(phoneMaskBehavior, phoneMaskOptions);
    });


    /**
     * Document Mask Behavior
     *
     * @type  {Closure}
     */
    var documentMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 14 ? '00.000.000/0000-00' : '000.000.000-00999';
    };
    var documentMaskOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(documentMaskBehavior.apply({}, arguments), options);
        }
    };


    /**
     * Mask document
     */
    $(document).on('focus', '.document', function() {
        $(this).mask(documentMaskBehavior, documentMaskOptions);
    });


    // CPF
    $(document).on('focus', '.cpf', function() {
        $(this).mask('999.999.999-99');
    });

    // CNPJ
    $(document).on('focus', '.cnpj', function() {
        $(this).mask('99.999.999/9999-99');
    });

    // Date BR
    $(document).on('focus', '.date_br', function() {
        $(this).mask('99/99/9999');
    });

    // Date US
    $(document).on('focus', '.date_us', function() {
        $(this).mask('9999-99-99');
    });

    // DateTime BR
    $(document).on('focus', '.datetime_br', function() {
        $(this).mask('99/99/9999 99:99:99');
    });

    // DateTime US
    $(document).on('focus', '.datetime_us', function() {
        $(this).mask('9999-99-99 99:99:99');
    });

    // CEP
    $(document).on('focus', '.cep', function() {
        $(this).mask('99.999-999');
    }).on('focus', '.zipcode', function() {
        $(this).mask('99.999-999');
    });

    // Numeros Inteiros (max 40 digitos)
    $(document).on('focus', '.integer', function() {
        $(this).mask('9999999999999999999999999999999999999999', {placeholder: ''});
    });

    // No Inteiro 1 digito
    $(document).on('focus', '.int1', function() {
        $(this).mask('9');
    });

    // No Inteiro 2 digitos
    $(document).on('focus', '.int2', function() {
        $(this).mask('99');
    });

    // No Inteiro 3 digitos
    $(document).on('focus', '.int3', function() {
        $(this).mask('999');
    });

    // No Inteiro 4 digitos
    $(document).on('focus', '.int4', function() {
        $(this).mask('9999');
    });

    // Monetaria
    $(document).on('focus', '.decimal', function() {
        $(this).maskMoney({thousands : '', decimal : '.', precision: 2, allowZero: true});
    });

    // Monetaria
    $(document).on('focus', '.empty_decimal', function() {
        $(this).maskMoney({thousands : '', decimal : '.', precision: 2, allowZero: false, allowEmpty: true});
    });

    // Peso (3 Casas Decimais)
    $(document).on('focus', '.peso', function() {
        $(this).maskMoney({thousands : '', decimal : '.', precision: 3, allowZero: true});
    });

    // Peso (4 Casas Decimais)
    $(document).on('focus', '.decimal4', function() {
        $(this).maskMoney({thousands : '', decimal : '.', precision: 4});
    });

    // Peso (5 Casas Decimais)
    $(document).on('focus', '.decimal5', function() {
        $(this).maskMoney({thousands : '', decimal : '.', precision: 5});
    });
});

// Execute URL Dialog
$(document).on('click', 'a.dialog-confirm', function(e) {
    e.preventDefault();
    e.stopPropagation();

    var button = $(this);

    var href = button.attr('href');

    bootbox.dialog({
        message: 'Deseja realmente executar esta ação ?',
        title: button.getDialogTitle(),
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
                    $(location).attr('href', href);
                }
            }
        }
    });
});

// Dialog Ajax Rest Get
$(document).on('click', '.ajax-rest-get', function(e) {
    e.preventDefault();

    var button = $(this);

    bootbox.dialog({
        message: 'Deseja realmente executar esta ação ?',
        title: button.getDialogTitle(),
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: button.attr('href'),
                        success: function(json) {
                            if (json.redirect) {
                                $(location).attr('href', json.redirect);

                            } else if (json.success) {
                                window.location.reload(true);
                            }
                        }
                    });
                }
            }
        }
    });
});

// Dialog Ajax Rest Delete
$(document).on('click', '.ajax-rest-delete', function(e) {
    e.preventDefault();

    var button = $(this);

    bootbox.dialog({
        message: 'Deseja realmente executar esta ação ?',
        title: button.getDialogTitle(),
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _method: 'DELETE'
                        },
                        url: button.attr('href'),
                        success: function(json) {
                            if (json.redirect) {
                                $(location).attr('href', json.redirect);
                            }

                            if (json.success) {
                                window.location.reload(true);
                            }
                        }
                    });
                }
            }
        }
    });
});

// Ajax form submit
$(document).on('click', '.ajax-rest-post', function(e) {
    e.preventDefault();

    var button = $(this);

    if (button.attr('data-confirm') == 'true') {
        bootbox.dialog({
            message: 'Tem certeza que deseja continuar ?',
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
                        submitPost(button);
                    }
                }
            }
        });
    } else {
        submitPost(button);
    }
});

// Proccess form Post
function submitPost(button)
{
    var html = button.html();

    var formData = new FormData(button.parents('form')[0]);

    // Ajax request
    $.ajax({
        url: button.parents('form').attr('action'),
        type: 'POST',
        dataType: 'json',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            button
                .html('<i class="fa fa-spinner fa-spin"></i> Processando...')
                .attr('disabled', true);
        },
        complete: function(data) {
            button.html(html);
        },
        success: function(data, xhr) {
            processResponse(data, 200, button, button.parents('form'));
        },
        error: function(xhr, ajaxOptions, thrownError) {
            processResponse(xhr.responseJSON, xhr.status, button, button.parents('form'));
        }
    });
}

/**
 * Process ajax response
 *
 * @param   json  data    JSON Response
 * @param   obj   button  Target button
 * @param   obj   form    Target form
 */
function processResponse(data, status, button, form)
{
    // Remove validation error classes
    if (form) {
        $('.has-danger').each(function() {
            $(this).removeClass('has-danger');
        });

        $('.invalid').each(function() {
            $(this).removeClass('invalid');
        });

        $('.validation').each(function() {
            $(this).remove();
        });
    }

    // Response 200 - Success
    if (status == 200) {
        if (data && data !== undefined  && data.redirect !== undefined && data.redirect !== '') {
            location.href = data.redirect;

        } else if (form && form.find('input[name="success_redirect"]').length) {
            location.href = form.find('input[name="success_redirect"]').val();

        } else if(button && button.attr('data-success-redirect')) {
            location.href = button.attr('data-success-redirect');

        } else {
            toastr.success('Sucesso!');

            setTimeout(function() {
                location.reload(true);
            }, 2600);
        }
    }

    // Response 403 - Forbidden
    if (status == 403) {
        toastr.error('Operação não autorizada!');

        setTimeout(function() {
            if (form && form.find('input[name="error_redirect"]').length) {
                location.href = form.find('input[name="error_redirect"]').val();
            } else if(button && button.attr('data-error-redirect')) {
                location.href = button.attr('data-error-redirect');
            } else {
                location.reload(true);
            }
        }, 300);
    }

    // Response 422 - Validation errors
    if (status == 422 && data.errors) {
        if (form && form.find('input[name="validation_redirect"]').length) {
            location.href = form.find('input[name="validation_redirect"]').val();
        } else if(button && button.attr('data-validation-redirect')) {
            location.href = button.attr('data-validation-redirect');
        } else {
            toastr.error('Preencha corretamente todos os campos obrigatórios');

            $.each(data.errors, function(key, value) {
                inputName = getInputNameFromDotNotation(key);

                // Capturar elemento input
                var input = $(form).find('[name="' + inputName + '"],[name="' + inputName + '[]"]').first();

                if (input.attr('type') == 'hidden') {
                    toastr.error(value);

                } else {
                    // Capturar elemento pai
                    var parent = input.parent();

                    // Verifica qual o tipo do elemento pai
                    if (parent.hasClass('input-group') || parent.hasClass('radio') || parent.hasClass('checkbox')) {
                        var parent = input.parents('.input-group:first').parents('.form-group:first');

                        var parentGroup = input.parents('.input-group:first').parents('.form-group:first');

                    // Validation wrapper
                    } else if (parent.hasClass('validation-wrapper')) {
                        var parent = input.parents('.validation-wrapper');

                        var parentGroup = input.parents('.validation-wrapper').parents('.form-group:first');

                    // Form-group
                    } else {
                        var parent = input.parents('.form-group');

                        var parentGroup = input.parents('.form-group');
                    }

                    $(parent).append('<small class="validation text-danger text-xs font-weight-300">' + value + '</small>');

                    $(parentGroup).addClass('has-danger');

                    $(parentGroup).addClass('is-invalid');
                }
            });

            if (form) {
                hasTabs = $(form).find('.tab-content').length;

                if (hasTabs > 0) {
                    var receiveClick = false;

                    $.each($(form).find('.tab-content .tab-pane').get().reverse(), function(index, elem) {
                        var tabId = $(elem).attr('id');

                        if ($(elem).find('.validation').length > 0) {
                            receiveClick = tabId;

                            return true;
                        }
                    });

                    if (receiveClick) {
                        $(form).find('a[href="#' + receiveClick + '"]').trigger('click');
                    }
                }
            }

            button.attr('disabled', false);
        }
    }

    // Response 440 - Expired session
    if (status == 440) {
        toastr.error('Sessão expirada.');

        setTimeout(function() {
            location.reload(true);
        }, 300);
    }
}


/**
 * Return input instance from dot notation
 *
 * @param   string  inputName
 */
function getInputNameFromDotNotation(inputName)
{
    var parts = inputName.split('.');

    var name = '';

    $.each(parts, function(index, part) {
        if (index == 0) {
            name += part;
        } else {
            name += '[' + part + ']';
        }
    });

    return name;
}


/**
 * Create UUID
 *
 * @return  string
 */
function createUniqueId()
{
    var dt = new Date().getTime();

    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (dt + Math.random() * 16) % 16 | 0;

        dt = Math.floor(dt / 16);

        return (c == 'x' ? r :(r&0x3|0x8)).toString(16);
    });

    return uuid;
}


/**
 * Return formatted currency
 *
 * @return  string
 */
function formatCurrency(amount)
{
    var formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    });

    return formatter.format(amount);
}


// Catch form input 'enter'
$(document).on('keydown', 'input[type=text], input[type=email], input[type=number], input[type=password], input[type=search]', function(e) {
    if(e.keyCode == 13) {
        e.preventDefault();

        $(this).closest('form').find('button.ajax-rest-post').click();
    }
});


// Reset bootstrap modal on close
$(document).on('hidden.bs.modal', '#ajaxModal', function() {
    $('#ajaxModal').modal('dispose').remove();

    $('body').append('<div class="modal primary fade" id="ajaxModal"><div class="modal-dialog modal-lg"><div class="modal-content"></div></div></div>');
});


// Inject content on ajax modal
$(document).on('show.bs.modal', '#ajaxModal', function(e) {
    var modal = this;

    $(modal).find('.modal-content').load(e.relatedTarget.href, false, function() {

        // Trigger modal content injected
        $('#ajaxModal').trigger('content.bs.modal');
    });
});


// Change custom file label content
$(document).on('change', 'input[type="file"]', function(e) {
    var fileName = $(this).val();

    $(this).next('.custom-file-label').html(fileName);
});


// Extract button action title
jQuery.fn.extend({
    getDialogTitle: function() {
        if ($(this).attr('title') != '' && $(this).attr('title') !== undefined) {
            return $(this).attr('title');
        } else if ($(this).attr('data-title') != '' && $(this).attr('data-title') !== undefined) {
            return $(this).attr('data-title');
        } else {
            return $(this).html();
        }
    }
});