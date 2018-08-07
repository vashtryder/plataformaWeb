<?php
	class calificacionEtaModel extends EntidadBase
	{
		private static $table = 'tb_administrador_modulo';

		public function __construct() {
			self::$table;
		}

		public static function getCalificacionEtaIdModel($tabla)
        {
            $sql = "SELECT max(ID_CALIFICACION) FROM ".$tabla." LIMIT 1";
            return EntidadBase::consultaForech($sql);
		}
		
		public static function getCalificacionEtaNewModel($data,$sp_procedure)
        {
            $idCalificacion = EntidadBase::real_escape_string($data[0]);
            $idRegistroEta  = EntidadBase::real_escape_string($data[1]);
            $idAnio         = EntidadBase::real_escape_string($data[2]);
            $seccion        = EntidadBase::real_escape_string($data[3]);
            $bd_origen      = EntidadBase::real_escape_string($data[4]);
            $bd_destino     = EntidadBase::real_escape_string($data[5]);
            $tabla_origen   = EntidadBase::real_escape_string($data[6]);
            $tabla_destino  = EntidadBase::real_escape_string($data[7]);
            $sql = "CALL ".$sp_procedure."($idCalificacion,$idRegistroEta,$idAnio,'$seccion','$bd_origen','$bd_destino','$tabla_origen','$tabla_destino',@param,@script);";
            EntidadBase::consulta($sql);
            // return $sql;
		}
		
		public static function getCalificacionEtaCamposModel($data)
        {
            $sql = "SELECT * FROM ".$data." ORDER BY ID_CALIFICACION LIMIT 1";
            return EntidadBase::consultaFields($sql);
		}

		public static function getCalificacionEtaAulaModel($data,$limit=0,$tabla)
        {
            if($limit == 0){
                $sql = "SELECT
                    ".$tabla.".*
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
                    tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[5])."'
                ORDER BY
                    `Overall Total Score`
                DESC";

            } else {

                $sql = "SELECT
                    ".$tabla.".*
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
                    tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[5])."'
                ORDER BY
                    `Overall Total Score`
                DESC

                LIMIT ".EntidadBase::real_escape_string($limit);

            }

            return EntidadBase::consultaArray($sql);
            // return $sql;
		}
		
		public static function getCalificacionEtaGradoModel($data,$limit=0,$tabla)
        {

            if($limit == 0){
                $sql = "SELECT
                    ".$tabla.".*
                FROM
                    ".$tabla."
                INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
                INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
                WHERE
                    tb_eta_grupo.ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                    tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[1])."' AND
                    ".$tabla.".ID_ANIO = '".EntidadBase::real_escape_string($data[2])."' AND
                    tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[3])."'
                ORDER BY
                    `Overall Total Score`
                DESC";
            } else {
                $sql = "SELECT
                    ".$tabla.".*
                FROM
                    ".$tabla."
                INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
                INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
                WHERE
                    tb_eta_grupo.ID_GRADO = '".EntidadBase::real_escape_string($data[0])."' AND
                    tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[1])."' AND
                    ".$tabla.".ID_ANIO = '".EntidadBase::real_escape_string($data[2])."' AND
                    tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[3])."'
                ORDER BY
                    `Overall Total Score`
                DESC

                LIMIT ".EntidadBase::real_escape_string($limit);
            }
            return EntidadBase::consultaArray($sql);
        }

        public static function getCalificacionEtaGrupoModel($data,$limit,$tabla)
        {

            if($limit == 0){

                $sql = "SELECT DISTINCT
                    ".$tabla.".*
                FROM
                    ".$tabla."
                INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
                INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
                INNER JOIN tb_eta_semana ON tb_eta_semana.ID_SEMANA = tb_eta_registro.ID_SEMANA

                WHERE
                    tb_eta_grupo.GRUPOETA        = '".EntidadBase::real_escape_string($data[0])."' AND
                    tb_eta_registro.ID_COLEGIO   = '".EntidadBase::real_escape_string($data[1])."' AND
                    ".$tabla.".ID_ANIO = '".EntidadBase::real_escape_string($data[2])."' AND
                    tb_eta_semana.ID_SEMANA      = '".EntidadBase::real_escape_string($data[3])."'
                ORDER BY
                    `Overall Total Score`
                DESC";

            } else {

                $sql = "SELECT DISTINCT
                    ".$tabla.".*
                FROM
                    ".$tabla."
                INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
                INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
                INNER JOIN tb_eta_semana ON tb_eta_semana.ID_SEMANA = tb_eta_registro.ID_SEMANA

                WHERE
                    tb_eta_grupo.GRUPOETA        = '".EntidadBase::real_escape_string($data[0])."' AND
                    tb_eta_registro.ID_COLEGIO   = '".EntidadBase::real_escape_string($data[1])."' AND
                    ".$tabla.".ID_ANIO = '".EntidadBase::real_escape_string($data[2])."' AND
                    tb_eta_semana.ID_SEMANA      = '".EntidadBase::real_escape_string($data[3])."'
                ORDER BY
                    `Overall Total Score`
                DESC

                LIMIT ".EntidadBase::real_escape_string($limit);
            }

            return EntidadBase::consultaArray($sql);
        }

        public static function getCalificacionEtaEstudianteModel($data,$tabla)
        {
            $sql = "SELECT
                ".$tabla.".*
            FROM
                ".$tabla."
            INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
            INNER JOIN tb_colegio_ficha on ".$tabla.".CODETA = tb_colegio_ficha.CODETA
            INNER JOIN tb_eta_semana ON tb_eta_semana.ID_SEMANA = tb_eta_registro.ID_SEMANA
            WHERE
                ".$tabla.".CODETA = '".EntidadBase::real_escape_string($data[0])."' AND
                tb_colegio_ficha.ID_COLEGIO = '".EntidadBase::real_escape_string($data[1])."' AND
                tb_eta_semana.ID_ANIO = '".EntidadBase::real_escape_string($data[2])."' AND
                tb_eta_semana.ID_PERIODO = '".EntidadBase::real_escape_string($data[3])."'
            ORDER BY
                ID_CALIFICACION
            DESC";
            return EntidadBase::consultaArray($sql);
        }

        public static function getCalificacionEtaSemanaModel($data,$tabla)
        {
            $sql = "SELECT
                ".$tabla.".*
            FROM
                ".$tabla."
            INNER JOIN tb_eta_registro ON tb_eta_registro.ID_REGISTRO = ".$tabla.".ID_REGISTRO
            INNER JOIN tb_colegio_ficha on ".$tabla.".CODETA = tb_colegio_ficha.CODETA
            INNER JOIN tb_eta_semana ON tb_eta_semana.ID_SEMANA = tb_eta_registro.ID_SEMANA

            where
                tb_colegio_ficha.CODETA = '".EntidadBase::real_escape_string($data[0])."' AND
                tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[1])."' AND
                ".$tabla.".ID_ANIO = '".EntidadBase::real_escape_string($data[2])."' AND
                tb_eta_registro.ID_SEMANA = '".EntidadBase::real_escape_string($data[3])."'";
            return EntidadBase::consultaForech($sql);
            // return $sql;
        }

		
    }
?>
