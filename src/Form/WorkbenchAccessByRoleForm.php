<?php

/**
 * @file
 * Contains \Drupal\workbench_access\Form\WorkbenchAccessByRoleForm.
 */

namespace Drupal\workbench_access\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Drupal\Core\Form\FormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\workbench_access\WorkbenchAccessManagerInterface;

/**
 * Configure Workbench access settings for this site.
 */
class WorkbenchAccessByRoleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'workbench_access_by_role';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL) {
    dpm($id);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}