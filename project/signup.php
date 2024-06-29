<?php

require_once './includes/config_session.inc.php';

$grouped_errors = array(
    "username" => "",
    "password" => "",
);

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
    if (isset($errors['input_invalid'])) {
        $grouped_errors['username'] = $errors['input_invalid'];
        $grouped_errors['password'] = $errors['input_invalid'];
    }
    if (isset($errors['username_invalid'])) {
        $grouped_errors['username'] = $grouped_errors['username'] === "" ? $errors['username_invalid'] : $grouped_errors['username'] . '<br /><br />' . $errors['username_invalid'];
    }
    if (isset($errors['password_invalid'])) {
        $grouped_errors['password'] = $grouped_errors['password'] === "" ? $errors['password_invalid'] : $grouped_errors['password'] . '<br /><br />' . $errors['password_invalid'];
    }
    if (isset($errors['passwords_no_match'])) {
        $grouped_errors['password'] = $grouped_errors['password'] === "" ? $errors['passwords_no_match'] : $grouped_errors['password'] . '<br /><br />' . $errors['passwords_no_match'];
    }
    if (isset($errors['username_taken'])) {
        $grouped_errors['username'] = $grouped_errors['username'] === "" ? $errors['username_taken'] : $grouped_errors['username'] . '<br /><br />' . $errors['username_taken'];
    }
    if (isset($errors['username_too_short'])) {
        $grouped_errors['username'] = $errors['username_too_short'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizconst - signup</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>

<body>
    <div class="flex flex-col gap-1 min-h-screen">

        <?php
        include_once './includes/navbar.inc.php';
        $username = $_GET['username'] ?? '';

        ?>

        <div class="hero flex-1 bg-base-200">
            <div class="hero-content flex-col lg:flex-row-reverse gap-9">
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl font-bold whitespace-nowrap">Sign up now!</h1>
                    <p class="py-6 whitespace-nowrap">
                        Already have an account? <a href="/login.php" class="after:content-['_↗'] link link-primary">Login</a>
                    </p>
                </div>
                <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                    <form action="./includes/signup.inc.php" method="post" class="card-body">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Username</span>
                            </label>
                            <label class="input input-bordered
                                <?php if (strlen($grouped_errors['username']) > 0) {
                                    echo 'input-error';
                                } ?>
                            flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                    <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                </svg>
                                <input type="username" placeholder="Username" class="grow" name="username" value="<?php echo $username; ?>" required />
                            </label>
                            <small class="text-xs text-error ml-2">
                                <?php echo $grouped_errors['username']; ?>
                            </small>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Password</span>
                            </label>
                            <label class="input input-bordered
                            <?php if (strlen($grouped_errors['password']) > 0) {
                                echo 'input-error';
                            } ?>
                            flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                    <path d="M280-400q-33 0-56.5-23.5T200-480q0-33 23.5-56.5T280-560q33 0 56.5 23.5T360-480q0 33-23.5 56.5T280-400Zm0 160q-100 0-170-70T40-480q0-100 70-170t170-70q67 0 121.5 33t86.5 87h352l120 120-180 180-80-60-80 60-85-60h-47q-32 54-86.5 87T280-240Zm0-80q56 0 98.5-34t56.5-86h125l58 41 82-61 71 55 75-75-40-40H435q-14-52-56.5-86T280-640q-66 0-113 47t-47 113q0 66 47 113t113 47Z" />
                                </svg>
                                <input type="password" placeholder="Password" name="password" class="grow" name="password" required />
                            </label>

                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Repeat password</span>
                            </label>
                            <label class="input input-bordered
                            <?php if (strlen($grouped_errors['password']) > 0) {
                                echo 'input-error';
                            } ?>
                            flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                    <path d="M280-400q-33 0-56.5-23.5T200-480q0-33 23.5-56.5T280-560q33 0 56.5 23.5T360-480q0 33-23.5 56.5T280-400Zm0 160q-100 0-170-70T40-480q0-100 70-170t170-70q67 0 121.5 33t86.5 87h352l120 120-180 180-80-60-80 60-85-60h-47q-32 54-86.5 87T280-240Zm0-80q56 0 98.5-34t56.5-86h125l58 41 82-61 71 55 75-75-40-40H435q-14-52-56.5-86T280-640q-66 0-113 47t-47 113q0 66 47 113t113 47Z" />
                                </svg>
                                <input type="password" placeholder="Repeat password" name="repeated_password" class="grow" name="repeat_password" required />
                            </label>
                        </div>
                        <small class="text-xs text-error ml-2 mt-1">
                            <?php echo $grouped_errors['password']; ?>
                        </small>
                        <div class="form-control mt-6">
                            <input type="submit" class="btn btn-primary" value="Sign up"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

</html>