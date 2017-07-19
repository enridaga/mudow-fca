<?php

ini_set('memory_limit','2048M');

global $rulesFilename;
$rulesFilename = $argv[1];

function select(){
	$args = implode(' ',func_get_args());
	$args = explode(' & ', $args);
	$conditions = array();
	foreach ($args as $arg){
		array_push($conditions, explode(' ', $arg));
	}

	global $rulesFilename;

    $handle = fopen($rulesFilename,'r');
	if($handle){
      while ( ($line = fgetcsv ( $handle )) !== false ) {
		  $rule = $line;
		  $include = TRUE;
		  foreach($conditions as $con){
			  $left = NULL;
			  $right = trim($con[2]);
			  switch($con[0]){
				  case 'c':
				  $left = floatVal($rule[3]);
				  break;
				  case 's':
				  $left = floatVal($rule[2]);
				  break;
				  case 'h':
				  $left = $rule[0];
				  break;
				  case 'b':
				  $left = $rule[1];
				  break;
				  default:
					  $include = FALSE;
			  }
			  switch($con[1]){
				  case '~':
				  $left = strtolower($left);
				  $right = strtoLower($right);
				  if(strpos($left, $right) === FALSE){
					  $include = FALSE;
				  }
				  break;
				  case '>':
				  if(!($left > floatVal($right))) $include = FALSE;
				  break;
				  case '>=':
				  if(!($left >= floatVal($right))) $include = FALSE;
				  break;
				  case '<':
  				  if(!($left < floatVal($right))) $include = FALSE;
				  break;
				  case '<=':
				  if(!($left <= floatVal($right))) $include = FALSE;
				  break;
				  case '<>':
					$right = explode(',',$right);
  				  	if(!($left <= floatVal($right[1]) && $left >= floatVal($right[0]))) {
						$include = FALSE;
  				  	}
					break;
				  default:
					$include = FALSE;
			  }
		  }
		  if($include){
		  	print rule($rule);
		  }
      }
      fclose($handle);
    }else{
      throw new Exception('File not found');
    }
}

function relevance( $c_trashold = 0.9, $s_trashold = 0.3){
	global $rulesFilename;
    $handle = fopen($rulesFilename,'r');
	$dimensions = array();
	if($handle){
      while ( ($line = fgetcsv ( $handle )) !== false ) {
		  $rule = $line;
		  // 2 support
		  // 3 confidence
		  if(floatVal($rule[2]) < $s_trashold) continue;
		  if(floatVal($rule[3]) < $c_trashold) continue;
		  if(!isset($dimensions[$rule[0]])){
		  	$dimensions[$rule[0]] = $rule;
		  }else{
			  if(floatVal($rule[3]) > floatVal($dimensions[$rule[0]][3])){
  			  	$dimensions[$rule[0]] = $rule;
			  }else if(floatVal($rule[3]) == floatVal($dimensions[$rule[0]][3])){
				  // Check Support then
				  if(floatVal($rule[2]) > floatVal($dimensions[$rule[0]][2])){
	  			  	$dimensions[$rule[0]] = $rule;
				  }
			  }
		  }
      }
      fclose($handle);
    }else{
      throw new Exception('File not found');
    }
	usort($dimensions, function($a, $b) { 
		$aa = $a[3];
		$bb = $b[3];
		if ($aa == $bb){
			// Check support
			$aa = $a[2];
			$bb = $b[2];
			if($aa == $bb){
				return 0;
			}
		}
		return ($aa < $bb) ? 1 : -1; 
	});
	foreach($dimensions as $k => $d){
		print $d[3] . "\t" . $d[2] . "\t" . $d[0] . ' <- ' . $d[1] . "\n";
	}
}

function rule($rule){
	print "(" . $rule[0] . ")\n\t <- (" .$rule[1].")\n\t (s: " . $rule[2] . ", c: " .$rule[3] .")\n";
}

print " > ";
while($f = fgets(STDIN)){
    $args = explode(' ', $f);
    $cmd = trim($args[0]);
    if(function_exists($cmd)){
      array_shift($args);
      call_user_func_array($cmd,$args);
    }else if(count($args) == 1 && trim($args[0]) !== '' ){
      find($args[0]);
    }else{
      print "... ops!\n";
    }
    print " > ";
}