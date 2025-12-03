<?php
$pageTitle = "All Users — PureBite Beauty";
include("includes/header.php");
?>

<h1 style="text-align:center;">All Partner Company Users</h1>
<p style="text-align:center;">Below are the users from PureBite Beauty and our partner companies.</p>
<p style="text-align:center; font-size:0.9em; color:#666; max-width:800px; margin:10px auto;">
    <strong>Note:</strong> This page displays employee/user information from three partner 
    company websites via their public API endpoints as part of a CMPE 272 academic project 
    demonstration. All data shown is publicly available through legitimate API sources.
</p>

<?php
function fetchUsers($url, $retries = 2) {
    $attempt = 0;
    
    while ($attempt <= $retries) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ignore SSL for demo
        curl_setopt($ch, CURLOPT_TIMEOUT, 15); // 15 second timeout
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Cache-Control: no-cache'
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            if ($attempt < $retries) {
                $attempt++;
                sleep(2 * $attempt); // Exponential backoff: 2s, 4s
                continue;
            }
            return ["error" => "Connection error: " . $error];
        }

        if ($httpCode == 200) {
            break; // Success, exit retry loop
        }

        // Handle specific HTTP error codes
        if ($httpCode == 429) {
            if ($attempt < $retries) {
                // Wait longer for rate limit (exponential backoff)
                $waitTime = pow(2, $attempt + 1); // 2s, 4s, 8s
                sleep($waitTime);
                $attempt++;
                continue; // Retry
            }
            return ["error" => "API rate limit exceeded. Please refresh the page in a few moments."];
        } elseif ($httpCode == 404) {
            return ["error" => "API endpoint not found"];
        } elseif ($httpCode == 503) {
            if ($attempt < $retries) {
                $attempt++;
                sleep(3 * $attempt);
                continue;
            }
            return ["error" => "Service temporarily unavailable"];
        } else {
            if ($attempt < $retries && $httpCode >= 500) {
                // Retry on server errors
                $attempt++;
                sleep(2 * $attempt);
                continue;
            }
            return ["error" => "HTTP $httpCode error from API endpoint"];
        }
    }

    if (!$response || trim($response) === '') {
        return ["error" => "Empty response from $url"];
    }

    // Check if response is HTML (not JSON)
    if (stripos($response, '<html') !== false || stripos($response, '<!DOCTYPE') !== false) {
        return ["error" => "Received HTML instead of JSON from $url"];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ["error" => "Invalid JSON: " . json_last_error_msg() . " from $url"];
    }

    // Lambert's format: check if 'users' key exists
    if (isset($data['users']) && is_array($data['users'])) {
        // Normalize field names for consistency (handle joined_date vs join_date)
        $normalized = [];
        foreach ($data['users'] as $user) {
            $normalized[] = [
                'name' => $user['name'] ?? 'Unknown',
                'role' => $user['role'] ?? ($user['position'] ?? '—'),
                'email' => $user['email'] ?? '—',
                'status' => $user['status'] ?? '—',
                'join_date' => $user['join_date'] ?? $user['joined_date'] ?? '—'
            ];
        }
        return $normalized;
    }

    // Simple array (like your own)
    if (isset($data[0]) && is_array($data[0])) {
        // Normalize field names for consistency
        $normalized = [];
        foreach ($data as $user) {
            $normalized[] = [
                'name' => $user['name'] ?? 'Unknown',
                'role' => $user['role'] ?? ($user['position'] ?? '—'),
                'email' => $user['email'] ?? '—',
                'status' => $user['status'] ?? '—',
                'join_date' => $user['join_date'] ?? $user['joined_date'] ?? '—'
            ];
        }
        return $normalized;
    }

    // If data is not recognized
    return ["error" => "Unrecognized data format from $url"];
}

// === Company Endpoints ===
// Use current site's URL for Company A
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || 
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
            (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
$companyA = fetchUsers("$protocol://$host/users_api.php");

// Add small delay to avoid rate limiting
usleep(500000); // 0.5 second delay
$companyB = fetchUsers("https://lambertnguyen.cloud/api/users");

// Add delay before Company C (most rate-limited)
usleep(1000000); // 1 second delay
$companyC = fetchUsers("https://php-mysql-hosting-project.onrender.com/api/local_users.php");

// Combine them
$companies = [
    "Company A — PureBite Beauty" => $companyA,
    "Company B — Lambert Nguyen" => $companyB,
    "Company C — Render Project" => $companyC
];
?>

<div class="container" style="max-width:900px; margin:30px auto;">
  <?php foreach ($companies as $name => $users): ?>
    <h2><?= htmlspecialchars($name) ?></h2>
    <table border="1" cellspacing="0" cellpadding="8" style="width:100%; margin-bottom:25px;">
      <tr style="background:#f9e3ef;">
        <th>Name</th><th>Role</th><th>Email</th><th>Status</th><th>Joined</th>
      </tr>

      <?php if (isset($users['error'])): ?>
        <tr><td colspan="5" style="color:red; text-align:center;">
          <?= htmlspecialchars($users['error']) ?>
        </td></tr>

      <?php elseif (is_array($users) && count($users) > 0): ?>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= htmlspecialchars($user['name'] ?? 'Unknown') ?></td>
            <td><?= htmlspecialchars($user['role'] ?? ($user['position'] ?? '—')) ?></td>
            <td><?= htmlspecialchars($user['email'] ?? '—') ?></td>
            <td><?= htmlspecialchars(ucfirst($user['status'] ?? '—')) ?></td>
            <td><?= htmlspecialchars($user['join_date'] ?? $user['joined_date'] ?? '—') ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5" style="text-align:center;">No users found.</td></tr>
      <?php endif; ?>
    </table>
  <?php endforeach; ?>
</div>

<?php include("includes/footer.php"); ?>
