<?php
    require dirname(__FILE__) . '/utils.php';

    // Short-circuit if the client did not give us a date range.
    if (!isset($_GET['start']) || !isset($_GET['end'])) {
      die("Please provide a date range.");
    }

    // Parse the start/end parameters.
    // These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
    // Since no timezone will be present, they will parsed as UTC.
    $range_start = parseDateTime($_GET['start']);
    $range_end = parseDateTime($_GET['end']);

    // Parse the timezone parameter if it is present.
    $timezone = null;
    if (isset($_GET['timezone'])) {
      $timezone = new DateTimeZone($_GET['timezone']);
    }

    // Read and parse our events JSON file into an array of event data arrays.
    // $json = file_get_contents(dirname(__FILE__) . 'EVA/view/core/json/events.json');

    include('../../../conf.ini.php');
    $rs = gestorEvento::get_evento();
    $arrayJson = array();
    foreach($rs as $row){
        $arrayJson[] = array(
            'id'          => $row[0],
            'title'       => $row[1],
            'description' => $row[2],
            'location'    => $row[3],
            'contact'     => $row[4],
            'url'         => $row[5],
            'start'       => $row[6],
            'end'         => $row[7],
            'className'   => ($row[4] == 'media') ? "m-fc-event--success" : "m-fc-event--accent",
        );
    }

    $input_arrays = json_decode(json_encode($arrayJson), true);

    // Accumulate an output array of event data arrays.
    $output_arrays = array();
    foreach ($input_arrays as $array) {

      // Convert the input array into a useful Event object
      $event = new Event($array, $timezone);

      // If the event is in-bounds, add it to the output
      if ($event->isWithinDayRange($range_start, $range_end)) {
        $output_arrays[] = $event->toArray();
      }
    }

    // Send JSON to the client.
    echo json_encode($output_arrays);
?>