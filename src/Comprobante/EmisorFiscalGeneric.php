<?php
  /**
   * Created by PhpStorm.
   * User: IROXIT
   * Date: 27/01/2017
   * Time: 01:07 PM
   */

  namespace Crayon\Comprobante;

  /**
   * Class EmisorFiscalGeneric
   * Nodo requerido para expresar la información del contribuyente emisor del comprobante.
   *
   * @package Crayon\Comprobante
   */
  class EmisorFiscalGeneric extends NodeDefinitionGeneric implements IEmisor {

    /** @var \Crayon\Comprobante\IComprobanteFiscal $parent Comprobante Fiscal padre. */
    private $parent = NULL;

    /** @var null $rfc RFC del comprobante */
    private $rfc = NULL;

    /**
     * EmisorFiscalGeneric constructor.
     *
     * @param \SimpleXMLElement $emisor_node
     * @param \Crayon\Comprobante\IComprobanteFiscal $comprobanteFiscal
     */
    public function __construct(\SimpleXMLElement $emisor_node, IComprobanteFiscal $comprobanteFiscal) {
      $this->setSelf($emisor_node);

      $this->parent = $comprobanteFiscal;

      $this->setRfc();
    }

    /**
     * Retorna Comprobante Fiscal Padre
     * @return \Crayon\Comprobante\IComprobanteFiscal
     */
    public function getParentComprobante() {
      return $this->parent;
    }

    /**
     * Setea RFC de emisor.
     */
    private function setRfc() {
      $rfc       = $this->getAtributo('rfc', '');
      $this->rfc = new RfcGeneric($rfc);
    }

    /**
     * Atributo requerido para la Clave del Registro Federal de Contribuyentes
     * correspondiente al contribuyente emisor del comprobante sin guiones o
     * espacios.
     * @return IRfc
     */
    public function rfc() {
      return $this->rfc();
    }

    /**
     * Atributo opcional para el nombre, denominación o razón social del
     * contribuyente emisor del comprobante.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string
     */
    public function nombre() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Nodo opcional para precisar la información de ubicación del domicilio
     * fiscal del contribuyente emisor.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return IUbicacionFiscal|false
     */
    public function DomicilioFiscal() {
      $ubicacionFiscal = $this->getChild(__FUNCTION__, FALSE);

      if (!$ubicacionFiscal) {
        throw new \InvalidArgumentException("No ha sido posible obtener el Domicilio Fiscal.");
      }

      return new DomicilioFiscalGeneric($ubicacionFiscal, $this);
    }

    /**
     * Nodo opcional para precisar la información de ubicación del domicilio en
     * donde es emitido el comprobante fiscal en caso de que sea distinto del
     * domicilio fiscal del contribuyente emisor.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return IUbicacionFiscal|false
     */
    public function ExpedidoEn() {
      $expedidoEn = $this->getChild(__FUNCTION__, FALSE);

      if (!$expedidoEn) {
        throw new \InvalidArgumentException("No ha sido posible obtener la Ubicación de Expedición.");
      }

      return new UbicacionGeneric($expedidoEn, $this);
    }

    /**
     * Nodo requerido para incorporar los regímenes en los que tributa el
     * contribuyente emisor. Puede contener más de un régimen.
     *
     * @return string
     */
    public function RegimenFiscal() {
      $regimenFiscal = $this->getChild(__FUNCTION__, FALSE);

      if (!$regimenFiscal) {
        throw new \InvalidArgumentException("No ha sido posible obtener el Regimen Fiscal.");
      }

      return new RegimenFiscalGeneric($regimenFiscal, $this);
    }
  }