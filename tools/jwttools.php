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
                        <h3 class="lh-1">JSON Web Token Tools</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Type</b> : JWT Encode/Decode</b></li>
                      <li><b>Short Form</b> : JWT</b></li>
                      <li><b>Use case</b> : Decode or encode basic JWT Token.</li>
                      <li><b>Read More</b> : <a href="https://firdauskhairuddin.gitbook.io" target="_blank">Link</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">JWT Encoder/Decoder</h3>
                      <div class="card-actions">
                        <a href="https://jwt.io/introduction" target="_blank" class="btn btn-help" data-bs-toggle="tooltip" title="JWT Documentation">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 17l0 .01"></path>
                            <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path>
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row g-3">
                        <!-- Input Column -->
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">
                              Header
                              <span class="form-help" data-bs-toggle="tooltip" title="JWT header containing algorithm and token type">?</span>
                            </label>
                            <textarea class="form-control font-monospace" id="jwt-header" rows="4" spellcheck="false">{
  "alg": "HS256",
  "typ": "JWT"
}</textarea>
                            <div class="mt-1">
                              <select class="form-select form-select-sm w-auto" id="jwt-alg">
                                <option value="HS256">HS256</option>
                                <option value="HS384">HS384</option>
                                <option value="HS512">HS512</option>
                                <option value="none">None (unsecured)</option>
                              </select>
                            </div>
                          </div>
                          
                          <div class="mb-3">
                            <label class="form-label">
                              Payload
                              <span class="form-help" data-bs-toggle="tooltip" title="JWT claims (data you want to transmit)">?</span>
                            </label>
                            <textarea class="form-control font-monospace" id="jwt-payload" rows="6" spellcheck="false">{
  "sub": "1234567890",
  "name": "John Doe",
  "iat": 1516239022
}</textarea>
                          </div>
                          
                          <div class="mb-3">
                            <label class="form-label">
                              Secret Key
                              <span class="form-help" data-bs-toggle="tooltip" title="Leave empty for unsigned tokens">?</span>
                            </label>
                            <div class="input-group">
                              <input type="password" class="form-control" id="jwt-secret" value="your-256-bit-secret">
                              <button class="btn btn-outline-secondary" type="button" id="toggle-secret">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                  <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                </svg>
                              </button>
                            </div>
                          </div>
                          
                          <div class="d-flex gap-2">
                            <button class="btn btn-primary" id="jwt-encode">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2"></path>
                                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                <path d="M20 21l2 -2l-2 -2"></path>
                                <path d="M17 17l-2 2l2 2"></path>
                              </svg>
                              Encode
                            </button>
                            <button class="btn btn-success" id="jwt-decode">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                                <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M8 11v-5a4 4 0 0 1 8 0"></path>
                              </svg>
                              Decode
                            </button>
                            <button class="btn btn-outline-secondary" id="jwt-clear">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                              </svg>
                              Clear
                            </button>
                          </div>
                        </div>
                        
                        <!-- Output Column -->
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">
                              Encoded JWT
                              <span class="form-help" data-bs-toggle="tooltip" title="This is your complete JWT token">?</span>
                            </label>
                            <textarea class="form-control font-monospace" id="jwt-encoded" rows="14" spellcheck="false" placeholder="Your encoded JWT will appear here"></textarea>
                            <div class="mt-2 d-flex gap-2">
                              <button class="btn btn-sm btn-outline-primary" id="jwt-copy">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                                  <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                                </svg>
                                Copy
                              </button>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="jwt-verify">
                                <label class="form-check-label" for="jwt-verify">Verify Signature</label>
                              </div>
                            </div>
                          </div>
                          
                          <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                              <label class="form-label mb-0">Decoded Header</label>
                              <span class="badge bg-blue-lt" id="header-alg-badge">Algorithm: HS256</span>
                            </div>
                            <div class="card">
                              <div class="card-body p-2">
                                <pre class="m-0 p-2 font-monospace" id="jwt-decoded-header" style="min-height: 80px;"></pre>
                              </div>
                            </div>
                          </div>
                          
                          <div class="mb-3">
                            <label class="form-label">Decoded Payload</label>
                            <div class="card">
                              <div class="card-body p-2">
                                <pre class="m-0 p-2 font-monospace" id="jwt-decoded-payload" style="min-height: 120px;"></pre>
                              </div>
                            </div>
                          </div>
                          
                          <div class="alert alert-info d-flex align-items-center d-none" id="jwt-status">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                              <path d="M12 8l.01 0"></path>
                              <path d="M11 12l1 0l0 4l1 0"></path>
                            </svg>
                            <div class="ms-2" id="status-message">Ready</div>
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

    <script src="<?php echo $base_path; ?>dist/js/base64.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <script>
    document.addEventListener(\"DOMContentLoaded", function() {
      // Initialize tooltips
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle='tooltip']'));
      tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
      
      // Toggle secret visibility
      document.getElementById('toggle-secret').addEventListener('click', function() {
        const secretInput = document.getElementById('jwt-secret');
        const icon = this.querySelector('svg');
        if (secretInput.type === 'password') {
          secretInput.type = 'text';
          icon.innerHTML = '<path stroke='none' d="M0 0h24v24H0z" fill="none"></path><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"></path><path d="M3 3l18 18'></path>";
        } else {
          secretInput.type = 'password';
          icon.innerHTML = '<path stroke='none' d="M0 0h24v24H0z" fill="none"></path><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6'></path>";
        }
      });
      
      // Update header when algorithm changes
      document.getElementById('jwt-alg').addEventListener('change', function() {
        const headerTextarea = document.getElementById('jwt-header');
        try {
          const header = JSON.parse(headerTextarea.value || '{}');
          header.alg = this.value;
          headerTextarea.value = JSON.stringify(header, null, 2);
          document.getElementById('header-alg-badge').textContent = `Algorithm: ${this.value}`;
        } catch (e) {
          showStatus('Error updating algorithm: ' + e.message, 'danger');
        }
      });
      
      // Copy to clipboard
      document.getElementById('jwt-copy').addEventListener('click', function() {
        const jwt = document.getElementById('jwt-encoded');
        jwt.select();
        document.execCommand('copy');
        showStatus('JWT copied to clipboard!', 'success');
      });
      
      // Clear all fields
      document.getElementById('jwt-clear').addEventListener('click', function() {
        document.getElementById('jwt-header').value = '{\n  'alg': "HS256",\n  "typ": "JWT"\n}";
        document.getElementById('jwt-payload').value = '{\n  'sub': "1234567890",\n  "name": "John Doe",\n  "iat": 1516239022\n}";
        document.getElementById('jwt-secret').value = 'your-256-bit-secret';
        document.getElementById('jwt-encoded').value = '';
        document.getElementById('jwt-decoded-header').textContent = '';
        document.getElementById('jwt-decoded-payload').textContent = '';
        document.getElementById('jwt-alg').value = 'HS256';
        document.getElementById('header-alg-badge').textContent = 'Algorithm: HS256';
        document.getElementById('jwt-secret').type = 'password';
        showStatus('Fields cleared', 'info');
      });
      
      // Show status message
      function showStatus(message, type) {
        const statusEl = document.getElementById('jwt-status');
        statusEl.className = `alert alert-${type} d-flex align-items-center`;
        document.getElementById('status-message').textContent = message;
        statusEl.classList.remove('d-none');
        
        setTimeout(() => {
          statusEl.classList.add('d-none');
        }, 3000);
      }
      
      // Base64URL encode
      function base64urlencode(str) {
        return Base64.encode(str)
          .replace(/=/g, '')
          .replace(/\+/g, '-')
          .replace(/\//g, '_');
      }
      
      // Base64URL decode
      function base64urldecode(str) {
        // Add padding if needed
        str = str + Array((4 - str.length % 4) % 4 + 1).join('=');
        return Base64.decode(str.replace(/-/g, '+').replace(/_/g, '/'));
      }
      
      // Encode JWT
      document.getElementById('jwt-encode').addEventListener('click', function() {
        try {
          const header = JSON.parse(document.getElementById('jwt-header').value);
          const payload = JSON.parse(document.getElementById('jwt-payload').value);
          const secret = document.getElementById('jwt-secret').value;
          
          const encodedHeader = base64urlencode(JSON.stringify(header));
          const encodedPayload = base64urlencode(JSON.stringify(payload));
          
          let signature = '';
          if (secret && header.alg !== 'none') {
            const alg = header.alg || 'HS256';
            const toSign = `${encodedHeader}.${encodedPayload}`;
            
            if (alg === 'HS256') {
              signature = CryptoJS.HmacSHA256(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else if (alg === 'HS384') {
              signature = CryptoJS.HmacSHA384(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else if (alg === 'HS512') {
              signature = CryptoJS.HmacSHA512(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else {
              throw new Error(`Unsupported algorithm: ${alg}`);
            }
          }
          
          const jwt = `${encodedHeader}.${encodedPayload}${signature ? '.' + signature : ''}`;
          document.getElementById('jwt-encoded').value = jwt;
          document.getElementById('jwt-decoded-header').textContent = JSON.stringify(header, null, 2);
          document.getElementById('jwt-decoded-payload').textContent = JSON.stringify(payload, null, 2);
          
          showStatus('JWT encoded successfully!', 'success');
        } catch (e) {
          showStatus('Error encoding JWT: ' + e.message, 'danger');
        }
      });
      
      // Decode JWT
      document.getElementById('jwt-decode').addEventListener('click', function() {
        try {
          const jwt = document.getElementById('jwt-encoded').value.trim();
          const parts = jwt.split('.');
          
          if (parts.length < 2 || parts.length > 3) {
            throw new Error('Invalid JWT format - expected 2 or 3 parts');
          }
          
          // Decode header
          const header = JSON.parse(base64urldecode(parts[0]));
          document.getElementById('jwt-decoded-header').textContent = JSON.stringify(header, null, 2);
          document.getElementById('jwt-header').value = JSON.stringify(header, null, 2);
          document.getElementById('jwt-alg').value = header.alg || 'HS256';
          document.getElementById('header-alg-badge').textContent = `Algorithm: ${header.alg || 'HS256'}`;
          
          // Decode payload
          const payload = JSON.parse(base64urldecode(parts[1]));
          document.getElementById('jwt-decoded-payload').textContent = JSON.stringify(payload, null, 2);
          document.getElementById('jwt-payload').value = JSON.stringify(payload, null, 2);
          
          // Verify signature if requested
          if (document.getElementById('jwt-verify').checked && parts.length === 3) {
            const secret = document.getElementById('jwt-secret').value;
            if (!secret && header.alg !== 'none') {
              throw new Error('Secret required for verification');
            }
            
            const alg = header.alg || 'HS256';
            if (alg === 'none') {
              showStatus('Warning: Unsecured JWT (alg=none)', 'warning');
              return;
            }
            
            const toSign = `${parts[0]}.${parts[1]}`;
            let calculatedSig = '';
            
            if (alg === 'HS256') {
              calculatedSig = CryptoJS.HmacSHA256(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else if (alg === 'HS384') {
              calculatedSig = CryptoJS.HmacSHA384(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else if (alg === 'HS512') {
              calculatedSig = CryptoJS.HmacSHA512(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else {
              throw new Error(`Unsupported algorithm: ${alg}`);
            }
            
            if (calculatedSig !== parts[2]) {
              throw new Error('Invalid signature! The token may have been tampered with.');
            } else {
              showStatus('Signature is valid!', 'success');
            }
          }
        } catch (e) {
          showStatus('Error decoding JWT: ' + e.message, 'danger');
        }
      });
    });
    </script>
    <!-- Tabler Core -->
    <script src='<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062' defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>