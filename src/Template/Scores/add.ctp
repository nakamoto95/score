<!-- File: src/Template/Scores/add.ctp -->

<h1>スコア追加</h1>
<?php
    echo $this->Form->create($scores);
    // 今はユーザーを直接記述
    echo $this->Form->select('team_first',$teams);
    echo $this->Form->control('score_team_first');
    echo $this->Form->select('team_second',$teams);
    echo $this->Form->control('score_team_second');
    echo $this->Form->button(__('Save Score'));
    echo $this->Form->end();
?>
