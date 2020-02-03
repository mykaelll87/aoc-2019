<?php
include_once "./input.php";
include_once "./lib.php";

function execAmplifier($phase, $input){
    $memory = getBaseInput();

    $program = executeProgram($memory, array($phase,$input));
    foreach ($program as $output) {
        return $output;
    }
}

function generatePhases(){
    $currentPhases = array(0,1,2,3,4);

    $perms = [];
    heapPermutations($currentPhases, sizeof($currentPhases), $perms);
    return $perms;
}

$maxPhase;
$maxPhaseScore = -100;
foreach (generatePhases() as $phase){
    $score = 0;
    for ($i=0; $i<5;++$i){
        $score = execAmplifier($phase[$i], $score);
    }
    
    if ($score > $maxPhaseScore){
        $maxPhaseScore = $score;
        $maxPhase=$phase;
    }
}
print_r($maxPhase);
print($maxPhaseScore);

