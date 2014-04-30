<?php 

require_once("RLValidate.php");

require_once("RLIView.php");

// This view is a sub section of view and it does not contain any 
// header, footer content.

// Display a list of menu items for major work items.
//

class RLQuickUserQueryView extends RLIView
{
    public function __construct()
    {
    }
    
    public function display()
    {
    	global $RL__;
    	
        return <<<EOF
        <div>
            <form name="quick_query_form">
                <fieldset>  <legend>{$RL__('Query with user region')}</legend>
                    <label>{$RL__('Region')}</label>    
                    <input name="user_region" type="text" value=""/>
                    <input name="inputQuickQuery" type="button" value="{$RL__('Query')}" onclick="query_by_region();"/>
                 </fieldset>
                 <!-- a whole load of form fields -->
            </form>
        </div>
EOF;
    }
}

?>

