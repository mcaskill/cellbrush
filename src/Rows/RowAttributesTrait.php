<?php

namespace Donquixote\Cellbrush\Rows;

use Donquixote\Cellbrush\Html\Multiple\DynamicAttributesMap;

/**
 * @see RowAttributesInterface
 */
trait RowAttributesTrait {

  /**
   * Row classes for all table sections.
   *
   * @var DynamicAttributesMap
   */
  private $rowAttributes;

  /**
   * @var string[][]
   *   Format: $[] = ['odd', 'even']
   */
  private $rowStripings = [];

  function __constructRowAttributes() {
    $this->rowAttributes = new DynamicAttributesMap();
  }

  /**
   * @param string $rowName
   * @param string $class
   *
   * @return $this
   */
  public function addRowClass($rowName, $class) {
    $this->rowAttributes->nameAddClass($rowName, $class);
    return $this;
  }

  /**
   * @param string[] $rowClasses
   *   Format: $[$rowName] = $class
   *
   * @return $this
   */
  public function addRowClasses(array $rowClasses) {
    $this->rowAttributes->namesAddClasses($rowClasses);
    return $this;
  }

  /**
   * @param string $rowName
   * @param string $key
   * @param string $value
   *
   * @return $this
   */
  public function setRowAttribute($rowName, $key, $value) {
    $this->rowAttributes->nameSetAttribute($rowName, $key, $value);
    return $this;
  }

  /**
   * @param string[] $namesAttributes
   *   Format: $[$rowName] = [$key => $value]
   *
   * @return $this
   */
  public function setRowAttributes(array $namesAttributes) {
    $this->rowAttributes->namesSetAttributes($namesAttributes);
    return $this;
  }

  /**
   * @param string[] $striping
   *   Classes for striping. E.g. ['odd', 'even'], or '['1st', '2nd', '3rd'].
   *
   * @return $this
   */
  public function addRowStriping(array $striping = ['odd', 'even']) {
    $this->rowStripings[] = $striping;
    return $this;
  }

}
