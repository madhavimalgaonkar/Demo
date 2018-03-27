<?php

namespace Drupal\mb_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use CommerceGuys\Addressing\AddressFormat\AddressField;

/**
 * Provides multistep single url form.
 */
class Register extends FormBase {

  /**
   * Current step
   * @var int
   */
  protected $step = '';

  /**
   * Steps for the form
   * @var array
   */
  protected $steps = array();

  /**
   * Store values between steps
   * @var array
   */
  protected $multistep_values = array();

  /**
   * Is the form finished?
   * @var bool
   */
  protected $complete = FALSE;

  /**
   * Singleurl constructor.
   */
  public function __construct() {
    $this->steps = array(
      1 => 'one',
      2 => 'two',
      3 => 'three',
      4 => 'four',
      5 => 'five',
      6 => 'six'
    );

    if (!$this->step) {
      $this->step = $this->steps[1];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mb_register_register';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Set values from all step submissions.
    $form_state->setValues($this->multistep_values);

    // Get the step method
    $method = 'form' . ucwords($this->step);

    if (method_exists($this, $method)) {
      $this->{$method}($form, $form_state);
    }
    else {
      exit('You have not created a method ' . $method);
    }

    return $form;
  }

  /**
   * First step of form.
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  private function formOne(array &$form, FormStateInterface $form_state) {
    $personal = $form_state->getValues('personal');

    $form['personal']['username'] = [
      '#type' => 'textfield',
      '#title' => t('Username'),
      '#required' => TRUE,
    ];
    $form['personal']['email_address'] = [
      '#type' => 'email',
      '#title' => t('Email Address'),
      '#required' => TRUE,
    ];
    $form['personal']['password'] = [
      '#type' => 'password',
      '#title' => t('Password'),
      '#required' => TRUE,
    ];
    $form['personal']['con_password'] = [
      '#type' => 'password',
      '#title' => t('Confirm Password'),
      '#required' => TRUE,
    ];
    $form['personal']['fullname'] = [
      '#type' => 'textfield',
      '#title' => t('Full Name'),
      '#required' => TRUE,
    ];
    $form['personal']['gender'] = [
      '#type' => 'select',
      '#title' => t('Gender'),
      '#required' => TRUE,
      '#options' => mb_register_get_options_value('field_test'),
    ];
    $form['personal']['dob'] = [
      '#type' => 'date',
      '#title' => t('Date of Birth'),
      '#required' => TRUE,
    ];
    $form['personal']['tob'] = [
      '#type' => 'textfield',
      '#title' => t('Time of Birth'),
      '#required' => TRUE,
    ];
    $form['personal']['birthplace'] = [
      '#type' => 'textfield',
      '#title' => t('Birth Place'),
    ];
    $form['personal']['mstatus'] = [
      '#type' => 'select',
      '#title' => t('Marital Status'),
      '#required' => TRUE,
      '#options' => [
        'annulled' => t('Annulled'),
        'divorcee' => t('Divorcee'),
        'seperated' => t('Seperated'),
        'single' => t('Single'),
        'widowed' => t('Widowed'),
      ],
    ];
    $form['personal']['children'] = [
      '#type' => 'select',
      '#title' => t('No. of Children'),
      '#required' => TRUE,
      '#options' => [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => t('4 and above'),
      ],
    ];
    $form['personal']['mothertongue'] = [
      '#type' => 'select',
      '#title' => t('Mother Tongue'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['personal']['religion'] = [
      '#type' => 'select',
      '#title' => t('Religion'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['personal']['caste'] = [
      '#type' => 'select',
      '#title' => t('Caste'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['personal']['subcaste'] = [
      '#type' => 'select',
      '#title' => t('Sub Caste'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['personal']['height'] = [
      '#type' => 'textfield',
      '#title' => t('Height'),
      '#required' => TRUE,
    ];
    $form['personal']['weight'] = [
      '#type' => 'textfield',
      '#title' => t('Weight'),
      '#required' => TRUE,
    ];
    $form['personal']['bloodgrp'] = [
      '#type' => 'select',
      '#title' => t('Blood Group'),
      '#options' => [
        'notknown' => t('Not Known'),
        'ap' => t('A+'),
        'an' => t('A-'),
        'abp' => t('AB+'),
        'abn' => t('AB-'),
        'bp' => t('B+'),
        'bn' => t('B-'),
        'op' => t('O+'),
        'on' => t('O-'),
      ],
    ];
    $form['personal']['complexion'] = [
      '#type' => 'select',
      '#title' => t('Complexion'),
      '#required' => TRUE,
      '#options' => [
        'dark' => t('Dark'),
        'fair' => t('Fair'),
        'veryfair' => t('Very Fair'),
        'whitish' => t('Whitish'),
      ],
    ];
    $form['personal']['bodytype'] = [
      '#type' => 'select',
      '#title' => t('Body Type'),
      '#required' => TRUE,
      '#options' => [
        'select' => t('Select Body Type'),
        'athletic' => t('Athletic'),
        'average' => t('Average'),
        'heavy' => t('Heavy'),
        'slim' => t('Slim'),
      ],
    ];
    $form['personal']['manglik'] = [
      '#type' => 'select',
      '#title' => t('Manglik'),
      '#required' => TRUE,
      '#options' => [
        'notknown' => t('Not Known'),
        'yes' => t('Yes'),
        'no' => t('No'),
      ],
    ];
    $form['personal']['gothram'] = [
      '#type' => 'textfield',
      '#title' => t('Gothram'),
    ];
    $form['personal']['rasi'] = [
      '#type' => 'select',
      '#title' => t('Star / Raasi'),
      '#options' => [
        'notknown' => t('Not Known'),
        'aries' => t('Aries (मेष)'),
        'taurus' => t('Taurus (वृषभ)'),
        'gemini' => t('Gemini (मिथुन)'),
        'cancer' => t('Cancer (कर्क)'),
        'leo' => t('Leo  (सिंह)'),
        'virgo' => t('Virgo (कन्या)'),
        'libra ' => t('Libra (तुला)'),
        'scorpio' => t('Scorpio (वृश्चिक)'),
        'sagittarius' => t('Sagittarius (धनु)'),
        'capricorn' => t('Capricorn (मकर)'),
        'aquarius' => t('Aquarius (कुंभ)'),
        'pisces' => t('Pisces (मीन)'),
      ],
    ];
    $form['personal']['eating'] = [
      '#type' => 'radios',
      '#title' => t('Eating Habits'),
      '#required' => TRUE,
      '#options' => [
        'vegetarian' => t('Vegetarian'),
        'nonvegetarian' => t('Non Vegetarian'),
        'eggetarian' => t('Eggetarian'),
      ],
    ];
    $form['personal']['drinking'] = [
      '#type' => 'radios',
      '#title' => t('Drinking Habits'),
      '#required' => TRUE,
      '#options' => [
        'no' => t('No'),
        'occ' => t('Occasionally'),
        'yes' => t('Yes'),
      ],
    ];
    $form['personal']['smoking'] = [
      '#type' => 'radios',
      '#title' => t('Smoking Habits'),
      '#required' => TRUE,
      '#options' => [
        'no' => t('No'),
        'occ' => t('Occasionally'),
        'yes' => t('Yes'),
      ],
    ];
    $form['personal']['disable'] = [
      '#type' => 'checkbox',
      '#title' => t('Physical Disability'),
    ];
    $form['personal']['disdetails'] = [
      '#type' => 'textfield',
      '#title' => t('Disability Details'),
    ];
    $form['personal']['about'] = [
      '#type' => 'textarea',
      '#title' => t('About Myself'),
      '#required' => TRUE,
    ];
    $form['next'] = [
      '#type' => 'submit',
      '#value' => $this->t('Next'),
    ];
  }
  /**
   * Second step of form
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  private function formTwo(array &$form, FormStateInterface $form_state) {
    $addressinfo = $form_state->getValues('addressinfo');

    $form['addressinfo']['current'] = [
      '#type' => 'fieldset',
      '#title' => t('Current Address'),
    ];
    $form['addressinfo']['current']['current_address'] = [
      '#type' => 'address',
      '#default_value' => ['country_code' => 'IN'],
      '#used_fields' => [
        AddressField::ADMINISTRATIVE_AREA,
        AddressField::DEPENDENT_LOCALITY,
        AddressField::LOCALITY,
        AddressField::ADDRESS_LINE1,
        AddressField::ADDRESS_LINE2,
        AddressField::POSTAL_CODE,
      ],
    ];
    $form['addressinfo']['current']['ph'] = [
      '#type' => 'tel',
      '#title' => t('Phone Number'),
    ];
    $form['addressinfo']['current']['mob1'] = [
      '#type' => 'tel',
      '#title' => t('Mobile No. 1'),
      '#required' => TRUE,
    ];
    $form['addressinfo']['current']['mob2'] = [
      '#type' => 'tel',
      '#title' => t('Mobile No. 2'),
    ];
    $form['addressinfo']['origin'] = [
      '#type' => 'fieldset',
      '#title' => t('Ancestral Origin Address'),
    ];
    $form['addressinfo']['origin']['origin_address'] = [
      '#type' => 'address',
      '#default_value' => ['country_code' => 'IN'],
      '#used_fields' => [
        AddressField::ADMINISTRATIVE_AREA,
        AddressField::DEPENDENT_LOCALITY,
        AddressField::LOCALITY,
        AddressField::ADDRESS_LINE1,
      ],
    ];
    $form['addressinfo']['nri'] = [
      '#type' => 'fieldset',
      '#title' => t('For NRIs'),
    ];
    $form['addressinfo']['nri']['nri_address'] = [
      '#type' => 'address',
      '#used_fields' => [
        AddressField::ADDRESS_LINE1,
      ],
      '#available_countries' => [
        'Australia',
        'Canada',
        'Germany',
        'Singapore',
        'UAE',
        'UK',
        'US',
      ],
    ];
    $form['actions']['back'] = [
      '#type' => 'submit',
      '#value' => $this->t('Back'),
      '#id' => 'back',
      '#validate' => array(),
      '#limit_validation_errors' => array(),
      '#submit' => array(),
    ];
    $form['actions']['next'] = [
      '#type' => 'submit',
      '#value' => $this->t('Next'),
      '#id' => 'next',
    ];

    $form['#submit'] = array(

    );
  }

  /**
   * Third step of form
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  private function formThree(array &$form, FormStateInterface $form_state) {
    $professional = $form_state->getValues('professional');
    // $room = $form_state->getValue('room_rating');
    // $service = $form_state->getValue('service_rating');
    // $email = $form_state->getValue('email');
    //
    // $form['review']['review_details'] = array(
    //   '#type' => 'table',
    //   '#rows' => array(
    //     array('Room Rating', $room),
    //     array('Service Rating', $service),
    //   ),
    // );
    $form['professional']['educational'] = [
      '#type' => 'fieldset',
      '#title' => t('Educational Details'),
    ];
    $form['professional']['educational']['education'] = [
      '#type' => 'select',
      '#title' => t('Education'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['professional']['educational']['qualification'] = [
      '#type' => 'select',
      '#title' => t('Qualification'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['professional']['educational']['more'] = [
      '#type' => 'textarea',
      '#title' => t('More Infomation'),
      '#required' => TRUE,
    ];

    $form['professional']['Occupational'] = [
      '#type' => 'fieldset',
      '#title' => t('Occupation Details'),
    ];
    $form['professional']['Occupational']['occupation'] = [
      '#type' => 'select',
      '#title' => t('Occupation'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['professional']['Occupational']['suboccupation'] = [
      '#type' => 'select',
      '#title' => t('Sub Occupation'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['professional']['Occupational']['employed'] = [
      '#type' => 'textfield',
      '#title' => t('Employed In'),
      '#required' => TRUE,
    ];
    $form['professional']['Occupational']['annual'] = [
      '#type' => 'textfield',
      '#title' => t('Annual Income'),
    ];
    $form['actions']['back'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Back'),
      '#id' => 'back',
      '#validate' => array(),
      '#limit_validation_errors' => array(),
      '#submit' => array(),
    );

    $form['actions']['next'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Next'),
      '#id' => 'next',
    );
  }

  /**
   * Fourth step of form
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  private function formFour(array &$form, FormStateInterface $form_state) {
    $numbers = [
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
      'five' => t('4 and above'),
    ];
    $family = $form_state->getValues('family');

    $form['family']['famvalues'] = [
      '#type' => 'select',
      '#title' => t('Family Values'),
      '#required' => TRUE,
      '#options' => [
        'liberal' => t('Liberal'),
        'moderate' => t('Moderate'),
        'orthodox' => t('Orthodox'),
        'traditional' => t('Traditional'),
      ],
    ];
    $form['family']['famtype'] = [
      '#type' => 'select',
      '#title' => t('Family Type '),
      '#required' => TRUE,
      '#options' => [
        'joint' => t('Joint'),
        'nuclear' => t('Nuclear'),
      ],
    ];
    $form['family']['famstatus'] = [
      '#type' => 'select',
      '#title' => t('Family Status'),
      '#required' => TRUE,
      '#options' => [
        'affluent' => t('Affluent'),
        'middleclass' => t('Middle Class'),
        'rich' => t('Rich'),
        'uppermiddle' => t('Upper Middle Class'),
      ],
    ];
    $form['personal']['fname'] = [
      '#type' => 'textfield',
      '#title' => t("Father's Name"),
      '#required' => TRUE,
    ];
    $form['personal']['foccu'] = [
      '#type' => 'textfield',
      '#title' => t("Father's Occupation"),
      '#required' => TRUE,
    ];
    $form['personal']['mname'] = [
      '#type' => 'textfield',
      '#title' => t("Mother's Name"),
      '#required' => TRUE,
    ];
    $form['personal']['moccu'] = [
      '#type' => 'textfield',
      '#title' => t("Mother's Occupation"),
      '#required' => TRUE,
    ];
    $form['family']['brothers'] = [
      '#type' => 'select',
      '#title' => t('No of Brothers '),
      '#required' => TRUE,
      '#options' => $numbers,
    ];
    $form['family']['bmarried'] = [
      '#type' => 'select',
      '#title' => t('Married'),
      '#required' => TRUE,
      '#options' =>$numbers,
    ];
    $form['family']['sisters'] = [
      '#type' => 'select',
      '#title' => t('No of Sisters '),
      '#required' => TRUE,
      '#options' => $numbers,
    ];
    $form['family']['smarried'] = [
      '#type' => 'select',
      '#title' => t('Married'),
      '#required' => TRUE,
      '#options' => $numbers,
    ];
    $form['personal']['relative'] = [
      '#type' => 'textfield',
      '#title' => t('Surname of Relative'),
      '#required' => TRUE,
    ];
    $form['personal']['property'] = [
      '#type' => 'textfield',
      '#title' => t('Parental Details (Property etc)'),
      '#required' => TRUE,
    ];
    $form['actions']['back'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Back'),
      '#id' => 'back',
      '#validate' => array(),
      '#limit_validation_errors' => array(),
      '#submit' => array(),
    );
    $form['actions']['next'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Next'),
      '#id' => 'next',
    );
  }

  /**
   * Fifth step of form
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  private function formFive(array &$form, FormStateInterface $form_state) {
    $prefer = $form_state->getValues('preference');
    $form['preference']['basicinfo'] = [
      '#type' => 'fieldset',
      '#title' => t("Partner's Basic Information"),
    ];
    $form['preference']['basicinfo']['age'] = [
      '#type' => 'fieldset',
      '#title' => t("Partner's Age"),
      'from' => [
        '#type' => 'number',
        '#min' => 18,
        '#max' => 65,
      ],
      'to' => [
        '#type' => 'number',
        '#min' => 18,
        '#max' => 65,
      ],
    ];
    $form['preference']['basicinfo']['height'] = [
      '#type' => 'fieldset',
      '#title' => t("Partner's Height"),
      'from' => [
        '#type' => 'number',
        '#min' => 4.00,
        '#max' => 7.00,
      ],
      'to' => [
        '#type' => 'number',
        '#min' => 4.00,
        '#max' => 7.00,
      ],
    ];
    $form['preference']['basicinfo']['marstatus'] = [
      '#type' => 'select',
      '#title' => t('Marital Status'),
      '#required' => TRUE,
      '#options' => [
        'annulled' => t('Annulled'),
        'divorcee' => t('Divorcee'),
        'seperated' => t('Seperated'),
        'single' => t('Single'),
        'widowed' => t('Widowed'),
      ],
    ];
    $form['preference']['basicinfo']['famstatus'] = [
      '#type' => 'select',
      '#title' => t('Family Status'),
      '#required' => TRUE,
      '#options' => [
        'affluent' => t('Affluent'),
        'middleclass' => t('Middle Class'),
        'rich' => t('Rich'),
        'uppermiddle' => t('Upper Middle Class'),
      ],
    ];
    $form['preference']['basicinfo']['mothertongue'] = [
      '#type' => 'select',
      '#title' => t('Mother Tongue'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['preference']['basicinfo']['eating'] = [
      '#type' => 'radios',
      '#title' => t('Eating Habits'),
      // '#required' => TRUE,
      '#options' => [
        'dosentmatter' => t("Dosen't Matter"),
        'vegetarian' => t('Vegetarian'),
        'nonvegetarian' => t('Non Vegetarian'),
        'eggetarian' => t('Eggetarian'),
      ],
    ];
    $form['preference']['basicinfo']['drinking'] = [
      '#type' => 'radios',
      '#title' => t('Drinking Habits'),
      // '#required' => TRUE,
      '#options' => [
        'dosentmatter' => t("Dosen't Matter"),
        'no' => t('No'),
        'occ' => t('Occasionally'),
        'yes' => t('Yes'),
      ],
    ];
    $form['preference']['basicinfo']['smoking'] = [
      '#type' => 'radios',
      '#title' => t('Smoking Habits'),
      // '#required' => TRUE,
      '#options' => [
        'dosentmatter' => t("Dosen't Matter"),
        'no' => t('No'),
        'occ' => t('Occasionally'),
        'yes' => t('Yes'),
      ],
    ];
    $form['preference']['basicinfo']['havechildren'] = [
      '#type' => 'select',
      '#title' => t('Have Childs'),
      '#required' => TRUE,
      '#options' => [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => t('4 and above'),
      ],
    ];
    $form['preference']['basicinfo']['aboutpartner'] = [
      '#type' => 'textarea',
      '#title' => t('About Partner'),
      '#required' => TRUE,
    ];

    $form['preference']['religious'] = [
      '#type' => 'fieldset',
      '#title' => t("Partner's Religious Information"),
    ];
    $form['preference']['religious']['religion'] = [
      '#type' => 'select',
      '#title' => t('Religion'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['preference']['religious']['caste'] = [
      '#type' => 'select',
      '#title' => t('Caste'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['preference']['religious']['subcaste'] = [
      '#type' => 'select',
      '#title' => t('Sub Caste'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['preference']['religious']['rasi'] = [
      '#type' => 'select',
      '#title' => t('Star / Raasi'),
      '#options' => [
        'notknown' => t('Not Known'),
        'aries' => t('Aries (मेष)'),
        'taurus' => t('Taurus (वृषभ)'),
        'gemini' => t('Gemini (मिथुन)'),
        'cancer' => t('Cancer (कर्क)'),
        'leo' => t('Leo  (सिंह)'),
        'virgo' => t('Virgo (कन्या)'),
        'libra ' => t('Libra (तुला)'),
        'scorpio' => t('Scorpio (वृश्चिक)'),
        'sagittarius' => t('Sagittarius (धनु)'),
        'capricorn' => t('Capricorn (मकर)'),
        'aquarius' => t('Aquarius (कुंभ)'),
        'pisces' => t('Pisces (मीन)'),
      ],
    ];
    $form['preference']['religious']['manglik'] = [
      '#type' => 'select',
      '#title' => t('Manglik'),
      '#required' => TRUE,
      '#options' => [
        'notknown' => t('Dosent Matter'),
        'yes' => t('Yes'),
        'no' => t('No'),
      ],
    ];

    $form['preference']['professional'] = [
      '#type' => 'fieldset',
      '#title' => t("Partner's Professional Information"),
    ];
    $form['preference']['professional']['education'] = [
      '#type' => 'select',
      '#title' => t('Education'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['preference']['professional']['occupation'] = [
      '#type' => 'select',
      '#title' => t('Occupation'),
      // '#required' => TRUE,
      '#options' => [],
    ];
    $form['preference']['professional']['income'] = [
      '#type' => 'fieldset',
      '#title' => t("Partner's Age"),
      'from' => [
        '#type' => 'number',
        '#min' => 18,
        '#max' => 65,
      ],
      'to' => [
        '#type' => 'number',
        '#min' => 18,
        '#max' => 65,
      ],
    ];

  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->multistep_values = $form_state->getValues() + $this->multistep_values;
    $step_key = array_search($this->step, $this->steps);

    // Get the step method
    $method = 'form' . ucwords($this->step) . 'Submit';

    if (method_exists($this, $method)) {
      $this->{$method}($form, $form_state);
    }

    if ($this->complete) {
      return;
    }

    if ($form_state->getTriggeringElement()['#id'] == 'back') {
      // Move to previous step
      $this->step = $this->steps[$step_key - 1];
    }
    else {
      // Move to next step.
      $this->step = $this->steps[$step_key + 1];
    }

    $form_state->setRebuild();
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function formTwoSubmit(array &$form, FormStateInterface &$form_state) {
    drupal_set_message($this->t('Thank you for your submission'));
    $form_state->setRedirect('<front>');
    $this->complete = TRUE;
  }

}
