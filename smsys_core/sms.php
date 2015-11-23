<?php

class SMScore {

	private static $strServerPath = "/srv/http/";

        public static function getSMS(){
                $i = 1;
                $arSMS = array();

                while (file_exists(SMScore::$strServerPath.'.sendsms')) { sleep(1); }

                for($j = 1; $j < 4; $j+=2)
                        do{
                                exec("gammu getsms ".$j." ".$i.' > '.SMScore::$strServerPath.".sms");
                                $strContent = file_get_contents(SMScore::$strServerPath.'.sms');

                                $nAttempts = 0;
                                while(strpos($strContent,"Waiting for PIN") && $nAttempts < 2) {
                                        exec("gammu entersecuritycode PIN 0000");
                                        //error_log(date("h:i:s ")." gammu entersecuritycode PIN 0000\n", 3, '../sms_log/'.date('Y-m-d').'.log');
                                        sleep(1);
                                        $nAttempts++;
                                }

                                if($nAttempts == 2) $this->strErrors[] = "Problem with PIN entering!!! Made 2 attempts!!!";
                                else{
                                        $lamp = strpos($strContent, 'Empty') === FALSE;
                                        if($lamp){
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

                                                exec("gammu deletesms ".$j." ".$i);
                                        }
                                }
                        }while($lamp);

                unlink(SMScore::$strServerPath.'.sms');

                require_once(dirname(__FILE__)."/mysql.php");
                $pDB = new MySql();

                foreach ($arSMS as $value) {
                        $pDB->Query("INSERT INTO `sms_inbox`(`Sender`, `Content`) VALUES ('".$value['number']."','".$value['content']."')");
                }
        }   

        public static function sendSMS($phone, $mess){
                while (file_exists(SMScore::$strServerPath.'.sms')) { sleep(1); }
                
                exec('echo "qwerty" | echo "'.$mess.'" | sudo gammu sendsms TEXT '.$phone.' > '.SMScore::$strServerPath.".sendsms");
                $pDB->Log('echo "'.$mess.'" | gammu sendsms TEXT '.$phone.' > '.SMScore::$strServerPath.".sendsms");

                require_once(dirname(__FILE__)."/mysql.php");
                $pDB = new MySql();
                
                $pDB->Log(file_get_contents(SMScore::$strServerPath.'.sendsms'));
                $pDB->Log("Sent message");

                unlink(SMScore::$strServerPath.'.sendsms');
        }

        public function exportSMS(){
                require_once(dirname(__FILE__)."/mysql.php");
                $pDB = new MySql();
                

                header("Content-Disposition: attachment; filename=\"smsys_".date("Y-m-d_His").".xml");
                header("Content-Type: application/force-download");

                echo "<?xml version='1.0' encoding='UTF-8'?>\n<channel>\n\t<title>Export :: SMSYS</title>\n\t<pubDate>".date("D, j M Y G:i:s T")."</pubDate>\n";
                echo "\t<inbox>\n";
                $pDB->Query("SELECT * FROM sms_inbox ORDER BY `Date` DESC");
                while ($arSMS = $pDB->FetchAssoc()) {
                        echo "\t\t<item>\n\t\t\t<datetime>".date("Y-m-d H:i:s", strtotime($arSMS['Date']))."</datetime>\n\t\t\t<number>".$arSMS['Sender']."</number>\n\t\t\t<content>".$arSMS['Content']."</content>\n\t\t</item>\n";
                }
                echo "\t</inbox>\n";
                echo "\t<outbox>\n";
                $pDB->Query("SELECT * FROM sms_outbox ORDER BY `Date` DESC");
                while ($arSMS = $pDB->FetchAssoc()) {
                        echo "\t\t<item>\n\t\t\t<datetime>".date("Y-m-d H:i:s", strtotime($arSMS['Date']))."</datetime>\n\t\t\t<number>".$arSMS['Recipient']."</number>\n\t\t\t<content>".$arSMS['Content']."</content>\n\t\t</item>\n";
                }
                echo "\t</outbox>\n";                
                echo "</channel>";

                $pDB->Log("Export inbox SMSs");
        }        
}
?>
