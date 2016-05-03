<?php

class Clients_Form_Patients extends Twitter_Form
{

    public function init()
    {
        $this->setMethod('POST');
        $this->setAttribs(array('id'=> 'User_Form_NewUser', 'class'=>"form-horizontal", "role"=>"form"));
        $this->setAction('/clients/clients/new');

        $cl = new Zend_Form_Element_Hidden("clinic");
        $this->addElement($cl);

        $fn = new Zend_Form_Element_Text('first_name');
        $fn->setLabel('First Name:');
        $fn->setRequired(TRUE)->setAttribs(array('class'=> "form-control"));
        $this->addElement($fn);

        $ln = new Zend_Form_Element_Text('last_name');
        $ln->setLabel('Last Name:');
        $ln->setRequired(TRUE)->setAttribs(array('class'=> "form-control"));
        $this->addElement($ln);

        $bd = new Zend_Form_Element_Text('age');
        $bd->setLabel('Age:');
        $bd->setRequired(TRUE)->setAttribs(array('class'=> "form-control"));
        $this->addElement($bd);

        /*
        $add = new Zend_Form_Element_Text('address');
        $add->setLabel('Address:');
        $add->setRequired(TRUE)->setAttribs(array('class'=> "form-control"));
        $this->addElement($add);

        $pc = new Zend_Form_Element_Text('postal_code');
        $pc->setLabel('Postal-Code:');
        $pc->setRequired(TRUE)->setAttribs(array('class'=> "form-control"));
        $this->addElement($pc);

        $ct = new Zend_Form_Element_Text('city');
        $ct->setLabel('City:');
        $ct->setRequired(TRUE)->setAttribs(array('class'=> "form-control"));
        $this->addElement($ct);

        $ph = new Zend_Form_Element_Text('phone');
        $ph->setLabel('Phone:');
        $ph->setAttribs(array('class'=> "form-control"));
        $this->addElement($ph);

        $mb = new Zend_Form_Element_Text('mobile');
        $mb->setLabel('Mobile:');
        $mb->setAttribs(array('class'=> "form-control"));
        $this->addElement($mb);
        */
        $em = new Zend_Form_Element_Text('email');
        $em->setLabel('Email:');
        $em->setRequired(TRUE)->setAttribs(array('class'=> "form-control"));
        $em->addValidators(array(new Zend_Validate_EmailAddress()));
        $this->addElement($em);

        $or = new Zend_Form_Element_Select('origin');
        $or->setLabel('Origin:');
        $or->addMultiOptions(array(
            ""=>"",
            gettext("Swiss") => gettext("Swiss"),
            gettext("Portuguese") => gettext("Portuguese"),
            gettext("Spanish") => gettext("Spanish"),
            gettext("German") => gettext("German"),
            gettext("Italian") => gettext("Italian"),
            gettext("English") => gettext("English"),
            gettext("Maghrebian") => gettext("Maghrebian"),
            gettext("South American") => gettext("South American"),
            gettext("Other") => gettext("Other"),
        ));
        $or->setAttribs(array('class'=> "form-control"));
        $this->addElement($or);

        $nt = new Zend_Form_Element_Textarea('notes');
        $nt->setLabel('Notes:');
        $nt->setAttribs(array('class'=> "form-control"));
        $this->addElement($nt);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Create User');
        $submit->setAttrib('class', 'btn btn-clinik');
        $this->addElement($submit);

    }


}
