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

if (isset($_GET["delete"]))
{
    $uploadsDirectory = "uploads/";

    $filename = basename($_GET["delete"]);

    $filePath = $uploadsDirectory . $filename;

    // Check if the file exists
    if (file_exists($filePath))
    {
        if (unlink($filePath))
        {
            $_SESSION["message"] = "File " . htmlentities($filename) . " has been deleted successfully.";
        }
        else
        {
            $_SESSION["message"] = "Failed to delete file " . htmlentities($filename);
        }
    }
    else
    {
        $_SESSION["message"] = "File " . htmlentities($filename) . " does not exist";
    }

    echo "<script>window.location.href = '" . htmlentities($_SERVER["PHP_SELF"]) . "';</script>";
    exit();
}
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
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">Upload Image File</h3>
                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                          <input type="file" class="form-control" id="image" name="image" accept=".gif,.jpg,.jpeg,.png" placeholder="">
                        </div>
                        <button type="submit" class="btn">Upload</button>
                      </form>
                      <?php
                      if ($_SERVER["REQUEST_METHOD"] == "POST")
                      {
                          if (isset($_FILES["image"]))
                          {

                              $filename = $_FILES["image"]["name"];
                              $fileext = strtolower(substr( $filename, strrpos( $filename, "." ) + 1));
                              $filesize = $_FILES['image']["size"];
                              $filestype = strtolower($_FILES["image"]["type"]);
                              $filetmp = $_FILES["image"]["tmp_name"];

                              $path = getcwd() . "/uploads/";
                              $newfilename = md5( uniqid() . $filename ) . '.' . $fileext;

                              $allowedextensions = ['jpg', 'jpeg', 'png', 'gif'];
                              $allowedmime = ['image/jpeg', 'image/png', 'image/gif'];

                              if (in_array($fileext, $allowedextensions) && $filesize < 3000000 && in_array($filestype, $allowedmime) && getimagesize($filetmp)) {

                                if( $filestype == 'image/jpeg' ) {
                                    $img = imagecreatefromjpeg( $filetmp );
                                    imagejpeg( $img, $filetmp, 100);
                                } elseif($filestype == 'image/png' ) {
                                    $img = imagecreatefrompng( $filetmp );
                                    imagepng( $img, $filetmp, 9);
                                } else {
                                    $img = imagecreatefromgif( $filetmp );
                                    imagegif( $img, $filetmp);
                                }
                                imagedestroy( $img );

                                if( rename( $filetmp, ( $path . $newfilename ) ) ) {

                                  echo '<div class="mt-4">';
                                  echo "<h3>Successfully uploaded!:</h3>";
                                  echo "<center><img src=\"uploads/" . htmlentities($newfilename) . "\" alt='Uploaded Image' style='width:250px;height:250px;'></center>";
                                  echo "<br><br><p>Upload path : <a href='./uploads/" . htmlentities($newfilename) . "' target='_blank'>./uploads/" . htmlentities($newfilename) . "</a></p>";
                                  echo "<p>Delete this image : <a href='" . htmlentities($_SERVER["REQUEST_URI"]) . "?delete=" . htmlentities($newfilename) . "'>Delete file</a></p>";
                                  echo "</div>";

                                }
                              } else {
                                  echo "<br><center><p class='text-danger'>Please upload image file only</p></center>";
                              }
                          }
                      }

                      if (isset($_SESSION['message']))
                      {
                          echo '<br><center>' . htmlentities($_SESSION['message']) . '</center>';
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
                        <h3 class="lh-1">Insecure File Upload</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:#8B0000;"><b>Impossible</b></font></li>
                      <li><b>Short Form</b> : File Upload</li>
                      <li><b>Injection Point</b> : $_POST['file']</li>
                      <li><b>Why this happen</b> : Insecure file upload is a web application vulnerability where users can upload files without proper validation. This can lead to malicious file execution, server overloading, data breaches, and other security risks. To mitigate this, validate file types and sizes, enforce server-side checks, store files securely, sanitize file names, implement Content Security Policy, and educate users on safe upload practices.</li>
                      <li>Read More: <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/insecure-file-upload' target="_blank">Link</a></li>
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
              <h5 class="modal-title">File Upload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "sourcecode/fileuploadimpossiblecode.txt");
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
              <h5 class="modal-title">File Upload</h5>
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