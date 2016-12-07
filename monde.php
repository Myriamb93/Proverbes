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
      	var dataMap = [];
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
                                        var m = {};                                        
                                        //alert(geography.properties.name);
                                        if(dataMap[geography.id]){
                                        	if(dataMap[geography.id] == 'red') m[geography.id] = 'green';
                                        	else m[geography.id] = 'red';
                                        }else{
                                            m[geography.id] = 'green';
                                        }
                                        dataMap[geography.id] = m;
                                      	datamap.updateChoropleth(dataMap[geography.id]);
                                     
                                    });
                                  }
            
                                });
      </script>


    </body>	   
</html>