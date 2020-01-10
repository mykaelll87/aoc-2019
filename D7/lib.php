<?php

function heapPermutations(&$arr, $size, &$out){
  if($size ==1){
      $out[]= $arr;
  } else {
      for($i = 0; $i < $size;$i++ ){
          heapPermutations($arr, $size-1, $out);

          if($size % 2 == 1){
              $t = $arr[0];
              $arr[0] = $arr[$size-1];
              $arr[$size-1] = $t;
          } else {
              $t = $arr[$i];
              $arr[$i] = $arr[$size-1];
              $arr[$size-1] = $t;
          }
      }
  }        
}

function readMemory($mem, $i, $mode){
    return $mode == 0 ? $mem[$mem[$i]] : $mem[$i];
}

function executeProgram($memory, $input){
    return executeProgramMut($memory, $input);
}

function executeProgramMut(&$memory, $input){
    $inputI = 0;
    $i = 0;
    while (true) {
        $val = (string) $memory[$i];
        $code = substr($val, -2);

        $params = substr($val, 0, strlen($val) - 2);
        switch ($code) {
            case 1:
                $params = str_pad($params, 3, '0', STR_PAD_LEFT);
                $memory[$memory[$i + 3]] =
                    readMemory($memory, $i + 1, $params[2]) +
                    readMemory($memory, $i + 2, $params[1]);
                $i += 4;
                break;
            case 2:
                $params = str_pad($params, 3, '0', STR_PAD_LEFT);
                $memory[$memory[$i + 3]] =
                    readMemory($memory, $i + 1, $params[2]) *
                    readMemory($memory, $i + 2, $params[1]);
                $i += 4;
                break;
            case 3:
                $params = str_pad($params, 1, '0', STR_PAD_LEFT);
                
                $memory[$memory[$i + 1]] = $input[$inputI++];
                $i += 2;
                break;
            case 4:
                $params = str_pad($params, 1, '0', STR_PAD_LEFT);
                yield readMemory($memory, $i + 1, $params[0]);
                $i += 2;
                break;
            case 5:
                $params = str_pad($params, 2, '0', STR_PAD_LEFT);
                if (readMemory($memory, $i + 1, $params[1]) != 0) {
                    $i = readMemory($memory, $i + 2, $params[0]);
                } else {
                    $i += 3;
                }

                break;
            case 6:
                $params = str_pad($params, 2, '0', STR_PAD_LEFT);
                if (readMemory($memory, $i + 1, $params[1]) == 0) {
                    $i = readMemory($memory, $i + 2, $params[0]);
                } else {
                    $i += 3;
                }
                break;
            case 7:
                $params = str_pad($params, 3, '0', STR_PAD_LEFT);
                $memory[$memory[$i + 3]] = readMemory($memory, $i + 1, $params[2]) < readMemory($memory, $i + 2, $params[1]) ? 1 : 0;
                $i += 4;
                break;
            case 8:
                $params = str_pad($params, 3, '0', STR_PAD_LEFT);
                $memory[$memory[$i + 3]] = readMemory($memory, $i + 1, $params[2]) == readMemory($memory, $i + 2, $params[1]) ? 1 : 0;
                $i += 4;
                break;
            case 99:
                return $memory;
        }
    }
}

?>