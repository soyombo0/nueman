<?php
$assigneeId = null;

switch ($_GET['employee_id']) {
    case '8628293':
        $assigneeId = 4201;
        break;
    case '8417308':
        $assigneeId = 3891;
        break;
    case '8346323':
        $assigneeId = 3829;
        break;
    case '8756148':
        $assigneeId = 4519;
        break;
    case '2783898':
        $assigneeId = 319;
        break;
    case '8646278':
        $assigneeId = 4263;
        break;
}


$endpoint = "https://topkrovlya.bitrix24.ru/rest/4565/iodrozzf2mj0bszh/crm.deal.list.json";

$ch = curl_init();

$pr = array(
  'SELECT' => [
      'ID',
      'TITLE',
      'DATE_CREATE',
  ],
    'FILTER' => [
        '=%TITLE' => 'Прямой звонок на номер ОП 3531'
    ],
    'ORDER' => [
        'DATE_CREATE' => 'DESC',
    ],
);

$url = $endpoint . '?' . http_build_query($pr);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

$jsonResponse = json_decode($resp);
$dealId = $jsonResponse->result[0]->ID;

curl_exec($ch);

// update deal
if(isset($dealId)) {
    $endpoint = "https://topkrovlya.bitrix24.ru/rest/4565/iodrozzf2mj0bszh/crm.deal.update";
    $ch = curl_init();

    $paramsUpdate = array(
        'ID' => $dealId,
        'fields' => [
            'ASSIGNED_BY_ID' => 4201,
        ],
    );
    $url = $endpoint . '?' . http_build_query($paramsUpdate);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_close($ch);
}
