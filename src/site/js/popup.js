(function ($) {

    'use strict';

    function initialize() {
        /*
         * The official Pinterest script comes with many limitations, including the
         * inability to use your own, custom "pin it" image. Thus, we have opted to
         * write our own.
         */

        $('.pin-it-button-hover, .pin-it-button').on('click', '.pin-it', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            window.open($(this).attr('href'), 'Pinterest_Popup_Window', 'resizable=yes,height=550,width=750');
        });
    }

    initialize();

}(jQuery));
