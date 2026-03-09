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
    <title><?php echo htmlentities($title); ?> - Secure Password Generator</title>
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
        background-color: #f8fafc;
      }
      .tool-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
      }
      .password-display {
        font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        font-size: 2rem;
        font-weight: 700;
        color: #206bc4;
        text-align: center;
        padding: 2rem;
        background: #f1f5f9;
        border-radius: 8px;
        margin-bottom: 2rem;
        word-break: break-all;
        border: 2px dashed #cbd5e1;
        cursor: pointer;
        transition: all 0.2s;
      }
      .password-display:hover {
        background: #e2e8f0;
        border-color: #94a3b8;
      }
      .form-selectgroup-label {
        border-radius: 8px;
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
                  Secure Password Generator
                </h2>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
            
              <!-- Info Sidebar -->
              <div class="col-lg-4">
                <div class="card tool-card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                      <div class="me-3">
                        <div class="bg-blue-lt p-2 rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">About Passwords</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Security
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Short Form:</strong> Pass Gen
                        </div>
                      </li>
                      <li>
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        <div>
                            <strong>Use case:</strong> Creates strong, unpredictable passwords to secure accounts against brute-force attacks.
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Tool Area -->
              <div class="col-lg-8">
                <div class="card tool-card">
                  <div class="card-header">
                     <h3 class="card-title">Password Tool</h3>
                  </div>
                  <div class="card-body">
                    
                    <div class="password-display" id="passwordOutput" onclick="copyPassword()" title="Click to copy">
                        Click Generate
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Password Length: <span id="lengthVal" class="fw-bold">16</span></label>
                            <input type="range" class="form-range" min="4" max="64" value="16" id="passLength" oninput="updateLength(this.value); generatePassword()">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                         <label class="form-label">Options</label>
                         <div class="form-selectgroup">
                            <label class="form-selectgroup-item">
                              <input type="checkbox" id="optUppercase" class="form-selectgroup-input" checked onchange="generatePassword()">
                              <span class="form-selectgroup-label">A-Z</span>
                            </label>
                            <label class="form-selectgroup-item">
                              <input type="checkbox" id="optLowercase" class="form-selectgroup-input" checked onchange="generatePassword()">
                              <span class="form-selectgroup-label">a-z</span>
                            </label>
                            <label class="form-selectgroup-item">
                              <input type="checkbox" id="optNumbers" class="form-selectgroup-input" checked onchange="generatePassword()">
                              <span class="form-selectgroup-label">0-9</span>
                            </label>
                            <label class="form-selectgroup-item">
                              <input type="checkbox" id="optSymbols" class="form-selectgroup-input" checked onchange="generatePassword()">
                              <span class="form-selectgroup-label">@#$%</span>
                            </label>
                          </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg" onclick="generatePassword()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                            Generate New Password
                        </button>
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
    
    <!-- Scripts -->
    <script>
        function updateLength(val) {
            document.getElementById('lengthVal').innerText = val;
        }

        function generatePassword() {
            const length = document.getElementById('passLength').value;
            const useUpper = document.getElementById('optUppercase').checked;
            const useLower = document.getElementById('optLowercase').checked;
            const useNumbers = document.getElementById('optNumbers').checked;
            const useSymbols = document.getElementById('optSymbols').checked;

            const charsetUpper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const charsetLower = "abcdefghijklmnopqrstuvwxyz";
            const charsetNumbers = "0123456789";
            const charsetSymbols = "!@#$%^&*()_+~`|}{[]\:;?><,./-=";

            let charset = "";
            if (useUpper) charset += charsetUpper;
            if (useLower) charset += charsetLower;
            if (useNumbers) charset += charsetNumbers;
            if (useSymbols) charset += charsetSymbols;

            if (charset === "") {
                document.getElementById('passwordOutput').innerText = "Select options!";
                return;
            }

            let retVal = "";
            for (let i = 0, n = charset.length; i < length; ++i) {
                retVal += charset.charAt(Math.floor(Math.random() * n));
            }
            document.getElementById('passwordOutput').innerText = retVal;
        }

        function copyPassword() {
            const password = document.getElementById('passwordOutput').innerText;
            if(!password || password === "Select options!" || password === "Click Generate") return;

            navigator.clipboard.writeText(password);
            
             // Visual feedback
            const display = document.getElementById('passwordOutput');
            const originalText = display.innerText;
            
            display.style.borderColor = "#2fb344";
            display.style.backgroundColor = "#d1fae5";
            
            setTimeout(() => {
                display.style.borderColor = "#cbd5e1";
                display.style.backgroundColor = "#f1f5f9";
            }, 500);
        }

        // Generate on load
        window.onload = generatePassword;
    </script>
    <!-- Libs JS -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
