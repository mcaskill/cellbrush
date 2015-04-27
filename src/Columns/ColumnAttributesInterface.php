<?php

namespace Donquixote\Cellbrush\Columns;

interface ColumnAttributesInterface {

  /**
   * @param string $colName
   * @param string $class
   *
   * @return $this
   */
  public function addColClass($colName, $class);

  /**
   * @param string[] $colClasses
   *   Format: $[$colName] = $class
   *
   * @return $this
   */
  public function addColClasses(array $colClasses);

}
