<?   class MY_Lang extends CI_Lang {

    var $language    = array();
    var $is_loaded    = array();
    var $idiom;
    var $set;
    var $line;
    var $CI;  

    function __construct()
    {
	  parent::__construct();    
	  //parent::CI_Lang();  
    }

    /**
     * Load a language file
     *
     * @access    public
     * @param    mixed    the name of the language file to be loaded. Can be an array
     * @param    string    the language (english, etc.)
     * @return    mixed
     */
    
	
	
	
	function load($langfile = '', $idiom = '', $return = FALSE)
    {
  
	    // Calling early before CI reformats them
        $this->set = $langfile;
        $this->idiom = $idiom;
       	if($langfile)
        $langfile = str_replace(EXT, '', str_replace('_lang.', '', $langfile)).'_lang'.EXT;

        if (in_array($langfile, $this->is_loaded, TRUE))
        {
            return;
        }

        if ($idiom == '')
        {
            $CI =& get_instance();
            $deft_lang = $CI->config->item('language');
            $idiom = ($deft_lang == '') ? 'english' : $deft_lang;

            $this->idiom = $idiom;
        }
			
        // Determine where the language file is and load it

		if($langfile){
				if (file_exists(APPPATH.'language/'.$idiom.'/'.$langfile))
				{
					include(APPPATH.'language/'.$idiom.'/'.$langfile);
				}
				else
				{   
					if (file_exists(BASEPATH.'language/'.$idiom.'/'.$langfile))
					{
					   //print_r(BASEPATH.'language/'.$idiom.'/'.$langfile); exit;
					   
						include(BASEPATH.'language/'.$idiom.'/'.$langfile);
					}
				}
		}
        else
        {   
           
			    $database_lang =  $this->_get_from_db();
                if ( ! empty( $database_lang ) )
                {
                    $lang = $database_lang;
                }else{
                    show_error('Unable to load the requested language file: language/'.$langfile);
                }
        }
		
		

        if ( ! isset($lang))
        {
            log_message('error', 'Language file contains no data: language/'.$idiom.'/'.$langfile);
            return;
        }
        if ($return == TRUE)
        {
            return $lang;
        }
        $this->is_loaded[] = $langfile;
        $this->language = array_merge($this->language, $lang);
        unset($lang);

        log_message('debug', 'Language file loaded: language/'.$idiom.'/'.$langfile);
        return TRUE;
    }


	function line($line = '')
	{
		 
		 $value = ($line == '' OR ! isset($this->language[$line])) ? FALSE : $this->language[$line];
		// Because killer robots like unicorns!
		if ($value === FALSE)
		{
			log_message('error', 'Could not find the language line "'.$line.'"');
		}

		return $value;
	}

    /**
     * Load a language from database
     *
     * @access    private
     * @return    array
     */
	 
	 
    private function _get_from_db()
    {
		$CI =& get_instance();
		$return = array();	
		$site_lang = $CI->session->userdata('site_lang');
		if ($site_lang == NULL) {
			$site_lang =	'english';
		} 
		
        $CI->db->select   ('*');
        $CI->db->from     ('language');
      	//$CI->db->where    ('title', $this->set);
        $query = $CI->db->get()->result();
        foreach ( $query as $row )
        {
            $return[$row->title] = $row->$site_lang;
        } 
		
        unset($CI, $query);
        return $return;
    }
}