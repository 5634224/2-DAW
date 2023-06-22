<?php

    /*====================================================
                    CONSTANTES
    =====================================================*/
    define("ACTUAL_DATE", "CURRENT_TIMESTAMP"); // Nombre de columna de la tabla DUAL de MySQL que permite trabajar con la fecha actual del sistema

    /*====================================================
                    FUNCIONES
    =====================================================*/
    /**
     * Realiza la conexion con la BB.DD.
     *
     * @param  string $hostname Nombre del host donde se aloja la BB.DD. (¿Puede ser una direccion?)
     * @param  string $username Nombre de usuario para acceder a MySQL.
     * @param  string $password Contraseña para acceder a MySQL.
     * @param  string $database Nombre de la base de datos a la que deseas conectarte.
     * @return object Un objeto de conexión con la BB.DD. 
     */
    function conexionBD(string $hostname, string $username, string $password, string $database) {
        $conexion = new mysqli($hostname, $username, $password, $database);
        return $conexion;
    }
        
    /**
     * Funcion polivalente para hacer cualquier tipo de consulta preparada MySQLi.
     *
     * @param  mysqli $bdConexion Proporciona un objeto de conexión con MySQL. 
     * @param  string $sql Proporciona una consulta con código de MySQL.
     * @param  array $parametros Array (numérico o asociativo) que proporciona parámetros para la consulta. Debe ser un array cuyos valores son los que se sustituyen en las interrogaciones (?) del código SQL.
     * @param  object $todo Proporciona una función a realizar tras la consulta a la BB.DD, que permita trabajar con los datos (en caso de SELECT) por cada fila.
     * @return bool true si se ha realizado la operación correctamente; false si no.
     */
    function bd_prep_consulta_mysqli(mysqli $bdConexion, string $sql, array $parametros = null, object $todo = null) {
        /*-- Crea la consulta preparada --*/
        $query = $bdConexion->stmt_init(); // Inicia un Statement
        $query->prepare($sql);

        /*-- Prepara los parámetros --*/
        if (isset($parametros)) {
            $tipo = ""; // Cadena que se le pasará al método bind_param para detectar los tipos de datos de los parámetros
            foreach ($parametros as &$value) {
                switch (gettype($value)) {
                    case "float":
                        $tipo .= "d"; // Double
                        break;
                    case "integer":
                        $tipo .= "i"; // Integer
                        break;
                    case "string":
                        $tipo .= "s"; // String
                        break;
                    case "object":
                        $tipo .= "b"; // Binary
                        break;
                    case "array":
                        $tipo .= "b"; // Binary
                        break;
                    case "null":
                        $tipo .= "s";
                        $value = "NULL";
                        break;
                }
                $query->bind_param($tipo, $parametros);
            }
        }

        /*-- Ejecuta la consulta --*/
        $resultado = $query->execute();
        
        /*-- Trabajar con los datos (opcional, siempre que la consulta sea de tipo Select) --*/
        if (stripos($sql, "select") !== false && $todo != null) { // Es una consulta SELECT (Read)
            //https://es.stackoverflow.com/questions/209242/consulta-preparada-mysqli
            $datos = $query->get_result();
            while ($row = $datos->fetch_row()) { // Por cada fila (fetch row = array numérico)
                // https://lenguajes.com.mx/funciones-anonimas-de-php/#:~:text=Para%20usar%20una%20funci%C3%B3n%20an%C3%B3nima%2C%20debe%20asignarla%20a,%28%24x%2C%20%24y%29%20%7B%20return%20%24x%20%2A%20%24y%3B%20%7D%3B
                $todo($row); // Llama a la función anónima pasada por parámetro a la función
            }
        }

        /*-- Cierra la consulta --*/
        $query->close();

        /*-- Devuelve el resultado de la operación --*/
        return $resultado;
    }

    /**
     * Función que devuelve los datos de una consulta SELECT en MySQL.
     *
     * @param  mysqli $bdConexion Proporciona un objeto de conexión con MySQL. 
     * @param  string $sql Proporciona una consulta con código de MySQL.
     * @param  array $parametros Proporciona parámetros para la consulta. Debe ser un array cuyos valores son los que se sustituyen en las interrogaciones (?) del código SQL.
     * @return array|bool Devuelve un array con los datos de la consulta MySQL.
     */
    function bdSelect(mysqli $bdConexion, string $sql, array $parametros = null) {
        /*-- Declaración de variables --*/
        $datos = array();

        $todo = function (array $row) use (&$datos) {
            // global $datos;
            $datos[] = $row; // Agrega la fila al array de datos
        };

        /*-- Llama a la función para consultar la BB.DD --*/
        $resultado = bd_prep_consulta_mysqli($bdConexion, $sql, $parametros, $todo);
        
        /*-- Devuelve los datos en forma de array --*/
        if ($resultado) {
            return $datos;
        } else {
            return false;
        }
    }

    /**
     * Función que inserta datos en MySQL.
     *
     * @param  mysqli $bdConexion Proporciona un objeto de conexión con MySQL. 
     * @param  string $nombreTabla Proporciona el nombre de la tabla donde se quiere insertar un registro.
     * @param  array $datos Array asociativo que contiene key = columna, value = valor que se le quiere asignar a esa columna.
     * @return bool Devuelve true si la operacion tiene exito, false si no.
     */
    function bdInsert(mysqli $bdConexion, string $nombreTabla, array $datos) {
        /*-- Prepara el codigo SQL --*/
        $sql = "INSERT INTO " . $nombreTabla . " ";
        $columnas = "(";
        $valores = " VALUES (";
        
        foreach ($datos as $columna => $value) {
            $columnas .= $columna . ", ";
            $valores .= "?, ";
        }

        rtrim($columnas, ", "); // https://www.php.net/manual/es/ref.strings.php
        rtrim($valores, ", "); // https://www.php.net/manual/es/ref.strings.php
        $columnas .= ")";
        $valores .= ")";

        /*-- Define la cadena con el codigo SQL completo --*/
        $sql .= $columnas . " " . $valores;

        /*-- Llama a la función para consultar la BB.DD --*/
        $resultado = bd_prep_consulta_mysqli($bdConexion, $sql, $datos);
        
        /*-- Devuelve el resultado de la operación --*/
        return $resultado;
    }
        
    /**
     * Función que actualiza datos en MySQL.
     *
     * @param  mysqli $bdConexion Proporciona un objeto de conexión con MySQL. 
     * @param  string $nombreTabla Proporciona el nombre de la tabla donde se quiere actualizar los datos de uno/varios registros.
     * @param  array $datos Array asociativo que contiene key = columna, value = valor que se le quiere asignar a esa columna. No permite incremento de valores, puesto que al ser una consulta preparada, no permite inyección de código SQL.
     * @param  array $where Array asociativo que contiene las columnas y valores (key = columna, value = valor) que se utilizarán como criterio para determinar qué registros actualizar.
     * @return bool Devuelve true si la operacion tiene exito, false si no.
     */
    function bdUpdate(mysqli $bdConexion, string $nombreTabla, array $datos, array $where) {
        /*-- Prepara el codigo SQL --*/
        $sql = "UPDATE " . $nombreTabla . " ";

        /*-- Prepara los datos en la consulta --*/
        foreach ($datos as $columna => $value) {
            $sql .= $columna . " = ?, ";
        }
        rtrim($sql, ", "); // Elimina el sobrante , : https://www.php.net/manual/es/ref.strings.php
        
        /*-- Añade el WHERE --*/
        $sql .= " WHERE ";
        foreach ($where as $columna => $value) {
            $sql .= $columna . " = ? AND ";
        }
        rtrim($sql, " AND "); // Elimina el sobrante  AND  https://www.php.net/manual/es/ref.strings.php

        /*-- Une los arrays de $datos y $where, para pasárselos en un único argumento de "parámetros" a la función de consultas --*/
        $unionParametros = array_merge($datos, $where);

        /*-- Llama a la función para consultar la BB.DD --*/
        $resultado = bd_prep_consulta_mysqli($bdConexion, $sql, $unionParametros);

        /*-- Devuelve el resultado de la operación --*/
        return $resultado;
    }
        
    /**
     * Función que permite eliminar filas de una tabla MySQL.
     *
     * @param  mysqli $bdConexion Proporciona un objeto de conexión con MySQL. 
     * @param  string $nombreTabla Proporciona el nombre de la tabla donde se quiere eliminar los datos de uno/varios registros.
     * @param  array $where Array asociativo que contiene las columnas y valores (key = columna, value = valor) que se utilizarán como criterio para determinar qué registros eliminar.
     * @return bool Devuelve true si la operacion tiene exito, false si no.
     */
    function bdDelete(mysqli $bdConexion, string $nombreTabla, array $where = null) {
        /*-- Prepara el código SQL --*/
        $sql = "DELETE FROM " . $nombreTabla . "";

        /*-- Añade el WHERE --*/
        if (isset($where)) {
            $sql .= " WHERE ";
            foreach ($where as $columna => $value) {
                $sql .= $columna . " = ? AND ";
            }
        }

        /*-- Llama a la función para consultar la BB.DD --*/
        $resultado = bd_prep_consulta_mysqli($bdConexion, $sql, $where);

        /*-- Devuelve el resultado de la operación --*/
        return $resultado;
    }

    function fechaToString(DateTime $fecha) {
        return $fecha->format("Y-m-d");
    }

    function stringToFecha(string $fecha) {
        return DateTime::createFromFormat("Y-m-d", $fecha);
    }

    function horaToString(DateTime $hora) {
        return $hora->format("H:i:s");
    }

    function stringToHora(string $hora) {
        return DateTime::createFromFormat("H:i:s", $hora);
    }

    function fechaHoraToString(DateTime $fechaHora) {
        return $fechaHora->format("Y-m-d H:i:s");
    }

    function stringToFechaHora(string $fechaHora) {
        return DateTime::createFromFormat("Y-m-d H:i:s", $fechaHora);
    }

    class MyORM {
        /*===================================================
                        ATRIBUTOS
        ====================================================*/
        /**
         * Atributo que almacena la conexión con la BB.DD
         */
        private mysqli $bdConexion;

        /**
         * Atributo que guarda el nombre de la tabla.
         */
        private string $nombreTabla;

        /**
         * Array asociativo que los datos de una fila guardando key (columna), dato.
         */
        private array $atributos;

        /**
         * Array numérico que contiene en cada posición, un array (por cada columna de la tabla) que, contiene los atributos de esa tabla (field, type, null, key, default y extra (Por ejemplo, auto_increment)).
         */
        private array $tiposDatos;

        /**
         * Atributo que actúa de bandera. Si se crea el objeto con el constructor, este valor será true hasta que se haga el primer save(), en el cual se realizará la inserción de la fila en la BB.DD.
         * Después, pasará a false, haciendo que save() solo haga updates.
         */
        private bool $insert = true;

        /*===================================================
                        MÉTODOS
        ====================================================*/
                
        /**
         * Constructor para un objeto MyORM vinculado a la BB.DD especificada.
         *
         * @param  mixed $bdConexion Especifica la conexión a la base de datos.
         * @param  mixed $nombreTabla Proporciona el nombre de la tabla de la que se quiere crear un nuevo objeto asociado a una fila en la BB.DD.
         */
        public function __construct(mysqli &$bdConexion, string $nombreTabla) {
            /*-- Realiza una consulta a la BB.DD para consultar las columnas de la tabla y crearlas dentro del array de $atributos --*/
            /*-- Función que se ejecutará por cada fila que recoja de la consulta (con datos de cada columna de la tabla) --*/
            $todo = function ($row) {
                /*-- Verifica primero si es clave primaria, para inicializarla como null, a modo de bandera para el método save() --*/
                if ($row[3] == "PRI") {
                    $this->atributos[$row[0]] = null;
                    $this->tiposDatos[$row[0]] = $row;
                } else {
                    /*-- Realiza las comprobaciones de cada tipo de dato en caso de que no sea clave primaria --*/
                    if (stripos($row[1], "varchar") !== false || stripos($row[1], "char") !== false) {
                        $this->atributos[$row[0]] = "";
                        $this->tiposDatos[$row[0]] = $row;
                    } else if (stripos($row[1], "integer") !== false) {
                        $this->atributos[$row[0]] = -1;
                        $this->tiposDatos[$row[0]] = $row;
                    } else if (stripos($row[1], "decimal") !== false || stripos($row[1], "float") !== false || stripos($row[1], "double") !== false) {
                        $this->atributos[$row[0]] = 0.0;
                        $this->tiposDatos[$row[0]] = $row;
                    } else if (stripos($row[1], "boolean") !== false) {
                        $this->atributos[$row[0]] = false;
                        $this->tiposDatos[$row[0]] = $row;
                    } else if (stripos($row[1], "date") !== false) {
                        $fecha = DateTime::createFromFormat("Y-m-d", "1970-01-01");
                        $this->atributos[$row[0]] = $fecha;
                        $this->tiposDatos[$row[0]] = $row;
                    } else if (stripos($row[1], "time") !== false) {
                        $fecha = DateTime::createFromFormat("H:i:s", "00:00:00");
                        $this->atributos[$row[0]] = $fecha;
                        $this->tiposDatos[$row[0]] = $row;
                    } else if (stripos($row[1], "datetime") !== false) {
                        $fecha = DateTime::createFromFormat("Y-m-d H:i:s", "1970-01-01 00:00:00");
                        $this->atributos[$row[0]] = $fecha;
                        $this->tiposDatos[$row[0]] = $row;
                    }
                }
                
            };

            /*-- Declaracion de variables --*/
            $sql = "DESCRIBE " . $nombreTabla;

            /*-- Consulta de columnas --*/
            bd_prep_consulta_mysqli($bdConexion, $sql, null, $todo);

            /*-- Guarda los datos --*/
            $this->bdConexion = $bdConexion;
            $this->nombreTabla = $nombreTabla;
        }
        
        /**
         * Método que sirve para crear objetos MyORM asociados a varias filas existentes en la tabla especificada de la BB.DD especificada.
         *
         * @param  mixed $bdConexion Especifica la conexión a la base de datos.
         * @param  mixed $nombreTabla Proporciona el nombre de la tabla de la que se quieren obtener objetos asociados a filas.
         * @param  mixed $where Array asociativo que contiene las columnas y valores (key = columna, value = valor) que se utilizarán como criterio para determinar qué registros (en forma de objetos) obtener.
         * @return array|MyORM|null Un array, si devuelve varios objetos (filas) de la tabla, un objeto individual de tipo MyORM (si solo es una fila), o null, si no encuentra ninguna fila con el where especificado.
         */
        public static function from(mysqli &$bdConexion, string $nombreTabla, array $where): array|MyORM|null {
            /*-- Declaración de variables --*/
            $datos = array();
            $sql = "SELECT * FROM " . $nombreTabla;

            /*-- Añade el WHERE --*/
            $sql .= " WHERE ";
            foreach ($where as $columna => $value) {
                $sql .= $columna . " = ? AND ";
            }
            rtrim($sql, " AND "); // Elimina el sobrante  AND  https://www.php.net/manual/es/ref.strings.php

            /*-- Función anónima para agregar cada fila fila que recoja de la consulta en forma de objeto MyORM al array que devolverá (con datos de cada columna de la tabla) --*/
            $todo = function (array $row) use(&$bdConexion, &$nombreTabla, &$datos) {
                // global $bdConexion, $nombreTabla, $datos; // Obtiene acceso a las variables de fuera de la función anónima
                $objeto = new MyORM($bdConexion, $nombreTabla);
                /*-- Añade la fila al objeto --*/
                foreach ($row as $columna => $value) {
                    $objeto->add($columna, $value);
                }

                /*-- Cambia la bandera $insert a false para que save solo pueda hacer updates --*/
                $objeto->insert = false;

                $datos[] = $objeto; // Añade el objeto MyORM al array
            };

            /*-- Ejecuta la consulta --*/
            bd_prep_consulta_mysqli($bdConexion, $sql, null, $todo);

            /*-- Devuelve array (u objeto MyORM) --*/
            $numDatos = count($datos);
            if ($numDatos == 0) {
                return null;
            } else if ($numDatos == 1) {
                return $datos[0];
            } else {
                return $datos;
            }
        }

                
        /**
         * Método que sirve para obtener el valor de una columna del registro.
         *
         * @param  mixed $key Especifica el nombre de la columna.
         * @return mixed El valor de la columna.
         */
        public function get(string $key) {
            // Si se ha modificado el valor en el objeto pero no se ha invocado a save, no se devuelve el valor anterior (el de la BB.DD), sino el valor nuevo que aún no ha sido guardado en la BB.DD
            return $this->atributos[$key];
        }

                
        /**
         * Método privado para uso exclusivo interno de la clase (en concreto, para cuando se invoca al método estático from), que sirve para establecer el valor a una columna del registro.
         * Es privado, ya que no realiza ningún tipo de comprobación de si existe o no la columna con el nombre especificado.
         *
         * @param  mixed $key Especifica el nombre de la columna.
         * @param  mixed $value Especifica el valor que se quiere asignar a la columna.
         * @return void
         */
        private function add(string $key, string|int|float|object|array|null $value = null): void {
            $this->atributos[$key] = $value;
        }

        /**
         * Método que sirve para establecer el valor a una columna del registro.
         * Realiza una comprobación previa de si existe la columna con el nombre especificado.
         *
         * @param  mixed $key Especifica el nombre de la columna.
         * @param  mixed $value Especifica el valor que se quiere asignar a la columna.
         * @return bool true Si se ha cambiado con éxito el valor de la columna especificada. False si no.
         */
        public function set(string $key, string|int|float|object|array|null $value = null) : bool {
            /*-- Descarta primero si la key no existe en el array de atributos --*/
            if (!array_key_exists($key, $this->atributos)) {
                return false;
            }

            /*-- Actualiza el valor de la key en el array de atributos --*/
            if (!array_key_exists("anterior", $this->tiposDatos[$key])) { // Guarda el valor anterior en caso de que no exista ya un valor anterior guardado
                $this->tiposDatos[$key]["anterior"] = $this->atributos[$key]; // Actúa de bandera para el método save
            }
            $this->atributos[$key] = $value;

            return true;
        }
        
        /**
         * Método que sirve para realizar la inserción en la BB.DD (si el objeto se ha creado mediante el constructor y es la primera vez que se invoca al método save) de los datos introducidos con set, o bien la actualización de los mismos (si el/los objeto(s) se ha(n) creado mediante el método estático from, o ya se ha invocado al menos una vez este método save)
         *
         * @return bool true Si la operación de guardado en la BB.DD ha tenido éxito, false si no.
         */
        public function save() {
            /*-- Declaración de variables --*/
            $parametros = array(); // Array que se compondrá solamente de aquellos parámetros que hayan sido modificados (en caso de update)
            $where = array(); // Array que se compondrá de las columnas que actúen como clave primaria (en caso de update)
            //$insert = true; // Variable "bandera" que servirá para determinar si se hace un INSERT o un UPDATE en la BB.DD

            /*-- Rellena el array de parámetros y de where que enviaremos al método bdUpdate --*/
            foreach ($this->tiposDatos as $key => $value) {
                /*-- Rellena el array de parámetros --*/
                if (array_key_exists("anterior", $value) && $this->insert) {
                    $parametros[] = $this->atributos[$key];
                }

                /*-- Rellena el array de where --*/
                if ($value[3] == "PRI") {
                    if (array_key_exists("anterior", $value)) {
                        $where[$key] = $value["anterior"];
                    } else {
                        $where[$key] = $this->atributos[$key];
                        /*-- Si el atributo clave primaria no es nulo, significa que tendremos que actualizar la fila, en lugar de crear una nueva --*/
                        if (isset($this->atributos[$key])) {
                            $this->insert = false;
                        }
                    }
                }
            }

            /*-- Ejecuta la actualización/inserción de datos en la BB.DD --*/
            if (!$this->insert) {
                $resultado = bdUpdate($this->bdConexion, $this->nombreTabla, $parametros, $where);
            } else {
                $resultado = bdInsert($this->bdConexion, $this->nombreTabla, $this->atributos);
            }

            /*-- Comprueba el resultado, si ha sido satisfactorio, elimina las banderas "anterior" --*/
            if ($resultado == true) {
                foreach ($this->tiposDatos as $key => $value) {
                    if (array_key_exists("anterior", $value)) {
                        unset($this->tiposDatos[$key]["anterior"]); // Destruye la bandera para indicar que el valor ha sido actualizado en la BB.DD
                    }
                }
            }
            
            /*-- Devuelve el resultado --*/
            return $resultado;
        }
        
        /**
         * Método que sirve para eliminar el registro de la BB.DD.
         * No elimina los datos del objeto, por lo que si después se vuelve a ejecutar un save(), se volverá a reinsertar la fila en la BB.DD.
         *
         * @return bool true Si ha eliminado la fila de la BB.DD, false si se produce un error al intentarlo.
         */
        public function remove() {
            /*-- Declaración de variables --*/
            $where = array(); // Array que se compondrá de las columnas que actúen como clave primaria

            /*-- Obtiene las claves primarias para poder identificar perfectamente la fila que queremos borrar de la BB.DD --*/
            foreach ($this->tiposDatos as $key => $value) {
                /*-- Rellena el array de where --*/
                if ($value[3] == "PRI") {
                    if (array_key_exists("anterior", $value)) {
                        $where[$key] = $value["anterior"];
                    } else {
                        $where[$key] = $this->atributos[$key];
                    }
                }
            }

            /*-- Realiza la eliminación de la fila --*/
            $resultado = bdDelete($this->bdConexion, $this->nombreTabla, $where);

            /*-- Vuelve a poner la bandera $insert a true para que el próximo save haga un INSERT en vez de un UPDATE --*/
            $this->insert = true;

            /*-- Devuelve el resultado de la eliminación --*/
            return $resultado;
        }
    }
?>