<?php

namespace Donquixote\Cellbrush\Handle;

class RowHandle extends Handle {

  /**
   * @param string $class
   *
   * @return $this
   */
  public function addClass($class) {
    $this->tsection->addRowClass($this->handleName, $class);
    return $this;
  }

  /**
   * @param string[] $classes
   *
   * @return $this
   */
  public function addClasses(array $classes) {
    $this->tsection->addRowClasses($this->handleName, $classes);
    return $this;
  }

  /**
   * @param string $key
   * @param string $value
   *
   * @return $this
   */
  public function setAttribute($key, $value) {
    $this->tsection->setRowAttribute($this->handleName, $key, $value);
    return $this;
  }

  /**
   * @param string[] $attributes
   *   Format: $[$key] = $value
   *
   * @return $this
   */
  public function setAttributes(array $attributes) {
    $this->tsection->setRowAttributes($this->handleName, $attributes);
    return $this;
  }

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
