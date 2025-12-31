<div class="container d-flex justify-content-end gap-2 w-fit">

    <button class="btn btn-sm btn-info open-modal" data-url="{{ route($type.'.show', $model->id) }}" data-title="{{ ucfirst($model->name) }}">
        Show
    </button>
    @if(in_array($type,['products','warehouses','sales','users']))
    @can('update',$model)
    <a href="{{ route($type.'.edit',$model->id) }}" class="btn btn-sm btn-primary">Edit</a>
    @endcan
    @endif

    @if(in_array($type,['products','warehouses','users']))
    @can('delete',$model)
    <form action="{{ route($type.'.destroy',$model->id) }}" method="POST" class="d-inline delete-btn">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger delete-btn" id="delete-btn">Delete</button>
    </form>
        
    @endcan
    @endif
</div>
<script>
    $(document).on('submit', '.delete-btn', function(e) {
        e.preventDefault();
        let form = this;
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>