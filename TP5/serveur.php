<?php
if (isset($_GET["q"])) {
    $q = $_GET["q"];
    $result = @scandir($q);
    $response_array = [];
    $dir_array = [];
    $files_array = [];
    if ($result == FALSE) {
        echo 'Aucun répertoire à ce nom n\'a été trouvé';
    } else {
        foreach ($result as $file) {
            if (is_dir("$q/$file")) array_push($dir_array, $file);
            else array_push($files_array, $file);
        }
        array_push($response_array, $dir_array);
        array_push($response_array, $files_array);

        $result_json = json_encode(array("filesArray" => $files_array, "dirArray" => $dir_array));
        echo $result_json;
    }
}

if (isset($_GET["file"])) {
    $file = $_GET["file"];
    $txtBuffer = readfile($file);
    echo $txtBuffer;
}
