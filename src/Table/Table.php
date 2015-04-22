<?php

namespace Donquixote\Cellbrush\Table;

use Donquixote\Cellbrush\Columns\ColumnClassesTrait;
use Donquixote\Cellbrush\Columns\TableColumnsTrait;
use Donquixote\Cellbrush\Html\Multiple\DynamicAttributesMap;
use Donquixote\Cellbrush\Html\MutableAttributesTrait;
use Donquixote\Cellbrush\Handle\RowHandle;
use Donquixote\Cellbrush\Renderer\IndentationInterface;
use Donquixote\Cellbrush\Renderer\IndentationTrait;
use Donquixote\Cellbrush\Renderer\RendererInterface;
use Donquixote\Cellbrush\Renderer\RendererTrait;
use Donquixote\Cellbrush\TSection\TableSection;

class Table extends TBodyWrapper implements TableInterface, IndentationInterface, RendererInterface {

  use MutableAttributesTrait, IndentationTrait, RendererTrait, TableColumnsTrait, ColumnClassesTrait;

  /**
   * @var TableSection
   */
  private $thead;

  /**
   * Additional tbody sections.
   * (The main tbody is in the protected $tbody variable of TBodyWrapper)
   *
   * @var TableSection[]
   */
  private $tbodies = array();

  /**
   * @var TableSection
   */
  private $tfoot;

  /**
   * The constructor.
   */
  function __construct() {
    $this->__constructMutableAttributes();
    $this->__constructRendererOptions();
    $this->__constructTableColumns();
    $this->__constructColumnClasses();
    $this->columns;
    $this->thead = new TableSection('thead', $this);
    parent::__construct(new TableSection('tbody', $this));
    $this->tfoot = new TableSection('tfoot', $this);
    $this->colAttributes = new DynamicAttributesMap();
  }

  /**
   * @return self
   */
  static function create() {
    return new self();
  }

  /**
   * @return TableSection
   */
  function thead() {
    return $this->thead;
  }

  /**
   * @param string|null $name
   *   Key to identify the tbody, if another than the main tbody is used.
   *
   * @return TableSection
   */
  function tbody($name = null) {
    if (!isset($name)) {
      return parent::tbody();
    }
    return isset($this->tbodies[$name])
      ? $this->tbodies[$name]
      : $this->tbodies[$name] = new TableSection('tbody', $this);
  }

  /**
   * @return TableSection
   */
  function tfoot() {
    return $this->tfoot;
  }

  /**
   * A standardized way to access the main or only row of thead.
   *
   * @param string $rowName
   *
   * @return RowHandle
   */
  function headRow($rowName = 'head') {
    return $this->thead->addRowIfNotExists($rowName);
  }

  /**
   * @return string
   *   Rendered table html.
   */
  function render() {
    $colAttributes = $this->colAttributes->staticCopy();
    $columns = $this->columns->takeSnapshot();
    $html = '';
    $html .= $this->thead->render($columns, $colAttributes);
    $html .= $this->tfoot->render($columns, $colAttributes);
    $html .= $this->renderTBody($columns, $colAttributes);
    foreach ($this->tbodies as $tbody) {
      $html .= $tbody->render($columns, $colAttributes);
    }
    $eol = $this->getEOL();
    return $this->renderTag('table', $eol . $html) . $eol;
  }
}
