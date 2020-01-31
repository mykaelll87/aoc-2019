<?php
include_once "./lib.php";
include_once "./amplifier.php";

function generatePhases(){
    $currentPhases = array(5,6,7,8,9);

    $perms = [];
    heapPermutations($currentPhases, sizeof($currentPhases), $perms);
    return $perms;
}
$input = new ArrayIterator([]);

$baseMem = [3,26,1001,26,-4,26,3,27,1002,27,2,27,1,27,26,
27,4,27,1001,28,-1,28,1005,28,6,99,0,0,5];

$maxPhase;
$maxPhaseScore = -100;
foreach (generatePhases() as $phase){
    $amplifiers = [];

    $score = 0;

    for ($i=0; $i<5;++$i){
        $amp = new Amplifier($baseMem, $phase[$i], $input);
        $gen = $amp->executeProgram($score);
        $amplifiers[] = $gen;
        $score = $gen->current();
    }

    for ($i = 0; $amplifiers[4]->valid(); $i = ($i+1)%5){
        $input->send($score);
        $amplifiers[$i]->next();
        if ($amplifiers[$i]->valid()){
            $score = $amplifiers->current();
        } else {
            break;
        }
    }

    if ($score > $maxPhaseScore){
        $maxPhaseScore = $score;
        $maxPhase=$phase;
    }
}
print_r($maxPhase);
print($maxPhaseScore);

