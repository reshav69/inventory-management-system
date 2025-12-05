<div class="container d-flex justify-content-end gap-2 w-fit">

    <button class="btn btn-sm btn-info open-modal" data-url="{{ route($type.'.show', $product->id) }}" data-title="Data of {{ ucfirst($product->name) }}">
        Show
    </button>
    @can('update',$product)


    <a href="{{ route($type.'.edit',$product->id) }}" class="btn btn-sm btn-primary">Edit</a>


        
    @endcan
    @can('delete',$product)
    <form action="" method="POST" class="d-inline delete-btn">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">Delete</button>
    </form>
        
    @endcan
</div>
<script>

</script>