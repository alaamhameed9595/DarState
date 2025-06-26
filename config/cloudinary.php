<?php

return [
    'cloud_url' => env('CLOUDINARY_URL', 'cloudinary://your-cloud-name'),
    'cloud_name' => env('CLOUDINARY_CLOUD_NAME', 'your-cloud-name'),
    'api_key' => env('CLOUDINARY_API_KEY', 'your-api-key'),
    'api_secret' => env('CLOUDINARY_API_SECRET', 'your-api-secret'),
    'secure' => env('CLOUDINARY_SECURE', true),
    'default_image' => env('CLOUDINARY_DEFAULT_IMAGE', 'https://res.cloudinary.com/your-cloud-name/image/upload/v1234567890/default-image.jpg'),
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET', 'your-upload-preset'),
    'transformation' => [
        'width' => 800,
        'height' => 600,
        'crop' => 'fill',
        'quality' => 'auto',
    ],
];
