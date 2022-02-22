<?php

session_start();

if(isset($_SESSION['userId'])){

} else {
    header("Location: index.php?error=loginerror");
    exit();
}

require "./functions/header.php";

$service_link = "";
$path = "";
$q1_param = "";
$q1_value = "";
$q2_param = "";
$q2_value = "";

if(isset($_POST['submit']))
{
  $service_link = $_POST["service_link"];
  $path = $_POST["path"];
  $q1_param = $_POST["q1_param"];
  $q1_value = $_POST["q1_value"];
  $q2_param = $_POST["q2_param"];
  $q2_value = $_POST["q2_value"];
}

?>
<!-- Source - https://www.w3schools.com/php/php_ajax_php.asp -->
<script>
function runTest() {

  url = document.getElementById('testUrl').value;
  console.log(url);

  if (url == '') {
    document.getElementById("testResult").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("testResult").innerHTML = this.response;
        console.log(this.status);
      } else {
        console.log("error");
      }
    };
    xmlhttp.open("GET", url);
    xmlhttp.send();

  }
}
</script>


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
                      Test Service
                  </p>
                  <div class="panel-block box">
                    <form name="form1" method="post" action="test_service.php" class="box">
                      <div class="field is-horizontal">
                        <div class="field-label is-normal">
                          <label class="label">Service link: </label>
                        </div>
                        <div class="field-body">
                          <div class="field is-narrow">
                            <div class="control">
                              <div class="select is-fullwidth">
                                <select name="service_link">
                                  <option value="0">Service Link</option>
                                  <?php
                                  $sql = "SELECT id, title, link, reg_date FROM services";
                                  $result = $conn->query($sql);

                                  if ($result->num_rows > 0) {
                                    // output data of each row
                                      while($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row["link"]}'>{$row["link"]}</option>";

                                      }
                                    } else {
                                        echo "<option value='null'>null</option>";
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="field is-horizontal">
                        <div class="field-label is-normal">
                          <label class="label">Path:</label>
                        </div>
                        <div class="field-body">
                          <div class="field">
                            <div class="control">
                              <input class="input is-info" type="text" placeholder="Path" name="path">
                            </div>
                            <p class="help is-info">
                                This field is only required for the Proxy - path names : count/, total/, check/
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="field is-horizontal">
                        <div class="field-label is-normal">
                          <label class="label">Query String:</label>
                        </div>
                        <div class="field-body">
                          <div class="field">
                            <p class="control is-expanded">
                              <input class="input" type="text" placeholder="Parameter" name="q1_param">
                            </p>
                          </div>
                          <div class="field">
                            <p class="control is-expanded">
                              <input class="input" type="text" placeholder="Value" name="q1_value">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="field is-horizontal">
                        <div class="field-label is-normal">
                          <label class="label">Query String:</label>
                        </div>
                        <div class="field-body">
                          <div class="field">
                            <p class="control is-expanded">
                              <input class="input" type="text" placeholder="Parameter" name="q2_param">
                            </p>
                          </div>
                          <div class="field">
                            <p class="control is-expanded">
                              <input class="input" type="text" placeholder="Value" name="q2_value">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="field is-horizontal">
                        <div class="field-label">
                          <!-- Left empty for spacing -->
                        </div>
                        <div class="field-body">
                          <div class="field">
                            <div class="control">
                              <button type="submit" name="submit" class="button is-primary">
                                Build test link
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <article class="message">
                    <div class="message-header">
                      <p>Test Result</p>
                    </div>
                    <div class="message-body">
                      <?php

                          $q_data = array($q1_param => $q1_value , $q2_param => $q2_value);

                          $test_link = $service_link.$path."?".http_build_query($q_data);

                          if(isset($_POST['submit']))
                          {
                            echo '<h2 class="subtitle is-5">'.$test_link.'</h2>';

                            echo '<form name="form2" method="POST" onsubmit="runTest();">';
                            echo '<input type="hidden" id="testUrl" name="testUrl" value="'.$test_link.'">';
                            echo '<button type="submit" name="request-submit" class="button is-warning">Send Request</button>';
                            echo '</form>';
                            echo '<div class="field" id="testResult"></div>';
                          }
                       ?>
                    </div>
                  </article>
              </article>
            </div>
        </div>
    </div>
</section>

<?php

require "./functions/footer.php";

?>
