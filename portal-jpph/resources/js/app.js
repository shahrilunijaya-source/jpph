import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

Chart.defaults.color = '#0A2540';
Chart.defaults.borderColor = 'rgba(10,37,64,0.1)';
Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
Chart.defaults.font.size = 13;
Chart.defaults.plugins.legend.position = 'bottom';
Chart.defaults.responsive = true;
Chart.defaults.maintainAspectRatio = false;

window.Chart = Chart;

window.jpphChart = function (canvas, config) {
    if (canvas._jpphChart) {
        canvas._jpphChart.destroy();
    }
    canvas._jpphChart = new Chart(canvas, config);
    return canvas._jpphChart;
};
