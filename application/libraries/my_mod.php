<?php
	class my_mod
	{
		/**begin ti gia*/
		public static function mod_exchange()
		{
			# code...
			$Link = $Link2 = '';
			$dir='media/cache/exchange/';
			if(!is_dir($dir)) mkdir($dir,0755,true);
			$Link = $dir.'ExchangeRates.xml';
			$Link2 = 'http://vietcombank.com.vn/ExchangeRates/ExrateXML.aspx';
			$content = @file_get_contents($Link2);
			if($content==''){
				$content = @file_get_contents($Link);
			}else{
				copy($Link2,$Link);
			} 
			if($content!='' and preg_match_all('/Exrate CurrencyCode="(.*)" CurrencyName="(.*)" Buy="(.*)" Transfer="(.*)" Sell="(.*)"/',$content,$matches) and count($matches)>0){
				$exchange_rates=array(
					'USD'=>array()
					,'EUR'=>array()
					,'GBP'=>array()
					,'HKD'=>array()
					,'JPY'=>array()
					,'CHF'=>array()
					,'AUD'=>array()
					,'CAD'=>array()
					,'SGD'=>array()
					,'THB'=>array()
					);
				foreach($matches[1] as $key=>$value){
					if(isset($exchange_rates[$value])){
						$exchange_rates[$value]=array(
							'id'=>$value
							,'name'=>$matches[2][$key]
							,'buy'=>$matches[3][$key]
							,'transfer'=>$matches[4][$key]
							,'sell'=>$matches[5][$key]
							);
					}
				}

				echo '<table width="100%" border="1" cellspacing="0" cellpadding="5">
				    <tr>
				    	<th>Mã</th>
				        <th>Mua</th>
				        <th>Bán</th>
				        <th>Chuyển khoản</th>
				    </tr>';
				    foreach($exchange_rates as $key=>$value){
						echo '<tr>
					    	<td>'.$value['name'].'</td>
					        <td>'.$value['buy'].'</td>
					        <td>'.$value['sell'].'</td>
					        <td>'.$value['transfer'].'</td>
					    </tr>';
					}
				echo '</table>';
			}
			
		}
		/**end ti gia*/

		/**begin gia vang // bảng tỷ giá vàng của sjc.com.vn*/
		public static function mod_gold()
		{
			# code...
			$Link = $Link2 = '';
			$dir='media/mod/';
			if(!is_dir($dir)) mkdir($dir,0755,true);
			$Link = $dir.'GoldRates.xml';
			$Link2 = 'http://www.sjc.com.vn/xml/tygiavang.xml';	
			$content = @file_get_contents($Link2);
			if($content=='')
			{
				$content = @file_get_contents($Link);
			}else
			{
				copy($Link2,$Link);
			}
			$p = xml_parser_create();
			xml_parse_into_struct($p, $content, $xml);
			$goldrates['HANOI']=array(
				'id'=>'HANOI'
				,'name'=>$xml[23]['attributes']['NAME']
				,'buy'=>$xml[24]['attributes']['BUY']
				,'sell'=>$xml[24]['attributes']['SELL']
			);
			$goldrates['TPHCM']=array(
				'id'=>'TPHCM'
				,'name'=>$xml[6]['attributes']['NAME']
				,'buy'=>$xml[7]['attributes']['BUY']
				,'sell'=>$xml[7]['attributes']['SELL']
			);
			$goldrates['DANANG']=array(
				'id'=>'DANANG'
				,'name'=>$xml[28]['attributes']['NAME']
				,'buy'=>$xml[29]['attributes']['BUY']
				,'sell'=>$xml[29]['attributes']['SELL']
			);
			$goldrates['NHATRANG']=array(
				'id'=>'NHATRANG'
				,'name'=>$xml[33]['attributes']['NAME']
				,'buy'=>$xml[34]['attributes']['BUY']
				,'sell'=>$xml[34]['attributes']['SELL']
			);
			$goldrates['CAMAU']=array(
				'id'=>'CAMAU'
				,'name'=>$xml[38]['attributes']['NAME']
				,'buy'=>$xml[39]['attributes']['BUY']
				,'sell'=>$xml[39]['attributes']['SELL']
			);
			$goldrates['BUONMATHUOC']=array(
				'id'=>'BUONMATHUOC'
				,'name'=>$xml[43]['attributes']['NAME']
				,'buy'=>$xml[44]['attributes']['BUY']
				,'sell'=>$xml[44]['attributes']['SELL']
			);
			$goldrates['HUE']=array(
				'id'=>'HUE'
				,'name'=>$xml[53]['attributes']['NAME']
				,'buy'=>$xml[54]['attributes']['BUY']
				,'sell'=>$xml[54]['attributes']['SELL']
			);


			echo '<table width="100%" border="1" cellspacing="0" cellpadding="5">
			<tr>
				<th>Thành Phố</th>
				<th>Mua</th>
				<th>Bán</th>
			</tr>';

			foreach($goldrates as $key=>$value){
				echo '
				<tr>
					<td>'.$value['name'].'</td>
					<td>'.$value['buy'].'</td>
					<td>'.$value['sell'].'</td>
				</tr>
				';
			}

			echo '</table>';
		}
		/**end gia vang*/

		/**begin lich van nien*/
		public static function mod_calendar()
		{
			# code...
			echo 'Dữ liệu đang cập nhật';
		}
		/**end lich van nien*/

		/**begin weather*/
		public static function mod_weather()
		{
			# code...
			// echo '<img src="'.my_lib::site_img().'utility.png" alt="">';
			// Tạo cache dự phòng khi không lấy được thông tin
			

			$Link = array();
			$id = 1;
			$weather_dir='media/mod/weather';
			if(!is_dir($weather_dir)) mkdir($weather_dir,0755,true);
			$Link[] = $weather_dir.'Hanoi.xml';
			$Link[] = $weather_dir.'HCM.xml';
			$Link[] = $weather_dir.'Haiphong.xml';
			$Link[] = $weather_dir.'Vinh.xml';
			$Link[] = $weather_dir.'Danang.xml';
			$Link[] = $weather_dir.'Nhatrang.xml';
			$Link[] = $weather_dir.'Bacgiang.xml';

		// Lấy thông tin xml từ yahoo
			$Link2 = array();
			$Link2[] = 'http://weather.yahooapis.com/forecastrss?w=12800712&u=c';	// Hà Nội
			$Link2[] = 'http://weather.yahooapis.com/forecastrss?w=1252431&u=c';	// TP HCM
			$Link2[] = 'http://weather.yahooapis.com/forecastrss?w=1236690&u=c';	// Hải Phòng
			$Link2[] = 'http://weather.yahooapis.com/forecastrss?w=1252662&u=c';	// Vinh
			$Link2[] = 'http://weather.yahooapis.com/forecastrss?w=1252376&u=c';	// Đà Nẵng
			$Link2[] = 'http://weather.yahooapis.com/forecastrss?w=1252522&u=c';	// Nha Trang
			$Link2[] = 'http://weather.yahooapis.com/forecastrss?w=1229284&u=c';	// Bắc Giang
			
			// Lấy nội dung file xml chứa thông tin thời tiết từ yahoo
			$content = @file_get_contents($Link2[$id]);
			if($content==''){
				$content = @file_get_contents($Link[$id]); // Nếu không lấy được thông tin từ yahoo thì lấy thông tin từ file cache
			}else{
				copy($Link2[$id],$Link[$id]); // Nếu lấy được thông tin từ yahoo thì ghi vào file cache
			}
			
			// Phân tích và đưa thông tin file xml vào mảng $xml
			$p = xml_parser_create();
			xml_parse_into_struct($p, $content, $xml);
			
			// Đưa các thông tin cần lấy trong mảng $xml vào mảng $weather

			$weather['wind_speed_unit']=$xml[16]['attributes']['SPEED'];								// đơn vị tốc độ gió
			$weather['chill']=$xml[18]['attributes']['CHILL'];											// nhiệt độ
			$weather['direction']=self::wind_direction($xml[18]['attributes']['DIRECTION']);			// hướng gió
			$weather['wind_speed']=$xml[18]['attributes']['SPEED'];										// tốc độ gió
			$weather['humidity']=$xml[20]['attributes']['HUMIDITY'];									// độ ẩm
			$weather['sunrise']=$xml[22]['attributes']['SUNRISE'];										// mặt trời mọc
			$weather['sunset']=$xml[22]['attributes']['SUNSET'];										// mặt trời lặn
			$weather['condition']=$xml[48]['attributes']['TEXT'];										// tình trạng hiện tại
			$weather['image']=self::get_we_image($xml[50]['value']);									// ảnh thời tiết
			$weather['high']=$xml[52]['attributes']['HIGH'];											// nhiệt độ cao nhất trong ngày
			$weather['low']=$xml[52]['attributes']['LOW'];	
												// nhiệt độ thấp nhất trong ngày
			
		

			echo '<div class="we-info">';
				if(isset($weather) and $weather){ 
					echo '<div class="we-chill">'.$weather["chill"].'&deg;C</div>';
					echo '<div class="we-image"><img src="'.$weather["image"].'" align="left" alt="Hiện tại" /></div>';
					echo '<div class="clr"></div>';
					// echo '<div>'.$weather['condition'].'</div>';

			    	// echo '<div class="clrfix">';
			     //        
			     //        echo '<div class="we-hl"><span>H'.$weather["high"].'>&deg;</span><span>L'.$weather["low"].'>&deg;</span></div>';
			     //    echo '</div>';
			     //    
			     //    echo '<div>Độ ẩm: '.$weather['humidity'].'%</div>';
			     //    echo '<div>Gió: '.$weather['direction'].', '.$weather['wind_speed'].' '.$weather['wind_speed_unit'].'</div>';
			     //    echo '<div>Mặt trời mọc: '.$weather['sunrise'].'</div>';
			     //    echo '<div>Mặt trời lặn: '.$weather['sunset'].'</div>';
		        }
		    echo '<div class="source">Nguồn: yahoo.com</div>';
		    echo '</div>';

		}
		/**end weather*/
		/* Chuyển đổi hướng gió từ số thành chữ
		** $w là một số từ 0 tới 359
		*/
		public static function wind_direction($w){
			$content='';
			if($w==0){
				$content='không xác định';
			}elseif(($w>=355 and $w<360) or ($w>0 and $w<=5)){
				$content='bắc';
			}elseif($w>5 and $w<=40){
				$content='bắc đông bắc';
			}elseif($w>40 and $w<=50){
				$content='đông bắc';
			}elseif($w>50 and $w<=85){
				$content='đông đông bắc';
			}elseif($w>85 and $w<=95){
				$content='đông';
			}elseif($w>95 and $w<=130){
				$content='đông đông nam';
			}elseif($w>130 and $w<=140){
				$content='đông nam';
			}elseif($w>140 and $w<=175){
				$content='nam đông nam';
			}elseif($w>175 and $w<=185){
				$content='nam';
			}elseif($w>185 and $w<=220){
				$content='nam tây nam';
			}elseif($w>220 and $w<=230){
				$content='tây nam';
			}elseif($w>230 and $w<=265){
				$content='tây tây nam';
			}elseif($w>265 and $w<=275){
				$content='tây';
			}elseif($w>275 and $w<=310){
				$content='tây tây bắc';
			}elseif($w>310 and $w<=320){
				$content='tây bắc';
			}elseif($w>320 and $w<355){
				$content='bắc tây bắc';
			}
			return $content;
		}
		/* Lấy đường dẫn ảnh thời tiết hiện tại
		*/
		public static function get_we_image($content){
			$pos=strpos($content,'"/>');
			$content=substr($content,11,$pos-11);
			return $content;
		}
		/* Lấy thông tin từ url
		*/
		public static function get_url($url){
			if(isset($_REQUEST[$url]) and $_REQUEST[$url]){
				return $_REQUEST[$url];
			}
			return false;
		}
	}
?>