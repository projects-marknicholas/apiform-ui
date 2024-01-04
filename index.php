<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>
<body>

<div class="container login-container">
    <div class="row">
      <div class="col-md-12 login-form">
        <h3>Login</h3>
        <form id="loginForm">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" placeholder="Enter your email address">
          </div>

          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password">
          </div>

          <button type="button" class="btn btn-primary btn-block" onclick="submitForm()">Login</button>

          <div class="form-group mt-3">
            <a href="forgot-password" class="float-left">Forgot Password?</a>
            <a href="register" class="float-right">Create New Account</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Custom JS -->
  <script>
    function submitForm() {
      // Get form data
      var formData = new FormData(document.getElementById('loginForm'));

      // Make AJAX request
      $.ajax({
        url: 'http://localhost/apiform/login', // Update the URL to match your endpoint
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
          // Display SweetAlert with response message
          Swal.fire({
            icon: response.success ? 'success' : 'error',
            title: response.message,
            showConfirmButton: false,
            timer: 1500
          });

          // Optionally, you can redirect to another page on success
          if (response.success) {
            window.location.href = 'dashboard';
          }
        },
        error: function(error) {
          // Display SweetAlert with error message
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while processing your request.',
          });
        }
      });
    }
  </script>
</body>
</html>