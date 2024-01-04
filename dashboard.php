<?php include 'cookie.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <?php include 'navbar.php'; ?>

  <!-- Main content -->
  <div class="container mt-5">

    <!-- Create Form Button -->
    <button type="button" class="btn btn-primary mt-5 mb-3" data-toggle="modal" data-target="#createFormModal">Create Form</button>

    <!-- Table with Fields 1 to 5 -->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Form Name</th>
          <th scope="col">Form Enable</th>
          <th scope="col">Success URL</th>
          <th scope="col">Failed URL</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="formDataBody">

      </tbody>
    </table>
  </div>

  <!-- Create Form Modal -->
  <div class="modal fade" id="createFormModal" tabindex="-1" role="dialog" aria-labelledby="createFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createFormModalLabel">Create Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form for creating a new form -->
          <form id="createFormForm">
            <div class="form-group">
              <label for="formName">Form Name:</label>
              <input type="text" class="form-control" name="form_name" id="formName" placeholder="Enter Form Name" required>
            </div>
            <div class="form-group">
              <label for="successUrl">Success URL:</label>
              <input type="url" class="form-control" name="success_url" id="successUrl" placeholder="Enter Success URL" required>
            </div>
            <div class="form-group">
              <label for="failedUrl">Failed URL:</label>
              <input type="url" class="form-control" name="failed_url" id="failedUrl" placeholder="Enter Failed URL" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="submitCreateForm()">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- View Form Modal -->
  <div class="modal fade" id="viewFormModal" tabindex="-1" role="dialog" aria-labelledby="viewFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewFormModalLabel">View Form Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Form Name:</strong> <span id="viewFormName"></span></p>
          <p><strong>Form Enable:</strong> <span id="viewFormEnable"></span></p>
          <p><strong>Success URL:</strong> <span id="viewSuccessUrl"></span></p>
          <p><strong>Failed URL:</strong> <span id="viewFailedUrl"></span></p>
          <p><strong>Form Endpoint:</strong> <span id="viewFormEndpoint"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
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
  <!-- Custom JS -->
  <!-- Custom JS -->
  <script>
    // Function to fetch and display data in the table
    function displayFormData() {
      $.ajax({
        url: 'http://localhost/apiform/api/read-all-user-form/<?php echo $userData['userToken'];?>',
        type: 'GET',
        success: function(response) {
          // Clear existing rows
          $('#formDataBody').empty();

          // Populate the table with the received data
          $.each(response, function(index, formData) {
            var newRow = '<tr>' +
              '<td>' + formData.form_name + '</td>' +
              '<td>' + formData.enable_form + '</td>' +
              '<td>' + formData.success_url + '</td>' +
              '<td>' + formData.failed_url + '</td>' +
              '<td>' +
              '<button class="btn btn-success" onclick="viewForm(\'' + formData.form_name + '\', \'' + formData.enable_form + '\', \'' + formData.success_url + '\', \'' + formData.failed_url + '\', \'' + formData.form_token + '\')">View</button>' +
              '<button class="btn btn-danger" onclick="deleteForm(\'' + formData.form_token + '\')">Delete</button>' +
              '</td>' +
              '</tr>';
            $('#formDataBody').append(newRow);
          });
        },
        error: function(error) {
          // Handle error
          console.log('Error fetching data:', error);
        }
      });
    }

    // Initial data display
    displayFormData();

    // Function to submit create form
    function submitCreateForm() {
      // Get form data
      var formData = new FormData(document.getElementById('createFormForm'));

      // Make AJAX request
      $.ajax({
        url: 'http://localhost/apiform/api/create-form/<?php echo $userData['userToken'];?>',
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
          // Display SweetAlert with response message
          Swal.fire({
            icon: response.success ? 'error' : 'success',
            title: response.message,
            showConfirmButton: false,
            timer: 1500
          });

          // Optionally, you can reload or update the forms table on success
          if (!response.success) {
            // Reload or update the forms table
            displayFormData();
          }

          // Close the modal
          $('#createFormModal').modal('hide');
        },
        error: function(error) {
          // Display SweetAlert with error message
          Swal.fire({
            icon: 'success',
            title: 'Error',
            text: 'An error occurred while processing your request.',
          });
        }
      });
    }

    // Function to display form details in a popup
    function viewForm(formName, formEnable, successUrl, failedUrl, form_token) {
      $('#viewFormModal').modal('show');
      // Update modal content with form details
      $('#viewFormName').text(formName);
      $('#viewFormEnable').text(formEnable);
      $('#viewSuccessUrl').text(successUrl);
      $('#viewFailedUrl').text(failedUrl);
      $('#viewFormEndpoint').text('http://localhost/apiform/send/' + form_token);
    }

    // Function to delete a form
    function deleteForm(formToken) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // Make AJAX request to delete form
          $.ajax({
            url: 'http://localhost/apiform/api/delete-form/' + formToken,
            type: 'DELETE',
            success: function(response) {
              // Display SweetAlert with response message
              Swal.fire({
                icon: response.success ? 'error' : 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              });

              // Reload or update the forms table on success
              displayFormData();
            },
            error: function(error) {
              // Display SweetAlert with error message
              Swal.fire({
                icon: 'success',
                title: 'Error',
                text: 'An error occurred while processing your request.',
              });
            }
          });
        }
      });
    }
  </script>
</body>
</html>
