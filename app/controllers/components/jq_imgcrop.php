<?php  
class JqImgcropComponent extends Object { 

    function uploadImage($uploadedInfo, $uploadTo, $prefix){
    	$webpath = $uploadTo;
        $uploadTo = 'img/' . $uploadTo; 
        $upload_dir = WWW_ROOT.str_replace("/", DS, $uploadTo); 
        $upload_path = $upload_dir.DS; 
        $max_file = "34457280";                         // Approx 30MB 
        $max_width = 300; 

        $userfile_name = $uploadedInfo['name']; 
        $userfile_tmp =  $uploadedInfo["tmp_name"]; 
        $userfile_size = $uploadedInfo["size"]; 
        $filename = $prefix.basename($uploadedInfo["name"]);
        $file_ext = substr($filename, strrpos($filename, ".") + 1);
		$filename = String::uuid() . "." . $file_ext; 
        $uploadTarget = $upload_path.$filename; 

        if(empty($uploadedInfo)) { 
                  return false; 
                }   

        if (isset($uploadedInfo['name'])){ 
            move_uploaded_file($userfile_tmp, $uploadTarget ); 
            chmod ($uploadTarget , 0777); 
            $width = $this->getWidth($uploadTarget); 
            $height = $this->getHeight($uploadTarget); 
            // Scale the image if it is greater than the width set above 
            if ($width > $max_width){ 
                $scale = $max_width/$width; 
                $uploaded = $this->resizeImage($uploadTarget,$width,$height,$scale); 
            }else{ 
                $scale = 1; 
                $uploaded = $this->resizeImage($uploadTarget,$width,$height,$scale); 
            } 
        } 
        return array('imagePath' => $webpath.DS.$filename, 'imageName' => $filename, 'imageWidth' => $this->getWidth($uploadTarget), 'imageHeight' => $this->getHeight($uploadTarget)); 
    } 

    function getHeight($image) { 
        $sizes = getimagesize($image); 
        $height = $sizes[1]; 
        return $height; 
    } 
    function getWidth($image) { 
        $sizes = getimagesize($image); 
        $width = $sizes[0]; 
        return $width; 
    } 

    function resizeImage($image,$width,$height,$scale) { 
        $newImageWidth = ceil($width * $scale); 
        $newImageHeight = ceil($height * $scale); 
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight); 
$ext = strtolower(substr(basename($image), strrpos(basename($image), ".") + 1)); 
        $source = ""; 
        if($ext == "png"){ 
            $source = imagecreatefrompng($image); 
        }elseif($ext == "jpg" || $ext == "jpeg"){ 
            $source = imagecreatefromjpeg($image); 
        }elseif($ext == "gif"){ 
            $source = imagecreatefromgif($image); 
        } 
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height); 
        if($ext == "png" || $ext == "PNG"){ 
            imagepng($newImage,$image,0); 
        }elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG"){ 
            imagejpeg($newImage,$image,90); 
        }elseif($ext == "gif" || $ext == "GIF"){ 
            imagegif($newImage,$image); 
        } 
        chmod($image, 0777); 
        return $image; 
    } 

    function resizeThumbnailImage($thumb, $image, $width, $height, $start_width, $start_height, $scale){ 
        $newImageWidth = ceil($width * $scale); 
        $newImageHeight = ceil($height * $scale); 
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $ext = strtolower(substr(basename($image), strrpos(basename($image), ".") + 1)); 
        $source = ""; 
        if($ext == "png"){ 
            $source = imagecreatefrompng($image); 
        }elseif($ext == "jpg" || $ext == "jpeg"){
            $source = imagecreatefromjpeg($image); 
        }elseif($ext == "gif"){ 
            $source = imagecreatefromgif($image); 
        } 
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		
        if($ext == "png" || $ext == "PNG"){ 
            imagepng($newImage,$thumb,0); 
        }elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG"){ 
            imagejpeg($newImage,$thumb,90); 
        }elseif($ext == "gif" || $ext == "GIF"){ 
            imagegif($newImage,$thumb); 
        } 

        chmod($thumb, 0777); 
        return $thumb; 
    } 

    function cropImage($thumb_width, $x1, $y1, $x2, $y2, $w, $h, $thumbLocation, $imageLocation){
    	$imageLocation = 'img/' . $imageLocation;
		$thumbLocation = 'img/' . $thumbLocation;
        $scale = $thumb_width/$w; 
        $cropped = $this->resizeThumbnailImage(WWW_ROOT.str_replace("/", DS,$thumbLocation),WWW_ROOT.str_replace("/", DS,$imageLocation),$w,$h,$x1,$y1,$scale);
        return $cropped; 
    }
	
	function deleteImage($imageName, $folder) {
		$image = WWW_ROOT.'img/' . $folder . DS . $imageName;
		if(is_file($image))
			unlink($image);
	}
	
	function getFileExtension($str) {
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
} 
?>