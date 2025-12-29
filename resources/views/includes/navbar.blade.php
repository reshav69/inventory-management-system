@auth
@if(Auth::user()->role === 'admin')
<style>
    #sb-topnav {
        background-image: url("{{ asset('js/pattern.png') }}");
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
@endif
@endauth

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="sb-topnav">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/"><abbr title="inventory Management System">IMS</abbr></a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    {{-- title --}}
    <p class="navbar-brand ps-3">{{ $title ?? '' }}</p>
    <!-- Navbar Search-->
    
    <!-- Navbar-->
    <form action="{{ route('search') }}" id="globalSearchFrom" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <select id="globalSearch"
        class="form-control"
        style="width: 300px;">
    </select>
    </form>
<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    @auth
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
        {{Auth::user()->email}}</a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger">Logout</button>
                </form>
            </li>   
        </ul>
    </li>
    @endauth
    
    @guest
    <a href="{{ route('login') }}" class="nav-link">Login here</a>
    @endguest
</ul>
</nav>

@push('scripts')
<script>
    $(document).on('keydown', function (e) {
        if (e.key === '/') {
            const $target = $(e.target);
            
            if ($target.is('input, textarea') || $target.is('[contenteditable="true"]')) {
                return;
            }
            e.preventDefault();
            
            // 4. Open the Select2 dropdown
            const $searchSelect = $('#globalSearch');
            $searchSelect.select2('open');
            
            setTimeout(function() {
                const searchField = $('.select2-search__field').last();
                searchField.focus();
            }, 50); 
        }
    });
    
    $(function () {
        $('#globalSearch').select2({
            placeholder: 'Search for...',
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('search') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { q: params.term };
                },
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.url,
                            text: item.label
                        }))
                    };
                }
            }
        });
        $('#globalSearch').on('select2:select', function (e) {
            window.location.href = e.params.data.id;
        });
    });
</script>

@endpush
