
      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="./dashboard.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-vaccine"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3l4 4" /><path d="M19 5l-4.5 4.5" /><path d="M11.5 6.5l6 6" /><path d="M16.5 11.5l-6.5 6.5h-4v-4l6.5 -6.5" /><path d="M7.5 12.5l1.5 1.5" /><path d="M10.5 9.5l1.5 1.5" /><path d="M3 21l3 -3" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Vulnerability
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="./sqlinjection.php">
                          SQL Injection
                        </a>
                        <a class="dropdown-item" href="./sqlinjectionblind.php">
                          SQL Injection
                          <span class="badge badge-sm bg-info-lt text-uppercase ms-auto">Blind</span>
                        </a>
                        <a class="dropdown-item" href="./localfileinclusion.php">
                          Local File Inclusion
                        </a>
                        <a class="dropdown-item" href="./commandinjection.php">
                          Command Injection
                        </a>
                        <a class="dropdown-item" href="./fileupload.php">
                          File Upload
                        </a>
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Cross Site Scripting
                          </a>
                          <div class="dropdown-menu">
                            <a href="./xssreflected.php" class="dropdown-item">
                              XSS
                            <span class="badge badge-sm bg-info-lt text-uppercase ms-auto">Reflected</span>
                            </a>
                            <a href="./xssstored.php" class="dropdown-item">
                              XSS
                             <span class="badge badge-sm bg-info-lt text-uppercase ms-auto">Stored</span>
                            </a>
                            <a href="./xssdom.php" class="dropdown-item">
                              XSS
                              <span class="badge badge-sm bg-info-lt text-uppercase ms-auto">DOM</span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-menu-column">
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            SQLi
                          <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Others</span>
                          </a>
                          <div class="dropdown-menu">
                            <a href="./sqlinjectioncookie.php" class="dropdown-item">
                              SQLi - $_COOKIE['user_id']
                            </a>
                            <a href="./sqlinjectionuseragent.php" class="dropdown-item">
                              SQLi - User-Agent
                            </a>
                            <a href="./sqlinjectionwaf.php" class="dropdown-item">
                              SQLi - Simple WAF
                            </a>
                            <a href="./sqlinjectionlow.php" class="dropdown-item" style="color:green;">
                              SQLi - Low
                            </a>
                            <a href="./sqlinjectionmedium.php" class="dropdown-item" style="color:orange;">
                              SQLi - Medium
                            </a>
                            <a href="./sqlinjectionhigh.php" class="dropdown-item" style="color:red;">
                              SQLi - High
                            </a>
                            <a href="./sqlinjectionimpossible.php" class="dropdown-item" style="color:#8B0000;">
                              SQLi - Impossible
                            </a>
                          </div>
                        </div>
                      <div class="dropdown-menu-column">
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            SQLi Blind
                          <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Others</span>
                          </a>
                          <div class="dropdown-menu">
                            <a href="./sqlinjectionblindlow.php" class="dropdown-item" style="color:green;">
                              SQLi - Low
                            </a>
                            <a href="./sqlinjectionblindmedium.php" class="dropdown-item" style="color:orange;">
                              SQLi - Medium
                            </a>
                            <a href="./sqlinjectionblindhigh.php" class="dropdown-item" style="color:red;">
                              SQLi - High
                            </a>
                            <a href="./sqlinjectionblindimpossible.php" class="dropdown-item" style="color:#8B0000;">
                              SQLi - Impossible
                            </a>
                          </div>
                        </div>
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            LFI
                            <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Others</span>
                          </a>
                          <div class="dropdown-menu">
                            <a href="./localfileinclusionpost.php" class="dropdown-item">
                              LFI - $_POST['page']
                            </a>
                            <a href="./localfileinclusioncookie.php" class="dropdown-item">
                              LFI - $_COOKIE['page']
                            </a>
                            <a href="./localfileinclusionphpappend.php" class="dropdown-item">
                              LFI - .php append
                            </a>
                            <a href="./localfileinclusiongifchain.php" class="dropdown-item">
                              LFI - GIF Upload Chain
                            </a>
                            <a href="./localfileinclusionlfi2rce.php" class="dropdown-item">
                              LFI - LFI2RCE
                            </a>
                            <a href="./localfileinclusionlow.php" class="dropdown-item" style="color:green;">
                              LFI - Low
                            </a>
                            <a href="./localfileinclusionmedium.php" class="dropdown-item" style="color:orange;">
                              LFI - Medium
                            </a>
                            <a href="./localfileinclusionhigh.php" class="dropdown-item" style="color:red;">
                              LFI - High
                            </a>
                            <a href="./localfileinclusionimpossible.php" class="dropdown-item" style="color:#8B0000;">
                              LFI - Impossible
                            </a>
                          </div>
                        </div>
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Ci
                          <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Others</span>
                          </a>
                          <div class="dropdown-menu">
                            <a href="./commandinjectionlow.php" class="dropdown-item" style="color:green;">
                              Command Injection - Low
                            </a>
                            <a href="./commandinjectionmedium.php" class="dropdown-item" style="color:orange;">
                              Command Injection - Medium
                            </a>
                            <a href="./commandinjectionhigh.php" class="dropdown-item" style="color:red;">
                              Command Injection - High
                            </a>
                            <a href="./commandinjectionimpossible.php" class="dropdown-item" style="color:#8B0000;">
                              Command Injection - Impossible
                            </a>
                          </div>
                        </div>
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            File Upload
                          <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Others</span>
                          </a>
                          <div class="dropdown-menu">
                            <a href="./fileuploadlow.php" class="dropdown-item" style="color:green;">
                              File Upload - Low
                            </a>
                            <a href="./fileuploadmedium.php" class="dropdown-item" style="color:orange;">
                              File Upload - Medium
                            </a>
                            <a href="./fileuploadhigh.php" class="dropdown-item" style="color:red;">
                              File Upload - High
                            </a>
                            <a href="./fileuploadimpossible.php" class="dropdown-item" style="color:#8B0000;">
                              File Upload - Impossible
                            </a>
                          </div>
                        </div>
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            XSS
                          <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Others</span>
                          </a>
                          <div class="dropdown-menu">
                            <a href="./xssinputtag.php" class="dropdown-item">
                              XSS - Input Tag
                            </a>
                            <a href="./xsscookie.php" class="dropdown-item">
                              XSS - $_COOKIE['user_id']
                            </a>
                            <a href="./xssuseragent.php" class="dropdown-item">
                              XSS - User-Agent
                            </a>


                            <a href="./xssreflectedlow.php" class="dropdown-item" style="color:green;">
                              XSS Reflected - Low
                            </a>
                            <a href="./xssreflectedmedium.php" class="dropdown-item" style="color:orange;">
                              XSS Reflected - Medium
                            </a>
                            <a href="./xssreflectedigh.php" class="dropdown-item" style="color:red;">
                              XSS Reflected - High
                            </a>
                            <a href="./xssreflectedimpossible.php" class="dropdown-item" style="color:#8B0000;">
                              XSS Reflected - Impossible
                            </a>


                            <a href="./xssstoredlow.php" class="dropdown-item" style="color:green;">
                              XSS Stored - Low
                            </a>
                            <a href="./xssstoredmedium.php" class="dropdown-item" style="color:orange;">
                              XSS Stored - Medium
                            </a>
                            <a href="./xssstoredhigh.php" class="dropdown-item" style="color:red;">
                              XSS Stored - High
                            </a>
                            <a href="./xssstoredimpossible.php" class="dropdown-item" style="color:#8B0000;">
                              XSS Stored - Impossible
                            </a>


                            <a href="./xssdomow.php" class="dropdown-item" style="color:green;">
                              XSS DOM - Low
                            </a>
                            <a href="./xssdommedium.php" class="dropdown-item" style="color:orange;">
                              XSS DOM - Medium
                            </a>
                            <a href="./xssdomhigh.php" class="dropdown-item" style="color:red;">
                              XSS DOM - High
                            </a>
                            <a href="./xssdomimpossible.php" class="dropdown-item" style="color:#8B0000;">
                              XSS DOM - Impossible
                            </a>
                          </div>
                        </div>
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Others
                          <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Others</span>
                          </a>
                          <div class="dropdown-menu">
                            <a href="./arbitarydownload.php" class="dropdown-item">
                              Arbitrary File Download
                            </a>
                            <a href="./typejuggling.php" class="dropdown-item">
                              PHP Type Juggling
                            </a>
                            <a href="./jwt.php" class="dropdown-item">
                              JWT Weak Password
                            </a>
                            <a href="./idor.php" class="dropdown-item">
                              Insecure direct object references (IDOR)
                            </a>
                            <a href="./remotecodeexecution.php" class="dropdown-item">
                              Remote Code Execution
                            </a>
                            <a href="./gitexpose.php" class="dropdown-item">
                              Expose Git
                            </a>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tool"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Tools
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="./base64encode.php">
                          Base64 Encode
                        </a>
                        <a class="dropdown-item" href="./base64decode.php">
                          Base64 Decode
                        </a>
                        <a class="dropdown-item" href="./texttohex.php">
                          Text to Hex
                        </a>
                        <a class="dropdown-item" href="./texttomd5.php">
                          Text to MD5
                        </a>
                        <a class="dropdown-item" href="./texttosha1.php">
                          Text to SHA1
                        </a>
                        <a class="dropdown-item" href="./charactercount.php">
                          Character Count
                        </a>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-git-compare"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M11 6h5a2 2 0 0 1 2 2v8" /><path d="M14 9l-3 -3l3 -3" /><path d="M13 18h-5a2 2 0 0 1 -2 -2v-8" /><path d="M10 15l3 3l-3 3" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Compare Level
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="./sqlinjectioncodecompare.php">
                          SQL Injection
                        </a>
                        <a class="dropdown-item" href="./sqlinjectionblindcodecompare.php">
                          SQL Injection Blind
                        </a>
                        <a class="dropdown-item" href="./localfileinclusioncodecompare.php">
                          Local File Inclusion
                        </a>
                        <a class="dropdown-item" href="./commandinjectioncodecompare.php">
                          Command Injection
                        </a>
                        <a class="dropdown-item" href="./fileuploadcodecompare.php">
                          File Upload
                        </a>
                        <a class="dropdown-item" href="./xssreflectedcodecompare.php">
                          XSS
                        <span class="badge badge-sm bg-info-lt text-uppercase ms-auto">Reflected</span>
                        </a>
                        <a class="dropdown-item" href="./xssstoredcodecompare.php">
                          XSS
                         <span class="badge badge-sm bg-info-lt text-uppercase ms-auto">Stored</span>
                        </a>
                        <a class="dropdown-item" href="./xssdomcodecompare.php">
                          XSS
                          <span class="badge badge-sm bg-info-lt text-uppercase ms-auto">DOM</span>
                        </a>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./settings.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Settings
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./about.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" /><path d="M10 10l.01 0" /><path d="M14 10l.01 0" /><path d="M10 14a3.5 3.5 0 0 0 4 0" /></svg>
                    </span>
                    <span class="nav-link-title">
                      About
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>