<?php
require_once('facebook.php');
class FacebookUserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','ajax'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FacebookUser;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacebookUser']))
		{
			$model->attributes=$_POST['FacebookUser'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacebookUser']))
		{
			$model->attributes=$_POST['FacebookUser'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FacebookUser');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FacebookUser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacebookUser']))
			$model->attributes=$_GET['FacebookUser'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAjax() 
	{
		$model = new FacebookUser;
		$config = array();
		$config['appId'] = '167839766714035';
		$config['secret'] = '0fd6dd48a389e40cc810fec2bf3bec5f';

		$facebook = new Facebook($config);
		$uid = $facebook->getUser();
		echo json_encode(array("uid" => $uid));
		/*
		if(isset($_POST['FacebookUser'])) {
			$model->attributes = $_POST['EventoValoracion'];
			if($model->validate()) {
				// form inputs are valid, do something here
				if (isset($_POST['EventoValoracion']['id']) && 
					EventoValoracion::model()->exists('id=:id', 
						array(':id'=>$_POST['EventoValoracion']['id'])
						)
					) {
					$model->update();
				} else {
					$model->save();
				}
				echo json_encode(array("id" => $model->getPrimaryKey(), "code" => "success"));
				return;
			} else {
				echo json_encode(array("code" => "error"));
				return;
			}
		}*/
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FacebookUser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FacebookUser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FacebookUser $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='facebook-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
