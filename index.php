<?php
/*
Plugin Name: Đặt Phòng Khách Sạn
Plugin URI: http://namdeptrai.net
Description: Plugin dùng để Đặt phòng, đặt bàn, đặt dự án,... được phát triển bởi Nguyễn Nhất Nam
Author: Nhất Nam
Version: 0.1
Author URI: http://namdeptrai.net
*/
function plugin_name_activation() {
    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    global $wpdb;
    $hotelllmutilsite = $wpdb->prefix. 'datphong';
    if( $wpdb->get_var( "SHOW TABLES LIKE '$hotelllmutilsite'" ) != $hotelllmutilsite ) {
        if ( ! empty( $wpdb->charset ) )
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        if ( ! empty( $wpdb->collate ) )
            $charset_collate .= " COLLATE $wpdb->collate";
 
        $sql = "CREATE TABLE " . $hotelllmutilsite . " (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `email` varchar(100) NOT NULL DEFAULT '',
            `room` varchar(100) NOT NULL DEFAULT '',
            `people` int NOT NULL DEFAULT 1,
            `people1` int NOT NULL DEFAULT 1,
            `get1` varchar(100) NOT NULL DEFAULT '',
            `out1` varchar(100) NOT NULL DEFAULT '',
            PRIMARY KEY (`id`)
        ) $charset_collate;";
        dbDelta( $sql );
    }
}
register_activation_hook(__FILE__, 'plugin_name_activation');

function xuatnoidung() {    
  // set new option    
  add_option('noidunghtml', 'Plugin Đặt Hàng', '', '');
}
function print_noidunghtml() {  
  $msg = get_option('noidunghtml'); 
  echo '<div id="reservation-form">
            <div class="container" ng-app="">
                <div class="row">
                    <div class="res-z-index"><div style="color:#cab193;background-color:#967f63;overflow:hidden;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;font-size:13px;font-weight:700;display:inline-block;position:relative;line-height:20px;transition:color 300ms;-moz-transition:color 300ms;-o-transition:color 300ms;-webkit-transition:color 300ms;width:100%;"><p style="padding-left: 15px;     padding-top: 15px;
    color: #fff;">1. Danh sách phòng khả dụng</p></div>
                      <div class="form-inline reservation-horizontal clearfix ng-valid ng-dirty ng-valid-parse" style="background-color: rgba(245, 245, 245, 0.49);;text-align: center;
    padding: 10px;
    margin-bottom: 25px;">';do_shortcode('[home_contenttfull]'); echo'</div>

    <div style="color:#cab193;background-color:#967f63;overflow:hidden;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;font-size:13px;font-weight:700;display:inline-block;position:relative;line-height:20px;transition:color 300ms;-moz-transition:color 300ms;-o-transition:color 300ms;-webkit-transition:color 300ms;width:100%;"><p style="padding-left: 15px;     padding-top: 15px; 
    color: #fff;">2. Đơn Đặt Phòng</p></div>
                        <form style="background-color: rgba(245, 245, 245, 0.49);;text-align: center;
    padding: 10px;
    margin-bottom: 25px;" class="form-inline reservation-horizontal clearfix" role="form" method="post" action="/../wp-content/plugins/khachsan/xuli.php" name="reservationform" id="reservationform">

                            <!-- Error message -->
                            <div id="message"></div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="email" accesskey="E">E-mail</label>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Please fill in your email"><i class="fa fa-info-circle fa-lg"> </i></div>
                                        <input style="background: #fff;" name="email" ng-model="email" type="text" id="email" value="" class="form-control" placeholder="Nhập địa chỉ Email"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="room">Chọn Phòng</label>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Please select a room"><i class="fa fa-info-circle fa-lg"> </i></div>
                                        <input class="form-control" ng-model="room" name="room" id="room" value="" placeholder="Nhập Tên Phòng">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <div class="guests-select">
                                            <label>Số người</label>
                                            <i class="fa fa-user infield"></i>
                                            <div class="total form-control" id="test">1</div>
                                            <div class="guests">
                                                <div class="form-group adults">
                                                    <label for="adults">Người lớn</label>
                                                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="+18 years">
                                                        <i class="fa fa-info-circle fa-lg"> </i>
                                                    </div>
                                                    <select ng-model="people" name="adults" id="adults" class="form-control">
                                                        <option value="1">1 Người lớn</option>
                                                        <option value="2">2 Người lớn</option>
                                                        <option value="3">3 Người lớn</option>
                                                    </select>
                                                </div>
                                                <div class="form-group children">
                                                    <label for="children">Trẻ em</label>
                                                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="0 till 18 years">
                                                        <i class="fa fa-info-circle fa-lg"> </i>
                                                    </div>
                                                    <select ng-model="people1" name="children" id="children" class="form-control">
                                                        <option value="0">0 Trẻ em</option>
                                                        <option value="1">1 Trẻ em</option>
                                                        <option value="2">2 Trẻ em</option>
                                                        <option value="3">3 Trẻ em</option>
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-default button-save btn-block">Save</button>
                                            </div>
                                        </div></div>
                                    </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="checkin">Ngày Vào</label>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"><i class="fa fa-info-circle fa-lg"> </i></div>
                                        <i class="fa fa-calendar infield"></i>
                                        <input ng-model="get1" name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Ngày Vào"/>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="checkout">Ngày Ra</label>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"><i class="fa fa-info-circle fa-lg"> </i></div>
                                        <i class="fa fa-calendar infield"></i>
                                        <input ng-model="out1" name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Ngày Ra"/>
                                    </div>
                                </div>
                                
                                </div>
                                </div>
                        <div style="color:#cab193;background-color:#967f63;overflow:hidden;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;font-size:13px;font-weight:700;display:inline-block;position:relative;line-height:20px;transition:color 300ms;-moz-transition:color 300ms;-o-transition:color 300ms;-webkit-transition:color 300ms;width:100%;"><p style="padding-left: 15px;     padding-top: 15px; 
    color: #fff;" >3. Kiểm tra đơn hàng</p></div>
<div class="form-inline reservation-horizontal clearfix ng-valid ng-dirty ng-valid-parse" style="background-color: rgba(245, 245, 245, 0.49);;text-align: center;
    padding: 10px;
    margin-bottom: 25px;">
<div class="row">
  <div class="col-sm-4" style="color:#111; font-size:15px; font-weight:600; 
    border-bottom: 1px solid #ddd;">Email</div>
  <div class="col-sm-2" style="color:#111; font-size:15px; font-weight:600; 
    border-bottom: 1px solid #ddd;">Phòng</div>
  <div class="col-sm-2" style="color:#111; font-size:15px; font-weight:600; 
    border-bottom: 1px solid #ddd;">Ngày vào</div>
 <div class="col-sm-2" style="color:#111; font-size:15px; font-weight:600; 
    border-bottom: 1px solid #ddd;">Ngày ra</div>
  <div class="col-sm-1" style="color:#111; font-size:15px; font-weight:600; 
    border-bottom: 1px solid #ddd;">N. lớn</div>
  <div class="col-sm-1" style="color:#111; font-size:15px; font-weight:600; 
    border-bottom: 1px solid #ddd;">Trẻ em</div></div><div class="row">
  <div class="col-sm-4">{{email}}</div>
  <div class="col-sm-2">{{room}}</div>
  <div class="col-sm-2">{{get1}}</div>
 <div class="col-sm-2">{{out1}}</div>
  <div class="col-sm-1">{{people}}</div>
  <div class="col-sm-1">{{people1}}</div></div>
                    </div>
<div style="color:#cab193;background-color:#967f63;overflow:hidden;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;font-size:13px;font-weight:700;display:inline-block;position:relative;line-height:20px;transition:color 300ms;-moz-transition:color 300ms;-o-transition:color 300ms;-webkit-transition:color 300ms;width:100%;"><p style="padding-left: 15px;     padding-top: 15px; 
    color: #fff;">4. Đặt Phòng</p></div>
<div class="form-inline reservation-horizontal clearfix ng-valid ng-dirty ng-valid-parse" style="background-color: rgba(245, 245, 245, 0.49);;text-align: center;
    padding: 10px;
    margin-bottom: 25px;">
<div class="col-sm-12"><p style="text-align:left">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi, để hoàn thành đơn đặt phòng, vui lòng kiểm tra lại thông tin đơn đặt hàng ở bước 3. Sau đó, hãy chắc chắn không có vấn đề gì xảy ra và vui lòng ấn vào nút "ĐẶT PHÒNG !!" Để hoàn thành Đơn đặt phòng</p>

                                    <button type="submit" class="btn btn-primary" name="submit">Đặt Phòng!!</button>
                                </div></form></div>


                    </div>
                </div>
            </div>
        </div>';
		
}
add_shortcode('shortcode_datphong', 'print_noidunghtml');

register_activation_hook(__FILE__, 'xuatnoidung');

/*Nap CSS vào theme*/
add_action('wp_enqueue_scripts','Mythemss_register_style');
function Mythemss_register_style(){
  $cssUrl = get_template_directory_uri() . '/../../plugins/khachsan/css';

  wp_register_style('My_theme_anine', $cssUrl . '/animate.css');
  wp_enqueue_style('My_theme_anine');


  wp_register_style('My_theme_bt', $cssUrl . '/bootstrap.css');
  wp_enqueue_style('My_theme_bt');


  wp_register_style('My_theme_font', $cssUrl . '/font-awesome.min.css');
  wp_enqueue_style('My_theme_font');

  wp_register_style('My_theme_owlc', $cssUrl . '/owl.carousel.css');
  wp_enqueue_style('My_theme_owlc');


  wp_register_style('My_theme_owlt', $cssUrl . '/owl.theme.css');
  wp_enqueue_style('My_theme_owlt');

  wp_register_style('My_theme_jq', $cssUrl . '/jquery-ui-1.10.4.custom.min.css');
  wp_enqueue_style('My_theme_jq');


  wp_register_style('My_theme_rstyle', $cssUrl . '/theme.css');
  wp_enqueue_style('My_theme_rstyle');


  wp_register_style('My_theme_responsive', $cssUrl . '/responsive.css');
  wp_enqueue_style('My_theme_responsive');


  wp_register_style('My_theme_form', $cssUrl . '/form.css');
  wp_enqueue_style('My_theme_form');

}
/*Nap js vào theme*/
add_action('wp_enqueue_scripts','Mythemss_register_js');
function Mythemss_register_js(){
  $jsUrl = get_template_directory_uri() . '/../../plugins/khachsan/js';


  wp_register_script('My_theme_jqp', $jsUrl . '/jquery.js');
  wp_enqueue_script('My_theme_jqp');

  wp_register_script('My_theme_jq', $jsUrl . '/jquery-migrate.min.js');
  wp_enqueue_script('My_theme_jq');

  wp_register_script('My_theme_pun', $jsUrl . '/jquery.themepunch.tools.min.js');
  wp_enqueue_script('My_theme_pun');


  wp_register_script('My_theme_rev', $jsUrl . '/jquery.themepunch.revolution.min.js');
  wp_enqueue_script('My_theme_rev');


  wp_register_script('My_theme_btstt', $jsUrl . '/bootstrap.min.js');
  wp_enqueue_script('My_theme_btstt');


  wp_register_script('My_theme_btst', $jsUrl . '/bootstrap-hover-dropdown.min.js');
  wp_enqueue_script('My_theme_btst');


  wp_register_script('My_theme_par', $jsUrl . '/jquery.parallax-1.1.3.js');
  wp_enqueue_script('My_theme_par');


  wp_register_script('My_theme_sc', $jsUrl . '/jquery.nicescroll.js');
  wp_enqueue_script('My_theme_sc');


  wp_register_script('My_theme_pre', $jsUrl . '/jquery.prettyPhoto.js');
  wp_enqueue_script('My_theme_pre');


  wp_register_script('My_theme_jqq', $jsUrl . '/jquery-ui-1.10.4.custom.min.js');
  wp_enqueue_script('My_theme_jqq');

  wp_register_script('My_theme_cystomdt', $jsUrl . '/data.js');
  wp_enqueue_script('My_theme_cystomdt');


  wp_register_script('My_theme_cystom', $jsUrl . '/custom.js');
  wp_enqueue_script('My_theme_cystom');

  wp_register_script('My_theme_angular', $jsUrl . '/angular.min.js');
  wp_enqueue_script('My_theme_angular');
}
function add_admin_menu()
{
    add_menu_page (
            'Đơn Đặt Phòng', 
            'Đơn Đặt Phòng', 
            'manage_options', 
            'plugin-namdeptrai', 
            'show_plugin_options', 
            'http://Haivl.dev/wp-content/uploads/2016/10/man-with-tie.png', 
            '7'
    );
}
 
function show_plugin_options()
{
echo '
<div class="updated notice-info">
  <h1 align="center">Thông tin các đơn đặt hàng của khách</h1></div>
  <div class="updated notice-info" ng-app="myModule" > 
<form>
  Mời bạn lựa chọn:<br />
  <input type="radio" ng-model="myVar" value="dogs">Xem dạng Table
  <input type="radio" ng-model="myVar" value="tuts">Xem dạng List
  || Hoặc có thể 
  <button><a href="/../wp-content/plugins/khachsan/data.json">Tải xuống</a></button>
</form>
  ';?>
<?php
global $wpdb;
$query = "SELECT * FROM {$wpdb->prefix}datphong";
  $rows = $wpdb->get_results($query);
  foreach($rows as $datphong)
  {
      echo '
<div ng-switch="myVar">
  <div ng-switch-when="dogs">
      <div class="updated notice-info" style="
    line-height: 2;
    padding-top: 5px;
    padding-bottom: 10px;
"><div id="sidebar" class="widgets-sortables"><b>ID:</b> '.$datphong->id.'</div><div id="sidebar" class="widgets-sortables"><b>Mail Khách:</b> '.$datphong->email.'</div><div id="sidebar" class="widgets-sortables"><b>Phòng đặt:</b> '.$datphong->room.'</div><div id="sidebar" class="widgets-sortables"><b>Người lớn:</b> '.$datphong->people.'</div><div id="sidebar" class="widgets-sortables"><b>Trẻ em:</b> '.$datphong->people1.'</div><div id="sidebar" class="widgets-sortables"><b>Ngày Vô:</b> '.$datphong->get1.'</div><div id="sidebar" class="widgets-sortables"><b>Ngày ra:</b> '.$datphong->out1.'</div></div><hr style="width:50%;"/></div>
  <div ng-switch-when="tuts">

  <div class="updated notice-info" ng-controller="myController">

<table style="border: 1px solid #ddd;
    width: 100%;">
    <thead style="background-color: #ddd;">
      <tr>
        <th>Email</th>
        <th>Phòng</th>
        <th>Người Lớn</th>
        <th>Trẻ Em</th>
        <th>Ngày vào</th>
        <th>Ngày ra</th>
      </tr>
    </thead>
    <tbody>
       <tr ng-repeat="x in names">
    <td style="border: 1px solid #ddd;">
    {{ x.email }}</td>
    <td style="border: 1px solid #ddd;">
    {{ x.room }}</td>
    <td style="border: 1px solid #ddd;">
    {{ x.people}}</td>
    <td style="border: 1px solid #ddd;">
    {{ x.people1}}</td>
    <td style="border: 1px solid #ddd;">
    {{ x.get1}}</td>
    <td style="border: 1px solid #ddd;">
    {{ x.out1}}</td>
  </tr>
  </tbody>
</table>
  </div>

  </div></div>
';
  }
?><?php 
echo "<script src='/../wp-content/plugins/khachsan/js/angular.min.js'>";  
echo "</script>";
?>
<?php 
echo "<script>";
echo ' //create a module
var myApp = angular.module(\'myModule\', []);
//create a controller
myApp.controller("myController", function($scope, $http){
  $http.get("/../wp-content/plugins/khachsan/data.json")
  .then(function (response) {
    $scope.names = response.data;});
});';  
echo "</script>";
?>

<?php echo'</div>';
}
 
add_action('admin_menu', 'add_admin_menu');



function tao_custom_post_type()
{
 
    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Phòng Khách Sạn', //Tên post type dạng số nhiều
        'singular_name' => 'Phòng Khách Sạn' //Tên post type dạng số ít
    );
 
    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type đăng sản phẩm', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array( 'category', 'post_tag' ), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'http://Haivl.dev/wp-content/uploads/2016/10/man-with-tie.png', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
 
    register_post_type('phongkhachsan', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên
 
}
/* Kích hoạt hàm tạo custom post type */
add_action('init', 'tao_custom_post_type');

//Khởi tạo function cho shortcode
function homecontentt() {
$myposts = new WP_Query(array('posts_per_page' => 6, 'post_status' => 'publish', 'post_type' => array( 'phongkhachsan')));
if($myposts->have_posts()) {
    while($myposts->have_posts()) {
        $myposts->the_post();
    echo'<p>';
echo'<div class="col-sm-4">';
echo'<div style="float: left;width: 100%;overflow: hidden">';
the_post_thumbnail( array(350,200) ); 
echo '</div><br /><div style="display: block;
    line-height: 21px;
    padding: 0 10px;
    margin-bottom: 15px;
    clear: both;
    text-align:center;
    padding-top: 5px;">';
echo'<a href="';the_permalink();echo'" style="color: #111;
    font-weight: 600;
    font-size: 15px;">';the_title();echo'</a>';
echo '</div></div>';
} 
    wp_reset_postdata();
}
}
add_shortcode( 'home_contentt', 'homecontentt' );


//Khởi tạo function cho shortcode
function homecontenttfull() {
$myposts = new WP_Query(array('posts_per_page' => 1000, 'post_status' => 'publish', 'post_type' => array( 'phongkhachsan')));
if($myposts->have_posts()) {
    while($myposts->have_posts()) {
        $myposts->the_post();
    echo'<p>';
echo'<div class="col-sm-4">';
echo'<div style="float: left;width: 100%;overflow: hidden">';
the_post_thumbnail( array(350,200) ); 
echo '</div><br /><div style="display: block;
    line-height: 21px;
    padding: 0 10px;
    margin-bottom: 15px;
    clear: both;
    text-align:center;
    padding-top: 5px;">';
echo'<a href="';
the_permalink();echo'" style="color: #111;
    font-weight: 600;
    font-size: 15px;">';the_title();echo'</a>';
echo '</div></div>';
} 
    wp_reset_postdata();
}
}
add_shortcode( 'home_contenttfull', 'homecontenttfull' );

?>