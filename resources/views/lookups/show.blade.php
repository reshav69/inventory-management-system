
<div class="contaianer">
    <table class="table table-bordered">
        <tbody>
            @foreach ($datas as $label=>$value)
            
            <tr>
                <th>{{ $label }}</th>
                <td>
                    @switch($label)
                    @case('Status')
                    @if($value ??false)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Inactive</span>
                    @endif
                    @break
                    @case('Image')
                    @if($value??false)
                    <img src="{{ asset('storage/'.$value) }}" alt="{{ $datas['Name'] }}" class="img-fluid" style="max-height:150px;">
                    @endif
                    @break
                    @case('Barcode')
                    @if($datas['Barcode'] ?? false)
                    <svg id="barcode"></svg>
                    <script>
                        JsBarcode("#barcode", "{{ $datas['Barcode'] ?? '' }}", {
                            format: "CODE128",
                            width: 1,
                            height: 50,
                        });
                    </script>
                    @endif
                    
                    @break
                    
                    @default
                    {!! $value ?? '-' !!}
                    
                    @endswitch 
                </td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
    
</div>


<script>
    // console.log(@json($datas));
    
</script>
{{-- @if ($datas && $datas[])
<svg id="barcode"></svg>

<script>
    JsBarcode("#barcode", "{{ $datas['Barcode'] }}", {
    format: "CODE128",
    width: 2,
    height: 60,
    });
</script>
<span></span>
@endif --}}