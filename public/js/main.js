window.onload = function () {
            // Initialize EasyPieCharts
            $('.easypiechart').easyPieChart({
                easing: 'easeOutBounce',
                barColor: function(percent) {
                    // Different colors for different charts
                    var id = $(this).attr('id');
                    var colors = {
                        'easypiechart-blue': '#30a5ff',
                        'easypiechart-orange': '#ffb53e',
                        'easypiechart-teal': '#1ebfae',
                        'easypiechart-red': '#f9243f',
                        'easypiechart-green': '#4CAF50',
                        'easypiechart-purple': '#9C27B0'
                    };
                    return colors[id] || '#30a5ff';
                },
                trackColor: '#f2f2f2',
                scaleColor: false,
                lineWidth: 8,
                lineCap: 'round',
                animate: 1000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        };