<?php

namespace Donquixote\Cellbrush\Renderer;

interface IndentationInterface {

  /**
   * @param int $level
   */
  public function setIndentLevel($level);

  /**
   * @return int
   */
  public function getIndentLevel();

  /**
   * @return string
   */
  public function getIndent();

}
