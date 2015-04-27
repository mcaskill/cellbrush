<?php

namespace Donquixote\Cellbrush\Handle;

use Donquixote\Cellbrush\TSection\TableSection;

class Handle {

  /**
   * @var TableSection
   */
  protected $tsection;

  /**
   * @var string
   */
  protected $handleName;

  /**
   * @param TableSection $tsection
   * @param string $handleName
   */
  function __construct(TableSection $tsection, $handleName) {
    $this->tsection = $tsection;
    $this->handleName = $handleName;
    return $this;
  }

  /**
   * @return string|int
   */
  function getName() {
    return $this->handleName;
  }

  /**
   * @return string|int
   */
  function getTSection() {
    return $this->tsection;
  }

}
