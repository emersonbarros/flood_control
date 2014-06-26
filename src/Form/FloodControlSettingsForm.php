<?php

namespace Drupal\flood_control\Form;
 
use Drupal\Core\Form\ConfigFormBase;
 
class FloodControlSettingsForm extends ConfigFormBase { 
    public function getFormId() 
            {
      return 'flood_control_admin_settings';
    }

    public function buildForm(array $form, array &$form_state) {
      //$config = $this->configFactory->get('user.flood');

use Drupal\Component\Utility\MapArray;
$options = MapArray::copyValuesToKeys($my_array);
// With callback
$options = MapArray::copyValuesToKeys($my_array, $callback);

 $form['login'] = array(
    '#type' => 'fieldset',
    '#title' => t('Login'),
    '#access' => user_access('administer users'),
  );
  
  $options = array(
      '1'  => t('1'),
      '2' => t('2'),
    );
  
  $form['login']['user_failed_login_ip_limit'] = array(
    '#type' => 'select',
    '#title' => t('Failed login (IP) limit'),
    '#options' =>  $options,
    '#default_value' => '2',
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
