<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
    
/**
 * image manipulation class.
 *
 * @name Images.php
 * @version 1.0
 * @author Viktor Golubev
 * @created: 28.12.2011
 */
 
 class Image_upload_lib
 {
    private $error = array();

	/**
    * Get error message.
 	* Can be invoked after any failed operation such as not allowed image size, image properties.
 	*
 	* @return	string
 	*/
	function get_error_message()
	{
		return $this->error;
	}

    public function _img_crop($tmpname, $save_dir, $width, $height, $save_name, $crop=false) {

    	$save_dir .= ( substr($save_dir,-1) != "/") ? "/" : "";
    
        list($w, $h, $imageType) = getimagesize($tmpname);
        
    	$imageType = image_type_to_mime_type($imageType);	

    	switch($imageType){
    		case "image/gif":
    			$imorig=imagecreatefromgif($tmpname); 
    			break;
    	    case "image/pjpeg":
    		case "image/jpeg":
    		case "image/jpg":
    			$imorig=imagecreatefromjpeg($tmpname); 
    			break;
    	    case "image/png":
    		case "image/x-png":
    			$imorig=imagecreatefrompng($tmpname); 
    			break;
      	}
	 
    	if($w <= $width || $h <= $height){
    		$width = $w;
    		$height = $h;
    	}else{
    		if($crop==1){
    			$ratio = max($width/$w, $height/$h);
    			$h = $height / $ratio;
    			$x = ($w - $width / $ratio) / 2;
    			$w = $width / $ratio;
    		}else{
  			  $ratio = max($width/$w, $height/$h);
  			  $width = $w * $ratio;
  			  $height = $h * $ratio;
  			  $x = 0;
   		 }
    	}
      
    	$new = imagecreatetruecolor($width, $height);
    
        $filename = $save_dir.$save_name;
    
    	if (imagecopyresampled($new, $imorig, 0, 0, 0, 0, $width, $height, $w, $h))
        	switch($imageType) {
        		case "image/gif":
        	  		imagegif($new,$filename);
        			break;
              	case "image/pjpeg":
        		case "image/jpeg":
        		case "image/jpg":
        	  		imagejpeg($new,$filename,99);
        			break;
        		case "image/png":
        		case "image/x-png":
        			imagepng($new,$filename);  
        			break;
            }
        	
        	chmod($filename, 0777);
            imagedestroy($new);
            imagedestroy($imorig);
             
        return true;
    }
    
    // Resize Trumbnail
    function _resizeThumbnailImage($thumb_image_name, $source_image, $width, $height, $start_width, $start_height, $scale){
    	list($imagewidth, $imageheight, $imageType) = getimagesize($source_image);
    	$imageType = image_type_to_mime_type($imageType);
    	
    	$newImageWidth = ceil($width * $scale);
    	$newImageHeight = ceil($height * $scale);
    	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    	switch($imageType) {
    		case "image/gif":
    			$source=imagecreatefromgif($source_image); 
    			break;
    	    case "image/pjpeg":
    		case "image/jpeg":
    		case "image/jpg":
    			$source=imagecreatefromjpeg($source_image); 
    			break;
    	    case "image/png":
    		case "image/x-png":
    			$source=imagecreatefrompng($source_image); 
    			break;
      	}
        
    	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
    	switch($imageType) {
    		case "image/gif":
    	  		imagegif($newImage,$thumb_image_name); 
    			break;
          	case "image/pjpeg":
    		case "image/jpeg":
    		case "image/jpg":
    	  		imagejpeg($newImage,$thumb_image_name,90); 
    			break;
    		case "image/png":
    		case "image/x-png":
    			imagepng($newImage,$thumb_image_name);  
    			break;
        }
    	chmod($thumb_image_name, 0777);
    	return $thumb_image_name;
    }
    
    public function _move_file($tmpname, $save_dir)
    {        
        move_uploaded_file($tmpname, $save_dir);
    }
    
    public function _check_allowed_type($image_name, $allowed_types)
    {
        $file_info = pathinfo($image_name);
        
        if (in_array($file_info['extension'], $allowed_types) == TRUE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function _random_name() {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';    
    
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
    
    function getHeight($image) {
    	$size = getimagesize($image);
    	$height = $size[1];
    	return $height;
    }
    
    function getWidth($image) {
    	$size = getimagesize($image);
    	$width = $size[0];
    	return $width;
    }
    
    public function _get_size2($image, $max_width=null, $max_height=null)
    {
        $img = getimagesize($image);
        
        if (isset($max_width) && isset($max_height)) {
            if ($img['0']>$max_width || $img['1']>$max_height) {
                return FALSE;
            }
        }
        elseif (isset($max_width)) {
            if ($img['0']>$max_width) {
                return FALSE;
            }
        }
        elseif (isset($max_height)) {
            if ($img['1']>$max_height) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function _get_file_size2($image, $file_size)
    {
        if (filesize($image) > $file_size*1024)
        {
            return false;
        }
        else
        {
            return true;
        }
    }   
   
    public function _get_type($image_name)
    {
        $file_info = pathinfo($image_name);
        
        return strtolower($file_info['extension']);
    }
    
    public function _cut_name($image_name, $cut_number)
    {
        $file_info = pathinfo($image_name);
        
        return substr(preg_replace("/[^a-z0-9]/","", strtolower($file_info['filename'])),0,$cut_number);
    }

 }