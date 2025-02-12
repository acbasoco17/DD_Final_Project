<?php
require 'index.php';
if (!isset($_SESSION['email'])) {
    header("location: sign_in.html");
}
$_SESSION['destination'] = 'users.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
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
                            <a class="nav-link active" aria-current="page" href="users.php">Users</a>
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
            <div class="container align-items-center" style="grid-template-columns: 1fr 2fr;">
                <div class="d-flex align-items-center">
                    <form method="post" action="#" class="w-100 me-3" role="search">
                        <input type="search" class="form-control" name="keywords" placeholder="Search..." aria-label="Search">
                    </form>

                    <div class="flex-shrink-0 dropdown">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-body-tertiary">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $keywords = $_POST['keywords'];
                    } else {
                        $keywords = "";
                    }
                    $query = "SELECT * FROM `User` WHERE `fname` LIKE '%$keywords%'";
                    $search_result = mysqli_query($con, $query) or die(mysqli_error($con));
                    while ($row = mysqli_fetch_array($search_result)) {
                        $username_friend = $row['username'];
                    ?>
                        <div class="col">

                            <div class="card shadow-sm">
                                <a href="user_page.php?user=<?php echo $row['username'] ?>">
                                    <img class="bd-placeholder-img card-img-top" width="100%" height="400" src="img/profile_page_img.png">
                                </a>

                                <div class="card-body">
                                    <p class="card-text"> <?php echo $row['fname'] ?> </p>
                                    <p class="card-text"> <?php echo $row['username'] ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?php
                                        $username = $_SESSION['email'];
                                        $friend_query = "SELECT * FROM `Friends` WHERE `username_user` = '$username' AND `username_friend` = '$username_friend'";
                                        $friend_result = mysqli_query($con, $friend_query) or die(mysqli_error($con));
                                        if (mysqli_num_rows($friend_result) < 1) {
                                        ?>
                                            <a href="add_friend.php?friend=<?php echo $row['username'] ?>&name=<?php echo $row['fname'] ?>" type="button" class="btn btn-sm btn-outline-secondary">Add</a>
                                        <?php
                                        } else { ?>
                                            <a href="remove_friend.php?friend=<?php echo $username_friend ?>" type="button" class="btn btn-sm btn-success"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                                </svg></a>
                                        <?php } ?>
                                    </div>
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