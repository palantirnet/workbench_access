<?php

namespace Drupal\workbench_access\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Defines the workbench_access SectionAssociation class.
 *
 * @ContentEntityType(
 *   id = "section_association",
 *   label = @Translation("Section association"),
 *   bundle_label = @Translation("Section association"),
 *   handlers = {
 *     "access" = "Drupal\workbench_access\SectionAssociationAccessControlHandler",
 *     "views_data" = "\Drupal\views\EntityViewsData"
 *   },
 *   admin_permission = "assign workbench access",
 *   base_table = "section_association",
 *   data_table = "section_association_field_data",
 *   revision_table = "section_association_revision",
 *   revision_data_table = "section_association_field_revision_data",
 *   translatable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "revision" = "revision_id",
 *   }
 * )
 *
 * @internal
 *   This entity is marked internal because it should not be used directly.
 */
class SectionAssociation extends ContentEntityBase implements SectionAssociationInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Assigned users.
    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Users'))
      ->setDescription(t('The Name of the associated user.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setRevisionable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'author',
        'weight' => -2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => -2,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // Assigned roles.
    $fields['role_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Role'))
      ->setDescription(t('The roles associated with this section.'))
      ->setSetting('target_type', 'user_role')
      ->setSetting('handler', 'default')
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setRevisionable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    $fields['section_scheme_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Section scheme type'))
      ->setDescription(t('The type of access scheme being used.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', EntityTypeInterface::ID_MAX_LENGTH);
    $fields['section_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Section ID'))
      ->setDescription(t('The id of the access section.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', EntityTypeInterface::ID_MAX_LENGTH);

    return $fields;
  }

}