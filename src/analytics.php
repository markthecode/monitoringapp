<?php

session_start();

if(isset($_SESSION['userId'])){

} else {
    header("Location: index.php?error=loginerror");
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
                      Analytics
                  </p>
                  <div class="panel-block box">
                      <div class="control">
                          <strong>TODO</strong>
                      </div>
                      <div class="control">
                        <ol>
                          <li>log periodic status checks</li>
                          <li>log periodic connect time stamp</li>
                          <li>log periodic ping response time</li>
                          <li>Create some sorte of Cron Job to schedule checks</li>
                          <li>create visual graphs of output</li>
                        </ol>
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
