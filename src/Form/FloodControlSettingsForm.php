<?php

namespace Drupal\flood_control\Form;
 
use Drupal\Core\Form\ConfigFormBase;
 
class FloodControlSettingsForm extends ConfigFormBase { 
    public function getFormId() 
            {
      return 'flood_control_admin_settings';
    }

    public function buildForm(array $form, array &$form_state) {
      $flood_config = $this->configFactory->get('user.flood');

 $form['login'] = array(
    '#type' => 'fieldset',
    '#title' => t('Login'),
  );
  
  $options = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 20, 30, 40, 50, 75, 100, 125, 150, 200, 250, 500
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
