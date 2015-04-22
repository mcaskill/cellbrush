<?php

namespace Donquixote\Cellbrush\Renderer;

interface RendererInterface {

  /**
   * @param string|array $nameOrOptions
   * @param mixed $value
   */
  public function setRenderOption($nameOrOptions, $value);

  /**
   * @param $name
   *
   * @return mixed
   */
  public function getRenderOption($name);

}
