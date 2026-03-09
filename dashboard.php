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
      @import url(\"https://rsms.me/inter/inter.css");
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: 'cv03', "cv04", "cv11";
      }
      .bg-gray-50 { background-color: #f8f9fa; }
      .bg-gray-100 { background-color: #f3f4f6; }
      .text-gray-600 { color: #4b5563; }
      .text-gray-700 { color: #374151; }
      .border-gray-200 { border-color: #e5e7eb; }
      
      .bg-blue-100 { background-color: #dbeafe; }
      .text-blue-600 { color: #2563eb; }
      
      .bg-purple-100 { background-color: #e9d5ff; }
      .text-purple-600 { color: #9333ea; }
      
      .bg-green-100 { background-color: #dcfce7; }
      .text-green-600 { color: #16a34a; }
      
      .bg-orange-100 { background-color: #ffedd5; }
      .text-orange-600 { color: #ea580c; }
      
      .bg-red-50 { background-color: #fef2f2; }
      .bg-red-100 { background-color: #fee2e2; }
      .text-red-500 { color: #ef4444; }
      .text-red-600 { color: #dc2626; }
      
      .rounded-xl { border-radius: 12px; }
      .rounded-lg { border-radius: 8px; }
      .space-y-3 > * + * { margin-top: 0.75rem; }
      
      .display-5 {
        font-size: 2.5rem;
        font-weight: 600;
      }
      
      @media (max-width: 768px) {
        .display-5 {
          font-size: 2rem;
        }
      }
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
              <div class="col-lg-8">
                <div class="card card-lg border-0" style="box-shadow: 0 4px 16px rgba(0,0,0,0.08); border-radius: 12px; overflow: hidden;">
                  <div class="card-body p-5">
                    <div class="markdown">
                      <div class="text-center mb-6">
                        <span class="badge bg-gray-100 text-gray-600 border border-gray-200 mb-3" style="font-weight: 500; letter-spacing: 0.5px; padding: 6px 12px; border-radius: 20px;">Learning Environment for Cybersecurity through Immersive Real-world scenarios</span>
                        <h2 class="display-5 fw-semibold mb-1" style="letter-spacing: -0.5px;">Welcome to LEKIR</h2>
                        <div class="mx-auto" style="width: 250px; height: 3px; background: linear-gradient(to right, #0071e3, #34a853); opacity: 0.8; margin: 24px 0;"></div>
                      </div>
                      
                      <div class="bg-gray-50 p-4 rounded-xl mb-3" style="border: 1px solid rgba(0,0,0,0.03);">
                        <p class="text-gray-700 mb-0" style="font-size: 1.05rem; line-height: 1.7;">LEKIR is a deliberately vulnerable web application crafted to assist security professionals in refining their skills and evaluating their tools in a lawful, controlled environment.</p>
                      </div>
                      
                      <div class="row g-4 mb-6">
                        <div class="col-md-6">
                          <div class="p-4 rounded-xl h-100" style="background-color: #f8f9fa; border: 1px solid rgba(0,0,0,0.03);">
                            <div class="d-flex align-items-center mb-3">
                              <div class="bg-blue-100 text-blue-600 rounded-circle p-3 me-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-bullseye fa-lg"></i>
                              </div>
                              <h4 class="fw-semibold mb-0" style="letter-spacing: -0.3px;">Our Purpose</h4>
                            </div>
                            <p class="text-gray-600" style="line-height: 1.6; font-size: 0.95rem;">We provide a platform for practicing common web vulnerabilities with varying difficulty levels through an intuitive interface designed for progressive learning.</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="p-4 rounded-xl h-100" style="background-color: #f8f9fa; border: 1px solid rgba(0,0,0,0.03);">
                            <div class="d-flex align-items-center mb-3">
                              <div class="bg-purple-100 text-purple-600 rounded-circle p-3 me-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-users fa-lg"></i>
                              </div>
                              <h4 class="fw-semibold mb-0" style="letter-spacing: -0.3px;">Who Benefits</h4>
                            </div>
                            <p class="text-gray-600" style="line-height: 1.6; font-size: 0.95rem;">Security professionals, developers, students, and educators gain practical experience in a safe environment that mimics real-world scenarios.</p>
                          </div>
                        </div>
                      </div>
                      
                      <h4 class="fw-semibold text-center mb-4" style="letter-spacing: -0.3px;">Core Objectives</h4>
                      <div class="space-y-3 mb-6">
                        <div class="d-flex p-3 rounded-lg" style="background-color: #f8f9fa; border: 1px solid rgba(0,0,0,0.03);">
                          <div class="bg-green-100 text-green-600 rounded-circle p-2 me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-graduation-cap"></i>
                          </div>
                          <div>
                            <h5 class="fw-semibold mb-1" style="font-size: 1rem;">Learning</h5>
                            <p class="text-gray-600 mb-0" style="font-size: 0.9rem; line-height: 1.6;">Hands-on experience with cybersecurity concepts and best practices through practical exercises.</p>
                          </div>
                        </div>
                        
                        <div class="d-flex p-3 rounded-lg" style="background-color: #f8f9fa; border: 1px solid rgba(0,0,0,0.03);">
                          <div class="bg-blue-100 text-blue-600 rounded-circle p-2 me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-search"></i>
                          </div>
                          <div>
                            <h5 class="fw-semibold mb-1" style="font-size: 1rem;">Exploration</h5>
                            <p class="text-gray-600 mb-0" style="font-size: 0.9rem; line-height: 1.6;">Discover threats, vulnerabilities, and defense mechanisms in a controlled sandbox.</p>
                          </div>
                        </div>
                        
                        <div class="d-flex p-3 rounded-lg" style="background-color: #f8f9fa; border: 1px solid rgba(0,0,0,0.03);">
                          <div class="bg-orange-100 text-orange-600 rounded-circle p-2 me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-exchange-alt"></i>
                          </div>
                          <div>
                            <h5 class="fw-semibold mb-1" style="font-size: 1rem;">Knowledge Transfer</h5>
                            <p class="text-gray-600 mb-0" style="font-size: 0.9rem; line-height: 1.6;">Interactive modules and simulations designed for effective skill development.</p>
                          </div>
                        </div>
                        
                        <div class="d-flex p-3 rounded-lg" style="background-color: #f8f9fa; border: 1px solid rgba(0,0,0,0.03);">
                          <div class="bg-purple-100 text-purple-600 rounded-circle p-2 me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-vr-cardboard"></i>
                          </div>
                          <div>
                            <h5 class="fw-semibold mb-1" style="font-size: 1rem;">Immersion</h5>
                            <p class="text-gray-600 mb-0" style="font-size: 0.9rem; line-height: 1.6;">Real-world scenarios that accurately simulate modern cyber attacks.</p>
                          </div>
                        </div>
                        
                        <div class="d-flex p-3 rounded-lg" style="background-color: #f8f9fa; border: 1px solid rgba(0,0,0,0.03);">
                          <div class="bg-red-100 text-red-600 rounded-circle p-2 me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shield-virus"></i>
                          </div>
                          <div>
                            <h5 class="fw-semibold mb-1" style="font-size: 1rem;">Resilience Building</h5>
                            <p class="text-gray-600 mb-0" style="font-size: 0.9rem; line-height: 1.6;">Experiment with defense strategies to build robust security postures.</p>
                          </div>
                        </div>
                      </div>
                      
                      <div class="bg-red-50 border border-red-100 rounded-xl p-4" style="border-left: 4px solid #ea4335;">
                        <div class="d-flex align-items-start">
                          <div class="bg-red-100 text-red-600 rounded-circle p-2 me-3 flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-exclamation-triangle"></i>
                          </div>
                          <div>
                            <h4 class="fw-semibold text-red-600 mb-2">Important Security Notice</h4>
                            <p class="text-gray-700 mb-2" style="line-height: 1.6;">LEKIR contains intentional vulnerabilities. For safe usage:</p>
                            <ul class="text-gray-700 ps-3" style="line-height: 1.8; list-style-type: none;">
                              <li class="mb-1"><span class="text-red-500 me-2">•</span> <strong>Avoid</strong> public web server deployment</li>
                              <li class="mb-1"><span class="text-green-600 me-2">•</span> <strong>Use</strong> virtual machines (VirtualBox/VMware)</li>
                              <li class="mb-1"><span class="text-green-600 me-2">•</span> <strong>Configure</strong> with NAT networking</li>
                              <li class="mb-0"><span class="text-green-600 me-2">•</span> <strong>Install</strong> XAMPP for local testing</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 ">
                <div class="card card-lg border-0" style="box-shadow: 0 4px 16px rgba(0,0,0,0.08); border-radius: 12px; overflow: hidden;">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <div class="me-3">
                        <!-- Download SVG icon from http://tabler-icons.io/i/scale -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-server-2"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M7 8l0 .01" /><path d="M7 16l0 .01" /><path d="M11 8h6" /><path d="M11 16h6" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Server check</small>
                        <h3 class="lh-1">Information</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li>Server Name : <b><?php echo htmlentities($_SERVER['SERVER_NAME']);?></b></li>
                      <li>Operating System: <b><?php echo php_uname('s'); ?></b></li>
                      <br>
                      <li>PHP version: <b><?php echo phpversion(); ?></b></li>
                      <li>Function display_errors: <b style='color: <?php echo (ini_get('display_errors') ? 'green' : 'red'); ?>'><?php echo (ini_get('display_errors') ? 'Enabled' : 'Disabled'); ?></b></li>
                      <li>Function allow_url_fopen: <b style='color: <?php echo (ini_get('allow_url_fopen') ? 'green' : 'red'); ?>'><?php echo (ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled'); ?></b></li>
                      <li>Function allow_url_include: <b style='color: <?php echo (ini_get('allow_url_include') ? 'green' : 'red'); ?>'><?php echo (ini_get('allow_url_include') ? 'Enabled' : 'Disabled'); ?></b></li>
                      <br>
                      <li>Installed module gd: <b style='color: <?php echo (extension_loaded('gd') ? 'green' : 'red'); ?>'><?php echo (extension_loaded('gd') ? 'Installed' : 'Not installed'); ?></b></li>
                      <li>Installed module mysqli: <b style='color: <?php echo (extension_loaded('mysqli') ? 'green' : 'red'); ?>'><?php echo (extension_loaded('mysqli') ? 'Installed' : 'Not installed'); ?></b></li>
                      <li>Installed module pdo_mysql: <b style='color: <?php echo (extension_loaded('pdo_mysql') ? 'green' : 'red'); ?>'><?php echo (extension_loaded('pdo_mysql') ? 'Installed' : 'Not installed'); ?></b></li>
                      <li>Composer Autoloader: <b style='color: <?php echo ($composerAutoload ? 'green' : 'red'); ?>'><?php echo ($composerAutoload ? 'Found' : 'Not found'); ?></b></li>
                      <li>Twig installed: <b style='color: <?php echo (class_exists('Twig\Environment') ? 'green' : 'red'); ?>'><?php echo (class_exists('Twig\Environment') ? 'Installed' : 'Not installed'); ?></b></li>
                      <hr>
                      <?php
                      $paths = array(
                          getcwd().'/uploads/'
                      );

                      // Check each path and output the result
                      foreach ($paths as $path) {
                          $writable = is_writable($path);

                          // Output the result within <li> tags with color based on writability
                          echo '<li>[User: ".get_current_user()."] Writable " . (is_dir($path) ? \"folder' : 'file') . ' $path: ";
                          echo $writable ? "<span style='color: green;">Yes</span>' : '<span style='color: red;'>No</span>";
                          echo '</li>';
                      }
                      ?>

                      <hr>
                      <li>Current security level : <?php echo $level->current_level($_SESSION['level']); ?></li>
                      <br>
                      <form role='form' action="<?php echo $base_path; ?>api.php?action=level" method="POST' >
                        <div class="mb-3">
                          <select class="form-select" name="level">
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                            <option value="4">Impossible</option>
                          </select>
                        </div>
                        <div class="col-auto">
                        <center><button action="submit" class="btn btn-primary">
                          Submit
                        </button>
                        </center> 
                      </form>
                    </div>
                    </ul>   
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
