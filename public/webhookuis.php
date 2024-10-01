<?php
//ini_set('display_errors', 0);

const INTEGRATION_KEY = 'ODliOTEwMjI4MTFkZmU3ZDNjMmI3Y2ZiZmExMTFlZWI6MTk5ODk2';

$phone = $_GET['contact_phone_number'];
$lastNumDigits = substr($_GET['virtual_phone_number'], 7);
$email = '';
$name = '';
$form = 'Звонок с номера ' . $phone;
$comment = 'Набранный номер: ' . $_GET['virtual_phone_number'];
$assigneeId = null;
$recordFileLinks = $_GET['record_file_links'] ?? null;

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

if (mb_strlen($phone) > 0 || mb_strlen($email) > 0) {
    $roistatData = array(
        'roistat' => 'unknown',
        'key' => INTEGRATION_KEY,
        'title' => $form,
        'comment' => $comment,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'is_skip_sending' => '1',
        'fields' => array(
            'ASSIGNED_BY_ID' => $assigneeId,
            "SOURCE_ID" => "Прямой ЗВОНОК" . " " . $lastNumDigits,
            "UF_CRM_1648718242" => "Прямой ЗВОНОК" . " " . $lastNumDigits,
        ),
    );
//    file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
}
