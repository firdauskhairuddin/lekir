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
    <title><?php echo htmlentities($title); ?> - About</title>
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
      .page-header-premium {
        background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);
        padding: 5rem 2rem;
        border-radius: 0 0 3rem 3rem;
        margin-bottom: -4rem;
        color: white;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 97, 255, 0.2);
      }
      .premium-card {
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease;
      }
      .avatar-ring {
        padding: 5px;
        background: linear-gradient(to bottom right, #0061ff, #60efff);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
      }
      .text-gradient {
        background: linear-gradient(to right, #0061ff, #60efff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .tag-premium {
        background: #f1f5f9;
        color: #475569;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        margin: 0.25rem;
        transition: background-color 0.2s;
      }
      .tag-premium:hover {
        background: #e2e8f0;
      }
      .social-link-premium {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        transition: all 0.2s;
        color: white;
        font-size: 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
      }
      .social-link-premium:hover {
        transform: translateY(-3px);
        color: white;
        filter: brightness(1.1);
      }
    </style>
  </head>
  <body>
    <script src="<?php echo $base_path; ?>dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <?php include($base_path . "components/top_navbar.php"); ?>
      <?php include($base_path . "components/header.php"); ?>
 
      <div class="page-header-premium">
        <div class="container-xl">
          <small class="text-uppercase fw-bold opacity-75" style="letter-spacing: 2px;">Vulnerable by Design</small>
          <h1 class="display-3 fw-bold mt-2 mb-3">LEKIR Framework</h1>
          <p class="lead opacity-90 mx-auto fs-3" style="max-width: 700px;">Learning Framework for Cybersecurity through Immersive Real-world scenarios</p>
        </div>
      </div>

      <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards justify-content-center">
              <div class="col-lg-10">
                <div class="card premium-card overflow-hidden">
                  <div class="card-body p-5">
                    <div class="row align-items-center g-5">
                      <div class="col-md-4 text-center">
                        <div class="avatar-ring mb-4">
                          <span class="avatar avatar-xl rounded-circle" style="background-image: url(./static/avatars/firdauskhairuddin.jpg); width: 160px; height: 160px; border: 4px solid white;"></span>
                        </div>
                        <h2 class="fw-bold mb-1">Firdaus Khairuddin</h2>
                        <p class="text-muted mb-4 fs-4">Security Enthusiast & Educator</p>
                        <div class="d-flex justify-content-center gap-3">
                           <a href="https://linkedin.com/in/firdauskhairuddin" class="social-link-premium bg-linkedin" title="LinkedIn">
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M8 11l0 5" /><path d="M8 8l0 .01" /><path d="M12 16l0 -5" /><path d="M16 16v-3a2 2 0 0 0 -4 0" /></svg>
                           </a>
                           <a href="https://github.com/firdauskhairuddin" class="social-link-premium bg-dark" title="GitHub">
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
                           </a>
                           <a href="https://twitter.com/firdaus_khai" class="social-link-premium bg-twitter" title="Twitter">
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 4.01c-1 .49-1.98.689-3 .99-1.121-1.265-2.783-1.335-4.38-.737S11.977 6.323 12 8v1c-3.245.083-6.135-1.395-8-4 0 0-4.182 7.433 4 11-1.872 1.247-3.739 2.088-6 2 3.308 1.803 6.913 2.423 10.034 1.517 3.58-1.04 6.522-3.723 7.651-7.742a13.84 13.84 0 0 0 .497 -3.753C20.18 7.773 21.692 5.25 22 4.009z" /></svg>
                           </a>
                           <a href="https://youtube.com/c/mfbktech" class="social-link-premium bg-danger" title="YouTube">
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8" /><path d="M10 9l5 3l-5 3l0 -6" /></svg>
                           </a>
                        </div>
                      </div>
                      <div class="col-md-8 border-start-md ps-md-5">
                        <span class="badge bg-blue-lt mb-3">Project Maintainer</span>
                        <h2 class="fw-bold mb-3 display-6">👋 Welcome to my project</h2>
                        <p class="text-secondary mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                          I'm thrilled to welcome you to LEKIR! Created out of a passion for cybersecurity education, this platform provides a hands-on, immersive experience for anyone looking to master the art of secure web development and ethical hacking.
                        </p>
                        <div class="row g-4">
                          <div class="col-sm-6">
                            <div class="p-3 bg-blue-lt rounded-3 border-start border-blue border-3 h-100">
                              <h4 class="mb-2 text-blue fw-bold">Mission</h4>
                              <p class="small mb-0 opacity-75 lh-base">Empowering learners with safe, legal, and realistic environments to practice offensive and defensive security.</p>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="p-3 bg-purple-lt rounded-3 border-start border-purple border-3 h-100">
                              <h4 class="mb-2 text-purple fw-bold">Community</h4>
                              <p class="small mb-0 opacity-75 lh-base">Building a safer digital future together by sharing knowledge and tools freely.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr class="my-5 opacity-25">

                    <div class="row g-5">
                      <div class="col-md-6">
                        <h3 class="fw-bold mb-4 d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><path d="M12 12l0 .01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                            Professional Services
                        </h3>
                        <div class="tags-list mb-4">
                          <span class="tag-premium">Security Training</span>
                          <span class="tag-premium">Penetration Testing</span>
                          <span class="tag-premium">Security Consulting</span>
                          <span class="tag-premium">Workshops</span>
                          <span class="tag-premium">CTF Design</span>
                        </div>
                        <p class="text-muted">Specializing in delivering high-impact security assessments and educational content for modern organizations.</p>
                        <a href="https://mfbktech.academy" target="_blank" class="btn btn-outline-primary rounded-pill px-4 mt-2">Visit Academy</a>
                      </div>
                      
                      <div class="col-md-6">
                        <h3 class="fw-bold mb-4 d-flex align-items-center">
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-world me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M3.6 9h16.8" /><path d="M3.6 15h16.8" /><path d="M11.5 3a17 17 0 0 0 0 18" /><path d="M12.5 3a17 17 0 0 1 0 18" /></svg>
                             Resources
                        </h3>
                        <div class="list-group list-group-flush">
                          <a href="https://firdauskhairuddin.gitbook.io" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center py-3 border-0 rounded-3 mb-2 bg-light">
                            <span class="avatar bg-blue-lt me-3 text-blue">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6l0 13" /><path d="M12 6l0 13" /><path d="M21 6l0 13" /></svg>
                            </span>
                            <div>
                                <div class="fw-bold text-dark">Official Documentation</div>
                                <div class="small text-muted">Guides & Walkthroughs on GitBook</div>
                            </div>
                          </a>
                          <a href="https://mfbktech.academy" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center py-3 border-0 rounded-3 bg-light">
                             <span class="avatar bg-purple-lt me-3 text-purple">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>
                             </span>
                             <div>
                                <div class="fw-bold text-dark">MFBK Tech Academy</div>
                                <div class="small text-muted">Premium courses and tutorials</div>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="mt-6 pt-5 border-top text-center">
                      <p class="mb-3 text-muted fw-medium">Supported by amazing contributors</p>
                      <div class="d-flex justify-content-center flex-wrap gap-2">
                         <span class="badge bg-green-lt text-green px-3 py-2 rounded-pill border border-green-lt">Tabler.io (Theme)</span>
                         <span class="badge bg-orange-lt text-orange px-3 py-2 rounded-pill border border-orange-lt">Ahmad Razin Azman (Coffee)</span>
                         <span class="badge bg-purple-lt text-purple px-3 py-2 rounded-pill border border-purple-lt">Prof. Apokalips (Code)</span>
                         <span class="badge bg-red-lt text-red px-3 py-2 rounded-pill border border-red-lt">EagleTube (Code)</span>
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