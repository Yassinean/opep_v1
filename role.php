<?php
include 'php/connexion.php';
include 'php/header.php';

if(isset($_POST['role'])){
  $role = $_POST['role'];
}
?>
<div>
  <label for="Role" class="block text-sm font-medium text-gray-700">Role</label>
  <select id="Role" name="Role" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
    <option value="admin" >Admin</option>
    <option value="client" >Client</option>
  </select>
</div>
<script src="https://cdn.tailwindcss.com"></script>
</body>

</html>