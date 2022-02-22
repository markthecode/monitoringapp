<?php
session_start();

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
                      About
                  </p>
                  <div class="panel-block box">
                      <p class="control">
                          <strong>Hello</strong>
                      </p>
                  </div>
              </article>
            </div>
        </div>
    </div>
</section>

<?php

require "./functions/footer.php";

?>
