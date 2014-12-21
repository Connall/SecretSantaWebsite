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
                                    <a href="#" class="active">User Overview</a>
                                </li>
                                <li>
                                    <a href="secretsanta.php">Secret Santa</a>
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
                        <h1 class="page-header">User Overview</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <h3>Notifcations</h3>
            <?php
              $conn = mysqli_connect($SERVERHOST, $USERNAME, $PASSWORD, $DBNAME);
              $info = $conn->query("SELECT * FROM users WHERE steamid='".$steamprofile['steamid']."';");

              $info = $info->fetch_assoc();

              if ($steamprofile['communityvisibilitystate'] != $info['profilevisibility'] || $steamprofile['profilestate'] != $info['profilestate'] || $steamprofile['personaname'] != $info['personname'] || $steamprofile['profileurl'] != $info['profileurl']) {
                $conn->query("UPDATE users SET profilevisibility='".$steamprofile['communityvisibilitystate']."', profileurl='".$steamprofile['profileurl']."', profilestate=".$steamprofile['profilestate'].", personname=".$steamprofile['personaname']." WHERE steamid='".$steamprofile['steamid']."';");
              }

              if ($info['wishlist'] == 1 && $info['profilevisibility'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>You have indicated you would like a game from your wishlist. However, your steam profile is set to private. This may cause problems for your secret santa attempting to view your wishlist.</div>";
              }


            ?>
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

                                          $information = $conn->query("SELECT personname, profileurl, wishlist, tisusername, tisconfirmed, secretsanta, backupbuyer, extrainfo FROM users where steamid=".$steamprofile['steamid'].";");

                                          $information = $information->fetch_assoc();



                                          if ($information['backupbuyer'] == 0) {
                                            $backupbuyer = "<div class='alert alert-info'>You have not volunteered to be a backup buyer.</div>";
                                          } else {
                                            $backupbuyer = "<div class='alert alert-info'>You have volunteered to be a backup buyer. Thanks!</div>";
                                          }

                                          if ($information['wishlist'] == 1) {
                                            $wishlistchoice = "Wishlist";
                                          } elseif ($information['wishlist'] == 0) {
                                            $wishlistchoice = "Any game from Steam.";
                                          } else {
                                            $wishlistchoice = "ERROR";
                                          }

                                          if ($information['secretsanta'] == 0) {
                                            $assignedperson = "<div class='alert alert-info'>You have not been assigned anyone yet.</div>";
                                          } else {
                                            $sql = $conn->query("SELECT personname, profileurl FROM users where steamid=".$information['secretsanta'].";");
                                            $sql = $sql->fetch_assoc();
                                            $assignedperson= "You have been assigned: <a href='".$sql['profileurl']."'>".$sql['personname']."</a>";
                                          }

                                          echo "
                                            <tr>
                                                <td>Steam Name</td>
                                                <td>".$information['personname']."</td>
                                                <td>This is your public Steam name.</td>
                                            </tr>
                                            <tr>
                                                <td>Profile URL</td>
                                                <td>".$information['profileurl']."</td>
                                                <td>The URL to your Steam Profile.</td>
                                            </tr>
                                            <tr>
                                                <td>Wishlist Choice</td>
                                                <td>".$wishlistchoice."</td>
                                                <td>Whether you wished you wanted a game from your wishlist, or any game from the Steam Store.</td>
                                            </tr>
                                            <tr>
                                                <td>Backup Buyer</td>
                                                <td>".$backupbuyer."</td>
                                                <td>Whether you have specified to be a backup buyer. Want to know more? <a data-target='#myModal' data-toggle='modal'>Click here!</a></td>
                                                <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                <h4 class='modal-title' id='myModalLabel'>Backup Buyer</h4>
                                                            </div>
                                                            <div class='modal-body'>
                                                                Backup buyers are sometimes called upon, if someone never recieves their present for one reason or another. Generally the responsibility of the backup buyer is that, should they be called upon they will buy a game for a secondary person at a moments notice. You should never say yes to this, if you don't think you could perform the role later on.
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </tr>
                                            <tr>
                                                <td>Assigned Person</td>
                                                <td>".$assignedperson."</td>
                                                <td>The person you have been assigned to buy a gift for.</td>
                                            </tr>
                                            <tr>
                                                <td>Extra Information</td>
                                                <td>".$information['extrainfo']."</td>
                                                <td>The extra information you have provided.</td>
                                            </tr>";
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
