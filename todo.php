<?php

// Create array to hold list of todo items
$items = array('');
unset($items[0]);

/// List array items formatted for CLI
function list_items($list){
    $result = '';

    foreach ($list as $key => $value) {
        $result .= "[{$key}] $value" . PHP_EOL;
    }
    
    return $result;
}
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
    echo list_items($items);
    // Show the menu options
    echo '(N)ew item, (R)emove item, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(TRUE);

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = get_input();
    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        unset($items[$key]);
    }
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors