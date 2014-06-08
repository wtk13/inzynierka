<?php 
namespace Fixtures\Form;

 use Zend\Form\Form;

 class FixturesForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('fixtures');

         $this->add(array(
             'name' => 'round',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Podaj nr rundy: ',
             ),
             'attributes' => array(
                 'size' => 5,
                 'id' => 'round',
                 'class' => 'form-control'
             ),
         ));
          $this->add(array(
             'name' => 'content',
             'type' => 'textarea',
             'options' => array(
                 'label' => 'Wpisz mecze: ',
             ),
             'attributes' => array(
                 'cols' => 60,
                 'rows' => 12,                 
                 'class' => 'form-control',
                 'id' => 'content1'
             ),
         ));      
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',             
             'attributes' => array(
                 'value' => 'Dodaj',
                 'class' => 'btn btn-success',
                 'id'    => 'submit_fix'                 
             ),
         ));            
     }
 }
?>