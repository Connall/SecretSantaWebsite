<?php
    require ('../steamauth/steamauth.php');
    require('../config.php');
    if (!isset($_SESSION['steamid']) || !isset($_COOKIE['ipb_member_id'])) {
      header("Location: ../index.php");
    } else {
      include ('../steamauth/userInfo.php');
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Secret Santa - Members Area</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">The Indie Stone Secret Santa</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                  <?php if (!isset($_SESSION['steamid'])) {

                  } else {
                    echo "<div style='height: 50px; padding: 15px 15px;'><p><a href=".$steamprofile['profileurl'].">Welcome, ".$steamprofile['personaname']."</a></p></div>";
                  }
                  ?>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="active">
                            <a href="#"><i class="fa fa-users fa-fw"></i> Members Dashboard<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php">User Overview</a>
                                </li>
                                <li>
                                    <a href="secretsanta.php" class="active">Secret Santa</a>
                                </li>
                                <li>
                                    <a href="preferences.php">Preferences</a>
                                </li>
                                <li>
                                    <a href="dates.php">Important Dates</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                          <a href="credits.php">Credits</a>
                        </li>
                        <li>
                          <a href="../steamauth/logout.php">Log Out</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Secret Santa</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <h3>Information About Person</h3>
            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Information</th>
                                            <th>Value</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                          $conn = mysqli_connect($SERVERHOST, $USERNAME, $PASSWORD, $DBNAME);

                                          if (!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                          }


                                          $user = $conn->query("SELECT secretsanta FROM users where steamid=".$steamprofile['steamid'].";");

                                          $user = $user->fetch_assoc();

                                          if ($user['secretsanta'] == 0) {
                                            echo "
                                              <div class='panel panel-primary'>
                                                <div class='panel-heading'>
                                                  Not so fast!
                                                </div>
                                                <div class='panel-body'>
                                                  <p>Hey there! It's cool to see you're enthusiastic, however the sign ups are still ongoing so we can't assign anyone to you yet. Once we can you'll see a bunch of funky info about the person you're trying to buy for.</p>
                                                </div>
                                                <div class='panel-footer'>

                                                </div>
                                              </div>
                                            ";
                                          } else {
                                              $target = $conn->query("SELECT personname, profileurl, wishlist, tisusername, profilevisibility, extrainfo FROM users WHERE steamid=".$user['secretsanta']."");
                                              $target = $target->fetch_assoc();

                                              if ($target['wishlist'] == 1) {
                                                $wishlistchoice = "Wishlist Game";
                                              } else {
                                                $wishlistchoice = "Any game from the store.";
                                              }

                                              $wishlistrequest = "";

                                              if ($target['profilevisibility'] == 1) {
                                                $wishlistrequest = "<div class='alert alert-info'><p>This persons profile is private, in order to get their wishlist you can make a request for their wishlist information.</p></div>";
                                              }

                                              echo "
                                                <tr>
                                                    <td>Steam Name</td>
                                                    <td>".$target['personname']."</td>
                                                    <td>Their Steam name.</td>
                                                </tr>
                                                <tr>
                                                    <td>Profile URL</td>
                                                    <td><a href='".$target['profileurl']."'>".$target['profileurl']."</a></td>
                                                    <td>The URL to their Steam Profile.</td>
                                                </tr>
                                                <tr>
                                                    <td>Wishlist Choice</td>
                                                    <td>".$wishlistchoice."".$wishlistrequest."</td>
                                                    <td>Whether they wanted a game from their wishlist, or any game from the Steam Store.</td>
                                                </tr>
                                                <tr>
                                                    <td>Extra information</td>
                                                    <td>".$target['extrainfo']."</td>
                                                    <td>Extra information the user has provided.</td>
                                                </tr>";
                                          }




                                        ?>
                                    </tbody>
                                </table>
                            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

</body>

</html>
