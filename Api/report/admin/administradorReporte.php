<?php
	include_once '../../core/ControladorBase.php';
	include_once "../../config/global.php";
	include_once "../../config/sistema.php";

	include_once ROOT_PHPEXCEL .'PHPExcel.php';
	
    function get_import_estudiante($data)
    {
        include_once ROOT_PHPEXCEL . 'PHPExcel\\IOFactory.php';

        $nombre_archivo = $archivo = $data[1]['name'];
        $destino        = ROOT_ARCHIVE . "bak_".$nombre_archivo;
        $c = $nroId = $nroLogin0 = 0;
        if (move_uploaded_file($data[1]['tmp_name'],$destino)){

            if (file_exists($destino)){

				$rows1 = estudianteController::getEstudianteId();
				$rows2 = fichaController::getFichaCodigo();
				$rows3 = fichaController::getFichaId();
				$rows4 = estudianteController::getEstudianteIdLogin();

                $objPHPExcel = PHPExcel_IOFactory::load($destino);
                $nroId     = $rows1[0];
                $codigoETA = $rows2[0];
                $nroficha  = $rows3[0];
                $nroLogin  = $rows4[0];

                $estudianteAnio  = $_SESSION['anio'][0];
                $estudianteFecha = date('Y-m-d');
                $estudianteHora  = date('h:m:s');

                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){

                    $worksheetTitle     = $worksheet->getTitle();
                    $highestRow         = $worksheet->getHighestRow();
                    $highestColumn      = $worksheet->getHighestColumn();
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

                    for ($row = 2; $row <= $highestRow; ++$row){

                        if(empty($worksheet->getCellByColumnAndRow(1, $row)->getValue())){

                            break;

                        } else {

                            $nroId++;
                            $nroficha++;
                            $codigoETA++;
                            $nroLogin++;

                            $dniAlternativo       = 10000000 + $nroId;

                            $estudianteId         = $nroficha;
                            $estudianteColegio    = $data[0];
                            $estudianteDni        = empty($worksheet->getCellByColumnAndRow(0, $row)->getValue()) ? $dniAlternativo : $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $estudiantePaterno    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $estudianteMaterno    = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $estudianteNombres    = $worksheet->getCellByColumnAndRow(3, $row)->getValue();


                            $estudianteSexo       = sistema::get_sexo($worksheet->getCellByColumnAndRow(7, $row)->getValue());
                            $estudianteDireccion  = empty($worksheet->getCellByColumnAndRow(8, $row)->getValue()) ? '' : $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                            $estudianteTelefono1  = empty($worksheet->getCellByColumnAndRow(9, $row)->getValue()) ? '' : $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                            $estudianteTelefono1  = empty($worksheet->getCellByColumnAndRow(10, $row)->getValue()) ? '' : $worksheet->getCellByColumnAndRow(10, $row)->getValue();

                            $celdaNacimiento      = empty($worksheet->getCellByColumnAndRow(11, $row)->getValue()) ? '2004-01-01' : $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                            // $timestamp         = PHPExcel_Shared_Date::ExcelToPHP($celdaNacimiento);
                            $estudianteNacimiento = $celdaNacimiento; //date('Y-m-d', $timestamp);

                            $estudianteCorreo     = empty($worksheet->getCellByColumnAndRow(12, $row)->getValue()) ? 'correo@servidor.com' : $worksheet->getCellByColumnAndRow(12, $row)->getValue();


                            $estudianteEdad       = ($celdaNacimiento == '') ? 0 : sistema::CalculaEdad($estudianteNacimiento);
                            $estudianteFoto       = sistema::get_info_foto_estudiante('',$estudianteSexo);

                            $celdagrado           = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                            $celdaseccion         = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                            $celdanivel           = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

							$row_g                = gradoController::setGradoAcademico($celdagrado);
							$row_s                = seccionController::setSeccionAcademico($celdaseccion);
							$row_n                = nivelController::setNivelAcademico($celdanivel);

                            $estudianteGrado      = $row_g[0];
                            $estudianteSeccion    = $row_s[0];
                            $estudianteNivel      = $row_n[0];

                            $data1 = $data2 = $data3 = array();
                            array_push($data1, $nroId);
                            array_push($data1, $estudianteColegio);
                            array_push($data1, $estudianteAnio);
                            array_push($data1, $estudiantePaterno);
                            array_push($data1, $estudianteMaterno);
                            array_push($data1, $estudianteNombres);
                            array_push($data1, $estudianteDni);
                            array_push($data1, $estudianteSexo);
                            array_push($data1, $estudianteEdad);
                            array_push($data1, $estudianteNacimiento);
                            array_push($data1, $estudianteDireccion);
                            array_push($data1, $estudianteTelefono1);
                            array_push($data1, $estudianteTelefono1);
                            array_push($data1, $estudianteCorreo);
                            array_push($data1, $estudianteFoto);

							$r1 = estudianteController::getEstudianteNew($data1);

                            array_push($data2, $nroficha);
                            array_push($data2, $estudianteColegio);
                            array_push($data2, $estudianteAnio);
                            array_push($data2, $nroId);
                            array_push($data2, $estudianteGrado);
                            array_push($data2, $estudianteSeccion);
                            array_push($data2, $estudianteNivel);
                            array_push($data2, 1000 + $codigoETA);
                            array_push($data2, 1);
                            array_push($data2, $estudianteFecha);
                            array_push($data2, $estudianteHora);

							$r2 = fichaController::getFichaNew($data2);

                            array_push($data3, $nroLogin);
                            array_push($data3, $estudianteColegio);
                            array_push($data3, $nroId);
                            array_push($data3, $estudianteDni);
                            array_push($data3, $estudianteDni);
                            array_push($data3, 1);

							$r3 = estudianteController::getEstudianteLoginNew($data3);

                            // print_r($r1);
                        }

                    }

                    print_r("Registros Insertados: ". $nroId);
                }

            } else {
                print_r(1);
            }

        } else {
            print_r(0);
        }
    }

    function get_export_estudiante()
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_PHPEXCEL .'PHPConfig.php';

        $arrayName = array('DNI','APELLIDO PATERNO','APELLIDO MATERNO','NOMBRE COMPLETO','GRADO','SECCIÓN','NIVEL','SEXO','DIRECCION','TELEFONO 1','TELEFONO 2','FECHA NACIMIENTO','EMAIL');
        $arraySize = array(15,30,30,30,24,24,24,45,15,15,45,6);

        foreach ($arrayName as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($key,1))->applyFromArray($titulo_horizontal);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($key)->setWidth($arraySize[$key]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($key,1, $value);
        }

        $nombreArchivo = "ETA_importar_estudiante.xlsx";
        require_once ROOT_PHPEXCEL .'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(ROOT_ARCHIVE  . $nombreArchivo);
        print_r(utf8_decode($nombreArchivo));
    }

    function get_import_docente($data)
    {
        include_once ROOT_PHPEXCEL .'PHPExcel\\IOFactory.php';

        $nombre_archivo = $archivo = $data[1]['name'];
        $destino        = ROOT_ARCHIVE  . "bak_".$nombre_archivo;
        $c = $nroId = $nroLogin0 = 0;
        if (move_uploaded_file($data[1]['tmp_name'],$destino)){

            if (file_exists ($destino)){

				$rows1 = docenteController::getPersonalId(); 
				$rows2 = docenteController::getPersonalLoginId();

                $objPHPExcel = PHPExcel_IOFactory::load($destino);
                $nroId       = $rows1[0];
                $nroLogin    = $rows2[0];

                $personalAnio  = $_SESSION['anio'][0];

                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){

                    $worksheetTitle     = $worksheet->getTitle();
                    $highestRow         = $worksheet->getHighestRow();
                    $highestColumn      = $worksheet->getHighestColumn();
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

                    for ($row = 2; $row <= $highestRow; ++$row){

                        if(empty($worksheet->getCellByColumnAndRow(1, $row)->getValue())){

                            break;

                        } else {

                            $c++;
                            $nroId++;
                            $nroLogin++;

                            $dniAlternativo     = 20000000 + $nroId;

                            $personalId         = $nroId;
                            $personalColegio    = $data[0];
                            $personalDni        = empty($worksheet->getCellByColumnAndRow(0, $row)->getValue()) ? $dniAlternativo : $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $personalPaterno    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $personalMaterno    = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $personalNombres    = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            $personalModulo     = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                            $personalSexo       = sistema::get_sexo($worksheet->getCellByColumnAndRow(5, $row)->getValue());

                            $personalDireccion  = empty($worksheet->getCellByColumnAndRow(6, $row)->getValue()) ? '' : $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                            $personalTelefono1  = empty($worksheet->getCellByColumnAndRow(7, $row)->getValue()) ? '' : $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                            $personalTelefono2  = empty($worksheet->getCellByColumnAndRow(8, $row)->getValue()) ? '' : $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                            $personalCorreo     = empty($worksheet->getCellByColumnAndRow(9, $row)->getValue()) ? 'correo@servidor.com' : $worksheet->getCellByColumnAndRow(9, $row)->getValue();

                            $celdaNacimiento    = empty($worksheet->getCellByColumnAndRow(10, $row)->getValue()) ? '2002-01-01' : $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                            $personalNacimiento = date('Y-m-d', $celdaNacimiento);


                            $personalFoto       = sistema::get_info_foto_personal('',$personalSexo);

							$row3               = moduloController::setModuloPersonal($personalModulo);
                            $personalModulo     = $row3[0];

                            $data1 = array();
                            array_push($data1, $personalId );
                            array_push($data1, $personalColegio);
                            array_push($data1, $personalAnio);
                            array_push($data1, $personalPaterno);
                            array_push($data1, $personalMaterno);
                            array_push($data1, $personalNombres);
                            array_push($data1, $personalDni);
                            array_push($data1, $personalSexo);
                            array_push($data1, $personalCorreo);
                            array_push($data1, $personalDireccion);
                            array_push($data1, $personalTelefono1);
                            array_push($data1, $personalTelefono2);
                            array_push($data1, $personalNacimiento);
                            array_push($data1, $personalFoto);

							$r1 = docenteController::getPersonalNew($data1); 


                            $data2 = array();
                            array_push($data2, $nroLogin);
                            array_push($data2, $personalId);
                            array_push($data2, $personalModulo);
                            array_push($data2, $personalDni);
                            array_push($data2, $personalDni);
                            array_push($data2, 1);

							$r2 = docenteController::getPersonalLoginNew($data2);

                        }

                    }

                    print_r("Registros Insertados: ". $c);
                }

            } else {
                print_r(2);
            }

        } else {
            print_r(0);
        }
    }

    function get_export_docente()
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_PHPEXCEL .'PHPConfig.php';

        $arrayName = array('DNI','APELLIDO PATERNO','APELLIDO MATERNO','NOMBRE COMPLETO','CARGO','DIRECCION','TELEFONO 1','TELEFONO 2','EMAIL','SEXO');
        $arraySize = array(15,30,30,30,25,45,15,15,45,6);

        foreach ($arrayName as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($key,1))->applyFromArray($titulo_dos);
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($key)->setWidth($arraySize[$key]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($key,1, $value);
        }

        $nombreArchivo = "ETA_importar_docente.xlsx";
        require_once ROOT_PHPEXCEL .'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(ROOT_ARCHIVE  . $nombreArchivo);
        print_r(utf8_decode($nombreArchivo));
    }

    function get_export_respuesta($data){
        $objPHPExcel = new PHPExcel();
        include_once ROOT_PHPEXCEL .'PHPConfig.php';

        list($colegio,$unidad,$semana,$eta,$grado,$seccion,$nivel,$anio) = $data;

        if($eta[0] == 1){
            $respuestas = 40;
            $tabla = 'tb_eta_respuesta1';
        } else{
            $respuestas = 30;
            $tabla = 'tb_eta_respuesta2';
        }

		$r_respuesta =  respuestaEtaController::getRespuestaEtaId($tabla);
		$r_registro  = 	registroEtaController::getRegistroEtaAula(array($grado,$seccion,$nivel,$colegio,$anio,$semana));

        if($r_registro){
            $arrayName = array('ID',"COD.\nREGISTO","COD.\nCOLEGIO","GRUPO\nETA");
            $arraySize = array(10,15,15,15);

            for ($i=1; $i<=$respuestas; $i++) {
                array_push($arrayName,'R'.$i);
                array_push($arraySize,7);
            }

            foreach ($arrayName as $key => $value) {
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($key,1))->applyFromArray($titulo_cinco);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($key)->setWidth($arraySize[$key]);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($key,1, $value);
            }

            $arrayData = $arrayName = array($r_respuesta[0]+1,$r_registro[0],$colegio,$eta[0]);

            foreach ($arrayData as $key => $value) {
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($key,2))->applyFromArray($titulo_cuatro);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($key,2, $value);
            }

			list( $idGrado, $nombreGrado)     = gradoController::setGrado($grado);
			list( $idSeccion, $nombreSeccion) = seccionController::setSeccion($seccion);
			list( $idNivel, $nombreNivel)     = nivelController::setNivel($nivel);

            $nombreArchivo = "respuesta_".$nombreGrado."_".$nombreSeccion."_".$nombreNivel.".xlsx";
            require_once ROOT_PHPEXCEL .'PHPExcel\\IOFactory.php';
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save(ROOT_ARCHIVE . $nombreArchivo);
            print_r($nombreArchivo);

        } else {
            print_r(0);
        }
    }

    function get_import_respuesta($data){

        include_once ROOT_PHPEXCEL .'PHPExcel\\IOFactory.php';

        $nombre_archivo = $archivo = $data[1]['name'];
        $destino        = ROOT_ARCHIVE . $nombre_archivo;


        if (move_uploaded_file($data[1]['tmp_name'],$destino)){

            if (file_exists ($destino)){

                $objPHPExcel = PHPExcel_IOFactory::load($destino);

                $rowRespuesta = array();

                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){

                    $worksheetTitle     = $worksheet->getTitle();
                    $highestRow         = $worksheet->getHighestRow();
                    $highestColumn      = $worksheet->getHighestColumn();
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

                    for ($row = 2; $row <= $highestRow; ++$row){

                        if(empty($worksheet->getCellByColumnAndRow(1, $row)->getValue())){

                            break;

                        } else {

                            $rowId       = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $rowRegistro = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $rowColegio  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $rowGrupoEta = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            $rowAnio     = $_SESSION['anio'][0];

                            if($rowGrupoEta == 1){
                                $respuestas = 40;
                                $tabla = 'sp_eta_respuesta_1';
                            } else {
                                $respuestas = 30;
                                $tabla = 'sp_eta_respuesta_2';
                            }

                            $celda = 3;
                            for ($i=1; $i<=$respuestas; $i++) {
                                $celda++;
                                $rowRespuesta[$i] = $worksheet->getCellByColumnAndRow($celda, $row)->getValue();
                            }

                            $data1 = array($rowId,$rowRegistro,$rowColegio,$rowAnio);
                            for ($i=1; $i<=$respuestas; $i++) {
                                array_push($data1, $rowRespuesta[$i] );
                            }

							$r = respuestaEtaController::getRespuestaEtaNew($data1,$respuestas,$tabla);

                            // print_r($r);
                        }

                    }

                    ($r !== false) ? print_r(1) : print_r(0);
                }

            } else {
                print_r(2);
            }

        } else {
            print_r(0);
        }
    }

?>
