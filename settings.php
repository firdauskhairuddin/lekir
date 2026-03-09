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

if(isset($_GET['action']) && $_GET['action'] === 'delete'){
  shell_exec("rm -fr ./uploads/*");
  echo '<script>window.onload = function() { var myModal = new bootstrap.Modal(document.getElementById('modal-success')); myModal.show(); }</script>";
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
      #modalTriggerButton {
        display: none;
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
            <div class="card">
              <div class="row g-0">
                <div class="col-12 col-md-3 border-end">
                  <div class="card-body">
                    <h4 class="subheader">Server settings</h4>
                    <div class="list-group list-group-transparent">
                      <a href="<?php echo $base_path; ?>settings.php" class="list-group-item list-group-item-action d-flex align-items-center active">Uploads Folder</a>
                      <a href="./info.php" class="list-group-item list-group-item-action d-flex align-items-center" target="_blank">PHP Info</a>
                      <a href="./systemUpdate.php" class="list-group-item list-group-item-action d-flex align-items-center">System Update</a>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-9 d-flex flex-column">
                  <div class="card-body">
                    <h2 class="mb-4">Clear Uploads folder</h2>
                    <h3 class="card-title">Folder Listing</h3>
                    <table class="table table-vcenter card-table">
                      <thead>
                          <tr>
                              <th>File Name</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          // Directory to scan
                          $upload_dir = \"uploads/";

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
                              echo "<tr><td colspan=\"1">Upload directory does not exist.</td></tr>';
                          }
                          ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                      <a href="#" class="btn primary" data-bs-toggle="modal" data-bs-target="#modal-danger">
                        Remove All
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include($base_path . "components/footer.php");?>
    </div>
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-danger"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
            <h3>Are you sure?</h3>
            <div class="text-secondary">Do you really want to remove all files? What you"ve done cannot be undone.</div>
          </div>
          <div class='modal-footer'>
            <div class="w-100">
              <div class="row">
                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                    Cancel
                  </a></div>
                <div class="col"><a href="?action=delete" class="btn btn-danger w-100">
                    Delete all items
                  </a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal modal-blur fade" id="modal-success" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-success"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M9 12l2 2l4 -4"></path></svg>
            <h3>File deleted</h3>
            <div class="text-secondary">Now that"s a clean start!</div>
          </div>
          <div class='modal-footer'>
            <div class="w-100">
              <div class="row">
                <div class="col"><a href="<?php echo $base_path; ?>settings.php" class="btn w-100">
                    Close
                  </a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="#" id="modalTriggerButton" class="btn primary" data-bs-toggle="modal" data-bs-target="#modal-success">Trigger Modal</a>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>