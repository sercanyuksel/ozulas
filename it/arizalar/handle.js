$( "#car_id" ).change(function() {
    $('#dynamicInput').remove();
    var deger=$("#car_id").val();
    $.get("ajax/fetch_car_camera.php?id="+deger, function( data ) {
            $( ".form-group" ).eq(0).after( data);
        });
});

$("#handle").click(function(e){
    var id=$("#req_id").val();
    var sid=$('#ses_id').val();
    var variables='id='+id+',sid='+sid;
    $.post("ajax/handle_request.php",
    {
        id: id,
        sid: sid
    },
    function(data){
        alert(data);
        window.location.href='index.php?islem=talepler';
    });
});

$("#filterCar").keyup(function () {
    var valthis = $(this).val().toLowerCase();

    $("select#car_id>option").each(function () {
        var text = $(this).text().toLowerCase();
        if (text.indexOf(valthis) !== -1) {
            $(this).show(); $(this).prop("selected",true);
        }
        else {
            $(this).hide();
        }
    });
});
function myFunction() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("table_filter");
    filter = input.value.toUpperCase();
    table = document.getElementById("talepler");
    tr = table.getElementsByTagName("tr");
    if(filter==""){
        for (i = 1; i < tr.length; i++) {
            tr[i].style.display="";
        }
    }
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td");
      var find=false;
      for(k=0;k<td.length;k++)
      {
        val=td[k];
        if (val) {
            if (val.innerHTML.toUpperCase().indexOf(filter) > -1) {
             find=true;
             break;
            } else {
                find=false;
            }
          } 
      }
      if(!find){
      tr[i].style.display = "none";
      }
     
    }
  }
  $( "#filter_creator" ).change(function() {
    var deger=$("#filter_creator").val();
    var input, filter, table, tr, td, i;
    filter = deger.toUpperCase();
    table = document.getElementById("talepler");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    if(filter!="ALL"){
    for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      } 
    }
    }
    else{
        for (i = 1; i < tr.length; i++) {
            tr[i].style.display="";
        }
    }
});