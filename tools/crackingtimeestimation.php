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
    <title><?php echo htmlentities($title); ?> - Password Cracking Estimator</title>
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
      
      .strength-meter-container {
        height: 8px;
        background-color: #f1f5f9;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 0.5rem;
      }
      
      .strength-meter-bar {
        height: 100%;
        width: 0%;
        transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.5s;
      }
      
      .result-card {
        background: #f8f9fa;
        border: 1px solid #e6e7e9;
        border-radius: 4px;
        padding: 1.5rem;
        text-align: center;
        margin-top: 2rem;
      }
      
      .estimate-time {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0.5rem 0;
      }
      
      .entropy-value {
        font-family: 'Menlo', monospace;
        background: #e2e8f0;
        padding: 0.1rem 0.4rem;
        border-radius: 3px;
        font-size: 0.9em;
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
                  Password Cracking Estimator
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
                            <!-- Download SVG icon from http://tabler-icons.io/i/shield-check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12l2 2l4 -4" /><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">Security Metrics</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Password Strength
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Unit:</strong> Entropy (Bits)
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
                     <h3 class="card-title">Estimator Tool</h3>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-12">
                        <label class="form-label required">Target Password</label>
                        <div class="input-group input-group-flat">
                          <input type="text" id="password" class="form-control" oninput="updateEstimate()" placeholder="Enter a password to analyze">
                          <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Clear" data-bs-toggle="tooltip" onclick="document.getElementById('password').value=''; updateEstimate();">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                            </a>
                          </span>
                        </div>
                        <div class="form-hint">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; vertical-align: -2px;"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                          Processed locally in your browser. Never sent to server.
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label class="form-label">Character Set</label>
                        <select class="form-select" id="charset" onchange="updateEstimate()">
                             <option value="26">Lowercase letters (a-z) - 26</option>
                             <option value="52">Mixed case letters (a-Z) - 52</option>
                             <option value="62" selected>Alphanumeric (a-Z, 0-9) - 62</option>
                             <option value="94">Printable ASCII - 94</option>
                             <option value="custom">Custom...</option>
                        </select>
                        <div class="mt-2" id="custom-charset-group" style="display: none;">
                            <input type="number" class="form-control" id="custom-charset" min="1" value="62" oninput="updateEstimate()" placeholder="Size">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label class="form-label">Attack Speed</label>
                         <select class="form-select" id="speed" onchange="updateEstimate()">
                             <option value="1000">1 k/s (Home PC)</option>
                             <option value="1000000">1 M/s (Gaming PC)</option>
                             <option value="1000000000" selected>1 G/s (Supercomputer)</option>
                             <option value="1000000000000">1 T/s (Nation State)</option>
                             <option value="custom">Custom...</option>
                         </select>
                         <div class="mt-2" id="custom-speed-group" style="display: none;">
                            <input type="number" class="form-control" id="custom-speed" min="1" value="1000000000" oninput="updateEstimate()" placeholder="Guesses/sec">
                         </div>
                      </div>
                      
                      <div class="col-12">
                         <div class="d-flex justify-content-between mb-1">
                            <label class="form-label mb-0">Strength Assessment</label>
                            <span class="text-muted small" id="entropy-display">0 bits of entropy</span>
                         </div>
                         <div class="strength-meter-container">
                            <div class="strength-meter-bar" id="strength-bar"></div>
                         </div>
                      </div>

                      <div class="col-12">
                          <div id="result" class="result-card d-none">
                              <div class="text-muted text-uppercase small fw-bold tracking-wide">Estimated Time to Crack</div>
                              <div class="estimate-time" id="time-estimate">Instant</div>
                              <div class="text-muted small mt-2">
                                  Assuming a brute-force attack trying <span id="speed-display-val">1 Billion</span> passwords per second.
                              </div>
                          </div>
                          
                          <div id="result-placeholder" class="text-center py-5 text-muted">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-dots mb-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 48px; height: 48px; opacity: 0.2;"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3v18h18" /><path d="M9 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19 7m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M10.16 10.62l2.34 2.88" /><path d="M15.088 13.328l2.837 -4.586" /></svg>
                              <div>Enter a password above to generate an estimate.</div>
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
        document.getElementById('charset').addEventListener('change', function() {
            document.getElementById('custom-charset-group').style.display = 
                this.value === 'custom' ? 'block' : 'none';
            updateEstimate();
        });
        
        document.getElementById('speed').addEventListener('change', function() {
            document.getElementById('custom-speed-group').style.display = 
                this.value === 'custom' ? 'block' : 'none';
            updateEstimate();
        });
        
        function updateEstimate() {
            const password = document.getElementById('password').value;
            const resultDiv = document.getElementById('result');
            const placeholderDiv = document.getElementById('result-placeholder');
            const strengthBar = document.getElementById('strength-bar');
            
            if (!password) {
                resultDiv.classList.add('d-none');
                placeholderDiv.classList.remove('d-none');
                strengthBar.style.width = '0%';
                document.getElementById('entropy-display').textContent = '0 bits of entropy';
                return;
            }
            
            resultDiv.classList.remove('d-none');
            placeholderDiv.classList.add('d-none');
            
            let charsetSize;
            const charsetSelect = document.getElementById('charset');
            if (charsetSelect.value === 'custom') {
                charsetSize = parseInt(document.getElementById('custom-charset').value) || 62;
            } else {
                charsetSize = parseInt(charsetSelect.value);
            }
            
            let speed;
            const speedSelect = document.getElementById('speed');
            if (speedSelect.value === 'custom') {
                speed = parseInt(document.getElementById('custom-speed').value) || 1000000000;
            } else {
                speed = parseInt(speedSelect.value);
            }
            
            const entropy = calculateRealisticEntropy(password, charsetSize);
            document.getElementById('entropy-display').innerHTML = `<span class='entropy-value'>${entropy.toFixed(1)}</span> bits of entropy`;
            
            const combinations = Math.pow(2, entropy);
            let seconds = combinations / speed;
            
            updateStrengthMeter(entropy, strengthBar);
            document.getElementById('time-estimate').innerHTML = formatTime(seconds);
            
            // Update explanatory text
            let speedText = speedSelect.options[speedSelect.selectedIndex].text.split('(')[0].trim();
            if(speedSelect.value === 'custom') speedText = speed.toLocaleString() + " /s";
            document.getElementById('speed-display-val').textContent = speedText;
        }

        function calculateRealisticEntropy(password, charsetSize) {
            let hasLower = /[a-z]/.test(password);
            let hasUpper = /[A-Z]/.test(password);
            let hasNumber = /[0-9]/.test(password);
            let hasSpecial = /[^a-zA-Z0-9]/.test(password);
            
            let effectiveCharset = 0;
            if (hasLower) effectiveCharset += 26;
            if (hasUpper) effectiveCharset += 26;
            if (hasNumber) effectiveCharset += 10;
            if (hasSpecial) effectiveCharset += 32;
            
            // Allow user to restrict max charset size (e.g. if they know it's only digits)
            // But realistically, attacker doesn't know that. We use min(effective, specified) for base calc
            // essentially assuming attacker guesses effectively.
            let baseSize = Math.max(effectiveCharset, 1);
            if (charsetSize > baseSize) baseSize = charsetSize; 
            // In a real scenario, use effectiveCharset if we assume smart attacker knowing the pattern, 
            // or charsetSize if pure brute force.
            // Let's stick closer to the previous logic:
            
            let entropy = password.length * Math.log2(Math.max(effectiveCharset, 1));
            
            // Common password penalties
            const common = ['password', '123456', 'qwerty', 'admin', 'welcome'];
            if (password.length > 0 && password.length <= 15) {
                 if (common.some(p => password.toLowerCase().includes(p))) {
                    entropy *= 0.3; 
                }
            }
            
             // Sequential penalty
            const sequences = ['123', 'abc', 'qwerty', 'asdf'];
            if (sequences.some(seq => password.toLowerCase().includes(seq))) {
                entropy *= 0.7;
            }

            return Math.max(entropy, 0);
        }
        
        function updateStrengthMeter(entropy, strengthBar) {
            let strengthPercentage;
            let color;
            
            if (entropy < 28) {
                strengthPercentage = 20;
                color = '#d63939'; // Red
            } else if (entropy < 45) {
                strengthPercentage = 40;
                color = '#f59f00'; // Orange
            } else if (entropy < 60) {
                strengthPercentage = 60;
                color = '#f76707'; // Yellow-Orange (Tabler orange)
            } else if (entropy < 80) {
                strengthPercentage = 80;
                color = '#74b816'; // Lime
            } else {
                strengthPercentage = 100;
                color = '#2fb344'; // Green
            }
            
            strengthBar.style.width = strengthPercentage + '%';
            strengthBar.style.backgroundColor = color;
        }
        
        function formatTime(seconds) {
            if (seconds < 0.001) return 'Instant';
            if (seconds < 1) return '< 1 Second';
            if (seconds < 60) return Math.round(seconds) + " Seconds";
            
            const minutes = seconds / 60;
            if (minutes < 60) return Math.round(minutes) + " Minutes";
            
            const hours = minutes / 60;
            if (hours < 24) return Math.round(hours) + " Hours";
            
            const days = hours / 24;
            if (days < 365) return Math.round(days) + " Days";
            
            const years = days / 365;
            if (years < 1000) return Math.round(years) + " Years";
            
            const millennia = years / 1000;
            if (millennia < 1000) return Math.round(millennia) + " Millennia";
            
            return "Millions of Years";
        }
    </script>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>