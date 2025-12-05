<div>
    <div class="contaianer">
        <table class="table table-bordered">
            <tbody>
                @foreach ($datas as $label=>$value)
                <tr>
                    <th>{{ $label }}</th>
                    <td>
                        @if($label == 'Status')
                            @if($value)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        @elseif($label == 'Image' && $value)
                            <img src="{{ asset('storage/'.$value) }}" alt="{{ $datas['Name'] }}" class="img-fluid" style="max-height:150px;">
                        @else
                            {!! $value ?? '-' !!}
                        @endif
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        
    </div>
    
</div>

@if ($datas['Barcode'])
<svg id="barcode"></svg>

<script>
    JsBarcode("#barcode", "{{ $datas['Barcode'] }}", {
        format: "CODE128",
        width: 2,
        height: 60,
    });
</script>
    
@endif