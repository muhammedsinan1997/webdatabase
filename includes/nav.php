

<div class="min-vh-100" style="background-image: url('img/forest.jpg'); background-size: cover; background-repeat: no-repeat; background-position:center ">
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">WORLD FORESTS AND NATIONAL PARKS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true ) : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="welcome.php">Add Forest</a>
                        </li>
                        <?php endif;?>
                    </ul>
                    <div class="d-flex">
                        <?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true ) : ?>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="#"  tabindex="-1">Hi, <?= $_SESSION['user']['username']; ?> </a>
                                </li>
                                <li class="nav-item">
                                    <form action="logout.php" method="post">
                                        <button type="submit" class="btn btn-outline-warning">Logout</button>
                                    </form>

                                </li>
                            </ul>
                        <?php else:?>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php" tabindex="-1">Log in/Register</a>
                                </li>
                            </ul>
                        <?php endif;?>


                    </div>
                </div>
            </div>
        </nav>
    </div>

<?php include('./includes/footer.php') ?>