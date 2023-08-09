<?php
  include("../config.php");
	session_start();
	if(!isset($_SESSION["admin_login"]))
	{
		header( "location: login.php" );
	}
	if(isset($_GET["logout"]))
	{
		unset($_SESSION["admin_login"]);
		unset($_SESSION["admin_user"]);
		unset($_SESSION["admin_permision"]);
		header( "location: login.php" );
  }
  $sql_admin_login = mysqli_query($sql_con, 'SELECT * FROM admin WHERE user="'.$_SESSION["admin_user"].'"');
  $admin_login = mysqli_fetch_array($sql_admin_login);
  $sql_movie = mysqli_query($sql_con, 'SELECT * FROM movie ORDER BY no DESC');
  $sql2 = mysqli_query($sql_con, "SELECT * FROM movie");
  $sql3 = mysqli_query($sql_con, "SELECT MAX(`no`) As `no` FROM `movie`");
  $sql3_query = mysqli_fetch_array($sql3);
  $movie_no = $sql3_query["no"] + 1;
	
	if(isset($_POST["movie_add_ok"]))
	{
		mysqli_query($sql_con, "INSERT INTO `movie` (
      `no`, 
      `date`, 
      `time`, 
      `category`, 
      `name`, 
      `pic`, 
      `hd`, 
      `year`, 
      `imdb`, 
      `story`, 
      `youtube`, 
      `video`) VALUES (
        '".$_POST["no"]."', 
        '".$_POST["date"]."', 
        '".$_POST["time"]."', 
        '".$_POST["category"]."', 
        '".$_POST["name"]."', 
        '".$_POST["pic"]."', 
        '".$_POST["hd"]."', 
        '".$_POST["year"]."', 
        '".$_POST["imdb"]."', 
        '".$_POST["story"]."', 
        '".$_POST["youtube"]."', 
        '".$_POST["video"]."');");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
		echo "<script>alert('เพิ่มหนังเสร็จเรียบร้อย'); </script>";
		exit();
	}
	if(isset($_GET["edit"]))
	{
    $sql_movie_category = mysqli_query($sql_con, 'SELECT * FROM category  WHERE no="'.$_GET["edit"].'" ORDER BY no ASC');
		$sql_edit = mysqli_query($sql_con, "SELECT * FROM movie WHERE no = '".$_GET["edit"]."'");
		$db_edit = mysqli_fetch_array($sql_edit);
		/*if($_SESSION["admin_user"]!=$db_edit["upload_by"])
		{
			echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
			echo "<script>alert('คุณไม่มีสิทธิ์ในเมนูนี้!'); </script>";
			exit();
		}*/
	}
	if(isset($_POST["movie_edit_ok"]))
	{
		mysqli_query($sql_con, "UPDATE `movie` SET 
		`category` = '".$_POST["category"]."', 
		`name` = '".$_POST["name"]."', 
		`year` = '".$_POST["year"]."', 
		`imdb` = '".$_POST["imdb"]."', 
		`hd` = '".$_POST["video_type"]."', 
		`pic` = '".$_POST["pic"]."', 
		`youtube` = '".$_POST["youtube"]."', 
		`story` = '".$_POST["story"]."', 
		`video` = '".$_POST["video"]."' WHERE `no`='".$_POST["no"]."';");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
    echo "<script>alert('แก้ไขหนังเสร็จเรียบร้อย'); </script>";
    exit();
	}
	if(isset($_GET["del"]))
	{
		mysqli_query($sql_con, "DELETE FROM movie WHERE no = '".$_GET["del"]."'");
		echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
    echo "<script>alert('ลบหนังเสร็จเรียบร้อย'); </script>";
    exit();
	}
  //} else

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../img/ico.png" />

  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  <!-- Tyint MCE Text Editor -->
	<!--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
	<script src="https://cdn.tiny.cloud/1/4rrromyrz2x6qf69qzgg5ck6x9975sbdv4j9dhd1sw0nao1w/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<!-- <script>tinymce.init({selector:'textarea'});</script> -->
	
  


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">แผงควบคุม</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="ค้นหาหนัง..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php require('menu.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">ภาพรวม</a>
          </li>
          <li class="breadcrumb-item active">รายการ หนัง</li>
        </ol>

        <!-- Icon Cards-->
        <?php if(!isset($_GET["add_movie"])) { ?>
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3" id="movie_add">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-plus-square"></i>
                </div>
                <div class="mr-5">เพิ่มหนัง</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="?add_movie">
                <span class="float-left">คลิก</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <?php } ?>

        <!-- DataTables Example -->
		<?php
		if(!isset($_GET["edit"]) && !isset($_GET["add_movie"]))
		{
		?>
        <div class="card mb-3" id="movie_list">
          <div class="card-header">
            <i class="fas fa-table"></i>
            รายชื่อหนัง</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr align="center">
                    <th>วันที่เพิ่ม</th>
                    <th>หมวดหมู่</th>
                    <th>ชื่อหนัง</th>
                    <th><img src="https://upload.wikimedia.org/wikipedia/commons/6/69/IMDB_Logo_2016.svg" width="50" height="auto"></th>
                    <th>ปีที่ฉาย</th>
                    <th>จัดการ</th>
                    
                  </tr>
                </thead>
                <tbody>

                <?php
                    while($row = mysqli_fetch_array($sql_movie))
                    {
                      $sql_category = mysqli_query($sql_con, 'SELECT * FROM category WHERE no="'.$row["category"].'"');
                      $category = mysqli_fetch_array($sql_category);

                ?>
                  <tr>
                    
                    <td align="center" data-sort-order="desc"><?=$row["date"]?> - <?=$row["time"]?></td>
                    <td align="center"><?=$category["name"]?></td>
                    <td><img src="<?=$row["pic"]?>" width="50" height="auto" style="border-radius: 5px;"> <?=$row["name"]?></td>
                    <td align="center"><?=$row["imdb"]?></td>
                    <td align="center"><?=$row["year"]?></td>
                    <td align="center">
                        <a href="../index.php?movie=<?=$row["mid"]?>" target="_blank" title="ดูหน้าลิงค์"><i class="fa fa-eye"> </i></a>&nbsp;&nbsp;
                         <?php //if($_SESSION["admin_user"] ==  "Admin") { ?>
						<a href="?edit=<?=$row["no"]?>" title="แก้ไข"><i class="fa fa-edit"> </i></a>&nbsp;&nbsp;
                        <a href="?del=<?=$row["no"]?>"  data-toggle="modal" data-target="#delModal<?=$row["no"]?>" style="color: red;" title="ลบ"><i class="fa fa-trash"></i></a>
						<?php //} ?>
                    </td>
                      <!-- Logout Modal-->
                            <div class="modal fade" id="delModal<?=$row["no"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">คุณกำลังจะลบหนัง?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                <div class="modal-body">คุณต้องการลบหนัง <b style="color: red;"><?=$row["name"]?></b> ใช่หรือไม่?</div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                                    <a class="btn btn-primary" href="?del=<?=$row["no"]?>">ใช่ ฉันยืนยัน</a>
                                  </div>
                                </div>
                                </div>
                            </div>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>
		<?php } ?>
		
		<!-- Movie Add Table Code Start-->
		<?php
		if(isset($_GET["add_movie"]))
		{
      $sql_movie_category = mysqli_query($sql_con, 'SELECT * FROM category ORDER BY no ASC');
		?>
        <div class="card mb-3" id="movie_add_tb">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <strong>เพิ่มหนัง</strong></div>
          <div class="card-body col-6">
		  <form action="index.php" method="POST">
			<input type="hidden" name="movie_add_ok" class="form-control">
			<input type="hidden" name="date" value="<?=date('Y-m-d')?>">
      <input type="hidden" name="time" value="<?=date('H:i')?> น.">
			<input type="hidden" name="no" value="<?=$movie_no?>">
			<div class="form-inline">
      <strong>Movie ID</strong>&nbsp;
			<input type="hidden" name="upload" value="<?=$_SESSION["admin_user"]?>" class="form-control" readonly>
      <input type="text" name="no_show" value="<?=$movie_no?>" class="form-control" readonly>&nbsp;&nbsp;
      <strong>หมวดหมู่</strong>&nbsp;
				<select name="category" class="form-control">
          <?php while($movie_category = mysqli_fetch_array($sql_movie_category)) { ?>
					  <option value="<?=$movie_category["no"]?>"><?=$movie_category["name"]?></option>
          <?php } ?>
				</select>
				</div>
			<br>
            <strong>ชื่อหนัง</strong> <input type="text" name="name" class="form-control"><br>
			<div class="form-inline">
            <strong>ปีที่ฉาย</strong>&nbsp;<input type="number" name="year" value="2020" class="form-control">&nbsp;&nbsp;&nbsp;
				</div>
			<br>
			<div class="form-inline">
            <strong>เรทติ้ง IMDb</strong>&nbsp;<input type="number" name="imdb" step=".01" class="form-control">&nbsp;&nbsp;&nbsp;
            <strong>ความชัด</strong>&nbsp;
				<select name="hd" class="form-control">
					<option value="HD" selected>HD</option>
					<option value="Zoom">Zoom</option>
				</select>
				</div>
			<br>
            <strong>รูปภาพหน้าปก</strong><input type="text" name="pic" placeholder="http://www.uppic.com/img6509611.jpg" class="form-control"><br>
            <strong>ตัวอย่างหนังจาก Youtube</strong> <input type="text" name="youtube" placeholder="https://www.youtube.com/embed/7okAzJiybRA" class="form-control"><br>
            <strong>เรื่องย่อ</strong> <textarea name="story" id="mini_content" rows="10" cols="30" class="form-control"></textarea><br>
              
			<script>
    tinymce.init({
	  selector: 'textarea',
	  height : "300",
      plugins: 'lists media table tinydrive ',
      toolbar: 'addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
      //plugins: 'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinydrive tinymcespellchecker',
      //toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
      toolbar_drawer: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
			
            <strong>Video Link</strong><input type="text" name="video" placeholder="https://www.movie-free2u.com/player.php=ciZfb844WM0NtRA/" class="form-control"><br>
			
          </div>
          <div class="card-footer">
			<button type="submit" class="btn btn-primary"> <i class="fa fa-plus-square"></i> เพิ่มหนัง</button>
			<button type="reset" class="btn btn-danger" id="movie_add_cancle" onclick="javascript:window.location='';">ยกเลิก</button>
		  
		  </div>
		  </form>
        </div>
		<?php } ?>
		<!-- Movie Add Table Code End -->
		
		<?php
		if(isset($_GET["edit"]))
		{
		?>
		
		<!-- Movie Edit Table Code Start-->
        <div class="card mb-3" id="movie_edit">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <strong>แก้ไขหนัง</strong></div>
          <div class="card-body col-6">
		  <form action="index.php" method="POST">
			<input type="hidden" name="movie_edit_ok" value="<?=$movie_no?>" class="form-control" >
			<input type="hidden" name="no" value="<?=$db_edit["no"]?>" class="form-control" >
			<p><img src="<?=$db_edit["pic"]?>" width="250" height="auto" style="border-radius: 5px;"></p>
			<div class="form-inline">
			<strong>Movie ID</strong>&nbsp;<input type="text" name="mid" value="<?=$db_edit["no"]?>" class="form-control" readonly>&nbsp;&nbsp;&nbsp;
            <strong>หมวดหมู่</strong>&nbsp;
				<select name="category" class="form-control">
        <?php
          $sql_category2 = mysqli_query($sql_con, 'SELECT * FROM category');
          while($db_category = mysqli_fetch_array($sql_category2)) {
        ?>
					<option value="<?=$db_category["no"]?>" <?php if($db_edit["category"]==$db_category["no"]) { echo "selected"; } ?>><?=$db_category["name"]?></option>
        <?php } ?>
				</select>
				</div>
			<br>
            <strong>ชื่อหนัง</strong> <input type="text" name="name" value="<?=$db_edit["name"]?>" class="form-control"><br>
			<div class="form-inline">
            <strong>ปีที่ฉาย</strong>&nbsp;<input type="number" name="year" value="<?=$db_edit["year"]?>" class="form-control">&nbsp;&nbsp;&nbsp;
				</div>
			<br>
			<div class="form-inline">
            <strong>เรทติ้ง IMDb</strong>&nbsp;<input type="number" name="imdb" step=".01" value="<?=$db_edit["imdb"]?>" class="form-control">&nbsp;&nbsp;&nbsp;
            <strong>ความชัด</strong>&nbsp;
				<select name="video_type" class="form-control">
					<option value="HD" selected>HD</option>
					<option value="Zoom">Zoom</option>
				</select>
				</div>
			<br>
            <strong>รูปภาพหน้าปก</strong><input type="text" name="pic" placeholder="http://www.uppic.com/img6509611.jpg" value="<?=$db_edit["pic"]?>" class="form-control"><br>
            <strong>ตัวอย่างหนังจาก Youtube</strong> <input type="text" name="youtube" placeholder="https://www.youtube.com/embed/7okAzJiybRA" value="<?=$db_edit["youtube"]?>" class="form-control"><br>
            <strong>เรื่องย่อ</strong> <textarea name="story" rows="10" cols="30" class="form-control"><?=$db_edit["story"]?></textarea><br>
			
			<script>
    tinymce.init({
	  selector: 'textarea',
	  height : "300",
      plugins: 'lists media table tinydrive ',
      toolbar: 'addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
      //plugins: 'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinydrive tinymcespellchecker',
      //toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
      default_link_target: "_blank", 
      toolbar_drawer: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
			
            <strong>Gdrive Video Link</strong><input type="text" name="video" placeholder="https://www.movie-free2u.com/gdrive/video/ciZfb844WM0NtRA/" value="<?=$db_edit["video"]?>" class="form-control"><br>
			<font color="red">Gdrive Video Link คือลิงค์จากเมนู Google Drive Proxy</font>
			
          </div>
          <div class="card-footer">
			<button type="submit" class="btn btn-primary"> <i class="fa fa-plus-square"></i> บันทึก</button>
			<button type="reset" class="btn btn-danger"  onclick="javascript:window.location='index.php';">ยกเลิก</button>
		  
		  </div>
		  </form>
        </div>
		<!-- Movie Edit Table Code End -->
		
		<?php } ?>
		
		
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2020. All rights reserved.</span>
          </div>
        </div>
      </footer>

    </div>
	
	
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
