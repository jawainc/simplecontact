<?php return [
        'custom' => [
            'name' => [
                'required' => 'Naam is een verplicht veld.',
            ],
            'email' => [
                'required' => 'E-mail is een verplicht veld. ',
                'email' => 'Geen geldig e-mailadres opgegeven.'
            ],
            'subject' => [
                'required' => 'Onderwerp is een verplicht veld.',
            ],
            'message' => [
                'required' => 'Bericht is een verplicht veld.',
            ],
            'reCAPTCHA' => [
                'required' => 'De reCAPTCHA checkbox moet geselecteerd zijn.'
            ]
        ]
    ];