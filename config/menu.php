

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
                'href' => '/students/list',
                'in url' => '/students/list'
            ],
            'create' => [
                'name' => 'Create',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'students.create',
                'href' => '/students/create',
                'in url' => '/students/create'
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
                'name' => 'Upload',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'assignment.upload',
                'href' => '/assignment/upload',
                'in url' => '/assignment/upload'
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
            'name' => 'View',
            'icon' => 'zmdi zmdi-view-list',
            'permission' => 'lecturer.view.view',
            'href' => '/lecturer/list',
            'in url' => '/lecturer/list'
        ],
        'create' => [
            'name' => 'Add',
            'icon' => 'zmdi zmdi-plus',
            'permission' => 'assignment.add',
            'href' => '/assignment/add',
            'in url' => '/assignment/add'
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
                'name' => 'View',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'lecture.view.view',
                'href' => '/lecture/list',
                'in url' => '/lecture/list'
            ],
            'create' => [
                'name' => 'Add',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'lecture.add',
                'href' => '/lecture/add',
                'in url' => '/lecture/add'
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
                'name' => 'View',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'lectureAssignments.view.view',
                'href' => '/lectureAssignments/list',
                'in url' => '/lectureAssignments/list'
            ],
            'create' => [
                'name' => 'Add',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'lectureAssignments.add',
                'href' => '/lectureAssignments/add',
                'in url' => '/lectureAssignments/add'
            ]
        ]
    ],
    'Batch' => [
        'name' => 'Batch',
        'icon' => 'zmdi zmdi-group',
        'permission' => 'batch.view',
        'inurl' => '/batch/',
        'sub' => [
            'list' => [
                'name' => 'View',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'batch.view.view',
                'href' => '/batch/list',
                'in url' => '/batch/list'
            ],
            'create' => [
                'name' => 'Add',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'batch.add',
                'href' => '/batch/add',
                'in url' => '/batch/add'
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
                'name' => 'View',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'batchStudents.view.view',
                'href' => '/batchStudents/list',
                'in url' => '/batchStudents/list'
            ],
            'create' => [
                'name' => 'Add',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'batchStudents.add',
                'href' => '/batchStudents/add',
                'in url' => '/batchStudents/add'
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
                'name' => 'View',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'assignmentStudents.view.view',
                'href' => '/assignmentStudents/list',
                'in url' => '/assignmentStudents/list'
            ],
            'create' => [
                'name' => 'Add',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'assignmentStudents.add',
                'href' => '/assignmentStudents/add',
                'in url' => '/assignment
                Students/add'
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
                'name' => 'View',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'course.view.view',
                'href' => '/course/list',
                'in url' => '/course/list'
            ],
            'create' => [
                'name' => 'Add',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'course.add',
                'href' => '/course/add',
                'in url' => '/course/add'
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
                'name' => 'View',
                'icon' => 'zmdi zmdi-view-list',
                'permission' => 'courseBatchs.view.view',
                'href' => '/courseBatchs/list',
                'in url' => '/courseBatchs/list'
            ],
            'create' => [
                'name' => 'Add',
                'icon' => 'zmdi zmdi-plus',
                'permission' => 'courseBatchs.add',
                'href' => '/courseBatchs/add',
                'in url' => '/courseBatchs/add'
            ]
        ]
    ],



 ];