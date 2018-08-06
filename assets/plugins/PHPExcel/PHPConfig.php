<?php

	$tutor = empty($_SESSION['tutor']['grado']) ? 0 : $_SESSION['tutor']['grado'];

    switch ($tutor) {
        case 1 : case 2: case 3:
            define ('ETA', 1);
            define ('ETA_TABLA', 'tb_eta_calificacion1');
            define ('ETA_RESPUESTA', 'tb_eta_respuesta1');
            break;
        case 5 : case 4:
            define ('ETA', 2);
            define ('ETA_TABLA', 'tb_eta_calificacion2');
            define ('ETA_RESPUESTA', 'tb_eta_respuesta2');
            break;
        default:
            break;
    }

	$objPHPExcel = new PHPExcel();

	/**
	 * [cellsToMergeByCols(3,2) => C2 ]
	 * @param  integer $start [Inicio de celda]
	 * @param  integer $row   [Fila de celda]
	 * @return [type]         [retorna matriz de celdas 1x1"]
	 */

	function cellsToMergeByCols($start = -1, $row = -1){
		$merge = 'A1'; # (0 , 1)
	    if($start>=0 && $row>=0){
	        $start = PHPExcel_Cell::stringFromColumnIndex($start);
	        $merge = "$start{$row}";
	    }
   	 	return $merge;
	}

	/**
	 * [cellsToMergeByColsRow(1,2,5) => B5:C5 ]
	 * @param  integer $start [Inicio de celda]
	 * @param  integer $end   [Fin de celda]
	 * @param  integer $row   [Fila de celda]
	 * @return [type]         [retorna matriz de celdas 2x1"]
	 */

	function cellsToMergeByColsRow($start = -1, $end = -1, $row = -1){
		$merge = 'A1:A1'; # (0 , 0 , 1)

	    if($start>=0 && $end>=0 && $row>=0){
	        $start = PHPExcel_Cell::stringFromColumnIndex($start);
	        $end = PHPExcel_Cell::stringFromColumnIndex($end);
	        $merge = "$start{$row}:$end{$row}";

	    }
   	 	return $merge;
	}

	/**
	 * [cellsToMergeByRowCols(0,2,5,7) => A5:B7 ]
	 * @param  integer $start [Inicio de celda]
	 * @param  integer $end   [Fin de celda]
	 * @param  integer $col   [Fila de celda]
	 * @param  integer $row   [Fila de celda]
	 * @return [type]         [retorna matriz de celdas 2x2"]
	 */
	function cellsToMergeByRowCols($start = -1, $end = -1, $col = -1, $row = -1){
		$merge = 'A1:A1'; # (0 , 0, 1 , 1)

	    if($start>=0 && $end>=0 && $row>=0 && $col>=0){
	        $start = PHPExcel_Cell::stringFromColumnIndex($start);
	        $end = PHPExcel_Cell::stringFromColumnIndex($end);
	        $merge = "$start{$col}:$end{$row}";

	    }
   	 	return $merge;
	}

	$titulo_uno = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 36
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	);

	$titulo_dos = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 18
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    )
	);

	$titulo_tres = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 12

	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
	);

	$titulo_cuatro = array(
	   'font' => array(
	        'bold' => true,
	        'size' => 12

	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'BFBFBF')
        )
	);

	$titulo_cinco = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 18
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    )
	);

	$option_uno = array(
	   'font' => array(
	        // 'bold' => true,
	        'size' => 12
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'BFBFBF')
        )
	);

	$option_dos = array(
	   'font' => array(
	        'bold' => true,
	        'size' => 12

	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
	);

	$option_tres = array(
	   'font' => array(
	        'bold' => true,
	        'size' => 12

	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'BFBFBF')
        )
	);

	$option_cuatro = array(
	   'font' => array(
	        'size' => 12
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
	);

	$encabezado_curso = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 12
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        // 'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFF')
        )
	);

	$celda_uno = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 10
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        // 'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFBC00')
        )
	);

	$celda_dos = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 10
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        // 'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'A2CF42')
        )
	);

	$celda_tres = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 10
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        // 'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
	);

	$celda_cuadro = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 10
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        // 'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'C6D9F1')
        )
	);

	$celda_quinto = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 10
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        // 'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '00B0F0')
        )
	);

	$titulo_vertical = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 9
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 90, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'BFBFBF')
        )
	);

	$titulo_horizontal = array(
	    'font' => array(
	        'bold' => true,
	        'size' => 12
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'rotation' => 0, //rotar string
	        'wrap' => true
	    ),
	    'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('argb' => '000')
			)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'BFBFBF')
        )
	);
?>