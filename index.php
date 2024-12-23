<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
    rel="shortcut icon"
    href="./assets/icons/favicon.ico"
    type="image/x-icon" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Create Post Box -->
<div class="create-post">
  <div class="create-post-header">
    <img src="./assets/images/user.png" alt="" />
    <button data-bs-toggle="modal" data-bs-target="#create_post_modal">What's on your mind?</button>
  </div>
  <div class="divider-0"></div>
  <div class="create-post-footer">
    <ul>
      <li>
        <div class="post-icon"></div>
        <span>Live Video</span>
      </li>
      <li>
        <div class="post-icon"></div>
        Photo/video
      </li>
      <li>
        <div class="post-icon"></div>
        Feeling/Activity
      </li>
    </ul>
  </div>
</div>

<!-- Modal for Creating a Post -->
<div class="modal fade" id="create_post_modal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="createPostForm" enctype="multipart/form-data">
          <div class="form-group">
            <label for="postText">What's on your mind?</label>
            <textarea id="postText" name="postText" class="form-control" rows="4" required></textarea>
          </div>
          <div class="form-group">
            <label for="postImage">Upload Image/Video</label>
            <input type="file" id="postImage" name="postImage" class="form-control-file" />
          </div>
          <div class="form-group">
            <label for="postFeeling">Feeling/Activity</label>
            <input type="text" id="postFeeling" name="postFeeling" class="form-control" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="./assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<!-- AJAX Script for Form Submission -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Handle form submission
    $("#createPostForm").on("submit", function(e) {
      e.preventDefault(); // Prevent default form submission

      var formData = new FormData(this); // Get the form data, including the file

      $.ajax({
        url: "submit_post.php",  // PHP script to handle the submission
        type: "POST",
        data: formData,
        contentType: false,  // Disable content type to allow file uploads
        processData: false,  // Don't process the data (allow files)
        success: function(response) {
          if (response === 'success') {
            alert("Post created successfully!");
            $('#createPostForm')[0].reset();  // Reset the form after submission
            $('#create_post_modal').modal('hide');  // Close the modal
          } else {
            alert("Error creating post. Please try again.");
          }
        },
        error: function() {
          alert("An error occurred. Please try again.");
        }
      });
    });
  });
</script>
    
</body>
</html>

