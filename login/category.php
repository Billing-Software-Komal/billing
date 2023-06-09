<?php
include('adminsession.php');
 $page_title = 'Category';

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

if(isset($_GET['cat_id'])){
  $keyvalue = $_GET['cat_id'];
}else{
  $keyvalue = 0;
}

if(isset($_POST['submit']))
{
  $cat_name = $_POST['cat_name'];
    
  if($keyvalue==0)
  {
      mysqli_query($conn,"INSERT INTO category SET cat_name='$cat_name',createdate='$createdate',ipaddress='$ipaddress',loginid='$loginid'");
      $action =1;
  }else
  {
        mysqli_query($conn,"UPDATE category SET cat_name='$cat_name',createdate='$createdate',ipaddress='$ipaddress',loginid='$loginid' WHERE cat_id='$keyvalue'");
      $action = 2;
  }
  echo "<script>location='category?action=$action';</script>";
}
if($_GET['dcat_id']!=''){
   
    mysqli_query($conn,"DELETE  FROM category WHERE cat_id='$_GET[dcat_id]'");
    $action = 3;
    echo "<script>location='category?action=$action';</script>";
  }
if($_GET['cat_id']!=''){
    $btn_name ='Update';
    $btn_color = 'success';
    $sql = mysqli_query($conn,"SELECT * FROM category WHERE cat_id='$_GET[cat_id]'");
    $rowedit = mysqli_fetch_array($sql);
    $cat_name = $rowedit['cat_name'];
   
  }else{
    $cat_name = '';
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
      <h1>Categoty</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
          <li class="breadcrumb-item ">Categoty</li>
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
                        Add Category
                     </h5>
                     <form action="" method='POST' enctype="multipart/form-data">
                        <div class="row md-3">
                            <input type="hidden" name='cat_id' value="<?php echo $keyvalue;?>" >
                            <h4 class="card-title ml-2">Category Name</h4>
                            <div class="col-sm-10">
                                <input type="text" name="cat_name" Placeholder="Name" class="form-control" value="<?php echo $cat_name; ?>">
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
                        Show Category
                     </h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                S.No.
                                </th>
                                <th scope="col">
                                     Name
                                </th>
                                <th scope="col">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn=1;
                                $sql = mysqli_query($conn,"SELECT * FROM category order by cat_id desc");
                                while($row = mysqli_fetch_array($sql)){
                                ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $row['cat_name'];?></td>
                                    
                                    <td>
                                    <a  href="category?cat_id=<?php echo $row['cat_id']; ?>"  class="btn btn-success editbtn">Edit</a>
                                    <a href="category?dcat_id=<?php echo $row['cat_id']; ?>"  class="btn btn-danger">Delete</a>
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