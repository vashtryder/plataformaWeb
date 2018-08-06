<?php
	class Sistema
	{
        public static function a_romano($integer, $upcase = true)
        {
            $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100,
                           'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9,
                           'V'=>5, 'IV'=>4, 'I'=>1);
            $return = '';
            while($integer > 0)
            {
                foreach($table as $rom=>$arb)
                {
                    if($integer >= $arb)
                    {
                        $integer -= $arb;
                        $return .= $rom;
                        break;
                    }
                }
            }

            if ($upcase==false) $return = strtolower($return);

            return $return;
        }

        public static function CalculaEdad( $fecha='' ) {
            list($Y,$m,$d) = explode("-",$fecha);
            return(date("Y")-$Y);
        }

        public static function cerosNumero($data=''){
            $ln = strlen($data);
            if($ln>=2){
                return $data;
            } else{
                return '0'.$data;
            }
         }

        public static function enlaceController()
        {
			require_once 'routes.php';
			$enlace = empty($_GET['s']) ? 'direccionLogin' : $_GET['s'];
            include EnlacesModels::enlacesModel($enlace);
        }

        public static  function get_info_foto_personal($foto='',$sexo='')
        {
            if(empty($foto)){
                switch ($sexo) {
                    case 'M':
                        $avatar = "fotoDocente2.png";
                        break;
                    case 'F':
                        $avatar = "fotoDocente1.png";
                        break;
                    default:
                        $avatar = "fotoDocente2.png";
                    break;
                }
            }else{
                $avatar = $foto;
            }

            return $avatar;
        }

        public static function get_info_foto_estudiante($foto='',$sexo='')
        {

            if(empty($foto)){
                switch ($sexo) {
                    case '1':
                        $avatar = "estudiante1.png";
                        break;
                    case '2':
                        $avatar = "estudiante2.png";
                        break;
                    default:
                        $avatar = "estudiante1.png";
                        break;
                }
            }else{
                $avatar = $foto;
            }

            return $avatar;
        }

        public static function sumaDiaSemana($fechaA,$fechaB){
            $suma = 0;
            $fecha1 = strtotime($fechaA);
            $fecha1= strtotime('+1 day ' . date('Y-m-d',$fecha1));
            $fecha2 = strtotime($fechaB);
            for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){
                if((strcmp(date('D',$fecha1),'Sun')!=0) && (strcmp(date('D',$fecha1),'Sat')!=0)){
                    $suma++;
                }
            }
            return $suma;
        }

        public static function imprimirTiempo($fecha,$hora){
            $start_date = new DateTime($fecha." ".$hora);
            $since_start = $start_date->diff(new DateTime(date("Y-m-d")." ".date("H:i:s")));
            $message = "Hace ";

            if($since_start->y==0){
                if($since_start->m==0){
                    if($since_start->d==0){
                       if($since_start->h==0){
                           if($since_start->i==0){
                              if($since_start->s==0){
                                 $message .= $since_start->s.' segundos';
                              }else{
                                  if($since_start->s==1){
                                     $message .= $since_start->s.' segundo';
                                  }else{
                                     $message .= $since_start->s.' segundos';
                                  }
                              }
                           }else{
                              if($since_start->i==1){
                                  $message .= $since_start->i.' minuto';
                              }else{
                                $message .= $since_start->i.' minutos';
                              }
                           }
                       }else{
                          if($since_start->h==1){
                            $message .=  $since_start->h.' hora';
                          }else{
                            $message .= $since_start->h.' horas';
                          }
                       }
                    }else{
                        if($since_start->d==1){
                            $message .= $since_start->d.' día';
                        }else{
                            $message .= $since_start->d.' días';
                        }
                    }
                }else{
                    if($since_start->m==1){
                       $message .= $since_start->m.' mes';
                    }else{
                        $message .= $since_start->m.' meses';
                    }
                }
            }else{
                if($since_start->y==1){
                    $message .= $since_start->y.' año';
                }else{
                    $message .= $since_start->y.' años';
                }
            }

            return $message;
        }

        public static function imprimirTiempoCorto($fecha,$hora){
            $start_date = new DateTime($fecha." ".$hora);
            $since_start = $start_date->diff(new DateTime(date("Y-m-d")." ".date("H:i:s")));
            $message = "";

            if($since_start->y==0){
                if($since_start->m==0){
                    if($since_start->d==0){
                       if($since_start->h==0){
                           if($since_start->i==0){
                              if($since_start->s==0){
                                 $message .= $since_start->s.' seg';
                              }else{
                                  if($since_start->s==1){
                                     $message .= $since_start->s.' seg';
                                  }else{
                                     $message .= $since_start->s.' segs';
                                  }
                              }
                           }else{
                              if($since_start->i==1){
                                  $message .= $since_start->i.' min';
                              }else{
                                $message .= $since_start->i.' mins';
                              }
                           }
                       }else{
                          if($since_start->h==1){
                            $message .=  $since_start->h.' hr';
                          }else{
                            $message .= $since_start->h.' hrs';
                          }
                       }
                    }else{
                        if($since_start->d==1){
                            $message .= $since_start->d.' día';
                        }else{
                            $message .= $since_start->d.' días';
                        }
                    }
                }else{
                    if($since_start->m==1){
                       $message .= $since_start->m.' mes';
                    }else{
                        $message .= $since_start->m.' meses';
                    }
                }
            }else{
                if($since_start->y==1){
                    $message .= $since_start->y.' año';
                }else{
                    $message .= $since_start->y.' años';
                }
            }

            return $message;
        }


        public static function Error($mensaje=''){
            include ROOT_HTML.'sesion.html.php';
            die();
        }

        public static function Hay_sesion(){
            return ($_SESSION["idmodulo"]) ? true : false;
        }

        public static function dia_anterior($fecha) {
            $sol = (strtotime($fecha) - 3600);
            return date('Y-m-d', $sol);
        }

		public static function imprimir($value=''){
            print_r($value);
        }

        public static function substr($cadena, $valor)
        {
            return utf8_encode(mb_strcut($cadena, 0, $valor));
        }

	 	public static function calculaFecha($modo,$valor,$fecha_inicio=false){
			if($fecha_inicio!=false) {
				$fecha_base = strtotime($fecha_inicio);
			}else {
				$time=time();
				$fecha_actual=date("Y-m-d",$time);
				$fecha_base=strtotime($fecha_actual);
			}
			$calculo = strtotime("$valor $modo","$fecha_base");
			return date("Y-m-d", $calculo);
		}

		public static function calcularDias($fecha_inicio=false, $fecha_final=false)
		{
			if($fecha_inicio!=false) {
				$fecha_base_inicio = strtotime($fecha_inicio);
				$fecha_base_final = strtotime($fecha_final);
			}else {
				$time=time();
				$fecha_actual=date("Y-m-d",$time);
				$fecha_base_inicio=strtotime($fecha_actual);
				$fecha_base_final = calculaFecha("days",1,$fecha_base_inicio);
			}
			$dias = ($fecha_base_inicio-$fecha_base_final)/86400;
			$dias = abs($dias);
			$dias = floor($dias);
			return $dias;
		}

		public static function formato_fecha($fecha_)
        {
			$date    = date_create($fecha_);
            $dias    = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
			$meses   = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$dt_dia  = $dias[date_format($date, 'w')];
            $mes     = $meses[date_format($date, 'n')-1];
			$nro_dia = date_format($date, 'd');
			$anio    = date_format($date, 'Y');
	        return $dt_dia.", ".$nro_dia." de ".$mes." del ".$anio;
	    }

        public static function formato_fecha_corta($fecha_, $upcase = true)
        {
            $date    = date_create($fecha_);
            $dias    = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
            $meses   = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $dt_dia  = $dias[date_format($date, 'w')];
            $mes     = $meses[date_format($date, 'n')-1];
            $nro_dia = date_format($date, 'd');
            $anio    = date_format($date, 'Y');

            $mes = ($upcase === true) ? strtoupper($mes) : strtolower($mes);

            return $nro_dia." ".$mes;
        }

       	public static function formato_hora($hora,$tipo=false)
       	{
			$h     =  date('H',strtotime($hora));
			$m     =  date('m',strtotime($hora));
			$s     =  date('s',strtotime($hora));

        if($tipo!=false){
		    $fecha = date( "h:i A", strtotime($hora));
		} else {
            $fecha = date( "H:i", strtotime($hora));
        }
        return $fecha;
       	}

       	public static function set_fecha($ahora)
       	{
			$d     =  date('d',strtotime($ahora));
			$m     =  date('m',strtotime($ahora));
			$a     = date('Y',strtotime($ahora));
			$mes   = $m;
			$fecha = $d.' / '.$mes.' / '.$a;
          	return $fecha;
       	}

       	public static function get_fecha($ahora)
       	{
          	$d =  date('d',strtotime($ahora));
          	$m =  date('n',strtotime($ahora));
          	$a =  date('Y',strtotime($ahora));
          	$mes = $m;
          	$fecha = $d.'-'.$m.'-'.$a;
          	return $fecha;
       	}

        public static function cambiarFecha($fechaCambio)
        {
            $aux_fecha = explode('/',$fechaCambio);
            $fecha = $aux_fecha[2]."-".$aux_fecha[1]."-".$aux_fecha[0];
            return $fecha;
        }

        public static function generar_password()
        {
            $str = "abcdefghijklmnopqrstuvwxyz1234567890";
            $cad = "";
            for($i=0;$i<20;$i++){
                $cad .= substr($str,rand(0,64),1);
            }
            return $cad;
        }

        public static function get_porcentaje($subtotal='',$total='')
        {
            $t = ($total == 0) ? 1 : $total;
            $s = ($subtotal == 0) ? 0 : $subtotal;
            $p = ($s*100)/$t;
            return round($p,1);
        }

        public static function get_format_cero($number='')
        {
            $str            = strlen($number);
            $insertar_ceros = '0';
            $numero         = ($str < 2) ? $insertar_ceros.= $number : $number;
            return $numero;
        }

        public static function get_format_string($cadena='')
        {
            $parte = explode(" ",$cadena);
            if(count($parte) == 1){
                $value = sistema::substr($parte[0],4);
            }else{
                $value = "";
                for ($i=0; $i < count($parte); $i++) {
                    $value .= ucfirst(sistema::substr($parte[$i],1));
                }
            }

            return $value;
        }

        public static function get_sexo($value='')
        {
            switch ($value) {
                case 'M': case 'm': case 'masculino':
                    $sexo = 1;
                    break;
                case 'F': case 'f': case 'femenino':
                    $sexo = 2;
                    break;

                default:
                    $sexo = 1;
                    break;
            }

            return $sexo;
        }

        public static function set_sexo($value='')
        {
            switch ($value) {
                case 1:
                    $sexo = 'Masculino';
                    break;
                case 2:
                    $sexo = 'Femenino';
                    break;

                default:
                    $sexo = 'Masculino';
                    break;
            }

            return $sexo;
        }

	} # end class
?>