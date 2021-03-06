<?php

//initialize variables
$suggest="";
$query="";
$suggestionBox="";

/*filter user input. Vary the method of doing this depending on whether or not magic quotes
**is switched on*/
if (get_magic_quotes_gpc()) {
   $query = htmlentities(strip_tags(stripslashes($_POST['query'])));
} else {
   $query = htmlentities(strip_tags($_POST['query']));
}

//Create an array of words
$words[]="prevent";
$words[]="present";
$words[]="president";
$words[]="prevalent";
$words[]="accumulate";
$words[]="accelerate";
$words[]="actual";

//if there's any user input in the input field, compare against all elements in $words
if (strlen($query) > 0){
    for($i=0; $i<count($words); $i++){
        /*make user input ($query) and array elements ($words[]) lowercase
        **and then compare however many letters of user input against that same number
        **of letters in each $words array element, starting with the first letter*/
        if (strtolower($query) == strtolower(substr($words[$i],0,strlen($query)))){
            /*if no words from the array have been assigned to $suggest yet, 
            **go ahead and put one in there...*/
            if ($suggest == "") {
            $suggest=$words[$i];
            }
            /*...but if something is already assigned to $suggest, do a new line and 
            **append another word from the array*/
            else{
            $suggest = $suggest."\n".$words[$i];
            }
        }
    }
}

//if there are no matches, print error message...
if ($suggest == ""){
  $suggestionBox = "I don't have any words like that. Try again.";
  }
//otherwise, pass suggestion text to the suggestion box
else{
  $suggestionBox = $suggest;
  }

//print the suggestion in the suggestion box
echo $suggestionBox;
?>  
