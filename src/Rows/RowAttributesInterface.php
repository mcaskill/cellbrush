<?php

namespace Donquixote\Cellbrush\Rows;

interface RowAttributesInterface {

  /**
   * @param string $rowName
   * @param string $class
   */
  public function addRowClass($rowName, $class);

  /**
   * @param string $rowName
   * @param string[] $classes
   */
  public function addRowClasses($rowName, array $classes);

  /**
   * @param string[] $rowClasses
   *   Format: - $[$rowName] = $class
   *           - $[$rowName] = $classes[]
   */
  public function mapRowClasses(array $rowClasses);

  /**
   * @param string[] $striping
   *   Classes for striping. E.g. ['odd', 'even'], or '['1st', '2nd', '3rd'].
   */
  public function addRowStriping(array $striping = ['odd', 'even']);

  /**
   * @param string $rowName
   * @param string $key
   * @param string $value
   *
   * @return $this
   */
  public function setRowAttribute($rowName, $key, $value);

  /**
   * @param string $rowName
   * @param string[] $attributes
   *   Format: $[$key] = $value
   *
   * @return $this
   */
  public function setRowAttributes($rowName, array $attributes);

  /**
   * @param string[] $namesAttributes
   *   Format: $[$rowName] = [$key => $value]
   *
   * @return $this
   */
  public function mapRowAttributes(array $namesAttributes);

}
