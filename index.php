<?php

$dbSample = [
    [
        'ident' => 'ident4',
        'value' => 'some value 44',
        'version' => 2,
    ],
    [
        'ident' => 'ident5',
        'value' => 'some value 55',
        'version' => 2,
    ],
    [
        'ident' => 'ident6',
        'value' => 'some value 66',
        'version' => 1,
    ],
    [
        'ident' => 'ident7',
        'value' => 'some value 77',
        'version' => 1,
    ],
    [
        'ident' => 'ident11',
        'value' => 'some value 111',
        'version' => 1,
    ]
];

$queryData = [
    [
        'ident' => 'ident4',
        'value' => 'some value 44',
        'version' => 1,
    ],
    [
        'ident' => 'ident5',
        'value' => 'some value 55',
        'version' => 1,
    ],
    [
        'ident' => 'ident7',
        'value' => 'some value 77',
        'version' => 1,
    ],
    [
        'ident' => 'ident8',
        'value' => 'some value 88',
        'version' => 2,
    ],
    [
        'ident' => 'ident9',
        'value' => 'some value 99',
        'version' => 2,
    ]
];

function sortArray($dataArr)
{
    $sortedArr = [];
    foreach ($dataArr as $arr) {
        if (!($indent = $arr['ident'] ?? null)) {
            continue;
        };
        unset($arr['ident']);
        $sortedArr[$indent] = $arr;
    }
    return $sortedArr;
}

$queryData = sortArray($queryData);
$dbSample = sortArray($dbSample);

function sortQueryData($queryData, $dbSample)
{
    $sortedQueryData = [];
    foreach ($dbSample as $key => $val) {
        if (!isset($queryData[$key])) {
            $sortedQueryData['new'][] = [$key => $val];
            continue;
        }
        if (!$queryData[$key]['version']) {
            continue;
        }
        if ($val['version'] > $queryData[$key]['version']) {
            $sortedQueryData['update'][] = [$key => $val];
        }
        unset($queryData[$key]);
    }
    $sortedQueryData['delete'][] = array_keys($queryData);
    return $sortedQueryData;
}

print_r(sortQueryData($queryData, $dbSample));

