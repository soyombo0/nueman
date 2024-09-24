<?php
//  $endpoint = "https://legacyonlineschool.bitrix24.com/rest/18/1wpof25pb33o3itf/crm.deal.get.json";
//  $endpointUpdate = "https://legacyonlineschool.bitrix24.com/rest/18/1wpof25pb33o3itf/crm.deal.update.json";
//
//  // $dealId = $_REQUEST['data']['FIELDS']['ID'];
//  $dealId = 35224;
//  $params = array('ID' => $dealId);
//  $url = $endpoint . '?' . http_build_query($params);
//  $roistatField = null;
//
//  // Get deal
//  $ch = curl_init();
//  curl_setopt($ch, CURLOPT_URL, $url);
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
// $resp = json_decode(curl_exec($ch));
//
// if($resp->result->UF_CRM_1710840971231 === 'EWEBINAR'  || $resp->result->UF_CRM_1710840971231 === 'ewebinar') {
//     $roistatField = 'facebook1_' . $resp->result->UTM_CAMPAIGN;
// }
//  curl_close($ch);
//
//  // Update deal
//  $chUpdate = curl_init();
//  $paramsUpdate = array(
//      'ID' => $dealId,
//      'fields' => ['UF_CRM_1710840971231' => $roistatField],
//  );
//  $urlUpdate = $endpointUpdate . '?' . http_build_query($paramsUpdate);
//
//  curl_setopt($chUpdate, CURLOPT_URL, $urlUpdate);
//  curl_setopt($chUpdate, CURLOPT_RETURNTRANSFER, true);
//
//  $respUpdate = curl_exec($chUpdate);
//
//  curl_close($chUpdate);

$phone = '19952426628';
$email = 'test224@test11.com';
$form = 'testWebhook33';
$name = 'testwebhook44';
$key = 'NDViNzM1ODY1MGU4MDEzOWM4NGJlZjU1YTZmOTAzOGY6MjYwODYx';

if (mb_strlen($phone) > 0 || mb_strlen($email) > 0 && isset($_COOKIE['roistat_visit']) ) {
   $roistatData = array(
       'roistat' => 'ewebinar',
       'key' => $key,
       'title' => $form,
       'name' => $name,
       'phone' => $phone,
       'email' => $email,
       'is_skip_sending' => '0',
       'fields' => array(
           'utm_campaign' => 'instagram'
       ),
   );
   file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
}
