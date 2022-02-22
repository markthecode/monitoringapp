<?php

session_start();

if(isset($_SESSION['userId'])){

} else {
    header("Location: ./index.php?error=loginerror");
    exit();
}

require "./functions/header.php";

if(isset($_POST['delete-submit'])){

    $serviceId = $_POST['serviceId'];
    $serviceTitle = $_POST['serviceTitle'];

} elseif (isset($_GET)) {
    $serviceId = $_GET['serviceId'];
    $serviceTitle = $_GET['serviceTitle'];
    $titleConfirm = $_GET['titleConfirm'];
}

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
                      Delete Service - <?php echo 'Title: '.$serviceTitle. ' ID: ' .$serviceId ?>
                  </p>
                  <?php
                      if(isset($_GET['error'])) {
                          echo '<div class="panel-block box">';
                          if($_GET['error'] == "emptyfields") {
                              echo '<p><strong>Fill in all fields!</strong><p>';
                          $emptyfields = "is-danger";
                          } elseif ($_GET['error'] == "nomatch") {
                              echo "<p><strong>".$serviceTitle." doesn't match ".$titleConfirm."!</strong><p>";
                          }
                          echo '</div>';
                      } else if (isset($_GET['delete'])) {
                          if ($_GET['delete'] == "success") {
                            echo '<div class="panel-block box">';
                            echo '<p><strong>Record deleted successfully!</strong></p>';
                            echo '</div>';
                          }
                      }
                  ?>
                  <!-- <div class="panel-block box">
                      <p class="control">
                          <strong>Hello</strong>
                      </p>
                  </div> -->
                  <div class="columns is-centered">
                      <div class="column">
                          <form class="box" action="./functions/service_setup.php" method="post">
                              <div class="field">
                                  <label class="label">Please confirm you want to delete this service by entering the Service Title!</label>
                                  <div class="control">
                                      <input type="hidden" id="serviceId" name="serviceId" value="<?php echo $serviceId; ?>">
                                      <input type="hidden" id="serviceTitle" name="serviceTitle" value="<?php echo $serviceTitle; ?>">
                                      <input class="input <?php echo $emptyfields; ?>" type="text" name="titleConfirm"
                                          placeholder="Title Confirmation">
                                  </div>
                              </div>
                              <button class="button is-warning" type="submit" name="delete-submit">DELETE</button>
                              <a class="button is-danger" href="./dashboard.php" title="CANCEL">CANCEL</a>
                              <?php
                              if (isset($_GET['delete'])) {
                                  if ($_GET['delete'] == "success") {
                                    echo '<a class="button is-info" href="./dashboard.php" title="Dashboard">Dashboard</a>';
                                  }
                              }
                              ?>
                          </form>
                      </div>

                  </div>
              </article>
            </div>
        </div>
    </div>
</section>

<?php

require "./functions/footer.php";

?>
