<?php 
/** 
 * WeeGo工作室微信公众平台接口源码 
 * @author CallMeWhy <wanghaiyang@139.me> 
 * @version 1.0 
 */ 
include "wechat_class.php"; 
$options = array 
( 
  'token'=>'weixin', 
  'debug'=>true, 
  'logcallback'=>'logdebug' 
); 
$weObj = new Wechat($options); 
// 验证 
$weObj->valid(); 
// 获取内容 
$weObj->getRev(); 
// 获取用户的OpenID  
$fromUsername = $weObj->getRevFrom(); 
// 获取接受信息的类型 
$type = $weObj->getRev()->getRevType(); 
 
//**********关注操作则写入数据库**********/ 
if($weObj->getRevSubscribe()) 
{ 
  // 获取用户OPENID并写入数据库 
  $mysql = new SaeMysql(); 
  $sql = "INSERT INTO `users` (`wxid`) VALUES ('" . $fromUsername . "');"; 
  $mysql->runSql($sql); 
  $mysql->closeDb(); 
  // 获得信息的类型 
  $news = array 
  ( 
    array 
    ( 
      'Title'=>'欢迎关注zipit', 
      'Description'=>'发送任意内容查看最新开发进展', 
      'PicUrl'=>'http://www.izipit.top/upload/2017/04/26/259aff1329bed38e9b2034cfccaf8756.jpg', 
    ) 
  ); 
  $weObj->news($news)->reply(); 
} 
//**********取消关注操作则删除数据库**********/ 
if($weObj->getRevUnsubscribe()) 
{ 
  // 获取用户OPENID并从数据库删除 
  $mysql = new SaeMysql(); 
  $sql = "DELETE FROM `users` WHERE `wxid` = '" . $fromUsername . "'"; 
  $mysql->runSql($sql); 
  $mysql->closeDb(); 
} 
switch($type) { 
  case Wechat::MSGTYPE_TEXT: 
    /**********文字信息**********/ 
    $news = array 
    ( 
      array 
      ( 
        'Title'=>"欢迎光临WeeGo工作室", 
        'PicUrl'=>'http://233.weego.sinaapp.com/images/weego_400_200.png', 
        //'Url'=>'http://233.weego.sinaapp.com/web/home.php?wxid='.$fromUsername 
      ),    
      array 
      ( 
        'Title'=>"功能1：发送图片可以查询照片中人脸的年龄和性别信息哦", 
        'PicUrl'=>'http://233.weego.sinaapp.com/images/face.jpg', 
        //'Url'=>'http://233.weego.sinaapp.com/web/home.php?wxid='.$fromUsername 
      ),  
      array 
      ( 
        'Title'=>"功能2：发送一张两人合影的照片可以计算两人的相似程度", 
        'PicUrl'=>'http://233.weego.sinaapp.com/images/mask.png', 
        //'Url'=>'http://233.weego.sinaapp.com/web/home.php?wxid='.$fromUsername 
      ),  
      array 
      ( 
        'Title'=>"功能3：山东大学绩点查询签到等功能正在开发中敬请期待", 
        'PicUrl'=>'http://233.weego.sinaapp.com/images/sdu.jpg', 
        //'Url'=>'http://233.weego.sinaapp.com/web/home.php?wxid='.$fromUsername 
      ) 
    ); 
    // 开发人员通道 
    if($weObj->getRev()->getRevContent() === "why"){ 
      $news = array 
      ( 
        array 
        ( 
          'Title'=>'开发人员通道', 
          'Description'=>'开发人员通道', 
          'PicUrl'=>'http://233.weego.sinaapp.com/images/weego_400_200.png', 
          'Url'=>'http://233.weego.sinaapp.com/web/home.php?wxid='.$fromUsername 
        ) 
      ); 
    } 
    $weObj->news($news)->reply(); 
    exit; 
    break; 
  case Wechat::MSGTYPE_EVENT: 
    break; 
  case Wechat::MSGTYPE_IMAGE: 
    /**********图片信息**********/ 
    $imgUrl = $weObj->getRev()->getRevPic(); 
    $resultStr = face($imgUrl); 
    $weObj->text($resultStr)->reply(); 
    break; 
  default: 
    $weObj->text("Default")->reply(); 
} 
// 调用人脸识别的API返回识别结果 
function face($imgUrl) 
{ 
  // face++ 链接 
  $jsonStr = 
    file_get_contents("http://apicn.faceplusplus.com/v2/detection/detect?url=".$imgUrl."&api_key=RbEXaIf6GG7eKtAdptVQggSHyulkFDAO&api_secret=dg1O17tvmXhF8ovg5he5S3WQtbE6HoJq&&attribute=glass,pose,gender,age,race,smiling"); 
  $replyDic = json_decode($jsonStr); 
  $resultStr = ""; 
  $faceArray = $replyDic->{'face'}; 
  $resultStr .= "图中共检测到".count($faceArray)."张脸！\n"; 
  for ($i= 0;$i< count($faceArray); $i++){ 
    $resultStr .= "第".($i+1)."张脸\n"; 
    $tempFace = $faceArray[$i]; 
    // 获取所有属性 
    $tempAttr = $tempFace->{'attribute'}; 
    // 年龄：包含年龄分析结果 
    // value的值为一个非负整数表示估计的年龄, range表示估计年龄的正负区间 
    $tempAge = $tempAttr->{'age'}; 
    // 性别：包含性别分析结果 
    // value的值为Male/Female, confidence表示置信度 
    $tempGenger = $tempAttr->{'gender'};  
    // 种族：包含人种分析结果 
    // value的值为Asian/White/Black, confidence表示置信度 
    $tempRace = $tempAttr->{'race'};    
    // 微笑：包含微笑程度分析结果 
    //value的值为0-100的实数，越大表示微笑程度越高 
    $tempSmiling = $tempAttr->{'smiling'}; 
    // 眼镜：包含眼镜佩戴分析结果 
    // value的值为None/Dark/Normal, confidence表示置信度 
    $tempGlass = $tempAttr->{'glass'};   
    // 造型：包含脸部姿势分析结果 
    // 包括pitch_angle, roll_angle, yaw_angle 
    // 分别对应抬头，旋转（平面旋转），摇头 
    // 单位为角度。 
    $tempPose = $tempAttr->{'pose'}; 
    //返回年龄 
    $minAge = $tempAge->{'value'} - $tempAge->{'range'}; 
    $minAge = $minAge < 0 ? 0 : $minAge; 
    $maxAge = $tempAge->{'value'} + $tempAge->{'range'}; 
    $resultStr .= "年龄：".$minAge."-".$maxAge."岁\n"; 
    // 返回性别 
    if($tempGenger->{'value'} === "Male") 
      $resultStr .= "性别：男\n";  
    else if($tempGenger->{'value'} === "Female") 
      $resultStr .= "性别：女\n"; 
    // 返回种族 
    if($tempRace->{'value'} === "Asian") 
      $resultStr .= "种族：黄种人\n";   
    else if($tempRace->{'value'} === "Male") 
      $resultStr .= "种族：白种人\n";   
    else if($tempRace->{'value'} === "Black") 
      $resultStr .= "种族：黑种人\n";   
    // 返回眼镜 
    if($tempGlass->{'value'} === "None") 
      $resultStr .= "眼镜：木有眼镜\n";  
    else if($tempGlass->{'value'} === "Dark") 
      $resultStr .= "眼镜：目测墨镜\n";  
    else if($tempGlass->{'value'} === "Normal") 
      $resultStr .= "眼镜：普通眼镜\n";  
    //返回微笑 
    $resultStr .= "微笑：".round($tempSmiling->{'value'})."%\n"; 
  }   
  if(count($faceArray) === 2){ 
    // 获取face_id 
    $tempFace = $faceArray[0]; 
    $tempId1 = $tempFace->{'face_id'}; 
    $tempFace = $faceArray[1]; 
    $tempId2 = $tempFace->{'face_id'}; 
 
    // face++ 链接 
    $jsonStr = 
      file_get_contents("https://apicn.faceplusplus.com/v2/recognition/compare?api_secret=dg1O17tvmXhF8ovg5he5S3WQtbE6HoJq&api_key=RbEXaIf6GG7eKtAdptVQggSHyulkFDAO&face_id2=".$tempId2 ."&face_id1=".$tempId1); 
    $replyDic = json_decode($jsonStr); 
    //取出相似程度 
    $tempResult = $replyDic->{'similarity'}; 
    $resultStr .= "相似程度：".round($tempResult)."%\n"; 
    //具体分析相似处 
    $tempSimilarity = $replyDic->{'component_similarity'}; 
    $tempEye = $tempSimilarity->{'eye'}; 
    $tempEyebrow = $tempSimilarity->{'eyebrow'}; 
    $tempMouth = $tempSimilarity->{'mouth'}; 
    $tempNose = $tempSimilarity->{'nose'}; 
    $resultStr .= "相似分析：\n"; 
    $resultStr .= "眼睛：".round($tempEye)."%\n"; 
    $resultStr .= "眉毛：".round($tempEyebrow)."%\n"; 
    $resultStr .= "嘴巴：".round($tempMouth)."%\n"; 
    $resultStr .= "鼻子：".round($tempNose)."%\n"; 
  } 
 
  //如果没有检测到人脸 
  if($resultStr === "") 
    $resultStr = "照片中木有人脸=.="; 
  return $resultStr; 
}; 
// 写入本地日志文件的函数 
function logdebug($text) 
{ 
  file_put_contents('log.txt', $text."\n", FILE_APPEND);    
};