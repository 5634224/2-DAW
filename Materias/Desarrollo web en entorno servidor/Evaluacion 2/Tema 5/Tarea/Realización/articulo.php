<?php
    abstract class Articulo {
        /**
         * Atributo que permite saber el tipo de articulo sin usar instanceof
         * (en formato string)
         * @var string
         */
        private $tipoArticulo;
        
        /**
         * Nombre del artículo.
         * @var string
         */
        private $nombre;
        
        /**
         * Sistema.
         * @var string
         */
        private $sistema;
        
        /**
         * Precio de venta del artículo.
         * @var int
         */
        private $precioVenta;
        
        public function __construct($nombre, $sistema, $precioVenta) {
            $this->tipoArticulo = get_class($this);
            $this->nombre = $nombre;
            $this->sistema = $sistema;
            $this->precioVenta = $precioVenta;
        }
        
        public function getTipoArticulo(): string {
            return $this->tipoArticulo;
        }
 
        public function getNombre(): string {
            return $this->nombre;
        }

        public function getSistema(): string {
            return $this->sistema;
        }

        public function getPrecioVenta(): int {
            return $this->precioVenta;
        }

        public function setNombre($nombre): void {
            $this->nombre = $nombre;
        }

        public function setSistema($sistema): void {
            $this->sistema = $sistema;
        }

        public function setPrecioVenta($precioVenta): void {
            $this->precioVenta = $precioVenta;
        }


    }

?>