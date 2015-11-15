<?php

require_once "settings.php";

class MySql{

	private $strHost;
	private $strUser;
	private $strPass;
	private $strDB;

	protected $mConn;
	protected $mCurs;

	function MySql(){
		$this->SQLLog("\n#[".date("H:i:s")."] - ".$_SERVER['REMOTE_ADDR'].' - '.$_SERVER['REQUEST_URI']);

		$this->strHost = defined('MYSQL_HOST') ? MYSQL_HOST : '';
		$this->strUser = defined('MYSQL_USERNAME') ? MYSQL_USERNAME : '';
		$this->strPass = defined('MYSQL_PASSWORD') ? MYSQL_PASSWORD : '';
		$this->strDB = defined('MYSQL_DATABASE') ? MYSQL_DATABASE : '';

		$this->mConn = mysql_connect($this->strHost, $this->strUser, $this->strPass, TRUE);
		if ( !$this->mConn ){
            trigger_error( mysql_error(), E_USER_ERROR );
            return FALSE;     
        } else if ( !$this->ChangeDatabase() ) {
            return FALSE;
        } 		

		$this->Query('set names utf8');
	}

    public function ChangeDatabase($strDatabase = '') 
    {              
        if(empty($strDatabase)){
            $strDatabase = $this->strDB;    
        }
        if ( !mysql_select_db( $strDatabase ) ) {
            trigger_error(mysql_error(), E_USER_ERROR); 
            return FALSE;
        } 
        
        return TRUE; 
    }

    public function Query( $sqlQuery ) 
    {
        $sqlQuery = trim($sqlQuery);

        if (empty($sqlQuery)) {
            trigger_error('Empty query in method Query on class MySQL', E_USER_ERROR); 
            return FALSE;
        }
         
        $this->SQLLog("\n$sqlQuery\n");

       	if($this->mConn !== FALSE){
        	$this->mCurs = mysql_query($sqlQuery, $this->mConn);
        }
        
        if (!$this->mCurs){
            trigger_error($sqlQuery . '<p>&nbsp;</p>' . mysql_error(), E_USER_ERROR); 
            return FALSE;
        }
        
        return $this->mCurs;
    }  

	public function FetchAssoc($hCursor = null){
		
		if ( $this->mCurs ) return mysql_fetch_assoc( $this->mCurs );
		else if($hCursor) return mysql_fetch_assoc( $hCursor );
        
        return FALSE;
    }

    public function Result( $hCursor = null, $row = 0 ){
		
		if ( $this->mCurs ) return mysql_result( $this->mCurs, $row );
		else if( $hCursor ) return mysql_result( $hCursor, $row );

		return FALSE;
    }

    private function SQLLog($strQuery){         
        
        if (defined('SQLLOG')) error_log($strQuery, 3, SQLLOG.date('Y-m-d').'.sql'); 
    }
}


?>