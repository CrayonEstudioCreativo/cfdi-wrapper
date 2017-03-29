<?php
  /**
   * Created by PhpStorm.
   * User: IROXIT
   * Date: 27/01/2017
   * Time: 01:58 PM
   */

  namespace Crayon\Comprobante;

  /**
   * Class RegimenFiscalGeneric
   * Nodo requerido para incorporar los regímenes en los que tributa el
   * contribuyente emisor. Puede contener más de un régimen.
   *
   * @package Crayon\Comprobante
   */
  class RegimenFiscalGeneric extends NodeDefinitionGeneric implements IRegimenFiscal {

    /**
     * IRegimenFiscal constructor.
     *
     * @param \SimpleXMLElement $regimenFiscal
     */
    public function __construct(\SimpleXMLElement $regimenFiscal) {
      $this->setSelf($regimenFiscal);
    }

    /**
     * Atributo requerido para incorporar el nombre del régimen en el que
     * tributa el contribuyente emisor.
     *
     * @return string
     */
    public function Regimen() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Alias de Regimen()
     *
     * @return string
     */
    public function __toString() {
      return $this->Regimen();
    }
  }