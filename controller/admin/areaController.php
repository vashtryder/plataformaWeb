<?php
	class areaController extends areaModel
	{
		public static function getArea(){
			return areaModel::getAreaModel();
		}

		public static function setArea($data){
			return areaModel::setAreaModel($data);
		}

		public static function getAreaId(){
			return areaModel::getAreaIdModel();
		}

		public static function getAreaNew($data){
			return areaModel::getAreaNewModel($data);
		}

		public static function getAreaUpdate($data){
			return areaModel::getAreaUpdateModel($data);
		}

		public static function getAreaDelete($data){
			return areaModel::getAreaDeleteModel($data);
		}
	}
?>