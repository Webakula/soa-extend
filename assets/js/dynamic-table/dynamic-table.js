$(function () {
     function changeName() {
         $('table[data-element="wa-table"]').each(function(ti,ei){
                 $(ei).find('tbody>tr').each(function(i,e){
                    $(e).find('input, select, textarea').each(function(i1,e1){
                        var name = $(e1).attr('name');
                        name = name.replace(/\[\d*\]|\[]/, ('['+i+']'));
                        $(e1).attr('name',name);
                    });
                });
         });
    };
    $('table[data-element="wa-table"]').each(function(i,e){
        dragula([$(e).find('tbody')[0]]).on('drop', function (el) {
            changeName();
          })
    });
    
    
    $('.wa-table-add').click(function () {
        var $tr = $('.initial-empty-row').clone();
        $tr.find('input, select').removeAttr('disabled');
        $tr.removeAttr('class').show();
        var $table = $(this).data('name');
        $('table[data-name="' + $table + '"]').append($tr);
        changeName();
    });
    $('body').on('click', '.wa-table-remove-row', function () {
        $(this).parents('tr').remove();
        changeName();
    });
    changeName();
});