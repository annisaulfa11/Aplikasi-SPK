<?php
include "config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {;
    $sql = "SELECT * FROM pengguna WHERE username='$_POST[username]' AND password='" . ($_POST['password']) . "'";
    if ($query = $conn->query($sql)) { if ($query->num_rows) { session_start(); while ($data = $query->fetch_array()) { $_SESSION["is_logged"] = true; $_SESSION["username"] = $data["username"]; } header('location: index.php'); } else {
header("Location: login.php"); } } else { echo "Query error!"; } } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LOGIN</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="login_style.css" />
</head>

<body>
    <section id="main" class="d-flex ">
        <div class="container">
            <div class="content d-flex justify-content-center align-item-center">
                <div class="col-sm-6">
                    <img src="img/img-01.webp" />
                </div>
                <div class="col-sm-6">
                    <h2>LOGIN</h2>
                    <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control ip" id="username"
                                placeholder="Username" autofocus="on" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control ip" id="password"
                                placeholder="Password" />
                        </div>
                        <button type="submit" class="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
        /
    </section>
</body>

</html>