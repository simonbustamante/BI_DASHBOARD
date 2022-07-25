

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import $ from '../node_modules/jquery';

//import '';
// start the Stimulus application
import './bootstrap';
//import 'bootstrap/dist/js/bootstrap.min.js';
//import 'bootstrap/dist/css/bootstrap.min.css';


import bsCustomFileInput from 'bs-custom-file-input';
bsCustomFileInput.init();

$(function () {

    $('#farmerDataList').on('change', function () {
        //ways to retrieve selected option and text outside handler
        $.ajax({
            type: 'post',
            url: '/',
            data: { farmers: $("#")},
            success: function (data) {
              console.log(data);
              console.log('Changed option value ' + $('#farmerDataList').value);
              console.log('Changed option text ' + $('#farmerDataList').find('option').filter(':selected').text());
            }
          });
    });

});