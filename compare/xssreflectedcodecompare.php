<?php
// Determine the base path based on current directory depth
$current_path = $_SERVER['PHP_SELF'];
$base_path = './';
if (strpos($current_path, '/vulnerabilities/') !== false) {
    $parts = explode('/vulnerabilities/', $current_path);
    if (isset($parts[1]) && strpos($parts[1], '/') !== false) {
        $base_path = '../../';
    } else {
        $base_path = '../';
    }
} elseif (strpos($current_path, '/tools/') !== false || strpos($current_path, '/compare/') !== false || strpos($current_path, '/components/') !== false) {
    $base_path = '../';
}

session_start();
include($base_path . 'core/configuration.php');
include($base_path . "core/function.php");

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set("display_errors", 1);
?>
<!doctype html>
<!--
* LEKIR - Vulnerable by design to learn common web vulnerability
* Learning Environment for Cybersecurity through Immersive Real-world scenarios
* By Firdaus Khairuddin
-->
<html lang='en'>
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo htmlentities($title); ?></title>
    <link rel="icon" href="<?php echo $base_path; ?>static/lekir.jpeg" type="image/png">
    <!-- CSS files -->
    <link href="<?php echo $base_path; ?>dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="<?php echo $base_path; ?>dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="<?php echo $base_path; ?>dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="<?php echo $base_path; ?>dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="<?php echo $base_path; ?>dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url("https://rsms.me/inter/inter.css");
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: 'cv03', "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="<?php echo $base_path; ?>dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      

      <?php include($base_path . "components/top_navbar.php"); ?>
      <?php include($base_path . "components/header.php"); ?>

      <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-12">
                <div class="card card-lg">
                  <div class="card-body" style="background-color: #E5E4E2;">
                      <div class="markdown">

                      <h1>Cross Site Scripting - Reflected</h1>
                      <hr>
                      <h3>Low Security Source Code <a href="xssreflectedlow.php" class="btn btn-primary float-end">Go to level</a></h3>
                      <br>
                      <pre style="background:white;border: 1px solid #000;">
                        <?php
                        highlight_file($base_path . "sourcecode/xssreflectedlowcode.txt");
                        ?>
                      </pre>
                      <br>
                      <h3>Medium Security Source Code <a href="xssreflectedmedium.php" class="btn btn-primary float-end">Go to level</a></h3>
                      <br>
                      <pre style="background:white;border: 1px solid #000;">
                        <?php
                        highlight_file($base_path . "sourcecode/xssreflectedmediumcode.txt");
                        ?>
                      </pre>
                      <br>
                      <h3>High Security Source Code <a href="xssreflectedhigh.php" class="btn btn-primary float-end">Go to level</a></h3>
                      <br>
                      <pre style="background:white;border: 1px solid #000;">
                        <?php
                        highlight_file($base_path . "sourcecode/xssreflectedhighcode.txt");
                        ?>
                      </pre>
                      <br>
                      <h3>Impossible Security Source Code <a href="xssreflectedimpossible.php" class="btn btn-primary float-end">Go to level</a></h3>
                      <br>
                      <pre style="background:white;border: 1px solid #000;">
                        <?php
                        highlight_file($base_path . "sourcecode/xssreflectedimpossiblecode.txt");
                        ?>
                      </pre>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include($base_path . "components/footer.php");?>

    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>