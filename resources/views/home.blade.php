@extends('layout')
@section('content')
<div class="container">
  <div class="row">
    <h1> Welcome, {{ Auth::user()->name }}</h1>
  </div>
 <div class="row">
  <div class="col">
    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
      <div class="card-header">Total Income</div>
      <div class="card-body">
        <h5 class="card-title"><i class="fa fa-inr" aria-hidden="true"></i> {{$totalIncome}} </h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
      <div class="card-header">Total Expenses</div>
      <div class="card-body">
        <h5 class="card-title"><i class="fa fa-inr" aria-hidden="true"></i> {{$totalExpense}}</h5>
       
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
      <div class="card-header"> Balance</div>
      <div class="card-body">
        <h5 class="card-title"><i class="fa fa-inr" aria-hidden="true"></i> {{$balance}}</h5>
      </div>
    </div>
  </div>
  <!-- HTML Canvas Element -->
<canvas id="myChart" width="200" height="200"></canvas>
 </div>
</div>
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var months = {!! json_encode($months) !!};
var incomeData = {!! json_encode($incomeData) !!};
var expenseData = {!! json_encode($expenseData) !!};

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Income',
            data: incomeData,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            fill: false,
        }, {
            label: 'Expense',
            data: expenseData,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            fill: false,
        }]
    },
    // options: {
    //     scales: {
    //         y: {
    //             beginAtZero: true
    //         }
    //     }
    // }
});
</script>

@endsection
