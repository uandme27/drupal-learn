<?php

namespace Drupal\rsvplist\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\RouteMatchInterface;

class RSVPForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rsvplist_email_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $node = \Drupal::routeMatch()->getParameter('node');
    if (!is_null($node)) {
      $nid = $node->id();
    } else {
      $nid = 0;
    }

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email address'),
      '#size' => 25,
      '#description' => $this->t('We will send updates to the email address you provide.'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('RSVP'),
    ];
    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => $nid, // Chuyển giá trị $nid thay vì 'nid'
    ];
    return $form;
  }
  
  /**
   * {@inheritdoc}
   */

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $value = $form_state->getValue('email');
    if (!\Drupal::service('email.validator')->isValid($value)) {
        $form_state->setErrorByName('email',
        $this->t('It appears that @mail is not a valid email. Please try again.', ['@mail' => $value]));
      }
    
   
}

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $submitted_email = $form_state->getValue('email');

    $this->messenger()->addMessage($this->t('The form is working! You entered @entry.', ['@entry' => $submitted_email]));
  }
}
