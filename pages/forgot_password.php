<?php
require_once 'config.php';
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Check if user exists
        $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows === 1) {
            // Update password
            $update = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
            $update->bind_param("ss", $hashed_password, $username);

            if ($update->execute()) {
                $success = "Password reset successfully. You may now log in.";
            } else {
                $error = "Failed to update password.";
            }
            $update->close();
        } else {
            $error = "Username not found.";
        }
        $check->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
  <div class="bg-white p-10 w-full max-w-4xl text-center shadow-xl ring-1 ring-gray-200/50 min-h-[700px]">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="/LAPE-PRO/PROJECT-ROOT/assets/images/logo.PNG" alt="LAPE Logo" class="h-24 w-24 object-contain" />
    </div>

    <!-- Title -->
    <h2 class="text-green-600 font-bold text-sm uppercase mb-8">RESET YOUR PASSWORD</h2>

    <!-- Reset Form -->
    <form method="POST" class="space-y-5">
      <input type="text" name="username" placeholder="Username" required
        class="block mx-auto w-3/4 max-w-sm px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-400" />

      <input type="password" name="new_password" placeholder="New Password" required
        class="block mx-auto w-3/4 max-w-sm px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-400" />

      <input type="password" name="confirm_password" placeholder="Confirm New Password" required
        class="block mx-auto w-3/4 max-w-sm px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-400" />

      <?php if (!empty($error)): ?>
        <div class="text-red-500 text-sm"><?php echo $error; ?></div>
      <?php elseif (!empty($success)): ?>
        <div class="text-green-600 text-sm"><?php echo $success; ?></div>
      <?php endif; ?>

      <button type="submit"
        class="block mx-auto w-3/4 max-w-sm bg-gray-900 text-white py-3 rounded-lg hover:bg-black transition">
        Save New Password
      </button>

      <a href="sign_in.php" class="block text-center text-sm text-blue-600 hover:underline mt-2">Back to Login</a>
    </form>
  </div>
</body>
</html>
