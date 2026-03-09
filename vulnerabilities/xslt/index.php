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

//ini_set("display_errors", 1);
//error_reporting(E_ALL);

$xslt_output = "";
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['xslt'])) {
    $xsltInput = $_POST['xslt'];
    
    // Fixed car XML data
    $carXml = '<?xml version="1.0"?>
<car>
    <brand>Toyota</brand>
    <model>Camry XSE</model>
    <year>2024</year>
    <color>Midnight Black Metallic</color>
    <price>34999</price>
    <engine>2.5L 4-Cylinder Hybrid</engine>
</car>';
    
    try {
        ob_start();
        // Load car XML
        $xml = new DOMDocument();
        $xml->loadXML($carXml);
        
        // Load user's XSLT (VULNERABLE!)
        $xsl = new DOMDocument();
        
        // INSECURE: Allow external entities
        libxml_disable_entity_loader(false);
        
        if (!$xsl->loadXML($xsltInput, LIBXML_NOENT | LIBXML_DTDLOAD)) {
            throw new Exception("Invalid XSLT format");
        }
        
        // Create XSLT processor with NO security
        $proc = new XSLTProcessor();
        $proc->registerPHPFunctions();
        
        // Remove security restrictions for CTF
        if (defined('XSL_SECPREFS_NONE')) {
            $proc->setSecurityPrefs(XSL_SECPREF_NONE);
        }
        
        $proc->importStylesheet($xsl);
        
        // Transform
        $result = $proc->transformToXML($xml);
        
        if ($result === false) {
            echo '<div class="alert alert-danger">
                <h4 class="alert-title">Transformation Failed</h4>
                <div class="text-secondary">Check your XSLT syntax or logic.</div>
            </div>';
        } else {
            echo '<div class="card bg-white"><div class="card-body">';
            echo $result;
            echo '</div></div>';
            
            // CTF Hint
            echo '<div class="alert alert-warning mt-3">
                <h4 class="alert-title">💡 Challenge</h4>
                <div class="text-secondary">Can you find a way to read <code>/etc/passwd</code> or <code>/flag.txt</code> using XSLT?</div>
            </div>';
        }
        $xslt_output = ob_get_clean();
        
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
        if (ob_get_level() > 0) ob_end_clean();
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10 13l-1 2l1 2" /><path d="M14 13l1 2l-1 2" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">XSLT Injection</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:green;"><b>Low</b></font></li>
                      <li><b>Short Form</b> : XSLTI</li>
                      <li><b>Injection Point</b> : $_POST['xslt']</li>
                      <li><b>Why this happen</b> : XSLT (Extensible Stylesheet Language Transformations) Injection occurs when an application includes untrusted input in an XSLT stylesheet. If the XSLT processor is not configured securely, it may allow an attacker to read local files (XXE), execute system commands, or perform other malicious actions depending on the available XSLT functions and processor capabilities.</li>
                      <li><b>Author</b> : EagleTube</li>
                      <li><b>Read More</b> : <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/xslt-injection' target='_blank'>Link</a></li>
                      <br>
                      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-payloads">
                      View Payload
                      </a>
                    </ul>   
                  </div>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                        <div class="markdown">
                          <div>
                            <h3 class="lh-1">Car Style Customizer</h3>
                          </div>
                          <p>Enter an XSLT stylesheet to customize how the car data is displayed. Our system uses a high-performance XSLT processor to transform your XML data into beautiful HTML.</p>

                          <form role="form" action="" method="POST" >
                            <div class="mb-3">
                              <label class="form-label">XSLT Stylesheet</label>
                              <textarea class="form-control" name="xslt" rows="12" style="font-family: 'Courier New', monospace;"><?php
                                if (isset($_POST['xslt'])) {
                                    echo htmlspecialchars($_POST['xslt']);
                                } else {
                                    echo '<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div class="p-3">
            <h2 class="text-primary">Car Details</h2>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Brand:</strong> <xsl:value-of select="car/brand"/></li>
                <li class="list-group-item"><strong>Model:</strong> <xsl:value-of select="car/model"/></li>
                <li class="list-group-item"><strong>Year:</strong> <xsl:value-of select="car/year"/></li>
                <li class="list-group-item"><strong>Engine:</strong> <xsl:value-of select="car/engine"/></li>
            </ul>
        </div>
    </xsl:template>
</xsl:stylesheet>';
                                }
                              ?></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-player-play" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 4v16l13 -8z" /></svg>
                                    Apply XSLT Transformation
                                </button>
                            </div>
                          </form> 
                        </div>

                        <?php if ($error): ?>
                            <div class="alert alert-danger mt-4">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <?php if ($xslt_output): ?>
                                <h4>Transformation Result:</h4>
                                <div class="border rounded bg-light p-0 overflow-auto" style="max-height: 500px;">
                                    <?php echo $xslt_output; ?>
                                </div>
                            <?php else: ?>
                                <div class="bg-light-lt p-5 text-center border-dashed rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-settings text-muted mb-2" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M12 10.5v1.5" /><path d="M12 16v1.5" /><path d="M15.031 12.25l-1.299 .75" /><path d="M10.268 15l-1.3 .75" /><path d="M15.031 15.75l-1.299 -.75" /><path d="M10.268 13l-1.3 -.75" /><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
                                    <h3 class="text-muted">No transformation applied</h3>
                                    <p class="text-muted">Enter an XSLT stylesheet and click the button to see the results.</p>
                                </div>
                            <?php endif; ?>
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
              <h5 class="modal-title">🎯 XSLT Injection Payloads</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
              <pre class="bg-dark text-white p-3 m-0" style="font-family: 'Courier New', monospace; white-space: pre-wrap; word-break: break-all; border-radius: 0;"><?php echo htmlspecialchars(@file_get_contents($base_path . 'payloads/xslt_payload.txt')); ?></pre>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>payloads/xslt_payload.txt" download class="btn btn-primary">Download Payload</a>
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