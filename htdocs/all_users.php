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
function fetchUsers($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // ignore SSL for demo
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error || !$response) {
        return ["error" => "Could not connect to $url"];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ["error" => "Invalid JSON data from $url"];
    }

    // Lambert’s format: check if 'users' key exists
    if (isset($data['users']) && is_array($data['users'])) {
        return $data['users'];
    }

    // Simple array (like your own)
    if (isset($data[0]) && is_array($data[0])) {
        return $data;
    }

    // If data is not recognized
    return ["error" => "Unrecognized data format from $url"];
}

// === Company Endpoints ===
$companyA = fetchUsers("https://anukrithimyadala.42web.io/users_api.php");
$companyB = fetchUsers("https://lambertnguyen.cloud/api/users");
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
            <td><?= htmlspecialchars($user['status'] ?? '—') ?></td>
            <td><?= htmlspecialchars($user['join_date'] ?? '—') ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5" style="text-align:center;">No users found.</td></tr>
      <?php endif; ?>
    </table>
  <?php endforeach; ?>
</div>

<?php include("includes/footer.php"); ?>
