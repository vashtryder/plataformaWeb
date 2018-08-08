<?php
    class JsBase
    {
        public static function enlacesJs($enlaces)
        {
			$filename = array();

			switch ($enlaces) {
				case 'direccionPerfil':
				case 'tutorProceso':
   
				   $filename[] = 'director/profile.js';
				   break;
   
			   case 'tutorListaEstudiante':
			   case 'reporteGrado':
			   case 'tutorPerfil':
			   case 'reporteAula':
			   case 'reporteMerito':
			   case 'reporteRespuesta':
			   case 'reporteEstudiante':
			   case 'reporteGrupo':
			   case 'tutorSabana':
			   case 'tutorCuadro':
			   case 'direccionMatricula':
			   case 'tutorSemana':
			   case 'direccionSemana':
   
				   $filename[] = 'director/profile.js';
				   $filename[] = 'director/estudiante.js';
				   $filename[] = 'tutor/tutor.js';
   
				   break;
   
			   case 'direccionAsignacion':
				   $filename[] = 'director/asignacion.js';
				   $filename[] = 'director/profile.js';
				   break;
   
			   case 'direccionInstitucion':
				   $filename[] = 'director/institucion.js';
				   $filename[] = 'director/profile.js';
				   break;
   
			   case 'direccionDocente':
			   case 'direccionUsuario':
			   case 'direccionMensaje':
			   case 'tutorDocente':
			   case 'tutorMensajes':
				   $filename[] = 'director/personal.js';
				   $filename[] = 'director/profile.js';
				   break;
   
			   case 'direccionImportarEstudiante':
			   case 'administradorImportarEstudiante':
			   case 'administradorImportarDocente':
			   case 'administradorRespuesta':
				   $filename[] = 'admin/importar.js';
				   $filename[] = 'director/profile.js';
			   break;
   
			   case 'tutorHistoria':
				   $filename[] = 'tutor/historia.js';
				   $filename[] = 'director/profile.js';
			   break;
   
			   case 'administradorInstitucion':
				   $filename[] = 'admin/institucion.js';
				   $filename[] = 'admin/profile.js';
			   break;
   
			   case 'administradorMatricula':
				   $filename[] = 'admin/estudiante.js';
			   break;
   
			   case 'administradorAsignacion':
				   $filename[] = 'admin/asignacion.js';
				   $filename[] = 'admin/profile.js';
				   break;
   
			   case 'administradorGrado':
				   $filename[] = 'admin/grado.js';
				   $filename[] = 'admin/profile.js';
				   break;
   
			   case 'administradorSeccion':
				   $filename[] = 'admin/seccion.js';
				   $filename[] = 'admin/profile.js';
				   break;
   
			   case 'administradorNivel':
				   $filename[] = 'admin/nivel.js';
				   $filename[] = 'admin/profile.js';
				   break;
   
			   case 'administradorPeriodo':
				   $filename[] = 'admin/periodo.js';
				   $filename[] = 'admin/profile.js';
				   break;
   
			   case 'administradorArea':
				   $filename[] = 'admin/area.js';
				   $filename[] = 'admin/profile.js';
				   break;
   
			   case 'administradorCurso':
				   $filename[] = 'admin/curso.js';
				   $filename[] = 'admin/profile.js';
				   break;
			   case 'administradorDireccion':
			   case 'administradorTutor':
			   case 'administradorPadre':
				   $filename[] = 'admin/user.js';
				   $filename[] = 'admin/profile.js';
			   break;
   
			   case 'administradorProceso':
				   $filename[] = 'admin/proceso.js';
				   $filename[] = 'admin/profile.js';
				   break;
   
			   case 'administradorItem':
				   $filename[] = 'admin/item.js';
				   $filename[] = 'admin/profile.js';
			   break;
   
			   case 'direccionLogin':
				   $filename[] = 'director/login.js';
				   $filename[] = 'admin/profile.js';
			   break;
   
			   case 'administradorLogin':
				   $filename[] = 'admin/login.js';
				   $filename[] = 'admin/profile.js';
			   break;
   
			   case 'administradorAnio':
				   $filename[] = 'admin/anio.js';
				   $filename[] = 'admin/profile.js';
			   break;
   
			   case 'administradorDocente':
			   case 'administradorDatos':
			   case 'administradorMensaje':
			   case 'administradorPersonal':
				   $filename[] = 'admin/personal.js';
				   $filename[] = 'admin/profile.js';
			   break;
   
			   case 'padreLogin':
				   $filename[] = 'padre/login.js';
				   $filename[] = 'padre/profile.js';
			   break;
   
			   case 'administradorHorario':
				   $filename[] = 'admin/horario.js';
				   $filename[] = 'admin/profile.js';
				   break;
   
			   case 'direccionHorario':
				   $filename[] = 'director/horario.js';
				   $filename[] = 'director/profile.js';
				   break;
   
			   case 'tutorSemanaEta':
				   $filename[] = 'tutor/semana.js';
				   $filename[] = 'tutor/profile.js';
				   break;
   
			   case 'administradorSemanaEta':
				   $filename[] = 'admin/semana.js';
				   $filename[] = 'admin/profile.js';
				   break;
			   case 'administradorPreguntaEta':
				   $filename[] = 'admin/pregunta.js';
				   $filename[] = 'admin/profile.js';
			   break;
   
			   case 'administradorCalificacion':
				   $filename[] = 'admin/registroEta.js';
			   break;
   
			   case 'administradorEvento':
				   $filename[] = 'admin/evento.js';
			   break;
   
			   case 'administradorPerfil':
				   $filename[] = 'admin/profile.js';
			   break;
   
			   default:
				   $filename[] = 'director/login.js';
				   break;
			}
			
			$script = "";
			foreach ($filename as $value) {
				$script .= "<script src=\"Api/js/$value\" type=\"text/javascript\"></script>\n";
			}
			return $script;
        }
    }
?>