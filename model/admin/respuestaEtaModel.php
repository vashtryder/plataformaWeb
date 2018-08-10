<?php 
	class respuestaEtaModel extends EntidadBase
	{

		public function __construct() {
			
		}

		public static function getRespuestaEtaProcentajeModel($data,$tabla1,$tabla2)
        {
            $sql = "SELECT
            (SELECT ROUND((SELECT (count(*)*100) FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."' and R".EntidadBase::real_escape_string($data[2])."='A')/count(*)) As A FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."') AS A,
            (SELECT ROUND((SELECT (count(*)*100) FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."' and R".EntidadBase::real_escape_string($data[2])."='B')/count(*)) As A FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."') AS B,
            (SELECT ROUND((SELECT (count(*)*100) FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."' and R".EntidadBase::real_escape_string($data[2])."='C')/count(*)) As B FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."') AS C,
            (SELECT ROUND((SELECT (count(*)*100) FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."' and R".EntidadBase::real_escape_string($data[2])."='D')/count(*)) As C FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."') AS D,
            (SELECT ROUND((SELECT (count(*)*100) FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."' and R".EntidadBase::real_escape_string($data[2])."='E')/count(*)) As D FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."') AS E,
            (SELECT ROUND((SELECT (count(*)*100) FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."' and R".EntidadBase::real_escape_string($data[2])."='BLANK')/count(*)) As BLANCO FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."') AS BLANCO,
            (SELECT ROUND((SELECT (count(*)*100) FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."' and R".EntidadBase::real_escape_string($data[2])."='MULT')/count(*)) As MULT FROM ".$tabla2." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."') AS MULT
            FROM ".$tabla1." WHERE ID_REGISTRO='".EntidadBase::real_escape_string($data[0])."' AND ID_ANIO='".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getRespuestaEtaModel($data,$tabla)
        {
            $sql = "SELECT
                *
            FROM
                ".$tabla."
            WHERE
                ID_REGISTRO = ( SELECT
                tb_eta_registro.ID_REGISTRO
            FROM
                tb_eta_registro
            INNER JOIN tb_eta_grupo ON tb_eta_grupo.ID_GRUPO = tb_eta_registro.ID_GRUPO
            WHERE
                tb_eta_grupo.ID_GRADO      = '".EntidadBase::real_escape_string($data[0])."' AND
                tb_eta_grupo.ID_SECCION    = '".EntidadBase::real_escape_string($data[1])."' AND
                tb_eta_grupo.ID_NIVEL      = '".EntidadBase::real_escape_string($data[2])."' AND
                tb_eta_registro.ID_COLEGIO = '".EntidadBase::real_escape_string($data[3])."' AND
                tb_eta_registro.ID_ANIO    = '".EntidadBase::real_escape_string($data[4])."' AND
                tb_eta_registro.ID_SEMANA  = '".EntidadBase::real_escape_string($data[5])."' )";
            return EntidadBase::consultaForech($sql);
            // return $sql;
        }

        public static function getRespuestaEtaIdModel($data)
        {
            $sql = "SELECT max(ID_RESPUESTA) FROM ".$data;
            return EntidadBase::consultaForech($sql);
        }

        public static function getRespuestaEtaNewModel($data,$respuestas,$tabla)
        {
            $idRespuesta   = EntidadBase::real_escape_string($data[0]);
            $idRegistroEta = EntidadBase::real_escape_string($data[1]);
            $idColegio     = EntidadBase::real_escape_string($data[2]);
            $idAnio        = EntidadBase::real_escape_string($data[3]);

            $w = 3;
            for ($i=1; $i <= $respuestas; $i++) {
                $w++;
                $r[$i]  = EntidadBase::real_escape_string($data[$w]);
            }

            $sql = "CALL ".$tabla."($idRespuesta,$idRegistroEta,$idColegio,$idAnio,";
            for ($i=1; $i <= $respuestas; $i++) {
                $sql .= "'".$r[$i]."',";
            }

            $sql .= "@param,@script); ";

            return EntidadBase::consulta($sql);
            // return $sql;
        }

	}
?>