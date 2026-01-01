@auth
@if(Auth::user()->role === 'admin')
<style>
    #sb-topnav {
        background-image: url("{{ asset('iconsandshi/pattern.png') }}");
        background-size: cover;
        background-repeat: no-repeat;
    }
    .navbar-icon{
        width:36px;
        height:36px;
        object-fit: contain;
        image-rendering: crips-edges;
    }
</style>
@endif
@endauth
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="sb-topnav">

    <a class="navbar-brand ps-3" style="width: 200px;" href="dashboard">
        <img src="{{asset('iconsandshi/PASAL.gif')}}" alt="icon" class="navbar-icon" width="36">
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-2" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <p class="navbar-brand ps-3 mb-0">{{ $title ?? '' }}</p>

    <!-- RIGHT SIDE WRAPPER -->
    <div class="d-flex align-items-center ms-auto">

        @auth
        <form action="{{ route('search') }}"
        class="d-none d-md-inline-block me-3">
        <select id="globalSearch" class="form-control" style="width: 300px;"></select>
    </form>

    <ul class="navbar-nav me-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-user fa-fw"></i>
                <span class="d-none d-md-inline">
                    {{ Auth::user()->email }}
                </span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    @endauth

    @guest
    <ul class="navbar-nav me-4">
        <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">Login here</a>
        </li>
    </ul>
    @endguest

</div>
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
