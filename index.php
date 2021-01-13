<?
extract($_REQUEST);

include("lib.php");

if(!@$act){
$act="idx";
}


switch($act){
case "idx":
print head("გაცნობა");

$db=db();
$count=count($db)-1;

print "<div align=center>ბოლო {$last_on_main} ანკეტა</div><br>
<table align=center border=0 width=80%>
<tr align=center class=header><td align=left class=pad>&nbsp; სახელი</td><td>ქალაქი</td><td>ასაკი</td><td>სიმაღლე</td><td>წონა</td><td width=16></td><td width=16><br><br></td></tr>\n";

for($i=$count;$i>($count-$last_on_main);$i--){
if($i && isset($db[$i])){

$age=date("Y")-date("Y",$db[$i][4])+15;
if(date("md")<date("md",$db[$i][4])) $age--;

$pol=($db[$i][2]=='male') ? 'ბიჭი' : 'გოგო';

print "<tr align=center><td align=left style='background-color: #dfdfdf;'><br>&nbsp;&nbsp;<a href=\"index.php?act=view&login=".$db[$i][0]."\" title=ანკეტა>".$db[$i][3]."</a></td><td style='background-color: #dfdfdf;'><br>".result($db[$i][5])."</td><td style='background-color: #dfdfdf;'><br>".$age."</td><td style='background-color: #dfdfdf;'><br>".result($db[$i][6])."</td><td style='background-color: #dfdfdf;'><br>".result($db[$i][7])."</td><td style='background-color: #dfdfdf;'><br>{$pol}</td><td style='background-color: #dfdfdf;'><br><br>".result($db[$i][12],3)."<br><br></td></tr>\n";

}
}

print "</table>";

break;
case "add":
print head("ანკეტის დამატება");
if(@$send && @$_POST['login'] && @$_POST['pass'] && @$_POST['name'] && @$_POST['pass'] && @$_POST['born_day'] && @$_POST['born_month'] && @$_POST['born_year'] && @$_POST['city'] && @$_POST['mail']){
post();
$db=db();
$registered="no";

for($i=0;$i<count($db);$i++){
if($db[$i][0]==$login){
$registered="yes";
}
}

if($registered!="no"){
print "<div class=footer>
    
      <div class=love>აღნიშნული მომხმარებელი უკვე რეგისტრირებულია</div>
    
  </div>";

print form($login,"",$pol,$name,$born_day,$born_month,($born_year+15),$city,$growth,$weight,$mail,$url,$icq,$about);

}else{

$foto=null;

if($_FILES['foto']['size']<=204800 && $_FILES['foto']['name']!=""){

$ftype=substr($_FILES['foto']['name'],-4);
if(substr($ftype,0,1)!="."){
$ftype=".image";
}

$td=time();
srand((double)microtime()*1000000*$td);
$gen=md5(uniqid(rand()));

copy($_FILES['foto']['tmp_name'], "./foto/".$gen.$ftype);

$foto=$gen.$ftype;
}

$time=mktime(0,0,0,$born_month,$born_day,($born_year+15));

$i=count($db);
$db[$i][0]=$login;
$db[$i][1]=md5($pass);
$db[$i][2]=$pol;
$db[$i][3]=$name;
$db[$i][4]=$time;
$db[$i][5]=$city;
$db[$i][6]=$growth;
$db[$i][7]=$weight;
$db[$i][8]=$mail;
$db[$i][9]=$url;
$db[$i][10]=$icq;
$db[$i][11]=$about;
$db[$i][12]=$foto;

presave($db[$i]);

savedb($db);

print "<div class=footer>
    
      <div class=love>თქვენი ანკეტა შენახულია</div>
    
  </div>";
}
}else{
print form();
}
break;
case "edit":
print head("პროფილი");

post();

$loginform="<form method=post><br><br><center>
<input type=text placeholder='მომხმარებელი' name=login><br>
<input type=password placeholder='პაროლი' name=pass><br>
<input type=submit value='შესვლა' style=margin-top:1>
</center>
</form>";

if(@$_POST['login'] && @$_POST['pass']){

if(notlogin($login,$pass)){
print notlogin($login,$pass);
print $loginform;
}else{

$db=db();

for($i=0;$i<count($db);$i++){
if($db[$i][0]==$login){
break;
}
}

if(@$delanket){

if($db[$i][12]!=""){
@unlink("./foto/".$db[$i][12]);
}

unset($db[$i]);
savedb($db);

print "<div class=footer>
    
      <div class=love>ანკეტა წაიშალა</div>
    
  </div>";

}else{

if(@$name && @$pol && @$born_day && @$born_month && @$born_year){
$time=mktime(0,0,0,$born_month,$born_day,($born_year+15));

if($_FILES['foto']['size']<=204800 && $_FILES['foto']['name']!=""){

$ftype=substr($_FILES['foto']['name'],-4);
if(substr($ftype,0,1)!="."){
$ftype=".image";
}

$td=time();
srand((double)microtime()*1000000*$td);
$gen=md5(uniqid(rand()));

copy($_FILES['foto']['tmp_name'], "./foto/".$gen.$ftype);

if($db[$i][12]!=""){
@unlink("./foto/".$db[$i][12]);
}

$foto=$gen.$ftype;
}else{
$foto=$db[$i][12];
}

if(@$delphoto){
@unlink("./foto/".$foto);
$foto="";
print "<div class=footer>
    
      <div class=love>ფოტო წაიშალა</div>
    
  </div><br>\n";
}


$db[$i][0]=$login;
$db[$i][1]=md5($pass);
$db[$i][2]=$pol;
$db[$i][3]=$name;
$db[$i][4]=$time;
$db[$i][5]=$city;
$db[$i][6]=$growth;
$db[$i][7]=$weight;
$db[$i][8]=$mail;
$db[$i][9]=$url;
$db[$i][10]=$icq;
$db[$i][11]=$about;
$db[$i][12]=$foto;

savedb($db);

print "<div class=footer>
    
      <div class=love>ცვლილება შენახულია</div>
    
  </div><br>\n";
}

$p_day=date("d",$db[$i][4]);
$p_month=date("m",$db[$i][4]);
$p_year=date("Y",$db[$i][4]);

print form($db[$i][0],$pass,$db[$i][2],$db[$i][3],$p_day,$p_month,$p_year,$db[$i][5],$db[$i][6],$db[$i][7],$db[$i][8],$db[$i][9],$db[$i][10],$db[$i][11],$db[$i][12]);

}
}

}else{
print $loginform;
}

break;
case "view":
print head("ანკეტის ნახვა");

if(@$login){
$db=db();

for($i=0;$i<count($db);$i++){
if($db[$i][0]==$login){
break;
}
}


$born=date("d M ",$db[$i][4]);
$born.=date("Y",$db[$i][4])-15;
month($born);

view($db[$i]);
?>

<center><div style="text-align:center; background-color: #dfdfdf; max-width: 400px; margin:0px auto 0px auto;">
<br>&nbsp; <b>სახელი:</b> <?=$db[$i][3]?>&nbsp;<hr>
&nbsp; <b>სქესი:</b> <?=$db[$i][2]?>&nbsp;<hr>
&nbsp; <b>დაბადების თარიღი:</b>&nbsp;<?=$born?> წელი.&nbsp;<hr>
&nbsp; <b>ქალაქი:</b> <?=$db[$i][5]?>&nbsp;<hr>
&nbsp; <b>სიმაღლე:</b> <?=$db[$i][6]?>&nbsp;<hr>
&nbsp; <b>წონა:</b> <?=$db[$i][7]?>&nbsp;<hr>
&nbsp; <b>ელ. ფოსტა:</b> <?=$db[$i][8]?>&nbsp;<hr>
&nbsp; <b>ვებ გვერდი:</b> <?=$db[$i][9]?>&nbsp;<hr>
&nbsp; <b>ტელ. ნომერი:</b> <?=$db[$i][10]?>&nbsp;<hr>
&nbsp; <b>ჩემს შესახებ:</b> <?=$db[$i][11]?>&nbsp;<hr>
&nbsp; <b>ჩემი ფოტო:</b> <?=$db[$i][12]?>&nbsp;<br><br></div>
</center>

<?
}
break;
case "filter":
get();
$name=@$_GET['name'];
print head("ანკეტის ძებნა");
print @filterform($_GET['pol'],$_GET['name_param'],$_GET['name'],$_GET['age_min'],$_GET['age_max'],$_GET['city_param'],$_GET['city']);

if(@$_GET['pol']){
$db=db();

if(!@$_GET['age_min'] || !is_numeric($_GET['age_min'])){
$_GET['age_min']=mktime(0,0,0,1,1,2037);
}else{
$_GET['age_min']=time()-60*60*24*365.25*$_GET['age_min'];
}

if(!@$_GET['age_max'] || !is_numeric($_GET['age_max'])){
$_GET['age_max']=-$tm;
}else{
$_GET['age_max']++;
$_GET['age_max']=time()-60*60*24*365.25*$_GET['age_max'];
}


$_GET['age_min']=$_GET['age_min']+$tm;
$_GET['age_max']=$_GET['age_max']+$tm;

$display="<center>არაფერი მოიძებნა</center>\n";
$result="";

print "<table align=center border=0 width=80%>\n";

for($i=1;$i<count($db);$i++){

if(@$_GET['name']==""  ||  ($_GET['name_param']=="==" && strtolower($_GET['name'])==strtolower($db[$i][3]))  ||  ($_GET['name_param']=="!=" && strtolower($_GET['name'])!=strtolower($db[$i][3]))  ||  ($_GET['name_param']=="cont" && stristr($db[$i][3], $_GET['name']))  ||  ($_GET['name_param']=="notcont" && !stristr($db[$i][3], $_GET['name']))  ){
if(@$_GET['city']==""  ||  ($_GET['city_param']=="==" && strtolower($_GET['city'])==strtolower($db[$i][5]))  ||  ($_GET['city_param']=="!=" && strtolower($_GET['city'])!=strtolower($db[$i][5]))  ||  ($_GET['city_param']=="cont" && stristr($db[$i][5], $_GET['city']))  ||  ($_GET['city_param']=="notcont" && !stristr($db[$i][5], $_GET['city']))  ){
if($_GET['age_min']>=$db[$i][4] && $db[$i][4]>=$_GET['age_max']){
if($_GET['pol']=="all" || $_GET['pol']==$db[$i][2]){

$age=floor((time()-$db[$i][4]+$tm)/(60*60*24*365.25));
$age=date("Y")-date("Y",$db[$i][4])+15;
if(date("md")<date("md",$db[$i][4])) $age--;

$pol=($db[$i][2]=='male') ? 'ბიჭი' : 'გოგო';

$result.="<tr align=center><td align=left style='background-color: #dfdfdf;'><br>&nbsp;&nbsp;<a href=\"index.php?act=view&login=".$db[$i][0]."\" title=ანკეტა>".$db[$i][3]."</a></td><td style='background-color: #dfdfdf;'><br>".result($db[$i][5])."</td><td style='background-color: #dfdfdf;'><br>".$age."</td><td style='background-color: #dfdfdf;'><br>".result($db[$i][6])."</td><td style='background-color: #dfdfdf;'><br>".result($db[$i][7])."</td><td style='background-color: #dfdfdf;'><br>{$pol}</td><td style='background-color: #dfdfdf;'><br><br>".result($db[$i][12],3)."<br><br></td></tr>\n";

$display="<br><br><tr align=center class=header><td align=left class=pad>&nbsp; სახელი</td><td>ქალაქი</td><td>ასაკი</td><td>სიმაღლე</td><td>წონა</td><td width=16></td><td width=16><br><br></td></tr>\n";
}
}
}
}
}

print $display;
print $result;
print "</table>\n";
}

break;
}
echo "<br><br>";
include "banner.php";
print footer();
?>
