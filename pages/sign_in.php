<?php
session_start();
$error = "";

require_once 'config.php'; // Include
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;

            switch ($role) {
                case 'admin': header("Location: pages/admin.php"); break;
                case 'privileged': header("Location: pages/foreman.php"); break;
                case 'core': header("Location: pages/supervisor.php"); break;
                case 'procure': header("Location: pages/procure.php"); break;
                case 'dbadmin': header("Location: pages/dbadmin.php"); break;
                default: $error = "Unauthorized role.";
            }
            exit;
        } else {
            $error = "Invalid credentials.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LAPE Sign In</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
  <div class="bg-white p-10 w-full max-w-4xl text-center shadow-xl ring-1 ring-gray-200/50 min-h-[700px]">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="/LAPE-PRO/PROJECT-ROOT/assets/images/logo.PNG" alt="LAPE Logo" class="h-24 w-24 object-contain" />
    </div>

    <!-- Title -->
    <h2 class="text-green-600 font-bold text-sm uppercase mb-8">LAKESHORE AGRO-PROCESSORS ENTERPRISE</h2>

    <!-- Login Form -->
    <!-- Login Form -->
<form method="POST" class="space-y-5">
  <div>
    <input type="text" name="username" placeholder="Username" required
      class="block mx-auto w-3/4 max-w-sm px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-400" />
  </div>

  <div class="relative">
    <input type="password" name="password" placeholder="Password" required
      class="block mx-auto w-3/4 max-w-sm px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-400" />

    <!-- Forgot Password Link (right aligned) -->
    <div class="text-right text-sm mt-1 max-w-sm mx-auto">
      <a href="forgot_password.php" class="text-blue-600 hover:underline">Forgot password?</a>
    </div>
  </div>

  <?php if (!empty($error)): ?>
    <div class="text-red-500 text-sm"><?php echo $error; ?></div>
  <?php endif; ?>

  <button type="submit"
    class="block mx-auto w-3/4 max-w-sm bg-gray-900 text-white py-3 rounded-lg hover:bg-black transition">
    Log In
  </button>

  <!-- <button onclick="window.location.href='register.php'"
    class="block mx-auto w-3/4 max-w-sm bg-gray-900 text-white py-3 rounded-lg hover:bg-black transition">
    sign up
  </button> -->

  <a href="register.php"
    class="block text-center text-sm text-blue-600 hover:underline mt-2">Don't have an account? Sign Up</a>
</form>

  </div>
</body>
</html>
