<?php return [
        'custom' => [
            'name' => [
                'required' => '请填入您的姓名!',
            ],
            'email' => [
                'required' => 'Email地址须填写',
                'email' => '请提供一个有效的电子邮件地址!'
            ],
            'subject' => [
                'required' => '请填写您消息的主题!',
            ],
            'message' => [
                'required' => '消息内容字段须填写!',
            ],
            'reCAPTCHA' => [
                'required' => '人机测试失败, 请打勾 reCAPTCHA。'
            ]
        ]
    ];
