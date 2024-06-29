<?php
require_once './includes/config_session.inc.php';

if (isset($_SESSION['user_id'])) {
    $logged_in = true;
} else {
    $logged_in = false;
    header('Location: login.php');
}

require 'classes/dbh.class.php';
require 'classes/profile/profile.class.php';
require 'classes/profile/profile-view.class.php';
require 'classes/permission/permission.class.php';
require 'classes/permission/permission-view.class.php';

$permissionView = new PermissionView();

$user_id = $_SESSION['user_id'];

if (isset($_GET['id']) && $_GET['id'] != $user_id) {
    if ($permissionView->userHasPermission($user_id, 'edit_profile')) {
        $user_id = $_GET['id'];
    } else {
        header('Location: insufficient-permissions.php');
        die();
    }
}

$profileView = new ProfileView();

$userDetails = $profileView->getPublicProfileDetails($user_id);
$avatarUrl = '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo $userDetails['user_name']; ?></title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/tailwind.css">
    <script>
        function editProperty(buttonId, inputId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            input.removeAttribute('disabled');
            input.focus();
            button.querySelector('.edit-icon').classList.add('hidden');
            button.querySelector('.undo-icon').classList.remove('hidden');
            button.setAttribute('onclick', `revertProperty('${buttonId}', '${inputId}', '${input.value}')`);
        }

        function revertProperty(buttonId, inputId, originalValue) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            input.value = originalValue;
            input.setAttribute('disabled', 'disabled');
            button.querySelector('.edit-icon').classList.remove('hidden');
            button.querySelector('.undo-icon').classList.add('hidden');
            button.setAttribute('onclick', `editProperty('${buttonId}', '${inputId}')`);
        }


        function editPassword(buttonId, inputId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const retypePasswordControl = document.getElementById('retype-password-control');
            const retypePasswordInput = document.getElementById('retype-password');
            input.removeAttribute('disabled');
            input.focus();
            retypePasswordInput.removeAttribute('disabled');
            button.querySelector('.edit-icon').classList.add('hidden');
            button.querySelector('.undo-icon').classList.remove('hidden');
            button.setAttribute('onclick', `revertPassword('${buttonId}', '${inputId}', '${input.value}')`);
            retypePasswordControl.classList.remove('hidden');
        }

        function revertPassword(buttonId, inputId, originalValue) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const retypePasswordControl = document.getElementById('retype-password-control');
            const retypePasswordInput = document.getElementById('retype-password');
            input.value = originalValue;
            input.setAttribute('disabled', 'disabled');
            retypePasswordInput.setAttribute('disabled', 'disabled');
            button.querySelector('.edit-icon').classList.remove('hidden');
            button.querySelector('.undo-icon').classList.add('hidden');
            button.setAttribute('onclick', `editPassword('${buttonId}', '${inputId}')`);
            retypePasswordControl.classList.add('hidden');
        }

        function handleFile(event) {
            const file = event.target.files[0];
            if (!file) {
                return;
            }
            const preview = document.querySelector("#avatar-preview");
            preview.classList.add("obj");
            preview.file = file;

            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
            showAvatar();
        }
    </script>
</head>

<body>
    <div class="flex flex-col gap-1 min-h-screen">
        <?php
        include_once './navbar.partial.php';
        ?>

        <div class="flex-1 flex justify-center">
            <div class="w-full md:w-4/5 p-2 my-5 flex flex-col gap-4">
                <div class="card relative bg-base-200 shadow-xl pt-5 mt-9">
                    <div class="card-body flex flex-col">
                        <h1 class="card-title">Edit profile</h1>
                        <div id="placeholder" class="block avatar placeholder absolute right-2 top-2">
                            <div class="bg-primary text-primary-content w-20 rounded-full">
                                <span class="text-3xl"><?php echo strtoupper(substr($userDetails['user_name'], 0, 1)) ?></span>
                            </div>
                        </div>

                        <div id="avatar" class="hidden avatar absolute right-2 top-2">
                            <div class="w-20 rounded-full">
                                <img id="avatar-preview" />
                            </div>
                        </div>
                        <form action="./includes/edit-profile.inc.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                            <input type="hidden" name="uid" value="<?php echo $user_id ?>" />

                            <label class="form-control w-full md:w-72">
                                <div class="label">
                                    <span class="label-text">Avatar</span>
                                </div>
                                <div>
                                    <input name="avatar" onchange="handleFile(event)" accept="image/*" type="file" class="file-input file-input-bordered w-full" />
                                </div>
                            </label>
                            <label class="form-control w-full md:w-72">
                                <div class="label">
                                    <span class="label-text">Username</span>
                                </div>
                                <div class="flex gap-3">
                                    <input type="text" value="<?php echo $userDetails['user_name'] ?>" id="username" name="username" class="input input-bordered w-full " disabled />
                                    <button type="button" class="btn btn-square btn-outline" id="username-button" onclick="editProperty('username-button', 'username')">
                                        <svg class="edit-icon fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                                            <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                                        </svg>
                                        <svg class="hidden undo-icon fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                                            <path d="M280-200v-80h284q63 0 109.5-40T720-420q0-60-46.5-100T564-560H312l104 104-56 56-200-200 200-200 56 56-104 104h252q97 0 166.5 63T800-420q0 94-69.5 157T564-200H280Z" />
                                        </svg>
                                    </button>
                                </div>
                            </label>
                            <label class="form-control w-full md:w-72" id="password-control">
                                <div class="label">
                                    <span class="label-text">Password</span>
                                </div>
                                <div class="flex gap-3">
                                    <input type="password" placeholder="********" id="password" name="password" class="input input-bordered w-full " disabled />
                                    <button type="button" class="btn btn-square btn-outline" id="password-button" onclick="editPassword('password-button', 'password')">
                                        <svg class="edit-icon fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                                            <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                                        </svg>
                                        <svg class="hidden undo-icon fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                                            <path d="M280-200v-80h284q63 0 109.5-40T720-420q0-60-46.5-100T564-560H312l104 104-56 56-200-200 200-200 56 56-104 104h252q97 0 166.5 63T800-420q0 94-69.5 157T564-200H280Z" />
                                        </svg>
                                    </button>
                                </div>
                            </label>
                            <label class="form-control w-full md:w-72 hidden" id="retype-password-control">
                                <div class="label">
                                    <span class="label-text">Retype password</span>
                                </div>
                                <div class="flex gap-3">
                                    <input type="password" placeholder="********" id="retype-password" name="retype_password" class="input input-bordered w-full " disabled />
                                    <div class="w-14"></div>
                                </div>
                            </label>
                            <div class="mt-3 ml-auto w-full md:w-32">
                                <input class="btn btn-outline w-full" type="submit" value="Save changes">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const profileUrl = '<?php echo './uploads' . $userDetails['avatar_url'] ?>';

        function showPlaceholder() {
            const avatar = document.querySelector('#avatar');
            avatar.classList.remove('block');
            avatar.classList.add('hidden');

            const placeholder = document.querySelector('#placeholder');
            placeholder.classList.remove('hidden');
            placeholder.classList.add('block');
        }

        function showAvatar(src) {
            const avatar = document.querySelector('#avatar');
            avatar.classList.remove('hidden');
            avatar.classList.add('block');

            const placeholder = document.querySelector('#placeholder');
            placeholder.classList.remove('block');
            placeholder.classList.add('hidden');
            if (src) {
                console.log(src)
                const preview = document.querySelector("#avatar-preview");
                preview.src = src;
            }
        }
        if (!!profileUrl) {
            showAvatar(profileUrl);
        } else {
            showPlaceholder();
        }
    </script>

</body>

</html>