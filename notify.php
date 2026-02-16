<?php

header("Content-Type: application/json");

// ====== CONFIG ======
$webhook = "https://gpbankvn.webhook.office.com/webhookb2/0bb253ba-640b-42e5-8f9c-a31aee391483@f0e4aa1a-e71b-4dc9-b33f-869a95c9d0cb/IncomingWebhook/032713cfc66c49e680c54e1de1c93ab4/5bb350ee-c6ec-4c74-b86b-9a8c94ad229c/V2_pYBYdbmaV_Rssy6x_s84xbSaA9H4GSCcDpEvgAEVaM1";


// ====== GET DATA ======
$message = $_POST['data'] ?? 'Có người vừa quay trúng thưởng!';

// ====== TEAMS MESSAGE CARD ======
$payload = [
    "@type" => "MessageCard",
    "@context" => "http://schema.org/extensions",
    "themeColor" => "00FF00",
    "summary" => $message,
    "sections" => [
        [
            "activityTitle" => "🎉 Thông báo hệ thống",
            "text" => $message
        ]
    ]
];

// ====== SEND ======
$ch = curl_init($webhook);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

if ($result === false) {
    echo json_encode([
        "success" => false,
        "error" => curl_error($ch)
    ]);
} else {
    echo json_encode([
        "success" => true,
        "response" => $result
    ]);
}

curl_close($ch);
