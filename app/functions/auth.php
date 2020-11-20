<?php


function is_logged_in(): bool
{

        if ($_SESSION) {
            $db_data = file_to_array(DB_FILE);

            foreach ($db_data as $entry) {

                if ($entry['email'] === $_SESSION['email']
                    && $entry['password'] === $_SESSION['password']) {

                    return true;
                }
            }
        }

    return false;
}

/**
 * Function ends the session
 *
 * @param null $redirect
 */
function logout($redirect = null): void
{
    $_SESSION = [];
    session_destroy();
    if ($redirect) {
        header("Location: $redirect");
    }
}


/**
 * Check if user just registered
 *
 * @return bool
 */
function is_registered(): bool
{
    if ($_SESSION) {
        $db_data = file_to_array(DB_FILE);

        foreach ($db_data as $db_entry) {
            if ($_SESSION['email'] === $db_entry['email']
                && $_SESSION['password'] === $db_entry['password']) {

                return true;
            }
        }
    }

    return false;
