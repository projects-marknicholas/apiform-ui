<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <a class="navbar-brand" href="#">APIform</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Settings</a>
      </li>
    </ul>
    <!-- User's Name on the Right -->
    <?php include 'cookie.php';?>
    <span class="navbar-text" style="color: white;"><?php echo $userData['firstname'] . ' ' . $userData['lastname'];?></span>
  </div>
</nav>