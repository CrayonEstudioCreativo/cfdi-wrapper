<?php
  /**
   * Created by PhpStorm.
   * User: isaac
   * Date: 25/01/17
   * Time: 10:13 PM
   */

  namespace Crayon\Comprobante;

  /**
   * Class BasicXMLNodeTrait
   * Clase generica con métodos comunes entre nodos de Comprobante.
   *
   * @package Crayon\Comprobante
   */
  abstract class NodeDefinitionGeneric {

    /**
     * @var \SimpleXMLElement $self Nodo actual.
     */
    private $self = NULL;

    /**
     * Getter mágico para atributos de Comprobante.
     *
     * @param $name
     *
     * @return bool
     */
    public function __get($name) {
      return $this->getAtributo($name, FALSE);
    }

    /**
     * Setea el nodo en una variable interna para operaciones entre nodos.
     *
     * @param \SimpleXMLElement $node
     */
    public function setSelf(\SimpleXMLElement $node) {
      $this->self = $node;
    }

    /**
     * Getter para atributos de Comprobante.
     *
     * @param $name
     * @param $default
     *
     * @return bool
     */
    protected function getAtributo($name, $default = FALSE) {
      /** @var \SimpleXMLElement $attr_wrapper */
      $attr_wrapper = $this->self->attributes();

      return isset($attr_wrapper->{$name}) ? (string) $attr_wrapper->{$name} : $default;
    }


    /**
     * Getter para nodos child de comprobante.
     *
     * @param $name
     * @param bool $default
     *
     * @return \SimpleXMLElement|false
     */
    protected function getChild($name, $default = FALSE) {
      /** @var array $ns */
      $ns = $this->self->getNamespaces(TRUE);

      /** @var \SimpleXMLElement $children */
      $children = $this->self->children($ns['cfdi']);

      /** @noinspection PhpIncompatibleReturnTypeInspection */
      return isset($children->{$name}) ? $children->{$name} : $default;
    }

    /**
     * Retorna elemento padre al nodo actual
     * @return \SimpleXMLElement[]
     */
    protected function getParent() {
      return $this->self->xpath("..");
    }
  }
