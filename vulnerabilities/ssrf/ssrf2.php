<?php
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

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

require_once $base_path . 'vendor/autoload.php';

use GuzzleHttp\Client;

session_start();
include($base_path . 'core/configuration.php');
include($base_path . "core/function.php");

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set("display_errors", 1);
error_reporting(E_ALL);

// Function to detect content type
function detectContentType($url, $content) {
    $path = parse_url($url, PHP_URL_PATH);
    
    // Try URL extension first
    if ($path) {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $mime_types = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            'txt' => 'text/plain',
            'html' => 'text/html',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'pdf' => 'application/pdf',
        ];
        
        if (isset($mime_types[$extension])) {
            return $mime_types[$extension];
        }
    }
    
    // Fallback to content detection
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_buffer($finfo, $content);
        finfo_close($finfo);
        return $mime ?: 'application/octet-stream';
    }
    
    // Final fallback
    return 'application/octet-stream';
}

$error = null;
$content = null;
$contentType = null;
$url = "";

// Handle image loading
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    
    try {
        // VULNERABLE: Using file_get_contents which may allow file:// protocol
        // CTF HINT: This is less restrictive than Guzzle/cURL
        $content = @file_get_contents($url);
        
        if ($content === false) {
            $lastError = error_get_last();
            $error = "Failed to fetch URL: " . ($lastError['message'] ?? 'Unknown error');
        } else if (empty($content)) {
            $error = "URL returned empty content";
        } else {
            $contentType = detectContentType($url, $content);
        }
        
    } catch (Exception $e) {
        $error = "Error loading content: " . htmlspecialchars($e->getMessage());
    }
    
    // If we have content and it's not a "rendered" view, handle direct output
    if ($content !== null && $error === null && !isset($_GET['render'])) {
        header("Content-Type: $contentType");
        
        // For HTML content, wrap it
        if (strpos($contentType, 'text/html') === 0) {
            echo "<!DOCTYPE html><html><head><title>Loaded Content</title></head><body>";
            echo "<div style='padding: 20px; border: 1px solid #ccc;'>";
            echo $content;
            echo "</div></body></html>";
        } else {
            echo $content;
        }
        exit();
    }
}
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M7 11v-4a5 5 0 0 1 10 0v4" /><path d="M12 16l0 .01" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">SSRF & LFI Challenge</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:orange;"><b>Medium</b></font></li>
                      <li><b>Short Form</b> : SSRF / LFI</li>
                      <li><b>Injection Point</b> : $_GET['url']</li>
                      <li><b>Why this happen</b> : This challenge uses PHP's <code>file_get_contents()</code> function without proper validation. This function is highly versatile and supports various wrappers and protocols. If <code>allow_url_fopen</code> is enabled, it can fetch remote URLs (SSRF). Additionally, it can read local files via the <code>file:///</code> protocol, leading to Local File Inclusion (LFI).</li>
                      <li><b>Author</b> : EagleTube</li>
                      <li><b>Read More</b> : <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/server-side-request-forgery-ssrf' target='_blank'>Link</a></li>
                      <br>
                      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-payloads">
                      View Payload
                      </a>
                    </ul>   
                  </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Exploitation Hints</h4>
                        <ul class="list-unstyled space-y-1 small">
                            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M7 11v-4a5 5 0 0 1 10 0v4" /><path d="M12 16l0 .01" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg> Try the <code>file:///</code> protocol to read system files like <code>/etc/passwd</code>.</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M7 11v-4a5 5 0 0 1 10 0v4" /><path d="M12 16l0 .01" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg> Explore other PHP wrappers like <code>php://filter</code>.</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M7 11v-4a5 5 0 0 1 10 0v4" /><path d="M12 16l0 .01" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg> Use <code>render=1</code> for in-page content viewing.</li>
                        </ul>
                    </div>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                        <div class="markdown">
                          <div>
                            <h3 class="lh-1">Universal Content Fetcher</h3>
                          </div>
                          <p>Fetch content from almost anywhere. Our advanced fetcher supports multiple protocols and file types for seamless integration.</p>

                          <form role="form" action="" method="GET" >
                            <div class="mb-3">
                              <label class="form-label">Target Resource</label>
                              <div class="input-group mb-2">
                                <span class="input-group-text">
                                  PATH / URL
                                </span>
                                <input type="text" class="form-control" name="url" autocomplete="off" placeholder="https://example.com/image.jpg or file:///etc/passwd" value="<?php echo htmlspecialchars($url); ?>" required>
                              </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="render" value="1" <?php echo isset($_GET['render']) ? 'checked' : ''; ?>>
                                    <span class="form-check-label">Render content in-page</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                    Fetch Resource
                                </button>
                            </div>
                          </form> 
                        </div>

                        <?php if ($error): ?>
                            <div class="alert alert-danger mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <?php if ($content !== null && !$error): ?>
                                <h4>Fetched Resource (<?php echo htmlspecialchars($contentType); ?>):</h4>
                                <div class="card overflow-hidden">
                                    <div class="card-body bg-light overflow-auto" style="max-height: 500px;">
                                        <?php if (strpos($contentType, 'image/') === 0): ?>
                                            <div class="text-center">
                                                <img src="?url=<?php echo urlencode($url); ?>" class="img-fluid rounded shadow-sm">
                                            </div>
                                        <?php elseif (strpos($contentType, 'text/html') === 0): ?>
                                            <div class="bg-white p-3 border rounded shadow-sm">
                                                <?php echo $content; ?>
                                            </div>
                                        <?php else: ?>
                                            <pre class="mb-0 bg-dark text-white p-3 rounded shadow-sm" style="font-family: 'Courier New', monospace;"><?php echo htmlspecialchars($content); ?></pre>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php elseif (isset($_GET['url'])): ?>
                                <!-- Error handled above -->
                            <?php else: ?>
                                <div class="bg-light-lt p-5 text-center border-dashed rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-search text-muted mb-2" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5" /><path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" /><path d="M18.5 19.5l2.5 2.5" /></svg>
                                    <h3 class="text-muted">No resource selected</h3>
                                    <p class="text-muted">Enter a URL or a file path to see its content. Try <code>file:///etc/passwd</code> for testing!</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-4 alert alert-warning bg-warning-lt">
                            <h4 class="alert-title">🔓 Vulnerability Note</h4>
                            <div class="text-secondary">
                                This implementation uses <code>file_get_contents()</code>. This is highly dangerous as it supports many protocols by default, including <code>file:///</code>, <code>php://</code>, and potentially <code>data://</code>, making it prone to both SSRF and Local/Remote File Inclusion.
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

      <div class="modal modal-blur fade" id="modal-payloads" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">🎯 SSRF/LFI Payloads</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
              <pre class="bg-dark text-white p-3 m-0" style="font-family: 'Courier New', monospace; white-space: pre-wrap; word-break: break-all; border-radius: 0;"><?php echo htmlspecialchars(@file_get_contents($base_path . 'payloads/ssrf_payload.txt')); ?></pre>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>payloads/ssrf_payload.txt" download class="btn btn-primary">Download Payload</a>
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