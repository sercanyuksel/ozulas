
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
$("#close").click(function(e){
    var id=$("#req_id").val();
    var sid=$('#ses_id').val();
    var variables='id='+id+',sid='+sid;
    $.post("ajax/end_request.php",
    {
        id: id,
        sid: sid
    },
    function(data){
        alert(data);
        window.location.href='index.php?islem=talepler';
    });
});
function myFunction() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("table_filter");
    filter = input.value.toUpperCase();
    table = document.getElementById("kazalar");
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
$("#filter_creator").change(function() {
   
    var deger=$("#filter_creator").val();
    var input, filter, table, tr, td, i;
    filter = deger.toUpperCase();
    table = document.getElementById("kazalar");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    if(filter!="ALL"){
    for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[7];
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



function confirmation() {
    return confirm('Talep Silinecek!Emin Misiniz?');
  }
  $("#filter_date").click(function(e){
    // $("#filter_date").text("Kaldır");
     var s_date=$("#s_date").val();
     var e_date=$("#e_date").val();
    
     $.get("../admin/ajax/filter_date.php?s_date="+s_date+"&e_date="+e_date, function( data ) {
         console.log(data);
             $( "table#talepler tbody" ).html(data);
         });
 });
 $("#filter_date1").click(function(e){
    // $("#filter_date").text("Kaldır");
     var s_date=$("#s_date").val();
     var e_date=$("#e_date").val();
    
     $.get("../admin/ajax/filter_date_closed.php?s_date="+s_date+"&e_date="+e_date, function( data ) {
         console.log(data);
             $( "table#talepler tbody" ).html(data);
         });
 });

 $.fn.sortOptions = function(){
    $(this).each(function(){
        var op = $(this).children("option");
        op.sort(function(a, b) {
            return a.text > b.text ? 1 : -1;
        })
        return $(this).empty().append(op);
    });
}
$("#car_id").sortOptions();