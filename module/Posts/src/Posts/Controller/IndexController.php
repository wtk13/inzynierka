<?php

namespace Posts\Controller;

use Posts\Model;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Posts\Model\Posts;
use Zend\Db\TableGateway\TableGateway;
use Posts\Form\PostsForm;

class IndexController extends AbstractActionController
{ 
	protected $postsTable;

    public function indexAction()
    {
        $this->layout('layout/layout-posts.phtml');       
        //$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbTableGateway($this->getPostsTable()));


        $iteratorAdapter = new \Zend\Paginator\Adapter\Iterator($this->getPostsTable1()->fetchAll());
        $paginator = new \Zend\Paginator\Paginator($iteratorAdapter);

        $page = 1;
        if ($this->params()->fromRoute('page')) $page = $this->params()->fromRoute('page');
        $paginator->setCurrentPageNumber((int)$page);
        $paginator->setItemCountPerPage(10);
        return new ViewModel(array('paginator' => $paginator));
    }    

    public function getPostsTable()
    {
        if (!$this->postsTable) {
            $this->postsTable = new TableGateway(
                'posts', 
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
            );
        }
        return $this->postsTable;
    }

    public function getPostsTable1()
    {
        if (!$this->postsTable) {
            $sm = $this->getServiceLocator();
            $this->postsTable = $sm->get('Posts\Model\PostsTable');
        } 
        return $this->postsTable;
    }

    public function publishAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()){             
           $id = $this->getRequest()->getPost('id');           
           $post = $this->getPostsTable1()->getById($id);           
           $newFlag = $post->active == 1 ?  0 : 1;         
           $this->getPostsTable1()->changeStatus($id, $newFlag);
           $tablica['wynik'] = "success";           
           echo json_encode($tablica);
        }
        return $this->response;
    }

    public function addAction()
    {     
       $this->layout('layout/layout-posts.phtml');
       $form = new PostsForm();
       $request = $this->getRequest();
        if ($request->isPost()) {
            $post = new Posts();            
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $post->exchangeArray($form->getData());
                $this->getPostsTable1()->addPost($post);                
                return $this->redirect()->toRoute('posts');
            }
        }
       return array('form' => $form);
    } 

    public function deleteAction()
    {            
        $request = $this->getRequest();
        if ($request->isPost()){             
            $id = $this->getRequest()->getPost('id');
            $this->getPostsTable1()->deletePost($id);
            $tablica['wynik'] = 'success';
            echo json_encode($tablica);         
        }
        return $this->response;
    }

    public function uploadifyAjaxAction(){
        $targetFolder = 'public/img/posts'; 
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
       $targetFolder = 'public/img/posts'; 
       if (file_exists($targetFolder . '/' . $a)) {
        echo '1';
       } else {
        echo '0';
       }
      }
      return $this->response;
    }

    public function editAction()
    {
        $this->layout('layout/layout-posts.phtml');
       $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('posts', array(
                 'action' => 'add'
             ));
         }
         try {
             $post = $this->getPostsTable1()->getById($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('posts', array(
                 'action' => 'index'
             ));
         }

         $form  = new PostsForm();
         $post->name = str_replace('_', ' ', $post->name);
         $data = array(
            'name' => $post->name,
            'id' => $post->id,
            'content' => $post->content,
            'file' => $post->file
        );
         $form->setData($data);
         $form->get('submit')->setAttribute('value', 'Edytuj');         

         $request = $this->getRequest();
         if ($request->isPost()) {             
             $form->setData($request->getPost());
             if ($form->isValid()) {
                $post->exchangeArray($form->getData());
                $this->getPostsTable1()->addPost($post);                
                return $this->redirect()->toRoute('posts');
             }
         }
         return array(
             'id' => $id,
             'form' => $form,
             'photo' => $post->file
         );
    }       
}