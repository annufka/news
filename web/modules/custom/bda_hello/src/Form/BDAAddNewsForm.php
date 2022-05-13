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
        $form['news_text'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('News Description:'),
            '#required' => TRUE,
          );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Add'),
        );
        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
        parent::validateForm($form, $form_state);
    
        $title = $form_state->getValue('news_title');
        $text = $form_state->getValue('news_text');
    
        if (strlen($title) < 10) {
          $form_state->setErrorByName('news_title', $this->t('The title must be at least 10 characters long.'));
        }
    
        if (empty($text)){
          $form_state->setErrorByName('news_text', $this->t('You must write description of your news.'));
        }
    
      }

    public function submitForm(array &$form, FormStateInterface $form_state) {

        $news = \Drupal::entityTypeManager()->getStorage('node')->create(['type' => 'news', 
        'title' => $form_state->getValue('news_title'), 
        'field_news_description' => $form_state->getValue('news_text'), 
        'uid' => \Drupal::currentUser()->id(),
        'status' => 0, 
        ]);
        $news->save();

        $message = \Drupal::messenger();
        $message->addMessage('News with id ' . $news->id() . ' was created and now waiting for publishing');

        $form_state->setRedirect('<front>');
    }
    
}