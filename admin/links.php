<?
require( '../config.php' );
session_start();
switch (isset($_SESSION[usernameadmin])) {
     case TRUE:
$_SESSION['username'] = $_SESSION[usernameadmin];
$username = $_SESSION['username'];
           break;
     case FALSE:
echo"
<form action=\"index.php\" method=\"POST\">
            <tr>
              <td width=\"100%\">
                <p align=\"center\"><font face=\"Verdana\" size=\"2\">&nbsp;<br>Username</font></td>
            </tr>
            <tr>
              <td width=\"100%\">
                <p align=\"center\"><input style=\"FONT-WEIGHT: bold; FONT-SIZE: 8pt; BORDER-LEFT-COLOR: #141721; BORDER-BOTTOM-COLOR: #141721; COLOR: #c0c0c0; BORDER-TOP-STYLE: solid; BORDER-TOP-COLOR: #141721; FONT-FAMILY: Verdana; BORDER-RIGHT-STYLE: solid; BORDER-LEFT-STYLE: solid; BACKGROUND-COLOR: #000000; BORDER-RIGHT-COLOR: #141721; BORDER-BOTTOM-STYLE: solid\" size=\"15\" name=\"username\"></td>
            </tr>
            <tr>
              <td width=\"100%\">
                <p align=\"center\"><font face=\"Verdana\" size=\"2\">Password</font></td>
            </tr>
            <tr>
              <td width=\"100%\">
                <p align=\"center\"><input type =\"password\" style=\"FONT-WEIGHT: bold; FONT-SIZE: 8pt; BORDER-LEFT-COLOR: #141721; BORDER-BOTTOM-COLOR: #141721; COLOR: #c0c0c0; BORDER-TOP-STYLE: solid; BORDER-TOP-COLOR: #141721; FONT-FAMILY: Verdana; BORDER-RIGHT-STYLE: solid; BORDER-LEFT-STYLE: solid; BACKGROUND-COLOR: #000000; BORDER-RIGHT-COLOR: #141721; BORDER-BOTTOM-STYLE: solid\" size=\"15\" name=\"password\"></td>
            </tr>
            <tr>
              <td width=\"100%\">
                <p align=\"center\"><font face=\"Verdana\" size=\"2\"><input style=\"FONT-WEIGHT: bold; FONT-SIZE: 8pt; BORDER-LEFT-COLOR: #141721; BORDER-BOTTOM-COLOR: #141721; COLOR: #c0c0c0; BORDER-TOP-STYLE: solid; BORDER-TOP-COLOR: #141721; FONT-FAMILY: Verdana; BORDER-RIGHT-STYLE: solid; BORDER-LEFT-STYLE: solid; BACKGROUND-COLOR: #000000; BORDER-RIGHT-COLOR: #141721; BORDER-BOTTOM-STYLE: solid\" type=\"submit\" value=\"Submit\"><input style=\"FONT-WEIGHT: bold; FONT-SIZE: 8pt; BORDER-LEFT-COLOR: #141721; BORDER-BOTTOM-COLOR: #141721; COLOR: #c0c0c0; BORDER-TOP-STYLE: solid; BORDER-TOP-COLOR: #141721; FONT-FAMILY: Verdana; BORDER-RIGHT-STYLE: solid; BORDER-LEFT-STYLE: solid; BACKGROUND-COLOR: #000000; BORDER-RIGHT-COLOR: #141721; BORDER-BOTTOM-STYLE: solid\" type=\"reset\" value=\"Reset\"><br>&nbsp;</font></td>
            </tr>
</form>
";
die;
}
if ($_GET["task"] == "logout")
{
session_unset();
session_destroy();
header("Location: ../index.php"); 
exit();
	}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link href="../style.css" rel="stylesheet" type="text/css">
<script src="../javascript.js" language="Javascript"></script>
<title>Delta Force League - Administrator</title>
</head>
<body bgcolor="#202020" leftmargin="0" topmargin="0" text="#EEC6A2" link="#C67B41" vlink="#C67B41" alink="#C67B41">
<div align="center">
  <center>
  <table border="0" cellpadding="0" cellspacing="1" width="800" bgcolor="#171717">
    <tr>
      <td width="100%" bgcolor="#202020" colspan="3">
        <p align="center"><font face="Verdana" size="2"><img border="0" src="images/banner.jpg" width="800" height="95"></font></td>
    </tr>
    <tr>
      <td width="20%" bgcolor="#363F5A">
        <p style="margin-left: 10" align="center"><font face="Verdana" size="2"><b>NAVIGATION</b></font></td>
      <td width="20%" bgcolor="#363F5A">
        <p style="margin-left: 10"><b><font face="Verdana" size="2" color="#FFFFFF">LINKS LIST</font></b></td>
      <td width="60%" bgcolor="#363F5A">
        <p style="margin-left: 10" align="center"><b><font face="Verdana" size="2"><? print date ("l F d Y, H:i:s"); ?></font></b></td>
    </tr>
    <tr>
	<center>
      <td width="20%" bgcolor="#141721" valign="top">
          <table border="0" cellpadding="0" cellspacing="1" width="100%"><? include "navigation.php"; ?></table>
		</center>
      </td>
      <td width="80%" bgcolor="#202020" colspan="2" valign="top">
        <p align="center"><font face="Verdana" size="1">&nbsp;</font>
<?
	if ($_GET["task"] == "del")
	{
		$id = $_GET["id"];
        $SQL  = " DELETE FROM links ";
        $SQL .= "WHERE id = $id ";
        mysql_db_query($db, $SQL, $cid);
        if (mysql_error()) { print "Database Error: $sql " . mysql_error();}
        print "<center><font face=\"Verdana\" size=\"2\">Link ID# $id Deleted from Database.</font></center><br>";
	}
?>
  <center>
  <table border="0" width="50%" cellspacing="0" cellpadding="0">
    <tr>
      <td width="33.3%"><font face="Verdana" size="2"><b>Link ID</b></font></td>
      <td width="33.3%"><font face="Verdana" size="2"><b>Site Name</b></font></td>
      <td width="33.3%"><font face="Verdana" size="2"><b>Command</b></font></td>
    </tr>
  </table>
<table border=\"0\" width=\"2000%\" cellspacing=\"0\" cellpadding=\"0\">
<?

	$sql = " SELECT * FROM links ";
	$rs = mysql_query($sql, $cid);
    if (mysql_error()) { print "Database Error: $sql " . mysql_error(); }

	print "<p><table cellpadding=4>\n";
    while ($row = mysql_fetch_array($rs)) 
    {
        $sitename = $row["sitename"];
        $id = $row["id"];

        print "
<tr>
<td width=\"33.3%\"><font face=\"Verdana\" size=\"2\">$id</font></td>
<td width=\"33.3%\"><font face=\"Verdana\" size=\"2\">$sitename</font></td>
<td width=\"17%\"><font face=\"Verdana\" size=\"2\"><a href=\"links1.php?id=$id\">Edit</a></font></td>
<td width=\"16%\"><font face=\"Verdana\" size=\"2\"><a href=\"$_SERVER[PHP_SELF]?id=$id&task=del\">Delete</a></font></td>
</tr>
";
    }
?>
  </table>
</center>
        <p align="center"><font face="Verdana" size="1">&nbsp;</font>
</td>
        </div>
        <p style="margin-left: 10">&nbsp;</td>
    </tr>
    <tr>
      <td width="100%" bgcolor="#1B1B1B" colspan="4"><? include "footer.php"; ?></td>
    </tr>
  </table>
  </center>
</div>
</body>
</html>