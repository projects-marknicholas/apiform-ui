<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="container login-container">
    <div class="row">
      <div class="col-md-12 login-form">
        <h3>Reset Password</h3>
        <form id="resetPasswordForm">
          <div class="form-group">
            <label for="newPassword">New Password:</label>
            <input type="password" class="form-control" name="new_password" placeholder="Enter your new password" required>
          </div>

          <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your new password" required>
          </div>

          <!-- Hidden input field to store the token from the URL -->
          <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

          <button type="button" class="btn btn-primary btn-block" onclick="submitResetPassword()">Submit</button>

          <div class="form-group mt-3 text-center">
            <p>Remembered your password? <a href="./">Login here</a></p>
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
    function submitResetPassword() {
      // Get form data
      var formData = new FormData(document.getElementById('resetPasswordForm'));

      // Make AJAX request
      $.ajax({
        url: 'http://localhost/apiform/reset-password/' + formData.get('token'), // Update the URL to match your reset password endpoint
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

          // Redirect to login page on success
          if (response.success) {
            window.location.href = './'; // Update the URL to match your login page
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
