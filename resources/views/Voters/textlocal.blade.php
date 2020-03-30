
<?php
	// Account details
if(isset($_POST['submit']))
{
	$mobile = $_POST['mobile'];
	$apiKey = urlencode('j/YIcgcLzgQ-Jx2k3MsBvHKTJxCwWhNzOTy5ESww4X');
	$rand = rand(00000,99999);
	$hash = md5($mobile.$rand);
$ins = DB::table('registrations')->insert(['mobileNum'=>$mobile,'otp'=>$rand,'hashCode'=>$hash]);
if($ins)
{

$session->put('mobile',$mobile);
	// Message details
	// $numbers = array(918123456789, 918987654321);
		$numbers = array($mobile);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode('This is your otp for VoteForU-'.$rand);
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	$json = json_decode($response, true);
      // echo $json['status'];
	if($json['status'] == 'success')
	{
		echo '<script>window.location.href="/otppage/'.$mobile.'";</script>';
	}

  }
  else
  {
  echo "not inserted";	
  }
  }
?>