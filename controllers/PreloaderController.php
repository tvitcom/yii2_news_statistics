<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\controllers;

use Yii;
use app\models\News;
use app\models\Click;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class PreloaderController extends Controller
{
    public $previous_see_time;//for storing time from client:
    
    public function init()
    {
        parent::init();

        //Set last see time:
        $cookies = Yii::$app->request->cookies;
        //exit(var_dump($cookies));
        if (isset($cookies['last_see'])) {
            $this->previous_see_time = $cookies['last_see']->value;
        } else {
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'last_see',
                'value' => time(),
            ]));
            $this->previous_see_time = '';
        }
    }
}