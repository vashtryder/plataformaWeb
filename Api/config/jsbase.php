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
				   $filename[] = 'administrador/importar.js';
				   $filename[] = 'director/profile.js';
			   break;
   
			   case 'tutorHistoria':
				   $filename[] = 'tutor/historia.js';
				   $filename[] = 'director/profile.js';
			   break;
   
			   case 'administradorInstitucion':
				   $filename[] = 'administrador/institucion.js';
				   $filename[] = 'administrador/profile.js';
			   break;
   
			   case 'administradorMatricula':
				   $filename[] = 'administrador/estudiante.js';
			   break;
   
			   case 'administradorAsignacion':
				   $filename[] = 'administrador/asignacion.js';
				   $filename[] = 'administrador/profile.js';
				   break;
   
			   case 'administradorGrado':
				   $filename[] = 'administrador/grado.js';
				   $filename[] = 'administrador/profile.js';
				   break;
   
			   case 'administradorSeccion':
				   $filename[] = 'administrador/seccion.js';
				   $filename[] = 'administrador/profile.js';
				   break;
   
			   case 'administradorNivel':
				   $filename[] = 'administrador/nivel.js';
				   $filename[] = 'administrador/profile.js';
				   break;
   
			   case 'administradorPeriodo':
				   $filename[] = 'administrador/periodo.js';
				   $filename[] = 'administrador/profile.js';
				   break;
   
			   case 'administradorArea':
				   $filename[] = 'administrador/area.js';
				   $filename[] = 'administrador/profile.js';
				   break;
   
			   case 'administradorCurso':
				   $filename[] = 'administrador/curso.js';
				   $filename[] = 'administrador/profile.js';
				   break;
			   case 'administradorDireccion':
			   case 'administradorTutor':
			   case 'administradorPadre':
				   $filename[] = 'administrador/user.js';
				   $filename[] = 'administrador/profile.js';
			   break;
   
			   case 'administradorProceso':
				   $filename[] = 'administrador/proceso.js';
				   $filename[] = 'administrador/profile.js';
				   break;
   
			   case 'administradorItem':
				   $filename[] = 'administrador/item.js';
				   $filename[] = 'administrador/profile.js';
			   break;
   
			   case 'direccionLogin':
				   $filename[] = 'director/login.js';
				   $filename[] = 'administrador/profile.js';
			   break;
   
			   case 'administradorLogin':
				   $filename[] = 'administrador/login.js';
				   $filename[] = 'administrador/profile.js';
			   break;
   
			   case 'administradorAnio':
				   $filename[] = 'administrador/anio.js';
				   $filename[] = 'administrador/profile.js';
			   break;
   
			   case 'administradorDocente':
			   case 'administradorDatos':
			   case 'administradorMensaje':
			   case 'administradorPersonal':
				   $filename[] = 'administrador/personal.js';
				   $filename[] = 'administrador/profile.js';
			   break;
   
			   case 'padreLogin':
				   $filename[] = 'padre/login.js';
				   $filename[] = 'padre/profile.js';
			   break;
   
			   case 'administradorHorario':
				   $filename[] = 'administrador/horario.js';
				   $filename[] = 'administrador/profile.js';
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
				   $filename[] = 'administrador/semana.js';
				   $filename[] = 'administrador/profile.js';
				   break;
			   case 'administradorPreguntaEta':
				   $filename[] = 'administrador/pregunta.js';
				   $filename[] = 'administrador/profile.js';
			   break;
   
			   case 'administradorCalificacion':
				   $filename[] = 'administrador/registroEta.js';
			   break;
   
			   case 'administradorEvento':
				   $filename[] = 'administrador/evento.js';
			   break;
   
			   case 'administradorPerfil':
				   $filename[] = 'administrador/profile.js';
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