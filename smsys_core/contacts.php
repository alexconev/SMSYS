<?php

class Contacts {

	public function importContacts($strFile){
		$strContent = file_get_contents($strFile);

		$arContacts = array();
		$i = 1; $nST = 0; $nEND = 0;
		while(($nST = strpos($strContent, "BEGIN:VCARD", $nEND)) !== FALSE){
			$nPos = strpos($strContent, "FN:", $nST);
			$nPos2 = strpos($strContent, "\r\n", $nPos);
			$arContacts[$i]['name'] = str_replace(array("/M","/H","/O"), array("","",""),substr($strContent, $nPos+3, $nPos2-$nPos-3));

			$nPos = strpos($strContent, "TEL;CELL;PREF:", $nST);
			$nPos2 = strpos($strContent, "\r\n", $nPos);
			$arContacts[$i]['phone'] = preg_replace('/^\\+359/', '0', substr($strContent, $nPos+14, $nPos2-$nPos-14));

			$i++; $nEND = strpos($strContent, "END:VCARD", $nST);
		}

		require_once(dirname(__FILE__)."/mysql.php");

		$pDB = new MySql();

		foreach ($arContacts as $value) {
			$pDB->Query("DELETE FROM `phonebook` WHERE `Phone` = '".$value['phone']."' OR `Name` = '".$value['name']."'");
			$pDB->Query("INSERT INTO `phonebook`(`Name`, `Phone`, `GroupID`) VALUES ('".$value['name']."','".$value['phone']."','0')");
		}
	}

	public function exportContacts(){
		require_once(dirname(__FILE__)."/mysql.php");
		$pDB = new MySql();
		$pDB->Query("SELECT `phonebook`.`Name`, `phonebook`.`Phone` FROM `phonebook` ORDER BY phonebook`.`Name` ASC");

		header("Content-Disposition: attachment; filename=\"smsys_".date("Y-m-d_His").".vcf");
		header("Content-Type: application/force-download");

		while ($arContact = $pDB->FetchAssoc()) {
			echo "BEGIN:VCARD\nVERSION:2.1\nN:;".$arContact['Name'].";;;\nFN:".$arContact['Name']."\nTEL;CELL;PREF:".$arContact['Phone']."\nEND:VCARD\n";
		}
	}
}
?>