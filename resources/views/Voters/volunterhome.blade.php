   
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
            <h3>Welcome Volunteer</h3>
        </div>
         <div class="title">
      </div>
        <div class="main">
            <div class="login">
                <center>
              <table>
  <tr>
    <th>Mobile</th>
    <th>VoterId</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php
$sel = DB::table('voterid')->select('*')->get();
foreach ($sel as $bal) {
  ?>
  <tr>
    <td>{{$bal->mobile}}</td>
    <td>{{$bal->voterId}}</td>
    <td>{{$bal->voterStatus}}</td>
    <td></td>
  </tr>
<?php
}
?>
                </center>  
            </div>
            <!--  -->
        </div>

    </body>
    </html>