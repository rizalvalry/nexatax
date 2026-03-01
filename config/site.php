<?php

return [
    'blocked' => env('SITE_BLOCKED', false),
    'blocked_title' => env('SITE_BLOCKED_TITLE', 'Website Tidak Dapat Diakses'),
    'blocked_message' => env('SITE_BLOCKED_MESSAGE', 'Website tidak bisa diakses. Hubungi developer untuk membuka akses.'),
    'developer_phone' => env('DEVELOPER_PHONE', ''),
    'developer_email' => env('DEVELOPER_EMAIL', ''),
    'developer_whatsapp' => env('DEVELOPER_WHATSAPP', ''),
];
