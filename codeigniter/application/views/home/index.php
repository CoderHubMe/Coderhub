<div class="row">
  <div class="col-md-6">
    <!-- DONUT CHART -->
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">User Skills</h3>
    
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <canvas id="userSkillsChart" style="height:250px"></canvas>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <script>
    $(document).ready(function() {
      $.getJSON("<?= base_url('analytics/skillsChart') ?>", function(jsonData) {
        console.dir(jsonData);
        var ctx = $('#userSkillsChart');
        var data = {
            labels: jsonData.labels,
            datasets: [{
              data: jsonData.data,
              backgroundColor: jsonData.colors,
              hoverBackgroundColor: jsonData.colors
            }]
        };
        var myDoughnutChart = new Chart(ctx, {
          type: 'doughnut',
          data: data,
          options: {
            type:"doughnut",
            animation:{
              animateScale: true,
              animateRotate: false
            }
          }
        });
      });
    });
  </script>
  <div class="col-md-6">
    <!-- LINE CHART -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Connections and Blocked Connections Over Time</h3>
    
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="connAndBlockedConnOverTimeChart" style="height:250px"></canvas>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <script>
    $(document).ready(function() {
      $.getJSON("<?= base_url('analytics/connAndBlockedConnOverTime') ?>", function(jsonData) {
        console.dir(jsonData);
        var ctx = $('#connAndBlockedConnOverTimeChart');
        var data = {
            labels: jsonData.labels,
            datasets: [{
              label: "Accepted Connections",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "rgba(75,192,192,0.4)",
              borderColor: "rgba(75,192,192,1)",
              borderCapStyle: 'butt',
              borderDash: [],
              borderDashOffset: 0.0,
              borderJoinStyle: 'miter',
              pointBorderColor: "rgba(75,192,192,1)",
              pointBackgroundColor: "#fff",
              pointBorderWidth: 1,
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "rgba(75,192,192,1)",
              pointHoverBorderColor: "rgba(220,220,220,1)",
              pointHoverBorderWidth: 2,
              pointRadius: 1,
              pointHitRadius: 10,
              data: jsonData.accepted_data,
            },
            {
              label: "Blocked Connections",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "rgba(255, 67, 67,0.4)",
              borderColor: "rgba(255, 67, 67,1)",
              borderCapStyle: 'butt',
              borderDash: [],
              borderDashOffset: 0.0,
              borderJoinStyle: 'miter',
              pointBorderColor: "rgba(255, 67, 67,1)",
              pointBackgroundColor: "#fff",
              pointBorderWidth: 1,
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "rgba(255, 67, 67,1)",
              pointHoverBorderColor: "rgba(220,220,220,1)",
              pointHoverBorderWidth: 2,
              pointRadius: 1,
              pointHitRadius: 10,
              data: jsonData.blocked_data,
            }]
        };
        var myLineChart = new Chart(ctx, {
          type: 'line',
          data: data,
          options: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                stepSize: 1
              }
            }]
          }
        });
      });
    });
  </script>
</div>