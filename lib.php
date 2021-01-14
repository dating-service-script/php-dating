<?
error_reporting(0);
$admin_pass="12345678";
$last_on_main=10;

$tm=60*60*24*365.25*15;

function head($title){
$output="<html>
<head>
<title>".$title."</title>
<style>
body, table, td {
  font-size: 10pt;
  font-family: Tahoma, Verdana, Arial, Helvetica, sans serif;
  color: #000000;
  background: #ffffff;
}

hr {
  color: #555555;
  height: 1;
}

tr.header td {
  font-weight:bold;
  color:#eee;
  background:#777;
}

td.pad {
  padding: 0 4;
}
select {
  padding: 16px 20px;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
}
textarea {
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}
input[type=text] {
  padding: 16px 20px;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
}
input[type=password] {
  padding: 16px 20px;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
}
input[type=button], input[type=submit], input[type=reset] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}
button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}
.chorbiuro {
  background-color: #bbbbbb;
  color: #ffffff;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #bfbfbf;
  border-radius: 4px;
}
summary {
  background-color: #bbbbbb;
  color: #ffffff;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #bfbfbf;
  border-radius: 4px;
}
img {
  max-width: 240px;
}
</style>
  <meta charset=UTF-8>
  <meta name='description' content='mylove.eu.org - საუკეთესო გაცნობის ვებგვერდი! გაიცანი ახალი პარტნიორი, განათავსეთ თქვენი ანკეტა, რეგისტრაცია უფასოა.'>
  <meta name=keywords content=gacnoba>
  <meta name=author content=მერაბი>
  <meta name=viewport content=width=device-width, initial-scale=1.0>
  <meta property=og:url content=http://mylove.eu.org />
  <meta property=og:type content=article />
  <meta property=og:title content=გაცნობა />
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <link href=assets/css/keen-static.css rel=stylesheet type='text/css' />
  <link href=assets/css/keen-dashboards.css rel=stylesheet type='text/css' />
</head>
<body>

  <div class='masthead hero'>
    <div class='container'>
      <header class='navbar'>
        <div class='navbar-header'>
        <button class='navbar-toggle' type='button' data-target='.keen-navbar-collapse'>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
		</div><img src=img/logo.png style=width:100%; alt=გაცნობა/>&nbsp;&nbsp;&nbsp;
        <nav class='navbar-collapse collapse keen-navbar-collapse' role='navigation'>
		  <ul class='navbar-nav nav main-nav'>
            <li><a href=index.php?act=idx class='btn navbar-btn'>ახალი</a></li>
            <li><a href=index.php?act=filter class='btn navbar-btn'>ძებნა</a></li>
            <li><a href=index.php?act=add class='btn navbar-btn'>რეგისტრაცია</a></li>
            <li><a href=index.php?act=edit class='btn navbar-btn'>შესვლა</a></li>
          </ul>

        </nav> 
      </header>
	  </div>
  </div>
    <div class=content>
    <div class=container grid grid-simple-col-2>
      <div>
<td style=font-size:1;width:1;background:#555555;padding:0 width=1>
&nbsp;
</td>
<td></div>
      <div></div>
    </div>
  </div>";
return $output;
}

function footer(){
$output="<div class=footer>
      <div class=love>&nbsp;</td>
</tr><tr><td height=10 colspan=3></td></tr>
</table>
  <script type=text/javascript src=assets/js/keen-analytics.js></script>
  <script>
    function toggleMenu() {
      const toggleBtn = document.querySelector('.navbar-toggle');

      toggleBtn.addEventListener('click', (e) => {
        let menu;
        if (e.currentTarget.dataset.target) {
          menu = document.querySelector(e.currentTarget.dataset.target);
        }
        if (menu) menu.classList.toggle('collapsed');
      });
    }

    window.addEventListener('DOMContentLoaded', toggleMenu);
  </script></div>
    </div>
</body>
</html>";

return $output;
}

function post(){
reset($_POST);
while(list($index,$value)=each($_POST)){
$GLOBALS[$index]=stripslashes($value);
}
}

function get(){
reset($_GET);
while(list($index,$value)=each($_GET)){
$GLOBALS[$index]=stripslashes($value);
}
}

function db(){
$file="./db.php";
$output=file($file);

for($i=0;$i<count($output);$i++){
$output[$i]=trim($output[$i]);
$output[$i]=explode("¦¦",$output[$i]);
}

return $output;
}

function savedb($input){
$file="./db.php";

if(is_array($input)){
for($i=0;$i<count($input);$i++){
if(@$input[$i]){
if(is_array($input[$i])){
$input[$i]=implode("¦¦",$input[$i]);
}
$input[$i].="\n";
}else{
$input[$i]="";
}
}
$input=implode("",$input);
}

$fp=fopen($file,"w");
flock($fp,2);
fwrite($fp,$input);
flock($fp,3);
fclose($fp);

}


function notlogin($login,$pass){
$db=db();
$output="<div class=footer>
    
      <div class=love>მომხმარებელი არასწორია!</div>
    
  </div>";
$login=stripslashes($login);
$pass=stripslashes($pass);

global $admin_pass;

for($i=0;$i<count($db);$i++){
if($db[$i][0]==$login){
if($db[$i][1]==md5($pass) || $pass==$admin_pass){
$output=false;
}else{
$output="<div class=footer>
    
      <div class=love>პაროლი არასწორია!</div>
    
  </div>";
}
}
}

return $output;
}

function view(&$input){
for($i=0;$i<count($input);$i++){
if($input[$i]==""){
$input[$i]="არაა შეყვანილი";
}else{
switch($i){
case 2:
if($input[2]=="male"){
$input[2]="მამრობითი";
}else{
$input[2]="მდედრობითი";
}
break;
case 8:
$input[$i]="<a href=\"mailto:".$input[$i]."\">".$input[$i]."</a>";
break;
case 9:
if(substr($input[$i],0,7)!="http://"){
$input[$i]="http://".$input[$i];
}
$input[$i]="<a href=\"".$input[$i]."\" target=_blank>".$input[$i]."</a>";
break;
case 12:
$input[$i]="<a href=\"foto.php?".$input[$i]."\" target=_blank>ფოტო</a>";
break;
}
}
}
}

function result($result,$code=0){
if($result!=""){
switch($code){
case 1:
$result="<a href=\"mailto:".$result."\"><img src=img/mail.png width=16 height=16 border=0 alt=\"".$result."\"></a>";
break;
case 2:
if(substr($result,0,7)!="http://"){
$result="http://".$result;
}
$result="<a href=\"".$result."\" target=_blank><img src=img/home.png width=16 height=16 border=0 alt=\"".$result."\"></a>";
break;
case 3:
$result="<a href=\"foto.php?".$result."\" target=_blank><img src=img/foto.png width=16 height=16 border=0 alt=\"ფოტო\"></a>";
break;
}
}else{
if($code!=0){
$result="";
}else{
$result="---";
}
}

return $result;
}

function month(&$date){
$er=array(
  "Jan" => "იანვარი",
  "Feb" => "თებერვალი",
  "Mar" => "მარტი",
  "Apr" => "აპრილი",
  "May" => "მაისი",
  "Jun" => "ივნისი",
  "Jul" => "ივლისი",
  "Aug" => "აგვისტო",
  "Sep" => "სექტემბერი",
  "Oct" => "ოქტომბერი",
  "Nov" => "ნოემბერი",
  "Dec" => "დეკემბერი",
);

$date=strtr($date,$er);
}

function presave(&$input){
for($i=0;$i<count($input);$i++){
$input[$i]=trim($input[$i]);
$input[$i]=stripslashes($input[$i]);
$input[$i]=str_replace("&","&amp;",$input[$i]);
$input[$i]=str_replace("<","&lt;",$input[$i]);
$input[$i]=str_replace(">","&gt;",$input[$i]);
$input[$i]=str_replace("\r","",$input[$i]);
$input[$i]=str_replace("\n","<br>",$input[$i]);
}
}

function form($s_login="",$s_pass="",$s_pol="",$s_name="",$s_day="",$s_month="",$s_year="",$s_city="",$s_growth="",$s_weight="",$s_mail="",$s_url="",$s_icq="",$s_about="",$s_foto=""){
$s_about=str_replace("<br>","\n",$s_about);
$s_about=str_replace("&lt;","<",$s_about);
$s_about=str_replace("&gt;",">",$s_about);
$s_about=str_replace("&amp;","&",$s_about);
$s_year=$s_year-15;

$output="<form method=\"post\" name=\"form\" enctype=\"multipart/form-data\" onsubmit=\"if(form.login.value=='' || form.pass.value=='' || form.pol.value=='' || form.name.value=='' || form.born_day.value=='' || form.born_month.value=='' || form.born_year.value=='' || form.city.value=='' || form.mail.value==''){alert('ყველა ველი, რომელიც მონიშნულია ვარსკვლავით, უნდა შეივსოს (*)');return false;return true}else{form.submit.disabled='yes'}\">
<input type=hidden name=send value=yes>
<table border=0 align=center>\n";
if($s_pass!=""){
$output.="<br><center><a class='chorbiuro' href='talk.php?name=".addslashes($s_login)."' title='მინი ჩატი'>ჩატი</a></center><br>
<center><details>
    <summary>ანკეტის რედაქტირება</summary><br><div style='text-align:center; max-width: 300px; margin:0px auto 0px auto;'>\n";
}
if($s_pass==""){
$output.="<br><div style='text-align:center; max-width: 300px; margin:0px auto 0px auto;'><input type=text placeholder='მომხმარებელი *' name=login value=\"".addslashes($s_login)."\"><br>
<input type=password placeholder='პაროლი *' name=pass value=\"".addslashes($s_pass)."\"><br>\n";
}else{
$output.="<input type=hidden name=login value=\"".addslashes($s_login)."\"><input type=hidden name=pass value=\"".addslashes($s_pass)."\">\n";
}

$output.="<div style='text-align:center; max-width: 400px; margin:0px auto 0px auto;'><input type=text placeholder='თქვენი სახელი *' name=name value=\"".addslashes($s_name)."\"><br>
<select name=pol>\n";

$select="
<option value=male>მამრობითი
<option value=female>მდედრობითი\n";

if($s_pol!=""){
$select=str_replace("=".$s_pol.">","=".$s_pol." selected>",$select);
}

$output.=$select;

$output.="</select><br>
<select name=born_day>\n";

for($day=1;$day<=31;$day++){
$output.="<option value=".$day;
if($day==$s_day){
$output.=" selected";
}
$output.=">".$day."\n";
}

$output.="</select> <select name=born_month>\n";

$select="<option value=01>იანვარი
<option value=02>თებერვალი
<option value=03>მარტი
<option value=04>აპრილი
<option value=05>მაისი
<option value=06>ივნისი
<option value=07>ივლისი
<option value=08>აგვისტო
<option value=09>სექტემბერი
<option value=10>ოქტომბერი
<option value=11>ნოემბერი
<option value=12>დეკემბერი
</select> <select name=born_year>\n";

if($s_month!=""){
$select=str_replace($s_month.">",$s_month." selected>",$select);
}

$output.=$select;

for($year=1956;$year<=date("Y");$year++){
$output.="<option value=".$year;
if($year==$s_year){
$output.=" selected";
}
$output.=">".$year."\n";
}
$output.="
<input type=text placeholder='ქალაქი *' name=city value=\"".addslashes($s_city)."\"><br>
<input type=text placeholder='სიმაღლე (სმ)' name=growth value=\"".addslashes($s_growth)."\"><br>
<input type=text placeholder='წონა (კგ)' name=weight value=\"".addslashes($s_weight)."\"><br>
<input type=text pattern='[^ @]*@[^ @]*' placeholder='მოქმედი ელ. ფოსტა *' name=mail value=\"".addslashes($s_mail)."\"><br>
<input type=text placeholder='ვებ გვერდი' name=url value=\"".addslashes($s_url)."\"><br>
<input type=text placeholder='ტელ. ნომერი' name=icq value=\"".addslashes($s_icq)."\"><br>
<textarea placeholder='თქვენს შესახებ' name=about cols=22 rows=5>".$s_about."</textarea><br>";

if($s_foto==""){
$output.="[200 kb] ფოტო: ";
}else{
$output.="<a href=foto.php?".$s_foto." target=_blank></a>[200 kb] ფოტო: ";
}

$output.="<input type=file name=foto size=50><br>\n";

if($s_foto!=""){
$output.="<input type=checkbox name=delphoto value=yes id=l1> <label for=l1>ფოტოსურათის წაშლა</label><br>\n";
}
if($s_pass!=""){
$output.="<input type=checkbox name=delanket value=yes id=l2> <label for=l2>ანკეტის წაშლა</label><br>\n";
}

$output.="<input type=submit name=submit value=დამახსოვრება!></div></div>
</table>
</form>
<div align=center></div>";

if($s_pass!=""){
$output.="</details></center><center><details>
    <summary>მომხმარებლის ანკეტა</summary><br><form method=get><input type='hidden' name='act' value='view'><input type='text' placeholder='მომხმარებელი' name='login' value='' required><br><button>ანკეტა</button></form><br></details>\n";
}
return $output;
}
function filterform($s_pol="all",$s_name_param="==",$s_name="",$s_age_min="",$s_age_max="",$s_city_param="==",$s_city=""){
$form="<div class=footer>
      <div class=love><form method=get style=margin-bottom:0>
<input type=hidden name=act value=filter>\n";

$select="<option value=all>ნებისმიერი ანკეტა
<option value=male>მხოლოდ მამრობითი
<option value=female>მხოლოდ მდედრობითი\n";
$select=str_replace("=".$s_pol.">","=".$s_pol." selected>",$select);

$form.="<br><br>
<nobr><select name=pol>".$select."</select> <br> </nobr>\n";

$select="<option value='=='>შეესაბამება
<option value='!='>არ შეესაბამება
<option value='cont'>შეიცავს
<option value='notcont'>არ შეიცავს\n";

$select=str_replace("='{$s_name_param}'>", "='{$s_name_param}' selected>", $select);

$form.="<nobr> <select name=name_param>".$select."</select> <input type=text placeholder='სახელი' name=name size=5 value=\"".$s_name."\"> <br> </nobr>\n";

$select="<option value='=='>შეესაბამება
<option value='!='>არ შეესაბამება
<option value='cont'>შეიცავს
<option value='notcont'>არ შეიცავს\n";

$select=str_replace("='{$s_city_param}'>", "='{$s_city_param}' selected>", $select);

$form.="<nobr> <select name=city_param>".$select."</select> <input type=text placeholder='ქალაქი *' name=city size=5 value=\"".$s_city."\" required> <br> </nobr>
<nobr> <input type=text placeholder='ასაკიდან *' name=age_min size=5 value=\"".$s_age_min."\" maxlength=2 size=10 required>  
<input type=text placeholder='ასაკამდე *' name=age_max size=5 value=\"".$s_age_max."\" maxlength=2 size=10 required> <br> </nobr>
<input type=submit value=ძებნა>
</form></div>
    </div>";

return $form;
}
?>
