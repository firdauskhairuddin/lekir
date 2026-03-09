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

// Function to validate URL format (basic validation)
function validateUrl($url) {
    // Basic URL format check
    if (!preg_match('/^https?:\/\//i', $url)) {
        return false;
    }
    
    // Parse URL
    $parsed = parse_url($url);
    if (!$parsed || !isset($parsed['host'])) {
        return false;
    }
    
    // Basic host validation
    $host = $parsed['host'];
    if (!preg_match('/^[a-zA-Z0-9\-\.]+$/', $host)) {
        return false;
    }
    
    return true;
}

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
    
    // Validate URL
    if (!validateUrl($url)) {
        $error = "Invalid URL format. Only http:// and https:// URLs are allowed.";
    } else {
        try {
            $client = new Client([
                'timeout' => 5,
                'allow_redirects' => true,
                'http_errors' => false,
            ]);
            
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode();
            $content = (string) $response->getBody();
            
            if ($statusCode !== 200) {
                $error = "Failed to fetch URL. HTTP Status: $statusCode";
            } else {
                $contentType = detectContentType($url, $content);
            }
            
        } catch (Exception $e) {
            $error = "Error loading content: " . htmlspecialchars($e->getMessage());
        }
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-world-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 12a9 9 0 1 0 -9 9" /><path d="M3.6 9h16.8" /><path d="M3.6 15h7.9" /><path d="M11.5 3a17 17 0 0 0 0 18" /><path d="M12.5 3a17 17 0 0 1 2.25 10.5" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M20.2 20.2l1.8 1.8" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">Server-Side Request Forgery</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:green;"><b>Low</b></font></li>
                      <li><b>Short Form</b> : SSRF</li>
                      <li><b>Injection Point</b> : $_GET['url']</li>
                      <li><b>Why this happen</b> : SSRF occurs when an attacker can influence the server to make requests to unintended locations. In this case, the server fetches content from a user-supplied URL and displays it. Attackers can use this to scan internal networks, access metadata services (like AWS metadata), or interact with internal-only APIs.</li>
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
                            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bulb" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg> Try accessing <code>http://localhost</code> or <code>http://127.0.0.1</code></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bulb" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg> Scan for open ports on the local system.</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bulb" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg> Use <code>render=1</code> to see content within the page.</li>
                        </ul>
                    </div>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                        <div class="markdown">
                          <div>
                            <h3 class="lh-1">SSRF Content Viewer</h3>
                          </div>
                          <p>Enter a URL to fetch and view its content. This service allows you to preview external images or web pages directly from our server.</p>

                          <form role="form" action="" method="GET" >
                            <div class="mb-3">
                              <label class="form-label">Target URL</label>
                              <div class="input-group mb-2">
                                <span class="input-group-text">
                                  URL
                                </span>
                                <input type="text" class="form-control" name="url" autocomplete="off" placeholder="https://example.com/image.jpg" value="<?php echo htmlspecialchars($url); ?>" required>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                    Fetch Content
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
                                <h4>Fetched Content (<?php echo htmlspecialchars($contentType); ?>):</h4>
                                <div class="card overflow-hidden">
                                    <div class="card-body bg-light overflow-auto" style="max-height: 500px;">
                                        <?php if (strpos($contentType, 'image/') === 0): ?>
                                            <div class="text-center">
                                                <img src="?url=<?php echo urlencode($url); ?>" class="img-fluid rounded shadow-sm">
                                            </div>
                                        <?php elseif (strpos($contentType, 'text/html') === 0): ?>
                                            <div class="bg-white p-3 border rounded">
                                                <?php echo $content; ?>
                                            </div>
                                        <?php else: ?>
                                            <pre class="mb-0 bg-dark text-white p-3 rounded"><?php echo htmlspecialchars($content); ?></pre>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php elseif (isset($_GET['url'])): ?>
                                <!-- Error handled above -->
                            <?php else: ?>
                                <div class="bg-light-lt p-5 text-center border-dashed rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-download text-muted mb-2" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4" /><path d="M12 13l0 9" /><path d="M9 19l3 3l3 -3" /></svg>
                                    <h3 class="text-muted">Ready to fetch</h3>
                                    <p class="text-muted">Enter a URL above to see its content. Try an image or a web page!</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-4 alert alert-info bg-info-lt">
                            <h4 class="alert-title">🔒 Security Note</h4>
                            <div class="text-secondary">
                                This implementation uses <strong>Guzzle</strong> for HTTP requests. While it has basic URL validation, it may still be vulnerable to certain SSRF techniques if internal network access is not properly restricted.
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
              <h5 class="modal-title">🎯 SSRF Injection Payloads</h5>
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
