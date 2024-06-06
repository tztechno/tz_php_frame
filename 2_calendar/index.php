<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>今月のカレンダー</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .calendar {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
        }

        .day {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-3">今月のカレンダー</h1>
        <div class="calendar">
            <div class="row">
                <div class="col">日曜日</div>
                <div class="col">月曜日</div>
                <div class="col">火曜日</div>
                <div class="col">水曜日</div>
                <div class="col">木曜日</div>
                <div class="col">金曜日</div>
                <div class="col">土曜日</div>
            </div>
            <!-- カレンダーの日付を表示 -->
            <?php
        $firstDayOfMonth = strtotime(date('Y-m-01'));
        $lastDayOfMonth = strtotime(date('Y-m-t'));
        $firstDayOfWeek = date('w', $firstDayOfMonth);
        $daysInMonth = date('t', $firstDayOfMonth);

        $currentDay = 1;
        while ($currentDay <= $daysInMonth) {
          echo "<div class='row'>";
          for ($i = 0; $i < 7; $i++) {
            if ($currentDay == 1 && $i < $firstDayOfWeek) {
              echo "<div class='col'></div>";
            } else {
              if ($currentDay <= $daysInMonth) {
                echo "<div class='col day'>$currentDay</div>";
                $currentDay++;
              } else {
                echo "<div class='col'></div>";
              }
            }
          }
          echo "</div>";
        }
      ?>
        </div>
    </div>
</body>

</html>
