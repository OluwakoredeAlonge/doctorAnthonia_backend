<?php

return [
    'account_sid'    => env('TWILIO_SID', ''),
    'auth_token'     => env('TWILIO_AUTH_TOKEN', ''),
    'phone_number'   => env('TWILIO_PHONE_NUMBER', ''),       // regular SMS number (if any)
    'whatsapp_from'  => env('TWILIO_WHATSAPP_FROM', ''),      // WhatsApp sandbox / business number
];
