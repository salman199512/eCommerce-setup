<?php

return [
    [
        'name' => 'Dashboard',
        'icon' => '<i class="bx bx-home side-menu__icon"></i>',
        'isHeader' => false,
        'route' => 'dashboard',
        'children' => [],
    ],
    [
        'name' => 'Users',
        'icon' => '<i class="ti ti-user-circle fs-18 me-2 side-menu__icon "></i>',
        'isHeader' => false,
        'route' => 'admin.users.index',
        'children' => [],
    ],

    [
        'name' => 'Masters',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-article side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M7 8h10" /><path d="M7 12h10" /><path d="M7 16h10" /></svg>',
        'isHeader' => false,
        'route' => '#',
        'children' => [
            [
                'name' => 'Categories',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.categories.index',
                'children' => [],
            ],
            [
                'name' => 'Sub Categories',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.sub-categories.index',
                'children' => [],
            ],

            [
                'name' => 'Attribute Groups',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.attribute-groups.index',
                'children' => [],
            ],
            [
                'name' => 'Attributes',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.attributes.index',
                'children' => [],
            ],
            [
                'name' => 'Brands',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.brands.index',
                'children' => [],
            ],
            [
                'name' => 'Products',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.products.index',
                'children' => [],
            ],
            [
                'name' => 'CMS Pages',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.contentManagements.index',
                'children' => [],
            ],
            [
                'name' => 'Faqs',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.faqs.index',
                'children' => [],
            ],
            [
                'name' => 'Website Content',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.websites.index',
                'children' => [],
            ],
        ],
    ],



    [
        'name'      => 'Others',
        'icon'      => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l11 0" /><path d="M9 12l11 0" /><path d="M9 18l11 0" /><path d="M5 6l0 .01" /><path d="M5 12l0 .01" /><path d="M5 18l0 .01" /></svg>',
        'isHeader'  => false,
        'route'     => '#',
        'children'  => [
            [
                'name'      => 'Inquiries',
                'icon'      => '',
                'isHeader'  => false,
                'route'     => 'admin.inquiries.index',
                'children'  => [],
            ],
            [
                'name'      => 'News Letters',
                'icon'      => '',
                'isHeader'  => false,
                'route'     => 'admin.newsletters.index',
                'children'  => [],
            ],
        ],
    ],


];
