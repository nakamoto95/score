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

  public function index(){
    $this->loadComponent('Paginator');
    $scores = $this->Paginator->paginate($this->Scores->find());
    $this->set(compact('scores'));
  }

  public function add(){
    $teams = $this->Scores->find('list');
    $this->set(compact('teams'));

    $scoresTable = TableRegistry::get('Scores');
    $scoresTable = TableRegistry::getTableLocator()->get('Scores');


    // $score = $this->Scores->newEntity();
    if ($this->request->is('post')) {

        $team1 = $scoresTable->get($this->request->getData('team_first')); // id 12 の記事を返します
        $vs_team1 = strval($this->request->getData('team_second'));
        $str_score_team1 = 'score_vs'.$vs_team1;
        $team1->$str_score_team1 =  $this->request->getData('score_team_first');
        $scoresTable->save($team1);

        $team2 = $scoresTable->get($this->request->getData('team_second')); // id 12 の記事を返します
        $vs_team2 = strval($this->request->getData('team_first'));
        $str_score_team2 = 'score_vs'.$vs_team2;
        $team2->$str_score_team2 =  $this->request->getData('score_team_second');
        $scoresTable->save($team2);

        $this->Flash->success(__('Score has been saved.'));
        // return $this->redirect(['action' => 'index']);
    }
    $this->set('score', $scoresTable);
  }
}
