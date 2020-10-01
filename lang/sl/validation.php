<?php return [
        'custom' => [
            'name' => [
                'required' => 'Vaše ime je obvezno!',
            ],
            'email' => [
                'required' => 'E-poštni naslov je obvezen!',
                'email' => 'Prosimo, vnesite veljaven e-poštni naslov!'
            ],
            'subject' => [
                'required' => 'Prosimo, vnesite temo vašega sporočila!',
            ],
            'message' => [
                'required' => 'Polje sporočilo je obvezno!',
            ],
            'reCAPTCHA' => [
                'required' => 'Človeški test ni uspel, potrdite potrditveno polje reCAPTCHA'
            ]
        ]
    ];