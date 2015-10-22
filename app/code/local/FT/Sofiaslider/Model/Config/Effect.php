<?php

class FT_Sofiaslider_Model_Config_Effect
{
	/**
	 * effects list
	 *
	 * @var string
	 */
	private $effects = "slide,fade";

    public function toOptionArray()
    {
	    $fonts = explode(',', $this->effects);
	    $options = array();
	    foreach ($fonts as $f ){
		    $options[] = array(
			    'value' => $f,
			    'label' => $f,
		    );
	    }

        return $options;
    }

}
