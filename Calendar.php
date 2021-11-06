<?php
namespace App;
use App\User;
use Illuminate\Support\Facades\Log;
use App\Item;
use Illuminate\Support\Facades\Auth;

class Calendar
{
    private $html; 
    private $items;
    
    function __construct($items) {
        $this->items = $items;
    }

    public function showCalendarTag($m, $y)
    {
        $year = $y;
        $month = $m;
        if ($year == null) {
            // システム日付を取得する。 
            $year = date("Y");
            $month = date("m");
        }
        $firstWeekDay = date("w", mktime(0, 0, 0, $month, 1, $year)); // 1日の曜日(0:日曜日、6:土曜日)
        $lastDay      = date("t", mktime(0, 0, 0, $month, 1, $year)); // 指定した月の最終日
        // 前月
	$prev = strtotime('-1 month',mktime(0, 0, 0, $month, 1, $year));
        $prev_year = date("Y",$prev);
        $prev_month = date("m",$prev);
        // 翌月
	$next = strtotime('+1 month',mktime(0, 0, 0, $month, 1, $year));
        $next_year = date("Y",$next);
        $next_month = date("m",$next);
        // 日曜日からカレンダーを表示するため前月の余った日付をループの初期値にする
        $day = 1 - $firstWeekDay;
        $this->html = <<< EOS
<h2>
<a class="btn btn-primary" href="/test?year={$prev_year}&month={$prev_month}" role="button">&lt;前月</a>
{$year}/{$month}
<a class="btn btn-primary" href="/test?year={$next_year}&month={$next_month}" role="button">翌月&gt;</a>
</h2>
<table class="table table-bordered" style="table-layout:fixed;">
<tr>
  <th scope="col">Sun</th>
  <th scope="col">Mon</th>
  <th scope="col">Tue</th>
  <th scope="col">Wed</th>
  <th scope="col">Thu</th>
  <th scope="col">Fri</th>
  <th scope="col">Sat</th>
</tr>
EOS;
    // カレンダーの日付部分を生成する
        while ($day <= $lastDay) {
            $this->html .= "<tr>";
            // 各週を描画するHTMLソースを生成する
            for ($i = 0; $i < 7; $i++) {
                if ($day <= 0 || $day > $lastDay) {
                    // 先月・来月の日付の場合
                    $this->html .= "<td>&nbsp;</td>";
                } else {
                  $this->html .= "<td>" . $day ."&nbsp"; 
                  $target = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)); 
                    // 案件名のカレンダー内表示
                   foreach($this->items as $val) { ★
                            if ($val->delivery_date == $target) ★
                            {★
                                $this->html .= $val->item_name; ★
                            }
                       
                    }
                  $this->html .= "</td>"; 
                }
              $day++;
            }
            
            $this->html .= "</tr>";
        }
        $this->html .= "</table>";
        return $this->html;
    }
}