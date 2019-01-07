(function ($) {
    "use strict";
var globlval = "";

    $.fn.tautocomplete = function (options, callback) {


        // default parameters
        var settings = $.extend({
            width: "500px",
            columns: [],
            hide: [false],
            onchange: null,
            norecord: "No Records Found",
            dataproperty: null,
            regex: "^[a-zA-Z0-9\b]+$",
            data: null,
            placeholder: null,
            theme: "classic",
            ajax: null,
            delay: 100,
            highlight:'word-highlight'
        }, options);

        var cssClass = {
            "default": "adropdown", 
            "classic": "aclassic",
            "white": "awhite"};

        settings.theme = cssClass[settings.theme];
        
        // initialize DOM elements
        var el = {
            ddDiv: $("<div>", { class: settings.theme }),
            ddTable: $("<table></table>", { style: "text-align:center;width:" + settings.width }),
            ddTableCaption: $("<caption>" + settings.norecord + "</caption>"),
            ddTextbox: $("<input type='text' class='form-control' id="+ settings.id + " required>")
        };

        var keys = {
            UP: 38,
            DOWN: 40,
            ENTER: 13,
            TAB: 9,
            BACKSPACE: 8
        };

        var errors = {
            columnNA: "Error: Columns Not Defined",
            dataNA: "Error: Data Not Available"
        };
        
        // plugin properties
        var tautocomplete = {
            id: function () {
                return el.ddTextbox.data("id");
            },
            text: function () {
                return el.ddTextbox.data("text");
            },
            searchdata: function () {
                return el.ddTextbox.val();
            },
            settext: function (text) {
                el.ddTextbox.val(text);
            },
           
            all: function(){
                return selectedData;
            }

        };

        // delay function which listens to the textbox entry
        var delay = (function () {
            var timer = 0;
            return function (callsback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callsback, ms);
            };
        })();

        // key/value containing data of the selcted row
        var selectedData = {};
        var responseData = {};

        var focused = false;

        // check if the textbox is focused.
        if (this.is(':focus')) {
            focused = true;
        }

        // get number of columns
        var cols = settings.columns.length;

        var orginalTextBox = this;


        // create a textbox for input
        this.after(el.ddTextbox);
        el.ddTextbox.attr("autocomplete", "off");
        el.ddTextbox.css("width", this.width + "px"); 
        el.ddTextbox.css("font-size", this.css("font-size"));
        el.ddTextbox.attr("placeholder", settings.placeholder);

        // check for mandatory parameters
        if (settings.columns == "" || settings.columns == null) {
            el.ddTextbox.attr("placeholder", errors.columnNA);
        }
        else if ((settings.data == "" || settings.data == null) && settings.ajax == null) {
            el.ddTextbox.attr("placeholder", errors.dataNA);
        }
        
        // append div after the textbox
        this.after(el.ddDiv);

        // hide the current text box (used for stroing the values)
        this.hide();

        // append table after the new textbox
        el.ddDiv.append(el.ddTable);
        el.ddTable.attr("cellspacing", "0");

        // append table caption
        el.ddTable.append(el.ddTableCaption);

        // create table columns
        var header = "<thead><tr>";
        for (var i = 0; i <= cols - 1; i++) {
            header = header + "<th>" + settings.columns[i] + "</th>"
        }
        header = header + "</thead></tr>"
        el.ddTable.append(header);

        el.ddTable.append("<tr class='selected'><td>"+settings.defaultValueID+"</td><td>"+settings.defaultValueName+"</td><td>3</td></tr>");


        // // assign data fields to the textbox, helpful in case of .net postbacks
        // {
        //     var id = "", text = "";

        //     if (this.val()) {
        //         var val = this.val().split("#$#");
        //         id = val[0];
        //         text = val[1];
        //     }

            el.ddTextbox.attr("data-id", settings.defaultValueID);
            el.ddTextbox.attr("data-text", settings.defaultValueName);
            el.ddTextbox.val(settings.defaultValueName);

        // }

        if (focused) {
            el.ddTextbox.focus();
        }

        // event handlers

        // autocomplete key press
        el.ddTextbox.keyup(function (e) {
            //return if up/down/return key
            if ((e.keyCode < 46 || e.keyCode > 105) && (e.keyCode != keys.BACKSPACE)) {
                e.preventDefault();
                return;
            }
            //delay for 1 second: wait for user to finish typing
            delay(function () {
                processInput();
            }, settings.delay);
        });


        // autocomplete key press
        el.ddTextbox.blur(function (e) {
            //return if up/down/return key
            hideDropDown();
        });


        // process input
        function processInput()
        {
            if (el.ddTextbox.val() == "") {
                    hideDropDown();
                    return;
            }

            // hide no record found message
            el.ddTableCaption.hide();

            el.ddTextbox.addClass("loading");

            if (settings.ajax != null)
            {
                var tempData = null;
                if ($.isFunction(settings.ajax.data)) {
                    tempData = settings.ajax.data.call(this);
                }
                else{
                    tempData = settings.ajax.data;
                }
                // get json data
                $.ajax({
                    type: settings.ajax.type || 'GET',
                    dataType: 'json',
                    contentType: settings.ajax.contentType || 'application/json; charset=utf-8',
                    headers: settings.ajax.headers || { 'Content-Type': 'application/x-www-form-urlencoded' },
                    data: tempData || null,
                    url: settings.ajax.url,
                    success: ajaxData,

                    error: function (xhr, ajaxOptions, thrownError) {

                        el.ddTextbox.removeClass("loading");
                        // alert('Error: ' + xhr.status || ' - ' || thrownError);
                    }
                });
            }
            else if ($.isFunction(settings.data)) {
                var data = settings.data.call(this);
                jsonParser(data);
            }
            else {
                
            }
        }

        // call on Ajax success
        function ajaxData(jsonData)
        {
            if (settings.ajax.success == null || settings.ajax.success == "" || (typeof settings.ajax.success === "undefined"))
            {
                jsonParser(jsonData);
                

            }
            else {
                if ($.isFunction(settings.ajax.success)) {
                    var data = settings.ajax.success.call(this, jsonData);
                    jsonParser(data);

                }
            }
        }

    
        // textbox keypress events (return key, up and down arrow)
        el.ddTextbox.keydown(function (e) {

            var tbody = el.ddTable.find("tbody");
            var selected = tbody.find(".selected");

            if (e.keyCode == keys.ENTER) {
                
                select();
            }
            if (e.keyCode == keys.UP) {
                el.ddTable.find(".selected").removeClass("selected");
                if (selected.prev().length == 0) {
                    tbody.find("tr:last").addClass("selected");
                } else {
                    selected.prev().addClass("selected");
                }
            }
            if (e.keyCode == keys.DOWN) {
                tbody.find(".selected").removeClass("selected");
                if (selected.next().length == 0) {
                    tbody.find("tr:first").addClass("selected");
                } else {
                    el.ddTable.find(".selected").removeClass("selected");
                    selected.next().addClass("selected");
                }
            }
        });

        // row click event
        el.ddTable.delegate("tr", "mousedown", function () {
            el.ddTable.find(".selected").removeClass("selected");
            $(this).addClass("selected");
            select();
        });

        // textbox blur event
       

        function select() {

            var selected = el.ddTable.find("tbody").find(".selected");

            

            el.ddTextbox.data("id", selected.find('td').eq(0).text());
            el.ddTextbox.data("text", selected.find('td').eq(1).text());

            for(var i=0; i < responseData.length; i++)
            {


                // selectedData[settings.columns[i]] = selected.find('td').eq(i).text();

                var obj = responseData[i];
                var pkvalue = "";

                 for (var key in obj) 
                 {
                    if(pkvalue == "")
                    {
                        pkvalue =  key;
                    }

                    if (obj[pkvalue] == selected.find('td').eq(0).text())
                    {
                        selectedData =  obj;
                        break;
                    }

                 }
            }
            
            el.ddTextbox.val(selected.find('td').eq(1).text());
            orginalTextBox.val(selected.find('td').eq(1).text());
            hideDropDown();


            // if(selected.find('td').eq(0).text()=="")
            // {
            //     $('#'+settings.id).val(globlval);
            //     orginalTextBox.val(globlval);
            // }else{
            //     globlval = ""
            //     // $('.searchinput').val(globlval);
            // }
            onChange();

            
           
        }

       function onChange()
        {
            // onchange callback function
            if ($.isFunction(settings.onchange)) {
                settings.onchange.call(this);
            }
            else {
                 el.ddTextbox.val();
            }
        }

        function hideDropDown() {
            el.ddTable.hide();
            el.ddTextbox.removeClass("inputfocus");
            el.ddDiv.removeClass("highlight");
            el.ddTableCaption.hide();
        }

        function showDropDown() {

            var cssTop = (el.ddTextbox.height() + 50) + "px 1px 0px 1px";
            var cssBottom = "1px 1px " + (el.ddTextbox.height() + 20) + "px 1px";

            // reset div top, left and margin
            el.ddDiv.css("top", "0px");
            el.ddDiv.css("left", "0px");
            el.ddTable.css("margin", cssTop);

            el.ddTextbox.addClass("inputfocus");
            el.ddDiv.addClass("highlight");
            el.ddTable.show();

            // adjust div top according to the visibility
            if (!isDivHeightVisible(el.ddDiv)) {
                el.ddDiv.css("top", -1 * (el.ddTable.height()) + "px");
                el.ddTable.css("margin", cssBottom);
                if (!isDivHeightVisible(el.ddDiv)) {
                    el.ddDiv.css("top", "0px");
                    el.ddTable.css("margin", cssTop);
                    $('html, body').animate({
                        scrollTop: (el.ddDiv.offset().top - 60)
                    }, 250);
                }
            }
            // adjust div left according to the visibility
            if (!isDivWidthVisible(el.ddDiv)) {
                el.ddDiv.css("left", "-" + (el.ddTable.width() - el.ddTextbox.width() - 20) + "px");
            }
        }
        function jsonParser(jsonData) {
            try{
                el.ddTextbox.removeClass("loading");

                // remove all rows from the table
                el.ddTable.find("tbody").find("tr").remove();


                el.ddTextbox.data("id", "");
                el.ddTextbox.data("text", "");



                // regular expression for word highlight
                var re = null;
                if(settings.highlight != null){
                    var highlight = true;
                    var re = new RegExp(el.ddTextbox.val(),"gi");
                }else{
                    el.ddTextbox.val();
                }

                var i = 0, j = 0;
                var row = null, cell = null;
                if (jsonData != null) {
                    responseData =  jsonData;

                    for (i = 0; i < jsonData.length; i++) {

                        // display only 15 rows of data
                        if (i >= 15)
                            continue;

                        var obj = jsonData[i];
                        row = "";
                        j = 0;

                        for (var key in obj) {

                            // return on column count
                            if (j <= cols) {
                                cell = obj[key] + "";

                                if(highlight){
                                    cell = cell.replace(re,"<span class='" + settings.highlight + "'>$&</span>");
                                }
                                row = row + "<td>" + cell + "</td>";
                            }
                            else {
                                continue;
                            }
                            j++;
                        }
                        // append row to the table
                        el.ddTable.append("<tr>" + row + "</tr>");
                    }
                }
                // show no records exists
                if (i == 0)
                    el.ddTableCaption.show();

                // hide columns
                for(var i=0; (i< settings.hide.length) && (i< cols) ; i++)
                {
                    if(!settings.hide[i])
                        el.ddTable.find('td:nth-child('+ (i+1) +')').hide();
                }
                if(jsonData.length==1){
                el.ddTable.find("tbody").find("tr:first").addClass('selected');
            }
                showDropDown();

            }
            catch (e)
            {
                // alert("Error: " + e);
            }
        }
        return tautocomplete;
    };
}(jQuery));

function isDivHeightVisible(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
      && (elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

function isDivWidthVisible(elem) {
    var docViewLeft = $(window).scrollLeft();
    var docViewRight = docViewLeft + $(window).width();

    var elemLeft = $(elem).offset().left;
    var elemRight = elemLeft + $(elem).width();

    return ((elemRight >= docViewLeft) && (elemLeft <= docViewRight)
      && (elemRight <= docViewRight) && (elemLeft >= docViewLeft));
}