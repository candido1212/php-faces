<?php
import("phpf.controllers.Facescontroller");
import("phpf.events.ActionEvent");
import("phpf.listeners.ActionListener");
import("dbf.orm");
import("entityes.Blog",true);
class Sampleblog extends FacesController implements ActionListener
{
    private $em;
    protected $blogs;
    protected $blog;
    function Sampleblog()
    {
        parent::FacesController();
        $this->addActionListener($this);
        $this->em= EntityManager::getInstance();
        $this->load("io.uri");
        if($this->uri->get(0)=="add")
        {
        $this->append("title", "Add new blog");
        $this->render("blog.phpf");
        }
        elseif($this->uri->get(0)=="edit")
        {
        $this->append("title", "Edid blog");
        $id = $this->uri->get(1);
        $this->blog = $this->em->find("Blog", $id);
        $this->blog->content = stripcslashes($this->blog->content);
        $this->render("blog.phpf");
        }
        else
        $this->blogList();

    }

    //The methot runing before render
    private function blogList()
    {
        if($this->uri->get(0)=="delete")
        {
           $id = $this->uri->get(1);
           $blog = $this->em->find("Blog",$id);
           if($blog)
           $this->em->delete($blog);
        }
        $query  = $this->em->createQuery("SELECT b FROM Blog");
        $query->execute();
        $this->blogs = $query->getResultList();
        $this->render("listblog.phpf");
        
    }
     //The methot runing after render
    public function actionPerformed(ActionEvent $evt)
    {
       if($this->blogid->getText()=="")
        $this->blog = new Blog();
        $this->blog->name= $this->caption->getText();
        $this->blog->content= $this->content->getText();
        $this->em->save($this->blog);
        $this->blog->content = stripcslashes($this->blog->content);
        $this->content->setText("");
        $this->message->settext("Saved your content");
    }

}
?>