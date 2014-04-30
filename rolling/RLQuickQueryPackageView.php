<?php 

require_once("RLValidate.php");

require_once("RLIView.php");

// This view is a sub section of view and it does not contain any 
// header, footer content.

// Display a list of menu items for major work items.
//

class RLQuickQueryPackageView extends RLIView
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
                <ul class="query_menu">
                    <li><input type="checkbox" name="input_date_query">{$RL__('Query with delivery date')}</input></li>
                    <li>
                        <label>{$RL__('Start Date')}</label>    
                        <input name="start_date" type="text" value="2012-01-01"/>
                     </li>
                     </li>
                        <label>{$RL__('End Date')}</label>  
                        <input name="end_date" type="text" value="2013-01-01"/>
                    </li>
                 </ul>
                 
                <ul class="query_menu">
                    <li><input type="checkbox" name="input_pkg_id_query" >{$RL__('Query with package ID')} </input>
                    <li><label>{$RL__('Package ID')}</label>    
                        <input name="query_package_id" type="text" value=""/>
                    </li>
                 </ul>
<!--                 
                 <fieldset class="queryset">
                    <legend>Query with package source </legend>
                    <input type="checkbox" name="input_pkg_from_query" >Choose</input>
                    <label>Adress:</label>    
                    <input name="query_package_id" type="text" value=""/>
                 </fieldset>
                 
                 <fieldset class="queryset">
                    <legend>Query with package desitionaion </legend>
                    <input type="checkbox" name="input_pkg_from_query" >Choose</input>
                    <label>Address:</label>    
                    <input name="query_package_id" type="text" value=""/>
                 </fieldset>
             -->
                 
                 <!-- a whole load of form fields -->
                 <div class="query_submit">
                 <input name="inputQuickQuery" type="button" value="{$RL__('Query')}" onclick="quickQuery();"/>
                 </div>
            </form>

        </div>
EOF;
    }
}

?>

