(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function ($) {

    'use strict';

    function initialize() {
        /*
         * The official Pinterest script comes with many limitations, including the
         * inability to use your own, custom "pin it" image. Thus, we have opted to
         * write our own.
         */

        // Custom Pinterest script.
        $('.pin-it-button-hover, .pin-it-button').on('click', '.pin-it', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            window.open($(this).attr('href'), 'Pinterest_Popup_Window', 'resizable=yes,height=550,width=750');
        });
    }

    initialize();

}(jQuery));

},{}]},{},[1]);
