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
            <div class="column is-6">
            <?php
                $printerror = "";
                $emptyfields = "";
                $printsuccess = "";

                if(isset($_GET['error'])) {
                    if($_GET['error'] == "emptyfields") {
                        $printerror = '<p>Fill in all fields</p>';
                        $emptyfields = "is-danger";

                        } else if($_GET['error'] == "loginerror") {
                            $printerror = '<p>Your Username or Password is wrong.</p>';
                            $emptyfields = "is-danger";

                    }
                } else if(!empty(($_GET['login']))) {
                    if (!empty($_GET['login'] == "success")) {
                    $printsuccess = '<p>Success! Your Logged into your account.</p>';
                    }
                }
                if(isset($_SESSION['userId'])) {
                    echo '<form action="./functions/user_setup.php" method="post" class="box">'.$printsuccess.'
                            <button type="submit" name="logout-submit" class="button is-primary p-2 m-2">Logout</button>';



                    echo '<a class="button is-info p-2 m-2" href="./dashboard.php" title="Dashboard">Dashboard</a>';


                    echo '</form>';

                } else {
                    echo '<form action="./functions/user_setup.php" method="post" class="box">'.$printerror.'
                            <div class="field">
                                <p class="control">
                                    <input type="text" class="input '.$emptyfields.'" name="username" placeholder="Username">
                                </p>
                            </div>
                            <div class="field">
                                <p class="control">
                                    <input type="password" class="input '.$emptyfields.'" name="pwd" placeholder="Password">
                                </p>
                            </div>
                            <div class="field">
                                <p class="control">
                                    <button type="submit" name="login-submit" class="button is-warning">Login</button>
                                </p>
                            </div>
                          </form>';
                }
            ?>
            </div>
        </div>
    </div>
</section>

<?php

require "./functions/footer.php";

?>
