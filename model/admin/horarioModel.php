<?php
	class horarioModel extends EntidadBase
	{
		private static $table = 'tb_colegio_horario';

		public function __construct() {
			self::$table;
		}

		public static function getHorarioModel()
        {
            $sql = "SELECT * FROM tb_colegio_horario";
            return EntidadBase::consultaArray($sql);
        }

        public static function getHorarioAcademicoModel($data)
        {
            $sql = "SELECT * FROM tb_colegio_horario WHERE ID_COLEGIO ='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaArray($sql);
        }


        public static function setHorarioModel($data)
        {
            $sql = "SELECT * FROM tb_colegio_horario WHERE ID_HORARIO ='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getHorarioIdModel()
        {
            $sql = "SELECT MAX(ID_HORARIO) FROM tb_colegio_horario";
            return EntidadBase::consultaForech($sql);
        }

        public static function getHorarioNewModel($data)
        {
            $sql = "INSERT INTO tb_colegio_horario(ID_HORARIO, ID_COLEGIO, ID_DOCENTE, ID_ANIO, ID_CURSO, ID_GRADO, ID_SECCION, ID_NIVEL) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."',
            '".EntidadBase::real_escape_string($data[6])."',
            '".EntidadBase::real_escape_string($data[7])."')";
            return EntidadBase::consulta($sql);
            // return $sql;

        }

        public static function getHorarioUpdateModel($data)
        {
            $sql = "UPDATE tb_colegio_horario SET
            ID_COLEGIO       = '".EntidadBase::real_escape_string($data[0])."',
            ID_DOCENTE       = '".EntidadBase::real_escape_string($data[1])."',
            ID_CURSO         = '".EntidadBase::real_escape_string($data[2])."',
            ID_GRADO         = '".EntidadBase::real_escape_string($data[3])."',
            ID_SECCION       = '".EntidadBase::real_escape_string($data[4])."',
            ID_NIVEL         = '".EntidadBase::real_escape_string($data[5])."'
            WHERE ID_HORARIO = '".EntidadBase::real_escape_string($data[6])."'";
            return EntidadBase::consulta($sql);
            // return $sql;

        }

        public static function getHorarioDeleteModel($data)
        {
            $sql = "DELETE FROM tb_colegio_horario WHERE ID_HORARIO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
	}
?>