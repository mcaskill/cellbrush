<?php

namespace Donquixote\Cellbrush\Handle;

class SectionColHandle extends Handle {

  /**
   * @param string $class
   *
   * @return $this
   */
  public function addClass($class) {
    $this->tsection->addColClass($this->handleName, $class);
    return $this;
  }

  /**
   * @param string[] $classes
   *
   * @return $this
   */
  public function addClasses(array $classes) {
    $this->tsection->addColClasses($this->handleName, $classes);
    return $this;
  }

  /**
   * @param string $key
   * @param string $value
   *
   * @return $this
   */
  public function setAttribute($key, $value) {
    $this->tsection->setColAttribute($this->handleName, $key, $value);
    return $this;
  }

  /**
   * @param string[] $attributes
   *   Format: $[$key] = $value
   *
   * @return $this
   */
  public function setAttributes(array $attributes) {
    $this->tsection->setColAttributes($this->handleName, $attributes);
    return $this;
  }

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
