<?php
require('config.php');

$sql_movie = mysqli_query($sql_con, 'SELECT * FROM movie ORDER BY year DESC') or die();
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


?>
<div class="container mt-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div id="carousel-example-1z" class="carousel slide carousel-fade mb-5" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-1z" data-slide-to="1"></li>
            <li data-target="#carousel-example-1z" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?=$setting["slide1_img"]?>" width="1200" height="auto" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$setting["slide2_img"]?>" width="1200" height="auto" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$setting["slide3_img"]?>" width="1200" height="auto" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <span class="text-white" style="font-size:18px; border-left:4px solid #d4252c;">&nbsp;&nbsp;&nbsp;หนังแนะนำ</span>
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
        <span class="text-white" style="font-size:18px; border-left:4px solid #d4252c;">&nbsp;&nbsp;&nbsp;หนังใหม่</span>
        <div class="row mb-4" style="margin-top:20px;">

          <?php while ($movie_show = mysqli_fetch_array($sql_movie)) { ?>
            <div class="col-sm-3 col-6">
              <div class="movie_grid">
                <a class="movie_col" href="?play=<?= $movie_show["no"] ?>">
                  <img class="img-thumbnail movie_img mb-2" style="border:none;" src="<?= $movie_show["pic"] ?>"></a>
                <div class="movie_type"><?= $movie_show["hd"] ?> (<?= $movie_show["year"] ?>)</div>
                <div class="movie_view"><i class="fa fa-eye"></i> <?= $movie_show["view"] ?></div>
                <div class="movie_imdb">IMDB : <?= $movie_show["imdb"] ?></div>
                <div class="movie_title"><?= $movie_show["name"] ?></div>
              </div>
            </div>
          <?php } ?>

        </div>

        <!-- Movie -->

      </div>
    </div>
  </div>
  <br><br>
</div>