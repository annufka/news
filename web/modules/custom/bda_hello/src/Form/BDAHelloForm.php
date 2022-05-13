<?php 

namespace Drupal\bda_hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class BDAAddNewsForm extends FormBase {

    public function getFormId() {
        return 'bda_add_news_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['news_title'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('News Title:'),
          '#required' => TRUE,
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Add'),
        );
        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $message = \Drupal::messenger();
        $message->addMessage('News with id was created and now waiting for publishing');

        $form_state->setRedirect('<front>');
    }
    

}