/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import * as suggestags from 'suggestags';
import axois from 'axios';




axios.get('/ajax/get-subjects')
  .then(function (response) {

    $('.subject-tags').amsifySuggestags({
        type : 'amsify',
        suggestions: response.data,
        whiteList: true
    });

    //console.log();

  })
  .catch(function (error) {
    console.log(error);
  });

  axios.get('/ajax/get-locations')
  .then(function (response) {

    $('.location-tags').amsifySuggestags({
        type : 'amsify',
        suggestions: response.data,
        whiteList: true
    });

  })
  .catch(function (error) {
    console.log(error);
  });

  $('.class-tags').amsifySuggestags({
    type : 'amsify',
    suggestions: ['Play Group','Class 1','Class 2','Class 3','Class 4','Class 5','Class 6','Class 7','Class 8','Class 9','Class 10','HSC Year 1','HSC Year 2'],
    whiteList: true
});

$(function () {

    $('.pagination').addClass('justify-content-center');
  
      
});


