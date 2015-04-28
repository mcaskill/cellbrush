<?php

namespace Donquixote\Cellbrush\Columns;

use Donquixote\Cellbrush\Html\Multiple\DynamicAttributesMap;

/**
 * @see ColumnAttributesInterface
 */
trait ColumnAttributesTrait {

  /**
   * Column classes for all table sections.
   *
   * @var DynamicAttributesMap
   */
  private $colAttributes;

  function __constructColumnAttributes() {
    $this->colAttributes = new DynamicAttributesMap();
  }

  /**
   * @param string $colName
   * @param string $class
   *
   * @return $this
   */
  public function addColClass($colName, $class) {
    $this->colAttributes->nameAddClass($colName, $class);
    return $this;
  }

  /**
   * @param string $colName
   * @param string[] $classes
   *
   * @return $this
   */
  public function addColClasses($colName, array $classes) {
    $this->colAttributes->nameAddClasses($colName, $classes);
    return $this;
  }

  /**
   * @param string[] $colClasses
   *   Format: - $[$colName] = $class
   *           - $[$colName] = $classes[]
   *
   * @return $this
   */
  public function mapColClasses(array $colClasses) {
    $this->colAttributes->namesAddClasses($colClasses);
    return $this;
  }

  /**
   * @param string $colName
   * @param string $key
   * @param string $value
   *
   * @return $this
   */
  public function setColAttribute($colName, $key, $value) {
    $this->colAttributes->nameSetAttribute($colName, $key, $value);
    return $this;
  }

  /**
   * @param string $colName
   * @param string[] $attributes
   *   Format: $[$key] = $value
   *
   * @return $this
   */
  public function setColAttributes($colName, array $attributes) {
    $this->colAttributes->nameSetAttributes($colName, $attributes);
    return $this;
  }

  /**
   * @param string[] $namesAttributes
   *   Format: $[$colName] = [$key => $value]
   *
   * @return $this
   */
  public function mapColAttributes(array $namesAttributes) {
    $this->colAttributes->namesSetAttributes($namesAttributes);
    return $this;
  }

}
