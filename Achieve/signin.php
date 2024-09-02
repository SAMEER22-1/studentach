<?php
require "function.php";
$msg = "";
$mail = "";
$pass = "";

getParams(); // Make sure this function is correctly retrieving email and password

session_start();
$_SESSION = array(); // Clear the session

if (!empty($mail) && !empty($pass)) {
    $res = signin($mail, $pass); 
    if ($res && $res->rowCount() > 0) {
        $row = $res->fetchAll();
        $fname = $row[0]["firstname"];
        $lname = $row[0]["lastname"];
        $userid = $row[0]["id"];
        $_SESSION["user"] = ["mail" => $mail, "fname" => $fname, "userid" => $userid, "lname" => $lname];
        header("Location: main.php", true, 303);
        exit(); // Make sure to exit after redirecting
    } else {
        $msg = "Email or password is incorrect";
    }
} else {
    $msg = "Please fill in both email and password";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signin.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>
<body>
    <div>
       <header>
           <!-- Your header content -->
       </header>
       <main>
          <div class="d-flex justify-content-center align-content-center flex-column" style="height: calc(100vh - 120px);">
             <div style="margin: auto;">
                <div style="box-shadow: 0px 2px 15px 3px rgba(0, 0, 0, 0.27); " class="d-flex justify-content-center align-content-center flex-column p-4">
                   <h2 class="pt-1 m-0"> Sign In </h2>
                   <p class="m-0  me-5"> Stay updated on your professional world </p>
                   <form method="post">
                      <input type="hidden" name="page" value="signin" />
                      <div class="d-flex flex-column">
                         <div id="input" class="my-3 px-2">
                            <input name="mail" type="text" class="py-3 h-100" style="border: 0; outline: none;" placeholder="Email or Phone">
                         </div>
                         <div id="input" class="px-2 mb-2">
                            <input name="pass" id="passbox" type="password" class="py-3 h-100" style="border: 0; outline: none;" placeholder="Password">
                            <p onclick="showpass()" id="showpass" class="border-0 px-2 user-select-none d-inline">show</p>
                         </div>

                         <?php echo '<p class="mb-0 ps-2 text-danger">' . $msg . '</p>'; ?>
                         <a class="px-3 pt-1 pb-2 w-50 buttonhover" href="#">Forgot password?</a>
                         <input class="py-3 text-light mt-2 mx-2" type="submit" value="Sign in" />
                      </div>
                   </form>
                </div>
                <div class="d-flex mt-4 w-100  mx-auto" style="font-size: 18px;">
                  <!-- Additional content -->
                </div>
             </div>
          </div>
       </main>
       <footer>
          <!-- Your footer content -->
       </footer>
    </div>

    <script>
       function showpass() {
          var x = document.getElementById("passbox");
          if (x.type === "password") {
             x.type = "text";
          } else {
             x.type = "password";
          }
       }
    </script>
</body>
</html>
