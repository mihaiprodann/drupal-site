<?php
/**
 * @file
 * Contains \Drupal\show_datetime\Controller\DateTimeController.
 */
namespace Drupal\show_datetime\Controller;

use Drupal\node\Entity\Node;

class DateTimeController {
  public function content() {
    $news_id = \Drupal::entityQuery('node')
                ->accessCheck(TRUE)
                ->condition('type', 'news')
                ->execute();

    $titles = [];
    foreach ($news_id as $id) {
      $node = Node::load($id);
      $title = $node->getTitle();
      $titles[] = [
        '#type' => 'html_tag',
        '#tag' => 'h4',
        '#value' => $title,
      ];
    }

    return [
      [
        '#theme' => 'link_list',
        '#links' => $titles,
      ],

    ];
  }
}
