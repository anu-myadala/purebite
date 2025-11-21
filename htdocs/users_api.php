<?php
// users_api.php — PureBite Beauty (Company A)
header('Content-Type: application/json');

$data = [
    "success" => true,
    "company" => "PureBite Beauty",
    "url" => "https://anukrithimyadala.42web.io",
    "count" => 10,
    "users" => [
        [
            "name" => "Ava Morgan",
            "email" => "ava.morgan@purebitebeauty.com",
            "role" => "Skincare Specialist",
            "status" => "Active",
            "join_date" => "2024-01-20"
        ],
        [
            "name" => "Noah Carter",
            "email" => "noah.carter@purebitebeauty.com",
            "role" => "Product Developer",
            "status" => "Active",
            "join_date" => "2024-02-10"
        ],
        [
            "name" => "Luna Patel",
            "email" => "luna.patel@purebitebeauty.com",
            "role" => "Marketing Lead",
            "status" => "Active",
            "join_date" => "2024-03-05"
        ],
        [
            "name" => "Ethan Rivera",
            "email" => "ethan.rivera@purebitebeauty.com",
            "role" => "Operations Manager",
            "status" => "Active",
            "join_date" => "2024-04-01"
        ],
        [
            "name" => "Sophia Kim",
            "email" => "sophia.kim@purebitebeauty.com",
            "role" => "Formulation Chemist",
            "status" => "Active",
            "join_date" => "2024-04-22"
        ],
        [
            "name" => "Mason Clark",
            "email" => "mason.clark@purebitebeauty.com",
            "role" => "Brand Designer",
            "status" => "Active",
            "join_date" => "2024-05-18"
        ],
        [
            "name" => "Harper Davis",
            "email" => "harper.davis@purebitebeauty.com",
            "role" => "E-Commerce Manager",
            "status" => "Active",
            "join_date" => "2024-06-10"
        ],
        [
            "name" => "Isabella Flores",
            "email" => "isabella.flores@purebitebeauty.com",
            "role" => "Content Strategist",
            "status" => "Active",
            "join_date" => "2024-07-08"
        ],
        [
            "name" => "Elijah Scott",
            "email" => "elijah.scott@purebitebeauty.com",
            "role" => "Customer Support",
            "status" => "Inactive",
            "join_date" => "2024-08-02"
        ],
        [
            "name" => "Mila Thompson",
            "email" => "mila.thompson@purebitebeauty.com",
            "role" => "Social Media Coordinator",
            "status" => "Active",
            "join_date" => "2024-09-15"
        ]
    ],
    "timestamp" => date("Y-m-d H:i:s")
];

echo json_encode($data, JSON_PRETTY_PRINT);
?>
