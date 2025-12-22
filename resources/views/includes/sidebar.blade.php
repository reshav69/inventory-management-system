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


                    <x-sidebars.collapser title="Products" name="Product" route="products" icon="boxes-stacked" :canCreate="true" model="\App\Models\Product"/>
                    @can('viewAny','\App\Models\Warehouse')
                    <x-sidebars.collapser title="Warehouses" name="Warehouse" route="warehouses" icon="house" :canCreate="true" model="\App\Models\Warehouse"/>

                    @endcan

                    <x-sidebars.collapser title="Stock Transactions" route="stocktransactions" name="Stransactions" icon="arrow-trend-up" :canCreate="true" model="\App\Models\StockTransaction"/>
                    
                    
                    
                    <x-sidebars.collapser title="Stock Transfers" name="Stransfers" icon="right-left" route="stocktransfers"/>
                    
                    <x-sidebars.collapser title="Sales" name="Sales" route="sales" icon="dollar" :canCreate="true" model="\App\Models\Sale"/>


                    @if(Auth::user()->role === 'admin')
                    <x-sidebars.collapser title="Users" name="Users" route="users" icon="user" :canCreate="true" model="\App\Models\User"/>
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