$(document).ready(function() {
    $('#formTes').submit(function(e) {
      e.preventDefault();
      var tam= $('#TesisNew')[0].files[0].size;

      var file = $('#TesisNew')[0].files[0];
      
      if (file.type !== 'application/pdf') {
        alert('Solo se permiten archivos PDF');
        return;
      }
      if(tam> 1000000)
         {alert('el archivo pesa mas de 1 MB');
         return;
         }
      
      this.submit();
    });
  });
  

  $(document).ready(function() {
    $('#formTesi').submit(function(e) {
      e.preventDefault();
      var tam= $('#TesisNew1')[0].files[0].size;

      var file = $('#TesisNew1')[0].files[0];
      
      if (file.type !== 'application/pdf') {
        alert('Solo se permiten archivos PDF');
        return;
      }
      if(tam> 1000000)
         {alert('el archivo pesa mas de 1 MB');
         return;
         }
      
      this.submit();
    });
  });
  