<?php

namespace Donquixote\Cellbrush\Handle;

class SectionColHandle extends Handle {

  /**
   * @param string $rowName
   * @param string $content
   *
   * @return $this
   */
  function td($rowName, $content) {
    $this->tsection->td($rowName, $this->handleName, $content);
    return $this;
  }

  /**
   * @param string $rowName ,
   * @param string $content
   *
   * @return $this
   */
  function th($rowName, $content) {
    $this->tsection->th($rowName, $this->handleName, $content);
    return $this;
  }

  /**
   * @param string[] $cells
   *   Format: $[$handleName] = $content
   *
   * @return $this
   */
  function tdMultiple(array $cells) {
    foreach ($cells as $rowName => $content) {
      $this->tsection->td($rowName, $this->handleName, $content);
    }
    return $this;
  }

  /**
   * @param string[] $cells
   *   Format: $[$handleName] = $content
   *
   * @return $this
   */
  function thMultiple(array $cells) {
    foreach ($cells as $rowName => $content) {
      $this->tsection->th($rowName, $this->handleName, $content);
    }
    return $this;
  }

}
