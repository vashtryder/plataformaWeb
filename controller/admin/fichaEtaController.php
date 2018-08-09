<?php
	class fichaEtaController extends fichaEtaModel
	{
		public static function getFichaEtaFicha($data){
			return fichaEtaModel::getFichaEtaFichaModel($data);
		}

		public static function getFichaEtaTabla(){
			return fichaEtaModel::getFichaEtaTablaModel();
		}

		public static function getFichaEtaGrado($data){
			return fichaEtaModel::getFichaEtaGradoModel($data);
		}

		public static function getFichaEtaSeccion($data){
			return fichaEtaModel::getFichaEtaSeccionModel($data);
		}

		public static function getFichaEtaNivel($data){
			return fichaEtaModel::getFichaEtaNivelModel($data);
		}

		public static function getFichaEtaCantidad($data){
			return fichaEtaModel::getFichaEtaCantidadModel($data);
		}
	}
?>