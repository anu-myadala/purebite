# Fix for redirect.php user_id NULL Error

## Problem
The error `Column 'user_id' cannot be null in /var/www/html/redirect.php:33` occurs when:
- A user visits the site without being logged in
- The `redirect.php` file tries to insert a database record with `user_id = NULL`
- The database column `user_id` is set to NOT NULL

## Solution Options

### Option 1: Use a Guest User ID (Recommended)
If your database doesn't allow NULL for `user_id`, use a default guest/anonymous user ID (e.g., 0 or -1).

**Steps:**
1. Create a guest user record in your database with ID = 0 (or another ID)
2. The fixed `redirect.php` already uses `$guest_user_id = 0` by default
3. Update the value if your guest user has a different ID

### Option 2: Make user_id NULLable in Database
If you want to allow NULL values for anonymous users:

```sql
ALTER TABLE redirects MODIFY COLUMN user_id INT NULL;
```

Then update `redirect.php` to handle NULL properly (see Option 3 code below).

### Option 3: Skip Database Insert for Anonymous Users
Only log redirects when a user is logged in:

```php
if ($user_id !== null) {
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO redirects (user_id, redirect_url, redirect_type, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $user_id, $redirect_url, $redirect_type);
    $stmt->execute();
    $stmt->close();
}
```

## Current Fix
The provided `redirect.php` uses **Option 1** by default, setting `$guest_user_id = 0` when `user_id` is NULL.

## Configuration
Make sure to set these environment variables in Render:
- `DB_HOST` - Your database host
- `DB_USER` - Your database username
- `DB_PASSWORD` - Your database password
- `DB_NAME` - Your database name

## Testing
1. Test with a logged-in user (should work normally)
2. Test with an anonymous user (should use guest user ID)
3. Verify no errors appear in Render logs

## Additional Notes
- The redirect will always work, even if database logging fails
- Errors are logged but don't break the user experience
- Check your database schema to determine which option works best for you

