<?php
$('#selection-name').on('change', function() {
    var table = $(this).find(':selected').text().toLowerCase();
    if (table !== 'select') {
        $.getJSON('../assets/data/select-data.php?table='+table, function(data){
            $('#item-name').empty();
          if (data !== null) {
            $.each(data, function(key, value){
                $('#item-name').append(new Option(value.text, value.id));
            });
          }

        });
    }
});

?> 