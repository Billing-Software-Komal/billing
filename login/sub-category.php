<?php
include('adminsession.php');
 $page_title = 'sub_category';

include('inc/head.php');

$btn_name = 'Submit';
$btn_color = 'primary';
if($_GET['action']==1){
$msg = "Data Has been Inserted Successfully";
}

if($_GET['action']==2){
$msg = "Data Has been Updated Successfully";
}

if($_GET['action']==3){
$msg = "Data Has been Deleted Successfully";
}

if(isset($_GET['sub_cat_id'])){
  $keyvalue = $_GET['sub_cat_id'];
}else{
  $keyvalue = 0;
}

if(isset($_POST['submit']))
{
  $sub_cat_name = $_POST['sub_cat_name'];
  $cat_id = $_POST['cat_id'];
    
  if($keyvalue==0)
  {
      mysqli_query($conn,"INSERT INTO sub_category SET sub_cat_name='$sub_cat_name',cat_id='$cat_id',createdate='$createdate',ipaddress='$ipaddress',loginid='$loginid'");
      $action =1;
  }else
  {
        mysqli_query($conn,"UPDATE sub_category SET sub_cat_name='$sub_cat_name',cat_id='$cat_id',createdate='$createdate',ipaddress='$ipaddress',loginid='$loginid' WHERE sub_cat_id='$keyvalue'");
      $action = 2;
  }
  echo "<script>location='sub-category?action=$action';</script>";
}
if($_GET['dsub_cat_id']!=''){
   
    mysqli_query($conn,"DELETE  FROM sub_category WHERE sub_cat_id='$_GET[dsub_cat_id]'");
    $action = 3;
    echo "<script>location='sub-category?action=$action';</script>";
  }
if($_GET['sub_cat_id']!=''){
    $btn_name ='Update';
    $btn_color = 'success';
    $sql = mysqli_query($conn,"SELECT * FROM sub_category WHERE sub_cat_id='$_GET[sub_cat_id]'");
    $rowedit = mysqli_fetch_array($sql);
    $sub_cat_name = $rowedit['sub_cat_name'];
    $cat_id = $rowedit['cat_id'];

   
  }else{
    $sub_cat_name = '';
    $cat_id = '';

  }
?>

<body>

  <!-- ======= Header ======= -->
 <?php 
include('inc/header.php');
 ?>

  <!-- ======= Sidebar ======= -->
 <?php 
include('inc/menu.php');
 ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Sub-Categoty</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
          <li class="breadcrumb-item ">Sub-Categoty</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <center> <span style="color:red;"><?php echo $msg; ?></span></center>
      <br>
      <!-- End Page Title -->
      <section class="section dashboard">
         <div class="row">
            <div class="col-lg-6">
               <div class="card">
                  <div class="card-body">
                     <h5 class="class card-title">
                        Add Sub Category
                     </h5>
                     <form action="" method='POST' enctype="multipart/form-data">
                        <div class="row md-3">
                            <input type="hidden" name='sub_cat_id' value="<?php echo $keyvalue;?>" >
                            <h4 class="card-title ml-2">Category Name</h4>
                            <div class="col-sm-10">
                                <select name="cat_id" id="cat_id" class="form-control select2">
                                  <Option value="">Select Category</Option>
                                  <?php 
                                  $sql = mysqli_query($conn,"SELECT * FROM category order by cat_id desc");
                                  while($row = mysqli_fetch_array($sql)){ ?>
                                  <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name']; ?></option>
                                  <?php } ?>
                                </select>
                                <script>document.getElementById('cat_id').value = '<?php echo $cat_id; ?>'; </script>
                            </div>
                            <h4 class="card-title ml-2">Sub Category Name</h4>
                            <div class="col-sm-10">
                                <input type="text" name="sub_cat_name" Placeholder="Name" class="form-control" value="<?php echo $sub_cat_name; ?>">
                            </div>
                           
                        </div>
                       <br>
                        <button type="submit" name="submit" class="btn btn-<?php echo $btn_color; ?>"><?php echo $btn_name; ?></button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="card">
                  <div class="card-body">
                     <h5 class="class card-title">
                        Show Sub Category
                     </h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                S.No.
                                </th>
                                <th scope="col">
                                    Category Name
                                </th>
                                <th scope="col">
                                    Sub Category Name
                                </th>
                                <th scope="col">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn=1;
                                $sql = mysqli_query($conn,"SELECT * FROM sub_category left join category on sub_category.cat_id = category.cat_id order by sub_cat_id desc");
                                while($row = mysqli_fetch_array($sql)){
                                ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo ucwords($row['cat_name']);?></td>
                                    <td><?php echo ucwords($row['sub_cat_name']);?></td>
                                    
                                    <td>
                                    <a  href="sub-category?sub_cat_id=<?php echo $row['sub_cat_id']; ?>"  class="btn btn-success editbtn">Edit</a>
                                    <a href="sub-category?dsub_cat_id=<?php echo $row['sub_cat_id']; ?>"  class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                    </table>
                  </div>
               </div>
            </div>
         </div>
      </section>
  </main><!-- End #main -->
  <script>
    $(document).ready(function(){
        $('#cat_id').chosen();
    });
</script>
  <!-- ======= Footer ======= -->
 <?php
include('inc/footer.php');
 ?>