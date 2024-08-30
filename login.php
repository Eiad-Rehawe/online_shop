<?php 
require_once ('classes/Session.php');
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

$sess = new Session;
$errors = $sess->get('errors');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div>
    <?php 
    if ($errors != null && is_array($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo '<p>' . htmlspecialchars($error) . '</p>';
        }
        echo '</div>';
        $sess->clear('errors');
    }
    ?>
</div>

<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">
    <div class="signup">
        <form action="handlers/SignUp.php" method="post">
            <label for="chk" aria-hidden="true">Sign up</label>
            <input type="text" name="firstname" placeholder="First name" required style="height:40px;">
            <input type="text" name="lastname" placeholder="Last name" required style="height:40px;">
            <input type="date" name="birthdate" value="01/01/2024" required style="height:40px;">
            <input type="email" name="email" placeholder="Email" required style="height:40px;">
            <input type="password" name="password" placeholder="Password" required style="height:40px;">
            <button>Sign up</button>
        </form>
    </div>
    <div class="login">
        <form action="handlers/Login.php" method="post">
            <label for="chk" aria-hidden="true">Login</label>
            <input type="email" name="email" placeholder="Email" required="" style="height:40px;">
            <input type="password" name="password" placeholder="Password" required="" style="height:40px;">
            <button>Login</button>
        </form>
    </div>
</div>

</body>
</html>
