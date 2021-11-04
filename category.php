<?php
include('include/header.php');
include('include/leftbar.php');
?>



  <div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

<?php
if (isset($_GET['edit'])) { 
  $select_id = $_GET['edit'];
  $edit_cat = "SELECT * FROM categories WHERE id = $select_id";
  $add_sql = mysqli_query($db, $edit_cat);
  while($row = mysqli_fetch_assoc($add_sql)){
    $cat_id           = $row['id'];
    $cat_name         = $row['cat_name'];
    $cat_des          = $row['cat_des'];
    $parent_id        = $row['parent_id'];
    $status           = $row['status'];
  };

  
  ?>
  <div class="col-md-6">
            <div class="card card-warning">
              <div class="card-header edit-card-header">
                <h3 class="card-title">Edit <?php echo $cat_name?> Categories</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <form action="category.php" method="POST">
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" value="<?php echo $cat_name?>" name="cat_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea id="inputDescription" name="cat_des" class="form-control" rows="4"><?php echo $cat_des?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="parent">Add Parent Category</label>
                    <select id="parent" name="parent_id" class="form-control custom-select">
                      <option selected="" value="0">Select Parent Category</option>

                      <!-- php code for show parent category -->
                      <?php
                          $select_cat = "SELECT * FROM categories";
                          $qurey = mysqli_query($db, $select_cat);

                          while($row = mysqli_fetch_assoc($qurey)){
                            $parent_id    = $row['id'];
                            $parent_name  = $row['cat_name'];
                            ?>
                          <option value="<?php echo $parent_id ?>"><?php echo $parent_name?></option>

                      <?php 
                      }
                      ?>
                      <!-- php code for show parent category -->

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select id="inputStatus" name="status" class="form-control custom-select">
                      <option selected="" value="0">Select one</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="update" class="btn btn-primary" value="Submit">
                  </div>
                </form>
              </div>

              <!-- PHP code for update form category start -->
              <?php
               if(isset($_POST['update'])){
    
                $cat_name       = $_POST['cat_name'];
                $cat_des        = $_POST['cat_des'];
                $parent_id      = $_POST['parent_id'];
                $status         = $_POST['status'];
            
                
                // $update_cat = "UPDATE `categories` SET `cat_name`= '$cat_name', `cat_des`= '$cat_des',`parent_id`= '$parent_id',`status`= '$status' WHERE `id` = '$cat_id'";
            
                
                $update_cat = "UPDATE `categories` SET 
                              `cat_name`        = '$cat_name', 
                              `cat_des`         = '$cat_des',
                              `parent_id`       = '$parent_id', 
                              `status`          = '$status' 
                              WHERE 
                              `categories`.`id`  = '$cat_id'";
            
                $update_cat_sql = mysqli_query($db, $update_cat);
            
                if($update_cat_sql){
                  echo "<span class='alert alert-success'>Category Updatede</span>";
                // header('Location: category.php');
                }else{
                  echo "<span class='alert alert-danger'>Someting wrong</span>";
                }
              };
              ?>
                <!-- PHP code for update form category end -->

          
           
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
<?php }else{ ?>
  <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Categories</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <form action="category.php" method="POST">
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" name="cat_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea id="inputDescription" name="cat_des" class="form-control" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="parent">Add Parent Category</label>
                    <select id="parent" name="parent_id" class="form-control custom-select">
                      <option selected="" value="0">Select Parent Category</option>

                      <!-- php code for show parent category -->
                      <?php
                          $select_cat = "SELECT * FROM categories";
                          $qurey = mysqli_query($db, $select_cat);

                          while($row = mysqli_fetch_assoc($qurey)){
                            $parent_id    = $row['id'];
                            $parent_name  = $row['cat_name'];
                            ?>
                          <option value="<?php echo $parent_id ?>"><?php echo $parent_name?></option>

                      <?php 
                      }
                      ?>
                      <!-- php code for show parent category -->

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select id="inputStatus" name="status" class="form-control custom-select">
                      <option selected="" value="0">Select one</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="add_cat" class="btn btn-primary" value="Submit">
                  </div>
                </form>
              </div>

              <!-- PHP code for submit form category start -->
              <?php
                if(isset($_POST['add_cat'])){
                    $cat_name       = $_POST['cat_name'];
                    $cat_des        = $_POST['cat_des'];
                    $parent_id      = $_POST['parent_id'];
                    $status         = $_POST['status'];

                    $add_cat = "INSERT INTO categories(cat_name, cat_des, parent_id, status) VALUES ('$cat_name','$cat_des','$parent_id','$status')";

                    $add_cat_sql = mysqli_query($db, $add_cat);

                    if($add_cat_sql){
                      echo "<span class='alert alert-success'>Category Added</span>";
                    }else{
                      echo "<span class='alert alert-danger'>Someting wrong</span>";
                    }
                  };
              ?>
                <!-- PHP code for submit form category end -->
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
<?php }

?>


          
          <div class="col-md-6">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">All Categories</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Satus</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- PHP code for show all category start -->
          <?php
            $all_cat_data = "SELECT * FROM categories WHERE parent_id = 0 ORDER BY id DESC";
            $qurey = mysqli_query($db, $all_cat_data);
            $i = 0;
            while($row = mysqli_fetch_assoc($qurey)){
              $cat_id           = $row['id'];
              $cat_name         = $row['cat_name'];
              $cat_des          = $row['cat_des'];
              $parent_id        = $row['parent_id'];
              $status           = $row['status'];
              $i++;
              ?>
                  <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $cat_name ?></td>
                    <td><?php echo $cat_des ?></td>
                    <td><?php 
                      if ($status == 1) {
                        echo "<span class='badge badge-success'>Active</span>";
                      }else{
                        echo "<span class='badge badge-danger'>Inactive</span>";
                      }
                    ?></td>
                    <td>
                      <a href="category.php?edit=<?php echo $cat_id ?>" class="fa fa-edit"></a>
                      <a href="#cat_id<?php echo $cat_id?>" data-toggle="modal" data-target="#cat_id<?php echo $cat_id?>" class="fa fa-trash"></a>
                    </td>
                  </tr>
                      
                  <!-- Modal -->
                  <div class="modal fade" id="cat_id<?php echo $cat_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h2>Are you sure to delete <?php echo $cat_name ?> category?</h2>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <a href="category.php?delete=<?php echo $cat_id ?>" class="btn btn-danger" >Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
              
              
            <?php 
              $sub_cat = "SELECT * FROM categories WHERE parent_id = '$cat_id' ORDER BY id DESC";
              $qurey = mysqli_query($db, $sub_cat);
             
              while($row = mysqli_fetch_assoc($qurey)){
                $cat_id           = $row['id'];
                $cat_name         = $row['cat_name'];
                $cat_des          = $row['cat_des'];
                $parent_id        = $row['parent_id'];
                $status           = $row['status'];
                
              ?>
                  <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td>--> <?php echo $cat_name ?></td>
                    <td><?php echo $cat_des ?></td>
                    <td><?php 
                      if ($status == 1) {
                        echo "<span class='badge badge-success'>Active</span>";
                      }else{
                        echo "<span class='badge badge-danger'>Inactive</span>";
                      }
                    ?></td>
                    <td>
                      <a href="category.php?edit=<?php echo $cat_id ?>" class="fa fa-edit"></a>
                      <a href="#cat_id<?php echo $cat_id?>" data-toggle="modal" data-target="#cat_id<?php echo $cat_id?>" class="fa fa-trash"></a>
                    </td>
                  </tr>
                 
                  <!-- Modal -->
                  <div class="modal fade" id="cat_id<?php echo $cat_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h2>Are you sure to delete <?php echo $cat_name ?> category?</h2>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <a href="category.php?delete=<?php echo $cat_id ?>" class="btn btn-danger" >Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>

              <?php
              }
            }
              ?>      


      


          <!-- PHP code for show all category end -->


          <!-- PHP code for delete category start -->

          <?php 
              
          if(isset($_GET['delete'])){
            $del_id = $_GET['delete'];

            $delete_qurey = "DELETE FROM categories WHERE id = '$del_id'";
            $sql = mysqli_query($db, $delete_qurey);

            if ($sql) {
              header('Location: category.php');
            }else{
              echo "error" . mysqli_error($db);
            }
          }    
          ?>

          <!-- PHP code for delete category end -->
                </tbody>
              </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  
  <?php
  include('include/footer.php');
  ?>