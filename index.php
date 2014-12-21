<!DOCTYPE html>
<html lang="en">
<?php
    require ('steamauth/steamauth.php');
    require('config.php');
    if (!isset($_SESSION['steamid'])) {

    } else {
      include ('steamauth/userInfo.php');
    }
?>

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

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                <!-- /.dropdown -->
                <li>
                    <ul>
                        <li>
                          <?php if (!isset($_SESSION['steamid'])) {

                          } else {
                            echo "<div style='height: 50px; padding: 15px 15px;'><p><a href=".$steamprofile['profileurl'].">Welcome, ".$steamprofile['personaname']."</a></p></div>";
                          }
                          ?>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome Area</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <?php

              $conn = mysqli_connect($SERVERHOST, $USERNAME, $PASSWORD, $DBNAME);

              define( 'IPS_XML_RPC_DEBUG_ON'  , 0 );
              define( 'IPS_XML_RPC_DEBUG_FILE', '' );

              require( "ipboard/classXmlRpc.php" );


              $classXmlRpc	= new classXmlRpc();




              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }
        if(!isset($_SESSION['steamid'])) {
            echo "<div style='margin: 30px auto; text-align: center;'>";
            echo "<p>Hey there! In order to continue past this area and access the entire site/register for Secret Santa, you will need to login to Steam.</p>";
            steamlogin();
            echo "<br><p>Want to know what information we ask for/store? <a data-target='#myModal' data-toggle='modal'>Click here</a></p>
                  <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                      <div class='modal-dialog'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                  <h4 class='modal-title' id='myModalLabel'>Stored Information</h4>
                              </div>
                              <div class='modal-body'>
                                  We take the following information and store in into a database. <br />
                                  -Steam ID <br />
                                  -Steam alias <br />
                                  -Steam profile url <br />
                                  -Steam profile visibility <br />
                                  -Steam profile state <br />
                                  -Your preferences (From the form ahead.)<br />
                                  We do not sell on this information and we will only share certain information with the Secret Santa that is assigned to you. The database will be deleted after the Secret Santa is completed.
                              </div>
                              <div class='modal-footer'>
                                  <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                              </div>
                          </div>
                          <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                  </div>";
          echo "</div>";
          }  else {
            include ('steamauth/userInfo.php');
            $sql = $conn->query("SELECT steamid FROM users WHERE steamid=".$steamprofile['steamid']."");
                $cookie_name = "ipb_member_id";
                if (!isset($_COOKIE[$cookie_name])) {
                  echo "<p>In order to continue you need to be signed into your Indie Stone Forum Account</p>
                        <p>If you don't have cookies enabled, that could also be causing the issue.";
                } else {

                  $sql = $conn->query("SELECT steamid FROM users WHERE steamid=".$steamprofile['steamid']."");

                  if ($sql->num_rows > 0) {
                    header("Location: /members-area/index.php");
                  } else {

                    $registration = 0;

                    if ($registration == 1) {


                      echo "
                        <div class='container'>
                          <form class='form-signin' role='form' action='registered.php' method='post'>
                            <h2 class='form-signin-heading'>Secret Santa Registration</h2>
                            <br />
                            <p>Are you willing to be a backup buyer? (See thread for more details)<br />
                              <input type='radio' name='backupbuyer' value='1' required>Yes<br /><input type='radio' name='backupbuyer' value='0'>No
                            </p>
                            <p>Would you like a game bought from your wishlist, or would you like any game from the Steam store? <br />
                              <input type='radio' name='wishlist' value='1' required>I would prefer a game from my wishlist.<br /><input type='radio' name='wishlist' value='0' required>I'm feeling lucky, get me any game from the store!
                            </p>
                            <p>You understand that when you buy a game, you will be sending it to an intermediary (most likely Connall) before it gets sent to the person it's gifted to. <br />
                              <input type='checkbox' name='agreement1' value='agree' required>Yes</p>
                            </p>
                            <p>You understand that you will not receive a game until you hand in the game you should of bought to the assigned intermediary. <br />
                              <input type='checkbox' name='agreement2' value='agree2' required>Yes</p>
                            </p>
                            <p>You understand that if you do not complete instructions given to you by the necessary date, that you will be removed from the list and will in no way be reimbursed. <br />
                              <input type='checkbox' name='agreement3' value='agree3' required>Yes</p>
                            </p>
                            <label>Extra Information/Personal Game preferences. Examples help.</label>
                            <textarea class='form-control' rows='3' name='extrainfo'></textarea>
                          <button id='done' type='submit'>Sign Up</button>
                        </form>

                        </div> <!-- /container -->";
                      } else {
                        echo "<div class='container'>
                              <p>Sorry, registration is over. If you're already a member and feel this message is an error then please report it to Connall on the forums.</p>";
                      }
                    }
                  }

          }
          ?>
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
