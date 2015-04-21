module.exports = (function () {

    'use strict';

    return {
        author: {
            email: 'manovotny@gmail.com',
            name: 'Michael Novotny',
            url: 'http://manovotny.com',
            username: 'manovotny'
        },
        files: {
            browserify: 'bundle'
        },
        paths: {
            curl: 'curl_downloads',
            source: 'src',
            translations: 'lang'
        },
        project: {
            composer: {
                name: 'manovotny/wp-pinterest',
                type: 'library' // Should be `library` or `project`.
            },
            description: 'Add Pinterest integration to WordPress.',
            git: 'git://github.com/manovotny/wp-pinterest.git',
            name: 'WP Pinterest',
            slug: 'wp-pinterest',
            type: 'plugin', // Should be `plugin` or `theme`.
            url: 'https://github.com/manovotny/wp-pinterest',
            version: '1.0.0'
        }
    };

}());
