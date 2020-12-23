function chart(){

    var ctx = document.getElementById('myChart').getContext('2d');
    var labels_string = ctx.canvas.dataset.labels;
    var labels_array = strToArray(labels_string);

    var new_labels = Array();
    for (let i = 0; i < labels_array.length; i++) {
        new_labels[i] = 'week ' + labels_array[i];
    }

    var cases_string = ctx.canvas.dataset.cases;
    var cases_array = strToArray(cases_string);

    var deaths_string = ctx.canvas.dataset.deaths;
    var deaths_array = strToArray(deaths_string);

    var cured_string = ctx.canvas.dataset.cured;
    var cured_array = strToArray(cured_string);

    var chart = new Chart(ctx, {
        type: 'line',
    
        data: {
            labels: new_labels,
            datasets: [{
                label: 'Cases',
                backgroundColor: 'rgb(138, 158, 212, 0.5)',
                borderColor: 'rgb(110, 118, 181)',
                data: cases_array
            },{
                label: 'Deaths',
                backgroundColor: 'rgb(233, 130, 29, 0.5)',
                borderColor: 'rgb(233, 59, 29)',
                data: deaths_array
            },{
                label: 'Cured',
                backgroundColor: 'rgb(29, 230, 186, 0.5)',
                borderColor: 'rgb(29, 200, 229)',
                data: cured_array
            }]
        },
        options: {}
    });
    console.log('from dep');
}

function strToArray(str){
    var sub_str = str.substring(1, str.length-1);
    var arr = sub_str.split(',');
    return arr;
}

function chartDep(){

    var ctx = document.getElementById('myChart-dep').getContext('2d');
    // var labels_string = ctx.canvas.dataset.labels;
    // var labels_array = strToArray(labels_string);

    // var new_labels = Array();
    // for (let i = 0; i < labels_array.length; i++) {
    //     new_labels[i] = 'week ' + labels_array[i];
    // }

    // var cases_string = ctx.canvas.dataset.cases;
    // var cases_array = strToArray(cases_string);

    // var deaths_string = ctx.canvas.dataset.deaths;
    // var deaths_array = strToArray(deaths_string);

    // var cured_string = ctx.canvas.dataset.cured;
    // var cured_array = strToArray(cured_string);

    // var chart = new Chart(ctx, {
    //     type: 'line',
    
    //     data: {
    //         labels: new_labels,
    //         datasets: [{
    //             label: 'Cases',
    //             backgroundColor: 'rgb(138, 158, 212, 0.5)',
    //             borderColor: 'rgb(110, 118, 181)',
    //             data: cases_array
    //         },{
    //             label: 'Deaths',
    //             backgroundColor: 'rgb(233, 130, 29, 0.5)',
    //             borderColor: 'rgb(233, 59, 29)',
    //             data: deaths_array
    //         },{
    //             label: 'Cured',
    //             backgroundColor: 'rgb(29, 230, 186, 0.5)',
    //             borderColor: 'rgb(29, 200, 229)',
    //             data: cured_array
    //         }]
    //     },
    //     options: {}
    // });
    console.log('from dep');
}