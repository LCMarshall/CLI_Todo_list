<?php

// Create array to hold list of todo items
$items = array();

// unset($items[0]);

/// List array items formatted for CLI
function list_items($list){
    $result = '';

    foreach ($list as $key => $value) {
        $result .= "[" . ($key + 1) . "]" . $value . PHP_EOL;
    }
    
    return $result;
}

function sort_menu ($items) {
    

    echo '(A)-Z, (Z)-A, (O)rder entered (R)everse order entered:';
        $input = get_input(true);
    
    if ($input == 'A') {
        asort($items);
    } elseif ($input == 'Z') {
        arsort($items);
    } elseif ($input == 'O') {
        ksort($items);
    } elseif ($input == 'R') {
        krsort($items);

    }
    return $items;

}

// When a new item is added to a TODO list, 
// ask the user if they want to add it to the beginning or end of the list. 
// Default to end if no input is given.


// Add a (S)ort option to your menu. When it is chosen, 
// it should call a function called sort_menu().

// When sort menu is opened, show the following options 
// "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered".

// When a sort type is selected, order the TODO list accordingly 
// and display the results.

    // Return string of list items separated by newlines.
    // Should be listed [KEY] Value like this:
    // [1] TODO item 1
    // [2] TODO item 2 - blah
    // DO NOT USE ECHO, USE RETURN

    //loop through the list
    //foreach or for
    //foreach ($list as $key => $value)

// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = FALSE) {
    $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;
}

    // if ($upper) {
    //     return strtoupper($result);
    // } 
    // else {
    //     return $result;
    // }
    // Return filtered STDIN input

// The loop!
do {
    // // Iterate through list items
    // foreach ($items as $key => $item) {
    //     // Display each item and a newline
    //     echo "[{$key}] {$item}\n";
    // }
    
    // Show the menu options

    echo list_items($items);   

    echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';

    $input = get_input(TRUE); 

    // Get the input from user
    // Use trim() to remove whitespace and newlines   

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $item = get_input();
        echo "Would you like to add this to item to the (B)eginning or (E)nd of your ToDo list?";
        $input = get_input(TRUE);
        if ($input == 'B'){
            array_unshift($items, $item);
            } else {
            array_push($items, $item); 
            }      
// Allow a user to enter F at the main menu to remove the first item 
// on the list. This feature will not be added to the menu, 
// and will be a special feature that is only available to "power users". 
// Also add a L option that grabs and removes the last item in the list.
    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $item = get_input();
        // Remove from array
        unset($items[$key - 1]);
        // $items = array_values($items);
    } elseif ($input == 'S') {
        $items = sort_menu($items);
    } elseif ($input == 'F') {
        array_shift($items);
    } elseif ($input == 'L') {
        array_pop($items);
    }
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors