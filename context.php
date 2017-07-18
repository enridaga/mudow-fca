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

    $attributes = array("Resource type",
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

    $attributeSeparator = '=';

    foreach($attributes as $attr){
      if(!v($attr, $line ))
        continue;
      if($attr == "Scope: Formats"){
        $v = v($attr, $line );
        $v = strtolower($v);
        $v = explode(',',$v);
        foreach($v as $vv){
          $vv = trim($vv);
          if(!$vv) continue;
          $attribute = $attr . $attributeSeparator . $vv;
          print "$object,$attribute,1\n";
        }
      }else
      if($attr == "Situation/Task" || $attr == "Target audience"){
        $v = v($attr, $line );
        $v = strtolower($v);
        $v = explode(';',$v);
        foreach($v as $vv){
          $vv = trim($vv);
          if(!$vv) continue;
          $attribute = $attr . $attributeSeparator . $vv;
          print "$object,$attribute,1\n";
        }
      }else
      if(d($attr, $t)){
        if(v($attr, $line ) && v($attr, $line ) === 'Y'){
          $attribute = $attr;
          print "$object,$attribute,1\n";
        }else
        if(v($attr, $line ) && v($attr, $line ) !== 'N'){
          $attribute = $attr . $attributeSeparator . v($attr, $line );
          print "$object,$attribute,1\n";
        }
      }
    }
  }
  fclose($handle);
}
