<?php
import("phpf.controllers.Facescontroller");
import("phpf.events.ActionEvent");
import("phpf.listeners.ActionListener");

class Fform extends FacesController implements ActionListener
{
    function Fform()
    {
        parent::FacesController();
        $this->addActionListener($this);
        $this->render(ApplicationContext::getCurrentView());
    }
    public function actionPerformed(ActionEvent $evt)
    {
         $this->label->setText("Your name : ".$this->textbox->getText()) ;
    }
}
?>