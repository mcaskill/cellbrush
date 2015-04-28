<?php

namespace Donquixote\Cellbrush\Columns;

interface ColumnAttributesInterface {

  /**
   * @param string $colName
   * @param string $class
   */
  public function addColClass($colName, $class);

  /**
   * @param string $colName
   * @param string[] $classes
   */
  public function addColClasses($colName, array $classes);

  /**
   * @param string[] $colClasses
   *   Format: - $[$colName] = $class
   *           - $[$colName] = $classes[]
   */
  public function mapColClasses(array $colClasses);

  /**
   * @param string $colName
   * @param string $key
   * @param string $value
   */
  public function setColAttribute($colName, $key, $value);

  /**
   * @param string $colName
   * @param string[] $attributes
   *   Format: $[$key] = $value
   */
  public function setColAttributes($colName, array $attributes);

  /**
   * @param string[] $namesAttributes
   *   Format: $[$colName] = [$key => $value]
   */
  public function mapColAttributes(array $namesAttributes);

}
