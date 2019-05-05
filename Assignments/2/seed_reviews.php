<?php

DB::table('reviews')->insert([
    [
        "name" => "Anton",
        "comment" => "Superbra telefon, lite gammal bara",
        "grade" => 5,
        "product_id" => 1
    ],
    [
        "name" => "Johan",
        "comment" => "Äpplen är goda!",
        "grade" => 3,
        "product_id" => 1
    ],
    [
        "name" => "Johan",
        "comment" => "Den är helt okej!",
        "grade" => 3,
        "product_id" => 2
    ],
    [
        "name" => "Anton",
        "comment" => "Bra, men har möjlighet att förbättras!",
        "grade" => 4,
        "product_id" => 2
    ],
    [
        "name" => "Anton",
        "comment" => "LG förvånar med en såhär bra telefon!",
        "grade" => 5,
        "product_id" => 3
    ],
    [
        "name" => "Johan",
        "comment" => "Bra med många alternativ på Android-marknaden",
        "grade" => 4,
        "product_id" => 3
    ],
    [
        "name" => "Johan",
        "comment" => "Gör de fortfarande Windows-telefoner? Behöver blir bättre!",
        "grade" => 3,
        "product_id" => 4
    ],
    [
        "name" => "Anton",
        "comment" => "Klart bättre än förväntat!",
        "grade" => 4,
        "product_id" => 4
    ]
]);
