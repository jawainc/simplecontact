<?php return [
        'custom' => [
            'name' => [
                'required' => 'Nous avons besoin de savoir votre nom!',
            ],
            'email' => [
                'required' => 'Le courriel est obligatoire',
                'email' => 'Veuillez fournir une adresse valide!'
            ],
            'subject' => [
                'required' => 'Veuillez fournir le sujet de votre message!',
            ],
            'message' => [
                'required' => 'Le champ Message est requis!',
            ],
            'reCAPTCHA' => [
                'required' => 'Test humain échoué, veuillez cocher la case reCAPTCHA'
            ]
        ]
    ];