<?php 

require_once("RLValidate.php");

require_once("RLIView.php");

// This view is a sub section of view and it does not contain any 
// header, footer content.

// Display a list of menu items for major work items.
//

class RLQueryPackageView extends RLIView
{
    public function __construct()
    {
    }
    
    public function display()
    {
        return <<<EOF
        <p> RLQueryPackageView </p>
EOF;
    }
}

?>

