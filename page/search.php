<?php
require('config.php');
$var_search = $_SESSION["search"] = $_GET["search"];
$sql_movie = mysqli_query($sql_con, 'SELECT * FROM `movie` WHERE `name` LIKE "%' . $var_search . '%"');


?>
<div class="container mt-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">


        <!-- Movie -->

        <span class="text-white" style="font-size:18px; border-left:4px solid #9672ea;">&nbsp;&nbsp;&nbsp;ผลการค้นหา [ <?= htmlspecialchars($_SESSION["search"]) ?> ]</span>
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
<?php unset($_SESSION["search"]); ?>