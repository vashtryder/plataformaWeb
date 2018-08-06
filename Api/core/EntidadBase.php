<?php 
	class EntidadBase extends MySQL{
		public function __construct() {
		}
	
		public static function consultaForech($consulta='')
        {
            $resultSet = array();
			$query=MySQL::connectDB()->query($consulta);
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
            $query = MySQL::connectDB()->query($consulta);
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
            MySQL::connectDB()->query("START TRANSACTION");
            $query = MySQL::connectDB()->query($consulta);
            if($query !== false){
                MySQL::connectDB()->query("COMMIT");
                return $query;
            }else{
                MySQL::connectDB()->query("ROLLBACK");
                return $query;
            }
        }

        public static function consultaProcedure($consulta='')
        {
            $query = MySQL::connectDB()->query($consulta);
			if ($query == true) {
				return $query;
			} else {
				return $query;
			}
        }

        public static function real_escape_string($consulta='')
        {
			$query = MySQL::connectDB()->real_escape_string($consulta);
			if($query == true){
				return $query;
			} else{
				return false;
			}
        }

        public static function consultaFields($consulta='')
        {
            if ($query = MySQL::connectDB()->query($consulta)) {
                return $query->field_count;
            } else{
				return false;
			}
        }
	
	}
	
?>