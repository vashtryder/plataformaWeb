<?php
	class tutorModel extends EntidadBase
	{
		private static $table = 'tb_colegio_tutor';

		public function __construct() {
			self::$table;
		}

        public static function getTutorModel()
        {
            $sql = "SELECT * FROM " . self::$table . "";
            return EntidadBase::consultaArray($sql);
        }

        public static function setTutorAcademicoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_COLEGIO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaArray($sql);
        }

        public static function setTutorModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_TUTOR = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getTutorPersonalModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_DOCENTE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getTutorIdModel()
        {
            $sql = "SELECT MAX(ID_TUTOR) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
        }

        public static function getTutorNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_TUTOR, ID_COLEGIO, ID_ANIO, ID_DOCENTE, ID_GRADO, ID_SECCION, ID_NIVEL ) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."',
            '".EntidadBase::real_escape_string($data[6])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getTutorUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            ID_COLEGIO     = '".EntidadBase::real_escape_string($data[0])."',
            ID_DOCENTE     = '".EntidadBase::real_escape_string($data[1])."',
            ID_GRADO       = '".EntidadBase::real_escape_string($data[2])."',
            ID_SECCION     = '".EntidadBase::real_escape_string($data[3])."',
            ID_NIVEL       = '".EntidadBase::real_escape_string($data[4])."'
            WHERE ID_TUTOR = '".EntidadBase::real_escape_string($data[5])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getTutorDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_TUTOR = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
		}
		
		public static function getTutorEtaModel($data)
        {
            $sql = "SELECT
                tb_colegio_docente.*
            FROM
                " . self::$table . "

            INNER JOIN tb_colegio_grado ON tb_colegio_grado.ID_GRADO = " . self::$table . ".ID_GRADO
            INNER JOIN tb_colegio_seccion ON tb_colegio_seccion.ID_SECCION = " . self::$table . ".ID_SECCION
            INNER JOIN tb_colegio_nivel ON tb_colegio_nivel.ID_NIVEL = " . self::$table . ".ID_NIVEL
            INNER JOIN tb_colegio_docente ON tb_colegio_docente.ID_DOCENTE = " . self::$table . ".ID_DOCENTE

            WHERE
                " . self::$table . ".ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                " . self::$table . ".ID_SECCION = '".EntidadBase::real_escape_string($data[1])."' AND
                " . self::$table . ".ID_NIVEL = '".EntidadBase::real_escape_string($data[2])."' AND
                " . self::$table . ".ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                " . self::$table . ".ID_ANIO = '".EntidadBase::real_escape_string($data[4])."'";
            return EntidadBase::consultaForech($sql);
            // return $sql;
        }

        public static function getTutorEtaGradoModel($data)
        {
            $sql = "SELECT
                tb_colegio_docente.*
            FROM
                " . self::$table . "
            INNER JOIN tb_colegio_grado ON tb_colegio_grado.ID_GRADO = " . self::$table . ".ID_GRADO
            INNER JOIN tb_colegio_seccion ON tb_colegio_seccion.ID_SECCION = " . self::$table . ".ID_SECCION
            INNER JOIN tb_colegio_nivel ON tb_colegio_nivel.ID_NIVEL = " . self::$table . ".ID_NIVEL
            INNER JOIN tb_colegio_docente ON tb_colegio_docente.ID_DOCENTE = " . self::$table . ".ID_DOCENTE

            WHERE
                " . self::$table . ".ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                " . self::$table . ".ID_COLEGIO = '".EntidadBase::real_escape_string($data[1])."' AND
                " . self::$table . ".ID_ANIO = '".EntidadBase::real_escape_string($data[2])."'";
                return EntidadBase::consultaArray($sql);
        }

        public static function getTutorReporteModel($data)
        {
            return EntidadBase::consultaForech("SELECT
                *
            FROM
                vb_colegio_tutor
            WHERE
                ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_SECCION = '".EntidadBase::real_escape_string($data[1])."' AND
                ID_NIVEL = '".EntidadBase::real_escape_string($data[2])."' AND
                ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                ID_ANIO = '".EntidadBase::real_escape_string($data[4])."'");
        }

    }
?>