<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase {
    public function simpleContent() {
        return [
            '#type' => 'markup',
            '#markup' => $this->t('Hello Drupal world'),
        ];
    }
    public function variableContent($name_1, $name_2) {
        return [
            '#type' => 'markup',
            '#markup' => $this->t('@name1 and @name2',
            ['@name1' => $name_1, '@name2' => $name_2]),
        ];
    }
}
