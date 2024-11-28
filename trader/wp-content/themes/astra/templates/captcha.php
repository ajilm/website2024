<?php
session_start();

// Generate a random string
$random_string = substr(md5(rand()), 0, 6);

// Store the string in the session
$_SESSION['captcha'] = $random_string;

// Create the image
$image = imagecreatetruecolor(120, 30);

// Allocate colors
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

// Fill the background
imagefilledrectangle($image, 0, 0, 120, 30, $bg_color);

// Add some lines to make it harder for bots to read
for ($i = 0; $i < 5; $i++) {
    $line_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imageline($image, rand(0, 120), rand(0, 30), rand(0, 120), rand(0, 30), $line_color);
}

// Add the text
imagettftext($image, 20, 0, 10, 25, $text_color, 'arial.ttf', $random_string);

// Output the image
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);