<?php
import("phpf.controllers.facete");
class Hbutton extends Facete 
{
    function Hbutton()
    {
        parent::Facete();
        $this->render(ApplicationContext::getCurrentView());
    }
    protected function btnClicked( $evt)
    {
            $evt->getComponent()->setText("You Clicked");
            $this->AjaxResponse();
    }
}
?>