<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploads extends CI_Controller {

	public function index() {
		$title       = $this->system_model->get_webtitle();
		$keywords    = $this->system_model->get_keywords();
		$description = $this->system_model->get_description();
		$search      = "";

		$head['search']      = $search;
		$head['title']       = "本地上传-" . $title;
		$head['keywords']    = $keywords;
		$head['description'] = $description;

		$this->load->view('default/mt_header.php',$head);
		if( $this->session->userdata('online') ) {
			$this->load->view('mt_upload.php');
		} else {
			redirect(base_url(), 'refresh');
		}
		

        $this->load->view('default/mt_footer.php');
	}

	public function mkdirFolder()
	{
		$year  = date("Y");
	    $month = date("m");
	    $day   = date("d");

	    if( !is_dir("upload") )
	    {
	      if( !mkdir ("upload", 0755) )
	      {
	        return false;
	      }
	    }
	    chdir("upload");
	    if( !is_dir($year) )
	    {
	      if( !mkdir ($year, 0755) )
	      {
	        return false;
	      }
	    }
	    chdir($year);
	    if( !is_dir($month) )
	    {
	      if( !mkdir ($month, 0755) )
	      {
	        return false;
	      }
	    }
	    chdir($month);
	    if( !is_dir($day) )
	    {
	      if( !mkdir ($day, 0755) )
	      {
	        return false;
	      }
	    }
	    chdir("../../../");

	    $targetFolder = "upload/".$year."/".$month."/".$day;

	    return $targetFolder;
	}

	public function image() 
	{
		$targetDir = $this->mkdirFolder();

		if (!file_exists($targetDir)) {
		    @mkdir($targetDir);
		}

		if (isset($_REQUEST["name"])) {
		    $fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
		    $fileName = $_FILES["file"]["name"];
		} else {
		    $fileName = uniqid("file_");
		}

		$filePath   = $targetDir . DIRECTORY_SEPARATOR . $fileName;


		if (!$out = @fopen("{$filePath}", "wb")) {
		    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}
		if (!empty($_FILES)) {
		    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
		    }
		    if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		    }
		} else {
		    if (!$in = @fopen("php://input", "rb")) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		    }
		}
		while ($buff = fread($in, 4096)) {
		    fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);

		$ext  = pathinfo( $filePath, PATHINFO_EXTENSION );

		$hash = hash_file('md5', $filePath);

		if ($this->pic_model->is_hash($hash))
		{
			@unlink($filePath);
		}
		else
		{
			$newPath   = $targetDir . DIRECTORY_SEPARATOR . $hash . "." . $ext;

		    $thumbPath = $targetDir . DIRECTORY_SEPARATOR . $hash . "_thumb." . $ext;

		    rename($filePath, $newPath);
		    //略缩图
			$src_img    = $newPath;
			$dst_img    = $thumbPath;
			$width      = 220;
			$height     = 0;
			$cut        = 0;
			$proportion = 0;

			$this->img2thumb($src_img, $dst_img, $width, $height, $cut, $proportion);
			//图片
			$title = trim($_POST['pic_title']);
			$album = trim($_POST['pic_album']);
			$info  = $_POST['pic_info'];
			//$tags  = trim($_POST['pic_tag']);
			$type  = $_POST['pic_type'];

			$tags   = preg_replace("/\s|　/","",$_POST['pic_tag']); //去除所以空格
      		$newtag = str_replace(","," ",$tags);

			$this->pic_model->releasenew( $title,$info,$type,$newPath,$hash,$newtag );

			//专辑
			//$albumstr = trim($album,"!@#$%^&*()_+-={}[]|;',./<>?/:");

			if ($album != "")
			{
				$user = $this->session->userdata('Username');
				if (!$this->album_model->is_have($user,$album))
				{
					$this->album_model->creat($user,$album);
				}

				$id  = $this->album_model->getid($album);
				$pic = $this->pic_model->getid($hash);

			    if ($this->album_model->picturenum($id)) 
				{
					if (!$this->album_model->is_pic($id,$pic))
					{
						$this->album_model->add($id,$pic,0);
					}
				} 
				else 
				{
					$this->album_model->add($id,$pic,1);
				}
			}
		}



	}


/**
 * 生成缩略图
 * @author yangzhiguo0903@163.com
 * @param string     源图绝对完整地址{带文件名及后缀名}
 * @param string     目标图绝对完整地址{带文件名及后缀名}
 * @param int        缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
 * @param int        缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
 * @param int        是否裁切{宽,高必须非0}
 * @param int/float  缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
 * @return boolean
 */
	public function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
	{
	    if(!is_file($src_img))
	    {
	        return false;
	    }
	    $ot = $this->fileext($dst_img);
	    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
	    $srcinfo = getimagesize($src_img);
	    $src_w = $srcinfo[0];
	    $src_h = $srcinfo[1];
	    $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
	    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

	    $dst_h = $height;
	    $dst_w = $width;
	    $x = $y = 0;

	    /**
	     * 缩略图不超过源图尺寸（前提是宽或高只有一个）
	     */
	    if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
	    {
	        $proportion = 1;
	    }
	    if($width> $src_w)
	    {
	        $dst_w = $width = $src_w;
	    }
	    if($height> $src_h)
	    {
	        $dst_h = $height = $src_h;
	    }

	    if(!$width && !$height && !$proportion)
	    {
	        return false;
	    }
	    if(!$proportion)
	    {
	        if($cut == 0)
	        {
	            if($dst_w && $dst_h)
	            {
	                if($dst_w/$src_w> $dst_h/$src_h)
	                {
	                    $dst_w = $src_w * ($dst_h / $src_h);
	                    $x = 0 - ($dst_w - $width) / 2;
	                }
	                else
	                {
	                    $dst_h = $src_h * ($dst_w / $src_w);
	                    $y = 0 - ($dst_h - $height) / 2;
	                }
	            }
	            else if($dst_w xor $dst_h)
	            {
	                if($dst_w && !$dst_h)  //有宽无高
	                {
	                    $propor = $dst_w / $src_w;
	                    $height = $dst_h  = $src_h * $propor;
	                }
	                else if(!$dst_w && $dst_h)  //有高无宽
	                {
	                    $propor = $dst_h / $src_h;
	                    $width  = $dst_w = $src_w * $propor;
	                }
	            }
	        }
	        else
	        {
	            if(!$dst_h)  //裁剪时无高
	            {
	                $height = $dst_h = $dst_w;
	            }
	            if(!$dst_w)  //裁剪时无宽
	            {
	                $width = $dst_w = $dst_h;
	            }
	            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
	            $dst_w = (int)round($src_w * $propor);
	            $dst_h = (int)round($src_h * $propor);
	            $x = ($width - $dst_w) / 2;
	            $y = ($height - $dst_h) / 2;
	        }
	    }
	    else
	    {
	        $proportion = min($proportion, 1);
	        $height = $dst_h = $src_h * $proportion;
	        $width  = $dst_w = $src_w * $proportion;
	    }

	    $src = $createfun($src_img);
	    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
	    $white = imagecolorallocate($dst, 255, 255, 255);
	    imagefill($dst, 0, 0, $white);

	    if(function_exists('imagecopyresampled'))
	    {
	        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	    }
	    else
	    {
	        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	    }
	    $otfunc($dst, $dst_img);
	    imagedestroy($dst);
	    imagedestroy($src);
	    return true;
	}

	public function fileext($file)
	{
	    return pathinfo($file, PATHINFO_EXTENSION);
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */