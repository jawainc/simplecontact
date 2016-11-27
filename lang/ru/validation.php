<?php return [
        'custom' => [
            'name' => [
                'required' => 'Укажите имя',
            ],
            'email' => [
                'required' => 'Укажите почту',
                'email' => 'Введите правильный адрес почты'
            ],
            'subject' => [
                'required' => 'Укажите тему сообщения',
            ],
            'message' => [
                'required' => 'Введите текст сообщения',
            ],
            'reCAPTCHA' => [
                'required' => 'Тест на человека провален, проверьте reCAPTCHA'
            ]
        ]
    ];
