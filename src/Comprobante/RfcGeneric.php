<?php
  /**
   * Created by PhpStorm.
   * User: IROXIT
   * Date: 27/01/2017
   * Time: 01:34 PM
   */

  namespace Crayon\Comprobante;

  /**
   * Class RfcGeneric
   * Atributo requerido para la Clave del Registro Federal de Contribuyentes
   * correspondiente al contribuyente emisor del comprobante sin guiones o
   * espacios.
   *
   * @package Crayon\Comprobante
   */
  class RfcGeneric implements IRfc {

    /**
     * RFC
     * @var string $rfc
     */
    private $rfc = NULL;

    /**
     * IRfc constructor.
     *
     * @param $rfc
     */
    public function __construct($rfc) {
      $this->rfc = $rfc;

      if (!$this->validarPatron()) {
        throw new \InvalidArgumentException('RFC Inválido');
      }
    }

    /**
     * Convierte tipo a string.
     * @return string
     */
    public function __toString() {
      return $this->rfc;
    }

    /**
     * Valida patron de RFC
     * [A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?
     *
     * @return bool
     */
    public function validarPatron() {
      $pattern = "/^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$/";

      return preg_match($pattern, $this->rfc);
    }

    /**
     * Valida RFC en el SAT mediante un Web Service
     *
     * @return bool
     */
    public function validarSAT() {
      // TODO: Falta añadir documentación sobre esta función.
      return FALSE;
    }
  }