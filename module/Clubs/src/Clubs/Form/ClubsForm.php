<?php 
namespace Clubs\Form;

 use Zend\Form\Form;

 class ClubsForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('club');

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
                'label' => 'Herb:',
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