<?php
  // Check if the 'user_data' cookie is set
  if (isset($_COOKIE['user_data'])) {
      // Decode the serialized user data
      $userData = json_decode($_COOKIE['user_data'], true);

      // Display the user's name
      //echo '<li class="nav-item text-white">Welcome, ' . $userData['firstname'] . ' ' . $userData['lastname'] . '</li>';
  }
?>