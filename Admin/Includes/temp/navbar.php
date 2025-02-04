<?php
include("Includes/temp/header.php");
$statment = $connect->prepare("SELECT * FROM users");
$statment->execute();
$result = $statment->fetch();
?>
<nav class="navbar navbar-expand-lg  bg-dark ">
  <a class="navbar-brand" href="dashboard.php">DashBoard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="users.php">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="categories.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">Posts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="comments.php">Comments</a>
      </li>
      <li class="nav-item">
        <a href="password.php?page=all&user_id=<?php echo $result['user_id'] ?>" class="btn btn-warning">Change My Password </i></a>
      </li>
      <a class="nav-link btn btn-success ml-3" href="logout.php">Log out</a>
      </li>
    </ul>
  </div>
</nav>
