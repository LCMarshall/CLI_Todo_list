<?php

// Create array to hold list of todo items
$items = array();

// unset($items[0]);

function list_items($list){
    $result = '';

    foreach ($list as $key => $value) {
        $result .= "[" . ($key + 1) . "]" . $value . PHP_EOL;
    }
    
    return $result;
}

function read_file($filename = 'data/list.txt') {
    // echo $filename;

    $handle = fopen($filename, 'r');
    $filesize = filesize($filename);
    $todo_string = trim(fread($handle, $filesize));
    $todolist = explode ("\n", $todo_string);

    fclose($handle);
    // var_dump($todolist);
    return $todolist;    
}

function write_file($file_save, $array) {

    $filename = $file_save;
    if (is_writable($filename)) {
        echo "File already exists: overwrite? (Y)es or (N)o?";
        $input = get_input(TRUE); 
        if ($input == 'Y') {
            $handle = fopen($filename, 'w');

            foreach ($array as $item) {
                fwrite($handle, $item . PHP_EOL);
            }
        fclose($handle);
        echo "File save successful \n";
        }
    }   
}

// If the file they are saving to exists, warn the user and ask for them 
// to confirm overwriting the file. If the user chooses not to proceed, 
// cancel the save and return to the main menu with TODOs listed.


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

// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = FALSE) {
    $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;
}    

// The loop!
do {
    echo list_items($items);   

    echo '(N)ew item, (R)emove item, (O)pen file, (S)ort, s(A)ve, (Q)uit : ';

    $input = get_input(TRUE); 
 
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

    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $item = get_input();
        // Remove from array
        unset($items[$key - 1]);
        $items = array_values($items);
    } elseif ($input == 'S') {
        $items = sort_menu($items);
    } elseif ($input == 'F') {
        array_shift($items);
    } elseif ($input == 'L') {
        array_pop($items);
    } elseif ($input == 'O') {
        echo 'Enter file path: ';
        $file_path = get_input();
        $array = read_file($file_path);
        $items = array_merge($items, $array);
    } elseif ($input == 'A') {
        echo 'Enter file path to save to: ';
        $file_save = get_input();
        write_file($file_save, $items);

    }
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors