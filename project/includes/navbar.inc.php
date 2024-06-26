<div class="navbar bg-base-200">
    <div class="flex-1">
        <a class="btn btn-ghost text-xl font-specific" href="/">Quizconst</a>
    </div>
    <div class="flex-none flex gap-4">
        <?php
        if (isset($_SESSION['user_id'])) {
            require_once './classes/profile/profile.class.php';
            require_once './classes/profile/profile-view.class.php';
            $profileView = new ProfileView();

            $userDetails = $profileView->getPublicProfileDetails($_SESSION['user_id']);
            echo '
            <a role="button" class="btn btn-ghost" href="./add-quiz.php">
                Add quiz
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                </svg>
            </a>
            <details class="dropdown dropdown-bottom dropdown-end">
                    <summary tabindex="0" role="button" class="flex items-center gap-3 btn btn-ghost">
                        <div class="hidden md:flex flex-col justify-center text-left h-full select-none">
                            <div class="text-xs font-specific">Welcome!</div>
                            <div class="font-semibold text-primary leading-3">' . htmlspecialchars($userDetails['user_name']) . '</div>
                        </div>
                        ' .
                (isset($userDetails['avatar_url']) ? '<div class="avatar">
                            <div class="w-10 rounded-full">
                                <img src="' . $userDetails['avatar_url'] . '" />
                            </div>
                        </div>' : '<div class="avatar placeholder">
                            <div class="bg-primary text-primary-content rounded-full w-10">
                                <span>' . strtoupper(substr($userDetails['user_name'], 0, 1)) . '</span>
                            </div>
                        </div>')
                . '
                        
                    </summary>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-52 mt-3">
                        <li><a>My quizes</a></li>
                        <li><a href="/profile.php">Profile</a></li>
                        <li><a href="/logout.php">Logout</a></li>
                    </ul>
        </details>
        ';
        } else {
            echo '<a role="button" class="btn btn-ghost" href="/login.php">Login</a>';
        }
        ?>

    </div>
</div>