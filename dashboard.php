<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

// Check if Composer"s autoloader exists (required for Twig - SSTi Vulnerability)
$composerAutoload = file_exists(__DIR__ . '/vendor/autoload.php');
if ($composerAutoload) {
    require_once __DIR__ . '/vendor/autoload.php';
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
        background-color: #f8fafc;
      }
      
      .card-premium {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        background: #ffffff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
      }
      
      .card-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      }

      .hero-badge {
        font-weight: 500;
        letter-spacing: 0.5px;
        padding: 6px 12px;
        border-radius: 20px;
        background-color: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        display: inline-block;
        margin-bottom: 1rem;
      }

      .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: -0.025em;
        margin-bottom: 0.5rem;
        color: #111827;
      }

      .hero-divider {
        width: 120px;
        height: 4px;
        background: linear-gradient(to right, #3b82f6, #10b981);
        border-radius: 2px;
        margin: 1.5rem auto;
        opacity: 0.9;
      }
      
      .info-box {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        height: 100%;
        transition: bg-color 0.2s;
      }
      
      .info-box:hover {
        background-color: #f3f4f6;
      }
      
      .icon-circle {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 1rem;
        font-size: 1.25rem;
      }
      
      .objective-item {
        display: flex;
        padding: 1rem;
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        transition: all 0.2s;
      }
      
      .objective-item:hover {
        border-color: #d1d5db;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      }
      
      .sidebar-list li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      
      .sidebar-list li:last-child {
        border-bottom: none;
      }
      
      
      
      .status-green { color: #059669; background-color: #d1fae5; }
      .status-red { color: #dc2626; background-color: #fee2e2; }
      
      /* New Colors matching the original intents but structured */
      .bg-blue-soft { background-color: #eff6ff; color: #3b82f6; }
      .bg-purple-soft { background-color: #f3e8ff; color: #a855f7; }
      .bg-green-soft { background-color: #ecfdf5; color: #10b981; }
      .bg-orange-soft { background-color: #fff7ed; color: #f97316; }
      .bg-red-soft { background-color: #fef2f2; color: #ef4444; }
    </style>
  </head>
  <body >
    <script src="<?php echo $base_path; ?>dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      <?php include($base_path . "components/top_navbar.php");?>
      <?php include($base_path . "components/header.php");?>
      <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <!-- Main Content Column -->
              <div class="col-lg-8">
                <div class="card card-premium mb-3">
                  <div class="card-body p-lg-5">
                    <div class="text-center mb-5">
                      <span class="hero-badge">Cybersecurity Learning Environment</span>
                      <h2 class="hero-title">Welcome to LEKIR</h2>
                      <div class="hero-divider"></div>
                      <p class="text-muted fs-3" style="max-width: 600px; margin: 0 auto;">
                        Refine your skills and evaluate security tools in a lawful, controlled, and immersive environment.
                      </p>
                    </div>
                    
                    <div class="row g-4 mb-5">
                      <div class="col-md-6">
                        <div class="info-box">
                          <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-blue-soft">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" /><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                            </div>
                            <h3 class="m-0 fw-bold">Our Purpose</h3>
                          </div>
                          <p class="text-muted m-0">Provide a platform for practicing common web vulnerabilities with varying difficulty levels through an intuitive interface.</p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="info-box">
                          <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-purple-soft">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                            </div>
                            <h3 class="m-0 fw-bold">Who Benefits</h3>
                          </div>
                          <p class="text-muted m-0">Security professionals, developers, students, and educators gain practical experience in a safe environment.</p>
                        </div>
                      </div>
                    </div>
                    
                    <h3 class="mb-4 fw-bold">Core Objectives</h3>
                    <div class="vstack gap-3 mb-5">
                        <div class="objective-item">
                            <div class="icon-circle bg-green-soft" style="width: 40px; height: 40px; font-size: 1rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 4l-8 4l8 4l8 -4l-8 -4" /><path d="M4 12l8 4l8 -4" /><path d="M4 16l8 4l8 -4" /></svg>
                            </div>
                            <div>
                                <h4 class="m-0 fw-semibold">Learn the attack</h4>
                                <small class="text-muted">Understand how common web vulnerabilities work, how attackers think, and how exploits are crafted in real environments.</small>
                            </div>
                        </div>
                        
                        <div class="objective-item">
                            <div class="icon-circle bg-blue-soft" style="width: 40px; height: 40px; font-size: 1rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                            </div>
                            <div>
                                <h4 class="m-0 fw-semibold">Exploit the weakness</h4>
                                <small class="text-muted">Safely practice exploiting vulnerable systems in a controlled lab to experience the impact firsthand.</small>
                            </div>
                        </div>

                        <div class="objective-item">
                            <div class="icon-circle bg-orange-soft" style="width: 40px; height: 40px; font-size: 1rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7l-5 5l-2 -2" /><path d="M17 7l-5 5l-2 -2" /><path d="M13 13l-5 5l-2 -2" /><path d="M19 13l-5 5l-2 -2" /></svg>
                            </div>
                            <div>
                                <h4 class="m-0 fw-semibold">Know the impact</h4>
                                <small class="text-muted">Analyze what happens after a successful attack — data exposure, system compromise, and business risk.</small>
                            </div>
                        </div>

                        <div class="objective-item">
                            <div class="icon-circle bg-green-soft" style="width: 40px; height: 40px; font-size: 1rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <div>
                                <h4 class="m-0 fw-semibold">Improve the defense</h4>
                                <small class="text-muted">Apply secure coding practices, configurations, and mitigations to fix the vulnerabilities you exploited.</small>
                            </div>
                        </div>

                        <div class="objective-item">
                            <div class="icon-circle bg-red-soft" style="width: 40px; height: 40px; font-size: 1rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" /></svg>
                            </div>
                            <div>
                                <h4 class="m-0 fw-semibold">Reinforce resilience</h4>
                                <small class="text-muted">Build long-term defensive thinking by testing, hardening, and validating systems against repeated attacks.</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                      <div class="me-3">
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                      </div>
                      <div>
                        <h4 class="alert-title">Important Security Notice</h4>
                        <div class="text-muted">
                           LEKIR contains intentional vulnerabilities. <strong>Do not</strong> deploy on public servers. Use in isolated VMs with NAT networking.
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <!-- Sidebar Column -->
              <div class="col-lg-4">
                <div class="card card-premium mb-4">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                      <div class="icon-circle bg-blue-soft me-3" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M7 8l0 .01" /><path d="M7 16l0 .01" /><path d="M11 8h6" /><path d="M11 16h6" /></svg>
                      </div>
                      <div>
                        <h3 class="m-0 lh-1">System Status</h3>
                        <small class="text-muted">Server Information</small>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled sidebar-list m-0">
                      <li>
                          <span class="text-muted">Server Name</span>
                          <span class="fw-bold"><?php echo htmlentities($_SERVER['SERVER_NAME']);?></span>
                      </li>
                      <li>
                          <span class="text-muted">OS</span>
                          <span class="fw-bold"><?php echo php_uname('s'); ?></span>
                      </li>
                      <li>
                          <span class="text-muted">PHP Version</span>
                          <span class="fw-bold"><?php echo phpversion(); ?></span>
                      </li>
                      <li>
                          <span class="text-muted">Display Errors</span>
                          <span class="<?php echo (ini_get('display_errors') ? 'status-green' : 'status-red'); ?>"><?php echo (ini_get('display_errors') ? 'Enabled' : 'Disabled'); ?></span>
                      </li>
                      <li>
                          <span class="text-muted">URL Fopen</span>
                          <span class="<?php echo (ini_get('allow_url_fopen') ? 'status-green' : 'status-red'); ?>"><?php echo (ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled'); ?></span>
                      </li>
                      <li>
                          <span class="text-muted">URL Include</span>
                          <span class="<?php echo (ini_get('allow_url_include') ? 'status-green' : 'status-red'); ?>"><?php echo (ini_get('allow_url_include') ? 'Enabled' : 'Disabled'); ?></span>
                      </li>
                      <li>
                          <span class="text-muted">GD Module</span>
                          <span class="<?php echo (extension_loaded('gd') ? 'status-green' : 'status-red'); ?>"><?php echo (extension_loaded('gd') ? 'Installed' : 'Missing'); ?></span>
                      </li>
                      <li>
                          <span class="text-muted">MySQLi</span>
                          <span class=" <?php echo (extension_loaded('mysqli') ? 'status-green' : 'status-red'); ?>"><?php echo (extension_loaded('mysqli') ? 'Installed' : 'Missing'); ?></span>
                      </li>
                      <li>
                          <span class="text-muted">Composer</span>
                          <span class="<?php echo ($composerAutoload ? 'status-green' : 'status-red'); ?>"><?php echo ($composerAutoload ? 'Found' : 'Missing'); ?></span>
                      </li>
                      <li>
                          <span class="text-muted">Twig</span>
                          <span class="<?php echo (class_exists('Twig\Environment') ? 'status-green' : 'status-red'); ?>"><?php echo (class_exists('Twig\Environment') ? 'Installed' : 'Missing'); ?></span>
                      </li>
                    </ul>
                    
                    <div class="mt-4 pt-3 border-top">
                        <?php
                        $upload_path = $base_path . 'uploads/';
                        $is_writable = is_writable($upload_path);
                        ?>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted">Uploads Folder</span>
                            <span class="<?php echo ($is_writable ? 'status-green' : 'status-red'); ?>"><?php echo ($is_writable ? 'Writable' : 'Not Writable'); ?></span>
                        </div>
                        <small class="text-muted d-block text-end font-monospace" style="font-size: 0.7em;"><?php echo htmlentities($upload_path); ?></small>
                    </div>
                  </div>
                </div>

                <div class="card card-premium">
                  <div class="card-body">
                    <h3 class="card-title">Security Level</h3>
                    <p class="text-muted small">Current Level: <strong class="text-primary"><?php echo $level->current_level($_SESSION['level']); ?></strong></p>
                    
                    <form role='form' action="<?php echo $base_path; ?>api.php?action=level" method="POST">
                        <select class="form-select mb-3" name="level">
                          <option value="1" <?php echo ($_SESSION['level'] == 1) ? 'selected' : ''; ?>>Low</option>
                          <option value="2" <?php echo ($_SESSION['level'] == 2) ? 'selected' : ''; ?>>Medium</option>
                          <option value="3" <?php echo ($_SESSION['level'] == 3) ? 'selected' : ''; ?>>High</option>
                          <option value="4" <?php echo ($_SESSION['level'] == 4) ? 'selected' : ''; ?>>Impossible</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100">
                          Update Security Level
                        </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include($base_path . "components/footer.php");?>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
