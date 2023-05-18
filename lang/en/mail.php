<?php

return [
    'vendor' => [
        'created' => [
            'subject' => 'New vendor registered',
            'message' => 'You have new vendor registered.',
            'button' => 'View profile',
        ],

        'invitation' => [
            'subject' => 'Welcome on ":service"',
            'message' => 'You have successfully registered on ":service".',
        ],
    ],

    'admin' => [
        'order' => [
            'created' => [
                'subject' => 'New order received',
                'message' => 'Incoming message.',
                'button' => 'Review order details',
            ],
        ],
    ],

    'customer' => [
        'order' => [
            'created' => [
                'subject' => 'Your order have been placed',
                'details' => 'Order details:',
                'thank' => 'Thank you for choosing our service.',
                'table' => [
                    'from' => 'from',
                    'to' => 'to',
                ],
            ],
        ],
    ],
];
