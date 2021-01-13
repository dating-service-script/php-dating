<?
if(@$_SERVER['QUERY_STRING']){
$foto=$_SERVER['QUERY_STRING'];

$foto=preg_replace("/[^a-z\.-_]/i", null, $foto);

include("lib.php");

$db=db();

for($i=0;$i<count($db);$i++){
if($db[$i][12]==$foto){
break;
}
}

$name  = @$db[$i][3];
$login = @$db[$i][0];

?>
<html>
<head>
<title><?=$name?>: ფოტო</title>
<style>
body, table, td {
  font-size: 10pt;
  font-family: Tahoma, Verdana, Arial, Helvetica, sans serif;
  background: #f9f9f9;
}

a {
  color: #555555;
}

a:hover {
  color: #000000;
  text-decoration: none;
}
</style>
</head>
<body bgcolor=#d8e8fe>
<table width=100% height=100% border=0>
<tr><td align=center valign=middle>
<?
if(file_exists("./foto/".$foto)){
print "<a href=\"index.php?act=view&login=".$login."\"><b>".$name."</b></a><span style=font-size:4><br><br></span><img src=./foto/".$foto." alt=\"".$name."\">";
}else{
print "<div style='width:200;height:200;border:1 solid black;text-align:middle;padding-top:88;background:gray;color:white'>ფოტო არ არის</div>";
}
?>
</td></tr>
</table>
</body>
</html>
<?
}
?>
