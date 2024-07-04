<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .dashboard-container {
            padding: 20px;
        }
        .chart-container {
            margin: 20px 0;
        }
        .chart-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        #moderatorPieChart {
            max-width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <a href="{{ route('moderator.home') }}" class="btn-back">Back to Home</a>

        <h1 class="text-center mb-4">Moderator Dashboard</h1>

        <!-- Pie Chart Card -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="chart-title">Overall Moderation Analysis</h2>
                <div class="chart-container">
                    <canvas id="moderatorPieChart"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- MCQ Chart Card -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="chart-title">MCQ Question Analysis</h2>
                        <div class="chart-container">
                            <canvas id="mcqChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Short Answer Chart Card -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="chart-title">Short Answer Question Analysis</h2>
                        <div class="chart-container">
                            <canvas id="shortAnswerChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch and render MCQ Chart
            fetch('/moderator-mcq-data')
                .then(response => response.json())
                .then(data => {
                    const mcqCtx = document.getElementById('mcqChart').getContext('2d');

                    // Define all possible MCQ categories
                    const mcqCategories = ['IQ', 'Math', 'Politics', 'Economics', 'Demographic', 'Other'];

                    // Create a data structure ensuring all categories are present
                    const mcqData = mcqCategories.map(category => {
                        const entry = data.find(item => item.nature === category);
                        return {
                            nature: category,
                            count: entry ? entry.count : 0
                        };
                    });

                    new Chart(mcqCtx, {
                        type: 'bar',
                        data: {
                            labels: mcqData.map(entry => entry.nature),
                            datasets: [{
                                label: 'MCQ Questions',
                                data: mcqData.map(entry => entry.count),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)',
                                    'rgba(255, 159, 64, 0.6)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                });

            // Fetch and render Short Answer Chart
            fetch('/moderator-sh-data')
                .then(response => response.json())
                .then(data => {
                    const shCtx = document.getElementById('shortAnswerChart').getContext('2d');

                    // Define all possible Short Answer categories
                    const shCategories = ['IQ', 'Math', 'Politics', 'Economics', 'Demographic', 'Other'];

                    // Create a data structure ensuring all categories are present
                    const shData = shCategories.map(category => {
                        const entry = data.find(item => item.nature === category);
                        return {
                            nature: category,
                            count: entry ? entry.count : 0
                        };
                    });

                    new Chart(shCtx, {
                        type: 'bar',
                        data: {
                            labels: shData.map(entry => entry.nature),
                            datasets: [{
                                label: 'Short Answer Questions',
                                data: shData.map(entry => entry.count),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)',
                                    'rgba(255, 159, 64, 0.6)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                });

            // Fetch and render Pie Chart
            fetch('/moderator-data')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('moderatorPieChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['MCQ', 'Short Answer'],
                            datasets: [{
                                label: 'Questions Moderated',
                                data: [data.mcq, data.short_answer],
                                backgroundColor: [
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)'
                                ],
                                borderColor: [
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        });
    </script>
</body>
</html>
