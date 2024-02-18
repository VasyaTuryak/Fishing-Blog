<?php
/    $s = "()[]))";
//    $s = "()[]{}";
//    $s = "(]";
//    $s='[[[[';
//    $s='[';
//    $s='([][[[))';
//    $s='([])';
$s="()[]{}[";

$NewArray = str_split($s);
$length = count($NewArray);
$finish=null;
$result='';
$result1='';
$result2='';
$result3='';

$resultArray=[];

if($length%2!==0){
    $result='odd';
}elseif ($NewArray[0]===')' or $NewArray[0]===']' or $NewArray[0]==='}'){
    $result='start from close';
}elseif ($NewArray[$length-1]==='(' or $NewArray[$length-1]==='[' or $NewArray[$length-1]==='{'){
    $result='end from open';
}else{

    //work with '[]'

    $newArray1 = $NewArray;
    for ($i = 0; $i < $length; $i++) {
        if ($newArray1[$i] !== '[' and $newArray1[$i] !== ']') {
            unset($newArray1[$i]);
        }
    }

    $newString=implode('',$newArray1);
    $CutArray1= str_split($newString);

    if(empty($CutArray1)){
        $result1='odd [';
    }elseif ($CutArray1[0]===']'){
        $result1='start from close ]';
    }elseif ($CutArray1[count($CutArray1)-1]==='[') {
        $result1 = 'end from open [';
    }else{
        for ($i = 0; $i < count($CutArray1)-1; $i+=2) {
            if ($CutArray1[$i] === '[' and $CutArray1[$i+1] === ']') {
                // All closed [ ]
                $result1='';
            }else{
                $result1='Not closed [ ]';
                break;
            }
        }
    }

    //work with '()'

    $newArray2 = $NewArray;
    for ($i = 0; $i < $length; $i++) {
        if ($newArray2[$i] !== '(' and $newArray2[$i] !== ')') {
            unset($newArray2[$i]);
        }
    }

    $newString=implode('',$newArray2);
    $CutArray2= str_split($newString);

    if(empty($CutArray2)){
        $result2='odd (';
    }elseif ($CutArray2[0]===')'){
        $result2='start from close )';
    }elseif ($CutArray2[count($CutArray2)-1]==='(') {
        $result2 = 'end from open (';
    }else{
        for ($i = 0; $i < count($CutArray2)-1; $i+=2) {
            if ($CutArray2[$i] === '(' and $CutArray2[$i+1] === ')') {
                // All closed ( )
                $result2='';
            }else{
                $result2='Not closed ( )';
                break;
            }
        }
    }

    //work with '{ }'

    $newArray3 = $NewArray;
    for ($i = 0; $i < $length; $i++) {
        if ($newArray3[$i] !== '{' and $newArray3[$i] !== '}') {
            unset($newArray3[$i]);
        }
    }

    $newString=implode('',$newArray3);
    $CutArray3= str_split($newString);

    if(empty($CutArray3)){
        $result3='odd {';
    }elseif ($CutArray3[0]==='}'){
        $result3='start from close }';
    }elseif ($CutArray3[count($CutArray3)-1]==='{') {
        $result3 = 'end from open {';
    }else{
        for ($i = 0; $i < count($CutArray3)-1; $i+=2) {
            if ($CutArray3[$i] === '{' and $CutArray3[$i+1] === '}') {
                // All closed { }
                $result3='';
            }else{
                $result3='Not closed { }';
                break;
            }
        }
    }
}

//    dd(count($CutArray1)%2!==0 );

//    echo '0 - zero: '.$result .PHP_EOL;
//    echo '1 - [: '.$result1 .PHP_EOL;
//    echo '2 - (: '.$result2 .PHP_EOL;
//    echo '3 - {: '.$result3 .PHP_EOL;



if(empty($result) and empty($result1) and empty($result2) and empty($result3)){
    $finish=true;
}else{
    $finish=false;
}



dd($finish);
return $finish;

//    dd($finish);
//    dd($CutArray1);
//    dd($resultArray);

//    '(', ')', '{', '}', '[' and ']'


