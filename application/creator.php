<?php
/* Chia sẻ bởi Khải Phan */
echo '<meta charset="UTF-8" />';
include 'httpsocket.php';
$sock = new HTTPSocket;
$server_ip="125.212.219.88"; //IP của server
$server_login="vps"; // Tài khoản RSL
$server_pass="VCVNM2QxYUApISY="; // Mật khẩu RSL
$package="Host-TS01"; // Tên gói packages
$server_host=$server_ip; //where the API connects to 127.0.0.1
$server_ssl="Y";
$server_port=1212;
//echo ('tsmedia.ioi.vn run on ip: '.gethostbynamel('tsmedia.ioi.vn')[0]);
//echo ('khachsanhaianh.vn run on ip: '.gethostbynamel('khachsanhaianh.vn')[0]);
// Chỉnh sửa những dòng trên và không sửa phần dưới này!
function checkIPdomain($hostname='')
{
	$hostname = is_array($hostname) ? $hostname : explode(',',$hostname);
	$result = '';
	foreach ($hostname as $key => $value) {
		$hosts = gethostbynamel($value);
		$result .= $key ? "<br>" : "";
		if (is_array($hosts)) {
		     $result .= "Host ".$value." resolves to IP:";
		     foreach ($hosts as $key => $ip) {
		     	  $result .= $key ? ", " : "";
		          $result .= $ip;
		     }
		} else {
		     $result .= "<br>Host ".$value." is not tied to any IP.";
		}
	}
	return $result;
		
}
echo checkIPdomain(array('tsmedia.ioi.vn','khachsanhaianh.vn'));

if ($server_ssl == 'Y')
{
	$sock->connect("ssl://".$server_host, $server_port);
}
else
{ 
	$sock->connect($server_host, $server_port);
}
$sock->set_login($server_login,$server_pass);

$sock->query('/CMD_API_PACKAGES_USER');
$result = $sock->fetch_parsed_body();$packages='';
foreach ($result['list'] as $key => $value) {
	$packages .= '<option value="'.$value.'">'.$value.'</option>';
}

echo "<br><h2>Danh sach goi hosting:</h2> ";
print_r($result);


if (isset($_POST['action']) && $_POST['action'] == "add")
{

	$username=$_POST['username'];
	$domain=$_POST['domain'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$package=$_POST['package'];
	echo "Đang tạo tài khoản $username trên server $server_ip.... <br>\n";
 
	
 
	
 
	$sock->query('/CMD_API_ACCOUNT_USER',
		array(
			'action' => 'create',
			'add' => 'Submit',
			'username' => $username,
			'email' => $email,
			'passwd' => $pass,
			'passwd2' => $pass,
			'domain' => $domain,
			'package' => $package,
			'ip' => $server_ip,
			'notify' => 'yes'
		));
 
	$result = $sock->fetch_parsed_body();
 
	if ($result['error'] != "0")
	{
		echo "<b>Lỗi tạo tài khoản $username trên server $server_ip:<br>\n";
		echo $result['text']."<br>\n";
		echo $result['details']."<br></b>\n";
	}
	else
	{
		echo "Tài khoản $username đã được tạo trên server $server_ip thành công, hãy kiểm tra hòm mail để xem thông tin hosting, nếu không thấy xin hãy kiểm tra hòm SPAM!<br>\n";
	}

}

echo "Kết nối đến: ".($server_ssl == "Y" ? "https" : "http")."://".$server_host.":".$server_port."<br>\n";

?>


<form action='' method="POST">
<input type=hidden name=action value="add">
Tên tài khoản: <input type=text name=username><br>
Tên miền:<input type=text name=domain><br>
Email: <input type=text name=email><br>
Mật khẩu: <input type=text name=pass value="hosting<?php echo rand(100,999); ?>%#"><br>
Gói hosting: <select name="package">
				<?=$packages?>
			</select>
<input type=submit name=submit value="Tạo host"><br>
</form>

<?php
if (isset($_POST['action']) && $_POST['action'] == "suspend"){
	$username=$_POST['username'];
	echo "Đang suspend tài khoản $username trên server $server_ip.... <br>\n";
	$sock->query('/CMD_SELECT_USERS',
		array(
			'location' => 'CMD_USER_SHOW',
			//'suspend' => 'Suspend', // note - this can also be 'Unsuspend'
			'dosuspend'=>'Suspend',
			'select0' => $username
	    ));
	$result = $sock->fetch_parsed_body();

	if ($result['error'] != "0")
	{
		echo "<b>Lỗi khóa $username trên server $server_ip:<br>\n";
		echo $result['text']."<br>\n";
		echo $result['details']."<br></b>\n";
	}
	else
	{
		echo "Tài khoản $username đã được khóa<br>\n";
	}
}

?>
<form action='' method="POST">
<input type=hidden name=action value="suspend">
Tên tài khoản: <input type=text name=username><br>
<input type=submit name=submit value="Suspend"><br>
</form>

<?php
if (isset($_POST['action']) && $_POST['action'] == "unsuspend"){
	$username=$_POST['username'];
	echo "Đang unsuspend tài khoản $username trên server $server_ip.... <br>\n";
	$sock->query('/CMD_SELECT_USERS',
		array(
			'location' => 'CMD_USER_SHOW',
			//'suspend' => 'Suspend', // note - this can also be 'Unsuspend'
			'dounsuspend'=>'Unsuspend',
			'select0' => $username
	    ));
	$result = $sock->fetch_parsed_body();
	if ($result['error'] != "0")
	{
		echo "<b>Lỗi mở khóa $username trên server $server_ip:<br>\n";
		echo $result['text']."<br>\n";
		echo $result['details']."<br></b>\n";
	}
	else
	{
		echo "Tài khoản $username đã được mở khóa<br>\n";
	}
}
	
?>
<form action='' method="POST">
<input type=hidden name=action value="unsuspend">
Tên tài khoản: <input type=text name=username><br>
<input type=submit name=submit value="Unuspend"><br>
</form>
<?php 
if (isset($_POST['action']) && $_POST['action'] == "show_users"){
	$sock->query('/CMD_API_SHOW_USERS');
	$result = $sock->fetch_parsed_body();
	echo "<br><h2>Danh sach user hosting:</h2> ";
	print_r($result);

}
	$sock->query('/CMD_API_SHOW_USERS');
	$result = $sock->fetch_parsed_body();
	echo "<br><h2>Danh sach user hosting:</h2> ";
	print_r($result);

?>
<form action='' method="POST">
<input type=hidden name=action value="show_users">
<input type=submit name=submit value="Show users"><br>
</form>