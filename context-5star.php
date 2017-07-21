<?php

$source = "https://docs.google.com/spreadsheets/d/1DNIRiQTcs8ZJ2ELm6vBMgTyHyhPO1Kh4mCEWRKr3vlM/pub?gid=0&single=true&output=csv";
$dimensionsFile = "https://docs.google.com/spreadsheets/d/1DNIRiQTcs8ZJ2ELm6vBMgTyHyhPO1Kh4mCEWRKr3vlM/pub?gid=275215384&single=true&output=csv";


// Prepare dimensions
$handle = fopen ( $dimensionsFile, 'r' );
if ($handle) {
	$first = TRUE;
	global $types, $dimensions;
	$types = FALSE;
	while ( ($line = fgetcsv ( $handle )) !== false ) {
		if ($first) {
			$first = FALSE;
			$types = $line;
			continue;
		}
		$dimensions[$line[0]] = $line;
	}
	fclose ( $handle );
} else {
	// error opening the file.
}

$handle = fopen ( $source, 'r' );
function v($column, $line){
	global $index;
	return $line[array_search($column, $index)];
}
function d($dimension, $type){
	global $types,$dimensions;
	return ($dimensions[$dimension][array_search($type, $types)] == 'Y');
}


if ($handle) {
	$first = TRUE;
	global $index;
	$index = FALSE;
	while ( ($line = fgetcsv ( $handle )) !== false ) {
		if ($first) {
			$first = FALSE;
			$index = $line;
			continue;
		}
		$md5 = md5($line[1]);
    $object = $md5;

    $t = v("Resource type", $line );

    $attributesALL = array(
	"Resource type",
    //"Project",
    "Category", "Type: Collection", "Type: Specification", "Affordance: Is playable?", "Purpose: Learning","Purpose: Research",
    "Scope: Temporal",
    "Scope: Geographical",
    "Scope: Genre",
    "Scope: Artist",
    "Scope: Formats",
    "Scope: MO type",
    "Scope: Object type",
    "Access: Public",
    "Access: license",
    "Access: Free/Charged",
    "Format: Interoperable?",
    "Interface: Human consumption?",
    "Interface: API?",
    "Interface: SPARQL endpoint?",
    // "SPARQL endpoint URI",
    "Interface: Data Dump?",
    "Interface: Is it queryable?",
    "Interface: Browsable?",
    "Collection: Size",
    "Data size",
    "Symbolic: Machine readable?",
    "Feature: Melody",
    "Feature: Harmony",
    "Feature: Lyrics",
    "Feature: Rhythm",
    "Feature: Timbre",
    "Feature: Contour/Shape",
    "Feature: Structure",
    "Feature: Descriptive Metadata",
    "Situation/Task",
    "Target audience"
	);
	
    $attributes5STAR = array(
	//"Resource type",
    //"Project",
    //"Category", 
	//"Type: Collection", "Type: Specification", "Affordance: Is playable?", "Purpose: Learning","Purpose: Research",
    /*"Scope: Temporal",
    "Scope: Geographical",
    "Scope: Genre",
    "Scope: Artist",*/
    "Scope: Formats",
/*    "Scope: MO type",
    "Scope: Object type", */
    "Access: Public",
    "Access: license",
/*    "Access: Free/Charged", */
    "Format: Interoperable?",
/*    "Interface: Human consumption?",  */
    "Interface: API?",
    "Interface: SPARQL endpoint?",
    // "SPARQL endpoint URI",
/*    "Interface: Data Dump?",
    "Interface: Is it queryable?",
    "Interface: Browsable?",
    "Collection: Size",
    "Data size", */
    "Symbolic: Machine readable?",
/*    "Feature: Melody",
    "Feature: Harmony",
    "Feature: Lyrics",
    "Feature: Rhythm",
    "Feature: Timbre",
    "Feature: Contour/Shape",
    "Feature: Structure",
    "Feature: Descriptive Metadata",
    "Situation/Task",
    "Target audience"*/
	);
	
	$filtersOL = array(
		"Access: Public" => array('Y'),
		"Access: license" => array('CC BY 3.0','CC-BY','CC-BY 4.0','CC-BY-NC','CC-BY-NC-ND','CC-BY-NC-SA','CC-BY-SA','CC0','GNU-FDL','GNU-GPL','MIT License','Open Access')
	);
	$filtersRE = array(
		"Format: Interoperable?" => array('Y'),
		"Interface: API?" => array('Y'),
		"Symbolic: Machine readable?" => array('Y'),
		"Interface: SPARQL endpoint?" => array('Y')
	);
	$filtersOF = array( // Open Formats
		"Scope: Formats" => array('rdf','midi','musicxml','json','mei/xml','owl','marcxml','mets/xml','mods/xml','svg','tei/xml','csv','tei','xml','skos','marcxml','cap/xml','mag/xml'),
	);
	$filtersURI = array(
		"Scope: Formats" => array('rdf','owl','skos'),
		"Interface: SPARQL endpoint?" => array('Y')
	);
	$filtersLD = array(
		"Interface: SPARQL endpoint?" => array('Y'),
	);
	
	// CONFIGURATION!
	$attributes = $attributes5STAR;

	
	// OL
	if( v("Access: Public", $line) == 'Y' && 
		in_array(v("Access: license",$line), $filtersOL["Access: license"])){
		print "$object,OL,1\n";
	}else{
		print "$object,OL,0\n";
	}
	
	// RE
	//(any of)
	$isRE = FALSE;
	foreach($filtersRE as $re => $rev){
		if(in_array(v($re,$line), $rev)){
			$isRE = TRUE;
			break;
		}
	}
	if($isRE){
		print "$object,RE,1\n";
	}else{
		print "$object,RE,0\n";
	}
	
	// OF
	// (any of the formats)
	$isOF = FALSE;
	$isURI = FALSE;
	$formats = v("Scope: Formats",$line);
    $v = strtolower($formats);
    $v = explode(',',$v);
    foreach($v as $vv){
      $vv = trim($vv);
      if(!$vv) continue;
	  if(in_array($vv, $filtersOF["Scope: Formats"])){
		  $isOF = TRUE;
	  }
	  if(in_array($vv, $filtersURI["Scope: Formats"])){
		  $isURI = TRUE;
	  }
	  
    }

	if($isOF){
		print "$object,OF,1\n";
	}else{
		print "$object,OF,0\n";
	}

	if($isURI){
		print "$object,URI,1\n";
	}else{
		print "$object,URI,0\n";
	}
	
	// LD
	if(v("Interface: SPARQL endpoint?", $line) == 'Y' ){
		print "$object,LD,1\n";
	}else{
		print "$object,LD,0\n";
	}
	
  }
  fclose($handle);
}
