<?php
include_once "./lib.php";
include_once "./amplifier.php";
include_once "./input.php";

function generatePhases(){
    $currentPhases = array(5,6,7,8,9);
    // yield array(9,8,7,6,5);
    $perms = [];
    heapPermutations($currentPhases, sizeof($currentPhases), $perms);
    return $perms;
}
// $baseMem = [3,52,1001,52,-5,52,3,53,1,52,56,54,1007,54,5,55,1005,55,26,1001,54,
// -5,54,1105,1,12,1,53,54,53,1008,54,0,55,1001,55,1,55,2,53,55,53,4,
// 53,1001,56,-1,56,1005,56,6,99,0,0,0,0,10];
$baseMem = getBaseInput();

$maxPhase = -1;
$maxPhaseScore = -100;
foreach (generatePhases() as $phase){
    $input = new ArrayIterator([]);
    $amplifiers = [];

    $score = 0;

    for ($i=0; $i<5;++$i){
        $amp = new Amplifier($baseMem, $phase[$i], $input);
        $gen = $amp->executeProgram($score);
        $score = $gen->current();
        $amplifiers[] = $gen;
    }

    $i = 0;
    $input->append($score);
    $amplifiers[$i]->next();

    while ($amplifiers[$i]->valid()){
        $score = $amplifiers[$i]->current();
        $input->append($score);

        $i = ($i+1)%5;
        $amplifiers[$i]->next();
    }

    if ($score > $maxPhaseScore){
        $maxPhaseScore = $score;
        $maxPhase=$phase;
    }
}
print_r($maxPhase); echo "\n";
echo "Score: $maxPhaseScore\n";

