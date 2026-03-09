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
require_once $base_path . 'vendor/autoload.php';

use GuzzleHttp\Client;

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set("display_errors", 1);
error_reporting(E_ALL);

$data_cookie = ['mode'=>'https','status'=>true];
$httpsOnly = true;

// Handle HTTP mode toggle
if (isset($_GET['http'])) {
    if ($_GET['http'] === 'enable') {
        setcookie('https_only', serialize($data_cookie), time() + (86400 * 30), "/"); 
    } elseif ($_GET['http'] === 'disable') {
        $data_cookie['status'] = false;
        setcookie('https_only', serialize($data_cookie), time() + (86400 * 30), "/");
    }
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}

// Read HTTPS-only setting from cookie
if(isset($_COOKIE['https_only'])){
    $mode = (Object)unserialize(urldecode($_COOKIE['https_only']));
    $httpsOnly = isset($mode->status) ? (Boolean)$mode->status : true;
}

// Function to validate URL
function validateUrl($url, $httpsOnly) {
    if ($httpsOnly) {
        if (!preg_match('/^https:\/\//i', $url)) {
            return false;
        }
    } else {
        if (!preg_match('/^https?:\/\//i', $url)) {
            return false;
        }
    }
    $parsed = parse_url($url);
    if (!$parsed || !isset($parsed['host'])) {
        return false;
    }
    $host = $parsed['host'];
    if (!preg_match('/^[a-zA-Z0-9\-\.]+$/', $host)) {
        return false;
    }
    $ip = gethostbyname($host);
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        $privateRanges = ['10.0.0.0/8','172.16.0.0/12','192.168.0.0/16','127.0.0.0/8','0.0.0.0/8','169.254.0.0/16','224.0.0.0/4','240.0.0.0/4'];
        foreach ($privateRanges as $range) {
            if (ipInRange($ip, $range)) return false;
        }
        $blockedHosts = ['localhost', '127.0.0.1', '0.0.0.0', '::1', '[::1]'];
        if (in_array(strtolower($host), $blockedHosts)) return false;
    }
    return true;
}

function ipInRange($ip, $range) {
    if (strpos($range, '/') !== false) {
        list($subnet, $bits) = explode('/', $range);
        $ipLong = ip2long($ip);
        $subnetLong = ip2long($subnet);
        $mask = -1 << (32 - $bits);
        $subnetLong &= $mask;
        return ($ipLong & $mask) == $subnetLong;
    }
    return $ip === $range;
}

function detectContentType($url, $content) {
    $path = parse_url($url, PHP_URL_PATH);
    if ($path) {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $mime_types = ['jpg'=>'image/jpeg','jpeg'=>'image/jpeg','png'=>'image/png','gif'=>'image/gif','bmp'=>'image/bmp','webp'=>'image/webp','svg'=>'image/svg+xml','txt'=>'text/plain','html'=>'text/html','json'=>'application/json','xml'=>'application/xml','pdf'=>'application/pdf'];
        if (isset($mime_types[$extension])) return $mime_types[$extension];
    }
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_buffer($finfo, $content);
        finfo_close($finfo);
        return $mime ?: 'application/octet-stream';
    }
    return 'application/octet-stream';
}

$error = null;
$content = null;
$contentType = null;

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    if (!validateUrl($url, $httpsOnly)) {
        $error = $httpsOnly ? "Invalid URL format. Only https:// URLs are allowed." : "Invalid URL format. Only http:// and https:// URLs are allowed.";
    } else {
        try {
            $clientOptions = ['timeout' => 5, 'allow_redirects' => true, 'http_errors' => false];
            if ($httpsOnly) {
                $clientOptions['curl'] = [CURLOPT_PROTOCOLS => CURLPROTO_HTTPS, CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS];
            } else {
                $clientOptions['curl'] = [CURLOPT_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS, CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS];
            }
            $client = new Client($clientOptions);
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

    if ($content !== null && $error === null) {
        if (!isset($_GET['render'])) {
             header("Content-Type: $contentType");
             echo $content;
             exit();
        }
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
                        <h3 class="lh-1">URL Content Viewer</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:orange;"><b>Medium</b></font></li>
                      <li><b>Short Form</b> : SSRF / DESERIALIZE</li>
                      <li><b>Injection Point</b> : Cookie: <code>https_only</code></li>
                      <li><b>Why this happen</b> : This page uses a serialized cookie to store user preferences (HTTPS-only mode). Untrusted data passed to <code>unserialize()</code> can lead to object injection. Additionally, this page is susceptible to Server-Side Request Forgery (SSRF) if URL validation is bypassed.</li>
                      <li><b>Author</b> : EagleTube</li>
                      <li><b>Read More</b> : <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/php-object-injection' target='_blank'>Link</a></li>
                    </ul>   
                  </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title text-muted">Mode Control</h4>
                        <div class="mb-3">
                            <span>HTTPS-Only: </span>
                            <span class="badge <?php echo $httpsOnly ? 'bg-success' : 'bg-danger'; ?>">
                                <?php echo $httpsOnly ? 'ENABLED' : 'DISABLED'; ?>
                            </span>
                        </div>
                        <div class="btn-list">
                            <a href="?http=enable" class="btn btn-sm btn-success">Enable HTTPS-Only</a>
                            <a href="?http=disable" class="btn btn-sm btn-danger">Allow HTTP</a>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                        <div class="markdown">
                          <div>
                            <h3 class="lh-1">Load Content from URL</h3>
                          </div>
                          <p>Enter a URL to fetch and view its content. If HTTPS-only mode is enabled, only secure URLs are allowed.</p>

                          <div class="row g-2 align-items-center">
                            <form role="form" action="" method="GET" >
                              <div class="mb-3">
                                <input type="text" class="form-control" name="url" autocomplete="off" placeholder="https://example.com/image.jpg" value="<?php echo isset($_GET['url']) ? htmlspecialchars($_GET['url']) : ''; ?>">
                              </div>
                              <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="render" id="renderCheck" <?php echo isset($_GET['render']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="renderCheck">
                                    Render content in-page
                                </label>
                              </div>
                              <center><button action="submit" class="btn btn-primary">
                                Load Content
                              </button>
                              </center> 
                            </form> 
                          </div>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger mt-3">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($content !== null && !$error): ?>
                            <div class="mt-4">
                                <h4>Fetched Content (<?php echo htmlspecialchars($contentType); ?>):</h4>
                                <div class="card">
                                    <div class="card-body bg-light overflow-auto" style="max-height: 400px;">
                                        <?php if (strpos($contentType, 'image/') === 0): ?>
                                            <img src="?url=<?php echo urlencode($url); ?>" class="img-fluid">
                                        <?php elseif (strpos($contentType, 'text/html') === 0): ?>
                                            <div class="border p-2 bg-white"><?php echo $content; ?></div>
                                        <?php else: ?>
                                            <pre class="mb-0"><?php echo htmlspecialchars($content); ?></pre>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="mt-4 p-3 bg-blue-lt rounded border border-blue">
                            <h4>💡 Educational Hints</h4>
                            <p><strong>Challenge 1:</strong> Try to bypass the HTTPS-only restriction using the deserialization vulnerability in the <code>https_only</code> cookie.</p>
                            <p><strong>Challenge 2:</strong> Once HTTP is allowed, can you perform SSRF to reach internal services?</p>
                            <p><strong>Example Cookie (Serialized):</strong> <code>a:2:{s:4:"mode";s:5:"https";s:6:"status";b:1;}</code></p>
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
    <!-- Libs JS -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
