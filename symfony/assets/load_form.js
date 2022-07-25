import $ from 'jquery';
// start the Stimulus application
import './bootstrap';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'bootstrap/dist/css/bootstrap.min.css';


import bsCustomFileInput from 'bs-custom-file-input';
bsCustomFileInput.init();

'use strict';

(function(window, $) {

    $.extend(window.load_form.prototype, {

        handleNewFormSubmit: function(e) {

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                success: function(data) {
                    $form.closest('.btn-toolbar').html(data);
                }
            });
        }
    });

})(window, jQuery);
