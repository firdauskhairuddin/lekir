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
    <title><?php echo htmlentities($title); ?> - JWT Tools</title>
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
      
      textarea.font-monospace {
          font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
          font-size: 0.85rem;
          background: #fcfdfe;
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

      .json-viewer {
          padding: 10px;
          background-color: #f8f9fa;
          border-radius: 4px;
          border: 1px solid #e6e7e9;
          overflow: auto;
          font-family: monospace;
          white-space: pre-wrap;
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
                  JWT Analyzer
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
                            <!-- Download SVG icon from http://tabler-icons.io/i/id-badge-2 -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12h3v4h-3z" /><path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" /><path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M14 16h2" /><path d="M14 12h4" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">JSON Web Tokens</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Token Encoding/Decoding
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Standard:</strong> RFC 7519
                        </div>
                      </li>
                      <li>
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        <div>
                            <strong>Use case:</strong> Compact, URL-safe means of representing claims to be transferred between two parties. Commonly used for authorization.
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
                     <h3 class="card-title">Token Tool</h3>
                     <div class="card-actions">
                        <button class="btn btn-sm btn-ghost-danger" id="jwt-clear">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            Reset
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <!-- Left Column: Input Claims & Signing -->
                      <div class="col-md-6 border-end">
                          <h4 class="card-title text-muted mb-3">1. Define Claims & Sign</h4>
                          
                          <div class="mb-3">
                              <label class="form-label">Algorithm</label>
                              <select class="form-select" id="jwt-alg">
                                <option value="HS256">HS256 (HMAC SHA-256)</option>
                                <option value="HS384">HS384 (HMAC SHA-384)</option>
                                <option value="HS512">HS512 (HMAC SHA-512)</option>
                                <option value="none">None (Unsecured)</option>
                              </select>
                          </div>

                          <div class="mb-3">
                              <label class="form-label">Header (JSON)</label>
                              <textarea class="form-control font-monospace" id="jwt-header" rows="3" spellcheck="false">
{
  "alg": "HS256",
  "typ": "JWT"
}</textarea>
                          </div>
                          
                          <div class="mb-3">
                              <label class="form-label">Payload (JSON)</label>
                              <textarea class="form-control font-monospace" id="jwt-payload" rows="6" spellcheck="false">
{
  "sub": "1234567890",
  "name": "Jane Doe",
  "admin": true,
  "iat": 1516239022
}</textarea>
                          </div>
                          
                          <div class="mb-3">
                              <div class="d-flex justify-content-between">
                                  <label class="form-label">Secret Key</label>
                                  <a href="#" class="link-secondary small" id="toggle-secret">Show</a>
                              </div>
                              <input type="password" class="form-control font-monospace" id="jwt-secret" value="secret">
                          </div>
                          
                          <div class="d-grid gap-2">
                              <button class="btn btn-primary" id="jwt-encode">
                                  Encode & Sign
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" /></svg>
                              </button>
                          </div>
                      </div>

                      <!-- Right Column: Encoded Output & Verification -->
                      <div class="col-md-6">
                           <h4 class="card-title text-muted mb-3">2. Encoded Token</h4>
                           
                           <div class="mb-3">
                               <label class="form-label">JWT String</label>
                               <textarea class="form-control font-monospace" id="jwt-encoded" rows="8" placeholder="Paste a token here to decode..." spellcheck="false"></textarea>
                           </div>

                           <div class="d-flex gap-2 mb-3">
                                <button class="btn btn-outline-primary w-100" id="jwt-decode">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                    Decode
                                </button>
                                <button class="btn btn-outline-success w-100" id="jwt-copy">
                                    Copy
                                </button>
                           </div>
                           
                           <div class="hr-text text-muted">Decoded Output</div>
                           
                           <div class="mb-2">
                               <label class="form-label">Header</label>
                               <div id="jwt-decoded-header" class="json-viewer text-muted"></div>
                           </div>
                           
                           <div class="mb-3">
                               <label class="form-label">Payload</label>
                               <div id="jwt-decoded-payload" class="json-viewer text-muted"></div>
                           </div>
                           
                           <div id="jwt-status" class="alert d-none" role="alert"></div>
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
    
    <!-- Dependencies -->
    <script src="<?php echo $base_path; ?>dist/js/base64.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <!-- Custom JS -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Toggle secret visibility
      document.getElementById('toggle-secret').addEventListener('click', function(e) {
        e.preventDefault();
        const secretInput = document.getElementById('jwt-secret');
        const isPass = secretInput.type === 'password';
        secretInput.type = isPass ? 'text' : 'password';
        this.textContent = isPass ? 'Hide' : 'Show';
      });
      
      // Update header when algorithm changes
      document.getElementById('jwt-alg').addEventListener('change', function() {
        const headerTextarea = document.getElementById('jwt-header');
        try {
          const header = JSON.parse(headerTextarea.value || '{}');
          header.alg = this.value;
          headerTextarea.value = JSON.stringify(header, null, 2);
        } catch (e) {
             // If invalid JSON, just ignore auto-update
        }
      });
      
      // Copy to clipboard
      document.getElementById('jwt-copy').addEventListener('click', function() {
        const jwt = document.getElementById('jwt-encoded');
        jwt.select();
        document.execCommand('copy');
        
        const originalText = this.innerHTML;
        this.textContent = "Copied!";
        setTimeout(() => this.innerHTML = originalText, 2000);
      });
      
      // Clear all fields
      document.getElementById('jwt-clear').addEventListener('click', function() {
        document.getElementById('jwt-header').value = JSON.stringify({"alg": "HS256", "typ": "JWT"}, null, 2);
        document.getElementById('jwt-payload').value = JSON.stringify({"sub": "1234567890", "name": "Jane Doe", "admin": true}, null, 2);
        document.getElementById('jwt-secret').value = 'secret';
        document.getElementById('jwt-encoded').value = '';
        document.getElementById('jwt-decoded-header').textContent = '';
        document.getElementById('jwt-decoded-payload').textContent = '';
        document.getElementById('jwt-alg').value = 'HS256';
        
        const statusEl = document.getElementById('jwt-status');
        statusEl.className = 'alert d-none';
      });
      
      function showStatus(message, type) {
        const statusEl = document.getElementById('jwt-status');
        let alertClass = 'alert-info';
        if (type === 'success') alertClass = 'alert-success';
        if (type === 'danger') alertClass = 'alert-danger';
        if (type === 'warning') alertClass = 'alert-warning';
        
        statusEl.className = `alert ${alertClass}`;
        statusEl.textContent = message;
        statusEl.classList.remove('d-none');
      }
      
      // Base64URL encode helpers
      function base64urlencode(str) {
        return Base64.encode(str).replace(/=/g, '').replace(/\+/g, '-').replace(/\//g, '_');
      }
      
      function base64urldecode(str) {
        str = str + Array((4 - str.length % 4) % 4 + 1).join('=');
        return Base64.decode(str.replace(/-/g, '+').replace(/_/g, '/'));
      }
      
      // Encode JWT
      document.getElementById('jwt-encode').addEventListener('click', function() {
        try {
          // 1. Get and validate JSON
          let headerObj, payloadObj;
          try {
             headerObj = JSON.parse(document.getElementById('jwt-header').value);
          } catch(e) { throw new Error("Invalid Header JSON"); }
          
          try {
             payloadObj = JSON.parse(document.getElementById('jwt-payload').value);
          } catch(e) { throw new Error("Invalid Payload JSON"); }

          const secret = document.getElementById('jwt-secret').value;
          
          // 2. Encode parts
          const encodedHeader = base64urlencode(JSON.stringify(headerObj));
          const encodedPayload = base64urlencode(JSON.stringify(payloadObj));
          const toSign = `${encodedHeader}.${encodedPayload}`;
          
          // 3. Sign
          let signature = '';
          if (headerObj.alg && headerObj.alg !== 'none') {
            const alg = headerObj.alg;
            if (alg === 'HS256') {
              signature = CryptoJS.HmacSHA256(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else if (alg === 'HS384') {
              signature = CryptoJS.HmacSHA384(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else if (alg === 'HS512') {
              signature = CryptoJS.HmacSHA512(toSign, secret).toString(CryptoJS.enc.Base64url);
            } else {
               // Fallback or warning
               console.warn("Unsupported algo for manual signing in UI: " + alg);
            }
          }
          
          const jwt = `${encodedHeader}.${encodedPayload}${signature ? '.' + signature : ''}`;
          document.getElementById('jwt-encoded').value = jwt;
          
          // Also update decoded views to match
          document.getElementById('jwt-decoded-header').textContent = JSON.stringify(headerObj, null, 2);
          document.getElementById('jwt-decoded-payload').textContent = JSON.stringify(payloadObj, null, 2);
          
          showStatus('Token generated and signed.', 'success');
        } catch (e) {
          showStatus(e.message, 'danger');
        }
      });
      
      // Decode JWT
      document.getElementById('jwt-decode').addEventListener('click', function() {
        try {
          const jwt = document.getElementById('jwt-encoded').value.trim();
          if(!jwt) { throw new Error("Please enter a JWT string."); }
          
          const parts = jwt.split('.');
          if (parts.length < 2) throw new Error('Invalid JWT format.');
          
          // Decode
          const headerObj = JSON.parse(base64urldecode(parts[0]));
          const payloadObj = JSON.parse(base64urldecode(parts[1]));
          
          // Update decoded views
          document.getElementById('jwt-decoded-header').textContent = JSON.stringify(headerObj, null, 2);
          document.getElementById('jwt-decoded-payload').textContent = JSON.stringify(payloadObj, null, 2);
          
          // Update Input views (Reverse engineering)
          document.getElementById('jwt-header').value = JSON.stringify(headerObj, null, 2);
          document.getElementById('jwt-payload').value = JSON.stringify(payloadObj, null, 2);
          if (headerObj.alg) document.getElementById('jwt-alg').value = headerObj.alg;

          // Verification Check
          if (parts.length === 3) {
             const secret = document.getElementById('jwt-secret').value;
             const alg = headerObj.alg;
             const toSign = `${parts[0]}.${parts[1]}`;
             let calculatedSig = '';
             
             if (alg === 'HS256') calculatedSig = CryptoJS.HmacSHA256(toSign, secret).toString(CryptoJS.enc.Base64url);
             else if (alg === 'HS384') calculatedSig = CryptoJS.HmacSHA384(toSign, secret).toString(CryptoJS.enc.Base64url);
             else if (alg === 'HS512') calculatedSig = CryptoJS.HmacSHA512(toSign, secret).toString(CryptoJS.enc.Base64url);
             
             if (calculatedSig === parts[2]) {
                 showStatus('Signature Verified (Valid)', 'success');
             } else {
                 showStatus('Signature Mismatch (Invalid or Wrong Secret)', 'danger');
             }
          } else {
              showStatus('Decoded (Unsigned)', 'info');
          }

        } catch (e) {
          showStatus('Error decoding: ' + e.message, 'danger');
        }
      });
    });
    </script>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>