<?php

/**
 * 
 * @param array $array
 * @param int $depth
 * @param bool $is_last
 * @return string
 */
function getCode(array $array, int $depth = 0, bool $is_last = false): string{
	$depth++;

	$is_list = array_is_list($array); //since PHP 8.1.0

	$result = sprintf("[%s", $is_list ? "" : "\n");
	foreach($array as $key => $val){

		$key_last = ($key === array_key_last($array));

		if(is_array($val)){
			if($is_list){
				$result .= sprintf("%s", getCode($val, $depth, $key_last));
			}else{
				$result .= str_repeat("\t", $depth);
				$result .= sprintf("%s => %s\n", getPropertyCode($key), getCode($val, $depth, $key_last));
			}
		}else{
			if($is_list){
				$result .= sprintf("%s%s", getPropertyCode($val), $key_last ? "" : ",");
			}else{
				$result .= str_repeat("\t", $depth);
				$result .= sprintf("%s => %s%s\n", getPropertyCode($key), getPropertyCode($val), $key_last ? "" : ",");
			}
		}
	}

	return sprintf("%s%s]%s", $result, ($is_list ? "" : str_repeat("\t", $depth - 1)), (($depth == 1) || $is_last) ? "" : ",");
}

/**
 * 
 * @param type $property
 * @return string
 * @throws Exception
 */
function getPropertyCode($property){
	if(is_string($property)){
		return sprintf('"%s"', $property);
	}elseif(is_bool($property)){
		return sprintf('%s', $property ? 'TRUE' : 'FALSE');
	}elseif(is_numeric($property)){
		return $property;
	}elseif(is_null($property)){
		return 'NULL';
	}else{
		throw new Exception('getPropertyCode: Undefined property type.');
	}
}
