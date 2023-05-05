<?php
include('adminsession.php');
 $page_title = 'Brand';

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

if(isset($_GET['brand_id'])){
  $keyvalue = $_GET['brand_id'];
}else{
  $keyvalue = 0;
}

if(isset($_POST['submit']))
{
  $brand_name = $_POST['brand_name'];
  $sub_cat_id = $_POST['sub_cat_id'];
    
  if($keyvalue==0)
  {
      mysqli_query($conn,"INSERT INTO brand SET brand_name='$brand_name',sub_cat_id='$sub_cat_id',createdate='$createdate',ipaddress='$ipaddress',loginid='$loginid'");
      $action =1;
  }else
  {
        mysqli_query($conn,"UPDATE brand SET brand_name='$brand_name',sub_cat_id='$sub_cat_id',createdate='$createdate',ipaddress='$ipaddress',loginid='$loginid' WHERE brand_id='$keyvalue'");
      $action = 2;
  }
  echo "<script>location='brand?action=$action';</script>";
}
if($_GET['dbrand_id']!=''){
   
    mysqli_query($conn,"DELETE  FROM brand WHERE brand_id='$_GET[dbrand_id]'");
    $action = 3;
    echo "<script>location='brand?action=$action';</script>";
  }
if($_GET['brand_id']!=''){
    $btn_name ='Update';
    $btn_color = 'success';
    $sql = mysqli_query($conn,"SELECT * FROM brand WHERE brand_id='$_GET[brand_id]'");
    $rowedit = mysqli_fetch_array($sql);
    $brand_name = $rowedit['brand_name'];
    $sub_cat_id = $rowedit['sub_cat_id'];

   
  }else{
    $brand_name = '';
    $sub_cat_id = '';

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
      <h1>Brand</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
          <li class="breadcrumb-item ">Brand</li>
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
                        Add Brand
                     </h5>
                     <form action="" method='POST' enctype="multipart/form-data">
                        <div class="row md-3">
                            <input type="hidden" name='brand_id' value="<?php echo $keyvalue;?>" >
                            <h4 class="card-title ml-2">Sub Category Name</h4>
                            <div class="col-sm-10">
                                <select name="sub_cat_id" id="sub_cat_id" class="form-control select2">
                                  <Option value="">Select Sub Category</Option>
                                  <?php 
                                  $sql = mysqli_query($conn,"SELECT * FROM sub_category order by sub_cat_id desc");
                                  while($row = mysqli_fetch_array($sql)){ ?>
                                  <option value="<?php echo $row['sub_cat_id'];?>"><?php echo $row['sub_cat_name']; ?></option>
                                  <?php } ?>
                                </select>
                                <script>document.getElementById('sub_cat_id').value = '<?php echo $sub_cat_id; ?>'; </script>
                            </div>
                            <h4 class="card-title ml-2">Brand Name</h4>
                            <div class="col-sm-10">
                                <input type="text" name="brand_name" Placeholder="Name" class="form-control" value="<?php echo $brand_name; ?>">
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
                        Show Brand
                     </h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                S.No.
                                </th>
                                <th scope="col">
                                    Sub Category Name
                                </th>
                                <th scope="col">
                                    Brand Name
                                </th>
                                <th scope="col">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn=1;
                                $sql = mysqli_query($conn,"SELECT * FROM brand left join sub_category on brand.sub_cat_id = sub_category.sub_cat_id order by brand_id desc");
                                while($row = mysqli_fetch_array($sql)){
                                ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo ucwords($row['sub_cat_name']);?></td>
                                    <td><?php echo ucwords($row['brand_name']);?></td>
                                    
                                    <td>
                                    <a  href="brand?brand_id=<?php echo $row['brand_id']; ?>"  class="btn btn-success editbtn">Edit</a>
                                    <a href="brand?dbrand_id=<?php echo $row['brand_id']; ?>"  class="btn btn-danger">Delete</a>
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
  <!-- ======= Footer ======= -->
 <?php
include('inc/footer.php');
 ?>