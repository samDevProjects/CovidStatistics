function chart_dep(){

    var new_labels = Array();
    var new_cases = Array();
    var new_cured = Array();
    var new_deaths = Array();

    var ctx = document.getElementById('myChart-dep').getContext('2d');
    
    var labels_string = ctx.canvas.dataset.lb;
    var labels_array = strToArray(labels_string);

    

    var cases_string = ctx.canvas.dataset.cases;
    var cases_array = strToArray(cases_string);

    console.log(cases_array);

    var deaths_string = ctx.canvas.dataset.deaths;
    var deaths_array = strToArray(deaths_string);

    var cured_string = ctx.canvas.dataset.cured;
    var cured_array = strToArray(cured_string);

    for (let i = 0; i < cases_array.length; i++) {
        if (cases_array[i] > 5) {
            new_cases.push(cases_array[i]);
            new_cured.push(cured_array[i]);
            new_deaths.push(deaths_array[i]);
            new_labels.push(labels_array[i]);
        }
    }

    console.log(new_labels);

    var chart = new Chart(ctx, {
        type: 'bar',
    
        data: {
            labels: new_labels,
            datasets: [{
                label: 'Cases',
                backgroundColor: 'rgb(138, 158, 212, 0.5)',
                borderColor: 'rgb(110, 118, 181)',
                data: new_cases
            },{
                label: 'Deaths',
                backgroundColor: 'rgb(233, 130, 29, 0.5)',
                borderColor: 'rgb(233, 59, 29)',
                data: new_deaths
            },{
                label: 'Cured',
                backgroundColor: 'rgb(29, 230, 186, 0.5)',
                borderColor: 'rgb(29, 200, 229)',
                data: new_cured
            }]
        },
        options: {}
    });

}

function strToArray(str){
    if (str.includes('[') || str.includes(']')) {
        var sub_str = str.substring(1, str.length-1);
        var arr = sub_str.split(',');
    }
    else{
        var arr = str.split(',');
    }
    return arr;
}
