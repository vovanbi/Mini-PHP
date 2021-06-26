asdaasd
<?php
require_once "./db/connection.php";
 if(!isset($_SESSION['name_id'])){
       header("location:sign-in.php");
    }
$name = $desc = $number = $sale = $price= "";
$error = []; // array error empty
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $error['name'] = "Trường này không được để trống.";
    }
    else{
        $name = $input_name;
    }

    $input_desc = trim($_POST["desc"]);
    if(empty($input_desc)){
        $error['desc'] = "Trường này không được để trống.";     
    } else{
        $desc = $input_desc;
    }
    
    $input_number = $_POST["number"];
    if($input_number==""){
        $error['number'] = "Trường này không được để trống.";     
    }else{
        $number = $input_number;
    }
    $input_price = $_POST["price"];
    if($input_price==""){
        $error['price'] = "Trường này không được để trống.";     
    } else{
        $price = $input_price;
    }
    $input_sale = $_POST["sale"];
     if($input_sale==""){
        $error['sale'] = "Trường này không được để trống.";     
    } else{
        $sale = $input_sale;
    }
    
    if(empty($error)){
        $sql = "INSERT INTO products (pro_name, pro_desc,pro_number,pro_sale,pro_price) VALUES ('$name','$desc','$number','$sale','$price')";
       
          if ($conn->query($sql) === TRUE) {
			    header("location: index.php");
		  } else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
    }    
   
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP- Bassic</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Tạo sản phẩm </h2>
                  <!--   <p>Please fill this form and submit to add employee record to the database.</p> -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($error['name'])) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $error['name'];?></span>
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($error['price'])) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $error['price'];?></span>
                        </div>
                         <div class="form-group">
                            <label>Giá giảm</label>
                            <input type="number" name="sale" class="form-control <?php echo (!empty($error['sale'])) ? 'is-invalid' : ''; ?>" value="<?php echo $sale; ?>">
                            <span class="invalid-feedback"><?php echo $error['sale'];?></span>
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="number" name="number" class="form-control <?php echo (!empty($error['number'])) ? 'is-invalid' : ''; ?>" value="<?php echo $number; ?>">
                            <span class="invalid-feedback"><?php echo $error['number'];?></span>
                        </div>
                        <div class="form-group">
                            <label>Miêu tả sản phẩm</label>
                            <textarea name="desc" class="form-control <?php echo (!empty($error['desc'])) ? 'is-invalid' : ''; ?>"><?php echo $desc; ?></textarea>
                            <span class="invalid-feedback"><?php echo $desc;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Thêm">
                        <a href="index.php" class="btn btn-secondary ml-2">Không</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>