<?php
  /**
   * Created by PhpStorm.
   * User: IROXIT
   * Date: 27/01/2017
   * Time: 01:56 PM
   */

  namespace Crayon\Comprobante;

  /**
   * Class UbicacionGeneric
   * Tipo definido para expresar domicilios o direcciones.
   *
   * @package Crayon\Comprobante
   */
  class UbicacionGeneric extends NodeDefinitionGeneric implements IUbicacionFiscal  {

    /**
     * Ubicacion Fiscal constructor.
     *
     * @param \SimpleXMLElement $ubicacion_fiscal
     */
    public function __construct(\SimpleXMLElement $ubicacion_fiscal) {
      $this->setSelf($ubicacion_fiscal);
    }

    /**
     * Este atributo requerido sirve para precisar la avenida, calle, camino o
     * carretera donde se da la ubicación.
     *
     * @return string
     */
    public function calle() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Este atributo opcional sirve para expresar el número particular en
     * donde se da la ubicación sobre una calle dada.
     *
     * @return string|false
     */
    public function noExterior() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Este atributo opcional sirve para expresar información adicional para
     * especificar la ubicación cuando calle y número exterior (noExterior)
     * no resulten suficientes para determinar la ubicación de forma precisa.
     *
     * @return string|false
     */
    public function noInterior() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Este atributo opcional sirve para precisar la colonia en donde se da la
     * ubicación cuando se desea ser más específico en casos de ubicaciones
     * urbanas.
     *
     * @return string|false
     */
    public function colonia() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional que sirve para precisar la ciudad o población donde se
     * da la ubicación.
     *
     * @return string|false
     */
    public function localidad() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para expresar una referencia de ubicación adicional.
     *
     * @return string|false
     */
    public function referencia() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido que sirve para precisar el municipio o delegación
     * en el caso del Distrito Federal) en donde se da la ubicación.
     *
     * @return string
     */
    public function municipio() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido que sirve para precisar el estado o entidad
     * federativa donde se da la ubicación.
     *
     * @return string
     */
    public function estado() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido que sirve para precisar el país donde se da la
     * ubicación.
     *
     * @return string
     */
    public function pais() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido que sirve para asentar el código postal en donde se
     * da la ubicación.
     *
     * @return string
     */
    public function codigoPostal() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

  }