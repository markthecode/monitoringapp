<?php

session_start();

if(isset($_SESSION['userId'])){

} else {
    header("Location: index.php?error=loginerror");
    exit();
}

require "./functions/header.php";

$username = $_SESSION['userName'];

?>
<section>
    <div class="container">
        <div class="columns">
            <div class="column"><br></div>
        </div>
    </div>
</section>
<section>
    <div class="container is-max-desktop">
        <div class="columns is-centered">
            <div class="column is-10">
              <article class="panel is-primary box">
                  <p class="panel-heading">
                      Dashboard
                  </p>
                  <div class="panel-block box">
                      <p class="control">
                          <a class="button is-warning p-2 m-2" href="./add_service.php" title="Add Service">Add Service</a>
                      </p>
                      <p class="control">
                          <a class="button is-light p-2 m-2" href="./test_service.php" title="Test Service">Test Service</a>
                      </p>
                      <p class="control">
                          <a class="button is-light p-2 m-2" href="./analytics.php" title="Analytics">Analytics</a>
                      </p>
                      <?php
                      // used to test is the monitoring service has a connection to the internet

                      $status =  network_check('http://www.google.com');

                      //testing status output
                      //$status = 200;
                      //$status = 404;
                      //$status = 500;

                      if ($status >= 200 && $status <= 308){
                        echo '<p class="button is-success">Monitoring Status: '.$status.'</p>';
                      } elseif ($status >= 400 && $status <= 499) {
                        echo '<p class="button is-warning">Monitoring Status: '.$status.'</p>';
                      }elseif ($status >= 500 && $status <= 599) {
                        echo '<p class="button is-danger">Monitoring Status: '.$status.'</p>';
                      }

                      ?>

                  </div>
                  <div><h1 class="title is-4 has-text-primary">Monitored Services</h1>
                      <?php
                      if (isset($_GET['delete'])) {
                          if ($_GET['delete'] == "success") {
                            echo '<div class="panel-block box">';
                            echo '<p><strong>Record deleted successfully!</strong></p>';
                            echo '</div>';
                         }
                      }
                      ?>
                      <?php
                        $sql = "SELECT id, title, link, reg_date FROM services";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {

                            echo '<form class="box" action="./delete_service.php" method="post">';
                            echo connect_service($row["link"]);
                            echo '<h1 class="title is-4">' . $row["title"]. '</h1>';
                            echo '<h2 class="subtitle">' . $row["link"]. '</h2>';
                            echo '<label class="label">Start Time</label>
                                  <div class="control">
                                  <p class = "p-2 m-2">'.$row["reg_date"].'</p>
                                  </div>';
                            echo '<input type="hidden" id="serviceId" name="serviceId" value="'.$row["id"].'">';
                            echo '<input type="hidden" id="serviceTitle" name="serviceTitle" value="'.$row["title"].'">';
                            echo '<button class="button is-danger" type="submit" name="delete-submit">DELETE</button>';

                            echo '</form>';


                          }
                        } else {
                          echo "0 results";
                        }
                        $conn->close();
                      ?>

                  </div>
              </article>
            </div>
        </div>
    </div>
</section>
<?php

function network_check($url) {

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);

  $output = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  return $httpcode;
}

function connect_service($url) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);

  $output = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $totaltime = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
  curl_close($ch);

  //echo '<p class="control">Count Service - HTTP Code: ' .$httpcode. '<p>';
  //echo '<p class="control">Total Time: ' .$totaltime. '<p>';

  if ($httpcode >= 200 && $httpcode <= 308){
    echo '<p class="button is-success is-medium is-fullwidth mb-2">Service Status: '.$httpcode.'</p>';
  } elseif ($httpcode >= 400 && $httpcode <= 499) {
    echo '<p class="button is-warning is-medium is-fullwidth mb-2">Service Status: '.$httpcode.'</p>';
  } elseif ($httpcode >= 500 && $httpcode <= 599) {
    echo '<p class="button is-danger is-medium is-fullwidth mb-2">Service Status: '.$httpcode.'</p>';
  }

}


require "./functions/footer.php";

?>
