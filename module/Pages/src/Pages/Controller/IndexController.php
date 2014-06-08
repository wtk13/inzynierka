<?php

namespace Pages\Controller;

use Pages\Model;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pages\Model\Pages;
use Zend\Db\TableGateway\TableGateway;
use Pages\Form\PagesForm;

class IndexController extends AbstractActionController
{ 
	protected $pagesTable;

    public function indexAction()
    {
       $this->layout('layout/layout-pages.phtml');
       $pages = $this->getPagesTable()->getPages();
       return new ViewModel(array('pages' => $pages));  
    }  

    public function addAction()
    {
       $this->layout('layout/layout-pages.phtml');
       $form = new PagesForm();
       $request = $this->getRequest();
        if ($request->isPost()) {
            $page = new Pages();            
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $page->exchangeArray($form->getData());
                $this->getPagesTable()->addPage($page);
                return $this->redirect()->toRoute('pages');
            }
        }
       return array('form' => $form);
    }

    public function editAction()
    {
        $this->layout('layout/layout-pages.phtml');
       $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('pages', array(
                 'action' => 'add'
             ));
         }
         try {
             $page = $this->getPagesTable()->getPage($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('pages', array(
                 'action' => 'index'
             ));
         }

         $form  = new PagesForm();
         $page->name = str_replace('_', ' ', $page->name);
         $data = array(
            'name' => $page->name,
            'id' => $page->id,
            'content' => $page->content,
            'file' => $page->file
        );
         $form->setData($data);
         $form->get('submit')->setAttribute('value', 'Edytuj');         

         $request = $this->getRequest();
         if ($request->isPost()) {             
             $form->setData($request->getPost());
             if ($form->isValid()) {
                $page->exchangeArray($form->getData());
                $this->getPagesTable()->addPage($page);                
                return $this->redirect()->toRoute('pages');
             }
         }
         return array(
             'id' => $id,
             'form' => $form,
             'photo' => $page->file
         );
    } 

    public function deleteAction()
    {            
        $request = $this->getRequest();
        if ($request->isPost()){             
            $id = $this->getRequest()->getPost('id');
            $this->getPagesTable()->deletePage($id);
            $tablica['wynik'] = 'success';
            echo json_encode($tablica);         
        }
        return $this->response;
    } 

    public function getPagesTable()
    {
        if (!$this->pagesTable) {
            $sm = $this->getServiceLocator();
            $this->pagesTable = $sm->get('Pages\Model\PagesTable');
        } 
        return $this->pagesTable;
    }

    public function uploadifyAjaxAction(){
        $targetFolder = 'public/img/pages'; 
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];            
            $targetFile = rtrim($targetFolder,'/') . '/' . $_FILES['Filedata']['name'];
            move_uploaded_file($tempFile,$targetFile);
            echo '1';          
        }
        return $this->response;
    }

    public function checkExistPhotoAjaxAction()
    { 
      if($this->getRequest()->isPost()){
       $a = $this->getRequest()->getPost("filename");
       $targetFolder = 'public/img/pages'; 
       if (file_exists($targetFolder . '/' . $a)) {
        echo '1';
       } else {
        echo '0';
       }
      }
      return $this->response;
    }
}