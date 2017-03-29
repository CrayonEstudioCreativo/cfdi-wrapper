<?php
  /**
   * Created by PhpStorm.
   * User: IROXIT
   * Date: 24/01/2017
   * Time: 03:35 PM
   */

  namespace Crayon\Comprobante;

  use Money\Currency;
  use Money\Money;

  /**
   * Class ComprobanteFiscalGeneric
   * Wrapper para carga de archivos XML
   * @package Crayon\Utils
   */
  class ComprobanteFiscalGeneric extends NodeDefinitionGeneric implements IComprobanteFiscal {

    /**
     * ComprobanteFiscalGeneric constructor.
     *
     * @param $path
     */
    public function __construct($path) {
      if (!is_file($path)) {
        throw new \InvalidArgumentException('Ruta de archivo inválida.');
      }

      if (!is_readable($path)) {
        throw new \InvalidArgumentException('Archivo existe pero no fue posible leerlo.');
      }

      if (!($xml = simplexml_load_file($path))) {
        throw new \InvalidArgumentException('Fue imposible convertir el archivo a objeto XML');
      }

      $this->setSelf($xml);
    }

    /**
     * Atributo requerido con valor prefijado a 3.2 que indica la versión del estándar bajo el que se encuentra
     * expresado el comprobante.
     *
     * @return string
     */
    public function version() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para precisar la serie para control interno del contribuyente. Este atributo acepta una cadena
     * de caracteres alfabéticos de 1 a 25 caracteres sin incluir caracteres acentuados.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function serie() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para control interno del contribuyente que acepta un valor numérico entero
     * superior a 0 que expresa el folio del comprobante.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function folio() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido para la expresión de la fecha y hora de expedición del comprobante fiscal. Se expresa en la
     * forma aaaa-mm-ddThh:mm:ss, de acuerdo con la especificación ISO 8601.
     *
     * @return string
     */
    public function fecha() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido para la expresión de la fecha y hora de expedición del comprobante fiscal.
     * Se devuelve como un objeto clase \DateTime.
     *
     * @return \DateTime|false
     */
    public function fechaAsDatetime() {
      $datetime = \DateTime::createFromFormat('y-m-d\TH:i:s', $this->fecha());

      if ($datetime) {
        return $datetime;
      }

      return FALSE;
    }

    /**
     * Atributo requerido para contener el sello digital del comprobante fiscal, al que hacen referencia las reglas de
     * resolución miscelánea aplicable. El sello deberá ser expresado cómo una cadena de texto en formato Base 64.
     *
     * @return string
     */
    public function sello() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido para precisar la forma de pago que aplica para este comprobnante fiscal digital a través de
     * Internet. Se utiliza para expresar Pago en una sola exhibición o número de parcialidad pagada contra el total
     * de parcialidades, Parcialidad 1 de X.
     *
     * @return string
     */
    public function formaDePago() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido para expresar el número de serie del certificado de sello digital que ampara al comprobante,
     * de acuerdo al acuse correspondiente a 20 posiciones otorgado por el sistema del SAT.
     *
     * @return string
     */
    public function noCertificado() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido que sirve para expresar el certificado de sello digital que ampara al comprobante como texto,
     * en formato base 64.
     *
     * @return string
     */
    public function certificado() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para expresar las condiciones comerciales aplicables para el pago del comprobante
     * fiscal digital a través de Internet.
     * Retornará un false cuando el atributo no esté definido.
     * @return string|false
     */
    public function condicionesDePago() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido para representar la suma de los importes antes de descuentos e impuestos.
     *
     * @return Money
     */
    public function subTotal() {
      $amount = $this->getAtributo(__FUNCTION__, FALSE);
      $amount = str_replace('$', '', $amount);

      return new Money($amount, new Currency('MXN'));
    }

    /**
     * Atributo opcional para representar el importe total de los descuentos aplicables antes de impuestos.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return Money|false
     */
    public function descuento() {
      $amount = $this->getAtributo(__FUNCTION__, FALSE);
      $amount = str_replace('$', '', $amount);

      return new Money($amount, new Currency('MXN'));
    }

    /**
     * Atributo opcional para expresar el motivo del descuento aplicable.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function motivoDescuento() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para representar el tipo de cambio conforme a la moneda usada.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function tipoCambio() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para expresar la moneda utilizada para expresar los montos.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function moneda() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido para representar la suma del subtotal, menos los descuentos aplicables, más los impuestos
     * trasladados, menos los impuestos retenidos.
     *
     * @return Money
     */
    public function total() {
      $amount = $this->getAtributo(__FUNCTION__, FALSE);
      $amount = str_replace('$', '', $amount);

      return new Money($amount, new Currency('MXN'));
    }

    /**
     * Atributo requerido para expresar el efecto del comprobante fiscal para el contribuyente emisor.
     *
     * @return string
     */
    public function tipoDeComprobante() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido de texto libre para expresar el método de pago de los bienes o servicios amparados por el
     * comprobante. Se entiende como método de pago leyendas tales como: cheque, tarjeta de crédito o debito,
     * depósito en cuenta, etc.
     *
     * @return string
     */
    public function metodoDePago() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo requerido para incorporar el lugar de expedición del comprobante.
     *
     * @return string
     */
    public function LugarExpedicion() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para incorporar al menos los cuatro últimos digitos del número de cuenta con la que se
     * realizó el pago.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function NumCtaPago() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para señalar el número de folio fiscal del comprobante que se hubiese expedido por el valor
     * total del comprobante, tratándose del pago en parcialidades.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function FolioFiscalOrig() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para señalar la serie del folio del comprobante que se hubiese expedido por el valor total del
     * comprobante, tratándose del pago en parcialidades.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function SerieFolioFiscalOrig() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Atributo opcional para señalar la fecha de expedición del comprobante que se hubiese emitido por el valor total
     * del comprobante, tratándose del pago en parcialidades. Se expresa en la forma  aaaa-mm-ddThh:mm:ss, de acuerdo
     * con la especificación ISO 8601.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function FechaFolioFiscalOrig() {
      return $this->getAtributo(__FUNCTION__, FALSE);
    }

    /**
     * Retorna al atributo FechaFolioFiscalOrig wrappeado en un objeto clase \DateTime.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return \DateTime|false
     */
    public function FechaFolioFiscalOrigAsDatetime() {
      $datetime = \DateTime::createFromFormat('y-m-d\TH:i:s', $this->FechaFolioFiscalOrig());

      if ($datetime) {
        return $datetime;
      }

      return FALSE;
    }

    /**
     * Atributo opcional para señalar el total del comprobante que se hubiese expedido por el valor total de la
     * operación, tratándose del pago en parcialidades.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return Money|false
     */
    public function MontoFolioFiscalOrig() {
      $amount = $this->getAtributo(__FUNCTION__, FALSE);
      $amount = str_replace('$', '', $amount);

      return new Money($amount, new Currency('MXN'));
    }

    /**
     * Retorna Emisor Fiscal del Comprobante.
     *
     * @return IEmisor
     */
    public function Emisor() {
      $emisor = $this->getChild(__FUNCTION__, FALSE);

      if (!$emisor) {
        throw new \InvalidArgumentException("No ha sido posible obtener el Emisor");
      }

      return new EmisorFiscalGeneric($emisor, $this);
    }

    /**
     * @return IReceptor
     */
    public function Receptor() {
      // TODO: Implement Receptor() method.
    }

    /**
     * @return IConceptos
     */
    public function Conceptos() {
      // TODO: Implement Conceptos() method.
    }

    /**
     * @return IImpuestos
     */
    public function Impuestos() {
      // TODO: Implement Impuestos() method.
    }

    /**
     * @return IComplemento|false
     */
    public function Complemento() {
      // TODO: Implement Complemento() method.
    }

    /**
     * @return IAddenda|false
     */
    public function Addenda() {
      // TODO: Implement Addenda() method.
    }
  }