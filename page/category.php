<?php
require('config.php');

$sql_movie_recommend = mysqli_query($sql_con, 'SELECT * FROM category  WHERE no="' . $_GET["category"] . '" ORDER BY no DESC');
$movie_recommend = mysqli_fetch_array($sql_movie_recommend);
$sql_movie = mysqli_query($sql_con, 'SELECT * FROM movie WHERE category="' . $_GET["category"] . '" ORDER BY no DESC');


?>
<div class="container mt-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">


        <!-- Movie -->

        <span class="text-white" style="font-size:18px; border-left:4px solid #9672ea;">&nbsp;&nbsp;&nbsp;<?= $movie_recommend["name"] ?></span>
        <div class="row" style="margin-top:20px;">

          <?php while ($movie = mysqli_fetch_array($sql_movie)) { ?>
            <div class="col-sm-3 col-6">
              <div class="movie_grid">
                <a class="movie_col" href="?play=<?= $movie["no"] ?>">
                  <img class="img-thumbnail movie_img mb-2" style="border:none;" src="<?= $movie["pic"] ?>"></a>
                <div class="movie_type"><?= $movie["hd"] ?> (<?= $movie["year"] ?>)</div>
                <div class="movie_imdb">IMDB : <?= $movie["imdb"] ?></div>
                <div class="movie_title"><?= $movie["name"] ?></div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
  <br><br>
</div>