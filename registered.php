<?php
    require ('steamauth/steamauth.php');
    require('config.php');
    if (!isset($_SESSION['steamid']) || !isset($_COOKIE['ipb_member_id'])) {
      header("Location: index.php");
    } else {
      include ('steamauth/userInfo.php');
    }

    $backupbuyer = $_POST["backupbuyer"];
    $wishlist = $_POST["wishlist"];
    $tisusername = $_POST["tisusername"];
    $extrainformation = $_POST["extrainfo"];

    if ($wishlist == 1) {
      $wishlist = 1;
    } else {
      $wishlist = 0;
    }

    if ($backupbuyer == 1) {
      $backupbuyer = 1;
    } else {
      $backupbuyer = 0;
    }

    $conn = mysqli_connect($SERVERHOST, $USERNAME, $PASSWORD, $DBNAME);

    $tisusername = $conn->real_escape_string($tisusername);
    $extrainformation = $conn->real_escape_string($extrainformation);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      header("Location: creationfailed.php");
    }

    $sql = $conn->query("SELECT steamid FROM users WHERE steamid=".$steamprofile['steamid']."");

    if ($sql->num_rows > 0) {
      header("Location: /members-area/index.php");
    } else {
      $sqlInsert = "INSERT INTO users (steamid, profilevisibility, profilestate, personname, profileurl, wishlist, secretsanta, backupbuyer) VALUES ('".$steamprofile['steamid']."', ".$steamprofile['communityvisibilitystate'].", ".$steamprofile['profilestate'].", '".$steamprofile['personaname']."', '".$steamprofile['profileurl']."', ".$wishlist.", '0', ".$backupbuyer.");";
      $conn->query($sqlInsert);
      $sqlInsert = "UPDATE users SET extrainfo='".$extrainformation."' WHERE steamid=".$steamprofile['steamid'].";";
      $conn->query($sqlInsert);
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

    <title>Secret Santa</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                <a class="navbar-brand" href="index.php">Secret Santa</a>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->

            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Registration Complete!</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
              <div class="panel panel-green">
                  <div class="panel-heading">
                      Success!
                  </div>
                  <div class="panel-body">
                      <p>You are being redirected to the members area.</p>
                    <?php header("refresh:5; url=http://secretsanta.theindiestone.com/members-area/index.php");
                    ?>
                  </div>
                  <div class="panel-footer">
                      Don't want to wait? <a href="/members-area/index.php">Click here.</a>
                  </div>
              </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
