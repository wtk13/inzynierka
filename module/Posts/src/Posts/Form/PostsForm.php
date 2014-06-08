<?php 
namespace Posts\Form;

 use Zend\Form\Form;

 class PostsForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('post');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'file',
             'type' => 'Hidden',
             'attributes' => array(                
                 'id' => 'file'            
             ),
         ));
         $this->add(array(
             'name' => 'name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Wprowadź nazwę: ',
             ),
             'attributes' => array(
                 'size' => 40,
                 'id' => 'name',
                 'class' => 'form-control'
             ),
         ));
         $this->add(array(
            'name' => 'photo',
            'attributes' => array(
                'type'  => 'file',
                'id' => 'photo'
            ),
            'options' => array(
                'label' => 'Zdjęcie:',
            ),
        )); 
         $this->add(array(
             'name' => 'content',
             'type' => 'textarea',
             'options' => array(
                 'label' => 'Wprowadź treść: ',
             ),
             'attributes' => array(
                 'cols' => 50,
                 'rows' => 12,
                 'class' => 'ckeditor',
                 'class' => 'form-control',
                 'id' => 'textarea'                 
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',             
             'attributes' => array(
                 'value' => 'Dodaj',
                 'class' => 'btn btn-success',
                 'id' => 'submit',
             ),
         ));            
     }
 }
?>