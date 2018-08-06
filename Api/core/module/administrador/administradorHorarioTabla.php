<?php
    require_once '../../../conf.ini.php';
    // include_once 'class-list-util.php';
    $rs = gestorHorario::get_horario();
    $return_arr    = array();
    foreach ($rs as $rows){
        $row1 = gestorColegio::set_colegio($rows[1]);
        $row2 = gestorPersonal::set_personal($rows[2]);
        $row3 = gestorCurso::set_curso($rows[4]);
        $row4 = gestorGrado::set_grado($rows[5]);
        $row5 = gestorSeccion::set_seccion($rows[6]);
        $row6 = gestorNivel::set_nivel($rows[7]);

        $row_array['id']      = $rows[0];
        $row_array['docente'] = $row2[3]." ".$row2[4]." ".$row2[5];
        $row_array['curso']   = $row3[3];
        $row_array['aula']    = $row4[1]." ".$row5[1]." ".$row6[1];
        $row_array['colegio'] = $row1[1];
        array_push($return_arr,$row_array);
    }

    $data = json_decode( json_encode($return_arr) );

    $datatable = ! empty( $_REQUEST[ 'datatable' ] ) ? $_REQUEST[ 'datatable' ] : array();
    $datatable = array_merge( array( 'pagination' => array(), 'sort' => array(), 'query' => array() ), $datatable );

    // search filter by keywords
    $filter = isset( $datatable[ 'query' ][ 'generalSearch' ] ) && is_string( $datatable[ 'query' ][ 'generalSearch' ] ) ? $datatable[ 'query' ][ 'generalSearch' ] : '';
    if ( ! empty( $filter ) ) {
        $data = array_filter( $data, function ( $a ) use ( $filter ) {
            return (boolean)preg_grep( "/$filter/i", (array)$a );
        } );
        unset( $datatable[ 'query' ][ 'generalSearch' ] );
    }

    // filter by field query
    $query = isset( $datatable[ 'query' ] ) && is_array( $datatable[ 'query' ] ) ? $datatable[ 'query' ] : null;
    if ( is_array( $query ) ) {
        $query = array_filter( $query );
        foreach ( $query as $key => $val ) {
            $data = list_filter( $data, array( $key => $val ) );
        }
    }

    $sort  = ! empty( $datatable[ 'sort' ][ 'sort' ] ) ? $datatable[ 'sort' ][ 'sort' ] : 'asc';
    $field = ! empty( $datatable[ 'sort' ][ 'field' ] ) ? $datatable[ 'sort' ][ 'field' ] : 'RecordID';

    $meta    = array();
    $page    = ! empty( $datatable[ 'pagination' ][ 'page' ] ) ? (int)$datatable[ 'pagination' ][ 'page' ] : 1;
    $perpage = ! empty( $datatable[ 'pagination' ][ 'perpage' ] ) ? (int)$datatable[ 'pagination' ][ 'perpage' ] : -1;

    $pages = 1;
    $total = count( $data ); // total items in array

    // sort
    usort( $data, function ( $a, $b ) use ( $sort, $field ) {
        if ( ! isset( $a->$field ) || ! isset( $b->$field ) ) {
            return false;
        }

        if ( $sort === 'asc' ) {
            return $a->$field > $b->$field ? true : false;
        }

        return $a->$field < $b->$field ? true : false;
    } );

    // $perpage 0; get all data
    if ( $perpage > 0 ) {
        $pages  = ceil( $total / $perpage ); // calculate total pages
        $page   = max( $page, 1 ); // get 1 page when $_REQUEST['page'] <= 0
        $page   = min( $page, $pages ); // get last page when $_REQUEST['page'] > $totalPages
        $offset = ( $page - 1 ) * $perpage;
        if ( $offset < 0 ) {
            $offset = 0;
        }

        $data = array_slice( $data, $offset, $perpage, true );
    }

    $meta = array(
        'page'    => $page,
        'pages'   => $pages,
        'perpage' => $perpage,
        'total'   => $total,
    );


    // if selected all records enabled, provide all the ids
    if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
        $meta['rowIds'] = array_map(function ($row) {
            return $row->RecordID;
        }, $alldata);
    }


    header( 'Content-Type: application/json' );
    header( 'Access-Control-Allow-Origin: *' );
    header( 'Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS' );
    header( 'Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description' );

    $result = array(
        'meta' => $meta + array(
                'sort'  => $sort,
                'field' => $field,
            ),
        'data' => $data
    );

    sistema::imprimir(json_encode( $result, JSON_PRETTY_PRINT ));
?>