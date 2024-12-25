<?php
function validatePlanForm($data) {
    $errors = [];
    
    if (empty($data['title'])) {
        $errors['title'] = 'Title is required';
    }
    
    if (!isset($data['amount']) || !is_numeric($data['amount']) || $data['amount'] <= 0) {
        $errors['amount'] = 'Please enter a valid amount';
    }
    
    if (!isset($data['duration']) || !in_array($data['duration'], [1, 3, 6, 12])) {
        $errors['duration'] = 'Please select a valid duration';
    }
    
    return $errors;
}
?>