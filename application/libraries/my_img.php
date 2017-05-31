<?php
	/**
		* 
		*/
		class my_img
		{
			
			/**begin crop*/
		    public static function scrop_img($file_img,$prefix_name,$path,$x,$y,$nw,$nh,$w,$h)
		    {
		        # code...
		        $valid_exts = array('jpeg', 'jpg', 'png', 'gif');        
		        if ( $file_img ) {            
		          # get file extension
		          $ext = strtolower(pathinfo($file_img, PATHINFO_EXTENSION));
		          # file type validity
		          if (in_array($ext, $valid_exts)) {
		              $path = $path .  $prefix_name.'-'.date("y-m-d-h-i-s").'.' . $ext;              
		              $size = getimagesize($file_img);
		              # grab data form post request
		              
		              # read image binary data
		              $data = file_get_contents($file_img);
		              # create v image form binary data
		              $vImg = imagecreatefromstring($data);
		              $dstImg = imagecreatetruecolor($nw, $nh);
		              # copy image
		              imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
		              # save image
		              imagejpeg($dstImg, $path);
		              # clean memory
		              imagedestroy($dstImg);
		              echo $path;
		              // echo "<p><img src='$path' /></p>";
		              
		            } else {
		              	echo 0; //echo 'unknown problem!';
		            } 
		        } else {
		          echo 0; //echo 'file is too small or large';
		        }                  
		    }
		    /**end crop*/
		}	
?>