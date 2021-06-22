<?php  
 require_once './db/connection.php';

 if(isset($_POST["id"]))  
 {  
      $query = "SELECT * FROM products WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($conn, $query);  
       
      while($row = mysqli_fetch_array($result))  
      {  
           $output = '  
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên SP</th>
                    <th scope="col">Sốlượng</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Miêu tả</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">'.$row['id'].'</th>
                    <td>'.$row["pro_name"].'</td>
                    <td>'.$row["pro_number"].'</td>
                    <td>'.$row["pro_price"].'</td>
                    <td>'.$row["pro_desc"].'</td>

                  </tr>
                </tbody>
              </table>
           ';  
      }  
      echo $output;  
 }  
 ?>