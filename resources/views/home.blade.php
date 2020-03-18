<html>
<header>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<title>Principal</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    header {
	display:flex;
	justify-content:center;
    height:120px;
    background-color:#39aae1;
    }
    .container {
    padding:50;    
	display:flex;
	justify-content:space-between;
	width:990px;
}
.btn {
    background-color:#39aae1;
    border-color:#FFFFFF;
    cursor: pointer;
    width:120px;
    height:38px;
    font-weight: bold;
    color:#ffff;

}
}
</style>

<div class="container">
        <nav class="navbar navbar-light">
            <form class="form-inline" id="formParticipant">
                <input class="form-control mr-sm-2" id="frist_name" placeholder="Frist Name" >
                <input class="form-control mr-sm-2" id="last_name" placeholder="Last Name" >
                <input class="form-control mr-sm-2" id="participation" placeholder="Participation" >
                    <button class="btn btn-primary" type="submit">SEND</button>
             </form>
        </nav>
    </div>

</header>

<body>
    <div class="container">
    <div class="row">
  <div class="col-sm-9">
  <h4>DATA</h4>
    <div class="row">
      <div class="col-8 col-sm-6">
      <table class="table table-ordered table-hover" id="tabelaParticipant">
            <thead>
                <tr>
                    <th>Cod.</th>
                    <th>Frist Name</th>
                    <th>Last Name</th>
                    <th>Partitipation</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
      </div>
      <div class="col-6 col-sm-4">
      <canvas id="labelChart"></canvas>
    </div>
  </div>
</div>
    
    </div>    
    <script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
</body>
</html>

<script type="text/javascript">
     
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function montarLinha(p){
        var line = "<tr>"+
        "<td>" + p.id + "</td>" +
        "<td>" + p.frist_name + "</td>" +
        "<td>" + p.last_name + "</td>" +
        "<td>" + p.participation + "</td>" +
        "</tr>";

        return line;
    }


     function loadParticipant(){
         $.getJSON('/api/participant', function(participant){
             for(i=0;i<participant.length;i++){
                 line = montarLinha(participant[i]);
                 $('#tabelaParticipant>tbody').append(line);
             }
         });
     }
     function criarParticipant() {
        par = { 
            frist_name: $("#frist_name").val(), 
            last_name: $("#last_name").val(), 
            participation: $("#participation").val(), 
        };
        $.post("/api/participant", par, function(data) {
            participant = JSON.parse(data);
            line = montarLinha(participant);
            $('#tabelaParticipant>tbody').append(line);            
        });
    }

    $("#formParticipant").submit( function(event){ 
        event.preventDefault(); 
        criarParticipant();
    });

    

     $(function(){
        loadParticipant();
    })
</script>