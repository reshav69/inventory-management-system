<div class="container d-flex justify-content-end gap-2 w-fit">
    <form action="{{ route($type.'.restore',$model->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PUT')
        <button class="btn btn-sm btn-success">Restore</button>
    </form>

    <form action="{{ route($type.'.forcedelete',$model->id) }}" method="POST" class="d-inline delete-btn">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger delete-btn" id="delete-btn">Delete</button>
    </form>

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