function ParseModule () {
    return [math]::Floor($_ / 3) -2
}


$modules = Get-Content "./D1/Data.txt"

$fuel =  $modules | % {ParseModule};

$sum = 0
$fuel | % { $sum += $_}
$sum