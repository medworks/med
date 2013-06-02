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
          self::$me = new Message();
     return self::$me;
   }  
   
   public function ShowError($msg)
    {     
            return '<table class="error" width="100%"><tr><td valign="middle">' .
                            '<img src="themes/default/images/msg/error.png" width="48" height="48"></td>' .
                            '<td>' . $msg . "</td></tr></table>";
    }
    
   public function ShowInfo($msg)
    {     
            return '<table class="info" width="100%"><tr><td valign="middle">' .
                            '<img src="themes/default/images/msg/info.png" width="48" height="48"></td>' .
                            '<td>' . $msg . "</td></tr></table>";
    }
    
   public function ShowSuccess($msg)
    {            
            return "<table class='success' width='100%'><tr><td valign='middle'>" .
                            "<img src='themes/default/images/msg/success.png' width='48' height='48'></td>" .
                            "<td>" . $msg . "</td></tr></table>";
    }
    
   public function ShowComment($msg)
    {     
            return '<table class="comment" width="100%"><tr><td valign="middle">' .
                            '<img src="themes/default/images/msg/comment.png" width="32" height="32"></td>' .
                            '<td>' . $msg . "</td></tr></table>";
    }

}

?>