<?php
require_once './includes/config_session.inc.php';

if (isset($_SESSION['user_id'])) {
    $logged_in = true;
} else {
    $logged_in = false;
    header('Location: login.php');
    die();
}
require_once 'classes/dbh.class.php';
require_once 'classes/permission/permission.class.php';
require_once 'classes/permission/permission-view.class.php';

$permissionView = new PermissionView();

if (!$permissionView->userHasPermission($_SESSION['user_id'], 'is_admin')) {
    header('Location: ./insufficient-permissions.php');
    die();
}

require_once 'classes/quiz/quiz.class.php';
require_once 'classes/quiz/quiz-view.class.php';

$quizView = new QuizView();

require_once 'classes/profile/profile.class.php';
require_once 'classes/profile/profile-view.class.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizconst</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>

<body>
    <div class="flex flex-col gap-1 min-h-screen">
        <?php
        include_once './includes/navbar.inc.php';
        ?>

        <div class="flex-1 flex justify-center">
            <div class="w-full md:w-4/5 p-2">
                <h1 class="text-3xl font-bold font-specific my-2 ml-2">Admin panel</h1>
                <div class="w-full flex flex-col gap-3 my-2">
                    <div class="collapse collapse-arrow bg-base-200">
                        <input type="checkbox" checked />
                        <div class="collapse-title text-xl font-medium">Users</div>
                        <div class="collapse-content overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="table">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th class="text-center">Quizzes made</th>
                                            <th class="text-center">Overall attempts</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($profileView->getAllUsersProfileDetails() as $user) {
                                            $isOwnProfile = $user['id'] == $_SESSION['user_id'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="flex items-center gap-3">
                                                        <?php
                                                        if (!$user['avatar_url']) {
                                                        ?>
                                                            <div class="avatar placeholder">
                                                                <div class="bg-primary text-primary-content rounded-full w-12">
                                                                    <span><?php echo strtoupper(substr($user['user_name'], 0, 1)) ?></span>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="avatar">
                                                                <div class="rounded-full h-12 w-12">
                                                                    <img src="<?php echo './uploads/' . $user['avatar_url'] ?>" alt="Avatar" />
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div>
                                                            <div class="font-bold"><?php echo $user['user_name'] ?>
                                                                <span class="badge badge-sm">#<?php echo $user['id'] ?></span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <?php $profileView->showQuizesMade($user['id']) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php $profileView->showAttemptsNumber($user['id']) ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['role'] ?>
                                                </td>
                                                <td>
                                                    <div class="flex gap-2">
                                                        <a href="./profile.php?id=<?php echo $user['id'] ?>" class="btn btn-primary btn-sm btn-square">
                                                            <div class="tooltip" data-tip="See user's details">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="fill-current">
                                                                    <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                                                </svg>
                                                            </div>
                                                        </a>

                                                        <a class="btn btn-error btn-sm btn-square <?php echo $isOwnProfile ? 'btn-disabled' : ''; ?>" href="./includes/delete-user.php?id=<?php echo $user['id'] ?>">
                                                            <div class="tooltip" data-tip="Delete user">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="fill-current">
                                                                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </div>

                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="collapse collapse-arrow bg-base-200">
                        <input type="checkbox" />
                        <div class="collapse-title text-xl font-medium">Quizzes</div>
                        <div class="collapse-content">
                            <p>TODO</p>
                        </div>
                    </div>
                    <div class="collapse collapse-arrow bg-base-200">
                        <input type="checkbox" />
                        <div class="collapse-title text-xl font-medium">Other</div>
                        <div class="collapse-content">
                            <p>TODO</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>