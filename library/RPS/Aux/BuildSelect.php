<?php

/**
 * Created by PhpStorm.
 * User: rpsimao
 * Date: 09/05/16
 * Time: 16:46
 */
class RPS_Aux_BuildSelect
{


    public function __construct(array $values)
    {
        $this->array = $values;
    }


    public function buildSelect()
    {

        $html = '';

        $lang = RPS_Aux_GetLocale::get();

        foreach ($this->array as $item)
        {

            $html.= '<option value="'.$item["description_$lang"].'">'.$item["description_$lang"].'</option>';
            
        }
        
        return $html;
    }
    
    
}