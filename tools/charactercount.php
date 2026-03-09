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
    <title><?php echo htmlentities($title); ?> - Character Count</title>
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
      
      .tool-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
      }
      
      .tool-textarea {
        font-family: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        font-size: 1rem;
        background-color: #f8f9fa;
        border: 1px solid #e6e7e9;
        transition: border-color 0.2s;
        line-height: 1.6;
      }
      
      .tool-textarea:focus {
        background-color: #fff;
        border-color: #206bc4;
        box-shadow: 0 0 0 0.25rem rgba(32, 107, 196, 0.15);
      }

      .info-list li {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: flex-start;
      }

      .info-icon {
        margin-top: 0.2rem;
        margin-right: 0.75rem;
        color: #206bc4;
      }
      
      .stat-card {
        background: #f8f9fa;
        border-radius: 4px;
        padding: 1rem;
        text-align: center;
        border: 1px solid #e6e7e9;
        height: 100%;
      }
      
      .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.25rem;
        display: block;
      }
      
      .stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        font-weight: 600;
      }
    </style>
  </head>
  <body >
    <script src="<?php echo $base_path; ?>dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      <?php include($base_path . "components/top_navbar.php"); ?>
      <?php include($base_path . "components/header.php"); ?>
 
      <div class="page-wrapper">
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <div class="page-pretitle">
                  Tool
                </div>
                <h2 class="page-title">
                  Character Counter
                </h2>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">

              <div class="col-lg-4">
                <div class="card tool-card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                      <div class="me-3">
                        <div class="bg-blue-lt p-2 rounded-circle">
                            <!-- Download SVG icon from http://tabler-icons.io/i/typography -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20l3 0" /><path d="M14 20l7 0" /><path d="M6.9 15l6.9 0" /><path d="M10.2 6.3l5.8 13.7" /><path d="M5 20l6 -16l2 0l7 16" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">Text Analysis</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Counting Tool
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Short Form:</strong> Count
                        </div>
                      </li>
                      <li>
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        <div>
                            <strong>Use case:</strong> Essential for crafting payloads within strict length limits, or simply analyzing text content statistics.
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /></svg>
                        <div>
                           <strong>Read More:</strong> <a href='https://firdauskhairuddin.gitbook.io' target="_blank" class="text-blue">Documentation</a>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="card tool-card">
                  <div class="card-header">
                     <h3 class="card-title">Counter Tool</h3>
                     <div class="card-actions">
                        <button class="btn btn-sm btn-ghost-danger" onclick="clearAll()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            Clear All
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-12">
                         <div class="d-flex justify-content-between mb-2">
                             <label class="form-label">Input Text</label>
                             <button class="btn btn-sm btn-ghost-primary" onclick="pasteFromClipboard()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>
                                Paste
                            </button>
                         </div>
                        <textarea class="form-control tool-textarea" id="inputText" rows="10" placeholder="Type or paste your text here to analyze..." autocomplete="off"></textarea>
                      </div>
                      
                      <div class="col-12 mt-4">
                        <div class="hr-text text-muted">Results</div>
                        <div class="row g-3 row-cards">
                            <div class="col-6 col-sm-4 col-md-2">
                                <div class="stat-card">
                                    <span class="stat-value" id="charCount">0</span>
                                    <span class="stat-label">Characters</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-md-2">
                                <div class="stat-card">
                                    <span class="stat-value" id="wordCount">0</span>
                                    <span class="stat-label">Words</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-md-2">
                                <div class="stat-card">
                                    <span class="stat-value" id="sentenceCount">0</span>
                                    <span class="stat-label">Sentences</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="stat-card">
                                    <span class="stat-value" id="paragraphCount">0</span>
                                    <span class="stat-label">Paragraphs</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="stat-card">
                                    <span class="stat-value" id="spaceCount">0</span>
                                    <span class="stat-label">Spaces</span>
                                </div>
                            </div>
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
    </div>
    <!-- Custom JS -->
    <script>
      function clearAll() {
          document.getElementById('inputText').value = '';
          updateCounts();
      }

      async function pasteFromClipboard() {
        try {
            const text = await navigator.clipboard.readText();
            document.getElementById("inputText").value = text;
            updateCounts();
        } catch (err) {
            console.error('Failed to read clipboard contents: ', err);
            alert("Failed to paste. Please allow clipboard access.");
        }
      }

      function updateCounts() {
        var inputText = document.getElementById('inputText').value;

        // Character count
        document.getElementById('charCount').textContent = inputText.length;

        // Word count
        var wordCount = inputText.trim().split(/\s+/).filter(Boolean).length;
        document.getElementById('wordCount').textContent = inputText.trim() ? wordCount : 0;

        // Sentence count
        // Improved regex to handle common sentence endings
        var sentenceCount = inputText.split(/[.!?]+/).filter(Boolean).length;
        // Adjust logic: if no punctuation, and has words, maybe count as 1? Usually specific regex is better. 
        // Keeping it simple based on previous logic but refined.
        if (!inputText.trim()) sentenceCount = 0;
        document.getElementById('sentenceCount').textContent = sentenceCount;

        // Paragraph count
        var paragraphCount = inputText.split(/\n\n+/).filter(Boolean).length;
        if (!inputText.trim()) paragraphCount = 0;
        else if (paragraphCount === 0) paragraphCount = 1; // At least one paragraph if text exists
        document.getElementById('paragraphCount').textContent = paragraphCount;

        // Space count
        var spaceCount = (inputText.match(/\s/g) || []).length;
        document.getElementById('spaceCount').textContent = spaceCount;
      }

      document.getElementById('inputText').addEventListener('input', updateCounts);
      
      // Initialize on load in case of refresh with content
      document.addEventListener('DOMContentLoaded', updateCounts);
    </script>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>