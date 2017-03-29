<?php
  /**
   * Created by PhpStorm.
   * User: isaac
   * Date: 25/01/17
   * Time: 10:33 PM
   */

  namespace Crayon\Comprobante;


  interface IRfc {

    /**
     * IRfc constructor.
     *
     * @param $rfc
     */
    public function __construct($rfc);

    /**
     * Convierte tipo a string.
     * @return string
     */
    public function __toString();

    /**
     * Valida patron de RFC.
     * [A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?
     *
     * @return bool
     */
    public function validarPatron();

    /**
     * Valida RFC en el SAT mediante un Web Service.
     *
     * @return bool
     */
    public function validarSAT();

  }