<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product</title>
    <link rel="stylesheet" type="text/css" href="product.css">
</head>
<body>
    <div>
        <table id="tintable">
           <tr>
              <th>Code</th>
              <th>Name</th>
          </tr>
          <?php
          require_once('data_access_helper.php');

    //Create an instance of data access helper
        $db = new DataAccessHelper();

    //Connect to database
        $db->connect();

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 12;
        $start = ($current_page - 1) * $limit;
        
    //query list products
        $result = $db->executeQuery("SELECT * FROM products LIMIT $start,$limit");

        

    //Display result out
          if ($result->num_rows > 0) {
      // output data of each row

           while($row = $result->fetch_assoc()) {
              echo "<tr><td>"  .$row["productCode"] ."</td><td>" .$row["productName"]. "</td></tr>";
          }

            } else {
            echo "0 results";
                     }
        //Close connection
        $db->close();
        ?>
        </table>
        <div >
        <?php
        require_once('data_access_helper.php');

        //Create an instance of data access helper
        $db = new DataAccessHelper();

        //Connect to database
        $db->connect();
        //find total records
        $resulttotal = $db->executeQuery("SELECT count(productCode) AS total FROM products");
        $row = mysqli_fetch_assoc($resulttotal);
        $totalrecords = $row['total'];

        //find limit and current page
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 12;

        //find total page and start
        $total_page = ceil($totalrecords / $limit);
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }

        $start = ($current_page - 1) * $limit;



        //display page split
        if ($current_page > 1 && $total_page > 1){
            echo '<a href="product.php?page='.($current_page-1).'">Prev</a> | ';
        }
        for ($i = 1; $i <= $total_page; $i++){
            // Nếu là trang hiện tại thì hiển thị thẻ span
            // ngược lại hiển thị thẻ a
            if ($i == $current_page){
                echo '<span>'.$i.'</span> | ';
            }
            else{
                echo '<a href="product.php?page='.$i.'">'.$i.'</a> | ';
            }
        }
        if ($current_page < $total_page && $total_page > 1){
            echo '<a href="prduct.php?page='.($current_page+1).'">Next</a> | ';
        }

        //Close connection
        $db->close();
        ?>
        </div>
    </div>
</body>
</html>

