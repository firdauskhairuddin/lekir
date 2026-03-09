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
    <title><?php echo htmlentities($title); ?> - Subnet Calculator</title>
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
      .result-table th {
        width: 30%;
        color: #64748b;
        font-weight: 600;
      }
      .result-table td {
        font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        color: #0f172a;
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
                  Subnet Calculator
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-network" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" /><path d="M12 3c1.333 .333 2 2.333 2 6s-.667 5.667 -2 6s-2 -2.333 -2 -6s.667 -5.667 2 -6z" /><path d="M12 3c-4.8 5 -4.8 11 0 16" /><path d="M12 3c4.8 5 4.8 11 0 16" /><path d="M12 9l4.35 4.35" /><path d="M12 19h-8.5" /><path d="M8.5 15.5l-3.5 3.5l3.5 3.5" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">About Networking</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Networking
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Short Form:</strong> Subnet
                        </div>
                      </li>
                      <li>
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        <div>
                            <strong>Use case:</strong> Calculates network range, broadcast address, netmask, and usable hosts from a CIDR block.
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Tool Area -->
              <div class="col-lg-8">
                <div class="card tool-card">
                  <div class="card-header">
                     <h3 class="card-title">Calculator</h3>
                     <div class="card-actions">
                         <button class="btn btn-sm btn-ghost-danger" onclick="document.getElementById('cidrInput').value=''; calculateSubnet();">Clear</button>
                     </div>
                  </div>
                  <div class="card-body">
                    
                    <div class="mb-4">
                        <label class="form-label required">IP Address / CIDR</label>
                        <div class="input-group">
                            <input type="text" class="form-control font-monospace" id="cidrInput" placeholder="192.168.1.1/24">
                            <button class="btn btn-primary" onclick="calculateSubnet()">Calculate</button>
                        </div>
                        <small class="form-hint">Example: 192.168.0.1/24 or 10.0.0.0/8</small>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped result-table">
                            <tbody>
                                <tr>
                                    <th>Network Address</th>
                                    <td id="resNetwork">-</td>
                                </tr>
                                <tr>
                                    <th>Broadcast Address</th>
                                    <td id="resBroadcast">-</td>
                                </tr>
                                <tr>
                                    <th>Netmask</th>
                                    <td id="resNetmask">-</td>
                                </tr>
                                <tr>
                                    <th>Wildcard Mask</th>
                                    <td id="resWildcard">-</td>
                                </tr>
                                <tr>
                                    <th>First Usable Host</th>
                                    <td id="resFirst">-</td>
                                </tr>
                                <tr>
                                    <th>Last Usable Host</th>
                                    <td id="resLast">-</td>
                                </tr>
                                <tr>
                                    <th>Total Hosts</th>
                                    <td id="resTotal">-</td>
                                </tr>
                                 <tr>
                                    <th>Usable Hosts</th>
                                    <td id="resUsable">-</td>
                                </tr>
                                <tr>
                                    <th>IP Binary</th>
                                    <td id="resBinary" class="small text-muted">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

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
        function ip2long(ip) {
            let parts = ip.split('.');
            if (parts.length !== 4) return false;
            return (parseInt(parts[0]) << 24) + (parseInt(parts[1]) << 16) + (parseInt(parts[2]) << 8) + parseInt(parts[3]);
        }

        function long2ip(long) {
            return [
                (long >>> 24) & 0xFF,
                (long >>> 16) & 0xFF,
                (long >>> 8) & 0xFF,
                long & 0xFF
            ].join('.');
        }

        function toBinary(long) {
             let bin = (long >>> 0).toString(2);
             while (bin.length < 32) bin = "0" + bin;
             return bin.match(/.{8}/g).join('.');
        }

        function calculateSubnet() {
            const input = document.getElementById('cidrInput').value.trim();
            if (!input) return;

            let ip = input;
            let mask = 32;

            if (input.includes('/')) {
                const parts = input.split('/');
                ip = parts[0];
                mask = parseInt(parts[1]);
            }

            if (mask < 0 || mask > 32) {
                alert("Invalid mask");
                return;
            }

            const ipLong = ip2long(ip);
            if (ipLong === false) {
                 alert("Invalid IP address");
                 return;
            }

            const maskLong = -1 << (32 - mask);
            const networkLong = ipLong & maskLong;
            const broadcastLong = networkLong | ~maskLong;
            const wildcardLong = ~maskLong;

            const totalHosts = Math.pow(2, 32 - mask);
            const usableHosts = (totalHosts - 2 < 0) ? 0 : totalHosts - 2;

            document.getElementById('resNetwork').innerText = long2ip(networkLong) + " / " + mask;
            document.getElementById('resBroadcast').innerText = long2ip(broadcastLong);
            document.getElementById('resNetmask').innerText = long2ip(maskLong);
            document.getElementById('resWildcard').innerText = long2ip(wildcardLong);
            
            if (mask >= 31) {
                 document.getElementById('resFirst').innerText = "N/A";
                 document.getElementById('resLast').innerText = "N/A";
            } else {
                 document.getElementById('resFirst').innerText = long2ip(networkLong + 1);
                 document.getElementById('resLast').innerText = long2ip(broadcastLong - 1);
            }

            document.getElementById('resTotal').innerText = totalHosts.toLocaleString();
            document.getElementById('resUsable').innerText = usableHosts.toLocaleString();
            document.getElementById('resBinary').innerText = toBinary(ipLong);
        }
    </script>
    <!-- Libs JS -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
