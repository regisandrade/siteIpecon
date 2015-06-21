 <style type="text/css">
   #mapa{
      width: 100%;
      height: 450px;
      border:1px solid #000;
      position: relative;
      top: 10px;

      -moz-box-shadow: 7px 7px 6px #CCC;
      -webkit-box-shadow: 7px 7px 6px #CCC;
      box-shadow: 7px 7px 6px #CCC;

      -moz-border-radius: 5px 5px 5px 5px;
      -webkit-border-radius: 5px 5px 5px 5px;
      border-radius: 5px 5px 5px 5px;

      margin-bottom: 20px;

   }
</style>
<script type="text/javascript">
  var map;

  function initialize() {
      var myLatlng = new google.maps.LatLng(<?php echo LATITUDE; ?>, <?php echo LONGITUDE; ?>);
      var mapOptions = {
        zoom: 17,
        center: myLatlng,
        panControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      // Parâmetros do texto que será exibido no clique;
      var contentString = '<h3><?php echo EMPRESA ?></h3>';
      var infowindow = new google.maps.InfoWindow({
          content: contentString,
          maxWidth: 700
      });

      var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);

      // Marcador personalizado;
      var image = 'https://cdn1.iconfinder.com/data/icons/destinations/200/Ivan_Kostynyk_Icon-01-64.png';
      var marcadorPersonalizado = new google.maps.Marker({
        position: myLatlng,
        map: map,
        icon: image,
        title: 'IPECON - Ensino e Consultoria - Goiânia/GO',
        animation: google.maps.Animation.DROP
      });

      // Exibir texto ao clicar no pin;
      google.maps.event.addListener(marcadorPersonalizado, 'click', function() {
        infowindow.open(map,marcadorPersonalizado);
      });
  }

  // Função para carregamento assíncrono
  function loadScript() {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyD6qo-nK1_R_tTUXTFeyHfyyIVYJg2IoVw&sensor=true&callback=initialize";
    document.body.appendChild(script);
  }

  window.onload = loadScript;
</script>

<div class="titulo">Localização</div>
<div class="texto">
  <div id="mapa"></div>
</div>
