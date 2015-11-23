<?php

require_once "settings.php";

if(!isset($_SERVER['REMOTE_ADDR'])) $_SERVER['REMOTE_ADDR'] = "127.0.0.1";
if(!isset($_SERVER['REQUEST_URI'])) $_SERVER['REQUEST_URI'] = "/srv/http/smsys_core/";

class MySql{

	private $strHost;
	private $strUser;
	private $strPass;
	private $strDB;

	protected $mConn;
	protected $mCurs;

	function MySql() {
		$this->SQLLog("\n#[".date("H:i:s")."] - ".$_SERVER['REMOTE_ADDR'].' - '.$_SERVER['REQUEST_URI']);

		$this->strHost = defined('MYSQL_HOST') ? MYSQL_HOST : '';
		$this->strUser = defined('MYSQL_USERNAME') ? MYSQL_USERNAME : '';
		$this->strPass = defined('MYSQL_PASSWORD') ? MYSQL_PASSWORD : '';
		$this->strDB = defined('MYSQL_DATABASE') ? MYSQL_DATABASE : '';

		$this->mConn = mysqli_connect($this->strHost, $this->strUser, $this->strPass, $this->strDB);
		if ( !$this->mConn ){
            trigger_error( mysqli_connect_error(), E_USER_ERROR );
            return FALSE;     
        }	

		$this->Query('set names utf8');
	}

    public function Query( $sqlQuery ) {
        $sqlQuery = trim($sqlQuery);

        if (empty($sqlQuery)) {
            trigger_error('Empty query in method Query on class MySQL', E_USER_ERROR); 
            return FALSE;
        }
         
        $this->SQLLog("\n$sqlQuery\n");

       	if($this->mConn !== FALSE){
        	$this->mCurs = mysqli_query($this->mConn, $sqlQuery);
        }
        
        if (!$this->mCurs){
            trigger_error($sqlQuery . '<p>&nbsp;</p>' . mysqli_error($this->mConn), E_USER_ERROR); 
            return FALSE;
        }
        
        return $this->mCurs;
    }  

    public function Log($mess){
        mysqli_query($this->mConn, "INSERT INTO `log` (`Message`) VALUES ('".$mess."')");
    }

	public function FetchAssoc( $hCursor = null ){
		
		if ( $this->mCurs ) return mysqli_fetch_assoc( $this->mCurs );
		else if($hCursor) return mysqli_fetch_assoc( $hCursor );
        
        return FALSE;
    }

    private function SQLLog( $strQuery ){         
        
        if (defined('SQLLOG')) error_log($strQuery, 3, SQLLOG.date('Y-m-d').'.sql'); 
    }
}


?>