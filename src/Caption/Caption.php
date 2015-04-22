<?php

namespace Donquixote\Cellbrush\Caption;

use Donquixote\Cellbrush\Html\Element;
use Donquixote\Cellbrush\Html\ContentTrait;
use Donquixote\Cellbrush\Html\MutableAttributesInterface;
use Donquixote\Cellbrush\Html\MutableAttributesTrait;

class Caption extends Element implements MutableAttributesInterface {

  use ContentTrait, MutableAttributesTrait;

  /**
   * @param string $content
   */
  function __construct($content = '') {
    $this->__constructMutableAttributes();

    parent::__construct('caption', $content);
  }
}