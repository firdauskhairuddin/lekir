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

              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <div class="me-3">
                        <!-- Download SVG icon from http://tabler-icons.io/i/scale -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tool"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">Character Count</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Type</b> : Counting Tools</b></li>
                      <li><b>Short Form</b> : Count</b></li>
                      <li><b>Use case</b> : Some injection points impose restrictions, requiring us to meticulously craft payloads within confined length parameters.</li>
                      <li><b>Read More</b> : <a href="https://firdauskhairuddin.gitbook.io" target="_blank">Link</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                    <div class="markdown">
                      <div>
                        <h3 class="lh-1">Character Count</h3>
                      </div>

                      <div class="row g-2 align-items-center">
                        <div class="mb-3">
                          <textarea rows="6" class="form-control" id="inputText" autocomplete="off"></textarea>
                        </div>

                        <div id="results">
                          <p><strong>Characters:</strong> <span id="charCount">0</span></p>
                          <p><strong>Words:</strong> <span id="wordCount">0</span></p>
                          <p><strong>Sentences:</strong> <span id="sentenceCount">0</span></p>
                          <p><strong>Paragraphs:</strong> <span id="paragraphCount">0</span></p>
                          <p><strong>Spaces:</strong> <span id="spaceCount">0</span></p>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include($base_path . "components/footer.php");?>

    </div>
    <!-- Custom JS -->
    <script>
      document.getElementById('inputText').addEventListener('input', function() {
        var inputText = this.value;

        // Character count
        document.getElementById('charCount').textContent = inputText.length;

        // Word count
        var wordCount = inputText.trim().split(/\s+/).filter(Boolean).length; // Filter out empty strings
        document.getElementById('wordCount').textContent = inputText ? wordCount : 0;

        // Sentence count
        var sentenceCount = inputText.split(/[.!?]+/).length - 1;
        document.getElementById('sentenceCount').textContent = sentenceCount;

        // Paragraph count
        var paragraphCount = inputText.split(/\n\n+/).filter(Boolean).length; // Filter out empty strings
        document.getElementById('paragraphCount').textContent = inputText ? paragraphCount : 0;


        // Space count
        var spaceCount = inputText.split(/\s/).filter(Boolean).length - 1; // Filter out empty strings
        document.getElementById('spaceCount').textContent = inputText ? spaceCount : 0;
      });
    </script>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>