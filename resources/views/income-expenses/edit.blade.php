@extends('layout')
@section('content')
<div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Income/Expense</h2>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
<form action="{{ route('transactions.update', $transaction->id) }}"  method="POST">
    @method('PUT')
    @csrf
    
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" class="form-control" required>
    <label>Type:</label>
    <input type="radio" name="type" value="income" id="incomeRadio" {{ $transaction->type === 'income' ? 'checked' : '' }}> Income
    <input type="radio" name="type" value="expense"  id="expenseRadio" {{ $transaction->type === 'expense' ? 'checked' : '' }}> Expense
    <br>
    <br>
    <div id="categorySection" style="display: none;">
        <label>Category:</label>
        <select name="category_id" class="form-control">
            @foreach ($category as $item)
            <option value="{{ $item->id }}" {{ $transaction->category_id == $item->id ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
            @endforeach
        </select>
        <br>
    </div>

    <label>Description:</label>
    <input type="text" name="description" value="{{ $transaction->description }}" class="form-control" required>
    <br>

    <label>Amount:</label>
    <input type="text" name="amount" value="{{ $transaction->amount }}" class="form-control" required>
    <br>

    <label>Date:</label>
    <input type="date" name="date" value="{{ $transaction->date }}" class="form-control"  required>
    <br>
    <button class="btn btn-primary" type="submit">Update Transaction</button>
</form>
</div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('input[type=radio][name=type]').change(function() {
        if (this.value === 'income') {
            $('#categorySection').hide();
        } else if (this.value === 'expense') {
            $('#categorySection').show();
        }
    });
    
    $('input[type=radio][name=type]:checked').trigger('change');
});
</script>
@endsection