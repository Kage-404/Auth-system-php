<?php include_once 'header.php' ?>

    <div class="signup-form">
        <h2>Log In</h2>
        <form class="flex-col" action="includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Username/Email">
            <input type="password" name="password" placeholder="Password">
            <button class="btn" type="submit" name="submit">Log In</button>
        </form>
        <?php 
        if(isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields!</p>";
            } 
            else if ($_GET["error"] == "wronglogin") {
                echo "<p>Incorrect Login Details</p>";
            }
        }
        ?>
    </div>

<?php include_once 'footer.php' ?>