<?php
// var_dump($_POST);
// exit;

date_default_timezone_set('Asia/Tokyo');

$patientId = $_POST['patient_id'] ?? '';

// 数字以外を除去
$patientId = preg_replace('/\D/', '', $patientId);

// 8桁に0埋め
$patientId = str_pad($patientId, 8, '0', STR_PAD_LEFT);

// 最終チェック
if (!preg_match('/^\d{8}$/', $patientId)) {
  exit('患者IDが不正です');
}

$data = [
  date('Y-m-d H:i:s'),
  $patientId,
  $_POST['name'],
  $_POST['symptom'],
  $_POST['department']
];

$filePath = __DIR__ . '/data/reserve.csv';

// ファイルを開く
$file = fopen($filePath, 'a');

if ($file === false) {
  exit('ファイルを開けません');
}

// ファイルロック
flock($file, LOCK_EX);
// プットする
fputcsv($file, $data);

// ファイルロック解除
flock($file, LOCK_UN);

// ファイルを閉じる
fclose($file);

header('Location: index.php');
exit;