class LineChart {
    constructor() {
    }

    setCanvas(canvas) {
        this.canvas = canvas;
    }

    create(label, points) {
        this.chart = new Chart(this.canvas, {
            type: 'line',
            data: {
                datasets: [{
                    label: label,
                    data: points,
                    pointRadius: 0,
                    borderWidth: 2,
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                animation: false,
                responsive: true,
                scales: {
                    x: {
                        type: 'linear',
                        position: 'center',
                        min: -15,
                        max: 15
                    },
                    y: {
                        type: 'linear',
                        position: 'center',
                        min: -100,
                        max: 100
                    }
                }
            }
        });

        return this.chart;
    }
}
window.lineChart = new LineChart();
