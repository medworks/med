<?php
class Login
{
    private static $me;
    public function __construct()
    {
        $security = Security::getSecurity();
        $db = Database::getDatabase();
    }
    public static function GetLogin()
    {
      if(is_null(self::$me))
         self::$me = new Login ();
      return self::$me;
    }
    
   public function AdminLogin($username,$password)
   {
       $sess = Session::getSesstion();
       
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
       $sess->set("login",true);
       $sess->set("username",$row["username"]);
       $sess->set("name",$row["name"]);
       $sess->set("family",$row["family"]);       
       return true;
   } 
	function LogOut()
	{
			$sess = Session::getSesstion();
            return ($sess->delete("login") and $sess->delete("username") and $sess->delete("name") and $sess->delete("family"));
	}	
		
	function IsLogged()
	{
		$sess = Session::getSesstion();
		if ($sess->get("login")) 
		{
			return true;
		}	else return false;
	}   
}

?>