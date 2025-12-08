{{-- @auth
@if(Auth::user()->role === 'admin')
<style>
    #sidenavAccordion {
        background: rgb;

    }
</style>
@endif
@endauth --}}
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" >
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    @auth
                    @if(Auth::user()->role === 'admin')
                    {{-- Admin-Specific Link --}}
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                    @elseif (Auth::user()->role === 'staff')
                        <a class="nav-link" href="{{ route('staff.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                    @endif
                    
                    <div class="sb-sidenav-menu-heading">Interface</div>

                    {{-- products --}}

                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                        <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked"></i></div>
                        Products
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                        
                    <div class="collapse" id="collapseProducts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <i class="fas fa-eye"></i> &emsp;View</a>

                            @can('create','\App\Models\Product')
                                
                            <a class="nav-link" href="{{ route('products.create') }}">
                                <i class="fas fa-plus"></i>&emsp; Add</a> 
                            @endcan

                        </nav>
                    </div>

                    @can()
                        
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('warehouses.index') }}">View</a>
                            <a class="nav-link" href="{{ route('warehouses.create') }}">Add</a>

                        </nav>
                    </div>
                    @endcan


                    @can('viewAny','\App\Models\Warehouse')
                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseWarehouses" aria-expanded="false" aria-controls="collapseWarehouses">
                        <div class="sb-nav-link-icon"><i class="fas fa-house"></i></div>
                        Warehouses
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                        
                    <div class="collapse" id="collapseWarehouses" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('warehouses.index') }}">
                                <i class="fas fa-eye"></i>&emsp;View</a>
                            <a class="nav-link" href="{{ route('warehouses.create') }}">
                                <i class="fas fa-plus"></i>&emsp;Add</a>

                        </nav>
                    </div>
                    @endcan

                    {{-- stocktransactions --}}

                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseStransactions" aria-expanded="false" aria-controls="collapseStransactions">
                        <div class="sb-nav-link-icon"><i class="fas fa-arrow-trend-up"></i></div>
                        Stock Transactions
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    
                    <div class="collapse" id="collapseStransactions" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('stocktransactions.index') }}">
                                <i class="fas fa-eye"></i>&emsp;View</a>
                            @can('create','\App\Models\StockTransaction')
                            <a class="nav-link" href="{{ route('stocktransactions.create') }}">
                                <i class="fas fa-plus"></i>&emsp;Add</a>
                            @endcan

                        </nav>
                    </div>


                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseStransfers" aria-expanded="false" aria-controls="collapseStransfers">
                        <div class="sb-nav-link-icon"><i class="fas fa-arrow-trend-up"></i></div>
                        Stock Transfers
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    
                    <div class="collapse" id="collapseStransfers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('stocktransfers.index') }}">
                                <i class="fas fa-eye"></i>&emsp;View</a>
                            {{-- @can('create','\App\Models\StockTransaction')
                            <a class="nav-link" href="{{ route('stocktransfers.create') }}">
                                <i class="fas fa-plus"></i>&emsp;Add</a>
                            @endcan --}}

                        </nav>
                    </div>



                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseSales" aria-expanded="false" aria-controls="collapseSales">
                        <div class="sb-nav-link-icon"><i class="fas fa-dollar"></i></div>
                        Sales
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    
                    <div class="collapse" id="collapseSales" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('sales.index') }}">
                                <i class="fas fa-eye"></i>&emsp;View</a>
                            <a class="nav-link" href="{{ route('sales.create') }}">
                                <i class="fas fa-plus"></i>&emsp;Add</a>

                        </nav>
                    </div>


                    @if(Auth::user()->role === 'admin')

                    <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    
                    <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="fas fa-eye"></i>&emsp;View</a>
                            <a class="nav-link" href="{{ route('users.create') }}">
                                <i class="fas fa-plus"></i>&emsp;Add</a>

                        </nav>
                    </div>
                    @endif



                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.html">Login</a>
                                    <a class="nav-link" href="register.html">Register</a>
                                    <a class="nav-link" href="password.html">Forgot Password</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="401.html">401 Page</a>
                                    <a class="nav-link" href="404.html">404 Page</a>
                                    <a class="nav-link" href="500.html">500 Page</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>

            
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ auth()->user()->email ??'User' }}
            </div>

            @endauth
        </nav>
    </div>

</div>