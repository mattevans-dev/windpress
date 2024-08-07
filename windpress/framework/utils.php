<?php

// function cls(...$classNames)
// {
//     return trim(array_reduce($classNames, function ($classes, $class) {
//         if (is_array($class)) {
//             foreach ($class as $conditionalClass => $condition) {
//                 $classes .= $condition ? "$conditionalClass " : '';
//             }
//         } else {
//             $classes .= "$class ";
//         }
//         return $classes;
//     }, ''));
// }

function className($baseClasses, ...$additionalClasses) {
    // Split the base classes string into an array
    $baseClassesArray = explode(' ', $baseClasses);

    // Merge additional classes with base classes
    $allClasses = array_merge($baseClassesArray, $additionalClasses);

    // Filter out empty classes and join them with a space
    return implode(' ', array_filter($allClasses));
}