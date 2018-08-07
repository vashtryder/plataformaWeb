<?php 
	include_once "Api/core/ControladorBase.php";

	class GestorHistoriaEta
	{
		public static function newHistoriaAjax()
        {
            $data  = array();

            if($_REQUEST['end'] == $_REQUEST['start']){
                $start = $_REQUEST['start'];
                $end   = strtotime ( '+1 day' , strtotime ( $start ) ) ;
                $end   = date ( 'Y-m-d' , $end );
            } else {
                $start = $_REQUEST['start'];
                $end   = $_REQUEST['end'];
            }

            array_push($data,$_FILES['file']);
            array_push($data,$_REQUEST['title']);
            array_push($data,$start);
            array_push($data,$end);
            return historiaEtaController::getHistoriaEtaNew($data);
        }

        public static function updateHistoriaAjax()
        {
            $data = array();
            if( !empty($_FILES['file']['name'])){

                if($_REQUEST['end'] == $_REQUEST['start']){
                    $start = $_REQUEST['start'];
                    $end   = strtotime ( '+1 day' , strtotime ( $start ) ) ;
                    $end   = date ( 'Y-m-d' , $end );
                } else {
                    $start = $_REQUEST['start'];
                    $end   = $_REQUEST['end'];
                }

                array_push($data,$_FILES['file']);
                array_push($data,$_REQUEST['title']);
                array_push($data,$start);
                array_push($data,$end);
				array_push($data,$_REQUEST['id']);
				
				return historiaEtaController::getHistoriaEtaUpdate($data);

            } else {

                if($_REQUEST['end'] == $_REQUEST['start']){
                    $start = $_REQUEST['start'];
                    $end   = strtotime ( '+1 day' , strtotime ( $start ) ) ;
                    $end   = date ( 'Y-m-d' , $end );
                } else {
                    $start = $_REQUEST['start'];
                    $end   = $_REQUEST['end'];
                }

				array_push($data,$_REQUEST['title']);
				array_push($data,$_REQUEST['description']);
                array_push($data,$start);
                array_push($data,$end);
				array_push($data,$_REQUEST['id']);
				
				return historiaEtaController::getHistoriaEtaUpdateSimple($data);
            }
        }

        public static function deleteHistoriaAjax()
        {
			return historiaEtaController::getHistoriaEtaDelete($_REQUEST['id']);
        }  
	}

	if(isset($_REQUEST["new_historia"])){
		GestorHistoriaEta::newHistoriaAjax();
    } else if(isset($_REQUEST["update_historia"])){
        GestorHistoriaEta::updateHistoriaAjax();
    } else if(isset($_REQUEST["delete_historia"])){
        GestorHistoriaEta::deleteHistoriaAjax();
    }
?>