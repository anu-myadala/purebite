# Fixes Applied to Your Code

## Problem
When your teammate combined the websites, `redirect.php` was looking for `$_SESSION['user_id']` but your code only set `$_SESSION['user']` (username). This caused NULL user_id errors.

## What I Fixed (On Your End)

### 1. **Updated `login/verify.php`**
   - Now sets both `$_SESSION['user']` AND `$_SESSION['user_id']` when users log in
   - Generates a consistent numeric ID from the username
   - This ensures `redirect.php` can always find `user_id` in the session

### 2. **Updated `includes/header.php`**
   - Automatically ensures `user_id` is set if `user` exists but `user_id` doesn't
   - Uses a session helper for consistency
   - Works even if someone accesses pages directly without going through login

### 3. **Created `includes/session_helper.php`**
   - Helper functions for consistent session management
   - `ensureUserID()` - Makes sure user_id is always set when user is logged in
   - `getCurrentUserID()` - Safely gets user_id
   - `isLoggedIn()` - Checks login status

### 4. **Updated `login/logout.php`**
   - Now properly clears both `user` and `user_id` from session
   - Ensures clean logout

## How It Works

When a user logs in:
- Your code sets `$_SESSION['user'] = "admin"` (or whatever username)
- Now it ALSO sets `$_SESSION['user_id'] = [numeric ID]`
- The ID is generated from the username using a hash function, so it's consistent

When `redirect.php` runs:
- It can now find `$_SESSION['user_id']` and won't get NULL
- No more database errors!

## Testing

1. **Test login**: Log in and check that both session variables are set
2. **Test pages**: Visit any page - user_id should be automatically set if user is logged in
3. **Test logout**: Logout should clear both session variables

## What Your Teammate Needs to Do

Your teammate still needs to:
1. Use the fixed `redirect.php` I created (or apply the same fix to their version)
2. Make sure their database allows the user_id values you're generating (0-999999 range)

But your code is now compatible and won't cause the NULL error!

## Notes

- The user_id is generated from username using `crc32()` hash, so it's consistent
- If you later add a real database with actual user IDs, you can update `getUserID()` function in `verify.php` to use those instead
- All changes are backward compatible - your existing code still works

