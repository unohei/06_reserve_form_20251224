<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>健康診断</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header>健康診断</header>
    <main>
      <?php
        date_default_timezone_set('Asia/Tokyo');
        $hour = (int)date('H');

        if ($hour >= 1 && $hour < 18) {
          echo '<a href="tel:117" class="call-btn">電話で予約</a>';
        } else {
          echo '<p class="note">現在時間外のため、お電話はご利用いただけません。</p>';
        }
      ?>
      <a href="index.php" class="back-btn">戻る</a>
    </main>
  </body>
</html>
