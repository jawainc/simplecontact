<?php return [
        'custom' => [
            'name' => [
                'required' => 'We need to know your name!',
            ],
            'email' => [
                'required' => 'Email address is required',
                'email' => 'Please provide a valid email address!'
            ],
            'subject' => [
                'required' => 'Please provide subject of your message!',
            ],
            'message' => [
                'required' => 'Message field is required!',
            ],
            'reCAPTCHA' => [
                'required' => 'Human test fail, please check reCAPTCHA checkbox'
            ]
        ]
    ];