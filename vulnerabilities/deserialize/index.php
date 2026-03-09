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
require_once 'serialize/FirstClass.php';

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set("display_errors", 1);
error_reporting(E_ALL);


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
      .result-box {
          background: #f8f9fa;
          border-radius: 8px;
          padding: 15px;
          margin: 15px 0;
          border-left: 5px solid #206bc4;
          text-align: left;
      }
      .result-box h3 {
          margin-top: 0;
      }
      .value {
          font-weight: bold;
          color: #206bc4;
      }
      .alert-execution {
          background-color: #f1f5f9;
          border-color: #64748b;
          color: #1e293b;
          padding: 1rem;
          border-radius: 8px;
          margin-top: 10px;
          text-align: left;
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

              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <div class="me-3">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-box"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">PHP Object Injection</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:green;"><b>Low</b></font></li>
                      <li><b>Short Form</b> : DESERIALIZE</li>
                      <li><b>Injection Point</b> : $_GET['num']</li>
                      <li><b>Why this happen</b> : PHP Object Injection is a vulnerability that occurs when user-supplied input is untrusted and is passed to the <code>unserialize()</code> function. This can lead to code execution, file manipulation, or other malicious activities if the application has classes defined with magic methods like <code>__wakeup()</code> or <code>__destruct()</code>.</li>
                      <li><b>Author</b> : EagleTube</li>
                      <li><b>Read More</b> : <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/php-object-injection' target='_blank'>Link</a></li>
                      <a href="#" class="btn mt-3" data-bs-toggle="modal" data-bs-target="#payloadModal">
                      View Payload
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
                            <h3 class="lh-1">Number Calculator</h3>
                          </div>
                          <p>This application calculates the sum of a default number (10) and your input. Try to manipulate the system to execute arbitrary commands!</p>

                          <div class="row g-2 align-items-center">
                            <form role="form" action="" method="GET" >
                              <div class="mb-3">
                                <input type="text" class="form-control" name="num" autocomplete="off" placeholder="Enter a number or serialized object..." value="<?php echo isset($_GET['num']) ? htmlspecialchars($_GET['num']) : ''; ?>">
                              </div>
                              <center><button action="submit" class="btn btn-primary">
                                Calculate
                              </button>
                              </center> 
                            </form> 
                          </div>

                        <div class="mt-4">
                        <?php 
                        if (isset($_GET['num'])) {
                            ob_start();
                            if (!is_numeric($_GET['num'])) {
                                echo "<div class='alert alert-warning mb-3'>⚠️ Non-numeric input detected! Attempting unserialize...</div>";
                                echo "<div class='card mb-3'><div class='card-body bg-light'><pre class='mb-0'>Processing: " . htmlspecialchars($_GET['num']) . "</pre></div></div>";
                                try {
                                    @unserialize($_GET['num']);
                                } catch (Exception $e) {
                                    echo "<div class='alert alert-danger'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</div>";
                                }
                            } else {
                                echo "<div class='alert alert-success mb-3'>✅ Valid number detected! Creating new object...</div>";
                                $num = (ctype_digit($_GET['num']) && (int)$_GET['num'] > 0)?$_GET['num']:0;
                                $first_obj = new First($num);
                                unset($first_obj); // Trigger destructor immediately
                            }
                            echo ob_get_clean();
                        }
                        ?>
                        </div>

                        <?php
                        // Display serialized object for educational purposes
                        if (!isset($_GET['num'])) {
                            $example = new First(5);
                            $serialized_example = serialize($example);
                            unset($example); // Prevent destructor from printing at end of page
                            echo "<div class='mt-4'>";
                            echo "<h4>📝 Example Object Serialization</h4>";
                            echo "<p>When you submit a number, an object is created. Here's what its serialized form looks like:</p>";
                            echo "<div class='card'><div class='card-body bg-light'><pre class='mb-0'>" . htmlspecialchars($serialized_example) . "</pre></div></div>";
                            echo "</div>";
                        }
                        ?>

                        <div class="mt-4 hint-section p-3 bg-blue-lt rounded border border-blue">
                            <h4>💡 Educational Hints</h4>
                            <p><strong>Goal:</strong> Create a serialized object where <code>trigger < default</code> to activate the destructor.</p>
                            <p><strong>Payload Structure:</strong> You need to craft a serialized object with trigger < 10.</p>
                            <p><strong>Tip:</strong> The application echoes the serialized object when you create a valid instance. Try accessing it with only a number first!</p>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include($base_path . "components/footer.php");?>

      <div class="modal modal-blur fade" id="payloadModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">🎯 Deserialization Payload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
              <pre class="bg-dark text-white p-3 m-0" style="font-family: 'Courier New', monospace; white-space: pre-wrap; word-break: break-all; border-radius: 0;"><?php echo htmlspecialchars(@file_get_contents('../../payloads/deserialize_payload.txt')); ?></pre>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="../../payloads/deserialize_payload.txt" download class="btn btn-primary">Download Payload</a>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Libs JS -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>