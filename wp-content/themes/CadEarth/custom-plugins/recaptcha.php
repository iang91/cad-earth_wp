<?php
function my_recaptcha_key(){
    $sitekey= "";
    $secretkey= "";
    return explode(",", $sitekey.",".$secretkey );  
}





/*
*Add reCAPTCHA to WordPress Comment Section
*/
add_action( 'wp_head', function(){
wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js');
} );
function add_google_recaptcha($submit_field) {
    $submit_field['submit_field'] = '<div class="g-recaptcha brochure__form__captcha" data-sitekey="'.my_recaptcha_key()[0].'"></div><br>' . $submit_field['submit_field'];
    return $submit_field;
}
if (!is_user_logged_in()) {
    add_filter('comment_form_defaults','add_google_recaptcha');
}
function is_valid_captcha($captcha) {
$captcha_postdata = http_build_query(array(
                            'secret' => my_recaptcha_key()[1],
                            'response' => $captcha,
                            'remoteip' => $_SERVER['REMOTE_ADDR']));
$captcha_opts = array('http' => array(
                      'method'  => 'POST',
                      'header'  => 'Content-type: application/x-www-form-urlencoded',
                      'content' => $captcha_postdata));
$captcha_context  = stream_context_create($captcha_opts);
$captcha_response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify" , false , $captcha_context), true);
if ($captcha_response['success'])
    return true;
else
    return false;
}
 
function verify_google_recaptcha() {
$recaptcha = $_POST['g-recaptcha-response'];
if (empty($recaptcha))
    wp_die( __("<b>ERROR:</b> please select <b>I'm not a robot!</b><p><a href='javascript:history.back()'>« Back</a></p>"));
else if (!is_valid_captcha($recaptcha))
    wp_die( __("<b>Go away SPAMMER!</b>"));
}
if (!is_user_logged_in()) {
    add_action('pre_comment_on_post', 'verify_google_recaptcha');
}






/*
*Add reCaptcha on WordPress Admin Login Page Without Plugin
*/

function login_style() {
    wp_register_script('login-recaptcha', 'https://www.google.com/recaptcha/api.js', false, NULL);
    wp_enqueue_script('login-recaptcha');
    echo "<style>p.submit, p.forgetmenot {margin-top: 10px!important;}.login form{width: 303px;} div#login_error {width: 322px;}</style>";
}
add_action('login_enqueue_scripts', 'login_style');
function add_recaptcha_on_login_page() {
    echo '<div class="g-recaptcha brochure__form__captcha" data-sitekey="'.my_recaptcha_key()[0].'"></div>';
}
add_action('login_form','add_recaptcha_on_login_page');
add_action('woocommerce_login_form', 'add_recaptcha_on_login_page');

function captcha_login_check($user, $password) {
    if (!empty($_POST['g-recaptcha-response'])) {
        $secret = my_recaptcha_key()[1];
        $ip = $_SERVER['REMOTE_ADDR'];
        $captcha = $_POST['g-recaptcha-response'];
        $rsp = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha .'&remoteip='. $ip);
        $valid = json_decode($rsp, true);
        if ($valid["success"] == true) {
            return $user;
        } else {
            return new WP_Error('Captcha Invalid', __('<center>Captcha Invalid! Please check the captcha!</center>'));
        }
    } else {
        return new WP_Error('Captcha Invalid', __('<center>Captcha Invalid! Please check the captcha!</center>'));
    }
}
add_action('wp_authenticate_user', 'captcha_login_check', 10, 2);







/*
*Add reCaptcha to Lost Password Form Without Plugin
*/
function recaptcha() {
    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    echo '<div class="g-recaptcha brochure__form__captcha" data-sitekey="'.my_recaptcha_key()[0].'"></div>';
    echo '<style>p.message {width: 324px;}</style>';
}
add_action('lostpassword_form', 'recaptcha');
add_action('woocommerce_lostpassword_form', 'recaptcha');

function captcha_lostpassword_check($errors) {
    if (!empty($_POST['g-recaptcha-response'])) {
        $secret = my_recaptcha_key()[1];
        $ip = $_SERVER['REMOTE_ADDR'];
        $captcha = $_POST['g-recaptcha-response'];
        $rsp = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha .'&remoteip='. $ip);
        $valid = json_decode($rsp, true);
        if ($valid["success"] == true) {
           
        } else {
            $errors->add('Captcha Invalid', __('Captcha Invalid! Please check the captcha!'));
        }
    } else {
        $errors->add('Captcha Invalid', __('Captcha Invalid! Please check the captcha!'));
    }
}
add_action( 'lostpassword_post', 'captcha_lostpassword_check', 10, 1 );








/*
*Protect WordPress Site Registration Form with reCaptcha
*/
function recaptcha_register_form() {
    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    echo '<div class="g-recaptcha brochure__form__captcha" data-sitekey="'.my_recaptcha_key()[0].'"></div>';
    echo'<style>p.message.register {
    width: 324px;
}</style>';
}
add_action('register_form', 'recaptcha_register_form');
add_action('woocommerce_register_form', 'recaptcha_register_form');

function captcha_registration_check($errors, $user_login, $user_email) {
    if (!empty($_POST['g-recaptcha-response'])) {
        $secret = my_recaptcha_key()[1];
        $ip = $_SERVER['REMOTE_ADDR'];
        $captcha = $_POST['g-recaptcha-response'];
        $rsp = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha .'&remoteip='. $ip);
        $valid = json_decode($rsp, true);
        if ($valid["success"] == true) {
            return $errors;
        } else {
            return new WP_Error('Captcha Invalid', __('Captcha Invalid! Please check the captcha!'));
        }
    } else {
        return new WP_Error('Captcha Invalid', __('Captcha Invalid! Please check the captcha!'));
    }
}
add_action('registration_errors', 'captcha_registration_check', 10, 3);

?>