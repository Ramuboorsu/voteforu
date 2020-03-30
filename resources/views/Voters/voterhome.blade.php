   
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login Page</title>
        <link rel="stylesheet" href="{{asset('css')}}/login.css">
        <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 60%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: black;
}
</style>
        <script>
function myFunction() {
  var x = document.getElementById("govtproof").value;
  alert(x);
  if(x =='Aadhar')
  {
     document.getElementById("form2").style.visibility = "hidden";
     document.getElementById("form1").style.visibility = "visible";
  }
 
  if(x == 'DrivingLicence')
  {
    document.getElementById("form1").style.visibility = "hidden";
    document.getElementById("form2").style.visibility = "visible";
  }
}
</script>
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
                 $seldata = DB::table('voterId')->where('mobile',session()->get('mobile'))->select('*')->get();
                foreach ($seldata as $getdata) {
                 $voterstatus =$getdata->voterStatus;
                  $voterid = $getdata->voterId;
                }
                echo $voterid;
                 $vtrcnt1=DB::table('voteraadhar')->where('mobile',session()->get('mobile'))->select('*')->count();
                  $vtrcnt2=DB::table('drivinglicence')->where('mobile',session()->get('mobile'))->select('*')->count();

                if($vtrcnt1>0 || $vtrcnt2>0 )  
                {
                  if($vtrcnt1>0)
                  {
                     $vtrpnd1=DB::table('voteraadhar')->where('mobile',session()->get('mobile'))->where('AadharStatus','pending')->select('*')->count();
                     if($vtrpnd1 > 0)
                     {
                      echo "<h3>waiting for verification</h3>";
                     }
                     else
                     {
                      
                      echo "<h3>ballet open</h3>"; 
                      ?>
                      <table>
  <tr>
    <th>BalletId</th>
    <th>Party</th>
    <th>Vote</th>
    <th>Action</th>
  </tr>
  <?php
$sel = DB::table('ballet')->select('*')->get();
foreach ($sel as $bal) {
  ?>
  <tr>
    <td>{{$bal->balletid}}</td>
    <td>{{$bal->party}}</td>
    <td>{{$bal->vote}}</td>
    <td></td>
  </tr>
<?php
}
?>
</table>
                      <?php
                     }
                   }
                 }
                 else{

                 if(isset($_POST['submit']))
                 {
                  $voterid = $_POST['voterid'];
                   $selcnt = DB::table('voterId')->where('voterId',$voterid)->select('*')->count();
  
         if($selcnt > 0)
         {
                $seldata = DB::table('voterId')->where('voterId',$voterid)->select('*')->get();
                foreach ($seldata as $getdata) {
                 $voterstatus =$getdata->voterStatus;
                  $voterid = $getdata->voterId;
                }
                echo $voterid;
                if( $voterstatus != 'success')
                {
                  ?>
                   <form  method="post" >
                    <fieldset>
                        <?php
                         if(isset($msg))
                         {
                            echo "<h4 style='color:red'>check gender properly</h4>";
                         }
                         elseif(isset($msg2))
                         {
                            echo "<h4 style='color:red'>check course properly</h4>";
                         }
                        ?>
                        <legend class="heading">Govt.Proof</legend>
                       <select id="govtproof" name="gentype" onchange="myFunction()">
                        <option value="1">Govt.Proof</option>
                         <option value="Aadhar">Aadhar</option>
                         <option value="DrivingLicence">DrivingLicence</option>
                         </select>
                    </fieldset>
                </form>  

                 <form  method="post" id="form1" action="/aadhar" style="visibility:hidden" enctype="multipart/form-data">
                    <fieldset>
                        <?php
                         if(isset($msg))
                         {
                            echo "<h4 style='color:red'>check gender properly</h4>";
                         }
                         elseif(isset($msg2))
                         {
                            echo "<h4 style='color:red'>check course properly</h4>";
                         }
                        ?>
                        <legend class="heading">Aadhar</legend>
                       <input type="file" name="aadhar" required>
                        <input type="hidden" name="voterid" value={{$voterid}} required>
                       
                       {{csrf_field()}}
                       <input type="submit" value="submit" name="submit">
                    </fieldset>
                </form>  

                <form  method="post" id="form2" action="/driving" style="visibility:hidden" enctype="multipart/form-data">
                    <fieldset>
                        <?php
                         if(isset($msg))
                         {
                            echo "<h4 style='color:red'>check gender properly</h4>";
                         }
                         elseif(isset($msg2))
                         {
                            echo "<h4 style='color:red'>check course properly</h4>";
                         }
                        ?>
                        <legend class="heading">DrivingLicence</legend>
                       <input type="file" name="driving" required>
                        <input type="hidden" name="voterid" value={{$voterid}} required>
                       {{csrf_field()}}
                       <input type="submit" value="submit" name="submit">
                    </fieldset>
                </form>  


                  <?php
                }
                else
                {
                  echo "waiting for confirmation from Volunteer";
                }
              }
              else
              {
                echo '<script>alert("you entered wrong id");window.location.href="/loginvoter";</script>';
              }
            }
          }

                 ?>
                </center>  
            </div>
            <!--  -->
        </div>

    </body>
    </html>