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
        'keywords' => ['product', 'list', 'view','see'],
    ],
    [
        'label' => 'Add Warehouse',
        'route' => 'warehouses.create',
        'policy' => ['Warehouse', 'create'],
        'keywords' => ['warehouse', 'add', 'create'],
    ],
    [
        'label' => 'View Warehouse',
        'route' => 'warehouses.create',
        'policy' => ['Warehouse', 'create'],
        'keywords' => ['warehouse', 'view', 'see','list'],
    ],
    [
        'label' => 'View Stock Transactions',
        'route' => 'stocktransactions.create',
        'policy' => ['StockTransaction', 'create'],
        'keywords' => ['stocktransaction','stock','transaction', 'view', 'see','list'],
    ],
    [
        'label' => 'Add Stock Transaction',
        'route' => 'stocktransactions.create',
        'policy' => ['StockTransaction', 'create'],
        'keywords' => ['stocktransaction','stock','transaction', 'add', 'create'],
    ],
    [
        'label' => 'View Stock Transfers',
        'route' => 'stocktransactions.create',
        'policy' => ['StockTransfer', 'create'],
        'keywords' => ['stock','transfer','stocktransfer', 'view', 'see','list'],
    ],
    [
        'label' => 'Add Stock Transfer',
        'route' => 'stocktransactions.create',
        'policy' => ['StockTransfer', 'create'],
        'keywords' => ['stock','transfer', 'add', 'create'],
    ],
];
