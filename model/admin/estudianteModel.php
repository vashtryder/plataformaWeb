<?php 
	class estudianteModel extends EntidadBase
	{
		private static $table = 'tb_colegio_estudiante';


		public function __construct() {
			self::$table;
		}

		public static function getEstudianteReporteModel($data)
        {
            return EntidadBase::consultaArray("SELECT
                *
            FROM
                vb_colegio_estudiante
            WHERE
                ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_SECCION = '".EntidadBase::real_escape_string($data[1])."' AND
                ID_NIVEL = '".EntidadBase::real_escape_string($data[2])."' AND
                ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                ID_ANIO = '".EntidadBase::real_escape_string($data[4])."'");
        }

        public static function getEstudianteModel()
        {
            $sql = "SELECT * FROM tb_colegio_estudiante";
            return EntidadBase::consultaArray($sql);
        }

        public static function getEstudianteVistaModel()
        {
            $sql = "SELECT * FROM vb_estudiante";
            return EntidadBase::consultaArray($sql);
        }


        public static function setEstudianteModel($data)
        {
            $sql = "SELECT * FROM tb_colegio_estudiante WHERE ID_ESTUDIANTE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getEstudianteIdModel()
        {
            $sql = "SELECT MAX(ID_ESTUDIANTE) FROM tb_colegio_estudiante";
            return EntidadBase::consultaForech($sql);
        }

        public static function getEstudianteAcademicoModel($data)
        {
            $sql = "SELECT * FROM tb_colegio_estudiante WHERE ID_COLEGIO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaArray($sql);
        }

        public static function getEstudianteCodigoModel()
        {
            $sql = "SELECT MAX(FICHACODIGOETA)-1000 FROM tb_colegio_estudiante";
            return EntidadBase::consultaForech($sql);
        }

        public static function getEstudianteNewModel($data)
        {
            $sql = "INSERT INTO tb_colegio_estudiante(ID_ESTUDIANTE, ID_COLEGIO, ID_ANIO, ESTUDIANTEPATERNO, ESTUDIANTEMATERNO, ESTUDIANTENOMBRES, ESTUDIANTEDNI, ESTUDIANTESEXO, ESTUDIANTEEDAD, ESTUDIANTEFECHABNAC, ESTUDIANTEDOMILICIO, ESTUDIANTETELEFONO1, ESTUDIANTETELEFONO2, ESTUDIANTEEMAIL, ESTUDIANTEFOTO)
            VALUES (
            '".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."',
            '".EntidadBase::real_escape_string($data[6])."',
            '".EntidadBase::real_escape_string($data[7])."',
            '".EntidadBase::real_escape_string($data[8])."',
            '".EntidadBase::real_escape_string($data[9])."',
            '".EntidadBase::real_escape_string($data[10])."',
            '".EntidadBase::real_escape_string($data[11])."',
            '".EntidadBase::real_escape_string($data[12])."',
            '".EntidadBase::real_escape_string($data[13])."',
            '".EntidadBase::real_escape_string($data[14])."')";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getEstudianteUpdateModel($data)
        {
            $sql = "UPDATE tb_colegio_estudiante SET
            ID_COLEGIO          ='".EntidadBase::real_escape_string($data[0])."',
            ESTUDIANTEPATERNO   ='".EntidadBase::real_escape_string($data[1])."',
            ESTUDIANTEMATERNO   ='".EntidadBase::real_escape_string($data[2])."',
            ESTUDIANTENOMBRES   ='".EntidadBase::real_escape_string($data[3])."',
            ESTUDIANTEDNI       ='".EntidadBase::real_escape_string($data[4])."',
            ESTUDIANTESEXO      ='".EntidadBase::real_escape_string($data[5])."',
            ESTUDIANTEEDAD      ='".EntidadBase::real_escape_string($data[6])."',
            ESTUDIANTEFECHABNAC ='".EntidadBase::real_escape_string($data[7])."',
            ESTUDIANTEDOMILICIO ='".EntidadBase::real_escape_string($data[8])."',
            ESTUDIANTETELEFONO1 ='".EntidadBase::real_escape_string($data[9])."',
            ESTUDIANTETELEFONO2 ='".EntidadBase::real_escape_string($data[10])."',
            ESTUDIANTEEMAIL     ='".EntidadBase::real_escape_string($data[11])."'
             WHERE ID_ESTUDIANTE='".EntidadBase::real_escape_string($data[12])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getEstudianteDeleteModel($data)
        {
            $sql = "DELETE FROM tb_colegio_estudiante WHERE ID_ESTUDIANTE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }

        public static function getEstudianteAvatarModel($data)
        {
            $sql = "UPDATE tb_colegio_estudiante SET
            ESTUDIANTEFOTO      = '".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_ESTUDIANTE = '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
        }
	}
?>