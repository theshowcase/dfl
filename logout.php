<?
session_start();
switch (isset($_SESSION[username])) {
     case TRUE:
session_unset();
session_destroy();
echo"
logged out!
";
           break;
     case FALSE:
header("Location: member.php"); 
            eak;
}
?>