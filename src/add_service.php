<?php

session_start();

if(isset($_SESSION['userId'])){

} else {
    header("Location: ./index.php?error=loginerror");
    exit();
}

require "./functions/header.php";

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
                      Add Service
                  </p>
                  <?php
                      if(isset($_GET['error'])) {
                          echo '<div class="panel-block box">';
                          if($_GET['error'] == "emptyfields") {
                              echo '<p><strong>Fill in all fields!</strong><p>';
                          $emptyfields = "is-danger";
                          } else if($_GET['error'] == "invalidlink") {
                              echo '<p><strong>Invalid Link!</strong><p>';
                          }
                          echo '</div>';
                      } else if (isset($_GET['add'])) {
                          if ($_GET['add'] == "success") {
                            echo '<div class="panel-block box">';
                            echo '<p><strong>Success Added Service!</strong></p>';
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
                                  <label class="label">Title</label>
                                  <div class="control">
                                      <input class="input <?php echo $emptyfields; ?>" type="text" name="title"
                                          placeholder="Title">
                                  </div>
                              </div>
                              <div class="field">
                                  <label class="label">Link</label>
                                  <div class="control">
                                      <textarea class="textarea <?php echo $emptyfields; ?>" name="link" placeholder="Link - http://www ..." rows="5"></textarea>
                                  </div>
                              </div>
                              <button class="button is-warning" type="submit" name="add-submit">ADD</button>
                              <a class="button is-danger" href="./dashboard.php" title="CANCEL">CANCEL</a>
                              <?php
                              if (isset($_GET['add'])) {
                                  if ($_GET['add'] == "success") {
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
