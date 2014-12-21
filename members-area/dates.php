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
                                    <a href="preferences.php">Preferences</a>
                                </li>
                                <li>
                                    <a href="dates.php" class="active">Important Dates</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                          <a href="credits.php">Credits</a>
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
                        <h1 class="page-header">Important Dates</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <p><b>9th of December</b> - Applications Closed.</p>
            <p><b>14th of December</b> - Wishlists must be updated by this point. If you don’t have at least one game in the $6.99-15 (See currency conversion below) range. It’s fine if it’s under, but if you have only high priced games and you specified wishlist only, then you will be removed from the secret santa list.</p>
            <p><b>15th of December</b> - Secret Santas assigned.</p>
            <p><b>21st of December</b> - Gifts bought and checked.</p>
            <p><b>22nd of December</b> - Start of distribution process.</p>
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
