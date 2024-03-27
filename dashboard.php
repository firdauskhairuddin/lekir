<?php
session_start();
include('./core/configuration.php');
include('./core/function.php');

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
    <title><?php echo htmlentities($title); ?></title>
    <link rel="icon" href="./static/lekir.jpeg" type="image/png">
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="./dashboard.php">
              LEKIR
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
                <a href="https://github.com/firdauskhairuddin" class="btn" target="_blank" rel="noreferrer">
                  <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
                  Source code
                </a>
                <!--
                <a href="https://paypal.me/firdauskhairuddin" class="btn" target="_blank" rel="noreferrer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                  Sponsor
                </a>
                -->
              </div>
            </div>
            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(./static/lekir.jpeg)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div><?php echo htmlentities($_SESSION['user_name']); ?></div>
                  <div class="mt-1 small text-secondary">Level : <?php echo $level->current_level($_SESSION['level']); ?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="./api.php?action=logout" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>

      <?php include('./components/header.php');?>
      <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                    <div class="markdown">
                      <div>
                        <small class="text-muted">Learning Environment for Cybersecurity through Immersive Real-world scenarios</small>
                        <h3 class="lh-1">Welcome to LEKIR!</h3>
                      </div>
                      <p>LEKIR is a deliberately vulnerable web application crafted to assist security professionals in refining their skills and evaluating their tools in a lawful setting. It also contributes to advancing web developers' comprehension of securing web applications. Moreover, LEKIR facilitates both students and instructors in comprehending web application security within a supervised environment.</p>
                      <p>The goal of LEKIR is to provide a platform for practicing numerous common web vulnerabilities, offering varying levels of difficulty, all presented within a simple and user-friendly interface.</p>

                      <ol>
                        <li><b>Learning</b>: Providing a platform for individuals to gain hands-on experience and knowledge in cybersecurity concepts and practices.</li>
                        <li><b>Exploration</b>: Encouraging users to explore various cybersecurity threats, vulnerabilities, and defense mechanisms in a safe and controlled environment.</li>
                        <li><b>Knowledge Transfer</b>: Facilitating the transfer of cybersecurity expertise and skills through interactive modules, simulations, and tutorials</li>
                        <li><b>Immersion</b>: Creating immersive and realistic scenarios that mimic real-world cyber attacks and incidents to enhance learning and problem-solving abilities.</li>
                        <li><b>Resilience Building</b>: Fostering resilience by allowing users to experiment with different strategies and solutions to mitigate cyber risks and defend against threats.</li>
                      </ol>
                      <hr>
                      <h3 class="text-danger">WARNING!</h3>
                      <p>LEKIR is intentionally engineered to possess vulnerabilities. To prevent compromise, refrain from uploading it to your hosting provider's public HTML folder or any Internet-facing servers. Instead, it's advisable to employ a virtual machine, such as VirtualBox or VMware, configured with NAT networking mode. Within the guest machine, you can install XAMPP for the web server and database. This configuration offers a controlled environment for exploring LEKIR's vulnerabilities without the risk of external exposure.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card">
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
                      <li>Function display_errors: <b style="color: <?php echo (ini_get('display_errors') ? 'green' : 'red'); ?>"><?php echo (ini_get('display_errors') ? 'Enabled' : 'Disabled'); ?></b></li>
                      <li>Function allow_url_fopen: <b style="color: <?php echo (ini_get('allow_url_fopen') ? 'green' : 'red'); ?>"><?php echo (ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled'); ?></b></li>
                      <li>Function allow_url_include: <b style="color: <?php echo (ini_get('allow_url_include') ? 'green' : 'red'); ?>"><?php echo (ini_get('allow_url_include') ? 'Enabled' : 'Disabled'); ?></b></li>
                      <br>
                      <li>Installed module gd: <b style="color: <?php echo (extension_loaded('gd') ? 'green' : 'red'); ?>"><?php echo (extension_loaded('gd') ? 'Installed' : 'Not installed'); ?></b></li>
                      <li>Installed module mysqli: <b style="color: <?php echo (extension_loaded('mysqli') ? 'green' : 'red'); ?>"><?php echo (extension_loaded('mysqli') ? 'Installed' : 'Not installed'); ?></b></li>
                      <li>Installed module pdo_mysql: <b style="color: <?php echo (extension_loaded('pdo_mysql') ? 'green' : 'red'); ?>"><?php echo (extension_loaded('pdo_mysql') ? 'Installed' : 'Not installed'); ?></b></li>
                      <hr>
                      <?php
                      $paths = array(
                          getcwd().'/uploads/'
                      );

                      // Check each path and output the result
                      foreach ($paths as $path) {
                          $writable = is_writable($path);

                          // Output the result within <li> tags with color based on writability
                          echo "<li>[User: ".get_current_user()."] Writable " . (is_dir($path) ? 'folder' : 'file') . " $path: ";
                          echo $writable ? '<span style="color: green;">Yes</span>' : '<span style="color: red;">No</span>';
                          echo "</li>";
                      }
                      ?>

                      <hr>
                      <li>Current security level : <?php echo $level->current_level($_SESSION['level']); ?></li>
                      <br>
                      <form role="form" action="api.php?action=level" method="POST" >
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

      <?php include('./components/footer.php');?>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>