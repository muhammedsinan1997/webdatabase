<?php if(session_status() == PHP_SESSION_NONE  ){
    session_start();
    if(!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true){
        header("Location: login.php");
    }
} ?>
<?php $title = 'Welcome'; ?>
<?php include('./includes/header.php') ?>
<?php include('./includes/nav.php') ?>

<?php include('db.php') ?>
<?php include('welcome_model.php') ?>




    <div class="container mt-5">
        <div class="row">

            <div class="col-md-4 offset-md-4">

                <?php if(isset($_SESSION['recordAdded']) && $_SESSION['recordAdded'] === true ) : ?>
                    <div class="alert alert-success" role="alert">
                    <span>
                        New forest record added successfully.
                    </span>
                    </div>
                    <?php  $_SESSION['recordAdded'] = false;  ?>
                <?php endif;?>

                <div class="text-center">
                    <h3>Add New Forest in the World</h3>
                </div>


                <div class="mt-4">
                    <form action="welcome.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="country" >
                            <option selected value="">Select country</option>
                            <?php foreach ($countries as $c)  : ?>
                            <option  value="<?php echo $c['id'];?>"  <?= isset($_SESSION['country']) && !empty($_SESSION['country'])  && $c['id'] === $_SESSION['country'] ?  'selected' : '';    ?>  > <?php echo $c['name'];  ?> </option>
                            <?php endforeach;  ?>
                        </select>

                        <?php  if(isset($_SESSION['errors']) && !empty($_SESSION['errors']['country'])):   ?>
                          <p class="text-danger"><?php echo $_SESSION['errors']['country']  ?></p>
                        <?php  $_SESSION['errors']['country'] = '';   ?>
                        <?php  endif;  ?>

                    </div>
                    <div class="mb-3">
                        <label for="forest" class="form-label">Name of the Forest</label>
                            <input class="form-control" id="forest" name="forest" type="text" value="<?= isset($_SESSION['forest']) && !empty($_SESSION['forest']) ?  $_SESSION['forest'] : '';    ?>" />
                            <?php  if(isset($_SESSION['errors']) && !empty($_SESSION['errors']['forest'])):    ?>
                              <p class="text-danger"><?php echo $_SESSION['errors']['forest']  ?></p>
                                <?php  $_SESSION['errors']['forest'] = '';   ?>
                            <?php  endif;  ?>



                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input class="form-control" id="link" name="link" type="url" />
                        </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Select image:</label>
                        <input class="form-control" id="image" name="image" type="file" />
                    </div>
                    <div class="mb-3">
                        <label for="area" class="form-label">Area in km²</label>
                        <input class="form-control" id="area" name="area" type="text" />
                    </div>
                    <div class="mb-3">
                        <label for="lat" class="form-label">Latitude</label>
                        <input class="form-control" id="lat" name="lat" type="text" />
                    </div>
                    <div class="mb-3">
                        <label for="lng" class="form-label">Longitude</label>
                        <input class="form-control" id="lng" name="lng" type="text" />
                    </div>
                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>



            </div>


<?php include('./includes/footer.php') ?>

