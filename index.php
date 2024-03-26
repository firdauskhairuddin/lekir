<?php
session_start();

include('./core/configuration.php');
include('./core/function.php');

$secure = new Secure();
if(isset($_SESSION['user_id'])){header('Location: ./dashboard.php');}

?>
<!doctype html>
<!--
* LEKIR - Vulnerable by design to learn common web vulnerability
* Learning Environment for Cybersecurity through Immersive Real-world scenarios
* By Firdaus Khairuddin
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo htmlentities($title); ?></title>
    <link rel="icon" href="./static/lekir.jpeg" type="image/png">
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column" style="background:#F6FFFE;">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/lekir.jpeg" height="150" alt=""></a>
        </div>

        <div class="card card-md">
          <div class="card-body">
            <form role="form" action="api.php?action=login" method="POST" autocomplete="off" novalidate>
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="username" name="username" autocomplete="off">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" class="form-control"  placeholder="password" name="password" autocomplete="off">
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Login</button>
              </div>
            </form>
          </div>
        </div>
        <br>
        <?php
        if(isset($_SESSION['message'])){
          echo "<center class='alert alert-".htmlentities($_SESSION['alert'])."'>".htmlentities($_SESSION['message'])."</center>";
          unset($_SESSION['message']);
        } else {
          echo "<center class='alert alert-info'>LEKIR - Vulnerable by Design</center>";
        }
        ?>
      </div>

      <div class="footer">
        <center>
          <small>Develop by <a href="https://github.com/firdauskhairuddin" target="_blank">@firdauskhairuddin</a></small>
        </center>
      </div>
    </div>

    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
  </body>
</html>