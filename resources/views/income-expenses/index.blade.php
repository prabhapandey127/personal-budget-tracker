@extends('layout')
@section('content')
<div class="conatiner">
    <div class="row justify-content-center mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add</a>
            <table id="example" class="display" >
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $key=> $row)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$row->type}}</td>
                        <td>{{$row->category->name ?? ''}}</td>
                        <td>{{$row->description}}</td>
                        <td>{{$row->amount}}</td>
                        <td>{{$row->date}}</td>
                        <td>
                            <a href="{{ route('transactions.edit', ['transaction' => $row->id]) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('transactions.destroy', ['transaction' => $row->id]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            
                        </td>
    
                    </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<!-- Scripts -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script>
 new DataTable('#example', {
    layout: {
        topStart: {
            buttons: [ {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1 ,2, 3, 4, 5] // Exclude column index 2 (zero-based index)
                    }
                },]
        }
    }
});
</script>
@endsection