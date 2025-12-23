<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>管理画面</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header>診療予約一覧</header>

    <main>
      <a href="download.php" class="dl-btn">CSVダウンロード</a>
      <table>
        <tr>
          <th>日時</th>
          <th>患者ID</th>
          <th>氏名</th>
          <th>症状</th>
          <th>診療科</th>
        </tr>
        <?php
          $filePath = __DIR__ . '/data/reserve.csv';

          if (file_exists($filePath)) {
            // ファイルを開く(読み取り)
            $file = fopen($filePath, 'r');

            if ($file) {
              // ファイルロック（WRITEの人がいたら待つ）
              flock($file, LOCK_SH);

              while (($row = fgetcsv($file)) !== false) {
                echo '<tr>';
                foreach ($row as $col) {
                  echo '<td>' . htmlspecialchars($col, ENT_QUOTES, 'UTF-8') . '</td>';
                }
                echo '</tr>';
              }
              
              // ロック解除
              flock($file, LOCK_UN);
              // ファイル閉じる
              fclose($file);
            }
          }
        ?>
      </table>
    </main>
  </body>
</html>