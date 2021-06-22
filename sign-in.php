<?php 
require_once './db/connection.php';

$errer=[];
$email = $password ="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
        if(!empty($_POST["remember"])) {
        setcookie ("email",$_POST["email"],time()+ 3600);
        setcookie ("password",$_POST["password"],time()+ 3600);
        } 
        else {
        setcookie("email","");
        setcookie("password","");
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".md5($password)."' LIMIT 1";
        $result =$conn->query($sql);
        $is_check = mysqli_fetch_array($result);
        if($is_check !=NULL)
        {
            $_SESSION['name_user']=$is_check['name'];
            $_SESSION['name_id']=$is_check['id'];
            echo "<script>alert(' Đăng nhập thành công'); location.href='index.php';</script>";

        }else{
           echo "<script>alert('Email hoặc mật khẩu bạn nhập không chính xác !');</script>";
        }   
        
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <script src="./public/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Đăng nhập</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap py-5">
                <h3 class="text-center mb-0">Welcome</h3>
                <p class="text-center">Đăng nhập bằng cách nhập thông tin bên dưới</p>
                        <form action="" class="login-form" method="POST">
                    <div class="form-group">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
                        <input type="text" class="form-control" name ="email"placeholder="Email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" required>
                        
                    </div>
                <div class="form-group">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
                  <input type="password" class="form-control" name="password" placeholder="Password"  value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"required>
                
                </div>
                <p><input type="checkbox" name="remember" /> Remember me</p>
                <div class="form-group">
                    <button type="submit" class="btn form-control btn-primary rounded submit px-3">Đăng nhập</button>
                </div>
              </form>
              <div class="w-100 text-center mt-4 text">
                <p class="mb-0">Bạn chưa có tài khoản?</p>
                  <a href="sign-up.php">Đăng ký </a>
              </div>
            </div>
                </div>
            </div>
        </div>
    </section>

</div>
</body>
</html>