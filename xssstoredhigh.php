<?php
session_start();
include('./core/configuration.php');
include('./core/function.php');

$session = new Session();
$session->check_invalid_session();

$secure = new Secure();
$level = new Level();

ini_set('display_errors', 1);
header ("X-XSS-Protection: 0");

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
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['submit']) && isset($_POST['name'], $_POST['age'], $_POST['job'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $job = $_POST['job'];

    $job = str_replace( '<script>', '', $job );

    executeStatement($mysqli, "INSERT INTO xss (xss_name, xss_age, xss_job) VALUES (?, ?, ?)", ['sis', $name, $age, $job]);
    header("Location: " . $_SERVER['PHP_SELF']);
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
                      <li><b>Level</b> : <font style="color:red;"><b>High</b></font></li>
                      <li><b>Short Form</b> : XSS</li>
                      <li><b>Injection Point</b> : $_POST['job']</li>
                      <li><b>Why this happen</b> : XSS occurs when a web application takes user-supplied data and includes it in the output sent back to the user's browser without properly validating or sanitizing it. This allows an attacker to craft a specially crafted URL or form input that, when clicked or submitted by a victim, executes malicious code in the victim's browser.</li>
                      <li><b>Read More</b> : <a href="https://firdauskhairuddin.gitbook.io/common-web-vulnerability-php/cross-site-scripting" target="_blank">Link</a></li>
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
                                  echo '<tr>';
                                  echo '<td>' . htmlspecialchars($row['xss_name']) . '</td>';
                                  echo '<td class="text-muted">' . $row['xss_job'] . '</td>';
                                  echo '<td class="text-muted">' . htmlspecialchars($row['xss_age']) . '</td>';
                                  // Display a "Remove" link to delete the corresponding record
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

      <?php include('./components/footer.php');?>

      <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cross Site Scripting - Source Code</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <code>
                <?php
                highlight_file('./sourcecode/xssstoredhighcode.txt');
                ?>
              </code>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="xssstoredcodecompare.php" type="button" class="btn btn-primary">Compare All Level</a>
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
            <div class="modal-body">
              <code>
                <?php
                highlight_file('./payloads/xss_payload.txt');
                ?>
              </code>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <a href="./payloads/xss_payload.txt" type="button" class="btn btn-primary" download>Download</a>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>