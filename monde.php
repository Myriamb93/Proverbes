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
      	var color = d3.scale.linear().domain([0,10]).range(["green","red"]);
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

		//merci à http://stackoverflow.com/questions/15505272/javascript-while-mousedown
		function mouseDown(geography){
			console.log('mousedown '+mousedownID);
            
            if(mousedownID==-1)  //Prevent multimple loops!
                mousedownID = setInterval(whilemousedown(geography), 100 /*execute every 100ms*/);
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

        }
        
      </script>


    </body>	   
</html>