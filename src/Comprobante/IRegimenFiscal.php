<?php
  /**
   * Created by PhpStorm.
   * User: IROXIT
   * Date: 27/01/2017
   * Time: 01:58 PM
   */

  namespace Crayon\Comprobante;

  /**
   * Interface IRegimenFiscal
   * Nodo requerido para incorporar los regímenes en los que tributa el
   * contribuyente emisor. Puede contener más de un régimen.
   *
   * @package Crayon\Comprobante
   */
  interface IRegimenFiscal {

    /**
     * IRegimenFiscal constructor.
     *
     * @param \SimpleXMLElement $regimenFiscal
     */
    public function __construct(\SimpleXMLElement $regimenFiscal);

    /**
     * Atributo requerido para incorporar el nombre del régimen en el que
     * tributa el contribuyente emisor.
     *
     * @return string
     */
    public function Regimen();

    /**
     * Alias de Regimen()
     *
     * @return string
     */
    public function __toString();

  }