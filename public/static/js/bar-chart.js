window.onload = sendRequestStats;
window.onresize = destroyBarChart;

let data;

function sendRequestStats() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(isConnected => {
        if (isConnected) {
            fetch('/api/trocs/stats.php').then(data => {
                return data.json()
            }).then(res => {
                data = res;
                data.forEach(stats => {
                    stats['date'] = stats['date'].substring(5, stats['date'].length);
                    const tab = stats['date'].split('-');
                    stats['date'] = tab[1] + '-' + tab[0];
                })
                createBarChart();
            });
            fetch('/api/trocs/findAll.php?last-10=true').then(data => {
                return data.json()
            }).then(res => {
                createCarousel(res);
            });
        } else {
            document.location.href = "/index.php"
        }
    });


}


function createBarChart() {
    var margin = {top: 20, right: 30, bottom: 35, left: 30};
    var width = Math.max(388, (document.getElementById("container-bar-chart").offsetWidth - 40)) - margin.left - margin.right,
        height = 360 - margin.top - margin.bottom;

    var svg = d3.select("#graph")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        //   .attr('viewBox', '0 0 ' + height + ' ' + width)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


    var dataset = d3.layout.stack()(["validate", "cancel"].map(function (type) {
        return data.map(function (d) {
            return {x: d.date, y: +d[type], type: type};
        });
    }));

    var x = d3.scale.ordinal()
        .domain(dataset[0].map(function (d) {
            return d.x;
        }))
        .rangeRoundBands([10, width - 10], 0.02);

    var y = d3.scale.linear()
        .domain([0, d3.max(dataset, function (d) {
            return d3.max(d, function (d) {
                return d.y0 + d.y;
            });
        })])
        .range([height, 0]);

    var colors = ["var(--validation-color)", "var(--refusal-color)"];


    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left")
        .ticks(5)
        .tickSize(-width, 0, 0)
        .tickFormat(function (d) {
            return d
        });

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom")

    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);


    var groups = svg.selectAll("g.cost")
        .data(dataset)
        .enter().append("g")
        .attr("class", "cost")
        .style("fill", function (d, i) {
            return colors[i];
        });

    var rect = groups.selectAll("rect")
        .data(function (d) {
            return d;
        })
        .enter()
        .append("rect")
        .attr("x", function (d) {
            return x(d.x) + (width * (width > 600 ? 0.055 : 0.04));
        })
        .attr("y", function (d) {
            return y(d.y0 + d.y);
        })
        .attr("height", function (d) {
            return y(d.y0) - y(d.y0 + d.y);
        })
        .attr("width", 25)
        .on("mouseover", function (d) {
            console.log(d);
            tooltip.style("display", null);
        })
        .on("mouseout", function () {
            tooltip.style("display", "none");
        })
        .on("mousemove", function (d) {
            var xPosition = d3.mouse(this)[0] - 15;
            var yPosition = d3.mouse(this)[1] - 25;
            tooltip.attr("transform", "translate(" + xPosition + "," + yPosition + ")");
            tooltip.select("text").text(d.y + (d.type == 'validate' ? ' trocs réussis' : ' trocs avortés'));
        });

    var tooltip = svg.append("g")
        .attr("class", "tooltip")
        .style("display", "none");

    tooltip.append("rect")
        .attr("width", 100)
        .attr("height", 20)
        .attr("fill", "var(--background-color)")
        .attr('text-anchor', 'middle')
        .style("opacity", 1);

    tooltip.append("text")
        .attr("x", 50)
        .attr("dy", "1.2em")
        .style("text-anchor", "middle")
        .attr("font-size", "12px")
        .attr("fill", "var(--font-color)")
        .attr("font-weight", "bold");

}


function destroyBarChart() {
    if (data) {
        document.getElementById("graph").innerHTML = '';
        createBarChart();
    }
}

function createCarousel(swaps) {
    let carouselHTML = '';
    if (swaps) {
        swaps.forEach(swap => {
            carouselHTML += templateItemsSwapped(swap, true);
        })
    }
    document.getElementById('slide').innerHTML = carouselHTML;
}