<!DOCTYPE html>
<?php require_once "cfg/config.php"; ?>
<html lang="en">
  <head>
<?php
  session_start();
  if(isset($_SESSION['username']) && $_SESSION['logged']) {
      $connect = new mysqli($host, $db_user, $db_password, $db_name);
      $user = $_SESSION['username'];
      $result = $connect->query("SELECT * FROM users WHERE Login='$user'");
      $data = $result->fetch_assoc();
      if($_SESSION['username'] == $data['Login']) {
          $username = $data["First"]." ".$data["Last"];
      }
  } else {
      header("Location: login.php");
  }
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logo Nav - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/logo-nav.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="http://placehold.it/300x60?text=Logo" width="150" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="btn btn-success" href="post.php">Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><?php echo $username ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="include/logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <ul>
        <li>
          <?php
            $data = $connect->query("SELECT * FROM posts");
            $num_of_rows = mysqli_num_rows($data);
            for($i = 0; $i < $num_of_rows; $i++) {
                $post_row = $connect->query("SELECT * FROM posts WHERE post_id='$i'");
                $post = $post_row->fetch_assoc();
                echo '
                    <div id="postlist">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h3 class="pull-left">Welcome</h3>
                                        </div>
                                        <div class="col-sm-3">
                                            <h4 class="pull-right">
                                            <small><em>2014-07-30<br>18:30:00</em></small>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <div class="panel-body">
                            '.$post["text"].'
                        </div>
                    </div>';
            }
          ?>

        </li>
    </ul>
    </div>

    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
