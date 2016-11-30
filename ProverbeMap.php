<html>
  <head>
    <title> Proverbes</title>
  </head>
    <body>
      <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
      <script src="datamaps.world.min.js"></script>
      <div id="container" style="position: relative; width: 800px; height: 500px;"></div>
      <script>
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
                                        //alert(geography.properties.name);

                                        var m = {};

                                      
                                          m[geography.id] = '#000000';
                                      
                                          datamap.updateChoropleth(m);
                                     

                                    });
                                  }


            


                                });



      </script>


    </body>	   
</html>