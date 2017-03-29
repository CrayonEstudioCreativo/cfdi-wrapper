<?php
  /**
   * Created by PhpStorm.
   * User: IROXIT
   * Date: 27/01/2017
   * Time: 03:19 PM
   */

  namespace Crayon\Utils;

  use Twig_Loader_Chain;

  class TwigEnv {

    /** @var Twig_Loader_Chain $twig_loader  */
    private $twig_loader = NULL;
    /** @var \Twig_Environment */
    private $twig_env = NULL;

    /**
     * TwigHandler constructor.
     *
     * @param array $path
     * @param array $options
     */
    public function __construct(array $path, array $options = []) {
      $this->twig_loader = new \Twig_Loader_Chain();
      $this->twig_loader->addLoader(new \Twig_Loader_Filesystem($path));

      $this->twig_env = new \Twig_Environment($this->twig_loader, $options);
    }

    /**
     * Render templates.
     * @param $template
     * @param array $context
     *
     * @return string
     */
    public function render($template, array $context = []){
      return $this->twig_env->render($template, $context);
    }

  }