<?php
  /**
   * Created by PhpStorm.
   * User: isaac
   * Date: 25/01/17
   * Time: 10:39 PM
   */

  namespace Crayon\Comprobante;

  /**
   * Interface IUbicacionFiscal
   * Tipo definido para expresar domicilios o direcciones.
   *
   * @package Crayon\Comprobante
   */
  interface IUbicacionFiscal {

    /**
     * Ubicacion Fiscal constructor.
     *
     * @param \SimpleXMLElement $ubicacion_fiscal
     */
    public function __construct(\SimpleXMLElement $ubicacion_fiscal);

    /**
     * Este atributo requerido sirve para precisar la avenida, calle, camino o
     * carretera donde se da la ubicación.
     *
     * @return string
     */
    public function calle();

    /**
     * Este atributo opcional sirve para expresar el número particular en
     * donde se da la ubicación sobre una calle dada.
     *
     * @return string|false
     */
    public function noExterior();

    /**
     * Este atributo opcional sirve para expresar información adicional para
     * especificar la ubicación cuando calle y número exterior (noExterior)
     * no resulten suficientes para determinar la ubicación de forma precisa.
     *
     * @return string|false
     */
    public function noInterior();

    /**
     * Este atributo opcional sirve para precisar la colonia en donde se da la
     * ubicación cuando se desea ser más específico en casos de ubicaciones
     * urbanas.
     *
     * @return string|false
     */
    public function colonia();

    /**
     * Atributo opcional que sirve para precisar la ciudad o población donde se
     * da la ubicación.
     *
     * @return string|false
     */
    public function localidad();

    /**
     * Atributo opcional para expresar una referencia de ubicación adicional.
     *
     * @return string|false
     */
    public function referencia();

    /**
     * Atributo requerido que sirve para precisar el municipio o delegación
     * en el caso del Distrito Federal) en donde se da la ubicación.
     *
     * @return string
     */
    public function municipio();

    /**
     * Atributo requerido que sirve para precisar el estado o entidad
     * federativa donde se da la ubicación.
     *
     * @return string
     */
    public function estado();

    /**
     * Atributo requerido que sirve para precisar el país donde se da la
     * ubicación.
     *
     * @return string
     */
    public function pais();

    /**
     * Atributo requerido que sirve para asentar el código postal en donde se
     * da la ubicación.
     *
     * @return string
     */
    public function codigoPostal();

  }