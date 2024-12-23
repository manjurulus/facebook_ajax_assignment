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

<!-- Display Data -->
<!-- Display Data -->
<div id="postContainer">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Post Text</th>
        <th>Image/Video</th>
        <th>Feeling/Activity</th>
      </tr>
    </thead>
    <tbody id="postTableBody">
      <!-- Posts will be dynamically appended here -->
    </tbody>
  </table>
</div>
<!-- End Display Data -->

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
  $(document).ready(function () {
  // Function to update serial numbers dynamically
  function updateSerialNumbers() {
    $("#postTableBody tr").each(function (index) {
      $(this).find("td:first").text(index + 1); // Update the first column with the new index
    });
  }

  // Handle form submission for new posts
  $("#createPostForm").on("submit", function (e) {
    e.preventDefault(); // Prevent default form submission

    var formData = new FormData(this);

    $.ajax({
      url: "submit_post.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response === "success") {
          var postText = $("#postText").val();
          var postFeeling = $("#postFeeling").val();
          var postImage = $("#postImage")[0].files[0]
            ? URL.createObjectURL($("#postImage")[0].files[0])
            : null;

          // Add new post as a table row
          var newPostRow = `
            <tr>
              <td>#</td> <!-- Temporary placeholder for serial -->
              <td>${postText}</td>
              <td>
                ${
                  postImage
                    ? `<img src="${postImage}" alt="Post Image" width="100"/>`
                    : ""
                }
              </td>
              <td>${postFeeling}</td>
            </tr>
          `;

          $("#postTableBody").prepend(newPostRow); // Add new row to the table
          updateSerialNumbers(); // Update serial numbers for all rows

          $("#createPostForm")[0].reset(); // Reset the form
          $("#create_post_modal").modal("hide"); // Close the modal
        } else {
          alert("Error creating post. Please try again.");
        }
      },
      error: function () {
        alert("An error occurred. Please try again.");
      },
    });
  });

  // Load existing posts
  $.ajax({
    url: "fetch_posts.php",
    type: "GET",
    success: function (data) {
      var posts = JSON.parse(data);
      var tableBody = "";

      posts.forEach(function (post, index) {
        tableBody += `
          <tr>
            <td>${index + 1}</td>
            <td>${post.post_text}</td>
            <td>
              ${
                post.post_image
                  ? `<img src="${post.post_image}" alt="Post Image" width="100"/>`
                  : ""
              }
            </td>
            <td>${post.feeling_activity}</td>
          </tr>
        `;
      });

      $("#postTableBody").html(tableBody); // Populate the table with posts
    },
    error: function () {
      alert("Failed to load posts.");
    },
  });
});



</script>
    
</body>
</html>

