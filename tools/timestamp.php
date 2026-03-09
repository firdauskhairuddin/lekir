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
    <title><?php echo htmlentities($title); ?> - Unix Timestamp Converter</title>
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
      .timestamp-display {
        font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        font-size: 2.5rem;
        font-weight: 700;
        color: #206bc4;
        text-align: center;
        padding: 2rem;
        background: #f1f5f9;
        border-radius: 8px;
        margin-bottom: 1rem;
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
                  Unix Timestamp Converter
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">About Timestamps</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Date & Time
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Short Form:</strong> Unix TS
                        </div>
                      </li>
                      <li>
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        <div>
                            <strong>Use case:</strong> Used in computer systems to track time as a running total of seconds since 1970.
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
                     <h3 class="card-title">Timestamp Tool</h3>
                  </div>
                  <div class="card-body">
                    
                    <!-- Live Clock -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <h3 class="text-center text-muted mb-2">Current Unix Timestamp</h3>
                            <div class="timestamp-display" id="currentTimestamp">loading...</div>
                            <div class="text-center">
                                <button class="btn btn-pill btn-outline-primary" onclick="copyCurrentTIMESTAMP()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" /><path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" /></svg>
                                    Copy
                                </button>
                                <button class="btn btn-pill btn-outline-secondary ms-2" onclick="togglePause()" id="pauseBtn">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-player-pause" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M14 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /></svg>
                                   Stop
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="hr-text">Converters</div>

                    <div class="row g-4">
                        <!-- Convert Timestamp to Date -->
                        <div class="col-md-6 border-end">
                            <h4 class="card-title">Timestamp to Date</h4>
                            <div class="mb-3">
                                <label class="form-label">Unix Timestamp</label>
                                <div class="input-group">
                                    <input type="text" id="tsInput" class="form-control font-monospace" placeholder="e.g. 1678886400">
                                    <button class="btn btn-primary" onclick="convertTsToDate()">Convert</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date & Time (Local)</label>
                                <input type="text" id="dateOutput" class="form-control bg-muted-lt" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date & Time (UTC)</label>
                                <input type="text" id="dateOutputUTC" class="form-control bg-muted-lt" readonly>
                            </div>
                        </div>

                        <!-- Convert Date to Timestamp -->
                        <div class="col-md-6">
                            <h4 class="card-title">Date to Timestamp</h4>
                             <div class="mb-3">
                                <label class="form-label">Date & Time</label>
                                <div class="input-group">
                                    <input type="datetime-local" id="dateInput" class="form-control">
                                    <button class="btn btn-primary" onclick="convertDateToTs()">Convert</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Unix Timestamp</label>
                                <div class="input-group">
                                    <input type="text" id="tsOutput" class="form-control font-monospace bg-muted-lt" readonly>
                                    <button class="btn btn-outline-secondary" onclick="copyResultTs()">Copy</button>
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
    
    <!-- Scripts -->
    <script>
        let isPaused = false;
        let intervalId;

        function updateClock() {
            if (!isPaused) {
                const now = Math.floor(Date.now() / 1000);
                document.getElementById('currentTimestamp').innerText = now;
            }
        }

        intervalId = setInterval(updateClock, 1000);
        updateClock(); // Initial call

        function togglePause() {
            isPaused = !isPaused;
            const btn = document.getElementById('pauseBtn');
            if (isPaused) {
                btn.classList.add('btn-warning');
                btn.classList.remove('btn-outline-secondary');
                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-player-play" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 4v16l13 -8z" /></svg> Start';
            } else {
                btn.classList.remove('btn-warning');
                btn.classList.add('btn-outline-secondary');
                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-player-pause" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M14 5m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /></svg> Stop';
                updateClock();
            }
        }

        function copyCurrentTIMESTAMP() {
            const ts = document.getElementById('currentTimestamp').innerText;
            navigator.clipboard.writeText(ts);
        }

        function convertTsToDate() {
            const ts = document.getElementById('tsInput').value;
            if (!ts) return;
            
            const date = new Date(ts * 1000);
            if (isNaN(date.getTime())) {
                document.getElementById('dateOutput').value = "Invalid Timestamp";
                document.getElementById('dateOutputUTC').value = "";
                return;
            }
            document.getElementById('dateOutput').value = date.toString();
            document.getElementById('dateOutputUTC').value = date.toUTCString();
        }

        function convertDateToTs() {
            const dateStr = document.getElementById('dateInput').value;
            if (!dateStr) return;
            
            const date = new Date(dateStr);
            const ts = Math.floor(date.getTime() / 1000);
            document.getElementById('tsOutput').value = ts;
        }

        function copyResultTs() {
             const output = document.getElementById('tsOutput');
             output.select();
             document.execCommand('copy');
        }
    </script>
    <!-- Libs JS -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
