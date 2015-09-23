<?php
function httpPost($url,$params)
{
  
 
    $ch = curl_init($url); 
    //$contents= json_decode($params,true);
    $contents=$params;
    $access_token='ea53e57170ea72c3bb8308f3163cdf90bf3595cf';
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Token ' . $access_token,
      'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $contents);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, false);
    $output=curl_exec($ch);
    echo $output;
    $matches = array();
    preg_match_all('$\b(https?|ftp|file)://[-A-Z0-9+&@#/%?=~_|!:,.;]*[-A-Z0-9+&@#/%=~_|]$i', $output, $matches);
    //print_r($matches);
   // echo curl_error($ch);
    curl_close($ch);
    $url=$matches[0][0];
    return $url;
 
}
error_reporting(E_ALL); 
ini_set('display_errors', 1);
$params = file_get_contents(Yii::app()->basePath."/files/upload.json");
$datetime=$model->date;
$content=$model->content;
list($year,$month,$day)=  explode("-", $datetime);
$data = json_decode($params);
$data->content=$content;
$data->reviewer->name=$model->review_name;
$data->publication->title=$model->publication_title;
$data->complete_date->month=$month;
$data->complete_date->year=$year;

$newJsonString = json_encode($data);
//echo $newJsonString;
file_put_contents('./upload.json', $newJsonString);


$url= httpPost("https://staging.publons.com/api/v2/review/",$newJsonString);
//echo $url;

//echo httpPosttest("http://hayageek.com");
$doi= file_get_contents("./doi.rtf");


list($a,$b,$c) = explode('.', (string)$doi);
$temp1 = intval($c)+1;
$newdoi= $a.'.'.$b.'.'.$temp1;
file_put_contents('./doi.rtf', $newdoi);

$xml = simplexml_load_file('./template.xml');

//echo 'DOI: '.$doi;

$xml-> identifier=$doi;
$xml-> creators->creator->creatorName=$_GET["name"];
$xml-> titles->title=$_GET["title"];
$xml-> dates->date=$_GET["date"];
$xml-> descriptions->description=$_GET["content"];
$xml-> relatedIdentifiers->relatedIdentifier=$_GET["doi"];
$xml ->asXML('./template.xml');


?>
<br>
<br>
<title>GigaScience Publon submission</title>
<a href=<?php echo $url?>> The Publon review page</a>
<br>
<br>
<?php echo 'DOI for this review: '.$doi ?>

<form action='mintdoi.php' method="get" >
    <input type="hidden" name="doi" value=<?php echo $doi?>>
    <input type="hidden" name="url" value=<?php echo $url?>>
    <input type="submit" name="button1"  value="Mint this DOI">    
</form>

        

