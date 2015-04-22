<?php

namespace Donquixote\Cellbrush\Caption;

use Donquixote\Cellbrush\Html\Element;
use Donquixote\Cellbrush\Html\ContentTrait;

class Caption extends Element {

  use ContentTrait;

  /**
   * @param string $content
   */
  function __construct($content = '') {
    parent::__construct('caption', $content);
  }

  /**
   * @return string
   */
  function render() {
    if ($this->hasContent()) {
      return '  ' . parent::render() . "\n";
    }
  }
}
