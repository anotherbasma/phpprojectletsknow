
<?php
$random='';
session_start();
$n=5;
function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

if (isset($_GET['confirm'])) {

$email=$_GET['email'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emailproject";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("SELECT * FROM users WHERE userEmail=:userEmail");
  $stmt->bindParam(':userEmail', $email);
  $stmt->execute();
  $result = $stmt->fetchAll();
  if ($result) {
      $random= getName($n);
        $stmt = $conn->prepare("UPDATE users SET lastCode=:gg WHERE userEmail=:useremail");
        $stmt->bindParam(':gg',$random);
        $stmt->bindParam(':useremail',$email);

        $stmt->execute();
        include("mailer.php");
        header('Location:forget_password.php');


  }
  else{
    echo"<p style='color:green;'>Email Not Found !</p>";
  }

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
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
                                <form method="get" >
                                    <div class="heading text-center mb-5">
                                        <h4 class="h4"> Email Address </h4>
                                        <img src="assets/images/logo.png" alt="" class="logo">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" autocomplete="off" autofocus required name="email" />
                                        <label class="floating-label"> Email Adress </label>
                                    </div>
                                    <button class="submit-btn" name="confirm">Confirm</button> 
                                    <?php
                                    // echo "<a class='submit-btn' name='confirm' href='forget_password.php?rand=".$random."' >confirm<a/>"

                                    ?>
                                 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="images/pattern-3.png" alt="" class="pattern">
            </section>
        </main>
        <!--end main-->
        <!--Scroll to top button-->
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
              $(window).scroll(function () {

                    $scrollpos = $(this).scrollTop();
                    if ($scrollpos >= 800) {
                        $('.scroll-top-btn').css({ 'opacity': '1' });

                    }
                    else {
                        $('.scroll-top-btn').css({ 'opacity': '0' });
                    }


                });

                $('.scroll-top-btn').click(function () {




                    $('html,body').animate({ scrollTop: '0' }, 1000);

                    return false;

                });
            
        </script>
    </body>
</html>