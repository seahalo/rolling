<?php 

require_once("RLValidate.php");

require_once("RLIView.php");

// This view is a sub section of view and it does not contain any 
// header, footer content.

// Display a list of menu items for major work items.
//

class RLContentAreaView extends RLIView
{
    public function __construct()
    {
        $this->mViewList = array();
    }
    
    public function display()
    {
        $content = " ";
        foreach($this->mViewList as $number => $view )
        {
            $content .= $view->display();
        }
        
        return <<<EOF
        
            $content
EOF;
    }
    
    public function addView($subView)
    {
        $this->mViewList[] = $subView;
    }
    
    protected $mViewList;
}

?>
