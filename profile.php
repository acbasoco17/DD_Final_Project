<?php
require 'index.php';
$_SESSION['destination'] = "profile.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        .right-half {
            position: absolute;
            right: 0px;
            width: 50%;
        }

        .left-half {
            position: absolute;
            left: 0px;
            width: 50%;
        }

        .cover {
            object-fit: cover;
            width: 100%;
            height: 300px;
        }
    </style>
</head>

<body>
    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark relative bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="music.php"><img src="img/dark_logo.png" width=50></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="music.php">Music</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="artists.php">Artists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Users</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main role="main relative">
        <section class="py-5 mb-6 container border-bottom">
            <div class="container align-items-center" style="grid-template-columns: 2fr 1fr;">
                <div class="d-flex justify-content-evenly">
                    <img src="img/profile_page_img.png" width=30%>
                    <div class="flex-lg-fill mt-5">
                        <?php
                        $username = $_SESSION['email'];
                        $query = "SELECT * FROM `User` WHERE `username` = '$username'";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));

                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <h3>Name: <?php echo $row['fname'] ?></h3>
                            <h3>Email: <?php echo $row['username'] ?></h3>
                            <h3>Account Created: <?php echo $row['account_created'] ?></h3>
                        <?php
                        }
                        ?>
                        <a role="button" class="btn btn-lg btn-danger" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-body-tertiary">
            <div class="container mb-5">
                <h1 class="d-flex justify-content-center">Your Music</h1>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    $username = $_SESSION['email'];
                    $query = "SELECT * FROM `Music_Library` INNER JOIN `Music_Listened_To` ON `Music_Library`.`id`=`Music_Listened_To`.`id` WHERE `username` = '$username'";
                    $search_result = mysqli_query($con, $query) or die(mysqli_error($con));
                    while ($row = mysqli_fetch_array($search_result)) {
                    ?>
                        <div class="col">
                            <div class="card shadow-sm">
                            <a href="song.php?id=<?php echo $row['id'] ?>">
                                <img class="bd-placeholder-img card-img-top cover" width="100%" height="300" src="<?php echo $row['cover_image'] ?>">
                    </a>
                                <div class="card-body">
                                    
                                    <div class="d-flex justify-content-between">
                                    <p class="card-text"> <?php echo $row['title'] ?> </p>
                                    
                                    <a href="remove_music.php?id=<?php echo $row['id']?>" role="button" class="text-body-secondary btn btn-danger">x</a>
                                    </div>
                                    <p class="card-text"> <?php echo $row['artist'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="container">
                <h1 class="d-flex justify-content-center">Friends</h1>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    $username = $_SESSION['email'];
                    $query = "SELECT * FROM `Friends` WHERE `username_user`='$username'";
                    $search_result = mysqli_query($con, $query) or die(mysqli_error($con));
                    while ($row = mysqli_fetch_array($search_result)) {
                    ?>
                        <div class="col">
                            <div class="card shadow-sm">
                            <a href="user_page.php?user=<?php echo $row['username_friend'] ?>">
                                <img class="bd-placeholder-img card-img-top" width="100%" height="300" src="img/profile_page_img.png">
                            </a>
                                <div class="card-body">
                                    <p class="card-text"> <?php echo $row['friend_name'] ?> </p>
                                    <p class="card-text"> <?php echo $row['username_friend'] ?></p>
                                    <a href="remove_friend.php?friend=<?php echo $row['username_friend'] ?>" type="button" class="btn btn-sm btn-danger"> X </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>