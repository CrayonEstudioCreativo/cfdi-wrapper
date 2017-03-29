<?php
  /**
   * Created by PhpStorm.
   * User: isaac
   * Date: 24/01/17
   * Time: 10:21 PM
   */

  namespace Crayon\Comprobante;

  use Money\Money;

  /**
   * Interface IComprobanteFiscal
   * Estandar base del XSD
   *
   *
   * @package Crayon\Utils
   * @see Anexo20RMF2014.doc
   */
  interface IComprobanteFiscal {

    /**
     * Atributo requerido con valor prefijado a 3.2 que indica la versión del estándar bajo el que se encuentra
     * expresado el comprobante.
     *
     * @return string
     */
    public function version();

    /**
     * Atributo opcional para precisar la serie para control interno del contribuyente. Este atributo acepta una cadena
     * de caracteres alfabéticos de 1 a 25 caracteres sin incluir caracteres acentuados.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function serie();

    /**
     * Atributo opcional para control interno del contribuyente que acepta un valor numérico entero
     * superior a 0 que expresa el folio del comprobante.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function folio();

    /**
     * Atributo requerido para la expresión de la fecha y hora de expedición del comprobante fiscal. Se expresa en la
     * forma aaaa-mm-ddThh:mm:ss, de acuerdo con la especificación ISO 8601.
     *
     * @return string
     */
    public function fecha();

    /**
     * Atributo requerido para la expresión de la fecha y hora de expedición del comprobante fiscal.
     * Se devuelve como un objeto clase \DateTime.
     *
     * @return \DateTime
     */
    public function fechaAsDatetime();

    /**
     * Atributo requerido para contener el sello digital del comprobante fiscal, al que hacen referencia las reglas de
     * resolución miscelánea aplicable. El sello deberá ser expresado cómo una cadena de texto en formato Base 64.
     *
     * @return string
     */
    public function sello();

    /**
     * Atributo requerido para precisar la forma de pago que aplica para este comprobnante fiscal digital a través de
     * Internet. Se utiliza para expresar Pago en una sola exhibición o número de parcialidad pagada contra el total
     * de parcialidades, Parcialidad 1 de X.
     *
     * @return string
     */
    public function formaDePago();

    /**
     * Atributo requerido para expresar el número de serie del certificado de sello digital que ampara al comprobante,
     * de acuerdo al acuse correspondiente a 20 posiciones otorgado por el sistema del SAT.
     *
     * @return string
     */
    public function noCertificado();

    /**
     * Atributo requerido que sirve para expresar el certificado de sello digital que ampara al comprobante como texto,
     * en formato base 64.
     *
     * @return string
     */
    public function certificado();

    /**
     * Atributo opcional para expresar las condiciones comerciales aplicables para el pago del comprobante
     * fiscal digital a través de Internet.
     * Retornará un false cuando el atributo no esté definido.
     * @return string|false
     */
    public function condicionesDePago();

    /**
     * Atributo requerido para representar la suma de los importes antes de descuentos e impuestos.
     *
     * @return Money
     */
    public function subTotal();

    /**
     * Atributo opcional para representar el importe total de los descuentos aplicables antes de impuestos.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return Money|false
     */
    public function descuento();

    /**
     * Atributo opcional para expresar el motivo del descuento aplicable.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function motivoDescuento();

    /**
     * Atributo opcional para representar el tipo de cambio conforme a la moneda usada.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function tipoCambio();

    /**
     * Atributo opcional para expresar la moneda utilizada para expresar los montos.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function moneda();

    /**
     * Atributo requerido para representar la suma del subtotal, menos los descuentos aplicables, más los impuestos
     * trasladados, menos los impuestos retenidos.
     *
     * @return Money
     */
    public function total();

    /**
     * Atributo requerido para expresar el efecto del comprobante fiscal para el contribuyente emisor.
     *
     * @return string
     */
    public function tipoDeComprobante();

    /**
     * Atributo requerido de texto libre para expresar el método de pago de los bienes o servicios amparados por el
     * comprobante. Se entiende como método de pago leyendas tales como: cheque, tarjeta de crédito o debito,
     * depósito en cuenta, etc.
     *
     * @return string
     */
    public function metodoDePago();

    /**
     * Atributo requerido para incorporar el lugar de expedición del comprobante.
     *
     * @return string
     */
    public function LugarExpedicion();

    /**
     * Atributo opcional para incorporar al menos los cuatro últimos digitos del número de cuenta con la que se
     * realizó el pago.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function NumCtaPago();

    /**
     * Atributo opcional para señalar el número de folio fiscal del comprobante que se hubiese expedido por el valor
     * total del comprobante, tratándose del pago en parcialidades.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function FolioFiscalOrig();

    /**
     * Atributo opcional para señalar la serie del folio del comprobante que se hubiese expedido por el valor total del
     * comprobante, tratándose del pago en parcialidades.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function SerieFolioFiscalOrig();

    /**
     * Atributo opcional para señalar la fecha de expedición del comprobante que se hubiese emitido por el valor total
     * del comprobante, tratándose del pago en parcialidades. Se expresa en la forma  aaaa-mm-ddThh:mm:ss, de acuerdo
     * con la especificación ISO 8601.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return string|false
     */
    public function FechaFolioFiscalOrig();

    /**
     * Retorna al atributo FechaFolioFiscalOrig wrappeado en un objeto clase \DateTime.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return \DateTime|false
     */
    public function FechaFolioFiscalOrigAsDatetime();

    /**
     * Atributo opcional para señalar el total del comprobante que se hubiese expedido por el valor total de la
     * operación, tratándose del pago en parcialidades.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return Money|false
     */
    public function MontoFolioFiscalOrig();

    /**
     * Nodo requerido para expresar la información del contribuyente emisor
     * del comprobante.
     *
     * @return IEmisor
     */
    public function Emisor();

    /**
     * Nodo requerido para precisar la información del contribuyente receptor del comprobante.
     * @return IReceptor
     */
    public function Receptor();

    /**
     * Nodo requerido para enlistar los conceptos cubiertos por el comprobante.
     * @return IConceptos
     */
    public function Conceptos();

    /**
     * Nodo requerido para capturar los impuestos aplicables.
     * @return IImpuestos
     */
    public function Impuestos();

    /**
     * Nodo opcional donde se incluirá el complemento Timbre Fiscal Digital de
     * manera obligatoria y los nodos complementarios determinados por el SAT,
     * de acuerdo a las disposiciones particulares a un sector o actividad
     * específica.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return IComplemento|false
     */
    public function Complemento();

    /**
     * Nodo opcional para recibir las extensiones al presente formato que sean
     * de utilidad al contribuyente. Para las reglas de uso del mismo,
     * referirse al formato de origen.
     * Retornará un false cuando el atributo no esté definido.
     *
     * @return IAddenda|false
     */
    public function Addenda();
  }