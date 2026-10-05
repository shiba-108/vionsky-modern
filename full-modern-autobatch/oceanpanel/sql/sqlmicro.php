<?
// (c)oded by pmbguy 2011
/*
If you make any improvements, please send me a copy...
alasdair.knox@gmail.com
Hope this helps some of y'all out there, I found it super useful already...
pmbguy out!!! (Leave This Text In Script Please Guys)
Finished @ 11:39PM
Wed June 29 2011
*/
/////intialise stuff///
$your_file_name = "sqlmicro.php"; // change the name of the script here,
$action = $_GET['action'];
if ($action=="")
{
 $action=="loginform";
}                                  //and rename the file to match for your own securities sake, lol...
//////////////////
if((isset($_COOKIE['DB_NAME5675']))&&(isset($_COOKIE['DB_HOST5675']))&&(isset($_COOKIE['DB_USER5675']))&&(isset($_COOKIE['DB_PASS5675']))&&($action!="logout"))
 {
$dbname = $_COOKIE["DB_NAME5675"];
$dbhost = $_COOKIE["DB_HOST5675"];
$dbuser = $_COOKIE["DB_USER5675"];
$dbpass = $_COOKIE["DB_PASS5675"];
$inTwoMonths = 60 * 60 * 24 * 60 + time();
$res = setcookie('DB_NAME5675', $dbname, $inTwoMonths);
$res = setcookie('DB_HOST5675', $dbhost, $inTwoMonths);
$res = setcookie('DB_USER5675', $dbuser, $inTwoMonths);
$res = setcookie('DB_PASS5675', $dbpass, $inTwoMonths);
$connect_database = connectdb();
}
else if (($action!="loginform")&&($action!="login")&&($action!="logout"))
{
echo "<meta http-equiv=\"refresh\" content=\"0; URL=$your_file_name?action=loginform\"/>";
}
else if ($action=="logout")
{
$backTwoMonths = time() - (60 * 60 * 24 * 60);
$res = setcookie('DB_NAME5675', "", $backTwoMonths);
$res = setcookie('DB_HOST5675', "", $backTwoMonths);
$res = setcookie('DB_USER5675', "", $backTwoMonths);
$res = setcookie('DB_PASS5675', "", $backTwoMonths);
echo "<meta http-equiv=\"refresh\" content=\"0; URL=$your_file_name?action=loginform\"/>";
echo "You Have Been Logged Out...<br/><a href='$your_file_name?action=loginform'>Login Form</a><br/>";
}

//////////////////
$action = $_GET['action'];
if ($action!="login")
{

?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN""http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Cache-control" content="no-store">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="http://fiwiloads.info/style/pmbguy.css" />
<style>body{

background-color:white;
padding:2px;
border:6px inset grey;
color:black;
}

.mid2{

background-color:silver;
padding:2px;
border:2px solid grey;
color: purple;
}
</style>

<title>SQL-Micro</title>

<?
}
//to put in in stand alone mode uncheck below n fill in info for database n user...
//and add // in front of the include config n include core below


function connectdb()
{
global $dbname, $dbuser, $dbhost, $dbpass;
$conms = @mysql_connect($dbhost,$dbuser,$dbpass); //connect mysql
if(!$conms) return false;
$condb = @mysql_select_db($dbname);
if(!$condb) return false;
return true;
}

if (isset($_POST))
{
$_POST = str_replace("DROP", "", $_POST);
$_POST = str_replace("TRUNCATE", "", $_POST);
$_POST = str_replace("drop", "", $_POST);
$_POST = str_replace("truncate", "", $_POST);
$quoteshtml = "&#34;";
$quotes = '"';
$_POST = str_replace($quotes, "$quoteshtml", $_POST);
$_POST = str_replace ("/&#34;", '"', $_POST);
$quotehtml = "&#39;";
$quote = "'";;
$_POST = str_replace($quote, $quotehtml, $_POST);
$_POST = str_replace ("/$quotehtml", "'", $_POST);
}
$action = $_GET['action'];
$sid = $_GET['sid'];

///////////////////////////
$table = $_POST['table'];
$column = $_POST['column'];
$format = $_POST['format'];
$length = $_POST['length'];
$querythat = $_POST['querythat'];
$what = $_POST['what'];
$variable = $_POST['variable'];
$somethingelse = $_POST['somethingelse'];
$variable2 = $_POST['variable2'];
///////////////////////////

if ((!$connect_database)&&($action!="loginform")&&($action!="login")&&($action!="logout"))
{
 echo "Cannot Connect To Database!!!!<br/>Try Again Later...<br/>";

}
else
{
if ($action=="menu")
{
 echo "<b>SQL MICRO</b><br/>";
 echo "<div style=\"border:1px solid black\">(c)oded by pmbguy</div>";

 $select = "SELECT $something FROM $table WHERE $what='$variable';";


 $alter = "ALTER table $table add column $what $format ($length);";

 
 echo "Select What You Want To Do Below:";

 echo "<br/>";
 echo "1. <a href='$your_file_name?action=create'>CREATE TABLE</a><br/>";
 echo "2. <a href='$your_file_name?action=alter'>ALTER TABLE</a> (Add fields)<br/>";
 echo "3. <a href='$your_file_name?action=select'>SELECT x</a><br/>";
 echo "4. <a href='$your_file_name?action=update'>UPDATE x</a><br/>";
 echo "5. <a href='$your_file_name?action=create'>DELETE FROM x...</a><br/>";
 echo "6. <a href='$your_file_name?action=logout'>LOGOUT</a>";
echo "<div class='mid2'><div class='sitehead'><b>Process Query:</b><br/>(SQL Command)<br/>(<i>This Section Still Giving Issues, Hence The Form Above...</i>)<br/></div>";
echo "<form align=\"left\" action=\"$your_file_name?action=querythat\" method=\"POST\" ENCTYPE=\"multipart/form-data\">";
echo "Enter Query:<br/><input size=\"30\" name=\"querythat\" format=\"text\" value=\"\" maxlength=\"500\"/><br/>";
echo "<br/><input type=\"submit\" value=\"Process Query\"/></form></div>";


}
else if ($action=="create")
{
echo "<div class='mid2'><div class='sitehead'><b>Create Table:</b><br/>(Creates a table with just the <i>id</i> column, you can then add additional columns using the alter table option...)</div>";
echo "<form align=\"left\" action=\"$your_file_name?action=createit\" method=\"POST\" ENCTYPE=\"multipart/form-data\">";
echo "Table Name:<br/><input size=\"30\" name=\"table\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "<br/><input type=\"submit\" value=\"Create Table\"/></form></div>";


echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="login")
{
 $dbname = $_POST['dbnameed']; //change to your mysql database name
$dbhost = $_POST['dbhosted'];//database host name
$dbuser = $_POST['dbusered'];  //database user
$dbpass = $_POST['dbpassed']; //user password
if (($dbname!="")&&($dbhost!="")&&($dbuser!="")&&($dbpass!=""))
{
$inTwoMonths = 60 * 60 * 24 * 60 + time();
$res = setcookie('DB_NAME5675', $dbname, $inTwoMonths);
$res = setcookie('DB_HOST5675', $dbhost, $inTwoMonths);
$res = setcookie('DB_USER5675', $dbuser, $inTwoMonths);
$res = setcookie('DB_PASS5675', $dbpass, $inTwoMonths);
echo "<meta http-equiv=\"refresh\" content=\"0; URL=$your_file_name?action=menu\"/>";
}
else
{
 echo "Please Go Back And Fill In ALL The Boxes Correctly...<br/>";
}
}
else if ($action=="loginform"||$action=="")
{
echo "<div class='mid2'><div class='sitehead'><b>Login 2 Database:</b><br/></div>";
echo "<form align=\"left\" action=\"$your_file_name?action=login\" method=\"POST\" ENCTYPE=\"multipart/form-data\">";
echo "DB Name:<br/><input size=\"30\" name=\"dbnameed\" format=\"text\" value=\"\" maxlength=\"500\"/><br/>";
echo "DB Host:<br/><input size=\"30\" name=\"dbhosted\" format=\"text\" value=\"\" maxlength=\"500\"/><br/>";
echo "DB User:<br/><input size=\"30\" name=\"dbusered\" format=\"text\" value=\"\" maxlength=\"500\"/><br/>";
echo "DB Pass:<br/><input size=\"30\" name=\"dbpassed\" format=\"text\" value=\"\" maxlength=\"500\"/><br/>";
echo "<br/><input type=\"submit\" value=\"Login\"/></form></div>";

}
else if ($action=="createit")
{
$create = "CREATE TABLE $table (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY);";
$pmbguy = $connect->query($create);
if ($pmbguy)
{
 echo "Table Created Successfully...<br/>$create<br/>";

}
else
{
 echo "Couldn't Complete Your Request...<br/>$create<br/>";

 echo mysql_error();

}

echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="alter")
{
echo "<div class='mid2'><div class='sitehead'><b>Alter Table:</b><br/>(Add column)</div>";
echo "<form align=\"left\" action=\"$your_file_name?action=alterit\" method=\"POST\" ENCTYPE=\"multipart/form-data\">";
echo "Table Name:<br/><input size=\"30\" name=\"table\" format=\"*x\" value=\"\" maxlength=\"30\"/><br/>";
echo "Column To Add:<br/><input size=\"30\" name=\"column\" format=\"*x\" value=\"\" maxlength=\"30\"/><br/>";
echo "Format Of Column:<br/>";
echo "<select name=\"format\">";
echo "<option value=\"TEXT\">TEXT</option>";
echo "<option value=\"INT\">INT</option>";
echo "<option value=\"VARCHAR\">VARCHAR</option>";
echo "</select><br/>";
echo "Number Of Chars:<br/>";
echo "<select name=\"length\">";
echo "<option value=\"1\">1</option>";
echo "<option value=\"5\">5</option>";
echo "<option value=\"25\">25</option>";
echo "<option value=\"100\">100</option>";
echo "<option value=\"250\">250</option>";
echo "<option value=\"800\">800</option>";
echo "<option value=\"1500\">1500</option>";
echo "<option value=\"2500\">2500</option>";
echo "<option value=\"5000\">5000</option>";
echo "</select><br/>";
echo "<br/><input type=\"submit\" value=\"Alter Table\"/></form></div>";


echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="alterit")
{
  $querythis = "alter table $table add column $column $format ($length);";
 $goforit = $connect->query("$querythis");
 if ($goforit)
 {
 echo "$table Modified Successfully...<br/>$querythis<br/>";

 }
else
 {
 echo "Error Occured While Trying To Modify $table<br/>$querythis<br/>";

 echo mysql_error();

 }

echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="select")
{
echo "<div class='mid2'><div class='sitehead'><b>SELECT:</b><br/>(Retrive One Value)</div>";
echo "<form align=\"left\" action=\"$your_file_name?action=selectit\" method=\"POST\" ENCTYPE=\"multipart/form-data\">";
echo "Table Name:<br/><input size=\"30\" name=\"table\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "Column To Request:<br/><input size=\"30\" name=\"column\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "WHERE (x):<br/><input size=\"30\" name=\"format\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "Equals What:<br/><input size=\"30\" name=\"length\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "<br/><input type=\"submit\" value=\"Request\"/></form></div>";


echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="selectit")
{
  $querythis = "SELECT $column FROM $table WHERE $format='$length';";
$update = $connect->query("$querythis");
 if ($update)
 {
 if (($querythis[0]=="s"||$querythis[0]=="S")&&($querythis[1]=="e"||$querythis[1]=="E"))
 {
  $result = $connect->fetch_array($update);
  echo "<div>Result: ".$result[0]."</div><br/>";

 }
  echo "Success!!!<br/>$querythis<br/>";
 }
 else
 {
 echo "Error Occured...<br/>$querythis<br/>";

  echo mysql_error();

}

echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="update")
{
 echo "<div class='mid2'><div class='sitehead'><b>UPDATE:</b></div>";
echo "<form align=\"left\" action=\"$your_file_name?action=updateit\" method=\"POST\" ENCTYPE=\"multipart/form-data\">";
echo "Table Name:<br/><input size=\"30\" name=\"table\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "What To (variable name):<br/><input size=\"30\" name=\"what\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "Set To (value):<br/><input size=\"30\" name=\"variable\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "WHERE (variable name):<br/><input size=\"30\" name=\"somethingelse\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "Equals What:<br/><input size=\"30\" name=\"variable2\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "<br/><input type=\"submit\" value=\"Request\"/></form></div>";


echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="updateit")
{
 $update = "UPDATE $table SET $what='$variable' WHERE $somethingelse='$variable2';";
 $doit = $connect->query($update);
 if ($doit)
 {

  echo "Success!!!<br/>$update<br/>";
 }
 else
 {
 echo "Error Occured...<br/>$update<br/>";

  echo mysql_error();

}

echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="delete")
{
 echo "<div class='mid2'><div class='sitehead'><b>UPDATE:</b></div>";
echo "<form align=\"left\" action=\"$your_file_name?action=deleteit\" method=\"POST\" ENCTYPE=\"multipart/form-data\">";
echo "Delete From Table:<br/><input size=\"30\" name=\"table\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "Where (variable name):<br/><input size=\"30\" name=\"what\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "Equals What:<br/><input size=\"30\" name=\"variable\" format=\"text\" value=\"\" maxlength=\"30\"/><br/>";
echo "<br/><input type=\"submit\" value=\"Request\"/></form></div>";


echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="deleteit")
{
 $delete = "DELETE FROM $table WHERE $what='$variable'";
 $doit = $connect->query($delete);
  if ($doit)
 {

  echo "Success!!!<br/>$update<br/>";
 }
 else
 {
 echo "Error Occured...<br/>$update<br/>";

  echo mysql_error();

}

echo "<a href=\"$your_file_name?action=menu\">SQL MICRO</a>";
}
else if ($action=="querythat")
{
 //$querythis = "SELECT $column FROM $table WHERE $format='$length';";
$update = $connect->query("$querythat");
 if ($update)
 {
 if (($querythat[0]=="s"||$querythat[0]=="S")&&($querythat[1]=="e"||$querythat[1]=="E"))
 {
  $result = $connect->fetch_array($update);
  echo "<div>Result: ".$result[0]."</div><br/>";
 }
 

  echo "Success!!!<br/>$querythat<br/>";
 }
 else
{
echo "Error Occured...<br/>$querythat<br/>";

  echo mysql_error();

}
 }

}
?>
</BODY>
</HTML>
