
function getData(id){
    var ctx = document.getElementById('all-data').getContext('2d');

    var ctx_canvas = document.getElementById(id).getContext('2d');

    var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
    var labels = new Array();
    var all = {};

    var months_num = strToArray(ctx.canvas.dataset.months);

    for (let i = 0; i < months_num.length; i++) {
        labels.push(months[months_num[i]]);
    }

    var cases_arr = strToArray(ctx.canvas.dataset.cases);
    var intcare_arr = strToArray(ctx.canvas.dataset.intcare);
    var deaths_arr = strToArray(ctx.canvas.dataset.deaths);
    var cured_arr = strToArray(ctx.canvas.dataset.cured);
    var tested_arr = strToArray(ctx.canvas.dataset.tested);
    var negatif_arr = strToArray(ctx.canvas.dataset.negatif);

    var cases = ctx.canvas.dataset.all_cases;
    var intcare = ctx.canvas.dataset.all_intcare;
    var deaths = ctx.canvas.dataset.all_deaths;
    var cured = ctx.canvas.dataset.all_cured;
    var tested = ctx.canvas.dataset.all_tested;
    var negatif = ctx.canvas.dataset.all_negatif;

    all["ctx"] = ctx_canvas;
    all["labels"] = labels;
    all["cases_arr"] = cases_arr;
    all["deaths_arr"] = deaths_arr;
    all["cured_arr"] = cured_arr;
    all["intcare_arr"] = intcare_arr;
    all["tested_arr"] = tested_arr;
    all["negatif_arr"] = negatif_arr;
    all["cases"] = cases;
    all["deaths"] = deaths;
    all["cured"] = cured;
    all["intcare"] = intcare;
    all["tested"] = tested;
    all["negatif"] = negatif;

    return all;
}

function DonutByMonth(id){
    var all = getData(id);
    var text = all.tested + ' tested';

    console.log(all.deaths)

    var chart = new Chart(all.ctx, {
        type: 'doughnut',
        data: {
            labels: ['Cured', 'Intcare', 'Deaths'],
            datasets: [{
                label: 'Deaths/Cured',
                backgroundColor: [
                    'rgb(29, 233, 182)',
                    'rgb(163, 137, 212)',
                    'rgb(255, 130, 122)'
                ],
                borderColor: [
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)'
                ],
                data: [all.cured, all.intcare, all.deaths]
            }]
        },
        
        options: {
            elements: {
                center: {
                    
                    hover: {mode: null},
                    text: text,
                    color: 'gray', // Default is #000000
                    fontStyle: 'Arial', // Default is Arial
                    sidePadding: 20, // Default is 20 (as a percentage)
                    fontSize: 13, // Default is 20 (in px), set to false and text will not wrap.
                    lineHeight: 20 // Default is 25 (in px), used for when text wraps
                }
            }
        }
    });
}

function LineByMonth(id){
    var all = getData(id);

    var chart = new Chart(all.ctx, {
        type: 'line',
    
        data: {
            labels: all.labels,
            datasets: [{
                label: 'Cases',
                backgroundColor: 'rgb(138, 158, 212, 0.4)',
                borderColor: 'rgb(110, 118, 181)',
                data: all.cases_arr
            },{
                label: 'Intcare',
                backgroundColor: 'rgb(233, 130, 29)',
                borderColor: 'rgb(233, 59, 29)',
                data: all.intcare_arr
            },{
                label: 'death',
                backgroundColor: 'rgb(0, 0, 0, 0.5)',
                borderColor: 'rgb(102, 121, 130)',
                data: all.deaths_arr
            },{
                label: 'Cured',
                backgroundColor: 'rgb(29, 233, 182, 0.4)',
                borderColor: 'rgb(233, 59, 29)',
                data: all.cured_arr
            }]
        },
        options: {
            scaleShowVerticalLines: false,
            scaleShowHorizontalLines: false,
        }
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