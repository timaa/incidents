/**
 * Created by taipov on 16.10.2015.
 */
$(document).ready(function(){
    $("#search-member").autocomplete({
        source: function(request, response){
            // организуем кроссдоменный запрос
            $.ajax({
                url: "/backend/web/index.php?r=assigned-to-catalog/search-member",
                // параметры запроса, передаваемые на сервер (последний - подстрока для поиска):
                data:{
                    featureClass: "P",
                    style: "full",
                    maxRows: 5,
                    term: request.term
                },
                // обработка успешного выполнения запроса
                success: function(data){
                    response($.map(data, function(item){
                        return{
                            label: item.fio,
                            value: item.fio,
                            item :item
                        }
                    }));
                }
            });
        },
        select: function(event, ui) {
            $(".users-form").show();
            fillForm(ui.item.item);
            //fillBlock(ui.item.item);
        },
        minLength: 2
    });

    function fillForm(data)
    {
        $("#users-id").val(data.id);
        $("#users-fio").val(data.fio);
        $("#users-mobile_number").val(data.mobile_number);
        $("#users-email").val(data.email);
        $("#users-send_sms").prop("checked", data.send_sms);
        $("#users-send_email").prop("checked", data.send_email);
        console.log($("#users-assigned_to_id").val());

    }
});