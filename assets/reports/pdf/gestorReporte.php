<?php
    require_once '../../Api/core/ControladorBase.php';
    require_once 'plugins/PHPTcpdf/tcpdf.php';

    $FONT_NAME        = TCPDF_FONTS::addTTFfont(K_PATH_FONTS . 'centuryGothic.ttf', 'TrueTypeUnicode', '', 32);
    $FONT_BOLD        = TCPDF_FONTS::addTTFfont(K_PATH_FONTS . 'CenturyGothicBold.ttf', 'TrueTypeUnicode', '', 32);
    $FONT_ITALIC      = TCPDF_FONTS::addTTFfont(K_PATH_FONTS . 'CenturyGothicItalic.ttf', 'TrueTypeUnicode', '', 32);
    $FONT_BOLD_ITALIC = TCPDF_FONTS::addTTFfont(K_PATH_FONTS . 'CenturyGothicItalic.ttf', 'TrueTypeUnicode', '', 32);

    define ('MARGIN_TOP', 20);
    define ('MARGIN_BOTTOM',15);
    define ('MARGIN_LEFT', 5);
    define ('MARGIN_RIGHT', 5);
    define ('FONT_NAME', $FONT_NAME);
    define ('FONT_BOLD', $FONT_BOLD);
    define ('FONT_ITALIC', $FONT_ITALIC);

    switch ($_SESSION['tutor']['grado']) {
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

    class MYPDF extends TCPDF
    {
        function Header()
        {
            // $institucion = GestorColegio::get_institucion();
            $logo = ROOT_IMG.'logo\\'.'logo360_menu.png';
            $this->SetXY(5,8);
            $this->Cell(40,4,"",0,0,'C'); # NOMBRE INTITUCION
            $this->SetXY(5,12);
            $this->SetFont(FONT_NAME,'',8);
            $this->Cell(40,4,(""),0,0,'C'); # DIRECCION
            $this->SetXY(5,16);
            $this->SetFont(FONT_NAME,'',8);
            $this->Cell(40,4,"",0,0,'C'); #TELEFONO

            $pos_logo = (PAGE_ORIENTATION == 'L') ? 245 : 155;
            $this->Image($logo,$pos_logo,3,50);
        }

        //Pie de página
        function Footer()
        {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont(FONT_NAME, 'I', 8);
            // Page number
            $this->Cell(0, 10, ('www.colegiodigital360.com'), 0, false, 'C', 0, '', 0, false, 'T', 'M');

            $this->setXY(5,-10);
            $this->SetFont(FONT_NAME, 'I', 8);
            $this->cell(0,10, date("Y-m-d H:i:s"), 0 , false, 'R');
        }

        public function color_celdas($valor1,$valor2,$valor3)
        {
            return $this->SetFillColor($valor1,$valor2,$valor3);
        }

        function Setheights($h)
        {
            $this->heights=$hr;
        }

        function SetWidths($w)
        {
            //Set the array of column widths
            $this->widths=$w;
        }

        function SetAligns($a)
        {
            //Set the array of column alignments
            $this->aligns=$a;
        }

        function SetFills($a)
        {
            //Set the array of column alignments
            $this->fills=$a;
        }

        function Setcolors($a)
        {
            //Set the array of column alignments
            $this->colors = $a;
        }


        function Row($data,$hr=false,$border=1)
        {
            $nb = $this->NbLines($data,$this->widths);
            if($hr === false){
                $nb = $this->NbLines($data,$this->widths);
                $h  = 5 * $nb;
            } else{
                $h=$hr;
            }

            $this->PageBreak($h);

            for($i=0;$i<count($data);$i++)
            {
                $w = $this->widths[$i];
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                $f = isset($this->fills[$i]) ? $this->fills[$i] : 0;
                //$c = isset($this->colors[$i]) ? $this->colors[$i] : array(255,255,255);
                $x = $this->GetX();
                $y = $this->GetY();

                //$this->SetFillColor($c[0],$c[1],$c[2]);

                $this->MultiCell($w,$h,$data[$i],$border, $a, $f, 0, '' ,'', true, 0, false, true, $h, 'M');
                $this->SetXY($x+$w,$y);
            }
            $this->Ln($h);
        }


        function Row_Colors($data,$hr=false,$border=1)
        {
            $nb = $this->NbLines($data,$this->widths);
            if($hr === false){
                $nb = $this->NbLines($data,$this->widths);
                $h  = 5 * $nb;
            } else{
                $h=$hr;
            }

            $this->PageBreak($h);

            for($i=0;$i<count($data);$i++)
            {
                $w = $this->widths[$i];
                $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                $f = isset($this->fills[$i]) ? $this->fills[$i] : 0;
                $c = isset($this->colors[$i]) ? $this->colors[$i] : array(255,255,255);
                $x = $this->GetX();
                $y = $this->GetY();

                $this->SetFillColor($c[0],$c[1],$c[2]);
                $this->MultiCell($w,$h,$data[$i],$border, $a, $f, 0, '' ,'', true, 0, false, true, $h, 'M');
                $this->SetXY($x+$w,$y);
            }
            $this->Ln($h);
        }

        function PageBreak($h)
        {
            if($this->GetY()+$h > $this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }

        function NbLines($data,$w)
        {
            for($i=0;$i<count($data);$i++){
                $l[$i]     = strlen($data[$i]);
                $a[$l[$i]] = $w[$i];
            }
            $altura = 1;
            $cl = max($l);
            if($cl > $a[$cl]) {
                $ce = abs($cl/$a[$cl]);
                $altura = 5*$ce;
            }
            return $altura;
        }
    }