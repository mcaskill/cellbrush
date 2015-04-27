<?php

namespace Donquixote\Cellbrush\Rows;

use Donquixote\Cellbrush\Axis\DynamicAxis;

/**
 * @see TableRowsInterface
 */
trait TableRowsTrait {

  /**
   * @var DynamicAxis
   */
  private $rows;

  public function __constructTableRows() {
    $this->rows = new DynamicAxis();
  }

  /**
   * @param string $rowName
   *
   * @return $this
   * @throws \Exception
   */
  function addRowName($rowName) {
    $this->rows->addName($rowName);
    return $this;
  }

  /**
   * @param string[] $rowNames
   *
   * @return $this
   * @throws \Exception
   */
  function addRowNames(array $rowNames) {
    $this->rows->addNames($rowNames);
    return $this;
  }

  /**
   * @param string $groupName
   * @param string[] $rowNameSuffixes
   *
   * @return $this
   * @throws \Exception
   */
  function addRowGroup($groupName, array $rowNameSuffixes) {
    $this->rows->addGroup($groupName, $rowNameSuffixes);
    return $this;
  }

  /**
   * Sets the order for all rows or row groups at the top level, or at a
   * the relative top level within one group.
   *
   * @param string[] $orderedBaseRowNames
   * @param string|null $groupPrefix
   *
   * @return $this
   * @throws \Exception
   */
  function setRowOrder($orderedBaseRowNames, $groupPrefix = null) {
    $this->rows->setOrder($orderedBaseRowNames, $groupPrefix);
    return $this;
  }

  /**
   * @param string $rowName
   *
   * @return true
   */
  function rowExists($rowName) {
    return $this->rows->nameExists($rowName);
  }

}
