<?php

        function dump()
{
    list($callee) = debug_backtrace();
    $arguments = func_get_args();
    $total_arguments = count($arguments);

    echo '<fieldset style="background: #fefefe !important; border:2px red solid; padding:5px;color:#000 ;">';
    echo '<legend style="background:lightgrey; padding:5px;">'.$callee['file'].' @ line: '.$callee['line'].'</legend><pre>';
    $i = 0;
    foreach ($arguments as $argument)
    {
        echo '<br/><strong>Debug #'.(++$i).' of '.$total_arguments.'</strong>: ';
        var_dump($argument);
    }

    echo "</pre>";
    echo "</fieldset>";
}


if (!function_exists('arrayToExcelDos'))
{
    function arrayToExcelDos($query, $fields, $filename = "Excel"){

        if (count($query) == 0) {
            return "The query is empty. It doesn't have any data.";
        } else {
            $headers = "";
            foreach ($fields as $field) {
                $headers .= $field . "\t";
            }

            $data = "";
            foreach ($query as $row) {
                $line = "";
                foreach ($row as $value) {
                    if ((!isset($value)) || ($value == "")) {
                        $value = "\t";
                    } else {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . utf8_decode($value) . '"' . "\t";
                    }
                    $line .= $value;
                }
                $data .= trim($line) . "\n";
            }
            $data = str_replace("\r", "", $data);

            $content = $headers . "\n" . $data;
            $filename = date('YmdHis') . "_export_{$filename}.xls";

            header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment; filename={$filename}");
            header("Content-Length: " . strlen($content));
            header("Pragma: no-cache");

            return $content;
        }
    }
}



?>