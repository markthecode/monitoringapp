<?php


include('./functions/dbconn.php');

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Service Monitoring</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
  <link rel="stylesheet" href="./css/ui.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>


  <script>

    $(document).ready(function () {

      // Check for click events on the navbar burger icon
      $(".navbar-burger").click(function () {

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");

      });
    });
  </script>
</head>
<nav class="navbar is-transparent navbar-add">
  <div class="container is-max-desktop">
    <div class="navbar-brand">
      <div class="navbar-item">
        <span class="iconify logo l-icon" data-icon="mdi:robot-excited-outline" data-inline="false"></span>
        <h1 class="logo">monitoringdroid</h1>
      </div>
      <span class="navbar-burger has-text-light" data-target="navbarMenuHeroA">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </div>
    <div id="navbarMenuHeroA" class="navbar-menu navbar-add">
      <div class="navbar-end">
        <a class="navbar-item my-navbar" href="./index.php">
          Home
        </a>
        <a class="navbar-item my-navbar" href="#" target="_blank">
          Launch Wordapp
        </a>
        <div class="navbar-item has-dropdown is-hoverable my-navbar">
          <a class="navbar-link is-arrowless my-navbar" id="opener" href="./about.php">
            About
          </a>
          <div class="navbar-dropdown">
            <!-- <a class="navbar-item">
              Contact
            </a> -->
            <div class="navbar-item">
              <p>monitoringdroid</p>
            </div>
            <hr class="navbar-divider">
            <div class="navbar-item">
              Version 1.0.0
            </div>
          </div>
        </div>

        <?php
          if(isset($_SESSION['userId'])) {
            echo '<span class="navbar-item">
                  <form action="./functions/user_setup.php" method="post">
                    <button type="submit" name="logout-submit" class="button is-primary">Logout</button>
                  </form>
                  </span>';

            echo '<span class="navbar-item">
                  <a class="button is-info" href="./dashboard.php" title="Dashboard">Dashboard</a>
                  </span>';
            }
        ?>

      </div>
    </div>
  </div>
</nav>
