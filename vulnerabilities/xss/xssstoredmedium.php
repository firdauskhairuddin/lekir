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

ini_set("display_errors", 1);
header ('X-XSS-Protection: 0');

function executeStatement($mysqli, $query, $params = null) {
    $stmt = $mysqli->prepare($query);
    if ($params) {
        $stmt->bind_param(...$params);
    }
    $stmt->execute();
    return $stmt;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    executeStatement($mysqli, 'DELETE FROM xss WHERE xss_id = ?', ['i', $_GET['id']]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['submit']) && isset($_POST['name'], $_POST['age'], $_POST['job'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $job = $_POST['job'];

    $job = str_replace( '<script>', '', $job );

    executeStatement($mysqli, "INSERT INTO xss (xss_name, xss_age, xss_job) VALUES (?, ?, ?)", ["sis", $name, $age, $job]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$query = $mysqli->query('SELECT * FROM xss LIMIT 10');
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
                        <!-- Download SVG icon from http://tabler-icons.io/i/scale -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-vaccine"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3l4 4" /><path d="M19 5l-4.5 4.5" /><path d="M11.5 6.5l6 6" /><path d="M16.5 11.5l-6.5 6.5h-4v-4l6.5 -6.5" /><path d="M7.5 12.5l1.5 1.5" /><path d="M10.5 9.5l1.5 1.5" /><path d="M3 21l3 -3" /></svg>
                      </div>
                      <div>
                        <small class="text-muted">Information</small>
                        <h3 class="lh-1">Cross Site Scripting - Stored</h3>
                      </div>
                    </div>
                    <ul class="list-unstyled space-y-1">
                      <li><b>Level</b> : <font style="color:orange;"><b>Medium</b></font></li>
                      <li><b>Short Form</b> : XSS</li>
                      <li><b>Injection Point</b> : $_POST['job']</li>
                      <li><b>Why this happen</b> : XSS occurs when a web application takes user-supplied data and includes it in the output sent back to the user's browser without properly validating or sanitizing it. This allows an attacker to craft a specially crafted URL or form input that, when clicked or submitted by a victim, executes malicious code in the victim's browser.</li>
                      <li><b>Read More</b> : <a href='https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/cross-site-scripting' target="_blank">Link</a></li>
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
              <div class="col-8">
                  <form class="card" action="" method="POST">
                    <div class="card-body">
                      <h3 class="card-title">Update User</h3>
                      <div class="row row-cards">
                        <div class="col-sm-4 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name">
                          </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="job" placeholder="Title">
                          </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control" name="age" placeholder="Age">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end">
                      <button type="submit" name="submit" class="btn btn-primary">Save Record</button>
                    </div>
                  </form>
                </div>

              <div class="col-lg-12">
                <div class="card">
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Title</th>
                          <th>Age</th>
                          <th class="w-1">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          if ($query && $query->num_rows > 0) {
                              // Iterate over each row
                              while ($row = $query->fetch_assoc()) {
                                  // Output the data for each row
                                  echo "<tr>";
                                  echo '<td>' . htmlspecialchars($row['xss_name']) . '</td>';
                                  echo '<td class="text-muted">' . $row['xss_job'] . '</td>';
                                  echo '<td class="text-muted">' . htmlspecialchars($row['xss_age']) . '</td>';
                                  // Display a 'Remove' link to delete the corresponding record
                                  echo '<td><a href="' . $_SERVER['PHP_SELF'] . '?action=delete&id=' . htmlspecialchars($row['xss_id']) . '">Remove</a></td>';
                                  echo '</tr>';
                              }
                          } else {
                              // Display a message if no records are found
                              echo '<tr><td colspan="4"><center>No records found</center></td></tr>';
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>

      <?php include($base_path . 'components/footer.php');?>

      <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cross Site Scripting - Source Code</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "sourcecode/xssstoredmediumcode.txt");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>compare/xssstoredcodecompare.php" type="button" class="btn btn-primary">Compare All Level</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="modal-payloads" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cross Site Scripting - Payload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #E5E4E2;">
              <?php
              highlight_file($base_path . "payloads/xss_payload.txt");
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="<?php echo $base_path; ?>payloads/xss_payload.txt" type="button" class="btn btn-primary" download>Download</a>
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