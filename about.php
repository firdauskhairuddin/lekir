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
    <script src="<?php echo $base_path; ?>dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      

      <?php include($base_path . "components/top_navbar.php"); ?>
      <?php include($base_path . "components/header.php"); ?>

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
              <strong>Welcome!</strong> I"m Firdaus Khairuddin, your guide in this cybersecurity journey.
              <button type='button' class="btn-close" data-bs-dismiss="alert'></button>
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
                        <p>I"m thrilled to welcome you to LEKIR - a dynamic learning platform dedicated to cybersecurity education. As a sales-turned-passionate cybersecurity enthusiast, I created LEKIR to provide a hands-on, immersive experience for individuals interested in learning about cybersecurity in a real-world context.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                            
              <div class='col-md-6'>
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
                <p class="mt-3">Let"s discuss how I can help secure your organization!</p>
              </div>
            </div>
            
            <div class='card mt-4'>
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

      <?php include($base_path . "components/footer.php");?>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>