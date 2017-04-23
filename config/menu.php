

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
        'inurl' => '/students/',
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
        'permission' => 'assignment.view',
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
                'name' => 'create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'md-file-plus',
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
            'name' => 'create',
            'icon' => 'zmdi zmdi-plus',
            'permission' => 'assignment.create',
            'href' => '/assignment/create',
            'in url' => '/assignment/create'
            ]
        ]
    ],
    'lecture' => [
        'name' => 'Lecture',
        'icon' => 'zmdi zmdi-graduation-cap',
        'permission' => 'lecture.view',
        'inurl' => '/lecture/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'lecture.view.list',
                'href' => '/lecture/list',
                'in url' => '/lecture/list'
            ],
            'create' => [
                'name' => 'create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'lecture.create',
                'href' => '/lecture/create',
                'in url' => '/lecture/create'
            ]
        ]
    ],
    'LectureAssignments' => [
        'name' => 'LectureAssignments',
        'icon' => 'zmdi zmdi-graduation-cap',
        'permission' => 'lectureAssignments.view',
        'inurl' => '/lectureAssignments/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'lectureAssignments.view.list',
                'href' => '/lectureAssignments/list',
                'in url' => '/lectureAssignments/list'
            ],
            'create' => [
                'name' => 'create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'lectureAssignments.create',
                'href' => '/lectureAssignments/create',
                'in url' => '/lectureAssignments/create'
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
                'name' => 'create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'batch.create',
                'href' => '/batch/create',
                'in url' => '/batch/create'
            ]
        ]
    ],
    'BatchStudents' => [
        'name' => 'BatchStudents',
        'icon' => 'zmdi zmdi-graduation-cap',
        'permission' => 'batchStudents.view',
        'inurl' => '/batchStudents/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'batchStudents.view.list',
                'href' => '/batchStudents/list',
                'in url' => '/batchStudents/list'
            ],
            'create' => [
                'name' => 'create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'batchStudents.create',
                'href' => '/batchStudents/create',
                'in url' => '/batchStudents/create'
            ]
        ]
    ],
    'AssignmentStudents' => [
        'name' => 'AssignmentStudents',
        'icon' => 'zmdi zmdi-graduation-cap',
        'permission' => 'AssignmentStudents.view',
        'inurl' => '/assignmentStudents/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'assignmentStudents.view.list',
                'href' => '/assignmentStudents/list',
                'in url' => '/assignmentStudents/list'
            ],
            'create' => [
                'name' => 'create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'assignmentStudents.create',
                'href' => '/assignmentStudents/create',
                'in url' => '/assignment
                Students/create'
            ]
        ]
    ],
    'Course' => [
        'name' => 'Course',
        'icon' => 'zmdi zmdi-graduation-cap',
        'permission' => 'Course.view',
        'inurl' => '/course/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'course.view.list',
                'href' => '/course/list',
                'in url' => '/course/list'
            ],
            'create' => [
                'name' => 'create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'course.create',
                'href' => '/course/create',
                'in url' => '/course/create'
            ]
        ]
    ],
    'CourseBatchs' => [
        'name' => 'CourseBatchs',
        'icon' => 'zmdi zmdi-graduation-cap',
        'permission' => 'CourseBatchs.view',
        'inurl' => '/courseBatchs/',
        'sub' => [
            'list' => [
                'name' => 'List',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'courseBatchs.view.list',
                'href' => '/courseBatchs/list',
                'in url' => '/courseBatchs/list'
            ],
            'create' => [
                'name' => 'create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'courseBatchs.create',
                'href' => '/courseBatchs/create',
                'in url' => '/courseBatchs/create'
            ]
        ]
    ],



 ];