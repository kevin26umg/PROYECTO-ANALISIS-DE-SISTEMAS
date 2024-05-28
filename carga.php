<style>
    #contenedorcarga{
background-color:white;
height:100%;
width:100%;
position:fixed;
transition: all 1s ease;
z-index:10000;

display: flex;
 justify-content: center;
  align-items: center;
 
 
    }
    #myBar{
        transition: width 0.2s;
    }
#carga{
    transform:scale(1);
    /* position:absolute; */
    /* top:0;
    left:0; 
    right:0;
    bottom:0;
    margin:auto; */
 
}
</style>

   <!-- <div id="carga"> -->
    <!--<img id="carga" src="assets/vendors/svg-loaders/bars.svg" class="me-4" style="width: 3rem" alt="audio">-->
   
    <div>
    <img id="carga" src="imagenes/freedom2.png" class="" width="450" style="padding:0 50px;" alt="audio">
    <br><br>
      <div style="margin: 0 50px;" class="progress progress-warning progress-lg  mb-4">
          
                    <div id="myBar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100"></div>
                        
                </div>
    </div>
    
    <!-- </div> -->
        <script>
        
        var i=0;
        window.onload =function(){
            
                           if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
        
         setTimeout(function() {
            var contenedor= document.getElementById('contenedorcarga');
            var carga= document.getElementById('carga');
            // contenedor.style.transformOrigin="top";
            // contenedor.style.background="transparent";
            contenedor.style.visibility="hidden";
            contenedor.style.opacity="0";
            // contenedor.style.marginTop="-100%";
            // contenedor.style.top="-100%";
            }, 150);
            
      } else {
        width++;
        elem.style.width = width + "%";
      }
    }
  }
  
        
           
            

            

        }
    </script>	