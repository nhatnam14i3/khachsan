<?php
function wp_path()
    {
    if (strstr($_SERVER["SCRIPT_FILENAME"], "/wp-content/"))
        {
        return preg_replace("/\/wp-content\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
        }
    return preg_replace("/\/[^\/]+?\/themes\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
    }
require wp_path() . "/wp-load.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Error messages
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    if(isset($_POST['room'])){ $room = $_POST['room']; }
    $adults = $_POST['adults'];
    $children = $_POST['children'];
// Khởi tạo biến toàn cục
    global $wpdb;
    $data = array(
            "email"   => $email,
            "room" => $room,
            "people" => $adults,
            "people1" => $children,
            "get1"  => $checkin, 
            "out1"  => $checkout
    );
    
    $format = array("%s", "%s", "%d", "%d", "%s", "%s");
 
    // Phương thức thêm mới dòng dữ liệu vào table
    $info = $wpdb->insert($wpdb->prefix .'datphong', $data, $format);
    


    $message = '';  
    $error = '';  
    if(file_exists('data.json'))  
           {  
                $current_data = file_get_contents('data.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'email'               =>     $_POST['email'],  
                     'room'          =>     $_POST["room"],  
                     'people'          =>     $_POST["adults"],  
                     'people1'          =>     $_POST["children"],  
                     'get1'          =>     $_POST["checkin"],  
                     'out1'     =>     $_POST["checkout"]  
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('data.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Success fully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  


    
    /*
    echo "<pre>";
       print_r($info);
    echo "</pre>";  
    ?>*/
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        
 echo'<div id="myModal" style=" display: none; 
    position: fixed; 
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);">

  <div style="position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s">
    <div style="padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <span class="close" style="cursor: pointer;color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;">X</span>
      <h2>Đặt phòng thành công!!</h2>
    </div>
    <div style="padding: 2px 16px;">
      <p>Rất tiếc! Dường như có vấn đề khi bạn nhập địa chỉ email. </p>
      <p>Xin hãy kiếm tra lại!</p>
    </div>
    <div style=" padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <h3>Failled !! Please check Email again</h3>
    </div>
  </div>

</div>';

echo '<script>';
echo'var modal = document.getElementById(\'myModal\');
var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";

span.onclick = function() {
    window.history.back();
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}';
echo '</script>';
        exit();
    }
    else
        if (isset($room) == '')
        {
           echo'<div id="myModal" style=" display: none; 
    position: fixed; 
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);">

  <div style="position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s">
    <div style="padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <span class="close" style="cursor: pointer;color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;">X</span>
      <h2>Đặt phòng thành công!!</h2>
    </div>
    <div style="padding: 2px 16px;">
      <p>Rất tiếc! Dường như có vấn đề khi bạn nhập tên Phòng. </p>
      <p>Xin hãy kiếm tra lại!</p>
    </div>
    <div style=" padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <h3>Failled !! Please check ROOM again</h3>
    </div>
  </div>

</div>';

echo '<script>';
echo'var modal = document.getElementById(\'myModal\');
var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";

span.onclick = function() {
    window.history.back();
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}';
echo '</script>';
            exit();
        }
        else
            if (trim($checkin) == '')
            {
                echo'<div id="myModal" style=" display: none; 
    position: fixed; 
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);">

  <div style="position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s">
    <div style="padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <span class="close" style="cursor: pointer;color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;">X</span>
      <h2>Đặt phòng thành công!!</h2>
    </div>
    <div style="padding: 2px 16px;">
      <p>Rất tiếc! Dường như có vấn đề khi bạn nhập ngày bắt đầu. </p>
      <p>Xin hãy kiếm tra lại!</p>
    </div>
    <div style=" padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <h3>Failled !! Please check date again</h3>
    </div>
  </div>

</div>';

echo '<script>';
echo'var modal = document.getElementById(\'myModal\');
var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";

span.onclick = function() {
    window.history.back();
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}';
echo '</script>';
                exit();
            }
            else
                if (trim($checkout) == '')
                {
                    echo'<div id="myModal" style=" display: none; 
    position: fixed; 
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);">

  <div style="position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s">
    <div style="padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <span class="close" style="cursor: pointer;color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;">X</span>
      <h2>Đặt phòng thành công!!</h2>
    </div>
    <div style="padding: 2px 16px;">
      <p>Rất tiếc! Dường như có vấn đề khi bạn nhập Ngày kết thúc. </p>
      <p>Xin hãy kiếm tra lại!</p>
    </div>
    <div style=" padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <h3>Failled !! Please check date again</h3>
    </div>
  </div>

</div>';

echo '<script>';
echo'var modal = document.getElementById(\'myModal\');
var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";

span.onclick = function() {
    window.history.back();
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}';
echo '</script>';
                    exit();
                }
    // Your e-mailadress.
    $recipient = $sh_redux['nhatnam14i3@gmail.com'];
    // Mail subject
    $subject = esc_html__("Chào admin! Bạn có một khách hàng đã đặt phòng với mail: $email", 'starhotel' );
    // Mail content
    $email_content = esc_html__("Chào admin! Bạn có một khách hàng đã đặt phòng với mail: $email

Khách hàng họ muốn bắt đầu ở vào ngày: $checkin 
và kết thúc ở vào ngày: $checkout

Khách hàng đã đặt phòng $room với số người lớn $adults và số trẻ em $children .

Admin có thể liên hệ lại với khách hàng qua địa chỉ email, $email và admin cũng có thể xem thông tin đặt phòng này tại trang quản trị wordpress của mình ^^
", 'starhotel' );

    // Mail headers
    $email_headers = "From: $name <$email>";
    // Main messages
    if (mail($recipient, $subject, $email_content, $email_headers))
    {
	echo'<div id="myModal" style=" display: none; 
    position: fixed; 
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);">

  <div style="position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s">
    <div style="padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <span class="close" style="cursor: pointer;color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;">X</span>
      <h2>Đặt phòng thành công!!</h2>
    </div>
    <div style="padding: 2px 16px;">
      <p>Cảm ơn bạn đã đặt phòng. Để xác nhận đơn đặt phòng của bạn chính xác, chúng tôi sẽ liên hệ lại với bạn qua địa chỉ mail mà bạn đã cung cấp cho chúng tôi trong thời gian sớm nhất!!!</p>
      <p>Vui lòng ấn vào dấu [X] Để trở về trang chủ</p>
    </div>
    <div style=" padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <h3>Successfull !! Please waiting reply from Admin</h3>
    </div>
  </div>

</div>';

echo '<script>';
echo'var modal = document.getElementById(\'myModal\');
var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";

span.onclick = function() {
    window.history.back();
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}';
echo '</script>';
    }
    else
    {
        echo'<div id="myModal" style=" display: none; 
    position: fixed; 
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);">

  <div style="position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s">
    <div style="padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <span class="close" style="cursor: pointer;color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;">X</span>
      <h2>Đặt phòng thành công!!</h2>
    </div>
    <div style="padding: 2px 16px;">
      <p>Rất tiếc! Đơn đặt phòng không được đặt thành công, có vẻ bạn đã sai sót gì đó trong đơn hàng của mình. </p>
      <p>Xin hãy kiếm tra lại!</p>
    </div>
    <div style=" padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <h3>Failled !! Please check again</h3>
    </div>
  </div>

</div>';

echo '<script>';
echo'var modal = document.getElementById(\'myModal\');
var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";

span.onclick = function() {
    window.history.back();
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}';
echo '</script>';
    }
}
else
{
    echo'<div id="myModal" style=" display: none; 
    position: fixed; 
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);">

  <div style="position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s">
    <div style="padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <span class="close" style="cursor: pointer;color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;">X</span>
      <h2>Đặt phòng thành công!!</h2>
    </div>
    <div style="padding: 2px 16px;">
      <p>Rất tiếc! Dường như có vấn đề trong tiến trình đặt phòng của bạn. </p>
      <p>Xin hãy kiếm tra lại!</p>
    </div>
    <div style=" padding: 2px 16px;
    background-color: #5cb85c;
    color: white;">
      <h3>Failled !! Please check again</h3>
    </div>
  </div>

</div>';

echo '<script>';
echo'var modal = document.getElementById(\'myModal\');
var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";

span.onclick = function() {
    window.history.back();
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}';
echo '</script>';
}

//power by NhatNam

?>