<?php

namespace Drupal\flood_control\Form;
 
use Drupal\Core\Form\ConfigFormBase;
 
class FloodControlSettingsForm extends ConfigFormBase { 
    public function getFormId() 
            {
      return 'flood_control_admin_settings';
    }

    public function buildForm(array $form, array &$form_state) {
      $flood_config = $this->config('user.flood');

 $form['login'] = array(
    '#type' => 'fieldset',
    '#title' => t('Login'),
  );
  
  $options = array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
        '20' => '20',
        '30' => '30',
        '40' => '40',
        '50' => '50',
        '75' => '75',
        '100' => '100',
        '125' => '125',
        '150' => '150',
        '200' => '200',
        '250' => '250',
        '500' => '500',
  );
  
  $form['login']['user_failed_login_ip_limit'] = array(
    '#type' => 'select',
    '#title' => t('Failed login (IP) limit'),
    '#options' =>  $options,
    '#default_value' => $flood_config->get('ip_limit'),
  );
  
      $form['flood_control_wrapping_element'] = array(
        '#type' => 'select',
        '#title' => $this->t('Select wrapping element'),
        '#default_value' => 'A'
      );

      return parent::buildForm($form, $form_state);
    }
    public function submitForm(array &$form, array &$form_state) {
      $this->config('flood_control.settings')
          ->set('element', $form_state['values']['flood_control_wrapping_element'])
          ->save();

      parent::submitForm($form, $form_state);
    }
}
?>
