<?php

/**
 * @file
 * Contains \Drupal\workbench_access\Plugin\AccessControlHierarchy\Menu.
 */

namespace Drupal\workbench_access\Plugin\AccessControlHierarchy;

use Drupal\workbench_access\AccessControlHierarchyBase;
use Drupal\Core\Menu\MenuLinkManagerInterface;
use Drupal\Core\Menu\MenuLinkTreeElement;
use Drupal\Core\Menu\MenuLinkTreeInterface;
use Drupal\Core\Menu\MenuTreeParameters;
use Drupal\Core\Menu\MenuLinkInterface;

/**
 * Defines a hierarchy based on a Menu.
 *
 * @AccessControlHierarchy(
 *   id = "menu",
 *   module = "menu_ui",
 *   base_entity = "menu",
 *   entity = "menu_link_content",
 *   label = @Translation("Menu"),
 *   description = @Translation("Uses a menu as an access control hierarchy.")
 * )
 */
class Menu extends AccessControlHierarchyBase {

  /**
   * @inheritdoc
   */
  public function getTree() {
    $config = $this->config('workbench_access.settings');
    $parents = $config->get('parents');
    $tree = array();
    $this->menuTree = \Drupal::getContainer()->get('menu.link_tree');
    foreach ($parents as $id => $label) {
      $tree[$id][$id] = array(
        'label' => $label,
        'depth' => 0,
        'parent' => '',
        'weight' => 0,
        'description' => $label,
      );
      $data = $this->menuTree->load($id, new MenuTreeParameters());
      foreach ($data as $link_id => $link) {
        $tree[$id][$link_id] = array(
          'label' => $link->link->getTitle(),
          'depth' => $link->depth,
          'parent' => $link->link->getParent(),
          'weight' => $link->link->getWeight(),
          'description' => $link->link->getDescription(),
        );
      }
    }
    return $tree;
  }

}