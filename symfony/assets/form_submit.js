/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

import $ from '../node_modules/jquery';

//import '';
// start the Stimulus application
import './bootstrap';
import '../node_modules/bootstrap/dist/css/bootstrap.min.css';
//import '../node_modules/bootstrap-select/dist/css/bootstrap-select.min.css';
import '../node_modules/bootstrap/dist/js/bootstrap.min.js';
//import '../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js';



import bsCustomFileInput from 'bs-custom-file-input';
bsCustomFileInput.init();


// this is the id of the form
$(function () {
      

  $('form').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: 'post',
      url: '/',
      data: {    }, 
      beforeSend: function() {
        $("#loader").show(); 

      },
      success: function (data) {
        //console.log(data);
        console.log('Changed option value farmerDataList ');
       
      },
      complete: function(data){
        $("#loader").hide();
       }
    });

  });

});

