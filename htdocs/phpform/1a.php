<?php
$a=10;
$b=20;
$c=$a+$b;
echo "\naddtion\t".$c;
$c=$a-$b;
echo "\nsub\t".$c;
$c=$a*$b;
echo "\nmulti\t".$c;
$c=$a/$b;
echo "\nmod\t".$c;
?>

<?php

$A=5;   
$A++;     //Post Increment  
echo "After Post Increment Value of A is : ".$A . "<br>"; 

// --$A;      //Pre Decrement    
echo "After Pre Decrement Value of A is : ". $A . "<br>";  
$B = 6;  
$C = &$B ;//Reference Variable    
$C++ ;    //Increment Reference Variable Value          
echo "Value of B is : ". $B . "<br> ";                                            
echo "Value of C is : ". $C . "<br><br>" ;      

?>

<?php
$x=5;
$y=5;
var_dump($x==$y)
?>

<?php

    $a=5;
    $b=4;

    $c= $a > $b ? 'greater' : 'smaller';
    echo "$a is {$c} than $b";

    $d=$a && $b;
    $e=$a || $b;
    var_dump( $d);
    var_dump( $e);
    $f=!$a;
    var_dump($f);
?>


<?php 

$age=10;
if ($age>18) {
    # code...

        echo "\n You are eligible for voting." ;
} else{
    echo "\n Sorry, you are not eligible for voting yet.";}

?>


<?php

$age =17;

if ($age>=18) {
    echo "yes you can vote";
}elseif($age ==17){
    echo "please wait one more year";
}else
    echo "you cannot vote";

?>


<?php
$age=15;
if ($age>=18) {
    if ($age<66) {
        # code...
        echo "yes you can vote";
    }else{
        echo "you cannot vote anymore";
    }
    # code...
}else{
    echo "you cant  vote yet";
}



?>
<?php


// Array

$arr1 = array("car1","car2","car3"); //Declare
print_r ($arr1);                       //Print all elements of an array in a human-readable format.
var_dump($arr1);                     
echo "</pre>";

// multi
// Dimension Array
$multiarray[0][0] ="Hello";   // Declare and initialize an element of the multi-dimensional array
echo $multiarray[0][0];         // Accessing the element of the multi-dimensional array


// Associative Arrays
$associate_array = array ("fname"=>"John", "lname"=>"Doe", "age"=>25, "city"=>"New York");
echo $associate_array["fname"];     //Accessing the value of associate array by its key name i.e., fname
echo $associate_array["lname"];     //Accessing the value of associate array by its key name i.e., fname

// Add Element to associative arrays   
// 3 

?>


<?php


// function


function greet(){

 echo "welcome to  my website!<br/>";
 echo "welcome to  GFE !<br/>";

    return;    
}
 greet();

// Recursive Function

?>


<?php

$car =  array(
    0 => 'Volvo',
    1 => 'BMW',
    2 => 'Saab',
    3=> 'Audi');

var_dump(is_array($car))     ;   // check whether it is an array or not
echo "<pre>";
print_r($car);                      // print all elements in array
echo "</pre>";



echo "<pre>";
print_r($car);   // print all elements in an array

$x=4;   

?>

<?php


$x= array("car1", "car2","car3","car4","car5");
        // create a new array
        echo "<pre>";
        print_r($x);
        echo "</pre>";
$y= array("car6", "car7","car8","car9","car10");
        // create a new array
        echo "<pre>";
        print_r($y);
        echo "</pre>";

$z= array_merge($x,$y); 

echo "<pre>";
print_r($z);
echo "</pre>";


// merge two arrays
//print_r(array_push($x,"car11"));         // add value to the end of the array
//print_r(array_pop($x));              // remove last element from the array
//print_r(array_shift($x));            // remove first element from the array
//print_r(array_unshift($x,"car0"));    // add value to the beginning of the array

/*
Arrays can also be sorted. There are different types of sort available:

SORT_ASC - will sort the values in ascending order. This means that all the values starting with A will come before the ones
SORT_ASC - used for ascending order. It sorts the values in ascending order. 
SORT_DESC - used for descending order. It sorts the values in descending order.  
*/
sort($x, SORT_ASC);                // sort the array in ascending order
print_r($x);

echo "<br/>";

rsort($x);                      // sort the array in descending order
print_r($x);

echo "<br/>";   

$key = array_search('car3', $x);     // search for a key in an array
if ($key === false) {   
    echo 'The car is not found';          // if the car is not found it will display this message
} else {
    echo 'The car is at index '. $key;    // if the car is found it will display its position
}

?>


<?php

// user defined function

function p($data){

    echo"<pre>";
    print_r($data);
    echo"<pre>";
}

$x = array(
    "car1",
    "car2",
    "car3",

);

p($x);
?>


<?php


$age=40;

function vote($age)
 {
    
if ($age >= 18 && $age<=65) {
 return "yes you can vote";

}else {
    return "sorry, you are not eligible to vote";

}
}

echo "Age 15:" .vote(15)."<br>";
echo "Age 20 :" .vote(20)."<br>";
echo "Age 25 :" .vote(25)."<br>";
echo "Age 30 :" .vote(30)."<br>";
echo "Age 35 :" .vote(35)."<br>";
echo "Age 40 :" .vote(40)."<br>";
echo "Age 45 :" .vote(45)."<br>";

?>

<?php

// loop in php
// while loop
// do  while loop   
// for loop
//  foreach loop

// while loop 
/*

    A whil loop is to execute a statement or code block repeatedly as long conition is true
  
    
    Once the condition v=becomes false the loop terminates


    it is also called entry control loop

$i=0;

while($i < 5){
echo "aksh"
. $i++ ;
}
 
*/

$i=1;
$b=2;
while ($i <= 10) {
    // echo "aksh<br/>";
    // echo $i."<br/>";
    echo $b."X".$i."=".$i*$b."<br>";
    $i++;
}


?>



<?php

/*
What is for loop

A loop is used to repeat a block of code until the specifield conition is met


when similer task is needed to be done again and again


save time andleads to code reusability

for ($i=0; $i < ; $i++) { 
    # code...
}



*/

for ($i=0; $i <=10 ; $i++) { 
    # code...
    echo $i."<br/>";
    
}



?>



<?php


/*

Do-while

do {
    # code...
} while ($a <= 10);


*/
$i=1;

while ($i <= 10) {
    # code...
    echo$i . "<br>";
    $i++;
}

echo "------------------------------ <br>" ;

$j = 1;

do {
    # code...
    echo $j ."<br>";
    $j ++;
} while ($j <= 10); 


?>


<?php

/*
foreach



*/
$arr=[
    "aksh"=>2500,
    "himanshu"=>3000,
    "dofo"=>250,
    "html"=>250,
];

echo "<pre>";
print_r($arr);
echo "</pre>";

foreach ($arr as $cours => $loan) {
    echo "total fees is $cours is $loan\n";
    # code...
}

?>
<?php

/*

#Break  statement  in php


#The break  statement is used to break the execution current loop or switch case

# As soon as it enoutered the flow of he program goes to next statement of loop or switch  case.

#   It does not execute any statements after that .
*/


$i =1;
while($i<10){
    if ($i==5) {
        # code...
        break;
    }
    echo $i."<br/>";
    $i++;
}
echo "loops end";
?>




<?php


/*

# continue statement

# The  continue statement is used to skip the current itretion  and go to nxt iteration


*/

for ($i=0; $i <=50 ; $i++) { 
    # code...
    if ($i%2!=0) {
        continue;
    }
    $count++;
    echo "$i<br/>";
}

echo"------------------------------<br/>";
echo $count;

?>


<?php

/*
Switch

# Switch statement is used to choose in between many cases

# it works same as nested  if-else  statements 

 */

$age=66;
switch ($age) {
    case ($age >=18 && $age<= 65):
        # code...
        echo "yes you can vote";
        break;
    case (18 - $age == 1):
        # code...
        echo "please wait one more yer";
        break;

    case ( $age > 65):
        # code...
        echo "your are old to vote";
        break;
    
    default:
        # code...
        echo "no you cannont vote ";
        break;
}
?>



<?php

/*

# Rcursion of function

function grren(){
    echo "aksh";
    grren();
}

*/


function aksh($me){
    if($me<=10){
        echo "$me <br/>";
        $me++;
        aksh($me);
}else{
    return;
}
}
aksh(0);

?>


<?php

/*

implode()method


The imploed() function returns a string from the  elements of an array. It takes two parameters:

implode(separator,array)


*/


$arr =[
    '1','2','3'
];

$str = implode('-',$arr);
echo "String :".$str."<br/>";

?>


<?php


/*

case changing methods
1. strtolower() - Converts all alphabets in a string to lower case.
2. strtoupper() - Converts all alphabets in a string to upper case.
3. ucfirst()     - Converts the first character of a string to upper case and makes the rest lower case.
4. ucwords()     - Conver ts the first character of each word to upper case and makes the rest lower case.
5. strrev()      - Reverses a string.
6. strtr()       - Translates characters or replaces substrings.
7. sprintf()     - Formats and inserts variables into a string.
8. printf()      - Outputs a formatted string.
9. fprintf()     - Writes a formatted string to file pointer.





*/
$str="Hello World!";

echo strtolower( $str )."<br/>"; //Output: hello world!
echo strtoupper($str)."<br/>";//Output:  HELLO WORLD!
echo ucfirst($str)."<br/>";//Output:    Hello world!
echo ucwords($str)."<br/>";//Output:   Hello World!
echo strrev($str)."<br/>";//Output: !dlroW olleH

?>

<?php

/**
 * str_replace()function
 * str_replace():This function is used to find a replace any character,ord or sub string in string.
 
 */

 $name="aksh patel";

echo str_replace( "a","A",$name);//Rep aksh => Aksh
echo str_replace( "patel","kumar",$name);//Rep patel =>kumar

?>


<?php

/**
 * strrev()function
 * strrev(): it used to reverse a string
 * eg. Aksh Patel as  output : elPat Aks
 * 
 */

 $str="Aksh Patel";

 echo  strrev($str);

?>
<?php

/**substr()function
 * syntax : substr(string,start,lenght);
 * string : requied
 * start : requied
 * lenght : optional
 * 
 */
$str="Aksh Patel";
echo "<br/>".substr($str,0,5)."<br/>"; //output: Aksh
    echo "<br/>".substr($str,6)."<br/>";   //output: Patel
     echo "<br/>".substr($str,-4)."<br/>";  //output: El    

?>

<?php

/**
 * str_word_count()
 * strlen()
 * str_repeat()
 */


$str="Hello World Hello PHP";
//Returns the number of words inside a string
echo "Number Of Words In String Is : ".str_word_count($str)."<br/>";

//Returns The Length Of A String
echo "Length Of String Is : ".strlen($str)."<br/>";

//Repeat A Given Value N Times
echo str_repeat("*",10)."<br/>";

?>

<?php

/*
 *rand() | random number function in php
 * Syntax : rand([minimum value],[maximum value])
 * If no argument is given then it will return a random integer between 0 and the maximum value which is equal to RAND_MAX.
 * If minimum and maximum values are not given then it will return a random integer between 0 and getrandmax().
 * If we do not provide any argument to this function then it will return a random integer between 0 and 214748
 * If we do not provide any argument to this function then it will return a random integer between 0 and 214748
 * min.value = 0 and max.value = getmaxval()
 * If we don't provide any argument to this function then it will return a random integer between 0 and getmaxval(). - 1 - 1 - 1
 * If we don't pass any argument to rand(), it will return a random integer between 0 and getmaxval().
 */

    echo rand(1,100);
    echo "<br/>";
    echo rand();

?>

<?php


/**
 * ceil and floor function  in php are used for rounding up or down a floating-point value to the nearest whole number
 * sprintf() is used to create a formatted string using an array or list of variables.
 * It returns a formatted string.
 */
    $name="Rahul Sharma";
    $age=25;
    $country="India";
    
    //Without Using Array
   /* echo "Name : ".$name."<br>";
    echo "Age : ".$age."    <br>";
    echo "Country : ".$country."<br>";*/
    
    //Using Array
    printf("Name : %s\n Age : %d \n Country : %s\n",$name,$age,$country);




    $a=8/7;
    echo $a."original <br/>";
    echo ceil( $a)."ceil <br/>";
    echo floor($a) ."floor <br/>";
    echo round($a) ."round <br/>";

?>

<?php

/**
 * pow and sqrt function
 *   
 * The pow() function raises the base number to the power of the exponent.    
 * If you pass in two arguments, it calculates the result of the first argument raised to the second argument.
 *  If the base number or exponent is negative, it  will return NaN (Not a Number). 
 *     If both are zero, it will return  1.
 *     If only the base number is zero 
 */

 echo sqrt(pow(20,2));


?>



<?php


/** date_default_timezone_set
 * getdatae() function
 */
echo  "Today's Date: ".date('Y-m-d');
//Set timezone for your application by using this function
date_default_timezone_set('Asia/Kolkata');
echo "<br>Current Time:".date("h:i:sa");
$timestamp = time(); // Returns current UNIX timestamp
echo "<br> Current Timestamp :".$timestamp;

?>

<?php

/**
 *
 
 */






?>