<?php
require_once('wp-load.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $captcha = $_POST['captcha'];

    if ($captcha !== $_SESSION['captcha']) {
        echo 'Error: Invalid CAPTCHA';
        exit;
    }

    if ($action === 'login') {
        $username = sanitize_user($_POST['username']);
        $password = $_POST['password'];

        $user = wp_signon(array(
            'user_login' => $username,
            'user_password' => $password,
            'remember' => true
        ));

        if (is_wp_error($user)) {
            echo 'Error: ' . $user->get_error_message();
        } else {
            echo 'Login successful. Redirecting...';
        }
    } elseif ($action === 'register') {
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            echo 'Error: ' . $user_id->get_error_message();
        } else {
            echo 'Registration successful. You can now login.';
        }
    } else {
        echo 'Invalid action.';
    }
} else {
    echo 'Invalid request method.';
}

// Generate a new CAPTCHA for the next attempt
$_SESSION['captcha'] = substr(md5(rand()), 0, 6);