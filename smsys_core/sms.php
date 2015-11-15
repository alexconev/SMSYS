<?php

class SMS {

	private static $strServerPath = "/srv/http/";

        public static function getSMS(){
                $i = 1;
                $arSMS = array();

                do{
                        exec("gammu getsms 1 ".$i.' > '.SMS::$strServerPath.".sms");
                        $strContent = file_get_contents(SMS::$strServerPath.'.sms');

                        $lamp = strpos($strContent, 'Empty') === FALSE;
                        if($lamp)
                        {
                                $nPos = strpos($strContent, 'Sent                 : ');
                                $nPos2 = strpos($strContent, "\n",$nPos+23);
                                $arSMS[$i-1]['date'] = substr($strContent, $nPos+23, $nPos2-$nPos-23);  

                                $nPos = strpos($strContent, 'Remote number        : "');
                                $nPos2 = strpos($strContent, '"',$nPos+24);
                                $arSMS[$i-1]['number'] = substr($strContent, $nPos+24, $nPos2-$nPos-24);

                                $nPos = strpos($strContent, 'Status               : ');
                                $nPos = strpos($strContent, "\n",$nPos+23);
                                $nPos = strpos($strContent, "\n",$nPos+1);
                                $nPos2 = strpos($strContent, "\n",$nPos+1);
                                $arSMS[$i-1]['content'] = substr($strContent, $nPos+1, $nPos2-$nPos-1); 

                                $i++;

                                //exec("gammu deletesms 1 ".$i);
                        }
                }while($lamp);

                return json_encode($arSMS);
        }       
}

echo SMS::getSMS();

?>
