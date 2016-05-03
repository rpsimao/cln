<?php

class Default_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setMethod('POST');
        $this->setAction('/users');
        $this->setAttrib('id', 'User_Form_Login');


        $email = new Zend_Form_Element_Text('Users_Form_Login_Username');
        $email->setLabel('Users_Form_Login_Username');
        $email->setAttrib('size', 20);
        $email->setRequired(TRUE);
        $this->addElement($email);

        $password = new Zend_Form_Element_Password('Users_Form_Login_Password');
        $password->setLabel('Users_Form_Login_Password');
        $password->setAttrib('size', 20);
        $password->setRequired(TRUE);
        $this->addElement($password);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Users_Form_Login_Submit');
        $submit->setAttrib('class', 'btn btn-clinik');
        $this->addElement($submit);







    }



}

