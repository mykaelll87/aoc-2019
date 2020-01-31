<?php
include_once "./lib.php";

class Amplifier {
  private $memory;
  private $phase;
  private $input;
  
  public function __construct($initialMem, $phase, &$inputGen){
    $this->memory = $initialMem;
    $this->phase = $phase;
    $this->input = $inputGen;
  }

  public function executeProgram($score){
    $input->send($this->phase);

    return executeProgramMut($this->memory, $input);
  }
}