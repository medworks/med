<?php
class Message
{
    private static $me;
    
   function __construct()
   {
                    
   }
   
   public static function getMessage()
   {
      if(is_null(self::$me))
          self::$me = new Database();
     return self::$me;
   }  
   
   public function ShowError($msg)
    {
            $DBase = new Database();
            return '<table class="error" width="100%"><tr><td valign="middle">' .
                            '<img src="'.$DBase->Site_Theme_Add.'msg/error.png" width="48" height="48"></td>' .
                            '<td>' . $msg . "</td></tr></table>";
    }
    
   public function ShowInfo($msg)
    {
            $DBase = new Database();
            return '<table class="info" width="100%"><tr><td valign="middle">' .
                            '<img src="'.$DBase->Site_Theme_Add.'msg/info.png" width="48" height="48"></td>' .
                            '<td>' . $msg . "</td></tr></table>";
    }
    
   public function ShowSuccess($msg)
    {
            $DBase = new Database();
            return '<table class="success" width="100%"><tr><td valign="middle">' .
                            '<img src="'.$DBase->Site_Theme_Add.'msg/success.png" width="48" height="48"></td>' .
                            '<td>' . $msg . "</td></tr></table>";
    }
    
   public function ShowComment($msg)
    {
            $DBase = new Database();
            return '<table class="comment" width="100%"><tr><td valign="middle">' .
                            '<img src="'.$DBase->Site_Theme_Add.'msg/comment.png" width="32" height="32"></td>' .
                            '<td>' . $msg . "</td></tr></table>";
    }

}

?>