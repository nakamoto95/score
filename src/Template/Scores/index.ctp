<!-- File: src/Template/scores/index.ctp -->

<h1>得点一覧</h1>

<!-- <?= $this->Html->link('スコア追加', ['action' => 'add']) ?> -->

<table>
    <tr>
        <th>team name</th>
        <?php for($i=1;$i<=5;$i++){  ?>
          <th>
            <?= $teams[$i]?>
          </th>
        <?php }?>
    </tr>

    <?php for($i=1;$i<=5;$i++){  ?>
      <tr>
        <th>
          <?= $teams[$i]?>
        </th>
        <?php for($j=1;$j<=5;$j++){ ?>
          <td>
            <?= $results_mark[$i][$j]?>
          </td>
        <?php }?>
      </tr>
    <?php }?>

</table>
<br>
<br>
<table>
  <tr>
    <th>順位</th>
    <th>チーム名</th>
    <th>勝</th>
    <th>敗</th>
    <th>分</th>
    <th>得失点差</th>
  </tr>
    <?php  $i=0;?>
  <?php foreach ($total_team_scores as $key => $value ): ?>
    <?php  $i = $i +1 ;?>
    <tr>
        <td>
          第<?=$i?>位
        </td>
        <td>
          <?= $key ?>
        </td>
        <td>
          <?php
          $ind = array_keys($teams,$key);
          if(array_key_exists(1, array_count_values($results[$ind[0]]))){
            echo array_count_values($results[$ind[0]])[1];
          }else{
            echo "0";
          }
          ?>
        </td>
        <td>
          <?php
          if(array_key_exists(3, array_count_values($results[$ind[0]]))){
            echo array_count_values($results[$ind[0]])[3];
          }else{
            echo "0";
          }
          ?>
        </td>
        <td>
          <?php
          if(array_key_exists(2, array_count_values($results[$ind[0]]))){
            echo array_count_values($results[$ind[0]])[2];
          }else{
            echo "0";
          }
          ?>
        </td>
        <td>
          <?php
            $difference = array_sum($scores[$ind[0]]);
            for($k=1;$k<=5;$k++){
              $difference = $difference - $scores[$k][$ind[0]];
            }
          echo $difference
          ?>
        </td>

    </tr>
  <?php endforeach; ?>

</table>
