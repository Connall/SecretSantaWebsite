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
                <a class="navbar-brand" href="../index.php">Secret Santa</a>
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
                                    <a href="secretsanta.php">Secret Santa</a>
                                </li>
                                <li>
                                    <a href="preferences.php" class="active">Preferences</a>
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
                        <h1 class="page-header">Preferences</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <h3>Information About Person</h3>
              <?php

                $conn = mysqli_connect($SERVERHOST, $USERNAME, $PASSWORD, $DBNAME);

                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                  header("Location: creationfailed.php");
                }


                $user = $conn->query("SELECT wishlist, backupbuyer FROM users where steamid=".$steamprofile['steamid'].";");

                $user = $user->fetch_assoc();

                $wishlist = $user['wishlist'];
                $backupbuyer = $user['backupbuyer'];

                if ($wishlist == 0) {
                  $wishlist = "You are currently set to recieve any game from the Steam store. To change that click below.";
                  $changewishlist = "Click here to only get games from your wishlist!";
                  $wishlistlink = "change.php?wishlist=1";
                } else {
                  $wishlist = "You are set you only recieve games from your wishlist. To change that, click below.";
                  $changewishlist = "Click here to get any game from the Steam store.";
                  $wishlistlink = "change.php?wishlist=0";
                }

                if ($backupbuyer == 1) {
                  $backupbuyer = "You are currently set to be a backup buyer. To change that, click below.";
                  $changebackupbuyer = "Click here to remove yourself from the backup buyer list.";
                  $buyerlink = "change.php?backupbuyer=0";
                } else {
                  $backupbuyer = "You are currently set to not be a backup buyer. To change that, click below.";
                  $changebackupbuyer = "Click here to add yourself to the backup buyer list.";
                  $buyerlink = "change.php?backupbuyer=1";
                }

                echo "
                  <p>Here you are able to change a couple of preferences for the Secret Santa. Once people are assigned to each other, you will not be able to change this. So make sure these are right while you can!</p>
                  <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Backup Buyer
                        </div>
                        <div class='panel-body'>
                            <p>".$backupbuyer."</p>
                        </div>
                        <div class='panel-footer'>
                            <a href='".$buyerlink."'>".$changebackupbuyer."</a>
                        </div>
                    </div>
                  <div class='panel panel-primary'>
                        <div class='panel-heading'>
                            Wishlist Option
                        </div>
                        <div class='panel-body'>
                            <p>".$wishlist."</p>
                        </div>
                        <div class='panel-footer'>
                            <a href='".$wishlistlink."'>".$changewishlist."</a>
                        </div>
                    </div>
                ";
              ?>
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
