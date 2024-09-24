// Thay đổi trang đăng nhập

/*
//Thay đổi url đăng nhập wordpress
add_filter( 'login_url', 'jav_login_url', 10, 2);
function jav_login_url( $force_reauth, $redirect ){
$login_url = 'xxx';
if ( !empty($redirect) )
$login_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $login_url );
if ( $force_reauth )
$login_url = add_query_arg( 'reauth', '1', $login_url ) ;
return $login_url ;
}
*/

//Chuyển hướng website sau khi đăng nhập thành công
add_action( 'login_redirect', 'jav_login_redirect');
function jav_login_redirect(){
return home_url('/');
}



//Thay đổi ảnh logo
add_action( 'login_enqueue_scripts', 'jav_login_enqueue_scripts' );
function jav_login_enqueue_scripts(){
echo '<style type="text/css" media="screen">';
echo '#login h1 a
{
background-image:url(https://github.com/akira6789/wp-admin-login-style/blob/main/logo-wide-web-gia-re.png?raw=true/images/logo-wide-web-gia-re.png);
;';
echo '</style>';
}

//Thay đổi url ảnh logo
add_filter( 'login_headerurl', 'jav_login_headerurl');
function jav_login_headerurl(){
return home_url('/');
}


//Thay đổi tiêu đề ảnh logo
add_filter( 'login_headertext', 'login_logo_url_title' );
function login_logo_url_title() {
return 'Akira Mobile';
}


//Tùy chỉnh CSS cho trang đăng nhập Wordpress
function login_css() {
wp_enqueue_style( 'login_css','https://github.com/akira6789/wp-admin-login-style/raw/refs/heads/main/login.css' ); 
}
add_action('login_head', 'login_css');

# chi admin mới vào được trang quản trị
function jav_restrict_admin_access() {
    if (is_user_logged_in()) {
        if (is_admin() && !defined('DOING_AJAX') && !current_user_can('administrator')) {
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('admin_init', 'jav_restrict_admin_access');
