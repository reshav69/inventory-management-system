<?php

return [
    [
        'label' => 'Add Product',
        'route' => 'products.create',
        'policy' => ['Product', 'create'],
        'keywords' => ['product', 'create', 'add'],
    ],
    [
        'label' => 'View Products',
        'route' => 'products.index',
        'policy' => ['Product', 'viewAny'],
        'keywords' => ['product', 'list', 'view','see','chart'],
    ],
    // --
    [
        'label' => 'Add Warehouse',
        'route' => 'warehouses.create',
        'policy' => ['Warehouse', 'create'],
        'keywords' => ['warehouse', 'add', 'create'],
    ],
    [
        'label' => 'View Warehouses',
        'route' => 'warehouses.index',
        'policy' => ['Warehouse', 'viewAny'],
        'keywords' => ['warehouse', 'view', 'see','list'],
    ],
    /////
    [
        'label' => 'View Stock Transactions',
        'route' => 'stocktransactions.index',
        'policy' => ['StockTransaction', 'viewAny'],
        'keywords' => ['stocktransaction','stock','transaction', 'view', 'see','list'],
    ],
    [
        'label' => 'Add Stock Transaction',
        'route' => 'stocktransactions.create',
        'policy' => ['StockTransaction', 'create'],
        'keywords' => ['stocktransaction','stock','transaction', 'add', 'create'],
    ],
    /////
    [
        'label' => 'View Stock Transfers',
        'route' => 'stocktransfers.index',
        'policy' => ['StockTransfer', 'viewAny'],
        'keywords' => ['stock','transfer','stocktransfer', 'view', 'see','list'],
    ],
    [
        'label' => 'Add Stock Transfer',
        'route' => 'stocktransactions.create',
        'policy' => ['StockTransfer', 'create'],
        'keywords' => ['stock','transfer', 'add', 'create'],
    ],
    /////
    [
        'label' => 'View Users',
        'route' => 'users.index',
        'policy' => ['User', 'viewAny'],
        'keywords' => ['user','admin','staff', 'view', 'see','list'],
    ],
    [
        'label' => 'Add Users',
        'route' => 'users.create',
        'policy' => ['User', 'create'],
        'keywords' => ['user','admin','staff', 'add', 'create'],
    ],
    /////
    [
        'label' => 'View Sales',
        'route' => 'sales.index',
        'policy' => ['Sale', 'viewAny'],
        'keywords' => ['sales','sell', 'view', 'see','list'],
    ],
    [
        'label' => 'Add Sales',
        'route' => 'sales.create',
        'policy' => ['Sale', 'create'],
        'keywords' => ['sales','sell', 'add', 'create'],
    ],
    //////
    [
        'label' => 'Dashboard',
        'route' => 'dashboard',
        'policy'=>['Product','viewAny'],
        'keywords' => ['dashboard', 'charts'],
    ]
];
