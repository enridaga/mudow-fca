<?php

function L(){
  fwrite(STDERR, $m);
}

$contextFilename = $argv[1];

$handle = fopen($contextFilename,'r');

$byObject = array();
if($handle){
  while ( ($line = fgetcsv ( $handle )) !== false ) {
		if($line[2] == '1'){
	      $byObject[$line[0]][] = $line[1];
	    }
	}
  fclose($handle);
}

L( "Objects " . count(array_keys($byObject)) . "\n");

//

$types = array(
	"Dataset",	"Repository",	"Service",	"Software",	"Schema",	"Catalogue",	"Digital Library",	"Ontology",	"Digital edition",	"Format",	"Project"
);
$files = array();
foreach($types as $type){
	$f = fopen('mudow-colatti-'. str_replace(' ','_',$type) . '.csv', 'a');
	$files[$type] = $f;
}
foreach($byObject as $O => $AA){
	$f = NULL;
	foreach($types as $type){
		if(!in_array("Resource type=$type",$AA)){
			continue;
		}else{
			$f = $files[$type];
		}
	}
	if($f === NULL){
		throw new Exception(implode("\n", $AA));
	}
    fwrite($f, $O.','. implode(',',$AA)."\n");	
}
foreach($files as $f){
	fclose($f);
}