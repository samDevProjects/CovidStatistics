function chart_pie(cases, deaths, cured, id){

    var ctx = document.getElementById(id).getContext('2d');

    var chart = new Chart(ctx, {
        type: 'pie',
    
        data: {
            labels: ['cases', 'deaths', 'cured'],
            datasets: [{
                label: 'Positif/Negatif',
                backgroundColor: [
                    'rgb(29, 233, 182)',
                    'rgb(163, 137, 212)',
                    'rgb(4, 169, 245)'
                ],
                borderColor: [
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)'
                ],
                data: [cases, deaths, cured]
            }]
        },
    });
}


