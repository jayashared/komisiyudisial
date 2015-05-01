<?php
	
	function PotongKata($Kata, $Jml)
	{
		$data = "";		
		$Kata = strip_tags($Kata);
		$temp = explode(" ", $Kata);

		if(count($temp) < $Jml)
			$Jml = count($temp);
		else
			$Jml = $Jml;
		
		for($i=0; $i<$Jml; $i++)
		{
			$data .= " " . $temp[$i];
		}

		return $data;
	}
	
	function TglIndo($tgl)
	{
		$bulan		= array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		$tgl_tmp 	= "";
		$tgl_tmp	= explode(" ", $tgl);
		$jam		= $tgl_tmp[1];
		$tgl		= explode("-", $tgl_tmp[0]);
		$b			= intval($tgl[1])-1>=0?intval($tgl[1])-1:0;
		$tgl		= $tgl[2] . " " . $bulan[$b] . " " . $tgl[0] . " " . $jam;

		return $tgl; 
	}
	
	function TglOnlyIndo($tgl)
	{
		$bulan		= array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		$tgl		= explode("-", $tgl);
		$b			= intval($tgl[1])-1>=0?intval($tgl[1])-1:0;
		$tgl		= $tgl[2] . " " . $bulan[$b] . " " . $tgl[0];

		return $tgl; 
	}
	
	function ddmmyyyy($tgl)
	{
		if( isset($tgl) and !empty($tgl) ):
			$tgl = explode("-", $tgl);
			return $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];
		endif;
	}
	
	function yyyymmdd($tgl)
	{
		if( isset($tgl) and !empty($tgl) ):
			$tgl = explode("-", $tgl);
			return $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];
		endif;
	}
	
	function TglIndoSaja($tgl)
	{
		$bulan		= array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		$tgl_tmp 	= "";
		$tgl_tmp	= explode(" ", $tgl);
		$jam		= isset($tgl_tmp[1])?$tgl_tmp[1]:"";
		$tgl		= explode("-", $tgl_tmp[0]);
		$b			= intval($tgl[1])-1>=0?intval($tgl[1])-1:0;
		$tgl		= $tgl[2] . " " . $bulan[$b] . " " . $tgl[0] ;

		return $tgl; 
	}
	
	function BlnIndoSaja($tgl)
	{
		$bulan		= array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
		$tgl		= explode("-", $tgl);
		$b			= intval($tgl[0])-1>=0?intval($tgl[0])-1:0;
		$tgl 		=  isset($tgl[1])?$tgl[1]:"";
		return $bulan[$b] . " " . $tgl; 
	}
	
	function SEO($input){ 
		//SEO - friendly URL String Converter    
		//ex) this is an example -> this-is-an-example
		
		$input = str_replace("&nbsp;", " ", $input);
		$input = str_replace(array("'", "-"), "", $input); //remove single quote and dash
		//echo $input;
		$input = strtolower($input); //convert to lowercase
		
		$input = preg_replace("#[^a-zA-Z]+#", "-", $input); //replace everything non an with dashes
		$input = preg_replace("#(-){2,}#", "$1", $input); //replace multiple dashes with one
		$input = trim($input, "-"); //trim dashes from beginning and end of string if any
		
		return $input; 
	}
	
	function SEO_Dec($input)
	{
		$input = str_replace("-", "&nbsp;", $input);
		return $input;
	}
	
	function FormatUang($uang)
	{
		setlocale(LC_MONETARY, 'it_IT');
		return money_format('%.2n', $number) . "\n";
	}
	
	function getTheme()
	{
		$sql = "select * from system_config";
		$r = mysql_query($sql);
		$data = mysql_fetch_array($r);
		$theme = !empty($data["frontend_theme"])?$data["frontend_theme"]:"red";
		return $theme;
	}
	
	function getTitle()
	{
		$sql = "select * from system_config";
		$r = mysql_query($sql);
		$data = mysql_fetch_array($r);
		$title = !empty($data["system_logo"])?$data["system_logo"]:"";
		return base_url() ."assets_frontend/logo_utama/" . $title;
	}
	
	function getPhone()
	{
		$sql = "select * from system_config";
		$r = mysql_query($sql);
		$data = mysql_fetch_array($r);
		$title = !empty($data["frontend_telp"])?$data["frontend_telp"]:"";
		return $title;
	}
	
	function getEmail()
	{
		$sql = "select * from system_config";
		$r = mysql_query($sql);
		$data = mysql_fetch_array($r);
		$title = !empty($data["frontend_email"])?$data["frontend_email"]:"";
		return $title;
	}
	
?>