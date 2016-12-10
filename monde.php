<html>
  <head>
    <title> Proverbes</title>
  </head>
    <body>
      <script src="js/d3.js"></script>
      <script src="js/topojson.js"></script>
      <script src="js/datamaps.world.js"></script>
      <div id="container" style="position: relative; width: 800px; height: 500px;"></div>
      <script>
      	var data = [], mousedownID = -1;  //Global ID of mouse down interval
      	var color = d3.scale.linear().domain([0,100]).range(["green","red"]);
        var map = new Datamap({
                                 element: document.getElementById('container'), 
                                 fills: { defaultFill: 'rgba(95,0,45,0.9)'
                                        },
                                        geographyConfig: {
                                          highlightOnHover: false,
                                          popupOnHover: true
                                      },
                                  done: function(datamap) 
                                  {
                                    datamap.svg.selectAll('.datamaps-subunit').on('click', function(geography) 
                                    {
                                     
                                    });
                                    datamap.svg.selectAll('.datamaps-subunit').on('mousedown', function(geography) 
                                    {
                                    	mouseDown(geography);                                                                       
                                    });

                                   /* datamap.svg.selectAll('.datamaps-subunit').on('mouseover', function(geography) 
                                    {
                                      mouseOver(geography);                                                                       
                                    });*/
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
 var test= false ;
function mouseDown(geography){
 
    timeout = setInterval( function(){


            if(data[geography.id]){

              data[geography.id] ++;
            }else{
              data[geography.id] = 1;
            }
            var m = {};                                        
            m[geography.id] = color(data[geography.id]);
            map.updateChoropleth(m);}, 100);
            test= true ; 

    return false;
}


function mouseUp(geography){

clearInterval(timeout);
    return false;
}



/*function mouseOver(geography){
  if (test)

  return '<div class="hoverinfo"><strong>' + data[geography.id] + '</strong></div>';
}
*/



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