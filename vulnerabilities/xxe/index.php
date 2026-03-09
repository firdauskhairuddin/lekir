<?php
// Determine the base path based on current directory depth
$current_path = $_SERVER["PHP_SELF"];
$base_path = "./";
if (strpos($current_path, "/vulnerabilities/") !== false) {
    $parts = explode("/vulnerabilities/", $current_path);
    if (isset($parts[1]) && strpos($parts[1], "/") !== false) {
        $base_path = "../../";
    } else {
        $base_path = "../";
    }
} elseif (
    strpos($current_path, "/tools/") !== false ||
    strpos($current_path, "/compare/") !== false ||
    strpos($current_path, "/components/") !== false
) {
    $base_path = "../";
}

session_start();
include $base_path . "core/configuration.php";
include $base_path . "core/function.php";

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set("display_errors", 1);
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
      @import url("https://rsms.me/inter/inter.css");
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: 'cv03', "cv04", "cv11";
      }
      
      /* Car Portal Parsed CSS */
      .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
      }
      .section-title i { font-size: 1.8rem; color: #3498db; }
      .section-title h2 { color: #2c3e50; font-size: 1.8rem; margin: 0; }
      
      .input-group label {
            display: block;
            margin-bottom: 10px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.1rem;
      }
      
      textarea#car-xml {
            width: 100%;
            padding: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            resize: vertical;
            min-height: 300px;
            transition: all 0.3s;
            line-height: 1.5;
            font-family: 'Courier New', monospace;
            background: #fafafa;
            margin-bottom: 20px;
      }
      textarea#car-xml:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            background: #fff;
      }
      
      .result-container {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            min-height: 300px;
            border: 2px dashed #dee2e6;
            margin-bottom: 20px;
      }
      
      .result-placeholder {
            text-align: center;
            color: #adb5bd;
            padding: 60px 20px;
      }
      .result-placeholder i { font-size: 4rem; margin-bottom: 20px; opacity: 0.5; }
      .result-placeholder h3 { font-size: 1.5rem; margin-bottom: 10px; color: #6c757d; }
      
      .car-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
      }
      
      .detail-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #3498db;
            transition: transform 0.3s;
      }
      .detail-card:hover { transform: translateY(-5px); }
      
      .detail-title {
            color: #7f8c8d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
      }
      .detail-value {
            color: #2c3e50;
            font-size: 1.3rem;
            font-weight: 600;
            word-break: break-all;
      }
      
      .example-section {
            margin-top: 30px;
            background: #e8f4fc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
      }
      .example-title {
            color: #3498db;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
      }
      .example-code {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            line-height: 1.5;
            overflow-x: auto;
      }
    </style>
  </head>
  <body >
    <script src="<?php echo $base_path; ?>dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      

      <?php include $base_path . "components/top_navbar.php"; ?>
      <?php include $base_path . "components/header.php"; ?>

      <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <div class="me-3">
                        <!-- Download SVG icon from http://tabler-icons.io/i/scale -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-vaccine"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3l4 4" /><path d="M19 5l-4.5 4.5" /><path d="M11.5 6.5l6 6" /><path d="M16.5 11.5l-6.5 6.5h-4v-4l6.5 -6.5" /><path d="M7.5 12.5l1.5 1.5" /><path d="M10.5 9.5l1.5 1.5" /><path d="M3 21l3 -3" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">XML External Entity (XXE)</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : Others</li>
                      <li><b>Short Form</b> : XXE</li>
                      <li><b>Injection Point</b> : $_POST['car-xml']</li>
                      <li><b>Why this happaen</b> : XXE attacks target applications that parse XML input. By injecting malicious XML entities, attackers can trick the parser into revealing sensitive information, such as local files or internal system data. This vulnerability arises when XML parsers are configured to process external entities without proper validation. To prevent XXE attacks, applications should disable external entity processing and validate all XML input. </li>
                      <li><b>Author</b> : EagleTube </li>
                      <br>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-payloads">
                      View Payload
                      </a>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-simple">
                      View Source
                      </a>
                    </ul>   
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="container">
                    <form method="POST" action="">
                    <div class="input-group mt-3">
                        <h2>Car Details in XML Format</h2>
                        <textarea id="car-xml" name="car-xml" placeholder='Paste your car XML data here...'><?php if (
                            $_SERVER["REQUEST_METHOD"] === "POST" &&
                            isset($_POST["car-xml"])
                        ) {
                            echo htmlspecialchars($_POST["car-xml"]);
                        } else {
                            echo '<?xml version="1.0"?>
<car>
    <brand>Toyota</brand>
    <model>Camry XSE</model>
    <year>2024</year>
    <color>Midnight Black Metallic</color>
    <price>34999</price>
    <engine>2.5L 4-Cylinder Hybrid</engine>
    <horsepower>208 HP</horsepower>
    <fuel_economy>44 MPG Combined</fuel_economy>
    <transmission>8-Speed Automatic</transmission>
    <features>
        <feature>Panoramic Sunroof</feature>
        <feature>Heated Leather Seats</feature>
        <feature>12.3" Touchscreen Display</feature>
        <feature>JBL Premium Audio</feature>
        <feature>Advanced Safety Suite</feature>
    </features>
    <description>The 2024 Toyota Camry XSE combines sophisticated styling with impressive fuel efficiency and advanced technology features.</description>
</car>';
                        } ?></textarea>
                    </div>
            </div>
            
            <div class="container">
                    <h2>Car Details Output</h2>
                
                <div class="result-container">
                    <?php if (
                        $_SERVER["REQUEST_METHOD"] === "POST" &&
                        isset($_POST["car-xml"])
                    ) {
                        $xmlData = $_POST["car-xml"];

                        if (!empty($xmlData)) {
                            try {
                                // Process the XML data
                                //libxml_disable_entity_loader(false);

                                $carData = simplexml_load_string(
                                    $xmlData,
                                    "SimpleXMLElement",
                                    LIBXML_NOENT | LIBXML_DTDLOAD
                                );

                                if ($carData) {
                                    echo '<div class="car-details">';

                                    // Function to display detail card
                                    function displayDetail($title, $value)
                                    {
                                        if (!empty($value)) {
                                            return '<div class="detail-card">
                                                <div class="detail-title">' .
                                                htmlspecialchars($title) .
                                                '</div>
                                                <div class="detail-value">' .
                                                htmlspecialchars($value) .
                                                '</div>
                                            </div>';
                                        }
                                        return "";
                                    }

                                    // Display all available car details
                                    echo displayDetail(
                                        "Brand",
                                        (string) $carData->brand
                                    );
                                    echo displayDetail(
                                        "Model",
                                        (string) $carData->model
                                    );
                                    echo displayDetail(
                                        "Year",
                                        (string) $carData->year
                                    );
                                    echo displayDetail(
                                        "Color",
                                        (string) $carData->color
                                    );
                                    echo displayDetail(
                                        "Price",
                                        '$' .
                                            number_format(
                                                (float) $carData->price,
                                                2
                                            )
                                    );
                                    echo displayDetail(
                                        "Engine",
                                        (string) $carData->engine
                                    );
                                    echo displayDetail(
                                        "Horsepower",
                                        (string) $carData->horsepower
                                    );
                                    echo displayDetail(
                                        "Transmission",
                                        (string) $carData->transmission
                                    );
                                    echo displayDetail(
                                        "Fuel Economy",
                                        (string) $carData->fuel_economy
                                    );
                                    echo displayDetail(
                                        "VIN",
                                        (string) $carData->vin
                                    );
                                    echo displayDetail(
                                        "Mileage",
                                        (string) $carData->mileage
                                    );

                                    // Handle features specially if they're in a list
                                    if (isset($carData->features)) {
                                        $features = "";
                                        if (
                                            isset($carData->features->feature)
                                        ) {
                                            foreach (
                                                $carData->features->feature
                                                as $feature
                                            ) {
                                                $features .=
                                                    "• " .
                                                    htmlspecialchars(
                                                        (string) $feature
                                                    ) .
                                                    "<br>";
                                            }
                                        } else {
                                            $features =
                                                (string) $carData->features;
                                        }

                                        if (!empty($features)) {
                                            echo '<div class="detail-card" style="grid-column: span 2;">
                                                <div class="detail-title">Features</div>
                                                <div class="detail-value">' .
                                                $features .
                                                '</div>
                                            </div>';
                                        }
                                    }

                                    // Handle description specially
                                    if (isset($carData->description)) {
                                        echo '<div class="detail-card" style="grid-column: span 2; border-left-color: #2ecc71;">
                                            <div class="detail-title">Description</div>
                                            <div class="detail-value">' .
                                            htmlspecialchars(
                                                (string) $carData->description
                                            ) .
                                            '</div>
                                        </div>';
                                    }

                                    echo "</div>";
                                } else {
                                    echo '<div class="result-placeholder">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <h3>Invalid XML Format</h3>
                                        <p>Please check your XML syntax and try again.</p>
                                    </div>';
                                }
                            } catch (Exception $e) {
                                echo '<div class="result-placeholder">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <h3>Processing Error</h3>
                                    <p>Error: ' .
                                    htmlspecialchars($e->getMessage()) .
                                    '</p>
                                </div>';
                            }
                        } else {
                            echo '<div class="result-placeholder">
                                <i class="fas fa-car"></i>
                                <h3>No Data Provided</h3>
                                <p>Please enter XML car data in the input section and click "Process Car Details".</p>
                            </div>';
                        }
                    } else {
                        echo '<div class="result-placeholder">
                            <i class="fas fa-arrow-left"></i>
                            <h3>Awaiting Input</h3>
                            <p>Enter your car XML data on the left and click "Process Car Details" to see the formatted results here.</p>
                        </div>';
                    } ?>
                </div>
                
            </div>
        </div>
                    <center>
                    <button action="submit" class="btn btn-primary mt-3">  
                        Process Car Details
                    </button>
                    </center>
                </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include $base_path . "components/footer.php"; ?>

      <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">XML External Entity - Source Code</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php highlight_file($base_path . "sourcecode/xxecode.txt"); ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="modal-payloads" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">XML External Entity - Payload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php highlight_file($base_path . "payloads/xxepayload.txt"); ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>payloads/xxepayload.txt" type="button" class="btn btn-primary" download>Download</a>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>