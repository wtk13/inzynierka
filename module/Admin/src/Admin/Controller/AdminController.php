<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AdminController extends AbstractActionController
{
    public function indexAction()
    {
       $this->layout('layout/layout.phtml');
    }
}