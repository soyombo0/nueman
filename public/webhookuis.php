<?php
ini_set('display_errors', 0);

$phone = $_GET['contact_phone_number'];
$managerPhone = $_GET['virtual_phone_number'];
$lastNumDigits = substr($managerPhone, 7);
$form = 'Звонок с номера ' . $phone;
$comment = 'Набранный номер: ' . $managerPhone;
$assigneeId = null;
$isLost = $_GET['is_lost'] ?? null;
$date = $_GET['notification_time'];
$duration = $_GET['total_time_duration']  ?? null;
$link = $_GET['record_file_links']  ?? null;

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
if(isset($link) || isset($isLost)) {

$regEndpoint = "https://topkrovlya.bitrix24.ru/rest/4565/iodrozzf2mj0bszh/telephony.externalcall.register.json";
$rCH = curl_init();

$rParams = array(
    'CRM_CREATE' => 1,
    'USER_ID' => $assigneeId,
    'TYPE' => 2,
    'USER_PHONE_INNER' => $managerPhone,
    'PHONE_NUMBER' => $phone,
    'CALL_START_DATE' => $date,
);
$rUrl = $regEndpoint . '?' . http_build_query($rParams);

curl_setopt($rCH, CURLOPT_URL, $rUrl);
curl_setopt($rCH, CURLOPT_RETURNTRANSFER, true);

$rResponse = curl_exec($rCH);
$jsonResponse = json_decode($rResponse);
$callId = $jsonResponse->result->CALL_ID;
$lead = $jsonResponse->result->CRM_CREATED_LEAD;
$entityId = $jsonResponse->result->CRM_CREATED_ENTITIES[1]->ENTITY_ID;

curl_close($rCH);

// update deal
if(isset($entityId)) {
    $endpoint = "https://topkrovlya.bitrix24.ru/rest/4565/iodrozzf2mj0bszh/crm.deal.update";
    $ch = curl_init();

    $paramsUpdate = array(
        'ID' => $entityId,
        'fields' => [
            'TITLE' => $form,
            'UF_CRM_1648718242' => 'unknown',
            'ASSIGNED_BY_ID' => $assigneeId,
            'STAGE_ID' => 1,
            'BEGINDATE' => $date,
            'COMMENTS' => $comment
        ],
    );
    $url = $endpoint . '?' . http_build_query($paramsUpdate);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_close($ch);
}

// finish call, since the webhook is triggered on finish call
    $finishCallEndpoint = "https://topkrovlya.bitrix24.ru/rest/4565/iodrozzf2mj0bszh/telephony.externalcall.finish.json";

    $fCH = curl_init();

    $fParams = array(
        'CALL_ID' => $callId,
        'USER_ID' => $assigneeId,
        'DURATION' => $duration
    );

    $fURL = $finishCallEndpoint . '?' . http_build_query($fParams);

    curl_setopt($fCH, CURLOPT_URL, $fURL);
    curl_setopt($fCH, CURLOPT_RETURNTRANSFER, true);

    curl_exec($fCH);

    curl_close($fCH);

// attach record to a deal
    $attachEndpoint = "https://topkrovlya.bitrix24.ru/rest/4565/iodrozzf2mj0bszh/telephony.externalcall.attachrecord.json";

    $aCH = curl_init();

    $aParams = array(
        'CALL_ID' => $callId,
        'FILENAME' => $date . '.mp3',
        'RECORD_URL' => $link
    );

    $aUrl = $attachEndpoint . '?' . http_build_query($aParams);

    curl_setopt($aCH, CURLOPT_URL, $aUrl);
    curl_setopt($aCH, CURLOPT_RETURNTRANSFER, true);

    curl_exec($aCH);

    curl_close($aCH);
}
