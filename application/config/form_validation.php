<?php
 
/** Rules for the Form Validation Class */

$config = array(

'register' => array(
array('field' => 'username','label' => 'Benutzername', 'rules' => 'required|callback_validUsername'),
array('field' => 'password','label' => 'Passwort', 'rules' => 'required'),
array('field' => 'passwordconf','label' => 'Passwort Wiederholung', 'rules' => 'required|matches[password]'),
array('field' => 'email','label' => 'E-Mail', 'rules' => 'required|valid_email'),
array('field' => 'phone','label' => 'Telefon', 'rules' => 'required|is_natural'),
array('field' => 'lastname','label' => 'Name', 'rules' => 'required'),
array('field' => 'firstname','label' => 'Vorname', 'rules' => 'required'),
array('field' => 'address','label' => 'Adresse', 'rules' => 'required'),
array('field' => 'zipcode','label' => 'PLZ', 'rules' => 'required|min_length[4]|is_natural'),
array('field' => 'location','label' => 'Ort', 'rules' => 'required')
),

'login' => array(
array('field' => 'username','label' => 'Benutzername', 'rules' => 'required|callback_credentialsCheck'),
array('field' => 'password','label' => 'Passwort', 'rules' => 'required'),
),

'address' => array(
array('field' => 'email','label' => 'E-Mail', 'rules' => 'required|valid_email'),
array('field' => 'phone','label' => 'Telefon', 'rules' => 'required|is_natural'),
array('field' => 'lastname','label' => 'Name', 'rules' => 'required'),
array('field' => 'firstname','label' => 'Vorname', 'rules' => 'required'),
array('field' => 'address','label' => 'Adresse', 'rules' => 'required'),
array('field' => 'zipcode','label' => 'PLZ', 'rules' => 'required|min_length[4]|is_natural'),
array('field' => 'location','label' => 'Ort', 'rules' => 'required')
),

'resetPassword' => array(
array('field' => 'username','label' => 'Benutzername', 'rules' => 'required|callback_credentialsCheck'),
array('field' => 'password','label' => 'Passwort', 'rules' => 'required'),
array('field' => 'newpassword','label' => 'Passwort', 'rules' => 'required'),
array('field' => 'newpasswordconf','label' => 'Passwort Wiederholung', 'rules' => 'required|matches[newpassword]'),

)

);




 
?>
