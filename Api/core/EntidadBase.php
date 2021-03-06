<?php 
	class EntidadBase extends MySQL{
		public function __construct() {
		}
	
		public static function consultaForech($consulta='')
        {
            $resultSet = array();
			$query=MySQL::connectDB()->query($consulta);
			if($query == true){
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
            if($query === true){
                MySQL::connectDB()->query("COMMIT");
                return 1;
            }else{
                MySQL::connectDB()->query("ROLLBACK");
                return 0;
            }
        }

        public static function consultaProcedure($consulta='')
        {
            $query = MySQL::connectDB()->query($consulta);
			if ($query == true) {
				return true;
			} else {
				return false;
			}
        }

        public static function real_escape_string($consulta='')
        {
			return MySQL::connectDB()->real_escape_string($consulta);
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