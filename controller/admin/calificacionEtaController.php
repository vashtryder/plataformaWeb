<?php
	class calificacionEtaController extends calificacionEtaModel
	{
		public static function getCalificacionEtaId($tabla){
			return calificacionEtaModel::getCalificacionEtaIdModel($tabla)
		}

		public static function getCalificacionEtaNew($data,$sp_procedure){
			return calificacionEtaModel::getCalificacionEtaNewModel($data,$sp_procedure);
		}

		public static function getCalificacionEtaCampos($data){
			return calificacionEtaModel::getCalificacionEtaCamposModel($data);
		}

		public static function getCalificacionEtaAula($data){
			return calificacionEtaModel::getCalificacionEtaAulaModel($data);
		}

		public static function getCalificacionEtaGrado($data,$limit=0,$tabla){
			return calificacionEtaModel::getCalificacionEtaGradoModel($data,$limit=0,$tabla);
		}

		public static function getCalificacionEtaGrupo($data,$limit=0,$tabla){
			return calificacionEtaModel::getCalificacionEtaGrupoModel($data,$limit=0,$tabla);
		}
		
		public static function getCalificacionEtaEstudiante($data,$tabla){
			return calificacionEtaModel::getCalificacionEtaEstudianteModel($data,$tabla);
		}

		public static function getCalificacionEtaSemana($data,$tabla){
			return calificacionEtaModel::getCalificacionEtaSemanaModel($data,$tabla);
		}
	}
?>