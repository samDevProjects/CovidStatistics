// let def = document.getElementsByClassName("mapTooltip");
// const config = { attributes: true, childList: true, subtree: true };

// let obs = new MutationObserver(() => $("#result").html(def[0].innerHTML));

// obs.observe(def[0], config);

// // show.setAttribute("style", "visibility: hidden");
function getDepData(data){
  
  // console.log(data);
  var obj = {};
  // var areas = {};

  $.each(data, function(key, town){
    obj[Object.keys(town)[0]] = town[Object.keys(town)[0]];
    
  });
  
    // d = data[3];
    $(".mapcontainer").mapael({
      map: {
        // Set the name of the map to display
        name: "france_departments",
        width: 800,
        cssClass: "map",
        // tooltip: {
        //   cssClass: "mapTooltip"
        // },
        defaultArea: {
            attrs: {
                fill: "#d3d3e2",
                stroke: "#5d5d5d",
                "stroke-width": 0.5,
                "stroke-linejoin": "round"
            },
            attrsHover: {
              fill: "#8DF2DC",
              animDuration: 300
            },
            text: {
                position: "inner",
                margin: 10,
                attrs: {
                    "font-size": 15,
                    fill: "#c7c7c7"
                },
                attrsHover: {
                    fill: "#eaeaea",
                    "animDuration": 300
                }
            },
            //  tooltip: {
            //       cssClass: "mapTooltip"
            // }
          }
      },
      //
      // slices: [{
      //   max: 3.9,
      //   attrs: {
      //     fill: "#F0F0F2",
      //     text: "value",
      //     opacity: ".80"
      //   }

    
      plots: obj
    });
}



// let defTooltip = document.getElementsByClassName("mapTooltip");
// var test = defTooltip[0];

// console.log(test);
// const config = { attributes: true, childList: true, subtree: true };

// let observer = new MutationObserver(() => $("#result").html(defTooltip[0].innerHTML))
// observer.observe(defTooltip[0], config);



// var show = document.getElementById('result');
// var els = document.getElementsByClassName("map");
// var target = document.getElementsByClassName("mapToolTip");

// console.log(els);
// // show.setAttribute("style", "width: 100px; height: 100px; top:100px; left:100px; background:gray;");

// for (let index = 0; index < els.length; index++) {
//   // els[index].addEventListener("mouseover", function() {
//     console.log(els[index].innerHTML);
//       // console.log(target[0].innerText);
//       // show.setAttribute("style", "width: 100px; height: 100px; top:100px; left:100px; background:gray;");
//       // show.innerHTML = div[0].innerText;
//   // });
// }