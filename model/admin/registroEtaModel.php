<?php
	class registroEtaModel extends EntidadBase
	{
		private static $table = 'tb_eta';

		public function __construct() {
			self::$table;
		}

		public static function getRegistroEtaModel()
        {
            $sql = "SELECT * FROM tb_eta_registro";
            return EntidadBase::consultaArray($sql);
		}
		
		public static function setRegistroEtaModel($data)
        {
            $sql = "SELECT * FROM `tb_eta_registro`
           WHERE
            ID_REGISTRO = '".EntidadBase::real_escape_string($data[0])."' AND
            ID_COLEGIO = '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consultaForech($sql);
        }

		public static function getRegistroEtaGrupoModel($data)
        {
            $sql = "SELECT * FROM tb_eta WHERE ETAGRUPO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getRegistroEtaIdModel()
        {
            $sql = "SELECT max(`ID_REGISTRO`) FROM `tb_eta_registro` LIMIT 1";
            return EntidadBase::consultaForech($sql);
        }

        public static function getRegistroEtaDeleteModel($data)
        {
            $bd_origen = EntidadBase::real_escape_strinG($data[0]);
            $tabla_origen = EntidadBase::real_escape_strinG($data[1]);
            $sql = "CALL sp_eliminarRegistroEta('$tabla_origen','$bd_origen',@param,@script)";
            return EntidadBase::consulta($sql);
        }

        public static function getRegistroEtaNewModel($data)
        {
            $idRegistro = EntidadBase::real_escape_string($data[0]);
            $idColegio  = EntidadBase::real_escape_string($data[1]);
            $idAnio     = EntidadBase::real_escape_string($data[2]);
            $idSemana   = EntidadBase::real_escape_string($data[3]);
            $idGrupo    = EntidadBase::real_escape_string($data[4]);
            $idtutor    = EntidadBase::real_escape_string($data[5]);
            $nombre     = EntidadBase::real_escape_string($data[6]);
            $fecha      = EntidadBase::real_escape_string($data[7]);
            $sql = "CALL sp_guardarRegistroEta($idRegistro,$idColegio,$idAnio,$idSemana,$idGrupo,$idtutor,'$nombre','$fecha',@param,@script);";
            EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getRegistroEtaEstudianteNewModel($data)
        {
            $sql = " SET @idRegistro = '" . EntidadBase::real_escape_string($data[0]) . "';";
            $sql .= "SET @idColegio = '" . EntidadBase::real_escape_string($data[1]) . "';";
            $sql .= "SET @idAnio = '" . EntidadBase::real_escape_string($data[2]) . "';";
            $sql .= "SET @idSemana = '" . EntidadBase::real_escape_string($data[3]) . "';";
            $sql .= "SET @idEstudiante = '" . EntidadBase::real_escape_string($data[4]) . "';";
            $sql .= "SET @idCalificacion = '" . EntidadBase::real_escape_string($data[5]) . "';";
            $sql .= "SET @param = '';";
            $sql .= "SET @script = '';";
            $sql .= "CALL sp_guardarRegistroEta(@idRegistro,@idColegio,@idAnio,@idSemana,@idEstudiante,@idCalificacion,@param,@script)";
            return EntidadBase::consulta($sql);

        }

        public static function getRegistroEtaAulaModel($data)
        {
            $sql = "SELECT
                tb_eta_registro.*
            FROM
                tb_eta_registro
            INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
            WHERE
                tb_eta_grupo.ID_GRADO      = '".EntidadBase::real_escape_string($data[0])."' AND
                tb_eta_grupo.ID_SECCION    = '".EntidadBase::real_escape_string($data[1])."' AND
                tb_eta_grupo.ID_NIVEL      = '".EntidadBase::real_escape_string($data[2])."' AND
                tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                tb_eta_registro.ID_ANIO    = '".EntidadBase::real_escape_string($data[4])."' AND
                tb_eta_registro.ID_SEMANA  = '".EntidadBase::real_escape_string($data[5])."'";
            return EntidadBase::consultaForech($sql);
            // return $sql;
        }

        public static function getRegistroEtaGradoModel($data)
        {
            $sql = "SELECT
                tb_eta_registro.*
            FROM
                tb_eta_registro
            INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
            WHERE
                tb_eta_grupo.ID_GRADO      = '".EntidadBase::real_escape_string($data[3])."' AND
                tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[0])."' AND
                tb_eta_registro.ID_ANIO    = '".EntidadBase::real_escape_string($data[1])."' AND
                tb_eta_registro.ID_SEMANA  = '".EntidadBase::real_escape_string($data[2])."' AND";
            return EntidadBase::consultaArray($sql);
        }

        public static function getRegistroEtaPromedioModel($data,$tabla)
        {
            if($data[2] == 1){
                $sql = "SELECT
                    ROUND(SUM(`HCOM Total Score`) / COUNT(*),2)  AS `HCOM`,
                    ROUND(SUM(`COMU Total Score`) / COUNT(*),2)  AS `COMU`,
                    ROUND(SUM(`HMAT Total Score`) / COUNT(*),2)  AS `HMAT`,
                    ROUND(SUM(`MATE Total Score`) / COUNT(*),2)  AS `MATE`,
                    ROUND(SUM(`CTYA Total Score`) / COUNT(*),2)  AS `CTYA`,
                    ROUND(SUM(`HGYE Total Score`) / COUNT(*),2)  AS `HGYE`,
                    ROUND(SUM(`INGL Total Score`) / COUNT(*),2)  AS `INGL`
                FROM
                    ".$tabla."
                WHERE
                    ID_REGISTRO = '".EntidadBase::real_escape_string($data[0])."' AND
                    ID_ANIO = '".EntidadBase::real_escape_string($data[1])."'";
            } else {
                $sql = "SELECT
                    ROUND(SUM(`PLEC Total Score`) / COUNT(*),2)  AS `PLEC`,
                    ROUND(SUM(`COMU Total Score`) / COUNT(*),2)  AS `COMU`,
                    ROUND(SUM(`MATE Total Score`) / COUNT(*),2)  AS `MATE`
                FROM
                    ".$tabla."
                WHERE
                    ID_REGISTRO = '".EntidadBase::real_escape_string($data[0])."' AND
                    ID_ANIO = '".EntidadBase::real_escape_string($data[1])."'";
            }
            return EntidadBase::consultaArray($sql);
        }


        public static function getRegistroEtaMaximoModel($data,$tabla)
        {
            $sql = "SELECT
                    max(`".$tabla."`.`Overall Total Score`)
                FROM
                    ".$tabla."
                INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
                INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
                WHERE
                    tb_eta_grupo.ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                    tb_eta_grupo.ID_SECCION= '".EntidadBase::real_escape_string($data[1])."' AND
                    tb_eta_grupo.ID_NIVEL = '".EntidadBase::real_escape_string($data[2])."' AND
                    tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                    ".$tabla.".ID_ANIO = '".EntidadBase::real_escape_string($data[4])."' AND
                    tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[5])."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getRegistroEtaMinimoModel($data,$tabla)
        {
            $sql = "SELECT
                    min(`".$tabla."`.`Overall Total Score`)
                FROM
                    ".$tabla."
                INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
                INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
                WHERE
                    tb_eta_grupo.ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                    tb_eta_grupo.ID_SECCION= '".EntidadBase::real_escape_string($data[1])."' AND
                    tb_eta_grupo.ID_NIVEL = '".EntidadBase::real_escape_string($data[2])."' AND
                    tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                    ".$tabla.".ID_ANIO = '".EntidadBase::real_escape_string($data[4])."' AND
                    tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[5])."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getRegistroEtaMaximoErrorModel($data,$tabla)
        {
            $sql = "SELECT
                    max(`".$tabla."`.`Overall Number Incorrect`)
                FROM
                    ".$tabla."
                INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
                INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
                WHERE
                    tb_eta_grupo.ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                    tb_eta_grupo.ID_SECCION= '".EntidadBase::real_escape_string($data[1])."' AND
                    tb_eta_grupo.ID_NIVEL = '".EntidadBase::real_escape_string($data[2])."' AND
                    tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                    ".$tabla.".ID_ANIO = '".EntidadBase::real_escape_string($data[4])."' AND
                    tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[5])."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getRegistroEtaMinimoErrorModel($data,$tabla)
        {
            $sql = "SELECT
                    min(`".$tabla."`.`Overall Number Incorrect`)
                FROM
                    ".$tabla."
                INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
                INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
                WHERE
                    tb_eta_grupo.ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                    tb_eta_grupo.ID_SECCION= '".EntidadBase::real_escape_string($data[1])."' AND
                    tb_eta_grupo.ID_NIVEL = '".EntidadBase::real_escape_string($data[2])."' AND
                    tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                    tb_eta_registro.ID_ANIO = '".EntidadBase::real_escape_string($data[4])."' AND
                    tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[5])."'";
            return EntidadBase::consultaForech($sql);
		}
		
        public static function getRegistroEtaGrupoAnioModel($data)
        {
            $sql = "SELECT
                *
            FROM
                tb_eta_grupo
            WHERE
                GRUPOETA = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_ANIO = '".EntidadBase::real_escape_string($data[1])."'";

            return EntidadBase::consultaArray($sql);
        }

        public static function getRegistroEtaGrupoAulaModel($data)
        {
            $sql = "SELECT
                *
            FROM
                tb_eta_grupo
            WHERE
                ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_SECCION = '".EntidadBase::real_escape_string($data[1])."' AND
                ID_NIVEL = '".EntidadBase::real_escape_string($data[2])."' AND
                ID_ANIO = '".EntidadBase::real_escape_string($data[3])."'";

            return EntidadBase::consultaForech($sql);
        }

        public static function getRegistroEtaGrupoGradoModel($data)
        {
            $sql = "SELECT
                *
            FROM
                tb_eta_grupo
            WHERE
                ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_ANIO = '".EntidadBase::real_escape_string($data[1])."'";

            return EntidadBase::consultaArray($sql);
        }
    }
?>