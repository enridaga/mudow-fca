<?php

ini_set('memory_limit','2048M');

global $latticeFilename;
$latticeFilename = $argv[1];

function find($cID){
  print "Finding $cID\n";
  global $latticeFilename;
  $handle = fopen($latticeFilename,'r');
  $concept = array();
  if($handle){
    while ( ($line = fgetcsv ( $handle )) !== false ) {
  		if($line[0] == trim($cID)){
        $concept = $line;
        break;
      }
  	}
    fclose($handle);
    concept($concept);
  }else{
    throw new Exception('File not found');
  }
}

function lattice($outputFilename = NULL){
	global $latticeFilename;
	if($outputFilename == NULL){
		$outputFilename = pathinfo($latticeFilename, PATHINFO_FILENAME) . '-distribution.csv';
	}
    $handle = fopen($latticeFilename,'r');
	if($handle){
      while ( ($line = fgetcsv ( $handle )) !== false ) {
        $c = $line[0];
        $ext = count(explode('|',$line[1]));
        $int = count(explode('|',$line[2]));
		$extent = $line[1];
		$intent = $line[2];
		$subs="";
		if(trim($line[3])){
			$subs = $line[3];
		}
		$data = "$c,$ext,$int,$extent,$intent,$subs\n";
		file_put_contents($outputFilename, $data, FILE_APPEND | LOCK_EX);
      }
      fclose($handle);
    }else{
      throw new Exception('File not found');
    }
}

function rules($outputFilename = NULL){
	global $latticeFilename;
	if($outputFilename == NULL){
		$outputFilename = pathinfo($latticeFilename, PATHINFO_FILENAME) . '-rules.csv';
	}
    $handle = fopen($latticeFilename,'r');
	$lattice = array();
	$top = NULL;
	$items = array();
    if($handle){
      while ( ($line = fgetcsv ( $handle )) !== false ) {
		  $lattice[$line[0]] = array(
			  $line[0],
			  explode('|',$line[1]),
			  explode('|',$line[2])
		  );
		  $items = array_merge($lattice[$line[0]][1],$items);
	      $ext = trim($line[1]);
	      if(!$ext) {
			  $top = $line[0];
		  }
		  $subs = trim($line[3]);
		  if($subs){
			  $lattice[$line[0]][3] = explode('|',$line[3]);		  	
		  }
      }
      fclose($handle);
    }else{
      throw new Exception('File not found');
    }

	// Generate rules
	$rules = array();
	$items = array_unique($items);
	// Start from the top
	$visit = array();
	$visited = array();
	array_push($visit, $top);
	
	while(!empty($visit)){
		$v = array_shift($visit);
		// If not already visited
		if(!in_array($v, $visited)){
			array_push($visited, $v);
		}else{
			continue;
		}
		$c = $lattice[$v];

		if(!isset($c[3])){
			continue;
		}		
		foreach($c[3] as $s){
			// Add subs to items to visit
			if(!in_array($s,$visited) && !in_array($s,$visit)){
				array_push($visit, $s);
			}
			
			// If this attributes set has any items
			if(count($c[1]) == 0) 
				continue;
			
			// head is the consequent, body the antecedent
			$antecedent = $lattice[$s][2];
			$consequent = array_diff($c[2], $antecedent);
			$support = round(count($c[1]) / count($items),3);
			$confidence = round(count($c[1]) / count($lattice[$s][1]),3);
			
			$head = implode(' & ',$consequent);
			$body = implode(' & ',$antecedent);
			
			$data = "$head,$body,$support,$confidence\n";
			file_put_contents($outputFilename, $data, FILE_APPEND | LOCK_EX);
		}
	}
}

function superRelations($cID){
  global $latticeFilename;
  $handle = fopen($latticeFilename,'r');
  $concept = array();
  $sups = array();
  $n = 0;
  if($handle){
    while ( ($line = fgetcsv ( $handle )) !== false ) {
		$n++;
      $s = trim($line[3]);
      if(!$s) continue;
      $s = explode('|',$line[3]);
      if(in_array($cID, $s)){
        array_push($sups, $line[0]);
      } 
    }
  }
  fclose($handle);
  return $sups;
}

function concept($concept){
  if(empty($concept)) return;
  print "ID: " . $concept[0] . "\n";
  $ext = explode('|', $concept[1]);
  print "Extent: " . count($ext) . "\n";
  print " - " . implode("\n - ",$ext) . "\n";
  $int = explode('|', $concept[2]);
  print "Intent: " . count($int) . "\n";
  print " - " . implode("\n - ",$int) . "\n";
  if($concept[3]){
    $srr = explode('|', $concept[3]);
    print "Subconcepts: " . count($srr) . "\n";
    print implode(" ",$srr) . "\n";
  }
  
  $sups = superRelations($concept[0]);
  if($sups){
    print "Superconcepts: " . count($sups) . "\n";
    print implode(" ",$sups) . "\n";
  }
}

function top(){
  global $latticeFilename;
  $handle = fopen($latticeFilename,'r');
  $concept = array();
  if($handle){
    while ( ($line = fgetcsv ( $handle )) !== false ) {
      if(!trim($line[1])){
        $concept = $line;
        break;
      }
    }
    fclose($handle);
    concept($concept);
	return "";
  }else{
    throw new Exception('File not found');
  }
}

function _bottom(){
  global $latticeFilename;
  $handle = fopen($latticeFilename,'r');
  $concept = array();
  if($handle){
    while ( ($line = fgetcsv ( $handle )) !== false ) {
      if(!trim($line[2]) || !trim($line[3])){
        $concept = $line;
        break;
      }
    }
    fclose($handle);
    return $concept;
  }else{
    throw new Exception('File not found');
  }
}
function bottom(){
    concept(_bottom());
}

function layer($layer = 1){

    global $latticeFilename;
    $handle = fopen($latticeFilename,'r');
    $lattice = array();
    if($handle){
      while ( ($line = fgetcsv ( $handle )) !== false ) {
		  $lattice[$line[0]]=$line;
      }
      fclose($handle);
    }else{
      throw new Exception('File not found');
    }

	// From the bottom
	$lc = 0;
	$layerConcepts = array();
	$b = _bottom();
	array_push($layerConcepts, $b[0]);
	while($lc <= $layer){
		if($lc == $layer){
			// Print layer
			foreach($layerConcepts as $cId){
				$c = $lattice[$cId];
				print $c[0];
				print "\t";
				print count(explode('|',$c[1]));
				print "\t";
				print $c[2];
				print "\n";
			}
		}else{
			$nextLayer = array();
			foreach($layerConcepts as $cId){
				$sups = superRelations($cId); // FIXME Inefficient!
				$nextLayer = array_merge($nextLayer, $sups);
			}
			$layerConcepts = $nextLayer;
		}
		$lc++;
	}
}

function select(){

  $args = func_get_args();
  $args = implode(' ', $args);
  $selects = explode(' & ', $args);

  $idss = array();
  foreach($selects as $select){
    $args = explode(' ',$select);
    $aspect = trim($args[0]);
    $operator = trim($args[1]);
    $value = intval(trim($args[2]));
      print " -- $aspect $operator $value -- \n";
      global $latticeFilename;
      $handle = fopen($latticeFilename,'r');
      $concept = array();
      if($handle){
        $ids = array();
        while ( ($line = fgetcsv ( $handle )) !== false ) {
          $k = '';
          switch($aspect){
            case 'extent':
              $k = 1;
            break;
            case 'intent':
              $k = 2;
            break;
            case 'sub':
              $k = 3;
            break;
          }
          if($line[$k]){
            $nb = count(explode('|', $line[$k]));
            switch($operator){
              case '=':
                if($nb == $value) {array_push($ids, $line[0]);}
              break;
              case '<':
                if($nb < $value) {array_push($ids, $line[0]);}
              break;
              case '>':
                if($nb > $value) {array_push($ids, $line[0]);}
              break;
            }
          }
        }
        fclose($handle);
      }else{
        throw new Exception('File not found');
      }
      if(empty($idss)){
        // echo "first " . count($ids) . "\n";
        $idss = $ids;
      }else{
        $idss = array_intersect($idss, $ids);
        // echo "rest " . count($ids) . "\n";
      }

      // echo "idss " . count($idss) . "\n";
  }
  print implode(' ', $idss);
  print "\n";
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
