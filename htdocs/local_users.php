<?php
// local_users.php — Company C (Render Project) - Local API endpoint
header('Content-Type: application/json');

$data = [
    "users" => [
        [
            "id" => 1,
            "name" => "Mary Smith",
            "email" => "mary.smith@email.com",
            "role" => "Admin",
            "status" => "active",
            "joined_date" => "2025-11-01"
        ],
        [
            "id" => 2,
            "name" => "John Wang",
            "email" => "john.wang@email.com",
            "role" => "User",
            "status" => "active",
            "joined_date" => "2025-10-18"
        ],
        [
            "id" => 3,
            "name" => "Alex Bington",
            "email" => "alex.bington@email.com",
            "role" => "Moderator",
            "status" => "inactive",
            "joined_date" => "2025-09-15"
        ],
        [
            "id" => 4,
            "name" => "Linda Green",
            "email" => "linda.green@email.com",
            "role" => "User",
            "status" => "active",
            "joined_date" => "2025-11-10"
        ],
        [
            "id" => 5,
            "name" => "David Lee",
            "email" => "david.lee@email.com",
            "role" => "Moderator",
            "status" => "active",
            "joined_date" => "2025-10-25"
        ],
        [
            "id" => 6,
            "name" => "Sophia Turner",
            "email" => "sophia.turner@email.com",
            "role" => "Admin",
            "status" => "inactive",
            "joined_date" => "2025-09-30"
        ]
    ],
    "timestamp" => date("Y-m-d H:i:s")
];

echo json_encode($data, JSON_PRETTY_PRINT);
?>

