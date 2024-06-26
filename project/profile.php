<?php
require_once 'includes/config_session.inc.php';

if (isset($_SESSION['user_id'])) {
    $logged_in = true;
} else {
    $logged_in = false;
}

require 'classes/dbh.class.php';
require 'classes/profile/profile.class.php';
require 'classes/profile/profile-view.class.php';

$profileView = new ProfileView();

if (isset($_GET['id'])) {
    $uid = $_GET['id'];
} elseif ($logged_in) {
    $uid = $_SESSION['user_id'];
} else {
    header('Location: index.php');
    die;
}

$user_exist = $profileView->isUserExists($uid);
if (!$user_exist) {
    header('Location: index.php');
    die;
}

$userDetails = $profileView->getPublicProfileDetails($uid);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo $userDetails['user_name']; ?></title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>

<body>
    <div class="flex flex-col gap-1 min-h-screen">
        <?php
        include_once 'includes/navbar.inc.php';
        ?>

        <div class="flex-1 flex justify-center">
            <div class="w-full md:w-4/5 p-2 my-5 flex flex-col gap-4">
                <div class="card relative bg-base-200 shadow-xl pt-5 mt-9">
                    <?php
                    echo isset($userDetails['avatar_url']) ? '<div class="avatar mx-auto absolute -top-14 left-1/2 -translate-x-1/2">
                            <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="' . $userDetails['avatar_url'] . '" />
                            </div>
                        </div>' : '<div class="avatar placeholder mx-auto absolute -top-14 left-1/2 -translate-x-1/2">
                        <div class="bg-primary text-primary-content rounded-full w-24 ring ring-primary ring-offset-base-100 ring-offset-2">
                            <span class="text-3xl">' . strtoupper(substr($userDetails['user_name'], 0, 1)) . '</span>
                        </div>
                    </div>';

                    ?>

                    <div class="card-body flex flex-col items-center">
                        <h1 class="card-title w-full text-2xl text-center font-bold font-specific "> <span class="w-full text-primary"><?php echo $userDetails['user_name'] ?></span></h1>

                        <div class="stats stats-vertical md:stats-horizontal bg-base-100 shadow w-full">

                            <div class="stat">
                                <div class="stat-figure text-primary font-specific text-4xl w-8 h-8">
                                    Q
                                </div>
                                <div class="stat-title">Quizes made</div>
                                <div class="stat-value"><?php $profileView->showQuizesMade($uid) ?></div>
                            </div>

                            <div class="stat">
                                <div class="stat-figure text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" class="fill-current">
                                        <path d="m239.33-160 40-159.33H120L136.67-386H296l47.33-188H184l16.67-66.67H360L399.33-800h66L426-640.67h188.67L654-800h66l-39.33 159.33H840L823.33-574H664l-47.33 188H776l-16.67 66.67H600L560-160h-66l40-159.33H345.33l-40 159.33h-66ZM362-386h188.67L598-574H409.33L362-386Z" />
                                    </svg>
                                </div>
                                <div class="stat-title">Attempts</div>
                                <div class="stat-value"><?php $profileView->showAttemptsNumber($uid) ?></div>
                            </div>

                        </div>

                        <?php
                        if ($logged_in && $uid == $_SESSION['user_id']) {
                        ?>
                            <a href="edit-profile.php" class="btn w-full bg-base-100">Edit profile</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>