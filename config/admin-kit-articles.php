<?php

// config for AdminKit/Articles
return [
    'image' => [
        'enabled' => true,

        // see https://filamentphp.com/docs/2.x/forms/fields#file-upload
        'crop_aspect_ratio' => '16:9',
        'resize_target_width' => '1280',
        'resize_target_height' => '720',
        'preview_height' => '250',

        // see https://spatie.be/docs/laravel-medialibrary/v10/converting-images/defining-conversions#content-a-single-conversion
        'thumb_width' => '160',
        'thumb_height' => '90',
        'thumb_sharpen' => '10',
    ],

    'seo' => [
        'enabled' => true,
    ],
];
