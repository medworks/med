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
            return '<div class="error">
                        <img src="images/msg/error.png" alert="error" style="width:48px; height:48px; float:right; margin-right:250px">
                        <p style="font-family:\'bmitra\'; font-size:20px; float:right; margin-top:20px; margin-right:10px;">'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowInfo($msg)
    {     
            return '<div class="info">
                        <img src="images/msg/info.png" alert="info" style="width:48px; height:48px; float:right; margin-right:250px">
                             <p style="font-family:\'bmitra\'; font-size:20px; float:right; margin-top:20px; margin-right:10px;">'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowSuccess($msg)
    {            
            return '<div class="success">
                      <img src="images/msg/success.png" alert="success" style="width:48px; height:48px; float:right; margin-right:250px">
                      <p style="font-family:\'bmitra\'; font-size:20px; float:right; margin-top:20px; margin-right:10px;">'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowComment($msg)
    {     
            return '<div class="comment">
                      <img src="images/msg/comment.png" alert="comment" style="width:48px; height:48px; float:right; margin-right:250px">
                      <p style="font-family:\'bmitra\'; font-size:20px; float:right; margin-top:20px; margin-right:10px;">' . $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }

}

?>