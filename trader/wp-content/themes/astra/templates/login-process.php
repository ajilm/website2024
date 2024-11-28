<?php
require_once('wp-load.php');

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];
    $email = sanitize_email($_POST['email']);

    if ($action === 'login') {
        $user = wp_authenticate($username, $password);

        if (is_wp_error($user)) {
            $response['status'] = 'error';
            $response['message'] = 'Invalid username or password.';
        } else {
            wp_set_auth_cookie($user->ID);
            $response['status'] = 'success';
            $response['message'] = 'Login successful. Redirecting...';
        }
    } elseif ($action === 'register') {
        if (!username_exists($username) && !email_exists($email)) {
            $user_id = wp_create_user($username, $password, $email);

            if (is_wp_error($user_id)) {
                $response['status'] = 'error';
                $response['message'] = 'Registration failed. Please try again.';
            } else {
                wp_set_auth_cookie($user_id);
                $response['status'] = 'success';
                $response['message'] = 'Registration successful. Redirecting...';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Username or email already exists.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid action.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);