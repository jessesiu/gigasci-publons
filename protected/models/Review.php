<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $id
 * @property string $review_name
 * @property string $reviewer_email
 * @property string $reviewer_affiliation
 * @property string $date
 * @property string $privacy
 * @property string $content
 * @property string $source
 * @property string $source_license
 * @property string $publication_title
 * @property string $publication_doi
 * @property string $abstract
 * @property string $url_manuscript
 * @property string $journal
 * @property string $review_doi
 */
class Review extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public $draftURL;
    public $revisedURL1;
    public $revisedURL2;
    public $revisedURL3;
    
    public $draftURLcheck;
    public $revisedURL1check;
    public $revisedURL2check;
    public $revisedURL3check;
    
    
    public function tableName()
    {
        return 'review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('review_name, reviewer_email,publication_title, publication_doi,date,content','required'),
            array('review_name, reviewer_email, reviewer_affiliation, privacy, source_license, url_manuscript, journal', 'length', 'max'=>50),
            array('publication_title', 'length', 'max'=>2000),
            array('publication_doi, source', 'length', 'max'=>100),
            array('review_doi', 'length', 'max'=>20),
            array('reviewer_email', 'email'),
            //array('draftURLcheck, revisedURL1check,revisedURL2check,revisedURL1check','checkbox'),
            array('date,draftURLcheck,revisedURL1check,revisedURL2check,revisedURL3check', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, review_name, reviewer_email, reviewer_affiliation, date, privacy, content, source, source_license, publication_title, publication_doi, abstract, url_manuscript, journal, review_doi', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'review_name' => 'Review Name',
            'reviewer_email' => 'Reviewer Email',
            'reviewer_affiliation' => 'Reviewer Affiliation',
            'date' => 'Date Of Review',
            'privacy' => 'Privacy',
            'content' => 'Review Content',
            'source' => 'Review Source URL',
            'source_license' => 'Review Source License',
            'publication_title' => 'Publication Title',
            'publication_doi' => 'Publication Doi',
            'abstract' => 'Publication Abstract',
            'url_manuscript' => 'URLs to manuscript versions',
            'journal' => 'Journal',
            'review_doi' => 'Review Doi',
            'publon_url' => 'Publon URL',
            'datacite_doi' => 'DataCite DOI',
            'minted'=>'Minted DataCite DOI',
            'draftURL'=>'Manuscript draft version URL',
            'revisedURL1'=>'Manuscript revised version 1 URL',
            'revisedURL2'=>'Manuscript revised version 2 URL',
            'revisedURL3'=>'Manuscript revised version 3 URL',
            
            'draftURLcheck'=>'reviewed version',
            'revisedURL1check'=>'reviewed version',
            'revisedURL2check'=>'reviewed version',
            'revisedURL3check'=>'reviewed version',
            
            
            
        );
    }
    
    public function checkbox($attribute)
    {
        if($attribute=='checked')
        {
            if($revisedURL1check=='checked')
            {
                $this->addError($attribute, 'Only allow one reviewedversion');
            }
             if($revisedURL2check=='checked')
            {
                $this->addError($attribute, 'Only allow one reviewedversion');
            }
             if($revisedURL3check=='checked')
            {
                $this->addError($attribute, 'Only allow one reviewedversion');
            }
        }
        
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('review_name',$this->review_name,true);
        $criteria->compare('reviewer_email',$this->reviewer_email,true);
        $criteria->compare('reviewer_affiliation',$this->reviewer_affiliation,true);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('privacy',$this->privacy,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('source',$this->source,true);
        $criteria->compare('source_license',$this->source_license,true);
        $criteria->compare('publication_title',$this->publication_title,true);
        $criteria->compare('publication_doi',$this->publication_doi,true);
        $criteria->compare('abstract',$this->abstract,true);
        $criteria->compare('url_manuscript',$this->url_manuscript,true);
        $criteria->compare('journal',$this->journal,true);
        $criteria->compare('review_doi',$this->review_doi,true);
        $criteria->compare('datacite_doi',$this->datacite_doi,true);
        $criteria->compare('publon_url',$this->publon_url,true);
        $criteria->compare('minted',$this->minted,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Review the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}