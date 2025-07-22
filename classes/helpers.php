<?php
namespace PMProEleCondition;

class Helpers
{
    public function pmpro_ele_condition_init()
    {
        // Get all PMPro membership levels
        $levels = pmpro_getAllLevels(true, true);
        $options = [];
        $options['pmpro-level-none'] = 'Non Members';
        $options['pmpro-level-guest'] = 'Not Logged In';

        if (!empty($levels)) {
            if (is_array($levels)) {
                foreach ($levels as $level) {
                    $class = 'pmpro-level-' . sanitize_html_class(strtolower(str_replace(' ', '-', $level->name)));
                    $options[$class] = $level->name;
                } 
            }
        }  
        return $options;
    }

}