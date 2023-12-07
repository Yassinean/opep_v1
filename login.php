<?php
include './connect.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
  $query = mysqli_query($conn, $sql);

  if (!$query) {
    die("Error: " . mysqli_error($conn));
  }

  $user = mysqli_fetch_assoc($query);
  if ($user != '' && password_verify($password, $user['passwordUser'])) {
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['idUser'] = $user['idUser'];

    $Role = $user['idRole'];
    $_SESSION['idRole'] = $Role;

    if ($Role == 1) {
      header('Location: admin/dashboard.php');
      exit();
    } else {
      header('Location: ./home.php');
      exit();
    }
  } else {
    echo '<script>alert("Invalid email or password. Please try again.");</script>';
  }
}

$title = 'Login Page';
include './tmp/head.php';
?>
<div class=" min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <img class="mx-auto h-24 w-auto" src="./admin/uploads/logo.png" alt="Workflow">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-green-800">Sign in to your account</h2>
    </div>
    <form action="" method="post">
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-600">Email:</label>
        <input type="email" name="email"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-800 focus:border-green-500 focus:z-10 sm:text-sm"
          required>
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-600">Password:</label>
        <input type="password" name="password"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-800 focus:border-green-500 focus:z-10 sm:text-sm"
          required>
      </div>

      <div class="text-center">
        <button type="submit" name="login"
          class="py-2 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-green-400">Login</button>
      </div>
    </form>
  </div>

  <?php include './tmp/footer.php' ?>