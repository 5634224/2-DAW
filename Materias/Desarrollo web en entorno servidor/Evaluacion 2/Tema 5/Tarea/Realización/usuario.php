<?php
    require_once 'videojuego.php'; // Ya importa tanto la clase videojuego como el fichero articulo.php que contiene la clase padre Articulo
    require_once 'consola.php';
    class Usuario {
        /**
         * Nombre del usuario
         * @var string
         */
        private $nombre;
        
        /**
         * Cantidad de crédito/dinero que posee el usuario para gastar con su tarjeta.
         * @var int
         */
        private $credito;
        
        /**
         * Array de videojuegos y consolas que tiene el usuario en propiedad
         * @var array
         */
        private $articulos;
        
        /**
         * Array con el nombre de los videojuegos alquilados por el usuario
         * @var array
         */
        private $prestamos;
        
        /**
         * Constructor del objeto Usuario.
         * @param string $nombre Especifica el nombre del usuario
         */
        public function __construct(string $nombre) {
            $this->nombre = $nombre;
            $this->credito = 0;
            $this->articulos = Array();
            $this->prestamos = Array();
        }
        
        public function getNombre(): string {
            return $this->nombre;
        }

        public function getCredito(): int {
            return $this->credito;
        }

        public function getArticulos(): array {
            return $this->articulos;
        }

        public function getPrestamos(): array {
            return $this->prestamos;
        }

        public function setNombre(string $nombre): void {
            $this->nombre = $nombre;
        }

//        public function setArticulos(array $articulos): void {
//            $this->articulos = $articulos;
//        }

//        public function setPrestamos(array $prestamos): void {
//            $this->prestamos = $prestamos;
//        }

        public function anadirTarjeta(int $credito): void {
            $this->credito += $credito;
        }
        
        /**
         * Alquila un videojuego a un usuario.
         * @param string $nombreVideojuego
         * @param Usuario $usuarioArrendador
         */
        public function alquilaVideojuego(string $nombreVideojuego, Usuario $usuarioArrendador) {
            /*-- Verifica que el articulo a alquilar existe dentro de la lista de articulos del usuario vendedor --*/
            if (!$usuarioArrendador->articulos[$nombreVideojuego]) {
                return 1;
            }
            
            /*-- Variables --*/
            $articulo = $usuarioArrendador->articulos[$nombreVideojuego][0];
            $precioAlquiler;
            
            /*-- Verifica que el articulo a alquilar sea un videojuego --*/
            if (!$articulo instanceof Videojuego) {
                return 1;
//            } else {
//                $precioAlquiler = $articulo->getPrecioPrestamo();
            }
            
            /*-- Verifica que el usuario arrendatario tiene saldo suficiente --*/
//            if ($this->credito < $precioAlquiler) {
            if ($this->credito < $articulo->getPrecioPrestamo()) {
                return 2;
            }
            
            /*-- Realiza la transacción --*/
            $usuarioArrendador->anadirTarjeta($articulo->getPrecioPrestamo());
            $this->credito -= $articulo->getPrecioPrestamo();
            
            /*-- Añade el juego al historico de alquileres del arrendatario --*/
            $this->prestamos[] = $nombreVideojuego;
            return 0;
        }
        
        
        /**
         * Funcion para añadir articulos al array interno de articulos.
         * El proposito de esta función es, principalmente, que si ya existe un
         * mismo artículo en el array de artículos, almacene bajo una clave común,
         * un subarray que almacene los artículos repetidos.
         * La he dejado publica para poder meter articulos la primera vez que
         * se ejecute el programa
         * @param Articulo $articulo
         */
        public function addArticulo(Articulo $articulo) {
            $nombre = $articulo->getNombre();
            $this->articulos[$nombre][] = $articulo;
//            $total = count($this->articulos);
//            return $total;
            return true;
            /*-- Verifica que exista dentro del array de articulos --*/
//            if (array_key_exists($nombre, $articulos)) {
//                $articulos[$nombre][] = $articulo;
//            } else {
//                
//            }
        }
        
        private function removeArticulo(String $nombreArticulo) {
            /*-- Verifica que exista ese articulo dentro del array de articulos --*/
            if (!array_key_exists($nombreArticulo, $this->articulos)) {
                return false;
            }
            
            /*-- Elimina la primera aparicion del articulo dentro del array --*/
            unset($this->articulos[$nombreArticulo][0]);
            
            /*-- Reagrupa los elementos el array interno del articulo en cuestion --*/
            $this->articulos[$nombreArticulo] = array_values($this->articulos[$nombreArticulo]);
            
            /*-- Verifica si el array de ese articulo ahora es vacio --*/
            if (count($this->articulos[$nombreArticulo]) == 0) {
                unset($this->articulos[$nombreArticulo]);
//                $this->articulos = array_values($this->articulos); // No hace falta reordenar los índices porque es un array asociativo
            }
            
            /*-- Devuelve true si las operaciones se han realizado con exito --*/
            return true;
        }
        
        /**
         * Compra un artículo a un usuario.
         * @param string $nombreArticulo
         * @param Usuario $usuarioVendedor
         */
        public function compraArticulo(string $nombreArticulo, Usuario $usuarioVendedor) {
            /*-- Verifica que el articulo a comprar existe dentro de la lista de articulos del usuario vendedor --*/
            if (!$usuarioVendedor->articulos[$nombreArticulo]) {
                return 1;
            }
            $articulo = $usuarioVendedor->articulos[$nombreArticulo][0];
            
            /*-- Verifica que el usuario comprador tiene saldo suficiente --*/
            if ($this->credito < $articulo->getPrecioVenta()) {
                return 2;
            }
            
            /*-- Realiza la transacción: Transifere el articulo de la lista de
             * articulos del vendedor a la del usuario que lo esta comprando --*/
            $usuarioVendedor->removeArticulo($nombreArticulo);
            $usuarioVendedor->anadirTarjeta($articulo->getPrecioVenta());
            $this->credito -= $articulo->getPrecioVenta();
            $this->articulos[$nombreArticulo][] = $articulo;
            
            /*-- Devuelve cero porque la operación se ha completado con éxito --*/
            return 0;
        }
        
    }

?>