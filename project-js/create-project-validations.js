/**
 * Created by UTOPIA SOFTWARE on 17/02/2017.
 */


function formatCurrency(inputElement){
    console.log("FORMAT CURRNCY");
    $(inputElement).val(kendo.toString(kendo.parseFloat($(inputElement).val()), "n2"));
}

function formatNumber(inputElement){
    console.log("FORMAT NUMBER");
    $(inputElement).val(kendo.toString(kendo.parseFloat($(inputElement).val()), "n3"));
}

