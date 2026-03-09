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

ini_set(\"display_errors", 0);
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
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                    <h2><center><a href="./.git/" target="_blank" style="color:blue;">Directory : Git Folder</a></center></h2>
                    <table class="table table-vcenter card-table">
                      <thead>
                          <tr>
                              <th>.git folder</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          // Directory to scan
                          $upload_dir = \"./.git/";

                          // Check if directory exists
                          if (is_dir($upload_dir)) {
                              // Open directory
                              if ($dh = opendir($upload_dir)) {
                                  // Read files in directory
                                  while (($file = readdir($dh)) !== false) {
                                      // Exclude special directories
                                      if ($file != '.' && $file != '..') {
                                          // Display file name in table row
                                          echo '<tr><td>$file</td></tr>';
                                      }
                                  }
                                  // Close directory
                                  closedir($dh);
                              }
                          } else {
                              echo "<tr><td colspan=\"1">.git directory does not exist on directory.</td></tr>';
                          }
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
                        <h3 class="lh-1">Expose .git - Source Code Disclosure</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : Others</b></li>
                      <li><b>Short Form</b> : Expose .git</b></li>
                      <li><b>Injection Point</b> : .git folder</b></li>
                      <li><b>Why this happen</b> : Exposing the .git directory means making it accessible from the web, typically unintentionally, which can lead to security vulnerabilities. This directory contains sensitive information about the repository, including commit history, configuration details, and potentially credentials. Attackers can exploit this exposure to gather information or perform attacks such as retrieving source code, identifying vulnerabilities, or conducting reconnaissance for further attacks.</li>
                      <li><b>Read More</b> : <a href="https://commonvuln.mfbktech.academy/git-of-terror" target="_blank">Link</a></li>
                      <br>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-payloads">
                      View Payload
                      </a>
                    </div>
                    </ul>   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include($base_path . "components/footer.php");?>

      <div class="modal modal-blur fade" id="modal-payloads" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Git Expose</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "payloads/gitexposepayload.txt");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>payloads/gitexpose.txt" type="button" class="btn btn-primary" download>Download</a>
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