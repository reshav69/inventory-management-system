<div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>

    $(document).on('click', '.open-modal', function() {
        let url = $(this).data('url');
        let title = $(this).data('title') || "{{ $title ?? '' }}";
        
        $('#showModalLabel').text(title);
        
        $.get(url, function(response) {
            $('#showModal .modal-body').html(response);
            
            $('#showModal').modal('show');
        });
    })
    
    
</script>
@endpush