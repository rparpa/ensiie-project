const stats = [
    [14, 10, 2],
    [15, 12, 2],
];

let formatedStats = [];
let maxTotal = 0;
stats.forEach(stat => {
    formatedStats.push({rank: stat[0], victory: stat[1], defeat: stat[2], total: stat[1] + stat[2]})
    if (stat[1] + stat[2] > maxTotal) {
        maxTotal = stat[1] + stat[2];
    }
});

window.onload = createBarChart;
window.onresize = destroyBarChart;

function createBarChart() {
    console.log(maxTotal);
    svgHeight = 70 * formatedStats.length;
    svgWidth = document.getElementById("graph").offsetWidth;
    stepWidth = (svgWidth - 50) / maxTotal;
    formatedStats.columns = formatedStats.map(formatedStat => formatedStat.rank);
    var svg = d3.select("#graph").append("svg").attr("height", svgHeight).attr("width", svgWidth);
    margin = {top: 40, right: 20, bottom: 30, left: 40};
    width = +svg.attr("width") - margin.left - margin.right;
    height = +svg.attr("height") - margin.top - margin.bottom;
    g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var y = d3.scaleBand()            // x = d3.scaleBand()
        .rangeRound([0, height])    // .rangeRound([0, width])
        .paddingInner(0.05)
        .align(0.1);

    const colors = ['var(--validation-color)', 'var(--refusal-color)'];

    var keys = formatedStats.columns;

    formatedStats.sort(function (a, b) {
        return b.rank - a.rank;
    });
    y.domain(formatedStats.map(function (d) {
        return d.rank;
    }));
    g.append("g")
        .selectAll("g")
        .data(d3.stack().keys(['victory', 'defeat'])(formatedStats))
        .enter().append("g")
        .attr("fill", function (d) {
            return colors[d.index];
        })
        .selectAll("rect")
        .data(function (d) {
            return d;
        })
        .enter().append("rect")
        .attr("y", function (d) {
            return y(d.data.rank);
        })
        .attr("x", function (d) {
            return d[0] * stepWidth;
        })
        .attr("width", function (d) {
            return (d[1] - d[0]) * stepWidth;
        })
        .attr("height", "20px");

    g.append("g")
        .attr("class", "axis")
        .attr("transform", "translate(0, " + (formatedStats.length == 1 ? 10 : -15) + ")")
        .call(d3.axisLeft(y));
}


function destroyBarChart() {
    document.getElementById("graph").innerHTML = '';
    createBarChart();
}