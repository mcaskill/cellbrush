<?php

namespace Donquixote\Cellbrush\Html;

/**
 * A primitive representation of textual content.
 *
 * @see DOMText
 * @see DOMCharacterData
 */
trait ContentTrait {

  /**
   * The size of the $content
   *
   * @var int
   */
  protected $length = 0;

  /**
   * @param string $tagName
   * @param string $content
   * @return string
   */
  function getContent() {
    return $this->content;
  }

  /**
   * @param string $tagName
   * @param string $content
   * @return string
   */
  function hasContent() {
    return ! empty($this->content);
  }

  /**
   * @param string $content
   */
  function setContent($content = '') {
    $this->content = $content;
    return $this;
  }
}
