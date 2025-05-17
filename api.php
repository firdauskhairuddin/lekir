<?php
include ('./core/configuration.php');
include ('./core/function.php');

$pages = new Pages();
$secure = new Secure();
$validate = new Validate();

if (isset($_GET['action']))
{
    $action = $_GET['action'];

    if ($action == NULL)
    {
        $data = "IkNyb2NvZGlsZXMgYXJlIGVhc3ksIHRoZXkgdHJ5IHRvIGtpbGwgYW5kIGVhdCB5b3UuIFBlb3BsZSBhcmUgaGFyZGVyLCBzb21ldGltZXMgdGhleSBwcmV0ZW5kIHRvIGJlIHlvdXIgZnJpZW5kIGZpcnN0IgoKLSBTdGV2ZSBJcndpbiAoMTk2MiAtIDIwMDYp";
        $pages->errorpage($data);
        exit();
    }

    //Login Process
    if ($action == "login")
    {
        error_reporting(0);
        $stmt = $connect->prepare('SELECT * FROM user WHERE user_name = ?');
        $stmt->execute([$_POST['username']]);

        $querydata = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($_POST['username'] === $querydata[0]->user_name && password_verify($_POST['password'], $querydata[0]->user_password))
        {
            session_start();
            $_SESSION['user_id'] = htmlentities($querydata[0]->user_id);
            $_SESSION['user_name'] = htmlentities($querydata[0]->user_name);
            $_SESSION['user_role'] = htmlentities($querydata[0]->user_role);
            $_SESSION['level'] = '1';
            $_SESSION['jwtrole'] = '1';
            $_SESSION['token'] = bin2hex(random_bytes(64));
            setcookie("user_id", "1", time() + 8 * 3600, "/");
            setcookie("page", "page1.php", time() + 8 * 3600, "/");

            header('Location: dashboard.php');
        }
        else
        {
            session_start();
            $_SESSION['message'] = "Invalid username or password";
            $_SESSION['alert'] = "danger";
            header('Location: ./');
            exit();
        }
    }

    //Login Process
    if ($action == "level")
    {
        if (isset($_POST['level']))
        {
            session_start();
            $level = min(max(1, intval($_POST['level'])) , 4);
            $_SESSION['level'] = $level;

            // if(isset($_SESSION['last_visited_page'])){
            // 	header('Location:'.$_SESSION['last_visited_page']);
            // } else {
            // 	header('Location: ./dashboard.php');
            // }
            header('Location: ./dashboard.php');
            exit;
        }

        header('Location: ./');
        exit;
    }

    //Logout Process
    if ($_GET['action'] == "logout")
    {
        session_start();
        session_destroy();
        session_start();
        $_SESSION['message'] = "You have been logged out";
        $_SESSION['alert'] = "success";
        header("Location: ./");
        exit();
    }

    else
    {
        $data = "QXJndWluZyB3aXRoIGEgd29tYW5pcyBsaWtlIHJlYWRpbmcgdGhlIFNvZnR3YXJlIExpY2Vuc2UgQWdyZWVtZW50LiBJbiB0aGUgZW5kLCB5b3UgaWdub3JlIGV2ZXJ5dGhpbmcgYW5kIGNsaWNrICJJIGFncmVlIg==";
        $pages->errorpage($data);
        exit();
    }

}

else
{
    $data = "aGVsbG8gaSBuZWVkIHNhbGFyeSBvZiA1MDAwIFVTRCBwbGVhc2UgaGlyZSBtZSBpIGNhbiBoYWNrLCBjb2RlIGFuZCBkbyBzZXJ2ZXIgc3R1ZmYhIEBmaXJkYXVza2hhaXJ1ZGRpbg==";
    $pages->errorpage($data);
    exit();
}

?>
