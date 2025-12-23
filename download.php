<?php
date_default_timezone_set('Asia/Tokyo');

$filePath = __DIR__ . '/data/reserve.csv';

if (!file_exists($filePath)) {
  exit('CSVファイルが存在しません');
}

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="reserve_' . date('Ymd_His') . '.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// ファイルを開く
$file = fopen($filePath, 'r');
if ($file === false) {
  exit('ファイルを開けません');
}

// ファイルをロック
flock($file, LOCK_SH);

// Excel文字化け防止（BOM）
echo "\xEF\xBB\xBF";

while (($row = fgetcsv($file)) !== false) {
  echo implode(',', $row) . "\n";
}

// ファイルをロック解除
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);
exit;