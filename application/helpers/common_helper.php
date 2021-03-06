<?php

function send_mail($data) {
    if (empty($data['to']) || empty($data['subject']) || empty($data['email_template'])) {
        return false;
    }

    $CI = & get_instance();
    $to = $data['to'];
    $from = $data['from'];
    $subject = $data['subject'];
    $message = $CI->load->view('email_templates/' . $data['email_template'], $data, true);


    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <'.$from.'>' . "\r\n";  
    
//    echo $message;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

/*function get_menu($menu_id) {
    $CI = & get_instance();
    $CI->db->distinct('page_by_menu.page_id')->select('page_by_menu.*,pages.page_name,pages.page_url')->from('page_by_menu')->join('pages', 'page_by_menu.page_id=pages.id')->where(array('menu_id' => $menu_id))->order_by('page_by_menu.sort', 'ASC');
    $data = $CI->db->get();
    return $data->result();
}
*/



function get_footer_service_settings() {
    $CI = & get_instance();    
    $data = $CI->common_model->RetriveRecordByWhereRow('ds_footer_service_settings', array('id' => '1'));
    return $data;
}


function get_catname_by_id($c_id) {
    $CI = & get_instance();    
    $data = $CI->common_model->RetriveRecordByWhereRow('ds_category', array('id' => $c_id));
    return $data;
}

function get_attrname_by_id($attr_id) {
    $CI = & get_instance();    
    $data = $CI->common_model->RetriveRecordByWhereRow('ds_products_attribute', array('id' => $attr_id));
    return $data;
}


function getServiceDetails($artist_id,$id) {
    $CI = & get_instance();    
    $data = $CI->common_model->RetriveRecordByWhereRow('ds_all_artist_services_details', array('artist_id' => $artist_id,'service_type_id' => $id));
    return $data;
}

    //s.p
    function digi_encode($id){
        $add = $id + 8038;
        return base64_encode(base64_encode($add));
    }
    //s.p
    function digi_decode($e_id){
        $id = base64_decode(base64_decode($e_id));
        return ($id-8038);
    }

    //s.p-30-01-2021
    function stringLimit($string,$limit=40,$view=''){

        if(strlen($string) >= $limit){
            if($view ==''){
                 return mb_strimwidth($string,0,$limit,"...");
            }else{
                 return mb_strimwidth($string,0,$limit,$view);
            }
        }
        else{
            return $string;
        }
    }

    //s.p-30-01-2021
    function date_time_format($date_time,$type=14){
		//$date_time=date_default_timezone_set("Asia/kolkata");
        $unx_stamp = strtotime($date_time);
        $date_str  = "";
        switch ($type) {
        case 1:
            $date_str = (date("Y-m-d", $unx_stamp));
            break; //2016/06/13
        case 2:
            $date_str = (date("m-d-Y", $unx_stamp));
            break; //01/30/2021
        case 3:
            $date_str = (date("d-m-Y", $unx_stamp));
            break; //13/06/2016
        case 4:
            $date_str = (date("d M Y", $unx_stamp));
            break; //13 Jun 2016
        case 5:
            $date_str = (date("dS M, Y", $unx_stamp));
            break; //30th Jan, 2021
        case 6:
            $date_str = (date("M d, Y", $unx_stamp));
            break; //Jan 30, 2021
        case 7:
            $date_str = (date("D M dS, Y", $unx_stamp));
            break; //Sat Jan 30th, 2021
        case 8:
            $date_str = (date("dS F, Y", $unx_stamp));
            break; //30th January, 2021
        case 9:
            $date_str = (date("l M dS, Y", $unx_stamp));
            break; //Saturday Jan 30th, 2021
        case 10:
            $date_str = (date("d M Y l", $unx_stamp));
            break; //30 Jan 2021 Saturday
        case 11:
            $date_str = (date("Y-m-d H:i:s", $unx_stamp));
            break; //2021/01/30  10:15:50
        case 12:
            $date_str = (date("H:i:a", $unx_stamp));
            break; //10:15:am
        case 13:
            $date_str = (date("Y-m-d H:i:a", $unx_stamp));
            break; //2021/01/30 10:15:am
        case 14:
            $date_str = (date("d-m-Y H:i:s", $unx_stamp));
            break; //30/01/2021 10:15:01
        default :
            $date_str = (date("dS M, Y", $unx_stamp));
            break; //30th Jan, 2021
        }
        return $date_str;
    }
    
   


    
    function getProductChildAttrName($p_id,$attr_id){
       $CI = & get_instance(); 
       $CI->db->select('ds_product_items.*, attr.parent_id,attr.id as sub_attr_id,attr.attr_name as child_attr_name,parent_attr.attr_name as p_attr_name,parent_attr.id as p_attr_id');
        $CI->db->from('ds_product_items');
        $CI->db->Join('ds_products_attribute as attr', 'ds_product_items.attr_id = attr.id', 'left');
        $CI->db->Join('ds_products_attribute as parent_attr', 'attr.parent_id = parent_attr.id', 'left');
        $CI->db->where('ds_product_items.p_id',$p_id);
        $CI->db->where('ds_product_items.attr_id',$attr_id);
        $CI->db->order_by('p_attr_id', 'asc');
        $attr_items = $CI->db->get()->result();
        return $attr_items;
    }


    function number_to_word($number){
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'One', '2' => 'Two',
        '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
        '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
        '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
        '13' => 'Thirteen', '14' => 'Fourteen',
        '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
        '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
        '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
        '60' => 'Sixty', '70' => 'Seventy',
        '80' => 'Eighty', '90' => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
             $divider = ($i == 2) ? 10 : 100;
             $number = floor($no % $divider);
             $no = floor($no / $divider);
             $i += ($divider == 10) ? 1 : 2;
             if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
             } else $str[] = null;
        }

        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
            " " . $words[$point / 10] . " " . 
                  $words[$point = $point % 10] : '';
        $paise = '';
        if($points !=''){
            $paise = ' Paise';
        }          
        return $result. "Rupees  " . $points.$paise.' Only.';
    }
?>