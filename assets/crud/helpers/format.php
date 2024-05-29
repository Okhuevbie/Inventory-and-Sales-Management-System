<?php
/**
*  Format Class
*/
class Format
{
	
	public function DateFormat($date)
	{
         return date("F j, Y  g:i a",strtotime($date));
	}
	public function DateFormat1($date)
	{
         return date("M jS, Y",strtotime($date));
	}
	public function DateFormat2($date)
	{
         return date("d-m-Y",strtotime($date));
	}
	public function DateFormat3($date)
	{
         return date("F jS, Y",strtotime($date));
	}
	public function DateFormat4($date)
	{
         return date("F, Y",strtotime($date));
	}
	public function DateFormat5($date)
	{
         return date("F jS, Y h:i a",strtotime($date));
	}
	public function DateFormat6($date)
	{
         return date("F jS, Y",strtotime($date));
	}
	public function DateFormat7($date)
	{
         return date("jS M, Y",strtotime($date));
	}
	public function DateFormat8($date)
	{
         return date("Y-M-d",strtotime($date));
	}
	public function DateFormat9($date)
	{
         return date("d-m-Y",strtotime($date));
	}
	public function DateFormat10($date)
	{
         return date("M d Y",strtotime($date));
	}
	public function AdminDateFormat($date)
	{
         return date("M, Y",strtotime($date));
	}
	public function TimeFormat($time)
	{		
         return date("g:i A",strtotime($time));
	}
	public function textExerpt($text,$limit=400)
	{
        $text = $text." ";
        $text = substr($text,0,$limit);
        $text = substr($text,0,strrpos($text," "));
        $text = $text."....";
        return $text;
	}
	public function validation($data)
	{
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = strip_tags($data);
		$data = stripcslashes($data);
		return $data;

	}
	public function validation1($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		$data = htmlentities($data);
		$data = strip_tags($data);
		return $data;

	}
	public function RemoveTags($data){
       $data = strip_tags(html_entity_decode($data));
       return $data;
	}

	public function fortitle(){
		$path = $_SERVER['SCRIPT_NAME'];
		$title = basename($path,'.php');
		if($title=="index"){
			$title = 'home';
		}elseif($title=="contact"){
			$title ="contact";
		}
		$title = ucwords($title);
		return $title;
	}
	public function limit_words($string, $word_limit){
	    $words = explode(" ",$string);
	    $dots = '';
	    if (count($words) > $word_limit) {
	    	$dots = '...';
	    }
	    $words = implode(" ", array_splice($words, 0, $word_limit)).$dots;

	    return $words;
	}
}

?>