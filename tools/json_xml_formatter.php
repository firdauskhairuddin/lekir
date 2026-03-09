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
    <title><?php echo htmlentities($title); ?> - JSON/XML Formatter</title>
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
      .tool-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
      }
      .code-editor {
        font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        font-size: 0.9rem;
        background-color: #f8f9fa;
        border: 1px solid #e6e7e9;
        min-height: 200px;
        transition: border-color 0.2s;
      }
      .code-editor:focus {
        background-color: #fff;
        border-color: #206bc4;
        box-shadow: 0 0 0 0.25rem rgba(32, 107, 196, 0.15);
      }
      .info-list li {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: flex-start;
      }
      .info-icon {
        margin-top: 0.2rem;
        margin-right: 0.75rem;
        color: #206bc4;
      }
      .btn-group-special .btn {
          flex: 1;
      }
    </style>
  </head>
  <body >
    <script src="<?php echo $base_path; ?>dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      <?php include($base_path . "components/top_navbar.php"); ?>
      <?php include($base_path . "components/header.php"); ?>
      
      <div class="page-wrapper">
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <div class="page-pretitle">
                  Tool
                </div>
                <h2 class="page-title">
                  JSON / XML Formatter
                </h2>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
            
              <!-- Info Sidebar -->
              <div class="col-lg-4">
                <div class="card tool-card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                      <div class="me-3">
                        <div class="bg-blue-lt p-2 rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 8l-4 4l4 4" /><path d="M17 8l4 4l-4 4" /><path d="M14 4l-4 16" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">About Data Formats</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Developer Utility
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Short Form:</strong> Format
                        </div>
                      </li>
                      <li>
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        <div>
                            <strong>Use case:</strong> Beautifies (Pretty Print) or Minifies JSON and XML data structures for better readability or compactness.
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Tool Area -->
              <div class="col-lg-8">
                <div class="card tool-card h-100">
                  <div class="card-header">
                     <h3 class="card-title">Formatter</h3>
                     <div class="card-actions">
                         <button class="btn btn-sm btn-ghost-danger" onclick="document.getElementById('inputData').value=''; document.getElementById('inputData').focus();">Clear</button>
                     </div>
                  </div>
                  <div class="card-body">
                    
                    <div class="mb-4">
                         <div class="d-flex justify-content-between mb-2">
                             <label class="form-label required">Raw Data (JSON / XML)</label>
                             <button class="btn btn-sm btn-ghost-primary" onclick="copyResult()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" /><path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" /></svg>
                                Copy
                             </button>
                         </div>
                        <textarea class="form-control code-editor" id="inputData" rows="15" placeholder='{"key":"value"} or <tag>content</tag>'></textarea>
                    </div>

                    <div class="row g-2">
                         <div class="col-md-6">
                             <div class="btn-group w-100 btn-group-special" role="group">
                                <button type="button" class="btn btn-outline-primary" onclick="formatJSON(false)">Beautify JSON</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="formatJSON(true)">Minify JSON</button>
                              </div>
                         </div>
                         <div class="col-md-6">
                            <div class="btn-group w-100 btn-group-special" role="group">
                                <button type="button" class="btn btn-outline-primary" onclick="formatXML(false)">Beautify XML</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="formatXML(true)">Minify XML</button>
                              </div>
                         </div>
                    </div>
                    
                    <div id="errorMsg" class="mt-3 text-danger" style="display:none;"></div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include($base_path . "components/footer.php");?>
      </div>
    </div>
    
    <!-- Scripts -->
    <script>
        function formatJSON(minify) {
            const input = document.getElementById('inputData');
            const error = document.getElementById('errorMsg');
            error.style.display = 'none';
            
            if (!input.value.trim()) return;

            try {
                const json = JSON.parse(input.value);
                if (minify) {
                    input.value = JSON.stringify(json);
                } else {
                    input.value = JSON.stringify(json, null, 4);
                }
            } catch (e) {
                error.innerText = "Invalid JSON: " + e.message;
                error.style.display = 'block';
            }
        }

        function formatXML(minify) {
             const input = document.getElementById('inputData');
             const error = document.getElementById('errorMsg');
             error.style.display = 'none';

             if (!input.value.trim()) return;

             try {
                 const parser = new DOMParser();
                 const xmlDoc = parser.parseFromString(input.value, "application/xml");
                 
                 const parseError = xmlDoc.getElementsByTagName("parsererror");
                 if (parseError.length > 0) {
                     throw new Error("XML Parsing Failed");
                 }

                 if (minify) {
                     // Simple regex replacement for minification (basic)
                     let xml = new XMLSerializer().serializeToString(xmlDoc);
                     input.value = xml.replace(/>\s+</g, '><').trim();
                 } else {
                     // Pretty print logic
                     const xsltDoc = new DOMParser().parseFromString([
                        '<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform">',
                        '  <xsl:strip-space elements="*"/>',
                        '  <xsl:template match="para">',
                        '   <xsl:copy>',
                        '    <xsl:apply-templates/>',
                        '   </xsl:copy>',
                        '  </xsl:template>',
                        '  <xsl:template match="node()|@*">',
                        '    <xsl:copy>',
                        '      <xsl:apply-templates select="node()|@*"/>',
                        '    </xsl:copy>',
                        '  </xsl:template>',
                        '  <xsl:output indent="yes"/>',
                        '</xsl:stylesheet>',
                    ].join('\n'), 'application/xml');

                    const xsltProcessor = new XSLTProcessor();    
                    xsltProcessor.importStylesheet(xsltDoc);
                    const resultDoc = xsltProcessor.transformToDocument(xmlDoc);
                    const serializer = new XMLSerializer();
                    input.value = serializer.serializeToString(resultDoc);
                 }

             } catch (e) {
                 // Fallback for simple XML, or show error
                  error.innerText = "Invalid XML: " + e.message;
                  error.style.display = 'block';
             }
        }

        function copyResult() {
            const result = document.getElementById('inputData');
            result.select();
            document.execCommand('copy');
             // Visual feedback
            result.style.borderColor = "#2fb344";
            setTimeout(() => {
                result.style.borderColor = "#e6e7e9";
            }, 500);
        }
    </script>
    <!-- Libs JS -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
