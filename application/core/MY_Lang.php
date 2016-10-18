<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// Originaly CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
//modification by Yeb Reitsma

/* 
in case you use it with the HMVC modular extention
uncomment this and remove the other lines
load the MX_Loader class */

//require APPPATH."third_party/MX/Lang.php";

//class MY_Lang extends MX_Lang {
	
class MY_Lang extends CI_Lang {
    
    /**************************************************
     configuration
    ***************************************************/
 
    // languages
//    private $languages = array(
//        'de' => 'german',
//        'fr' => 'french',
//        'es' => 'spanish',
//        'en' => 'english'
//    );

    // get current language
    // ex: return 'en' if language in CI config is 'english' 
    function lang()
    {
        global $CFG;        
        $language = $CFG->item('language');

        $lang = array_search($language, $CFG->item('language_list'));
        if ($lang)
        {
            return $lang;
        }
        return NULL;    // this should not happen
    }
}

// END MY_Lang Class

/* End of file MY_Config.php */
/* Location: ./system/application/core/MY_Lang.php */