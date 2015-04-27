<?php

namespace Donquixote\Cellbrush\Handle;

class RowHandle extends Handle {

  /**
   * @param string $colName
   * @param string $content
   *
   * @return $this
   */
  function td($colName, $content) {
    $this->tsection->td($this->handleName, $colName, $content);
    return $this;
  }

  /**
   * @param string $colName
   * @param string $content
   *
   * @return $this
   */
  function th($colName, $content) {
    $this->tsection->th($this->handleName, $colName, $content);
    return $this;
  }

  /**
   * @param string[] $cells
   *   Format: $[$colName] = $content
   *
   * @return $this
   */
  function tdMultiple(array $cells) {
    foreach ($cells as $colName => $content) {
      $this->tsection->td($this->handleName, $colName, $content);
    }
    return $this;
  }

  /**
   * @param string[] $cells
   *   Format: $[$colName] = $content
   *
   * @return $this
   */
  function thMultiple(array $cells) {
    foreach ($cells as $colName => $content) {
      $this->tsection->th($this->handleName, $colName, $content);
    }
    return $this;
  }

  /**
   * Adds a td cell with a colspan that ends where the next known cell begins.
   *
   * @param string|string[] $colName
   *   Column name, group or range.
   * @param string $content
   *   HTML cell content.
   *
   * @return $this
   */
  function tdOpenEnd($colName, $content) {
    $this->tsection->tdOpenEnd($this->handleName, $colName, $content);
    return $this;
  }

  /**
   * Adds a th cell with a colspan that ends where the next known cell begins.
   *
   * @param string|string[] $colName
   *   Column name, group or range.
   * @param string $content
   *   HTML cell content.
   *
   * @return $this
   */
  public function thOpenEnd($colName, $content) {
    $this->tsection->thOpenEnd($this->handleName, $colName, $content);
  }

}
