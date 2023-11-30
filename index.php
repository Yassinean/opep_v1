<?php
include './connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password,firstName,lastName) VALUES ('$email', '$password','$firstName','$lastName')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['email'] = $email;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        header("Location: role_selection.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
$title = 'Signup Page';
include './tmp/head.php'


?>

<div class=" min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <img class="mx-auto h-24 w-auto" src="./admin/uploads/logo.png" alt="Workflow">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-green-800">Sign up for free</h2>
    </div>

    <form action="" method="post">
      <div class="mb-4">
        <label for="firstName" class="block text-sm font-medium text-gray-600 dark:text-gray-400">First Name:</label>
        <input type="text" name="firstName" id="firstName" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-800 focus:border-green-500 focus:z-10 sm:text-sm" required>
      </div>

      <div class="mb-4">
        <label for="lastName" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Last Name:</label>
        <input type="text" name="lastName" id="lastName" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-800 focus:border-green-500 focus:z-10 sm:text-sm" required>
      </div>

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Email:</label>
        <input type="email" name="email" id="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-800 focus:border-green-500 focus:z-10 sm:text-sm" required>
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Password:</label>
        <input type="password" name="password" id="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-800 focus:border-green-500 focus:z-10 sm:text-sm" required>
      </div>

      <div class="d-flex justify-between">
        <button type="submit" class="py-2 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-green-400">Signup</button>
        <button class="py-2 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-green-400"><a href="login.php">Login</a></button>
      </div>

    </form>
  </div>

<?php include './tmp/footer.php' ?>

