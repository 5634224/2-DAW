<?php
    require_once 'articulo.php';
    class Videojuego extends Articulo {
        /**
         * Género del videojuego.
         * @var string
         */
        private $genero;
        
        /**
         * Precio de préstamo del videojuego.
         * @var int
         */
        private $precioPrestamo;
        
        public function __construct($nombre, $sistema, $precioVenta, $genero, $precioPrestamo) {
            parent::__construct($nombre, $sistema, $precioVenta);
            $this->genero = $genero;
            $this->precioPrestamo = $precioPrestamo;
        }
        
        public function getGenero(): string {
            return $this->genero;
        }

        public function getPrecioPrestamo(): int {
            return $this->precioPrestamo;
        }

        public function setGenero($genero): void {
            $this->genero = $genero;
        }

        public function setPrecioPrestamo($precioPrestamo): void {
            $this->precioPrestamo = $precioPrestamo;
        }



    }
?>