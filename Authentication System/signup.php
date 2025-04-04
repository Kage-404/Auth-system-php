<?php include_once 'header.php' ?>

    <div class="signup-form">
        <h2>Sign Up</h2>
        <form class="flex-col" action="includes/signup.inc.php" method="POST">
            <input type="text" name="name" placeholder="Fullname">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="passwordRepeat" placeholder="Repeat Password">
            <button class="btn" type="submit" name="submit">Sign Up</button>
        </form>
        <?php 
        if(isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields!</p>";
            } 
            else if ($_GET["error"] == "invalidusername") {
                echo "<p>Enter a valid username!</p>";
            }
            else if ($_GET["error"] == "invalidemail") {
                echo "<p>Enter a valid email!</p>";
            }
            else if ($_GET["error"] == "passwordsdontmatch") {
                echo "<p>Invalid matching passwords!</p>";
            }
            else if ($_GET["error"] == "stmtfailed") {
                echo "<p>Something went wrong! Try again</p>";
            }
            else if ($_GET["error"] == "none") {
                echo "<p>Sign-Up successfully!</p>";
            }
        }
        ?>
    </div>

<?php include_once 'footer.php' ?>