<?php
function pr($printr, $die = true) {
    echo "<pre>";
    print_r($printr);
    echo "</pre>";
    if ($die == true) {
        die();
    }
}
function get_main_factor($id) {
    $ci = & get_instance();
    $query = $ci->db->select('Faktor')
                    ->from('tbl_Aktivitet')
                    ->where('id', $id)->get();
          $data = $query->row();          
   return $data->Faktor;
}


?>