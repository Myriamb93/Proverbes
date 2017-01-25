<html>
  <head>
    <title> Proverbes</title>
    <style type="text/css">
    body {
  background-image: url(low_contrast_linen_@2X.png);
  background-size: 256px;
  background-color: #252525;
  font-family: "Roboto", Helvetica, Arial, sans-serif;
  margin: 0;
}
h4 {
  position: absolute;
  text-align: center;
  width: 100%;
  color: rgba(255,255,255, 0.75);
  text-align: center;
  span.city {
    color: rgba(255,255,255, 0.95);
  }
}
.country:hover{
  stroke: #fff;
  stroke-width: 1.5px;
}
.text{
  font-size: 10px;
  text-transform:capitalize;
}
#container {
  margin: 0;
  border: 1px solid #3a3f4f;
  border-radius: 2px;
  height:100%;
  overflow:hidden;
  background: #575e70;
}
.hidden { 
  display: none; 
}
div.tooltip {
  color: #222; 
  background: #fff; 
  padding: .5em; 
  text-shadow: #f5f5f5 0 1px 0;
  border-radius: 2px; 
  box-shadow: 0px 0px 2px 0px #a6a6a6; 
  opacity: 0.9; 
  position: absolute;
}
.graticule {
  fill: none;
  stroke: #8f8f8f;
  stroke-width: .5px;
  stroke-opacity: .5;
}
.equator {
  stroke: #ccc;
  stroke-width: 1px;
}



</style>

  </head>
    <body>

     <h4>Your location is: <span class="city"></span></h4>
<div id="container"></div>

<script src="js/d3.v3.min.js"></script>
<script src="http://d3js.org/d3.geo.projection.v0.min.js"></script>
<script src="js/topojson.v1.min.js"></script>


      <script>
	  
  d3.select(window).on("resize", throttle);

var ismousedown = false;

var zoom = d3.behavior.zoom()
.scaleExtent([1, 9])
.on("zoom", move);


var width = document.getElementById('container').offsetWidth;
var height = width / 2;

var topo,projection,path,svg,g;

var graticule = d3.geo.graticule();

var tooltip = d3.select("#container").append("div").attr("class", "tooltip hidden");
var tooltip2 = d3.select("#container").append("div").attr("class", "tooltip hidden");


setup(width,height);

//regler le width et heigth de container et afficher les contenu
function setup(width,height){
  projection = d3.geo.mercator()
  .translate([(width/2), (height/2)])
  .scale( width / 2 / Math.PI);

  path = d3.geo.path().projection(projection);

  svg = d3.select("#container").append("svg")
  .attr("width", width)
  .attr("height", height + 8)
  .call(zoom)
  .on("click", click)
  .append("g");

  g = svg.append("g");

}

d3.json("https://api.github.com/gists/9398333", function(error, root) {

    var world = root.files['world.json'].content
  world = JSON.parse(world)
  var countries = topojson.feature(world, world.objects.countries).features;

  topo = countries;
  draw(topo);

});

function draw(topo) {
/*
  svg.append("path")
  .datum(graticule)
  .attr("class", "graticule")
  .attr("d", path);

/*
  g.append("path")
  .datum({type: "LineString", coordinates: [[-180, 0], [-90, 0], [0, 0], [90, 0], [180, 0]]})
  .attr("class", "equator")
  .attr("d", path);
*/


  var country = g.selectAll(".country").data(topo);

  country.enter().insert("path")
  .attr("class", "country")
  .attr("d", path)
  .attr("id", function(d,i) { return d.id; })
  .attr("title", function(d,i) { return d.properties.name; })
  .style("fill", function(d, i) { return "#49cc90";return d.properties.color; });

  //offsets for tooltips
  var offsetL = document.getElementById('container').offsetLeft+20;
  var offsetT = document.getElementById('container').offsetTop+10;
  var color = d3.scale.linear().domain([0,100]).range(["green","red"]);
 var pas = [];
var ic = 1;
 //var ismousedown=-1;
var colorInterval = null;
  //tooltips
  country
  .on("mousemove", function(d,i) {

    var mouse = d3.mouse(svg.node()).map( function(d) { return parseInt(d); } );

    tooltip.classed("hidden", false)
    .attr("style", "left:"+(mouse[0]+offsetL)+"px;top:"+(mouse[1]+offsetT)+"px")
    .html(d.properties.name);

  })
  .on("mouseout",  function(d,i) {
    tooltip.classed("hidden", true);
  })//; 
  /*$.getJSON( "http://smart-ip.net/geoip-json?callback=?",
        function(data){
            console.log( data);
          addpoint(data.longitude, data.latitude, data.city);
          $("span.city").html(data.city);
        }
    )*/
 /* .on("mouseout",  function(d,i) {
    tooltip.classed("hidden", true);
  })*/

  .on("mousedown", function(d,i) {
    var that = this;
    ismousedown = true;
 //esetInterval xécuter la fonction à chaque 1 seconde
    colorInterval = window.setInterval(function () {

      if (ismousedown === true) 
      { 
            
           if (! pas[d.id] ) {pas[d.id] =0 ; }

            pas[d.id] += ic;
            ic *= (((pas[d.id] % 100) == 0) ? -1 : 1);//si pas[d.id] modulos 100 egale 0 ic = ic * (-1) else ic = ic * 1

              //console.log(ic);       

                tooltip.classed("hidden", false).html(pas[d.id]);   //popup de nombre d'incrémentation       
              d3.select(that)
              .classed("active", false)
              .style("fill", function(d, i) {return color(pas[d.id]);return d.properties.color;});// changement de couleur
      } else 
      {
        window.clearInterval(colorInterval);//to stop time et intialiser les valeur pas et ic
      }


    }, 100);
  })
  
  .on("mouseup", function(d,i) {
    
    ic = 1 ; 
    ismousedown = false;
    window.clearInterval(colorInterval);
  });
}


function redraw() {
  width = document.getElementById('container').offsetWidth;
  height = width / 2;
  d3.select('svg').remove();
  setup(width,height);
  draw(topo);
}



function move() {

  var t = d3.event.translate;
  var s = d3.event.scale; 
  zscale = s;
  var h = height/4;


  t[0] = Math.min(
    (width/height)  * (s - 1), 
    Math.max( width * (1 - s), t[0] )
  );

  t[1] = Math.min(
    h * (s - 1) + h * s, 
    Math.max(height  * (1 - s) - h * s, t[1])
  );

  zoom.translate(t);
  g.attr("transform", "translate(" + t + ")scale(" + s + ")");

  //adjust the country hover stroke width based on zoom level
  d3.selectAll(".country").style("stroke-width", 1.5 / s);

}

var throttleTimer;
function throttle() {
  window.clearTimeout(throttleTimer);
  throttleTimer = window.setTimeout(function() {
    redraw();
  }, 200);
}


//geo translation on mouse click in map
function click() {
 // var latlon = projection.invert(d3.mouse(this));
 // console.log(latlon);
}


//function to add points and text to the map (used in plotting capitals)
function addpoint(longitude, latitude, text) {

  var gpoint = g.append("g").attr("class", "gpoint");
  var x = projection([longitude, latitude])[0];
  var y = projection([longitude, latitude])[1];

  gpoint.append("svg:circle")
  .attr("cx", x)
  .attr("cy", y)
  .attr("class","point")
  .attr("r", 2)
  .style("fill", "#fff");

  //conditional in case a point has no associated text
  if(text.length>0){
    gpoint.append("text")
    .attr("x", x+2)
    .attr("y", y+2)
    .attr("class","text")
    .text(text)
    .style("fill", "#fff");
  }

}


        
      </script>


    </body>	   
</html>