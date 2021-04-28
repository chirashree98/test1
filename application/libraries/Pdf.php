<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Pdf{ 
    public function __construct(){

    require_once dirname(__FILE__).'/dompdf/autoload.inc.php';
    
    $pdf = new DOMPDF(array('enable_remote' => true));
    // $dompdf = new Dompdf(array('enable_remote' => true));
    
    $CI = & get_instance();
    
    $CI->dompdf = $pdf; 
    
    }
} ?>