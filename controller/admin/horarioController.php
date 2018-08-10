<?php 
	class horarioController extends horarioModel
	{
		public static function getHorario(){
			return horarioModel::getHorarioModel();
		}

		public static function getHorarioAcademico($data){
			return horarioModel::getHorarioAcademicoModel($data);
		}

		public static function setHorario($data){
			return horarioModel::setHorarioModel($data);
		}

		public static function getHorarioId(){
			return horarioModel::getHorarioIdModel();
		}

		public static function getHorarioNew($data){
			return horarioModel::getHorarioNewModel($data);
		}

		public static function getHorarioUpdate(){
			return horarioModel::getHorarioUpdateModel($data);
		}

		public function getHorarioDelete($data){
			return horarioController::getHorarioDeleteModel($data);
		}
	}
?>