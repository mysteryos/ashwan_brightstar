<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 24/02/2016
 * Time: 16:13
 */

return  [
    'js' => [
        'development' => [
            '/vendors/bower_components/jquery/dist/jquery.js',
            '/vendors/bower_components/bootstrap/dist/js/bootstrap.js',
            '/vendors/bower_components/Waves/dist/waves.js',
            '/vendors/bootstrap-growl/bootstrap-growl.min.js',
            '/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.js',
            '/js/functions.js'
        ],
        'production' => [
            '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
            '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js',
            '/vendors/bower_components/Waves/dist/waves.min.js',
            '/vendors/bootstrap-growl/bootstrap-growl.min.js',
            '/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js',
            '/js/functions.js'
        ]
    ],

    'css' => [
        'development' => [
            '/vendors/bower_components/animate.css/animate.css',
            '/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.css',
            '/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css',
            '/css/app.css'
        ],
        'production' => [
            '/vendors/bower_components/animate.css/animate.min.css',
            '/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
            '/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.css',
            '/css/app.css'
        ]
    ]
];