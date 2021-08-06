<?php if(session_status() == PHP_SESSION_NONE  ){
    session_start();
} ?>
<!--page title-->
<?php  $title = 'Home' ; ?>

<!--header of the page-->
<?php include('./includes/header.php') ?>
<?php include('./includes/nav.php') ?>
<!--db connection-->
<?php include('db.php') ?>
<?php include('model.php') ?>


    <div class="container">
        <div class="row">
            <div class="owl-carousel">
                <div> <img src="img/3.jpg" alt=""> </div>
                <div> <img src="img/4.jpg" alt=""> </div>
                <div> <img src="img/5.jpg" alt=""></div>
                <div> <img src="img/6.jpg" alt=""> </div>
                <div> <img src="img/9.jpg" alt=""> </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col"></div>
            <div class="col text-center">
                <h2>Search for Forests and National Parks</h2>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col"></div>
            <div class="col d-flex justify-content-center">
                <form class="row row-cols-lg-auto g-3 align-items-center" action="index.php" method="POST">
                        <div class="col-12" style="position: relative;width:250px">
                            <div class="input-group" style="position: absolute; width: 200px; top:0; left: 0;">
                                <input type="text" name="country" class="form-control" id="countrySearch" placeholder="country name" required autocomplete="off">
                            </div>
                            <div style="position: absolute; width: 200px; top:40px; left: 0;z-index: 100;" id="dropForest">


                            </div>

                            <div class="" style="position: absolute; width: 50px; top:0; right: 0;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                </form>

            </div>

            <div class="col"></div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" >
            <div id="searchedCards">


                <?php  if(isset($errors) && count($errors) !== 0) :    ?>
                    <div class="text-center">
                        <p class="text-danger">Country field is required</p>
                    </div>

                <?php  else :  ?>

                    <?php  if(isset($searches) && $_SESSION['isSearched'] === true && count($searches) !== 0) :    ?>

                        <?php foreach ($searches as $search ) : ?>
                            <div class="card mb-3" style="z-index: 10;" >
                                <div class="row g-0">
                                    <div class="col-md-4" style="background-image: url('<?= $search['image'] ;  ?>'); background-repeat: no-repeat;background-size: contain; " >

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($search['name']) ; ?></h5>
                                            <p class="m-0"> <span class="fw-bold">Area:</span> <span><?= $search['area'] === null ? 'N/A':$search['area']  ; ?></span>  <span>km²</span> </p>
                                            <p class="m-0"> <span class="fw-bold">Latitude:</span> <span><?= $search['lat'] === null ? 'N/A' : $search['lat'] ; ?></span> </p>

                                            <p class="m-0"><span class="fw-bold">Longitude:</span> <span><?= $search['lng'] === null ? 'N/A':$search['lng'] ; ?></span> </p>
                                            <p class="m-0"><span class="fw-bold">Description:</span> <span><?= $search['description'] === null ? 'N/A':htmlspecialchars($search['description'])  ; ?></span> </p>

                                            <p class="m-0"><span class="fw-bold">URL:</span> <span><?= $search['url'] === null ? 'N/A': "<a href='{$search['url']}'  target='_blank'>view</a>"   ; ?></span> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php  $_SESSION['isSearched'] = false   ?>
                    <?php  else :    ?>
                        <?php  if(isset($searches) && $_SESSION['isSearched'] === true):    ?>
                        <div class="text-center">
                            <p>No results found</p>
                        </div>
                            <?php  $_SESSION['isSearched'] = false   ?>
                        <?php  endif;     ?>

                    <?php  endif;     ?>

                <?php  endif;     ?>
            </div>
<!---->


            </div>
            <div class="col-md-2"></div>





        </div>

    </div>







<?php include('./includes/footer.php') ?>





