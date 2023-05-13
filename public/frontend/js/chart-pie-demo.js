// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Poppins';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myDoughChart");
var myDoughChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Laki - laki", "Perempuan"],
    datasets: [{
      data: [70, 30,],
      backgroundColor: ['#4CAF50', '#FFC107'],
      hoverBackgroundColor: ['#4CAF50', '#FFC107'],
      hoverBorderColor: ['#4CAF50', '#FFC107'],
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
});


// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: "",
    datasets: [{
      data: [12.21, 15.58, 11.25, 8.32],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});


// Pie Chart Example
var ctx = document.getElementById("myPieChart1");
var myPieChart1 = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: "",
    datasets: [{
      data: [12.21, 15.58, 11.25, 8.32],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});

// Pie Chart Example
var ctx = document.getElementById("myPieChart2");
var myPieChart2 = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: "",
    datasets: [{
      data: [12.21, 15.58, 11.25, 8.32],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});

// Pie Chart Example
var ctx = document.getElementById("myPieChart3");
var myPieChart3 = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: "",
    datasets: [{
      data: [12.21, 15.58, 11.25, 8.32],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});
