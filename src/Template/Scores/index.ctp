<!-- File: src/Template/scores/index.ctp -->

<h1>得点一覧</h1>

<!-- <?= $this->Html->link('スコア追加', ['action' => 'add']) ?> -->

<table>
    <tr>
        <th>team name</th>
        <th>vs team1</th>
        <th>vs team2</th>
        <th>vs team3</th>
        <th>vs team4</th>
        <th>vs team5</th>
    </tr>

    <!-- ここで、$scores クエリーオブジェクトを繰り返して、記事の情報を出力します -->

    <?php foreach ($scores as $score): ?>
    <tr>
        <td>
          <?= $score->team_name ?>
            <!-- <?= $this->Html->link($score->team_name, ['action' => 'view', $score->score_vs1]) ?> -->
        </td>
        <td>
          <?= $score->score_vs1 ?>
        </td>
        <td>
          <?= $score->score_vs2 ?>
        </td>
        <td>
          <?= $score->score_vs3 ?>
        </td>
        <td>
          <?= $score->score_vs4 ?>
        </td>
        <td>
          <?= $score->score_vs5 ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
