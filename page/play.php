<?php
require('config.php');

$sql_movie_recommend = mysqli_query($sql_con, 'SELECT * FROM movie') or die();
$sql_movie_error = mysqli_query($sql_con, 'SELECT * FROM movie WHERE no="' . $_GET["play"] . '"') or die();
$setting = mysqli_fetch_array($sql_movie_error);
if($setting["no"]==0)
{
  echo "<META HTTP-EQUIV='Refresh'  CONTENT='0;URL=index.php'>";
  echo "<script>alert('ไม่มีหน้าที่คุณเข้าชม!'); </script>";
  exit();
}
$sql_movie = mysqli_query($sql_con, 'SELECT * FROM movie WHERE no="' . $_GET["play"] . '"') or die();
$sql_setting = mysqli_query($sql_con, 'SELECT * FROM setting') or die();
$setting = mysqli_fetch_array($sql_setting);
$sql_movie1 = mysqli_query($sql_con, 'SELECT * FROM movie WHERE no='.$setting["movie_hot1"].' ORDER BY no DESC') or die();
$sql_movie2 = mysqli_query($sql_con, 'SELECT * FROM movie WHERE no='.$setting["movie_hot2"].' ORDER BY no DESC') or die();
$sql_movie3 = mysqli_query($sql_con, 'SELECT * FROM movie WHERE no='.$setting["movie_hot3"].' ORDER BY no DESC') or die();
$sql_movie4 = mysqli_query($sql_con, 'SELECT * FROM movie WHERE no='.$setting["movie_hot4"].' ORDER BY no DESC') or die();
$movie1 = mysqli_fetch_array($sql_movie1);
$movie2 = mysqli_fetch_array($sql_movie2);
$movie3 = mysqli_fetch_array($sql_movie3);
$movie4 = mysqli_fetch_array($sql_movie4);

$movie = mysqli_fetch_array($sql_movie);
$view_add = $movie["view"]+1;
mysqli_query($sql_con, 'UPDATE `movie` SET `view` = "'.$view_add.'" WHERE `no` = '.$_GET["play"].';');


?>
<div class="container mt-4">
  <div class="card mb-4" style="background-color:rgba(15,15,15,0.93);">
    <div class="card-body">
      <div class="row">
        <h1 class="text-white" style="border-left:4px solid #9672ea;">&nbsp;&nbsp;&nbsp;<?= $movie["name"] ?></h1><br><br>
      </div>
      <br>
      <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
          <img src="<?= $movie["pic"] ?>" width="100%" style="border-radius: 5px;"><br><br>
          <div class="movie_type"><?= $movie["hd"] ?> (<?= $movie["year"] ?>)</div>
          <div class="movie_imdb">IMDB : <?= $movie["imdb"] ?></div>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 embed-responsive embed-responsive-16by9">
          <iframe width="560" height="316" src="<?= $movie["youtube"] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>



    </div>
  </div>
  <div class="card mb-4" style="background-color:rgba(15,15,15,0.93);">
    <div class="card-body">
      <span class="text-white" style="font-size:18px; border-left:4px solid #9672ea;">&nbsp;&nbsp;&nbsp;เรื่องย่อ</span><br><br>
      <span class="text-white">
        <?= $movie["story"] ?>
      </span>
    </div>
  </div>

  <div class="embed-responsive embed-responsive-16by9 mb-0">
    <iframe src="<?= $movie["video"] ?>" width="100%" height="100%" frameborder="0" scrolling="no" allowfullscreen></iframe>
  </div>
  <div class="card mb-4" style="background-color:rgba(15,15,15,0.93);">
    <div class="card-body">
      <span class="text-white">
        ตัวเล่นหลัก
      </span>
      <span class="text-white float-right">
      <i class="fa fa-eye"></i> <?=$movie["view"]?> views
      </span>
    </div>
  </div>




  <span class="text-white" style="font-size:18px; border-left:4px solid #9672ea;">&nbsp;&nbsp;&nbsp;หนังแนะนำ</span>
  <div class="row mb-4" style="margin-top:20px;">
  <?php if($setting["movie_hot1"]!=0) { ?>
            <div class="col-sm-3 col-6">
              <div class="movie_grid">
                <a class="movie_col" href="?play=<?= $movie1["no"] ?>">
                  <img class="img-thumbnail movie_img mb-2" style="border:none;" src="<?= $movie1["pic"] ?>"></a>
                <div class="movie_type"><?= $movie1["hd"] ?> (<?= $movie1["year"] ?>)</div>
                <div class="movie_view"><i class="fa fa-eye"></i> <?= $movie1["view"] ?></div>
                <div class="movie_imdb">IMDB : <?= $movie1["imdb"] ?></div>
                <div class="movie_title"><?= $movie1["name"] ?></div>
              </div>
            </div>
        <?php } ?>
        <?php if($setting["movie_hot2"]!=0) { ?>
            <div class="col-sm-3 col-6">
              <div class="movie_grid">
                <a class="movie_col" href="?play=<?= $movie2["no"] ?>">
                  <img class="img-thumbnail movie_img mb-2" style="border:none;" src="<?= $movie2["pic"] ?>"></a>
                <div class="movie_type"><?= $movie2["hd"] ?> (<?= $movie2["year"] ?>)</div>
                <div class="movie_view"><i class="fa fa-eye"></i> <?= $movie2["view"] ?></div>
                <div class="movie_imdb">IMDB : <?= $movie2["imdb"] ?></div>
                <div class="movie_title"><?= $movie2["name"] ?></div>
              </div>
            </div>
        <?php } ?>
        <?php if($setting["movie_hot3"]!=0) { ?>
            <div class="col-sm-3 col-6">
              <div class="movie_grid">
                <a class="movie_col" href="?play=<?= $movie3["no"] ?>">
                  <img class="img-thumbnail movie_img mb-2" style="border:none;" src="<?= $movie3["pic"] ?>"></a>
                <div class="movie_type"><?= $movie3["hd"] ?> (<?= $movie3["year"] ?>)</div>
                <div class="movie_view"><i class="fa fa-eye"></i> <?= $movie3["view"] ?></div>
                <div class="movie_imdb">IMDB : <?= $movie3["imdb"] ?></div>
                <div class="movie_title"><?= $movie3["name"] ?></div>
              </div>
            </div>
        <?php } ?>
        <?php if($setting["movie_hot4"]!=0) { ?>
            <div class="col-sm-3 col-6">
              <div class="movie_grid">
                <a class="movie_col" href="?play=<?= $movie4["no"] ?>">
                  <img class="img-thumbnail movie_img mb-2" style="border:none;" src="<?= $movie4["pic"] ?>"></a>
                <div class="movie_type"><?= $movie4["hd"] ?> (<?= $movie4["year"] ?>)</div>
                <div class="movie_view"><i class="fa fa-eye"></i> <?= $movie4["view"] ?></div>
                <div class="movie_imdb">IMDB : <?= $movie4["imdb"] ?></div>
                <div class="movie_title"><?= $movie4["name"] ?></div>
              </div>
            </div>
        <?php } ?>
  </div>
  <div class="row mb-4" style="margin-top:20px;">
  <div id="fb-root"></div>

    <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="1120" data-numposts="5" colorscheme="dark"></div>
  </div>
</div>