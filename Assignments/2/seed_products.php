<?php

DB::table('products')->insert([
    [
        "title" => "iPhone 5s",
        "brand" => "Apple",
        "price" => 2999,
        "description" => "Apples iPhone 5S är uppgraderingen av iPhone 5. 5S har samma mått och skärmtyp som föregångaren, men telefonen har nu en fingeravtrycksläsare samt ny kamera med tvåfärgsblixt",
        "image" => "http://www.three.co.uk/static/images/device_pages/MobileVersion/Apple/iPhone_5s/Space_Grey/desktop/1.jpg"
    ],
    [
        "title" => "Galaxy s7",
        "brand" => "Samsung",
        "price" => 5999,
        "description" => "Den nya generationen av Galaxy Smartphones är här. Samsung Galaxy S7 och S7 Edge har den perfekta balansen mellan funktion och form.",
        "image" => "https://www.att.com/catalog/en/skus/images/samsung-galaxy%20s7%20edge-blue%20coral-450x350.png"
    ],
    [
        "title" => "G6",
        "brand" => "LG",
        "price" => 6499,
        "description" => "På samma sätt som normalstora telefoner från ett par år sedan känns pyttesmå idag vänjer man sig snabbt vid den stora skärmen i LG G6.",
        "image" => "http://www.lg.com/uk/images/mobile-phones/md05804712/gallery/G6-medium01.jpg"
    ],
    [
        "title" => "Elite",
        "brand" => "HP",
        "price" => 5499,
        "description" => "HP Elite x3 kombinerar persondatorns kraft och produktivitet, surfplattans mobilitet och smarta telefonens smidiga uppkoppling.",
        "image" => "https://media.dustin.eu/image/193471/400/320/hp-elite-x3-dual-sim-headset-64gb-svart-krom.jpg"
    ]
]);
