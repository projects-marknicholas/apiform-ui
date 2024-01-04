<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="container login-container">
    <div class="row">
      <div class="col-md-12 login-form">
        <h3>Forgot Password</h3>
        <form id="forgotPasswordForm">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address" required>
          </div>

          <button type="button" class="btn btn-primary btn-block" onclick="submitForgotPassword()">Submit</button>

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
    function submitForgotPassword() {
      // Get form data
      var formData = new FormData(document.getElementById('forgotPasswordForm'));

      // Make AJAX request
      $.ajax({
        url: 'http://localhost/apiform/forgot-password', // Update the URL to match your forgot password endpoint
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

          // Reset the form on success
          if (response.success) {
            document.getElementById('forgotPasswordForm').reset();
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
