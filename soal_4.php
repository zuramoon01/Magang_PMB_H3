<?php    
function decreaseResult($data, $result){
    $tmp = $data;

    foreach($result as $n){
        $tmp -= $n;
    }

    return $tmp;
}

function solution($X, $Y, $K, $A, $B){
    function sliceCake($width, $slice){
        $result = [];
        
        for ($i=0; $i < count($slice); $i++) {
            $data = $slice[$i];
            
            if($i === 0){
                array_push($result, $data);
            }
            else if($i < count($slice)){
                array_push($result, decreaseResult($data, $result));
            }

            if($i === count($slice) - 1){
                array_push($result, decreaseResult($width, $result));
            }
        }
    
        return $result;
    }

    $X = sliceCake($X, $A);
    $Y = sliceCake($Y, $B);

    $result = [];

    for ($i=1; $i < count($X); $i++) {
        for ($j=1; $j < count($Y); $j++) {
            array_push($result, $X[$i] * $Y[$j]);
        }
    }

    foreach($X as $x){
        array_push($result, $x);
    }

    foreach($Y as $y){
        array_push($result, $y);
    }

    for ($i=0; $i < count($result); $i++) {
        for ($j=$i + 1; $j < count($result); $j++) {
            if($result[$i] < $result[$j]){
                $tmp = $result[$i];
                $result[$i] = $result[$j];
                $result[$j] = $tmp;
            }
        }
    }

    return $result[$K - 1];
}

echo solution(6, 7, 3, [1, 3], [1, 5]);