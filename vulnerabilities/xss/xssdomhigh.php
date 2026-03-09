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
header('X-XSS-Protection: 0');
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
                        <h3 class="lh-1">Cross Site Scripting - Document Object Model (DOM)</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:red;">High</font></li>
                      <li><b>Short Form</b> : XSS DOM</li>
                      <li><b>Injection Point</b> : userInput</li>
                      <li><b>Why this happen</b> : XSS DOM specifically involve manipulation of the DOM. In this type of attack, the attacker injects malicious code into the DOM of a web page, typically by exploiting client-side JavaScript code that dynamically updates the DOM based on user input or other external data sources.</li>
                      <li><b>Read More</b> : <a href="https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/cross-site-scripting" target="_blank">Link</a></li>
                      <br>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-payloads">
                      View Payload
                      </a>
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
                            <h3 class="lh-1">Enter your name</h3>
                          </div>
                          <div class="row g-2 align-items-center">
                              <div class="mb-3">
                                <input type="text" class="form-control"  id="userInput" name="userInput" autocomplete="off">
                              </div>
                              <center><button onclick="displayMessage()" class="btn btn-primary">
                                Submit
                              </button>
                              </center>
                          </div>

                        <center>
                        <br>
                        <div id="output">Welcome</div>
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
              <h5 class="modal-title">Cross Site Scripting - Source Code</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "sourcecode/xssdomhighcode.txt");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>compare/xssdomcodecompare.php" type="button" class="btn btn-primary">Compare All Level</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="modal-payloads" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cross Site Scripting - Payload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "payloads/xss_payload.txt");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>payloads/xss_payload.txt" type="button" class="btn btn-primary" download>Download</a>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Custom JS -->
    <script>
    function displayMessage() {
        function escapeHtml(input) {
            // Escape special characters to prevent XSS
            return input.replace(/&/g, \"&amp;")
                        .replace(/'/g, '&quot;')
                        .replace(/'/g, '&#39;');
        }

        function sanitizeInput(input) {
            // Replace any <script> tags or event handlers with harmless text
            return input.replace(/<script.*?>|on\w+='.*?'/gi, "');
        }

        var userInput = document.getElementById('userInput').value;
        var sanitizedInput = sanitizeInput(userInput);
        var escapedInput = escapeHtml(sanitizedInput);
        document.getElementById("output").innerHTML = "Hello, " + escapedInput + "! Welcome to our website.";
    }
    </script>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>