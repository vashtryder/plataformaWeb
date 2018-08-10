<?php 
	class fichaController extends fichaModel
	{
		public static function getFicha(){
			return fichaModel::getFichaModel();
		}

		public static function setFicha($data){
			return fichaModel::setFichaModel($data);
		}

		public static function setFichaEstudiante($data){
			return fichaModel::setFichaEstudianteModel($data);
		}

		public static function getFichaId(){
			return fichaModel::getFichaIdModel();
		}

		public static function getFichaCodigoEta($data){
			return fichaModel::getFichaCodigoEtaModel($data);
		}

		public static function getFichaCodigo(){
			return fichaModel::getFichaCodigoModel();
		}

		public static function getFichaNew($data){
			return fichaModel::getFichaNewModel($data);
		}

		public function getFichaUpdate($data){
			return fichaModel::getFichaUpdateModel($data);
		}
		
		public static function getFichaDelete($data){
			return fichaModel::getFichaDeleteModel($data);
		}

		public static function getFichaEstado($data){
			return fichaModel::getFichaEstadoModel($data);
		}
	}	
?>