<?php

class ReviewController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view','admin','delete','mint'),
				'users'=>array('@'),
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
	public function actionMint($doi,$url,$id)
        {
            
           // echo 'hello'; 
            $handle=fopen(Yii::app()->basePath.'/files/template.xml',"r");
                    $xml= fread($handle,  filesize(Yii::app()->basePath.'/files/template.xml'));
                    //print_r($xml);
                   
                    $url="https://mds.datacite.org/metadata";
                    $ch=  curl_init($url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/xml'));
                    curl_setopt($ch, CURLOPT_USERPWD, 'BL.BGI:BG79xzpuqwe23xmn!');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, utf8_encode($xml));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    
                    echo $output;
                    curl_close($ch);
                    
                    
                  
                    
                    
                    $info="doi=".$doi."\nurl=".$url;
                    $url1="https://mds.datacite.org/doi";
                    $ch1=  curl_init($url1);
                    curl_setopt($ch1, CURLOPT_POST, 1);
                    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/xml'));
                    curl_setopt($ch1, CURLOPT_USERPWD, 'BL.BGI:BG79xzpuqwe23xmn!');
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, utf8_encode($info));
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                    $output1 = curl_exec($ch1);
                    
                    $model= Review::model()->findByPK($id);
                   // echo $output1;
                    curl_close($ch1);
                    $model->minted=TRUE;
                    $model->save();
                    
                    $this->render('doi',array(
			'xml'=>$xml,
                        'doi'=>$doi,
		));
                    
                    
            
        }
        public function actionCreate()
	{
		$model=new Review;
                $addpart=null;
                $revisedcontent=null;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Review']))
		{
                       //print_r ($_POST['Review']);
                       
                      
                       $model->attributes=$_POST['Review'];
                        
                       if(isset($_POST['Review']['draftURL'])){
                       $model->draftURL=$_POST['Review']['draftURL'];
                       }
                       if(isset($_POST['Review']['revisedURL1'])){
                       $model->revisedURL1=$_POST['Review']['revisedURL1'];
                       }
                       if(isset($_POST['Review']['revisedURL2'])){
                       $model->revisedURL2=$_POST['Review']['revisedURL2'];
                       }
                       if(isset($_POST['Review']['revisedURL3'])){
                       $model->revisedURL3=$_POST['Review']['revisedURL3'];
                       }
                       
                        
                        if($model->draftURL!=null)
                        {
                            $temp="Draft - ".$model->draftURL." <br />";
                            $revisedcontent.=$temp;
                            
                        }
                        if($model->revisedURL1 !=null)
                        {
                            $temp="First revision - ".$model->revisedURL1." <br />";
                            $revisedcontent.=$temp;
                        }
                        if($model->revisedURL2 !=null)
                        {
                            $temp="Second revision - ".$model->revisedURL2." <br />";
                            $revisedcontent.=$temp;
                        }
                        if($model->revisedURL3 != null)
                        {
                            $temp="Thrid revision - ".$model->revisedURL3." <br />";
                            $revisedcontent.=$temp;
                        }
                        if($model->draftURLcheck==1)
                        { 
                            $addpart="<div>The reviewed version of the manuscript can be seen here: <br />"
                                    . $model->draftURL." <br /> All revised versions are also available: <br />".$revisedcontent."</div>";
                                    
                            
                        }
                        elseif($model->revisedURL1check==1)
                        { 
                            $addpart="<div>The reviewed version of the manuscript can be seen here: <br />"
                                    . $model->revisedURL1." <br /> All revised versions are also available: <br />".$revisedcontent."</div>";
                                    
                            
                        }
                        elseif($model->revisedURL2check==1)
                        { 
                            $addpart="<div>The reviewed version of the manuscript can be seen here: <br />"
                                    . $model->revisedURL2." <br /> All revised versions are also available: <br />".$revisedcontent."</div>";
                                    
                            
                        }
                        elseif($model->revisedURL3check==1)
                        { 
                            $addpart="<div>The reviewed version of the manuscript can be seen here: <br />"
                                    . $model->revisedURL3." <br /> All revised versions are also available: <br />".$revisedcontent."</div>";
                                    
                            
                        }
                       // $model->content=html_entity_decode($model->content);
                        $model->content=$model->content." <br />".$addpart;
                       // echo $model->content;
                        
                       
			
                        if($model->save())
                        {
			    error_reporting(E_ALL); 
                            ini_set('display_errors', 1);
                            $params = file_get_contents(Yii::app()->basePath."/files/upload.json");
                            $datetime=$model->date;
                            $content=$model->content;
                            list($year,$month,$day)=  explode("-", $datetime);
                            $data = json_decode($params);
                            $data->content=$content;
                            $data->reviewer->email= $model->reviewer_email;
                            $data->reviewer->name=$model->review_name;
                            $data->publication->title=$model->publication_title;
                            $data->publication->doi=$model->publication_doi;
                            $data->complete_date->month=$month;
                            $data->complete_date->year=$year;
                            $data->url=$model->source;

                            $newJsonString = json_encode($data);
                            //echo $newJsonString;
                            file_put_contents(Yii::app()->basePath.'/files/upload.json', $newJsonString);


                            //$url= $this->httpPost("https://staging.publons.com/api/v2/review/",$newJsonString);
                            //$response = $this->httpGetHeader("https://publons.com/api/v2/review/post/");
                            //print_r($response);
                            //$url="";
                            $url= $this->httpPost("https://publons.com/api/v2/review/",$newJsonString);
                            //echo $url;

                            //echo httpPosttest("http://hayageek.com");
                            $doi= file_get_contents(Yii::app()->basePath.'/files/doi.rtf');
                            


                            list($a,$b,$c) = explode('.', (string)$doi);
                            $temp1 = intval($c)+1;
                            $newdoi= $a.'.'.$b.'.'.$temp1;
                            file_put_contents(Yii::app()->basePath.'/files/doi.rtf', $newdoi);

                            $xml = simplexml_load_file(Yii::app()->basePath.'/files/template.xml');

                            //echo 'DOI: '.$doi;

                            $xml-> identifier=$doi;
                            $xml-> creators->creator->creatorName=$model->review_name;
                            $xml-> titles->title="Peer review of \"".$model->publication_title."\"";
                            $xml-> dates->date=$model->date;
                            $xml-> descriptions->description='This is the open peer reviewers comments and recommendations regarding the submitted GigaScience article and/or dataset.' ;
                            $xml-> relatedIdentifiers->relatedIdentifier=$model->publication_doi;
                            $xml ->asXML(Yii::app()->basePath.'/files/template.xml');
                            $model->publon_url=$url;
                            $model->datacite_doi=$doi;
                            $model->save();
                            $this->render('view_1',array('model'=>$model));
                                
                        }
                        else{
                            $this->render('create',array(
                            'model'=>$model,));
                        }
		}
                else{
		$this->render('create',array(
			'model'=>$model,
		));
                }
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

		if(isset($_POST['Review']))
		{
			$model->attributes=$_POST['Review'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        
        private function httpGetHeader($url)
        {
            $ch = curl_init($url); 
    //$contents= json_decode($params,true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, true);
            $body = curl_exec($ch);
            
            $start= strpos($body, "csrftoken=");
            $end= strpos($body, "; expires");
            
            $token= substr($body,$start+10,$end-$start-11);
            
       
            return $token;
            
            
            
            
        }
        
   
        
        
        
        private function httpPost($url,$params)
{
  
 
    $ch = curl_init($url); 
    //$contents= json_decode($params,true);
    $contents=$params;
    $access_token='ea53e57170ea72c3bb8308f3163cdf90bf3595cf';
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Token ' . $access_token,
      'Content-Type: application/json'));
    /*
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Token ' . $access_token,
      'Content-Type: application/json',
      'Cookie: csrftoken='.$token));
     */
     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $contents);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//newadd
    //curl_setopt($ch, CURLOPT_REFERER, 'www.google.com');//newadd
    
    curl_setopt($ch, CURLOPT_VERBOSE, false);
    $output=curl_exec($ch);
    file_put_contents(Yii::app()->basePath.'/files/reply', $output);
    
    $matches = array();
    preg_match_all('$\b(https?|ftp|file)://[-A-Z0-9+&@#/%?=~_|!:,.;]*[-A-Z0-9+&@#/%=~_|]$i', $output, $matches);
   // print_r($matches);
   // echo curl_error($ch);
    curl_close($ch);
    $url=$matches[0][0];
    return $url;
 
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
		$dataProvider=new CActiveDataProvider('Review');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Review('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Review']))
			$model->attributes=$_GET['Review'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Review the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Review::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Review $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='review-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
