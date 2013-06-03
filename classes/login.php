<?php
class Login
{
    private static $me;
    public function __construct()
    {
        $security = Security::getSecurity();
        $db = Database::getDatabase();
    }
    public static function getLogin()
    {
      if(is_null(self::$me))
         self::$me = new Login ();
      return self::$me;
    }
    
   public function adminlogin($username,$password)
   {
       $tiba_session = Session::getSesstion();
       
       $security = Security::getSecurity();
       
       $db = Database::getDatabase();
       
       $username = $security->xss_clean($username);
       $password = $security->xss_clean($password);
       $password = $password = md5($password);
       $db->cmd = "SELECT * FROM `users` " .
                            "WHERE (`username`='$username') AND (`password`='$password') limit 1";
       $res =$db->RunSQL();
       if (mysql_num_rows($res)!=1) return false;
       
       $row = mysql_fetch_assoc($res);
       $tiba_session->set("login",true);
       $tiba_session->set("username",$row["username"]);
       $tiba_session->set("name",$row["name"]);
       $tiba_session->set("family",$row["family"]);       
       return true;
   } 
}

?>