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
                        <img src="themes/default/images/msg/error.png" style="width:48px; height:48px; float:right; margin-right:250px">
                        <p style="font-family:\'bmitra\'; font-size:20px; float:right; margin-top:20px; margin-right:10px;">'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowInfo($msg)
    {     
            return '<div class="info">
                        <img src="themes/default/images/msg/info.png" style="width:48px; height:48px; float:right; margin-right:250px">
                             <p style="font-family:\'bmitra\'; font-size:20px; float:right; margin-top:20px; margin-right:10px;">'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowSuccess($msg)
    {            
            return '<div class="success">
                      <img src="themes/default/images/msg/success.png" style="width:48px; height:48px; float:right; margin-right:250px">
                      <p style="font-family:\'bmitra\'; font-size:20px; float:right; margin-top:20px; margin-right:10px;">'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowComment($msg)
    {     
            return '<div class="comment">
                      <img src="themes/default/images/msg/comment.png" style="width:48px; height:48px; float:right; margin-right:250px">
                      <p style="font-family:\'bmitra\'; font-size:20px; float:right; margin-top:20px; margin-right:10px;">' . $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }

}

?>