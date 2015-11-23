<?php

require_once "settings.php";

class Network {

	private $strServerPath = "/srv/http/";
        private $strContent = '';
	private $strErrors = array();

	public function __construct(){
		exec("gammu monitor 1 > ".$this->strServerPath.".network");
                //error_log(date("h:i:s ")."gammu monitor 1 > ".$this->strServerPath.".network\n", 3, '../sms_log/'.date('Y-m-d').'.log');
                $this->strContent = file_get_contents($this->strServerPath.'.network');
                
                $nAttempts = 0;
                while(strpos($this->strContent,"Waiting for PIN") && $nAttempts < 2) {
                        exec("gammu entersecuritycode PIN 0000");
                        //error_log(date("h:i:s ")." gammu entersecuritycode PIN 0000\n", 3, '../sms_log/'.date('Y-m-d').'.log');
                        sleep(1);
                        $nAttempts++;
                }

                if($nAttempts == 2){
                        $this->strErrors[] = "Problem with PIN entering!!! Made 2 attempts!!!";
                }
                else{
                        exec("gammu monitor 1 > ".$this->strServerPath.".network");
                        //error_log(date("h:i:s ")."gammu monitor 1 > ".$this->strServerPath.".network\n", 3, '../sms_log/'.date('Y-m-d').'.log');
                        $this->strContent = file_get_contents($this->strServerPath.'.network');                        
                }
	}

        public function getSignal(){
                $nPos = strpos($this->strContent, 'Network level');
                $nPos2 = strpos($this->strContent, ' percent',$nPos+1);
                return substr($this->strContent, $nPos+23, $nPos2-$nPos-23);
        }

        public function getNetwork(){
                $nPos = strpos($this->strContent, 'Name in phone        :');
                $nPos2 = strpos($this->strContent, '"',$nPos+24);
                return substr($this->strContent, $nPos+24, $nPos2-$nPos-24);
        }        

        public function getJSONState(){
                $res = array();
                if(!empty($this->strErrors)){
                        $i = 0;
                        foreach ($this->strErrors as $value) {
                                $res['error'.$i] = $value;
                                $i++;
                        }
                }else{
                        $res['signal'] = $this->getSignal();
                        $res['network'] = $this->getNetwork();
                }

                require_once(dirname(__FILE__)."/mysql.php");
                $pDB = new MySql();
                //$pDB->Log(json_encode($res));

                return json_encode($res);
        }
}

?>
