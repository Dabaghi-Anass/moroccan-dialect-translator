<?php
  $translateUri = "http://localhost:8080/translator/api/translate";
  $text = $_POST["text"];
  $from = $_POST["from"];
  $to = $_POST["to"];

  $data = array('text' => $text, 'from' => $from, 'to' => $to);
  $data_string = json_encode($data);

  $options = array(
    'http' => array(
      'header'  => "Content-Type: application/json\r\n" .
                   "Content-Length: " . strlen($data_string) . "\r\n",
      'method'  => 'POST',
      'content' => $data_string,
    ),
  );

  $context  = stream_context_create($options);
  $result = file_get_contents($translateUri, false, $context);
  echo $result;
?>