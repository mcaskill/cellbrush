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
   * @param string[] $colClasses
   *   Format: $[$colName] = $class
   *
   * @return $this
   */
  public function addColClasses(array $colClasses) {
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
   * @param string[] $namesAttributes
   *   Format: $[$colName] = [$key => $value]
   *
   * @return $this
   */
  public function setColAttributes(array $namesAttributes) {
    $this->colAttributes->namesSetAttributes($namesAttributes);
    return $this;
  }

}
