@extends('admin.layout.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <canvas id="order"></canvas>
        </div>
        <div class="col-6">
            <h3>Latest User</h3>
            <ul class="list-group">
                @foreach ($user as $u)
                <li class="list-group-item">
                    {{$u->name}}
                </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($months)

  const data = {
    labels: labels,
    datasets: [{
      label: 'Order Report',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: @json($data),//[]
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {}
  };
  const myChart = new Chart(
    document.getElementById('order'),
    config
  );

</script>
@endsection
