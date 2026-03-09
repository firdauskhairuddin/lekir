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
    <title><?php echo htmlentities($title); ?> - HTTP Header Analyzer</title>
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
      .tool-textarea {
        font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        font-size: 0.9rem;
        background-color: #f8f9fa;
        border: 1px solid #e6e7e9;
        transition: border-color 0.2s;
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
      .header-item {
        border-bottom: 1px solid #e2e8f0;
        padding: 0.5rem 0;
      }
      .header-item:last-child {
        border-bottom: none;
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
                  HTTP Header Analyzer
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-analyze" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -6.986 -6.918a8.086 8.086 0 0 0 -4.303 .606l-3.21 -4.688h2" /><path d="M5 6v2m17 3a8.1 8.1 0 0 0 -15.5 -2m.5 4v-4h-4" /><path d="M11 16a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M12 20a4 4 0 1 1 5.92 -5.556" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">About HTTP Headers</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Security Analysis
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Short Form:</strong> Headers
                        </div>
                      </li>
                      <li>
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        <div>
                            <strong>Use case:</strong> Analyzes raw HTTP response headers to identify missing or misconfigured security mechanisms.
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
                     <h3 class="card-title">Analyzer</h3>
                     <div class="card-actions">
                         <button class="btn btn-sm btn-ghost-danger" onclick="document.getElementById('headerInput').value=''; analyzeHeaders();">Clear</button>
                     </div>
                  </div>
                  <div class="card-body">
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="form-label required">Raw Headers</label>
                            <button class="btn btn-sm btn-ghost-primary" onclick="pasteFromClipboard()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>
                                Paste
                            </button>
                        </div>
                        <textarea class="form-control tool-textarea" id="headerInput" rows="8" placeholder="HTTP/1.1 200 OK
Server: Apache
Date: Mon, 27 Jul 2023 12:28:53 GMT..."></textarea>
                        <div class="mt-2 text-end">
                            <button class="btn btn-primary" onclick="analyzeHeaders()">Analyze Security</button>
                        </div>
                    </div>

                    <div id="resultsArea" style="display:none;">
                        <h4 class="card-title">Security Report</h4>
                        <div class="card mb-3">
                            <ul class="list-group list-group-flush" id="securityReport">
                                
                            </ul>
                        </div>
                        
                        <h4 class="card-title mt-4">All Detected Headers</h4>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <tbody id="allHeadersTable">
                                </tbody>
                            </table>
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
        const securityHeaders = {
            "Strict-Transport-Security": { recommended: true, msg: "HSTS enforces HTTPS connections." },
            "Content-Security-Policy": { recommended: true, msg: "CSP prevents XSS and data injection." },
            "X-Frame-Options": { recommended: true, msg: "Prevents clickjacking attacks." },
            "X-Content-Type-Options": { recommended: true, msg: "Prevents MIME-sniffing." },
            "Referrer-Policy": { recommended: true, msg: "Controls how much referrer info is sent." },
            "Permissions-Policy": { recommended: true, msg: "Controls browser feature access." },
            "X-XSS-Protection": { recommended: false, msg: "Legacy header, CSP is preferred." },
        };

        function escapeHtml(text) {
          var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
          };
          return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        function analyzeHeaders() {
            const input = document.getElementById('headerInput').value;
            if (!input.trim()) return;

            const lines = input.split('\n');
            const foundHeaders = {};

            const tableBody = document.getElementById('allHeadersTable');
            tableBody.innerHTML = "";

            lines.forEach(line => {
                const parts = line.split(':');
                if (parts.length >= 2) {
                    const key = parts[0].trim();
                    const value = parts.slice(1).join(':').trim();
                    foundHeaders[key.toLowerCase()] = value;

                    const safeKey = escapeHtml(key);
                    const safeValue = escapeHtml(value);

                    const row = `<tr><td><span class='fw-bold'>${safeKey}</span></td><td class='text-muted'>${safeValue}</td></tr>`;
                    tableBody.innerHTML += row;
                }
            });

            const reportList = document.getElementById('securityReport');
            reportList.innerHTML = "";

            for (const [header, info] of Object.entries(securityHeaders)) {
                const lowerHeader = header.toLowerCase();
                if (foundHeaders[lowerHeader]) {
                    // Header found
                    if (info.recommended) {
                         reportList.innerHTML += `<li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-green me-2">PASS</span>
                                <strong>${header}</strong>
                                <div class="text-muted small">${info.msg}</div>
                            </div>
                            <span class="text-green">Present</span>
                        </li>`;
                    } else {
                         reportList.innerHTML += `<li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-yellow me-2">WARN</span>
                                <strong>${header}</strong>
                                <div class="text-muted small">${info.msg}</div>
                            </div>
                            <span class="text-yellow">Legacy/Optional</span>
                        </li>`;
                    }
                } else {
                    // Header missing
                    if (info.recommended) {
                         reportList.innerHTML += `<li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-red me-2">MISSING</span>
                                <strong>${header}</strong>
                                <div class="text-muted small">${info.msg}</div>
                            </div>
                            <span class="text-red">Not Found</span>
                        </li>`;
                    }
                }
            }

            document.getElementById('resultsArea').style.display = 'block';
        }

        async function pasteFromClipboard() {
            try {
                const text = await navigator.clipboard.readText();
                document.getElementById("headerInput").value = text;
                analyzeHeaders();
            } catch (err) {
                console.error('Failed to read clipboard contents: ', err);
                alert("Failed to paste. Please allow clipboard access.");
            }
        }
    </script>
    <!-- Libs JS -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
