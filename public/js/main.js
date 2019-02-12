$(document).on("click",".removeItem", function(){
    var itemId = $(this).attr("id").replace("remove","");

    $("#itemRow" + itemId).remove();

    var inputRows = $("#inputs > div");
    var inputNames = $("#inputs > div > div > .name_input");
    var numInputs = $("#inputs > div > div > .num_input");
    var descriptions = $("#inputs > div > div > textarea");
    var removeBtns = $("#inputs > div > div > span");

    var i;

    for(i = 0; i < inputRows.length; i++){
        var inputRow = $(inputRows[i]).attr("id").replace("itemRow","")

        if(inputRow > itemId){
            $(inputRows[i]).attr("id","itemRow"+i);

            $(inputNames[i]).attr("id","itemName"+i);
            $(inputNames[i]).attr("name","itemName["+i+"]");

            $(numInputs[i]).attr("id","itemDuration"+i);
            $(numInputs[i]).attr("name","itemDuration["+i+"]");

            $(descriptions[i]).attr("id","itemDescription"+i);
            $(descriptions[i]).attr("name","itemDescription["+i+"]");

            $(removeBtns[i-1]).attr("id","remove"+i);
        }

        if(itemCount > 0){
            itemCount = itemCount - 1;
        }
    }
});

$(document).on("click",".removeNewItem", function(){
    var itemId = $(this).attr("id").replace("remove","");

    $("#newItemRow" + itemId).remove();

    var inputRows = $("#inputs > div");
    var inputNames = $("#inputs > div > div > .new_name_input");
    var numInputs = $("#inputs > div > div > .new_num_input");
    var descriptions = $("#inputs > div > div > .new_textarea");
    var removeBtns = $("#inputs > div > div > .removeNewItem");

    var i;

    for(i = 0; i < inputRows.length; i++){
        var inputRow = $(inputRows[i]).attr("id").replace("itemRow","")

        if(inputRow > itemId){
            $(inputRows[i]).attr("id","newItemRow"+i);

            $(inputNames[i]).attr("id","newItemName"+i);
            $(inputNames[i]).attr("name","newItemName["+i+"]");

            $(numInputs[i]).attr("id","newItemDuration"+i);
            $(numInputs[i]).attr("name","newItemDuration["+i+"]");

            $(descriptions[i]).attr("id","newItemDescription"+i);
            $(descriptions[i]).attr("name","newItemDescription["+i+"]");

            $(removeBtns[i-1]).attr("id","remove"+i);
        }

        if(itemCount > 0){
            itemCount = itemCount - 1;
        }
    }
});

function CreateNotification(message, title, type){
    $.notify(
        {
            message: message,
            title: title
        },
        {
            type: type, 
            position: 'fixed', 
            newest_on_top: true, 
            allow_dismiss: true
        }
    );
}