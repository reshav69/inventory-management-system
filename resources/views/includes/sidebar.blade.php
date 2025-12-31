<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" >
    <div class="sb-sidenav-menu">
        <div class="nav">
            @auth
            {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
            {{-- Admin-Specific Link --}}
            <a class="nav-link" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Parent</div>



            <x-sidebars.collapser title="Products" name="Product" route="products" icon="boxes-stacked" :canCreate="true" model="\App\Models\Product"/>
            @can('viewAny','\App\Models\Warehouse')
            <x-sidebars.collapser title="Warehouses" name="Warehouse" route="warehouses" icon="house" :canCreate="true" model="\App\Models\Warehouse"/>

            @endcan

            <div class="sb-sidenav-menu-heading">Stock</div>
            <x-sidebars.collapser title="Stock Transactions" route="stocktransactions" name="Stransactions" icon="arrow-trend-up" :canCreate="true" model="\App\Models\StockTransaction"/>



            <x-sidebars.collapser title="Stock Transfers" name="Stransfers" icon="right-left" route="stocktransfers"/>

            <x-sidebars.collapser title="Sales" name="Sales" route="sales" icon="dollar" :canCreate="true" model="\App\Models\Sale"/>


            @if(Auth::user()->role === 'admin')
            <div class="sb-sidenav-menu-heading">Management</div>
            <x-sidebars.collapser title="Users" name="Users" route="users" icon="user" :canCreate="true" model="\App\Models\User"/>
            @endif


        </div>
    </div>

    
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->email ??'User' }}
    </div>

    @endauth
</nav>
