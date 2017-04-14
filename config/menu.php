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
        'inurl' => '/admin/',
        'sub' => [
            'users' => [
                'name' => 'Users',
                'icon' => 'zmdi zmdi-account',
                'permission' => 'admin.users.view',
                'href' => '/admin/users/list',
                'inurl' => '/admin/users'
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
            ],
        ]
    ],
//    'students' => [
//        'name' => 'Employees',
//        'icon' => 'zmdi zmdi-accounts-alt',
//        'permission' => 'employee.profile.view',
//        'inurl' => '/employee/',
//        'sub' => [
////            'overview' => [
////                'name' => 'Overview',
////                'icon' => 'zmdi zmdi-home',
////                'permission' => 'employee.profile.view',
////                'href' => '/employee/overview'
////            ],
//            'list' => [
//                'name' => 'List',
//                'icon' => 'zmdi zmdi-view-list-alt',
//                'permission' => 'employee.profile.view',
//                'href' => '/employee/list'
//            ],
////            'admin' => [
////                'name' => 'Admin',
////                'icon' => 'zmdi zmdi-wrench',
////                'permission' => 'employee.profile.admin',
////                'href' => '/employee/admin'
////            ]
//        ],
//    ],
//    'leaves' => [
//        'name' => 'Leaves',
//        'icon' => 'zmdi zmdi-calendar',
//        'permission' => 'employee.leave.view',
//        'inurl' => '/employee-leave/',
//        'sub'=> [
//            'overview' => [
//                'name' => 'Overview',
//                'icon' => 'zmdi zmdi-home',
//                'permission' => 'employee.leave.view',
//                'href' => '/employee-leave/overview'
//            ],
//            'list' => [
//                'name' => 'List',
//                'icon' => 'zmdi zmdi-view-list-alt',
//                'permission' => 'employee.leave.view',
//                'href' => '/employee-leave/list'
//            ],
//            'application_form' => [
//                'name' => 'Application Form',
//                'icon' => 'zmdi zmdi-collection-text',
//                'permission' => 'employee.leave.create',
//                'href' => '/employee-leave/create-application',
//                'inurl' => '/employee-leave/create-application-by-employee'
//            ],
//            'approval_list' => [
//                'name' => 'Approvals',
//                'icon' => 'zmdi zmdi-check',
//                'permission' => 'employee.leave.view',
//                'href' => '/employee-leave/approval-list-extended',
//                'inurl' => '/employee-leave/approval-list'
//            ],
//            'calendar' => [
//                'name' => 'Calendar',
//                'icon' => 'zmdi zmdi-calendar-alt',
//                'permission' => 'employee.leave.view',
//                'href' => '/employee-leave/calendar'
//            ],
//            'batch_application' => [
//                'name' => 'Batch Application',
//                'icon' => 'zmdi zmdi-copy',
//                'permission' => 'employee.leave.batch_application',
//                'href' => '/employee-leave-batch-application/list'
//            ]
//        ]
//    ],
//    'leave-balance' => [
//        'name' => 'Leave Balance',
//        'icon' => 'zmdi zmdi-balance-wallet',
//        'permission' => 'employee.leave-balance.view',
//        'inurl' => '/leave-balance/',
//        'sub'=> [
//            'list' => [
//                'name' => 'List',
//                'icon' => 'zmdi zmdi-view-list-alt',
//                'permission' => 'employee.leave-balance.view',
//                'href' => '/leave-balance/list'
//            ],
//        ]
//    ]
////    'departments' => [
////        'name' => 'Departments',
////        'icon' => 'zmdi zmdi-collection-bookmark',
////        'permission' => 'departments.view',
////        'sub' => [
////            'overview' => [
////                'name' => 'Overview',
////                'icon' => 'zmdi zmdi-home',
////                'permission' => 'departments.view',
////                'href' => '/departments/overview'
////            ],
////            'list' => [
////                'name' => 'List',
////                'icon' => 'zmdi zmdi-view-list-alt',
////                'permission' => 'departments.view',
////                'href' => '/departments/list'
////            ],
////            'admin' => [
////                'name' => 'Admin',
////                'icon' => 'zmdi zmdi-wrench',
////                'permission' => 'departments.admin',
////                'href' => '/departments/admin'
////            ]
////        ]
////    ]

];