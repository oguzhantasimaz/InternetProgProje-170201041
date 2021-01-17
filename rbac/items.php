<?php
return [
    'createNote' => [
        'type' => 2,
        'description' => 'Create a note',
    ],
    'updateNote' => [
        'type' => 2,
        'description' => 'Update note',
    ],
    'deleteNote' => [
        'type' => 2,
        'description' => 'Delete note',
    ],
    'seeAllNotes' => [
        'type' => 2,
        'description' => 'See All Notes',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'createNote',
            'updateNote',
            'deleteNote',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'seeAllNotes',
            'user',
        ],
    ],
];
//
