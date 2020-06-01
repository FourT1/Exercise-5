 <?php
    include "top.php";
    include "left.php";
 ?>
 <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Area Chart Example</div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Bar Chart Example</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">  
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
                                        echo '<a href="index.php?page='.($current_page-1).'">Prev</a> | ';
                                    }
                                    for ($i = 1; $i <= $total_page; $i++){
                                        // Nếu là trang hiện tại thì hiển thị thẻ span
                                        // ngược lại hiển thị thẻ a
                                        if ($i == $current_page){
                                            echo '<span>'.$i.'</span> | ';
                                        }
                                        else{
                                            echo '<a href="index.php?page='.$i.'">'.$i.'</a> | ';
                                        }
                                    }
                                    if ($current_page < $total_page && $total_page > 1){
                                        echo '<a href="index.php?page='.($current_page+1).'">Next</a> | ';
                                    }

                                    //Close connection
                                    $db->close();
                                    ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
<?php
include "bottom.php";
?>
