function chart_donut(data_1, data_2, id, label1, label2, condition){

    var positif = data_1;
    var tested = data_2;

    if (condition == true) {
        var negatif = tested - positif;    
    }
    else{
        var negatif = tested;
    }

    var ctx = document.getElementById(id).getContext('2d');

    var text = tested + ' tested';

    var chart = new Chart(ctx, {
        type: 'doughnut',
    
        data: {
            labels: [label1, label2],
            datasets: [{
                label: 'Positif/Negatif',
                backgroundColor: [
                    'rgb(29, 233, 182)',
                    'rgb(163, 137, 212)'
                ],
                borderColor: [
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)',
                ],
                data: [positif, negatif]
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
                    fontSize: 20, // Default is 20 (in px), set to false and text will not wrap.
                    lineHeight: 25 // Default is 25 (in px), used for when text wraps
                }
            }
        }
    });
}


