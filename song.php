<?php
require 'index.php';
$username = $_SESSION['email'];
$_SESSION['destination'] = 'song.php';
$id = $_GET['id'];
$music_query = "SELECT * FROM `Music_Library` WHERE `id` = '$id'";
$music_result = mysqli_query($con, $music_query) or die(mysqli_error($con));
$song = mysqli_fetch_row($music_result);

$user_rating_query = "SELECT * FROM `Reviews` WHERE `id` = '$id' AND `username` = '$username'";
$user_rating_result = mysqli_query($con, $user_rating_query) or die(mysqli_error($con));

$review_query = "SELECT * FROM `Reviews` INNER JOIN `User` ON `Reviews`.`username`=`User`.`username` WHERE `id` = '$id'";
$review_result = mysqli_query($con, $review_query) or die(mysqli_error($con));

$num = 0;
if (mysqli_num_rows($user_rating_result)) {
    $review = mysqli_fetch_row($user_rating_result);
    $num = $review[3];
}
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
            --bs-btn-border-width: 42px;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        .star {
            width: 42px;
        }

        .active {
            --bs-btn-color: var(--bs-btn-hover-color);
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
                <div class="collapse navbar-collapse" style="display: flex; justify-content: flex-end"
                    id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="navbar-brand" href="profile.php"><img src="img/profile.png" width=50></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main role="main relative">
        <section class="py-5 mb-6 container border-bottom">
            <div class="container align-items-center" style="grid-template-columns: 2fr 1fr;">
                <h1 class="d-flex justify-content-center"><?php echo $song[1] ?></h1>
                </br>
                <div class="d-flex justify-content-evenly">
                    <img src="<?php echo $song[6]; ?>">
                </div>
                </br>
                <div class="d-flex justify-content-center">
                    <h5><?php echo $song[2] ?> | <?php echo $song[3] ?> | <?php echo $song[5] ?></h5>
                </div>
            </div>
            <div class="container btn-group align-items-center mb-6">
                <a role="button" href="rating.php?id=<?php echo $id ?>&star=1" class="btn btn-outline-secondary <?php if ($num == 1) { ?> active <?php } ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                    </svg>
                </a>

                <a role="button" href="rating.php?id=<?php echo $id ?>&star=2" class="btn btn-outline-secondary <?php if ($num == 2) { ?> active <?php } ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                    </svg>
                </a>
                <a role="button" href="rating.php?id=<?php echo $id ?>&star=3" class="btn btn-outline-secondary <?php if ($num == 3) { ?> active <?php } ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                    </svg>
                </a>
                <a role="button" href="rating.php?id=<?php echo $id ?>&star=4" class="btn btn-outline-secondary <?php if ($num == 4) { ?> active <?php } ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                    </svg>
                </a>
                <a role="button" href="rating.php?id=<?php echo $id ?>&star=5" class="btn btn-outline-secondary <?php if ($num == 5) { ?> active <?php } ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                    </svg>
                </a>
            </div>
            <div class="container mt-3">
                <form method="post" action="review.php?id=<?php echo $id ?>">
                    <textarea name="review" class="w-100 form-control" style="height: 200px; border-radius: 3px;" placeholder="Review..."></textarea>
                    <div class="d-flex justify-content-end">
                    <input type="submit" class="btn btn-outline-secondary mt-2" value="Post Review">
                </div>
                </form>
                
            </div>
        </section>

        <div class="container d-flex align-items-center flex-column  mt-3 mb-3">
            <h3>Lyrics</h3>
            <h5 style="text-align: center;"><?php if ($song[4] != null) {
                    echo nl2br($song[4]);
                } else {
                    echo "No lyrics added yet.";
                } ?></h5>
        </div>
        <div class="container border-top"></div>
        <div class="container d-flex flex-column mt-3">
            <div class="d-flex align-items-center flex-column">
            <h3>Reviews</h3>
            </div>
            <ul style="list-style: none;">
                <?php
                while ($row = mysqli_fetch_array($review_result)) {
                    if ($row['review'] != NULL) {
                ?>
                        <li>
                            
                            <p style="margin-left: 25%">
                                <img style="margin-left: 23%;" src="img/profile_page_img.png" width="3%">
                                <?php echo $row['fname'] ?>: <?php echo $row['review'] ?></p>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </main>
</body>

</html>