<?php

namespace Donquixote\Cellbrush\TSection;

use Donquixote\Cellbrush\Axis\Axis;
use Donquixote\Cellbrush\Axis\DynamicAxis;
use Donquixote\Cellbrush\BuildContainer\BuildContainer;
use Donquixote\Cellbrush\BuildContainer\BuildContainerBase;
use Donquixote\Cellbrush\Columns\ColumnAttributesTrait;
use Donquixote\Cellbrush\Html\Multiple\DynamicAttributesMap;
use Donquixote\Cellbrush\Html\Multiple\StaticAttributesMap;
use Donquixote\Cellbrush\Html\MutableAttributesTrait;
use Donquixote\Cellbrush\Handle\RowHandle;
use Donquixote\Cellbrush\Handle\SectionColHandle;
use Donquixote\Cellbrush\Renderer\IndentationInterface;
use Donquixote\Cellbrush\Renderer\IndentationTrait;
use Donquixote\Cellbrush\Table\TableInterface;
use Donquixote\Cellbrush\Rows\RowAttributesTrait;
use Donquixote\Cellbrush\Rows\TableRowsTrait;

class TableSection implements TableSectionInterface, IndentationInterface {

  use MutableAttributesTrait, TableRowsTrait, RowAttributesTrait, ColumnAttributesTrait, IndentationTrait;

  /**
   * @var string
   */
  private $tagName;

  /**
   * @var \Donquixote\Cellbrush\Cell\CellInterface[][]
   *   Format: $[$rowName][$colName] = $content
   */
  private $cellContents = [];

  /**
   * A marker for cells that should be open-ended.
   *
   * @var true[][]
   *   Format: $[$rowName][$colName] = true
   */
  private $openEndCells = [];

  /**
   * @var string[][]
   *   Format: $[$rowName][$colName] = 'th'
   */
  private $cellTagNames = [];

  /**
   * Classes for table cells.
   *
   * These can be set even if no content is set for this cell yet.
   *
   * @var string[][][]
   *   Format: $[$rowName][$colName][$class] = $class
   */
  private $cellClasses = [];

  /**
   * @var TableInterface
   */
  public $parentNode;

  /**
   * @param string $tagName
   * @param TableInterface|null $parentNode
   */
  function __construct($tagName, TableInterface $parentNode = null) {
    $this->__constructMutableAttributes();
    $this->__constructColumnAttributes();
    $this->__constructTableRows();
    $this->__constructRowAttributes();
    $this->tagName = $tagName;
    $this->parentNode = $parentNode;
  }

  /**
   * @param string $colName
   *
   * @return SectionColHandle
   * @throws \Exception
   */
  public function colHandle($colName) {
    return new SectionColHandle($this, $colName);
  }

  /**
   * @param string $rowName
   *
   * @return \Donquixote\Cellbrush\Handle\RowHandle
   * @throws \Exception
   */
  public function rowHandle($rowName) {
    if (!$this->rowExists($rowName)) {
      throw new \Exception("Row '$rowName' does not exist.");
    }
    return new RowHandle($this, $rowName);
  }

  /**
   * Adds a row and returns the row handle.
   * This is a hybrid of addRowName() and rowHandle().
   *
   * @param string $rowName
   *
   * @return RowHandle
   * @throws \Exception
   */
  public function addRow($rowName) {
    $this->addRowName($rowName);
    return new RowHandle($this, $rowName);
  }

  /**
   * @param string $rowName
   *
   * @return RowHandle
   */
  public function addRowIfNotExists($rowName) {
    $this->rows->addNameIfNotExists($rowName);
    return new RowHandle($this, $rowName);
  }

  /**
   * @param string|string[] $rowName
   *   Row name, group or range.
   * @param string|string[] $colName
   *   Column name, group or range.
   * @param string $content
   *   HTML cell content.
   *
   * @return $this
   * @throws \Exception
   */
  function td($rowName, $colName, $content) {
    $this->cellContents[$rowName][$colName] = $content;
    return $this;
  }

  /**
   * @param string|string[] $rowName
   *   Row name, group or range.
   * @param string|string[] $colName
   *   Column name, group or range.
   * @param string $content
   *   HTML cell content.
   *
   * @return $this
   * @throws \Exception
   */
  function th($rowName, $colName, $content) {
    $this->cellContents[$rowName][$colName] = $content;
    $this->cellTagNames[$rowName][$colName] = 'th';
    return $this;
  }

  /**
   * Adds a td cell with a colspan that ends where the next known cell begins.
   *
   * @param string|string[] $rowName
   *   Row name, group or range.
   * @param string|string[] $colName
   *   Column name, group or range.
   * @param string $content
   *   HTML cell content.
   *
   * @return $this
   * @throws \Exception
   */
  function tdOpenEnd($rowName, $colName, $content) {
    $this->cellContents[$rowName][$colName] = $content;
    $this->openEndCells[$rowName][$colName] = true;
    return $this;
  }

  /**
   * Adds a th cell with a colspan that ends where the next known cell begins.
   *
   * @param string $rowName
   *   Row name, group or range.
   * @param string $colName
   *   Column name, group or range.
   * @param string $content
   *   HTML cell content.
   *
   * @return $this
   * @throws \Exception
   */
  function thOpenEnd($rowName, $colName, $content) {
    $this->cellContents[$rowName][$colName] = $content;
    $this->openEndCells[$rowName][$colName] = true;
    $this->cellTagNames[$rowName][$colName] = 'th';
    return $this;
  }

  /**
   * @param string $rowName
   * @param string $colName
   * @param string $class
   *
   * @return $this
   */
  public function addCellClass($rowName, $colName, $class) {
    $this->cellClasses[$rowName][$colName][$class] = $class;
  }

  /**
   * @param Axis $columns
   *   Either 'thead' or 'tbody' or 'tfoot'.
   * @param StaticAttributesMap $tableColAttributes
   *
   * @return string
   *   Rendered table section html.
   */
  function render(Axis $columns, StaticAttributesMap $tableColAttributes) {
    if ($this->rows->isEmpty() || !$columns->getCount()) {
      return '';
    }

    $parent = $this->parentNode;
    if ($parent instanceof TableInterface) {
      $eol = $parent->getEOL();
      $ind = $this->setIndentLevel($parent->getIndentLevel() + 1)->getIndent();
    }
    else {
      $eol = $ind = '';
    }

    $container = new BuildContainer(
      $this->rows->takeSnapshot(),
      $columns,
      $this);

    /** @var BuildContainerBase $container */
    $container->CellContents = $this->cellContents;
    $container->CellClasses = $this->cellClasses;
    $container->CellTagNames = $this->cellTagNames;
    $container->OpenEndCells = $this->openEndCells;
    $container->RowAttributes = clone $this->rowAttributes->staticCopy();
    $container->RowStripings = $this->rowStripings;
    $container->TableColAttributes = $tableColAttributes;
    $container->SectionColAttributes = $this->colAttributes->staticCopy();

    /** @var BuildContainer $container */
    $innerHtml = $container->InnerHtml;

    return $ind . $this->renderTag($this->tagName, $eol . $innerHtml . $ind) . $eol;
  }

}
