<?php 
	class EntidadBase extends Conectar{
		public function __construct() {
		}
	
		public static function consultaForech($consulta='')
        {
            $resultSet = array();
			$query=Conectar::conexion()->query($consulta);
			if($query == false){
				while ($row = $query->fetch_array(MYSQLI_NUM)) {
					foreach ($row as $rows) {
						$resultSet[] = $rows;
					}
				}
			} else{
				$resultSet[] = null;
			}
			return $resultSet;
        }

        public static function consultaArray($consulta='')
        {
            $resultSet = array();
            $query = Conectar::conexion()->query($consulta);
			if ($query == true) {
				while ($row = $query->fetch_array(MYSQLI_NUM)) {
					$resultSet[] = $row;
				}
			} else{
				$resultSet[] = null;
			}	
			return $resultSet;
        }

        public static function consulta($consulta='')
        {
            Conectar::conexion()->query("START TRANSACTION");
            $query = Conectar::conexion()->query($consulta);
            if($query !== false){
                Conectar::conexion()->query("COMMIT");
                return $query;
            }else{
                Conectar::conexion()->query("ROLLBACK");
                return $query;
            }
        }

        public static function consultaProcedure($consulta='')
        {
            $query = Conectar::conexion()->query($consulta);
			if ($query == true) {
				return $query;
			} else {
				return $query;
			}
        }

        public static function real_escape_string($consulta='')
        {
			$query = Conectar::conexion()->real_escape_string($consulta);
			if($query == true){
				return $query
			} else{
				return false;
			}
        }

        public static function consultaFields($consulta='')
        {
            if ($query = Conectar::conexion()->query($consulta)) {
                return $query->field_count;
            } else{
				return false;
			}
        }
	
	}
	
?>