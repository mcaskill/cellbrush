<?php

namespace Donquixote\Cellbrush\Renderer;

trait RendererTrait {

  /**
   * @var mixed[] {
   *     @type string $charset The character encoding to be used.
   *     @type string $indent  The indentation style and size.
   *     @type string $ending  How end of lines are represented.
   * }
   */
  protected $renderDefaults = [
    'charset' => 'UTF-8',
    'indent'  => "\t",
    'ending'  => "\n"
  ];

  /**
   * @var mixed[]
   */
  private $renderOptions = [];

  function __constructRendererOptions() {
    $this->resetRenderOptions();
  }

  /**
   * Sets render option(s)
   *
   * @param string|array $nameOrOptions
   *   Option name or array ('option name' => 'option value')
   * @param mixed $value
   *   Option value, if first argument is not an array
   * @return $this
   */
  function setRenderOption($nameOrOptions, $value = null) {
    if (is_array($nameOrOptions)) {
      foreach ($nameOrOptions as $k => $v) {
        $this->setOption($k, $v);
      }
    } else if (in_array($nameOrOptions, array_keys($this->renderDefaults))) {
      $this->renderOptions[$nameOrOptions] = $value;
    }
    return $this;
  }

  /**
   * Retrieve render option(s)
   *
   * @param string $name
   *   Option name
   *
   * @return mixed Option value, null if option does not exist,
   *               array of all options if $name is not given
   */
  function getRenderOption($name = null) {
    if (null === $name) {
      return $this->renderOptions;
    } else {
      return (isset($this->renderOptions[$name]) ? $this->renderOptions[$name] : null);
    }
  }

  /**
   * @return $this
   */
  function resetRenderOptions() {
    $this->renderOptions = $this->renderDefaults;
    return $this;
  }

  /**
   * @return string
   */
  function getEOL() {
    return $this->getRenderOption('ending');
  }
}
