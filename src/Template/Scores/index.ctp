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
