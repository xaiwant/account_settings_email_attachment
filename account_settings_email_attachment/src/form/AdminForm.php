<?php

/**
 * @file
 * Contains Drupal\account_settings_email_attachment\Form\AdminForm.
 */

namespace Drupal\account_settings_email_attachment\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AdminForm.
 *
 * @package Drupal\account_settings_email_attachment\Form
 */
class AdminForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'account_settings_email_attachment.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'account_settings_email_attachment_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::config('account_settings_email_attachment.settings');
	
	  $form['account_settings_email_attachment_allowed_extension'] = array(
		'#type' => 'textfield',
		'#title' => t('Allowed file extensions'),
		'#description' => t('Separate extensions with a space or comma and do not include the leading dot.'),
		'#element_validate' => array('_file_generic_settings_extensions'),
		'#default_value' => $config->get('account_settings_email_attachment_allowed_extension'),
		'#size' => 60,
		'#required' => TRUE,
	  );	
    return parent::buildForm($form, $form_state);
  }
 
  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      // Retrieve the configuration
       $this->configFactory->getEditable('account_settings_email_attachment.settings')
      ->set('account_settings_email_attachment_allowed_extension', $form_state->getValue('account_settings_email_attachment_allowed_extension'))
      ->save();

    parent::submitForm($form, $form_state);
  }

  
  
  
}