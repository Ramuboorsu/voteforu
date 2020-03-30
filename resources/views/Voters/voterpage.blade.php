   
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Otp Page</title>
        <link rel="stylesheet" href="{{asset('css')}}/login.css">
        <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
         <div class="title">
            <span>Novisync</span>
            <h3>Vote For Ur Future</h3>
        </div>
         <div class="title">
      </div>
        <div class="main">
            <div class="login">
                <center>
              <?php
              $vote=DB::table('voterid')->where('mobile',session()->get('mobile'))->select('*')->get();
              foreach ($vote as $voterid) {
                $showid = $voterid->voterId; 
              }

              $apiKey = urlencode('j/YIcgcLzgQ-Jx2k3MsBvHKTJxCwWhNzOTy5ESww4X');
              $mobile=session()->get('mobile');
    // Message details
    // $numbers = array(918123456789, 918987654321);
        $numbers = array($mobile);
    $sender = urlencode('TXTLCL');
    $message = rawurlencode('your VoterID-'.$showid);
 
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
              echo "<h3>Your VoterId</h3><h2>".$showid."</h2>";
              ?>
              Click here to login:<a href="/loginvoter"><h3 style="text-decoration:none;color:white">Login</h3></a>

                </center>  
            </div>
            <!--  -->
        </div>

    </body>
    </html>