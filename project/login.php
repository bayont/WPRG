<?php
require_once './includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizconst - login</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>

<body>
    <div class="flex flex-col gap-1 min-h-screen">

        <?php
        include_once './navbar.partial.php';
        ?>

        <div class="hero flex-1 bg-base-200">
            <div class="hero-content flex-col lg:flex-row-reverse gap-9">
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl font-bold whitespace-nowrap">Login now!</h1>
                    <p class="py-6 whitespace-nowrap">
                        You don't have an account? <a href="./signup.php" class="after:content-['_↗'] link link-primary">Sign up</a>
                    </p>
                </div>
                <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                    <form action="./includes/login.inc.php" method="post" class="card-body">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Username</span>
                            </label>
                            <label class="input input-bordered flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                    <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                </svg>
                                <input type="username" placeholder="Username" class="grow" name="username" required />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Password</span>
                            </label>
                            <label class="input input-bordered flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                    <path d="M280-400q-33 0-56.5-23.5T200-480q0-33 23.5-56.5T280-560q33 0 56.5 23.5T360-480q0 33-23.5 56.5T280-400Zm0 160q-100 0-170-70T40-480q0-100 70-170t170-70q67 0 121.5 33t86.5 87h352l120 120-180 180-80-60-80 60-85-60h-47q-32 54-86.5 87T280-240Zm0-80q56 0 98.5-34t56.5-86h125l58 41 82-61 71 55 75-75-40-40H435q-14-52-56.5-86T280-640q-66 0-113 47t-47 113q0 66 47 113t113 47Z" />
                                </svg>
                                <input type="password" placeholder="Password" name="password" class="grow" name="password" required />
                            </label>
                        </div>
                        <div class="form-control mt-6">
                            <input type="submit" class="btn btn-primary" value="Login"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

</html>