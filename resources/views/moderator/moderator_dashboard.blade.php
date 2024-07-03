<!DOCTYPE html>
<html>
<head>
    <title>Moderator Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0; /* Optional: Set a background color */
            font-family: Arial, sans-serif; /* Optional: Set a font for better readability */
        }
        #chart-container {
            width: 40%; /* Adjusted width for better proportion */
            max-width: 600px; /* Limiting maximum width to avoid too large charts */
            text-align: center; /* Center align the chart */
        }
        canvas {
            max-width: 100%; /* Make the chart responsive */
            height: auto; /* Ensure the chart maintains aspect ratio */
        }

        .btn {
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-bottom: 10px; /* Adds space between buttons */

        }

        .btn-mcq {
            background-color: #48daa9; /* Green background for MCQ button */
            color: white; /* White text */
            margin-bottom: 10px;
        }

        .btn-mcq:hover {
            background-color: #d99cf1; /* Darker green on hover */
        }

        .btn-sh {
            background-color: #d14eebbb; /* Purple background for Short Answer button */
            color: white; /* White text */
        }

        .btn-sh:hover {
            background-color: #b650d1; /* Darker purple on hover */
        }

    </style>
</head>
<body>
    <div>
        <a href="{{ route('mcq.chart') }}" class="btn btn-mcq">Do MCQ Analysis</a>
    </div>

    <div>
        <a href="{{ route('short.answer.chart') }}" class="btn btn-sh">Do SH- Analysis</a>
    </div>
    <div id="chart-container">
        <h1>Track Your Impact





        </h1>
        <p>Progress of Submission</p>
        <canvas id="moderatorChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/moderator-data')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('moderatorChart').getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'pie', // Change type to 'pie' for pie chart
                        data: {
                            labels: ['MCQ', 'Short Answer'],
                            datasets: [{
                                label: 'Questions Moderated',
                                data: [data.mcq, data.short_answer],
                                backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)'],
                                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
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
                            }
                        }
                    });
                });
        });
    </script>
</body>
</html>
