<?php

$managerPhone = $_POST['callee'];
$caller = $_POST['caller'];
$visitId = $_POST['visit_id'];
$date = $_POST['date'];
$landingPage = $_POST['landing_page'];
$referrer = $_POST['referrer'];
$marker = $_POST['marker'];
$utmCampaign = $_POST['utm_campaign'];
$utmMedium = $_POST['utm_medium'];
$utmSource = $_POST['utm_source'];
$utmTerm = $_POST['utm_term'];
$utmContent = $_POST['utm_content'];
$link = $_POST['link'];
$duration = $_POST['duration'];
$assigneeId = null;

switch ($managerPhone) {
    case '79251035121':
        $assigneeId = 640;
        break;
    case '79262097923':
        $assigneeId = 4;
        break;
    case '79250077127':
        $assigneeId = 9;
        break;
    case '79251702127':
        $assigneeId = 566;
        break;
}

$registerCallEndpoint = "https://bitrix.5-stars.org/rest/151/2amhtycf6hp51dyf/telephony.externalcall.register.json";
$rCH = curl_init();

$rParams = array(
    'CRM_CREATE' => 1,
    'USER_ID' => $assigneeId,
    'TYPE' => 2,
    'USER_PHONE_INNER' => $managerPhone,
    'PHONE_NUMBER' => $caller,
    'CALL_START_DATE' => $date,
);
$rUrl = $registerCallEndpoint . '?' . http_build_query($rParams);

curl_setopt($rCH, CURLOPT_URL, $rUrl);
curl_setopt($rCH, CURLOPT_RETURNTRANSFER, true);

$rResponse = curl_exec($rCH);
$jsonResponse = json_decode($rResponse);
$callId = $jsonResponse->result->CALL_ID;
$lead = $jsonResponse->result->CRM_CREATED_LEAD;
$entityId = $jsonResponse->result->CRM_CREATED_ENTITIES[1]->ENTITY_ID;

print_r($jsonResponse);

curl_close($rCH);

// update deal
if(isset($entityId)) {
    $endpoint = "https://bitrix.5-stars.org/rest/151/by05msgbx9kiy6z7/crm.deal.update";
    $ch = curl_init();

    $paramsUpdate = array(
        'ID' => $entityId,
        'fields' => [
            'TITLE' => 'Звонок от ' . $caller,
            'UF_CRM_1720623033' => $visitId,
            'ASSIGNED_BY_ID' => $assigneeId,
            'STAGE_ID' => "NEW",
            'BEGINDATE' => $date,
            'UTM_CAMPAIGN' => $utmCampaign,
            'UTM_SOURCE' => $utmSource,
            'UTM_MEDIUM' => $utmMedium,
            'UTM_CONTENT' => $utmContent,
            'UTM_TERM' => $utmTerm,
            'COMMENTS' => "
            Страница захвата: {$landingPage}
            Промокод: {$visitId}
            Источник: {$marker}
            Набранный номер: {$managerPhone}
        "
        ],
    );
    $url = $endpoint . '?' . http_build_query($paramsUpdate);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    print_r($response);

    curl_close($ch);
}



// finish call
$finishCallEndpoint = "https://bitrix.5-stars.org/rest/151/o4wbly1b06zw1dmz/telephony.externalcall.finish.json";

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
$attachEndpoint = "https://bitrix.5-stars.org/rest/151/by05msgbx9kiy6z7/telephony.externalcall.attachrecord.json";

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
