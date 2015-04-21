(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function ($) {

    'use strict';

    var config = {
            hoverButtonMarkup: '<span class="pinterest-pin-it-button-hover"></span>',
            hoverButtonOffset: 10,
            hoverButtonPosition: 'top-right',
            hoverImageOpacity: 0.50,
            //imageSelector: 'div.entry-content img:not([data-pin-no-hover="true"])',
            //postTitleSelector: '.entry-title'
            imageSelector: '.post-content img:not([data-pin-no-hover="true"])',
            postTitleSelector: '.entry-title'
        },

        $button,
        $images = $(config.imageSelector);

    function createPinterestPopupUrl(url, image, description) {
        return document.location.protocol + '//www.pinterest.com/pin/create/button/?url=' + encodeURIComponent(url) + '&media=' + encodeURIComponent(image) + '&description=' + encodeURIComponent(description);
    }

    function createPinDescriptionFromPostTitleAndDomainName($postTitle) {
        return $.trim($postTitle.text()) + ' | ' + window.location.hostname;
    }

    function imageDoesNotHaveCustomAltText(imageAlt) {
        return 0 === imageAlt.length || 0 === imageAlt.toLowerCase().indexOf('img_') || 0 === imageAlt.toLowerCase().indexOf('dsc_');
    }

    function getPinUrl($postTitle) {
        var metaUrl = $('meta[property="pinterest:url"]').attr('content');

        if (metaUrl.length) {
            return metaUrl;
        }

        if ('/' === window.location.pathname) {
            return $postTitle.find('a').attr('href');
        }

        return window.location.href;
    }

    function getPinDescription(imageAlt, $postTitle) {
        var metaDescription = $('meta[property="pinterest:description"]').attr('content');

        if (metaDescription.length) {
            return metaDescription;
        }

        if (imageDoesNotHaveCustomAltText(imageAlt)) {
            return createPinDescriptionFromPostTitleAndDomainName($postTitle);
        }

        return imageAlt;
    }

    function isMouseOverButton(mouseX, mouseY) {
        var buttonPosition = $button.offset(),
            buttonX = buttonPosition.left,
            buttonY = buttonPosition.top - $(window).scrollTop(),
            buttonWidth = $button.width(),
            buttonHeight = $button.height(),
            mouseWithinButtonWidth = (mouseX >= buttonX && mouseX <= buttonX + buttonWidth),
            mouseWithinButtonHeight = (mouseY >= buttonY && mouseY <= buttonY + buttonHeight);

        return (mouseWithinButtonWidth && mouseWithinButtonHeight);
    }

    function positionHoverButton($image) {
        var imagePosition = $image.position();

        switch (config.hoverButtonPosition) {
            case 'top-right':
                $button.css('left', imagePosition.left + $image.width() - $button.width() - config.hoverButtonOffset + 'px');
                $button.css('top', imagePosition.top + config.hoverButtonOffset + 'px');
                break;
            default:
                // Defaults to 'top-left'.
                $button.css('left', imagePosition.left + config.hoverButtonOffset + 'px');
                $button.css('top', imagePosition.top + config.hoverButtonOffset + 'px');
        }
    }

    function handleMouseoverImages() {
        var $image = $(this), // jshint ignore:line
            $postTitle = $(config.postTitleSelector),
            imageSource = this.src, // jshint ignore:line
            imageAlt = $.trim(this.alt), // jshint ignore:line
            url = getPinUrl($postTitle),
            description = getPinDescription(imageAlt, $postTitle),
            link = '<a class="pin-it">' + config.hoverButtonMarkup + '</a>';

        $image.css('opacity', config.hoverImageOpacity);

        $button.html(link);

        positionHoverButton($image);

        $button.find('> a').attr('href', createPinterestPopupUrl(url, imageSource, description));

        $button.show();
    }

    function handleMouseoutImages(event) {
        if (!isMouseOverButton(event.clientX, event.clientY)) {
            $(event.delegateTarget).css('opacity', 1.0);

            $button.hide();
        }
    }

    function addPinterestHoverButton() {
        var button = '<span class="pin-it-button-hover"></span>';

        $button = $(button).appendTo('body');

        $button.css('display', 'inline-block');
        $button.css('position', 'absolute');

        $button.hide();

        $images.on('mouseover', handleMouseoverImages);
        $images.on('mouseout', handleMouseoutImages);
    }

    function initialize() {
        var metaHover = $('meta[property="pinterest:hover"]').attr('content');

        if ('true' === metaHover) {
            addPinterestHoverButton();
        }
    }

    initialize();

}(jQuery));

},{}],2:[function(require,module,exports){
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

},{}]},{},[1,2]);
