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
      .text-gradient {
        background: linear-gradient(to right, #467fcf, #5eba00);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
      }
      .tag {
        background: #D3D3D3;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.85rem;
      }
      .social-links {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
      }
      .btn-linkedin { background-color: #0a66c2; color: white; }
      .btn-twitter { background-color: #1da1f2; color: white; }
      .credits {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
      }
      .card-borderless {
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        height: 100%;
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
    <div class="col-lg-12">
      <div class="card card-lg">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center mb-4">
            <div>
              <small class="text-muted text-uppercase tracking-wide">Learning Environment for Cybersecurity through Immersive Real-world scenarios</small>
              <h1 class="lh-1 mt-2 mb-3 text-gradient text-primary">About LEKIR</h1>
            </div>
          </div>
          
          <div class="markdown">
            <div class="alert alert-info alert-dismissible fade show mb-4">
              <strong>Welcome!</strong> I'm Firdaus Khairuddin, your guide in this cybersecurity journey.
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            
            <div class="row g-4">
              <div class="col-md-6">
                <div class="card card-borderless bg-blue-lt">
                  <div class="card-body">
                    <div class="row align-items-center">
                        <h3 class="card-title">👋 Hello There!</h3>
                      <div class="col-auto">
                        <span class="avatar avatar-xl" style="background-image: url(./static/avatars/firdauskhairuddin.jpg); border: 2px solid var(--tblr-border-color-translucent);"></span>
                      </div>
                      <div class="col">
                        <p>I'm thrilled to welcome you to LEKIR - a dynamic learning platform dedicated to cybersecurity education. As a sales-turned-passionate cybersecurity enthusiast, I created LEKIR to provide a hands-on, immersive experience for individuals interested in learning about cybersecurity in a real-world context.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                            
              <div class="col-md-6">
                <div class="card card-borderless bg-purple-lt">
                  <div class="card-body">
                    <h3 class="card-title">🎯 Our Mission</h3>
                    <p>With LEKIR, my aim is to offer a comprehensive learning environment that caters to security professionals, web developers, students, and teachers alike. Through practical exercises and real-world scenarios, we empower individuals to enhance their cybersecurity skills.</p>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card mt-4">
              <div class="card-body">
                <h3 class="card-title">💼 Professional Services</h3>
                <p>Beyond this platform, I offer professional cybersecurity services:</p>
                <div class="tags">
                  <span class="tag">Security Training</span>
                  <span class="tag">Penetration Testing</span>
                  <span class="tag">Security Consulting</span>
                  <span class="tag">VP of Security</span>
                  <span class="tag">Workshops</span>
                  <span class="tag">CTF</span>
                </div>
                <p class="mt-3">Let's discuss how I can help secure your organization!</p>
              </div>
            </div>
            
            <div class="card mt-4">
              <div class="card-body">
                <h3 class="card-title">🌐 Connect With Me</h3>
                <div class="social-links">
                  <a href="https://linkedin.com/in/firdauskhairuddin" class="btn btn-linkedin">
                    <i class="fab fa-linkedin"></i> LinkedIn
                  </a>
                  <a href="https://github.com/firdauskhairuddin" class="btn btn-dark">
                    <i class="fab fa-github"></i> GitHub
                  </a>
                  <a href="https://firdauskhairuddin.gitbook.io" class="btn btn-info">
                    <i class="fas fa-book"></i> GitBook
                  </a>
                  <a href="https://mfbktech.academy" class="btn btn-primary">
                    <i class="fas fa-globe"></i> Website
                  </a>
                  <a href="https://youtube.com/c/mfbktech" class="btn btn-danger">
                    <i class="fab fa-youtube"></i> YouTube
                  </a>
                  <a href="https://twitter.com/firdaus_khai" class="btn btn-twitter">
                    <i class="fab fa-twitter"></i> Twitter
                  </a>
                </div>
              </div>
            </div>
            
            <div class="mt-4 text-center text-muted">
              <div class="mb-2">
                <h4>Special Thanks To</h4>
              </div>
              <div class="credits">
                <div class="badge bg-green-lt text-green text-uppercase p-2 m-1">Tabler.io for the awesome theme</div>
              </div>
            </div><div class="mt-4 text-center text-muted">
              <div class="mb-2">
                <h4>Supported by</h4>
              </div>
              <div class="credits">
                <div class="badge bg-orange-lt text-orange text-uppercase p-2 m-1">Ahmad Razin Azman (Coffee)</div>
                <div class="badge bg-purple-lt text-purple text-uppercase p-2 m-1">Prof. Apokalips (Code)</div>
              </div>
            </div>
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