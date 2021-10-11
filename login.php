<?php




if(isset($_POST['signIn']))
{

  
  $signemail=$_POST['signEmail'];
  $signpassword=$_POST['signPassword'];
  $signpassword=md5($signpassword);

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "emailproject";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 

 $stmt = $conn->prepare("SELECT * FROM users WHERE userEmail=:userEmail");
 $stmt->bindParam(':userEmail',$signemail);
  $stmt->execute();
  $result = $stmt->fetchAll();
    if ($result) {
        foreach ($result as $user) {
            if ($user['userPawword']==md5($_POST['signPassword'])) {
               echo"Done!";
            }
            else {
                echo"Password Is Wrong Plz Try Again Ya 2l3";
            }
        }
    }
    else{
        echo"Email Not Found";
    }



  

  
} catch(PDOException $e) {
  echo  $e->getMessage();
}

$conn = null;
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, 
            shrink-to-fit=no">
    <meta name="author" content="Moataz Elsaied">
    <link rel="stylesheet" href="css/lib/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@6.3.2/swiper-bundle.min.css">
    <!--the intilize of bootstrap ar version lib-->
    <link rel="stylesheet" href="css/lib/bootstrap.css">
    <!--the intilize of owl carousel lib-->
    <link rel="stylesheet" href="css/lib/owl.carousel.min.css">
    <!--the intilize of dots that appear with owl carousel -->
    <link rel="stylesheet" href="css/lib/owl.theme.default.css">
    <link rel="stylesheet" href="css/lib/flipdown.css">
    <!-- css file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/media.css">
    <title>PHP ECOMMERCE</title>
</head>

<body>
    <!--start main-->
    <main>
        <!--Start register-pg -->
        <section class="register-pg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 m-auto">
                        <div class="form-wrapper">
                            <form action="index.php" method="post">
                                <div class="heading text-center mb-5">
                                    <h4 class="h4">Sign in</h4>
                                    <p class="another-register"> Have Not Account ? <a href="register.php">Sign up</a>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" autocomplete="off" autofocus required name="signEmail" />
                                    <label class="floating-label"> Email Address </label>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" autocomplete="off" autofocus
                                        required name="signPassword" />
                                    <label class="floating-label"> Password </label>
                                    <span class="togglePassword"><i class="fas fa-eye" id="togglePassword"></i></span>
                                </div>
                                <div class="text w-100">
                                    <a class="forget-pass" href="recover_mail.php"> Fogrt Password ?</a>
                                </div>
                                 <button class="submit-btn" name="signIn"> Log in </button>
                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <img src="images/pattern-3.png" alt="" class="pattern">
        </section>
    </main>
    <!--end main-->
    <!--loading page-->
    <div class="loader">
        <div class="container">
            <div class="loading-content">
                <div class="drop-water light-blue"></div>
                <div class="drop-water light-blue"></div>
                <div class="box">
                    <div class="wave light-blue">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/lib/jquery-3.6.0.min.js"></script>
    <script src="js/lib/popper.js"></script>
    <script src="js/lib/bootstrap.js"></script>
    <script src="js/lib/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/swiper@6.3.2/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.0/gsap.min.js"></script>
    <script src="js/lib/flipdown.js"></script>
    <script src="js/main.js"></script>

    <script>
        //show password
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>