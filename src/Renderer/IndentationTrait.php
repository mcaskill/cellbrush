<?php

namespace Donquixote\Cellbrush\Renderer;

/**
 * @see RendererTrait
 */
trait IndentationTrait {

  /**
   * @var int
   *   Indentation level of the element
   */
  private $indentLevel = 0;

  /**
   * Sets the indentation level
   *
   * @param int $level Indentation level
   *
   * @return $this
   */
  function setIndentLevel($level) {
    $level = intval($level);
    if (0 <= $level) {
      $this->indentLevel = $level;
    }
    return $this;
  }

  /**
   * Increment the indentation level
   *
   * @return $this
   */
  function incrementIndent() {
    $this->indentLevel++;
    return $this;
  }

  /**
   * Decrement the indentation level
   *
   * @return $this
   */
  function decrementIndent() {
    if ( ($this->indentLevel - 1) > 0 ) {
      $this->indentLevel--;
    }
    return $this;
  }

  /**
   * Gets the indentation level
   *
   * @return int
   */
  function getIndentLevel() {
    return $this->indentLevel;
  }

  /**
   * Returns the string to indent the element
   *
   * @param bool $boop
   *
   * @return string
   */
  function getIndent($boop = false) {
    if ( $master = $this->getGlobalRenderer() ) {
      return str_repeat($master->getRenderOption('indent'), $this->getIndentLevel() + ($boop ? 1 : 0));
    }
    return '';
  }

  /**
   * @param object $context
   *
   * @return mixed
   */
  function getGlobalRenderer($context = null) {
    if ( ! $context ) {
      $context = $this;
    }

    if ( method_exists($context, 'getRenderOption') ) {
      return $context;
    }
    if ( isset($context->parentNode) ) {
      return $context->getGlobalRenderer($context->parentNode);
    }

    return false;
  }
}
