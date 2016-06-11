<?php return [
        'custom' => [
            'name' => [
                'required' => 'Nós precisamos de saber o seu nome!',
            ],
            'email' => [
                'required' => 'Endereço de e-mail é necessário',
                'email' => 'Por favor, forneça um endereço de e-mail válido!'
            ],
            'subject' => [
                'required' => 'Por favor, forneça o assunto da sua mensagem!',
            ],
            'message' => [
                'required' => 'Campo de mensagem é necessário!',
            ],
            'reCAPTCHA' => [
                'required' => 'Teste humano falhou, verifique a caixa de seleção reCAPTCHA'
            ]
        ]
    ];
