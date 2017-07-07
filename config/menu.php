

<?php

/*
 * Menu
 */

return [
    'home' => [
        'name' => 'Home',
        'icon' => 'zmdi zmdi-home',
        'href' => '/',
        'permission' => false
    ],
    'admin' => [
        'name' => 'Admin',
        'icon' => 'zmdi zmdi-wrench',
        'permission' => 'admin.view',
        'in url' => '/admin/',
        'sub' => [
            'users' => [
                'name' => 'Users',
                'icon' => 'zmdi zmdi-account',
                'permission' => 'admin.users.view',
                'href' => '/admin/users/list',
                'in url' => '/admin/users'
            ]
        ]
    ],
    'students' => [
        'name' => 'Students',
        'icon' => 'zmdi zmdi-graduation-cap',
        'permission' => 'students.view',
        'inurl' => '/student/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'students.list.view',
                'href' => '/student/list',
                'inurl' => '/student/list'

            ],
            'create' => [
                'name' => 'Create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'students.create',
                'href' => '/student/create',
                'inurl' => '/student/create'
            ]
        ]
    ],
    'assignment' => [
        'name' => 'Assignment',
        'icon' => 'zmdi zmdi-assignment',
        'inurl' => '/assignment/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'assignment.list.view',
                'href' => '/assignment/list',
                'in url' => '/assignment/list'
            ],
            'create' => [
                'name' => 'Create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'assignment.create',
                'href' => '/assignment/create',
                'in url' => '/assignment/create'
                ]
            ]
    ],
     'lecturer' => [
        'name' => 'Lecturer',
        'icon' => 'zmdi zmdi-accounts-list',
        'permission' => 'lecturer.view',
        'inurl' => '/lecturer/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'lecturer.view.list',
                'href' => '/lecturer/list',
                'in url' => '/lecturer/list'
            ],
            'create' => [
                'name' => 'Create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'lecturer.create',
                'href' => '/lecturer/create',
                'in url' => '/lecturer/create'
                ]
            ]
    ],
    'lecture' => [
        'name' => 'Lecture',
        'icon' => 'zmdi zmdi-graduation-cap',
        'inurl' => '/lecture/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'lecture.list.view',
                'href' => '/lecture/list',
                'in url' => '/lecture/list'
            ],
            'create' => [
                'name' => 'Create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'lecture.create',
                'href' => '/lecture/create',
                'in url' => '/lecture/create'
            ]
        ]
    ],
    'Quiz' => [
        'name' => 'Quiz',
        'icon' => 'zmdi zmdi-pin-help',
        'inurl' => '/quiz/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'quiz.list.view',
                'href' => '/quiz/list',
                'in url' => '/quiz/list'
            ]
        ]
    ],
    'Batch' => [
        'name' => 'Batch',
        'icon' => 'zmdi zmdi-accounts-list',
        'permission' => 'batch.view',
        'inurl' => '/batch/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'batch.view.list',
                'href' => '/batch/list',
                'in url' => '/batch/list'
            ],
            'create' => [
                'name' => 'Create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'batch.create',
                'href' => '/batch/create',
                'in url' => '/batch/create'
            ]
        ]
    ],
    'Course' => [
        'name' => 'Course',
        'icon' => 'zmdi zmdi-graduation-cap',
        'inurl' => '/course/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'course.list.view',
                'href' => '/course/list',
                'in url' => '/course/list'
            ],
            'create' => [
                'name' => 'Create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'course.create',
                'href' => '/course/create',
                'in url' => '/course/create'
            ]
        ]
    ]

 ];