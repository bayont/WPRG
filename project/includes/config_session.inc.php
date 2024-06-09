<?php

// uncomment earlier
/* ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'samesite' => 'Strict',
    'secure' => false,
    'httponly' => true,
    'domain' => '*',
    'path' => '/',
]);
 */
session_start();

if (!isset($_SESSION['last_regenerated'])) {
    regenerate_session_id();
} else {
    $interval = 60 * 30; // 30 minutes
    if ($_SESSION['last_regenerated'] < time() - $interval) {
        regenerate_session_id();
    }
}


function regenerate_session_id()
{
    session_regenerate_id();
    $_SESSION['last_regenerated'] = time();
}
