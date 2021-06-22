<?php 
	require_once './db/connection.php'; 
	 if(!isset($_SESSION['name_id'])){
       header("location:sign-in.php");
    }
	$sql = 'SELECT * FROM products ORDER BY ID DESC LIMIT 5 ';
    $products = mysqli_query($conn, $sql);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP - Bassic </title>
	<link rel="stylesheet" href="./public/css/bootstrap.min.css">
	<script src="./public/js/bootstrap.js"></script>
	<script src="./public/js/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

     <div class="container-fluid">
     	<div class="row">
     		<div class="col-md-6 offset-md-3">
     		<h1 style="justify-content: center; align-items: center; display: flex;">Quản lý sản phẩm</h1>
            <div class="col-auto" style="float: right; padding: 10px 0px;"><a href="create.php"><button type="button" class="btn btn-primary">Thêm</button></a></div>
     		</div>
     	</div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<table class="table">
				  <thead>
				    <tr>
				      <th>#</th>
				      <th>Tên sản phẩm</th>
				      <th>Số lượng</th>
				      <th>Giá</th>
				      <th>Giá sale</th>
				      <th>Xử lý</th>
				    </tr>
				  </thead>
				  <tbody>
				    <?php $i=1;  while($pro = mysqli_fetch_array($products)): ?>
				     <tr>
				      <th scope="row"><?php echo $i; ?></th>
				      <td><?php echo $pro['pro_name']; ?></td>
				      <td><?php echo $pro['pro_number'];?></td>
				      <td><?php echo $pro['pro_price'];?></td>
				      <td><?php echo $pro['pro_sale']; ?></td>
				      <td>
				      	<span> 
				      	<a href="" name="view" data-toggle="modal" data-target="#dataModal"  data-id="<?php echo $pro['id'] ?>" class="view_data" title="view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="update.php?id=<?php echo $pro['id'] ?>" title="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				      	<a href="delete.php?id=<?php echo $pro['id'] ?>" onclick="return confirm('Bạn muốn xóa sản phẩm này?') " title="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
				      </span>
				      </td>
			  
				      </tr>
				    <?php $i++; endwhile;?>
				   
				  </tbody>
				</table>
			</div>
		</div>
		<div class="row">
		  <div class="col-md-6 offset-md-3" style="display: flex;">
     		 <div class="col-sm-5 col-md-6" style="margin-top: 5px; font-size: 25px">Quản lý : <?php echo isset($_SESSION['name_user']) ? $_SESSION['name_user'] : ''?></div>
            <div class="col-sm-5 col-md-6"><a href="logout.php"  style="float: right;"><button type="button"class="btn btn-primary">Đăng Xuất</button></a></div>
     		</div>
		</div>		
	</div>
	 <div id="dataModal" class="modal fade" >  
	      <div class="modal-dialog">  
	           <div class="modal-content">  
	                <div class="modal-header">  
	                	 <h4 class="modal-title">Chi tiết sản phẩm</h4> 
	                     <button type="button" class="close" data-dismiss="modal">&times;</button>   
	                </div>  
	                <div class="modal-body" id="product_detail">  
	                </div>  
	                <div class="modal-footer">  
	                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
	                </div>  
	           </div>  
	      </div>  
	 </div> 
 </div>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
 $(document).ready(function(){  
  $(document).on('click', '.view_data', function(){  
  	   var id=$(this).data('id');
       if(id != '')  
       {  
            $.ajax({  
                 url:"select.php",  
                 method:"POST",  
                 data:{id:id},  
                 success:function(data){  
                      $('#product_detail').html(data);  
                      $('#dataModal').modal('show');  
                 }  
            });  
       }            
  });  
 });  
 </script>