<?php
session_start();
include './connect.php';
if(isset($_POST['submit'])) {
  $email = $_SESSION["email"];
  $selectedRoleId = (int)$_POST["role"];

  $sql = "UPDATE utilisateur SET idRole = ? WHERE email = ?";
  $stmt = mysqli_prepare($conn, $sql);

  if($stmt) {
    $stmt->bind_param("is", $selectedRoleId, $email);
    if($stmt->execute()) {
      $stmt->close();

      if($selectedRoleId == 2) {
        $sql1 = "SELECT idUser FROM utilisateur WHERE email = ?";
        $stmt1 = mysqli_prepare($conn, $sql1);

        if($stmt1) {
          $stmt1->bind_param("s", $email);
          $stmt1->execute();
          $result1 = $stmt1->get_result();

          if($result1->num_rows > 0) {
            $user = $result1->fetch_assoc();
            $stmt1->close();

            $sql2 = "INSERT INTO panier (idUser) VALUES (?)";
            $stmt2 = mysqli_prepare($conn, $sql2);

            if($stmt2) {
              $stmt2->bind_param("i", $user['idUser']);
              if($stmt2->execute()) {
                $stmt2->close();
                $sql3 = "SELECT * FROM panier WHERE idUser = ".$user['idUser'];
                $result3 = mysqli_query($conn, $sql3);

                if($result3) {
                  $row1 = mysqli_fetch_assoc($result3);

                  $_SESSION['idPanier'] = $row1['idPanier'];

                }

                header("Location: login.php");
                exit();
              } else {
                echo "Error executing panier query: ".$stmt2->error;
              }
            }
          }
        }
      } else {
        header("Location: login.php");
        exit();
      }
    }
  }
}

$title = 'Role Selection';
include './tmp/head.php'
  ?>

<section class="bg-green-200 h-screen flex items-center justify-center">
  <div class="bg-white  rounded-lg shadow-lg p-8 max-w-md w-full">
    <div class="text-center">
      <h2 class="text-2xl font-semibold mb-4 text-green-600">Select Your Role</h2>
    </div>
    <form action="" method="post">
      <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
      <div class="grid grid-cols-2 gap-4">
        <div
          class="cursor-pointer p-4 border border-green-300 dark:border-green-700 rounded-md bg-[#50B041]  hover:bg-green-100  transition duration-200">
          <input type="radio" value="1" name="role" id="admin" class="hidden" required>
          <label for="admin" class="block text-center font-bold text-xl text-white hover:dark:text-black ">Admin</label>
        </div>

        <div
          class="cursor-pointer p-4 border border-green-300 dark:border-green-700 rounded-md bg-[#50B041]   hover:bg-green-100 transition duration-200">
          <input type="radio" value="2" name="role" id="client" class="hidden" required>
          <label for="client"
            class="block text-center font-bold text-xl text-white hover:dark:text-black ">Client</label>
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="submit"
          class="py-2 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-green-400"
          name='submit'>Submit</button>
      </div>
    </form>
  </div>
</section>



<?php include './tmp/footer.php' ?>