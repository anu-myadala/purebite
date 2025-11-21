<?php 
$pageTitle = "Contacts — PureBite Beauty";
include "includes/header.php"; 

$filename = __DIR__ . '/contacts.txt';
$contacts = [];

if (file_exists($filename) && is_readable($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $parts = explode('=', $line, 2);
        if (count($parts) == 2) {
            $contacts[trim($parts[0])] = trim($parts[1]);
        }
    }
}
?>

<h1>Contact</h1>
<div class="contact-card">
  <p><strong>Company:</strong> <?= htmlspecialchars($contacts['company_name'] ?? 'PureBite Beauty'); ?></p>
  <p><strong>Address:</strong> <?= htmlspecialchars($contacts['address'] ?? '—'); ?></p>
  <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($contacts['email'] ?? ''); ?>"><?= htmlspecialchars($contacts['email'] ?? ''); ?></a></p>
  <p><strong>Phone:</strong> <a href="tel:<?= htmlspecialchars($contacts['phone'] ?? ''); ?>"><?= htmlspecialchars($contacts['phone'] ?? ''); ?></a></p>
</div>

<?php include("includes/footer.php"); ?>
