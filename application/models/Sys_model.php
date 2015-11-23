<?php
class Sys_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_logs($nPerPage = 14){
          
          $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

          $query = $this->db->limit($nPerPage, ($page-1)*$nPerPage)->order_by('Date', "DESC")->get('log');
          return $query->result_array();
    }

    public function get_logs_cnt(){
        $query = $this->db->select('count(ID) as cnt')->get('log');
        $res = $query->row_array();
        return (int)$res['cnt'];
    }     

    public function get_stats(){
      $arIn = $this->db->query("SELECT DAY(`Date`) as Day, count(id) as CountIn FROM sms_inbox WHERE `Date` > '".date("Y-m-d H:i:s",strtotime("-1 month"))."' GROUP BY `Day`")->result_array();
      $arOut = $this->db->query("SELECT DAY(`Date`) as Day, count(id) as CountOut FROM sms_outbox WHERE `Date` > '".date("Y-m-d H:i:s",strtotime("-1 month"))."' GROUP BY `Day`")->result_array();

      $arInbox = array();
      foreach ($arIn as $value) {
        $arInbox[$value['Day']] = $value['CountIn'];
      }

      $arOutbox = array();
      foreach ($arOut as $value) {
        $arOutbox[$value['Day']] = $value['CountOut'];
      }

      $arRes = array();
      $i = 1;
      while($i <= date('d')){
        if(isset($arInbox[$i])) $arRes[$i]['inbox'] = $arInbox[$i];
        else $arRes[$i]['inbox'] = 0;
        if(isset($arOutbox[$i])) $arRes[$i]['outbox'] = $arOutbox[$i];
        else $arRes[$i]['outbox'] = 0;
        $i++;
      }

      return $arRes;
    }
}