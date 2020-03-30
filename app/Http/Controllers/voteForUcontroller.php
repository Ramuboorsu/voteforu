<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class voteForUcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

     public function vote(Request $req)
    {
        
        if(isset($_POST['submit']))
{
    $mobile = $_POST['mobile'];
    $apiKey = urlencode('j/YIcgcLzgQ-Jx2k3MsBvHKTJxCwWhNzOTy5ESww4X');
    $rand = rand(00000,99999);
    $hash = md5($mobile.$rand);
$ins = DB::table('registrations')->insert(['mobileNum'=>$mobile,'otp'=>$rand,'hashCode'=>$hash]);
if($ins)
{

$req->session()->put('mobile',$mobile);
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
        echo '<script>window.location.href="/otppage";</script>';
    }

  }
  else
  {
  echo "not inserted";  
  }
  }
    }


    public function otpsucces(Request $req)
    {
        if(isset($_POST['submit']))
        {
            $otpp = $_POST['otp'];
         $cnt =DB::table('registrations')->where('mobileNum',session()->get('mobile'))->where('otpStatus','!=',1)->count();
         if($cnt > 0)
         {
      $data=DB::table('registrations')->where('mobileNum',session()->get('mobile'))->select('*')->get();
      foreach ($data as $dat) {
          $optdata = $dat->otp;
      }
      if($optdata == $otpp)
      {
        //update otp status
        $up = DB::table('registrations')->where('mobileNum',session()->get('mobile'))->where('otp',$otpp)->update(['otpStatus'=>1]);
         $count = DB::table('registrations')->update([
        'otpStatus' => true
    ]);
         if($count == 0)
         {
            $length =12;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    // echo $randomString;
$hash = md5($randomString);


        //generate voterid store data in voterid table
        $in = DB::table('voterid')->insert(['mobile'=>session()->get('mobile'),'voterId'=>$randomString,'hash'=>$hash]);
        if($in)
        {
            echo '<script>window.location.href="/voteridpage"</script>'; 
            
        }
    }
    else
    {
        echo "otp wrong";
      }
    }

  }
  else
  {
    echo '<script>alert("otp expired");window.location.href="/otppage"</script>';
  }
}
else
{
    echo "wrong otp";
}

    }

//aadhar upload
    public function aadhar(Request $request)
    {
        $voterid = $_POST['voterid'];
        $mobile=session()->get('mobile');
        $file = $request->file('aadhar');
$file->move(public_path('\images'), $file->getClientOriginalName());
$aadhar = public_path('\images/'.$file->getClientOriginalName());
$ins=DB::table('voteraadhar')->insert(['mobile'=>session()->get('mobile'),'voterid'=>$voterid,'Aadhar'=>$aadhar]);

if($ins)
{
    echo '<script>alert("data updated");window.location.href="/voteridsuccess";</script>';
}

    }

    public function driving(Request $request)
    {
         $voterid = $_POST['voterid'];
         $mobile=session()->get('mobile');
        $file = $request->file('driving');
$file->move(public_path('\images'), $file->getClientOriginalName());
$aadhar = public_path('\images/'.$file->getClientOriginalName());
$ins =DB::table('drivinglicence')->insert(['mobile'=>session()->get('mobile'),'voterid'=>$voterid,'drivingLicence'=>$aadhar]);
if($ins)
{
    echo '<script>alert("data updated");window.location.href="/voteridsuccess";</script>';
}
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
