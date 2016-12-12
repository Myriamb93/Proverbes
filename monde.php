<html>
  <head>
    <title> Proverbes</title>
    <style type="text/css">#container {
  margin-bottom: 5px;
  overflow: hidden;
  border: 2px solid silver;
  border-radius: 6px;
  background: white;
}

</style>
<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.css" />
  </head>
    <body>

      <script src="js/d3.js"></script>
      <script src="js/topojson.js"></script>
      <script src="js/datamaps.world.js"></script>
      <div id="container"  style="  width: 800px; height: 500px;"  ></div>
      <button class="zoom-button" data-zoom="out"><i class="fa fa-search-minus" aria-hidden="true"></i></button>
      <button class="zoom-button" data-zoom="reset"><i class="fa fa-undo" aria-hidden="true"></i></button>
      <button class="zoom-button" data-zoom="in" ><i class="fa fa-search-plus" aria-hidden="true"></i></button>
 

      <script>
      	var data = [], maxDomain = 32, inc = true;   
      	var color = d3.scale.linear().domain([0,maxDomain]).range(["green","red"]);
        var map = new Datamap({
                                 element: document.getElementById('container'), 
                                 fills: { defaultFill: 'green'
                                        },
                                        geographyConfig: {
                                          highlightOnHover: false,
                                          popupOnHover: true   
                                      },

                           /* setProjection: function(element)
                           {
                              var projection = d3.geo.equirectangular()
                                .center([23, -3])
                                .rotate([4.4, 0])
                                .scale(400)
                                .translate([element.offsetWidth / 2, element.offsetHeight / 2]);
                              var path = d3.geo.path()
                                .projection(projection);

                              return {path: path, projection: projection};
                          },


                          data: {
                            'ZAF': { fillKey: 'blue' },
                            'ZWE': { fillKey: 'lt25' },
                            'NGA': { fillKey: 'lt50' },
                            'MOZ': { fillKey: 'eq50' },
                            'MDG': { fillKey: 'eq50' },
                            'EGY': { fillKey: 'gt75' },
                            'TZA': { fillKey: 'gt75' },
                            'LBY': { fillKey: 'eq0' },
                            'DZA': { fillKey: 'gt500' },
                            'SSD': { fillKey: 'pink' },
                            'SOM': { fillKey: 'gt50' },
                            'GIB': { fillKey: 'eq50' },
                            'AGO': { fillKey: 'lt50' }
                          },*/
                                  done: function(datamap) 
                                  {
                                    datamap.svg.selectAll('.datamaps-subunit').on('click', function(geography) 
                                    {
                                     
                                    });                         

                                    datamap.svg.selectAll('.datamaps-subunit').on('mousedown', function(geography) 
                                    {
                                    	mouseDown(geography);                                                                       
                                    });
                             
                                    datamap.svg.selectAll('.datamaps-subunit').on('mouseup', function(geography)
                                   {
                                    	mouseUp();
                                   });


                                

                                    datamap.svg.selectAll('.datamaps-subunit').on('mouseout', function(geography)
                                            {
                                    		mouseUp();
                                    	});


                                  }
            
                                });


 var timeout ;
 var m = {}; 
 
function mouseDown(geography){
 
    timeout = setInterval( function(){


            if(data[geography.id]){
				if(data[geography.id] >= maxDomain)
					inc	= false;	              					
				if(data[geography.id] <= 1)
					inc	= true;
            }else{
              data[geography.id] = 0;
            }
            if(inc) data[geography.id] ++; else data[geography.id] --;
                                                   
            m[geography.id] = color(data[geography.id]);
            map.updateChoropleth(m);}, 100);
          

    return false;
}


function mouseUp(geography){

clearInterval(timeout);
    return false;
}



function dosomething(geography)
{

  if(data[geography.id]){

    
  }
}

  


/*
 var loopthis;
function mouseDown (geography) {
    loopthis = setInterval(repeatingfunction(geography), 100);
}



function mouseUp () {
    clearInterval(loopthis);
}

function repeatingfunction(geography) {

var m = {};    
console.log(data[geography.id] );



    if(data[geography.id])
    {

        while( data[geography.id] < 100 )
          {
           data[geography.id]++;
           m[geography.id] = color(data[geography.id]);
            map.updateChoropleth(m);
          }

          while( data[geography.id] > -1 )
          {
              data[geography.id]--;
              m[geography.id] = color(data[geography.id]);
            map.updateChoropleth(m);
          }
    }
  else
  {
    data[geography.id] = 1;
    m[geography.id] = color(data[geography.id]);
            map.updateChoropleth(m);
  }
                                                
            
}

*/



		//merci à http://stackoverflow.com/questions/15505272/javascript-while-mousedown
	/*	function mouseDown(geography){
			console.log('mousedown '+mousedownID);
            
            if(mousedownID==-1)  //Prevent multimple loops!
                mousedownID = setInterval(whilemousedown(geography), 100 );
		}
		function mouseUp(){
			console.log('mouseup '+mousedownID);
            if(mousedownID!=-1) {  //Only stop if exists
                clearInterval(mousedownID);
                mousedownID=-1;
              }                                        
			
		}
        function whilemousedown(geography) {

			console.log('whilemousedown '+mousedownID+' '+geography);
            if(data[geography.id]){
            	data[geography.id] ++;
            }else{
            	data[geography.id] = 1;
            }
            var m = {};                                        
            m[geography.id] = color(data[geography.id]);
            map.updateChoropleth(m);

            if(mousedownID!=-1) 
             mousedownID = setInterval(whilemousedown, );

        }*/
        
      </script>


    </body>	   
</html>