<?php
require_once 'configuration.php';

class Secure
{

	function encrypt($data)
	{
		global $key;
	    // Generate a random IV (Initialization Vector)
	    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-gcm'));

	    // Extract the tag from the encryption process
	    $tag = openssl_cipher_iv_length('aes-256-gcm');

	    // Encrypt the data using AES-GCM
	    $ciphertext = openssl_encrypt($data, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag);

	    // Combine IV, tag, and ciphertext and encode them in Base64
	    $encrypted = base64_encode($iv . $tag . $ciphertext);

	    return $encrypted;
	}

	function decrypt($data)
	{
		global $key;
	    // Decode Base64 and extract IV and tag
	    $data = base64_decode($data);
	    $iv = substr($data, 0, 12); // IV length is 12 bytes for AES-GCM
	    $tag = substr($data, 12, 16); // Tag length is 16 bytes for AES-GCM
	    $ciphertext = substr($data, 28); // Remaining is the ciphertext

	    // Decrypt the ciphertext using AES-GCM
	    $plaintext = openssl_decrypt($ciphertext, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag);

	    if ($plaintext === false) {
	        // Decryption failed
	        return false;
	    }

	    return $plaintext;
	}

	function xecho($data)
	{
		$data = htmlspecialchars($data, FILTER_SANITIZE_SPECIAL_CHARS);
		return $data;
	}	
}

class Pages
{
	function errorpage($data)
	{
		global $title;

		echo '<head>';
		echo '<link rel="icon" sizes="16x16" href="./static/lekir.jpeg">';
		echo '<title>' . $title . '</title>';
		echo '</head>';
		echo '<body style="background:#F6FFFE;">';
		echo '<table width="100%" height="100%">';
		echo '<tr>';
		echo '<td align="center" valign="middle"><img border="0" width="120" height="120" src="./static/lekir.jpeg"><br/><br/><!-- '.$data.' --></br</td>';
		echo '</tr>';
		echo '</table>';
		echo '</body>';

		exit();
	}
}

class Validate
{
	function empty_data($data)
	{
		if(empty($data))
		{
			exit("error_data_empty");
		} else {
			return $data;
		}
	}

	function isvalidname($data)
	{
		if (preg_match('/[\W]+/', $data)){
		    exit("error_invalid_character");
		} else {
			return $data;
		}
	}

	function isnumeric($data)
	{
		if (preg_match('/[0-9]/', $data))
		{
		    exit('error_invalid_character');
		}
	}


	function isemail($data)
	{
		if (filter_var($data, FILTER_VALIDATE_EMAIL))
		{
			return $data;
		} else {
			exit("error_invalid_email");
		}
	}

	function upload($data)
	{
		if($data['name'] == NULL)
		{
			return NULL;
		} else {
			
			$filext = explode('.',$data['name']);
			$extensions= array("jpeg","jpg","png");
      
	      	if(in_array($filext[1],$extensions)=== false){
	      	   exit('error_file_extension');
	     	}

			move_uploaded_file($data['tmp_name'],"upload/".$data['name']);

			return $data['name'];
		}
	}
}

class Update
{
	// Function to fetch latest commit hash from GitHub main branch
	function getLatestCommitHash($owner, $repo) {
	    $url = "https://api.github.com/repos/$owner/$repo/commits/main";
	    
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
	    $response = curl_exec($ch);
	    curl_close($ch);
	    
	    $data = json_decode($response, true);
	    
	    if (isset($data['sha'])) {
	        return $data['sha'];
	    }
	    return false;
	}

	// Function to check current installed commit hash
	function getCurrentCommitHash() {
	    $hash_file = '.git/refs/heads/main';
	    $current_hash = file_get_contents($hash_file);
	    return trim($current_hash);
	}

	// Function to perform update
	function performUpdate($owner, $repo) {
	    // Execute git pull or any other update mechanism here
	    // This can be done via system commands or using PHP libraries like Symfony Process Component
	    // Remember to handle errors and output properly
	    $output = shell_exec("git pull origin main");
	    return $output;
	}
}

class Session
{
	function check_invalid_session()
	{
		
		if (empty($_SESSION['user_id']) || empty($_SESSION['user_name']) )
	    {
	        header("refresh:0;url=./");
	        exit();
	    }
	}
}

class Level
{
	function current_level($data)
	{
		if($data == '1')
		{
			$data = '<b><font style="color:green;">Low</font></b>';
			return $data;
			exit();
		}

		if($data == '2')
		{
			$data = '<b><font style="color:orange;">Medium</font></b>';
			return $data;
			exit();
		}

		if($data == '3')
		{
			$data = '<b><font style="color:red;">High</font></b>';
			return $data;
			exit();
		}

		if($data == '4')
		{
			$data = '<b><font style="color:#8B0000;">Impossible</font></b>';
			return $data;
			exit();
		}
		else
		{
			exit();
		}
	}

	function check_level($data,$url)
	{
		$urlarray= explode('.',$url);


		if($data=="1"){
			header("refresh:0;url=$urlarray[0]low.$urlarray[1]");
	        exit();
		}

		if($data=="2"){
			header("refresh:0;url=$urlarray[0]medium.$urlarray[1]");
	        exit();
		}

		if($data=="3"){
			header("refresh:0;url=$urlarray[0]high.$urlarray[1]");
	        exit();
		}

		if($data=="4"){
			header("refresh:0;url=$urlarray[0]impossible.$urlarray[1]");
	        exit();
		}
	}
}

?>
