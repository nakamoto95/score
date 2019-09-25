<?php
// src/Controller/scoresController.php

namespace App\Controller;
use Cake\ORM\TableRegistry;

class ScoresController extends AppController
{
  public function initialize(){
    parent::initialize();

    $this->loadComponent('Paginator');
    $this->loadComponent('Flash'); // FlashComponent をインクルード
  }

  public function test(){
    $this->loadComponent('Paginator');
    $scores = $this->Paginator->paginate($this->Scores->find());
    $this->set(compact('scores'));
  }

  public function index(){

    // $this->Html->css(‘index’);
    $teams_list = $this->Scores->find('list',['keyField'=>'id','valueField'=>'team_name']);
    $teams = $teams_list->toArray();

    $temp_scores = TableRegistry::get('Scores');
    $temp_scores = TableRegistry::getTableLocator()->get('Scores');

    for($i=1;$i<=5;$i++){
      $team_scores = $temp_scores->get($i);
      for($j=1;$j<=5;$j++){
        $vs_team = 'score_vs'.strval($j);
        $scores[$i][$j] = $team_scores->$vs_team;
      }
    }

    for($i=1;$i<=5;$i++){
      for($j=$i;$j<=5;$j++){
        // 0 : no game
        // 1 : win
        // 2 : lose
        // 3 : draw
        if($i==$j){
          // no game
          $results[$i][$j] = 0;
          $results_mark[$i][$j] = '';
        } elseif ($scores[$i][$j]>$scores[$j][$i]) {
          // i:win j:lose
          $results[$i][$j] = 1;
          $results[$j][$i] = 2;
          $results_mark[$i][$j] = '○';
          $results_mark[$j][$i] = '●';
        } elseif ($scores[$i][$j]<$scores[$j][$i]) {
          // i:lose j:win
          $results[$i][$j] = 2;
          $results[$j][$i] = 1;
          $results_mark[$i][$j] = '●';
          $results_mark[$j][$i] = '○';

        } else{
          // i,j:draw
          $results[$i][$j] = 3;
          $results[$j][$i] = 3;
          $results_mark[$i][$j] = '△';
          $results_mark[$j][$i] = '△';

        }
      }
    }

    for($k=1;$k<=5;$k++){
      // pr($teams[$k]);
      $total_team_scores[$teams[$k]]=0;
      if(array_key_exists(1, array_count_values($results[$k]))){
        $total_team_scores[$teams[$k]] = $total_team_scores[$teams[$k]] + array_count_values($results[$k])[1] *3;
      }
      if(array_key_exists(3, array_count_values($results[$k]))){
        $total_team_scores[$teams[$k]] = $total_team_scores[$teams[$k]] + array_count_values($results[$k])[3] *1;
      }
      $total_team_scores[$teams[$k]] = $total_team_scores[$teams[$k]] + array_sum($scores[$k])/1000;
      for($l=1;$l<=5;$l++){
        $total_team_scores[$teams[$k]] = $total_team_scores[$teams[$k]] - ($scores[$l][$k])/1000;
      }
    }

    // pr($total_team_scores);
    arsort($total_team_scores);
    // pr($total_team_scores);


    $this->set(compact('scores'));
    $this->set(compact('teams'));
    $this->set(compact('results'));
    $this->set(compact('results_mark'));
    $this->set(compact('total_team_scores'));
  }


  public function add(){
    $teams = $this->Scores->find('list');
    $this->set(compact('teams'));

    $scores = TableRegistry::get('Scores');
    $scores = TableRegistry::getTableLocator()->get('Scores');

    // pr($scores);
    // $score = $this->Scores->newEntity();
    if ($this->request->is('post')) {

        $team1 = $scores->get($this->request->getData('team_first')); // id 12 の記事を返します
        $vs_team1 = strval($this->request->getData('team_second'));
        $str_score_team1 = 'score_vs'.$vs_team1;
        $team1->$str_score_team1 =  $this->request->getData('score_team_first');
        $scores->save($team1);

        $team2 = $scores->get($this->request->getData('team_second')); // id 12 の記事を返します
        $vs_team2 = strval($this->request->getData('team_first'));
        $str_score_team2 = 'score_vs'.$vs_team2;
        $team2->$str_score_team2 =  $this->request->getData('score_team_second');
        $scores->save($team2);

        $this->Flash->success(__('Score has been saved.'));
        // return $this->redirect(['action' => 'index']);
    }
    $this->set(compact('scores'));
  }
}
