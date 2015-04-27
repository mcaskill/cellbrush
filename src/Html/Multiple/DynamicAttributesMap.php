<?php

namespace Donquixote\Cellbrush\Html\Multiple;

/**
 * Object representing attributes for a series of html elements.
 *
 * E.g. for all TR elements of a table section.
 */
class DynamicAttributesMap extends AttributesMapBase {

  /**
   * @return StaticAttributesMap
   */
  public function staticCopy() {
    return StaticAttributesMap::createCopy($this);
  }

  /**
   * @param string $name
   * @param string $class
   */
  public function nameAddClass($name, $class) {
    $this->classes[$name][$class] = $class;
  }

  /**
   * @param string $name
   * @param string[] $classes
   */
  public function nameAddClasses($name, array $classes) {
    foreach ($classes as $class) {
      $this->classes[$name][$class] = $class;
    }
  }

  /**
   * @param string[] $namesClasses
   *   Format: $[$name] = $class
   */
  public function namesAddClasses(array $namesClasses) {
    foreach ($namesClasses as $name => $class) {
      $this->classes[$name][$class] = $class;
    }
  }

  /**
   * @param string $name
   * @param string $key
   * @param string $value
   */
  public function nameSetAttribute($name, $key, $value) {
    $this->attributes[$name][$key] = $value;
  }

  /**
   * @param string $name
   * @param string[] $attributes
   */
  public function nameSetAttributes($name, array $attributes) {
    foreach ($attributes as $key => $value) {
      $this->attributes[$name][$key] = $value;
    }
  }

  /**
   * @param string[] $namesAttributes
   *   Format: $[$colName] = [$key => $value]
   */
  public function namesSetAttributes(array $namesAttributes) {
    foreach ($namesAttributes as $name => $attributes) {
      foreach ($attributes as $key => $value) {
        $this->attributes[$name][$key] = $value;
      }
    }
  }

}
