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
session_regenerate_id(true);
include($base_path . 'core/configuration.php');
include($base_path . "core/function.php");

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set(\"display_errors", 0);

setcookie('user_id', "1", time() + 3600, "/');

if(isset($_COOKIE['user_id'])){
                        
  $id = $_COOKIE['user_id'];

  try{

    // Vulnerable code: directly inserting user input into the SQL query
    $query = 'SELECT user_id, user_name, user_role FROM user WHERE user_id = '$id' LIMIT 1;';

    // Execute the query and fetch the results
    $result = mysqli_query($mysqli, $query); 

    $num = @mysqli_num_rows( $result );

    if( $num > 0 ) {
      // If exist
      $data = '<pre>User ID exists in the database.</pre>';
    } else {

      // Might sleep a random amount
      if( rand( 0, 5 ) == 3 ) {
          sleep( rand( 2, 4 ) );
      }
      
      // User wasn't found, so the page wasn't!
      header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );

      // If dont exist
      $data = '<pre>User ID is MISSING from the database.</pre>';
    }
      
    $mysqli->close();

  } catch (Exception $e) {

    $data = '<pre>User ID is MISSING from the database.</pre>';
  }

}
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
      @import url(\"https://rsms.me/inter/inter.css");
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

              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <div class="me-3">
                        <!-- Download SVG icon from http://tabler-icons.io/i/scale -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-vaccine"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3l4 4" /><path d="M19 5l-4.5 4.5" /><path d="M11.5 6.5l6 6" /><path d="M16.5 11.5l-6.5 6.5h-4v-4l6.5 -6.5" /><path d="M7.5 12.5l1.5 1.5" /><path d="M10.5 9.5l1.5 1.5" /><path d="M3 21l3 -3" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">SQL Injection - Blind</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:red;"><b>High</b></font></li>
                      <li><b>Short Form</b> : SQLI</li>
                      <li><b>Injection Point</b> : $_COOKIE['user_id']</li>
                      <li><b>Why this happen</b> : SQL injection happens when attackers exploit vulnerabilities in web applications by injecting malicious SQL code into input fields. This occurs due to inadequate input validation and improper handling of user-supplied data in SQL queries. Attackers can manipulate these queries to execute unauthorized commands, leading to data breaches, unauthorized access, and other security compromises.</li>
                      <li><b>Read More</b> : <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/sql-injection' target="_blank'>Link</a></li>
                      <br>
                      <!-- <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-payloads">
                      View Payload
                      </a> -->
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-simple">
                      View Source
                      </a>
                    </ul>   
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                        <div class="markdown">
                          <div>
                            <h3 class="lh-1">Search for User ID</h3>
                          </div>

                        <center>
                        <br>
                        <p>
                        <?php
                        if(isset($_COOKIE['user_id'])){
                        
                          echo "<code style=\'color:red;\'>&quot; SELECT user_id, user_name, user_role FROM user WHERE user_id = <b>'" . htmlentities($id) . "'</b> &quot;</code><br>';

                          echo $data;

                        }
                        ?>
                        </p>
                        </center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include($base_path . "components/footer.php");?>

      <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">SQL Injection - Source Code</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "sourcecode/sqlinjectionblindhighcode.txt");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>compare/sqlinjectionblindcodecompare.php" type="button" class="btn btn-primary">Compare All Level</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="modal-payloads" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">SQL Injection - Payload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "payloads/low_sqli_manual_payload.txt");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>payloads/low_sqli_manual_payload.txt" type="button" class="btn btn-primary" download>Download</a>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>