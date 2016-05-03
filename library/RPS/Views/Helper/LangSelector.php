<?php

class RPS_Views_Helper_LangSelector extends Zend_View_Helper_Abstract {



    public function LangSelector()
    {


       $html= '<div class="topblock2">
            <a href="/locale/index/locale/fr_FR/0/default/1/1"><img src="/images/france.png" alt="French Language" width="20px" height="20px" style="border: none"></a>
            <a href="/locale/index/locale/de_DE/0/default/1/1"><img src="/images/germany.png" alt="German Language" width="20px" height="20px" style="border: none"></a>
			<a href="/locale/index/locale/en_US/0/default/1/1"><img src="/images/britain.png" alt="English Language" width="20px" height="20px" style="border: none"></a>
		</div>';


        return $html;


    }


}