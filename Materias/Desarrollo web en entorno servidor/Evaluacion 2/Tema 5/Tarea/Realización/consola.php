<?php
    require_once 'articulo.php';
    class Consola extends Articulo {
        /**
         * Características específicas de la consola.
         * @var string
         */
        private $caracteristicas;
        
        public function __construct($nombre, $sistema, $precioVenta, $caracteristicas) {
            parent::__construct($nombre, $sistema, $precioVenta);
            $this->caracteristicas = $caracteristicas;
        }
        
        public function getCaracteristicas(): string {
            return $this->caracteristicas;
        }

        public function setCaracteristicas($caracteristicas): void {
            $this->caracteristicas = $caracteristicas;
        }



    }
?>