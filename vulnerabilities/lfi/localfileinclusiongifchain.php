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

ini_set("display_errors", 0);
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
 
      <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">Upload GIF file</h3>

                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                          <input type="file" class="form-control" id="image" name="image" accept=".gif">
                        </div>
                        <button type="submit" class="btn">Upload</button>
                      </form>
                      <?php
                      if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_FILES["image"])) {
                          $filename = $_FILES["image"]["name"];
                          $fileext = substr($filename, strrpos($filename, ".") + 1);
                          $filetmp = $_FILES['image']["tmp_name"];

                          if((strtolower($fileext) == "gif") && getimagesize($filetmp)){
                            // Move uploaded files to desired location
                            move_uploaded_file($filetmp, "uploads/$filename");

                            // Display uploaded files
                            echo '<div class="mt-4">';
                            echo "<h3>Successfully uploaded GIF File:</h3>";
                            echo "<center><img src=\"" . $base_path . "uploads/" . htmlentities($filename) . "\" alt='Uploaded GIF' style='max-width: 50%;'></center>";
                            echo "<br><br><p>Upload path : <a href='./uploads/" . htmlentities($filename) . "' target='_blank'>./uploads/" . htmlentities($filename) . "</a></p>";
                            echo "<p>Vulnerable link : <a href='" . $_SERVER["REQUEST_URI"] . "?file=./uploads/" . htmlentities($filename) . "' target='_blank'>" . $_SERVER['REQUEST_URI'] . "?file=./uploads/" . htmlentities($filename) . "</a></p>";
                            echo "<p>Delete this image : <a href='" . $_SERVER["REQUEST_URI"] . "?delete=" . htmlentities($filename) . "'>Delete file</a></p>";
                            echo "</div>";
                          } else {
                            echo "<br><center><p class='text-danger'>Please upload GIF file only.</p></center>";
                          }
                          
                        } else {
                          echo "<br><center><p class='text-danger'>Please upload GIF file only.</p></center>";
                        }
                      }

                      if(isset($_GET['file'])){

                        if(strlen($_GET['file']) > 150){
                          echo '<pre>Parameter has a maximum character limit of 150</pre>';
                          exit();
                        }
                        
                        $file = $_GET['file'];
                        include($file);
                      }

                      if (isset($_GET['delete'])) {

                        $uploadsDirectory = 'uploads/';

                        // Sanitize the filename to prevent directory traversal
                        $filename = basename($_GET['delete']);

                        // Construct the full path to the file
                        $filePath = $uploadsDirectory . $filename;

                        // Check if the file exists
                        if (file_exists($filePath)) {
                            // Attempt to delete the file
                            if (unlink($filePath)) {
                                $_SESSION['message'] = "File " . htmlentities($filename) . " has been deleted successfully.";
                            } else {
                                $_SESSION['message'] = "Failed to delete file " . htmlentities($filename);
                            }
                        } else {
                            $_SESSION['message'] = "File " . htmlentities($filename) . " does not exist";
                        }

                        echo "<script>window.location.href = './localfileinclusiongifchain.php';</script>";
                        exit();
                      }

                      if(isset($_SESSION['message']))
                      {
                        echo '<br><center>'.$_SESSION['message'].'</center>';
                        unset($_SESSION['message']);
                      }

                      ?>

                    </div>
                  </div>
                </div>
              </div>
              <div class='col-lg-4'>
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <div class="me-3">
                        <!-- Download SVG icon from http://tabler-icons.io/i/scale -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-vaccine"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3l4 4" /><path d="M19 5l-4.5 4.5" /><path d="M11.5 6.5l6 6" /><path d="M16.5 11.5l-6.5 6.5h-4v-4l6.5 -6.5" /><path d="M7.5 12.5l1.5 1.5" /><path d="M10.5 9.5l1.5 1.5" /><path d="M3 21l3 -3" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">Local File Inclusion</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : Others</li>
                      <li><b>Short Form</b> : LFI</li>
                      <li><b>Injection Point</b> : $_GET['file'] + File upload = RCE</li>
                      <li><b>Why this happen</b> : The improper use of function <i>include()</i> or <i>require()</i>. Insufficient input validation, dynamic file inclusion with user-supplied data, lack access controls, directory traversal exploits, and server misconfigurations.</li>
                      <li>Read More: <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/lfi-local-file-inclusion' target="_blank">Link</a></li>
                      <br>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-payloads">
                      View Payload
                      </a>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-simple">
                      View Source
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

      <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Local File Inclusion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "sourcecode/localfileinclusiongifchaincode.txt");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="modal-payloads" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Local File Inclusion - lfi.gif</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "payloads/lfi.gif");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>payloads/lfi.gif" type="button" class="btn btn-primary" download>Download</a>
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