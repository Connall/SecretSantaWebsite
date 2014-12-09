<?php
    require ('../steamauth/steamauth.php');
    require('../config.php');
    if (!isset($_SESSION['steamid']) || !isset($_COOKIE['ipb_member_id'])) {
      header("Location: ../index.php");
    } else {
      include ('../steamauth/userInfo.php');
    }

    $backupbuyer = $_GET['backupbuyer'];
    $wishlist = $_GET['wishlist'];

    $conn = mysqli_connect($SERVERHOST, $USERNAME, $PASSWORD, $DBNAME);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      header("Location: preferences.php");
    }


    if ($wishlist != null) {
      if (is_numeric($wishlist) && ($wishlist == 1 || $wishlist == 0)) {
        $conn->query("UPDATE users SET wishlist=".$wishlist." WHERE steamid=".$steamprofile['steamid'].";");
      }
    }

    if ($backupbuyer != null) {
      if (is_numeric($backupbuyer) && ($backupbuyer == 1 || $backupbuyer == 0)) {
        $conn->query("UPDATE users SET backupbuyer=".$backupbuyer." WHERE steamid=".$steamprofile['steamid'].";");
      }
    }

    header("Location: preferences.php");

?>
