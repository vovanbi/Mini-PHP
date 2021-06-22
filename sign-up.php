<?php 
require_once './db/connection.php';

$name = $email = $password = $address = "";
$error = [];

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $error['name'] = "Trường này không được để trống.";
    }
    else{
        $name = $input_name;
    }
    
    $input_email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email = '".$input_email."' LIMIT 1";
    $row = mysqli_query($conn,$sql);
    if(empty($input_email))
    {
    	$error["email"] = "Vui lòng nhập Email !";
    }
    elseif(!filter_var($input_email,FILTER_VALIDATE_EMAIL))
	{
       $error["email"] = "Email không thích hơp !";
	}
    else
    {
        $email = $input_email;
    }
	
	if($_POST["password"]=="")
	{
		$error["password"] ="Vui lòng nhập mật khẩu !";
	}elseif ($_POST['password'] != $_POST['confirmpassword']) {
        $error["password"]="Xác nhận mật khẩu không đúng!";
    }
    else
	{
		$password = md5($_POST["password"]);
	}
    $input_address = $_POST['address'];
	if($input_address=="")
	{
		$error["address"]="Vui lòng nhập địa chỉ !";
	}else{
        $address = $input_address;
    }

	if(empty($error))
	{
		$sql = "INSERT INTO users (name,email,password,address) VALUES ('$name','$email','$password','$address')";
		if($conn->query($sql)==TRUE)
		{
		   echo "<script>alert('Đăng ký thành công'); location.href='sign-in.php';</script>";
		}
		else
		{
		   echo "<script>alert('Đăng ký thất bại'); </script>";
	   
		}
        $conn->close();
	}

}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Đăng ký</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="./public/css/styles.css">
  </head>
  <body>
    <header>
      <h1>Đăng ký</h1>
    </header>
    <div class="container pt-60">
      <div class="row">
        <form class="col s12" action="" method="POST">
          <div class="row">
            <div class="input-field col s6">
              <input  id ="first_name"type="text" class="validate  <?php echo (!empty($error['name'])) ? 'is-invalid' : ''; ?>" name="name" value="<?php echo $name ?>">
              <label for="first_name">Tên</label>
               <?php if(isset($error['name'])): ?>
                 <p class="text-danger"><?php echo $error['name'] ?></p>
               <?php endif ?>
            </div>
            <div class="input-field col s6">
              <input id="last_name" type="text" class="validate  <?php echo (!empty($error['address'])) ? 'is-invalid' : ''; ?>" name="address" value="<?php echo $address ?>">
              <label for="last_name">Địa chỉ</label>
              <?php if(isset($error['address'])): ?>
                 <p class="text-danger"><?php echo $error['address'] ?></p>
               <?php endif ?>
            </div>
          </div>
            <div class="row">
            <div class="input-field col s12">
              <input id="email" type="email" class="validate  <?php echo (!empty($error['email'])) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo $email?>">
              <label for="email">Email</label>
              <?php if(isset($error['email'])): ?>
                 <p class="text-danger"><?php echo $error['email'] ?></p>
               <?php endif ?>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="pass" type="password" name="password" class="validate  <?php echo (!empty($error['password'])) ? 'is-invalid' : ''; ?>" value="<?php $password ?>">
              <label for="pass">Mật khẩu</label>
              <?php if(isset($error['password'])): ?>
                 <p class="text-danger"><?php echo $error['password'] ?></p>
               <?php endif ?>
            </div>
            <div class="input-field col s6">
              <input id="c_pass" type="password" name="confirmpassword" class="validate">
              <label for="c_pass">Nhập lại mật khẩu</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12 mt-25"> 
              <button class="btn waves-effect waves-light pulse" type="submit">Đăng ký
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
