<?php 
require_once("connection.php");
if (isset($_GET['page_no'])) {
    $pageno = $_GET['page_no'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page; 

$total_pages_sql = "SELECT COUNT(*) as count FROM customers";
$result = fetch_all($total_pages_sql);
foreach($result as $row){
    $total_rows = $row['count'];
}
// $total_rows = $result[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
$datas = fetch_all("SELECT * FROM customers ORDER BY id DESC LIMIT $offset, $no_of_records_per_page ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Web Application with Pagination</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        table{
            width:100%;
           
        }

    
    </style>
</head>
<body>

    <div class="container">
        <h1>CSV Web Application with Pagination</h1>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
            Upload a file
        </button>
        <!-- <div class="clearfix"></div> -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload a CSV File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="process.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                                <input type="file" class="form-control" name="csv" id="">
                                
                            
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button> -->
                            <input type="submit" class="btn btn-primary" name="upload" value="Upload">
                        </div>
                    </form>
                </div>
            </div>
        </div>
          
    </div>

    <div class="container-fluid">
      
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="?page_no=1">First</a></li>
                <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?page_no=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?page_no=".($pageno + 1); } ?>">Next</a>
                </li>
                <li class="page-item"><a class="page-link" href="?page_no=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
        </nav>
       
        <table class="table table-striped table-responsive">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Address</th>
                <th>Country</th>
                <th>State</th>
                <th>Zip</th>
                <th>Phone1</th>
                <th>Phone2</th>
                <th>Email</th>
                <th>Web</th>
            </tr>
            <?php foreach($datas as $data):?>
            <tr>
                <td><?= $data["id"]?></td>
                <td><?= $data["first_name"]?></td>
                <td><?= $data["last_name"]?></td>
                <td><?= $data["company"]?></td>
                <td><?= $data["address"]?></td>
                <td><?= $data["country"]?></td>
                <td><?= $data["state"]?></td>
                <td><?= $data["zip"]?></td>
                <td><?= $data["phone1"]?></td>
                <td><?= $data["phone2"]?></td>
                <td><?= $data["email"]?></td>
                <td><?= $data["web"]?></td>
            </tr>
            <?php endforeach;?>
        </table>


    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>