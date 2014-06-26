<?php

namespace Drupal\flood_control\Form;

use Drupal\Core\Form\ConfigFormBase;

class FloodControlSettingsForm extends ConfigFormBase
{
 
  function testPrint($item, $key)
  {
     $item =  \Drupal::service('date')->formatInterval($item);
  }
  
  public function getFormId()
  {
    return 'flood_control_admin_settings';
  }

  public function buildForm(array $form, array &$form_state)
  {
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
      '#options' => $options,
      '#default_value' => $flood_config->get('ip_limit'),
    );
    
    $options1 = array(
 		    '0' => t('None (disabled)'),
        '60' => '60',
        '180' => '180',
        '300' => '300',
        '600' => '600',
        '900' => '900',
        '1800' => '1800',
        '2700' => '2700',
        '3600' => '3600',
        '10800' => '10800',
        '21600' => '21600',
        '32400' => '32400',
        '43200' => '43200',
        '86400' => '86400',
        );
 
 $form['login']['user_failed_login_ip_window'] = array(
    '#type' => 'select',
    '#title' => t('Failed login (IP) window'),
    '#options' => $options1,
    '#default_value' => $flood_config->get('ip_window'),
    );
    
     $options2 = array(
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

 $form['login']['user_failed_login_user_limit'] = array(
    '#type' => 'select',
    '#title' => t('Failed login (username) limit'),
    '#options' => $options2,
    '#default_value' => $flood_config->get('user_limit'),
    );
    
     $options3 = array(
 	     	'0' => t('None (disabled)'),
        '60' => '60',
        '180' => '180',
        '300' => '300',
        '600' => '600',
        '900' => '900',
        '1800' => '1800',
        '2700' => '2700',
        '3600' => '3600',
        '10800' => '10800',
        '21600' => '21600',
        '32400' => '32400',
        '43200' => '43200',
        '86400' => '86400',
        );
        
        array_map('testPrint', $options3);
   
   
    $form['login']['user_failed_login_user_window'] = array(
    '#type' => 'select',
    '#title' => t('Failed login (username) window'),
    '#options' => $options3,
    '#default_value' => $flood_config->get('user_window'),
  );

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, array &$form_state)
  {
    $flood_config = $this->config('user.flood');
    //$flood_config->set('uid_only', $form_state['values']['user_failed_login_uid_only']);
    $flood_config->set('ip_limit', $form_state['values']['user_failed_login_ip_limit']);
    $flood_config->set('ip_window', $form_state['values']['user_failed_login_ip_window']);
    $flood_config->set('user_limit', $form_state['values']['user_failed_login_user_limit']);
    $flood_config->set('user_window', $form_state['values']['user_failed_login_user_window']);
    
    $flood_config->save();

    parent::submitForm($form, $form_state);
  }
}

?>
