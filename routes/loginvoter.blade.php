   
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
                <form  method="post" action="/otpsucces">
                    <fieldset>
                        <?php
                        echo 
                        "otp sent to  ". session()->get('mobile');
                         if(isset($msg))
                         {
                            echo "<h4 style='color:red'>check gender properly</h4>";
                         }
                         elseif(isset($msg2))
                         {
                            echo "<h4 style='color:red'>check course properly</h4>";
                         }
                        ?>
                        <legend class="heading">Voter Login</legend>
                        <input type="text" name="voterid" placeholder="Enter VoterId" autocomplete="off">
                     {{csrf_field()}}
                        <input type="submit" name="submit" value="Verify">
                    </fieldset>
                </form>  
                </center>  
            </div>
            <!--  -->
        </div>

    </body>
    </html>