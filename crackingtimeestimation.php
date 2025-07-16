<?php
session_start();
include('./core/configuration.php');
include('./core/function.php');

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set('display_errors', 0);
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
    <link rel="icon" href="./static/lekir.jpeg" type="image/png">
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
        .container {
            border-radius: 8px;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        #result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 4px;
            background-color: #e9f7ef;
            display: none;
        }
        .time-unit {
            font-weight: bold;
            color: #2c3e50;
        }
        .strength-meter {
            height: 20px;
            background-color: #eee;
            border-radius: 4px;
            margin-top: 10px;
            overflow: hidden;
        }
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s;
        }
        .password-info {
            font-size: 0.8em;
            color: #666;
            margin-top: 5px;
        }
    </style>
  </head>
  <body >
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="./dashboard.php">
              LEKIR
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
                <a href="https://github.com/firdauskhairuddin" class="btn" target="_blank" rel="noreferrer">
                  <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
                  Source code
                </a>
                <!--
                <a href="https://paypal.me/firdauskhairuddin" class="btn" target="_blank" rel="noreferrer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                  Sponsor
                </a>
                -->
              </div>
            </div>
            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(./static/lekir.jpeg)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div><?php echo htmlentities($_SESSION['user_name']); ?></div>
                  <div class="mt-1 small text-secondary">Level : <?php echo $level->current_level($_SESSION['level']); ?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="./api.php?action=logout" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>

      <?php include('./components/header.php');?>
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
                        <h3 class="lh-1">Password Cracking Time Estimation</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Type</b> : Computer Security Metric</b></li>
                      <li><b>Short Form</b> : Password Entropy</b></li>
                      <li><b>Measurement Unit</b> : Bits</b></li>
                      <li><b>Use case</b> : Estimates how long it would take to crack a password through brute-force or dictionary attacks.</li>
                      <li><b>Read More</b> : <a href="https://firdauskhairuddin.gitbook.io" target="_blank">Link</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                    <div class="container">
                        <h1>Password Cracking Time Estimator</h1>
                        
                        <div class="form-group">
                            <label for="password">Enter Password:</label>
                            <input type="text" id="password" oninput="updateEstimate()" placeholder="Type your password here">
                            <div class="password-info">Note: This tool runs completely in your browser. No passwords are sent to any server.</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="charset">Character Set:</label>
                            <select id="charset" onchange="updateEstimate()">
                                <option value="26">Lowercase letters only (26)</option>
                                <option value="52">Lowercase + Uppercase (52)</option>
                                <option value="62" selected>Letters + Numbers (62)</option>
                                <option value="94">All printable ASCII (94)</option>
                                <option value="custom">Custom size...</option>
                            </select>
                        </div>
                        
                        <div class="form-group" id="custom-charset-group" style="display: none;">
                            <label for="custom-charset">Custom Character Set Size:</label>
                            <input type="number" id="custom-charset" min="1" value="62" oninput="updateEstimate()">
                        </div>
                        
                        <div class="form-group">
                            <label for="speed">Cracking Speed (guesses per second):</label>
                            <select id="speed" onchange="updateEstimate()">
                                <option value="1000">1,000 (Home computer)</option>
                                <option value="1000000">1,000,000 (Fast computer)</option>
                                <option value="1000000000" selected>1,000,000,000 (Supercomputer/Botnet)</option>
                                <option value="1000000000000">1,000,000,000,000 (Government supercomputer)</option>
                                <option value="custom">Custom speed...</option>
                            </select>
                        </div>
                        
                        <div class="form-group" id="custom-speed-group" style="display: none;">
                            <label for="custom-speed">Custom Cracking Speed:</label>
                            <input type="number" id="custom-speed" min="1" value="1000000000" oninput="updateEstimate()">
                        </div>
                        
                        <div class="form-group">
                            <label>Password Strength:</label>
                            <div class="strength-meter">
                                <div class="strength-bar" id="strength-bar"></div>
                            </div>
                        </div>
                        
                        <div id="result">
                            <h3>Estimated Cracking Time:</h3>
                            <p id="time-estimate">Please enter a password to estimate cracking time.</p>
                            <p id="entropy">Password entropy: <span id="entropy-value">0</span> bits</p>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include('./components/footer.php');?>

    </div>
    <!-- Custom JS -->
    <script>
        // Show/hide custom inputs
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
        
        // Main calculation function
        function updateEstimate() {
            const password = document.getElementById('password').value;
            const resultDiv = document.getElementById('result');
            const strengthBar = document.getElementById('strength-bar');
            
            if (!password) {
                resultDiv.style.display = 'none';
                strengthBar.style.width = '0%';
                strengthBar.style.backgroundColor = '';
                return;
            }
            
            // Get character set size
            let charsetSize;
            const charsetSelect = document.getElementById('charset');
            if (charsetSelect.value === 'custom') {
                charsetSize = parseInt(document.getElementById('custom-charset').value) || 62;
            } else {
                charsetSize = parseInt(charsetSelect.value);
            }
            
            // Get cracking speed
            let speed;
            const speedSelect = document.getElementById('speed');
            if (speedSelect.value === 'custom') {
                speed = parseInt(document.getElementById('custom-speed').value) || 1000000000;
            } else {
                speed = parseInt(speedSelect.value);
            }
            
            // Calculate password entropy more realistically
            const entropy = calculateRealisticEntropy(password, charsetSize);
            document.getElementById('entropy-value').textContent = entropy.toFixed(2);
            
            // Calculate possible combinations (more realistic)
            const combinations = Math.pow(2, entropy);
            
            // Calculate time in seconds
            let seconds = combinations / speed;
            
            // Update strength meter
            updateStrengthMeter(entropy, strengthBar);
            
            // Format time
            const timeString = formatTime(seconds);
            document.getElementById('time-estimate').innerHTML = timeString;
            
            resultDiv.style.display = 'block';
        }

        function calculateRealisticEntropy(password, charsetSize) {
        // Base entropy calculation
        let hasLower = /[a-z]/.test(password);
        let hasUpper = /[A-Z]/.test(password);
        let hasNumber = /[0-9]/.test(password);
        let hasSpecial = /[^a-zA-Z0-9]/.test(password);
        
        // Calculate effective charset size based on what's actually used
        let effectiveCharset = 0;
        if (hasLower) effectiveCharset += 26;
        if (hasUpper) effectiveCharset += 26;
        if (hasNumber) effectiveCharset += 10;
        if (hasSpecial) effectiveCharset += 32;
        
        // Start with basic entropy calculation
        let entropy = password.length * Math.log2(Math.min(effectiveCharset, charsetSize));
        
        // Common password penalty (but don't override long passwords)
        const commonPasswordPenalty = () => {
            const common = [
                'password', '123456', 'qwerty', 'admin', 'welcome', 
                'sunshine', 'dragon', 'football', 'monkey', 'letmein'
            ];
            
            if (password.length > 15) return 1.0; // No penalty for long passwords
            if (common.some(p => password.toLowerCase().includes(p))) {
                return 0.3; // 70% entropy reduction for containing common words
            }
            return 1.0;
        };
        
        // Sequential pattern penalty
        const sequentialPenalty = () => {
            if (password.length > 15) return 0.8; // Small penalty even for long sequences
            if (isSequential(password)) return 0.2;
            return 1.0;
        };
        
        // Apply penalties multiplicatively
        entropy *= commonPasswordPenalty();
        entropy *= sequentialPenalty();
        
        // Minimum entropy guarantee
        return Math.max(entropy, password.length * 2); // At least 2 bits per character
    }

        function isSequential(str) {
            // Check for keyboard sequences like "qwerty" or "123456"
            const sequences = [
                '1234567890',
                '0987654321',
                'qwertyuiop',
                'poiuytrewq',
                'asdfghjkl',
                'lkjhgfdsa',
                'zxcvbnm',
                'mnbvcxz'
            ];
            
            const lowerStr = str.toLowerCase();
            return sequences.some(seq => lowerStr.includes(seq) || 
                lowerStr.includes(seq.split('').reverse().join('')));
        }
        
        function updateStrengthMeter(entropy, strengthBar) {
            let strengthPercentage;
            let color;
            
            if (entropy < 28) {
                strengthPercentage = Math.min(100, (entropy / 28) * 100);
                color = '#ff4d4d'; // Red
            } else if (entropy < 60) {
                strengthPercentage = Math.min(100, ((entropy - 28) / (60 - 28)) * 100);
                color = '#ffcc00'; // Yellow
            } else if (entropy < 100) {
                strengthPercentage = Math.min(100, ((entropy - 60) / (100 - 60)) * 100);
                color = '#66cc66'; // Green
            } else {
                strengthPercentage = 100;
                color = '#006600'; // Dark green
            }
            
            strengthBar.style.width = strengthPercentage + '%';
            strengthBar.style.backgroundColor = color;
        }
        
        function formatTime(seconds) {
            if (seconds < 0.001) {
                return "Less than a millisecond";
            }
            
            if (seconds < 1) {
                return (seconds * 1000).toFixed(2) + " milliseconds";
            }
            
            if (seconds < 60) {
                return seconds.toFixed(2) + " seconds";
            }
            
            const minutes = seconds / 60;
            if (minutes < 60) {
                return minutes.toFixed(2) + " minutes";
            }
            
            const hours = minutes / 60;
            if (hours < 24) {
                return hours.toFixed(2) + " hours";
            }
            
            const days = hours / 24;
            if (days < 365) {
                return days.toFixed(2) + " days";
            }
            
            const years = days / 365;
            if (years < 1000) {
                return years.toFixed(2) + " years";
            }
            
            const millennia = years / 1000;
            if (millennia < 1000000) {
                return millennia.toFixed(2) + " millennia";
            }
            
            const universeAges = years / 13800000000;
            return universeAges.toFixed(4) + " times the age of the universe";
        }
        
        // Initialize
        updateEstimate();
    </script>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>