<?php 
	class EntidadBaseEta extends MySQL{
		public function __construct() {
		}
	
		public static function consultaForech($consulta='')
        {
            $resultSet = array();
			$query=MySQL::connectETA()->query($consulta);
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
            $query = MySQL::connectETA()->query($consulta);
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
            MySQL::connectETA()->query("START TRANSACTION");
            $query = MySQL::connectETA()->query($consulta);
            if($query === true){
                MySQL::connectETA()->query("COMMIT");
                return 1;
            }else{
                MySQL::connectETA()->query("ROLLBACK");
                return 0;
            }
        }

        public static function consultaProcedure($consulta='')
        {
            $query = MySQL::connectETA()->query($consulta);
			if ($query == true) {
				return true;
			} else {
				return false;
			}
        }

        public static function real_escape_string($consulta='')
        {
			return MySQL::connectETA()->real_escape_string($consulta);
        }

        public static function consultaFields($consulta='')
        {
            if ($query = MySQL::connectETA()->query($consulta)) {
                return $query->field_count;
            } else{
				return false;
			}
        }
	
	}
	
?>