function ParseModule ([int32] $module) {
    $requiredFuel = [math]::Floor($module / 3) -2; 
    
    if ($requiredFuel -le 0) {
        $requiredFuel = 0
    }

    if ($requiredFuel -gt 0) {
        $requiredFuel+= (ParseModule -module $requiredFuel)
    }
    return $requiredFuel
}

# $modules = @(14,1969, 100756)


$modules = Get-Content "./D1/Data.txt"

$fuel =  $modules | % {ParseModule -module $_};

$sum = 0
$fuel | % { $sum += $_}
$sum