<?php

namespace Drupal\flood_control\Form;
 
use Drupal\Core\Form\ConfigFormBase;
 
class SnippetsSettingsForm extends ConfigFormBase { 
public function getFormId() 
        {
  return 'flood_control_admin_settings';
}

public function buildForm(array $form, array &$form_state) {
  $config = $this->config('flood_control.settings');
 
  $elements = drupal_map_assoc(array('pre', 'code'));
 
  $form['flood_control_wrapping_element'] = array(
    '#type' => 'select',
    '#title' => $this->t('Select wrapping element'),
    '#default_value' => $config->get('element'),
    '#options' => $elements,
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
