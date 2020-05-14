$(document).ready(function () {
    $('#filterable').hide(); // hide filterable container initially
    $('#sortable').hide(); // hide sortable container initially

    // toggle to show/hide filterable container
    $('button#btnfilters').click(function () {
        if ('#sortable:visible') {
            $('#sortable').hide();
            $('#filterable').toggle();
        } else {
            $('#filterable').toggle();
        }
    });

    // toggle to show/hide sortable container
    $('button#btnsort').click(function () {
        if ('#filterable:visible') {
            $('#filterable').hide();
            $('#sortable').toggle();
        } else {
            $('#sortable').toggle();
        }
    });

    //==============================================================//
    //                          FILTERS                             //
    //==============================================================//

    // initialise variables to store user's filter selection
    var selectedcuisine = [],
        selectedallergy = [],
        selectedbudget = 'no-budget';

    // register changes for cuisine filter
    $('#cuisine-filter').change(function () {
        selectedcuisine = $(this).val();
        console.log('[selected cuisines: ' + selectedcuisine + ']');
        filter();
    });

    // register changes for allergy filter
    $('#allergy-filter').change(function () {
        selectedallergy = $(this).val();
        console.log('[selected allergies: ' + selectedallergy + ']');
        filter();
    });

    // register changes for budget filter
    $('#budget-filter').change(function () {
        selectedbudget = $(this).val();
        console.log('[selected budget: ' + selectedbudget + ']');
        filter();
    });

    $('#searchpostcode').keyup(filter);

    // listen to clear button click
    $('a.ui-input-clear').click(function() {
        filter();
    });

    function filter() {
        var rex = new RegExp($('#searchpostcode').val(), 'i'); // 'i' modifier performs a global, case-insensitive search
        console.log(rex);
        var rows = $('.searchable li');

        rows.hide();

        rows.filter(function () {
            var tester = true;
  
            tester = rex.test($(this).text()); // returns true if it finds a match

            // if there's selected cuisine(s) in the filter
            if (selectedcuisine !== null && selectedcuisine.length > 0) {
                tester = tester && filtercuisine(this, selectedcuisine);
            } else {
                tester;
            }

            // if there's selected allergies in the filter
            if (selectedallergy !== null && selectedallergy.length > 0) {
                tester = tester && filterallergy(this, selectedallergy);
            } else {
                tester;
            }

            // check budget
            if (selectedbudget === 'no-budget') {
                tester;
            } else {
                tester = tester && filterbudget(this, selectedbudget);
            }

            return tester;
        }).show();  
    }

    function filtercuisine(selector, selectedcuisine) {
        var tester = true,
            match = false;
        var classitems = $(selector).attr('class');
        console.log(classitems);

        // check if the row contains specific cuisine in its class tag
        $.each(selectedcuisine, function (index, value) {
            var cuisine = new RegExp('^' + value + '\\s', 'gi');
            console.log('selected cuisine: ' + cuisine);

            let findmatch = cuisine.test(classitems);

            if (findmatch) {
                match = true;
                return false; // if a match is found, stop the loop
            }
        });

        if (match) {
            tester = true; // if the row matches a cuisine selected, show the row
        } else if (selectedcuisine.indexOf('other') > -1) {
            if (/american|british|chinese|indian|italian|japanese|thai/gi.test(classitems)) {
                tester = false; // if the row is one of the above cuisines, it doesn't belong to 'other' cuisine, so hide the row
            } else {
                tester = true; // if 'other' is selected and the row isn't one of the above cuisines, show the row
            }
        } else {
            tester = false; // if no match found and 'other' isn't selected, hide the row
        }

        return tester;
    }

    function filterallergy(selector, selectedallergy) {
        var tester = true,
            match = false;
        var classitems = $(selector).attr('class');
        console.log(classitems);

        $.each(selectedallergy, function (index, value) {
            var allergy = new RegExp('\\s' + value + '\\s', 'gi');

            let findmatch = allergy.test(classitems);
            if (findmatch) {
                match = true;
                return false; // if a match is found, stop the loop
            }
        });

        // if found matched allery, hide the row
        if (match) {
            tester = false;
        }

        return tester;
    }

    function filterbudget(selector, selectedbudget) {
        var tester = true;
        var classitems = $(selector).attr('class');
        console.log(classitems);
        let userbudget = new RegExp('\\s' + selectedbudget + '\\s', 'gi');

        return tester = userbudget.test(classitems);
    }

    //==============================================================//
    //                           SORT BY                            //
    //==============================================================//

    // register changes for sort buttons
    $('input[name="sorting"').change(function () {
        var sortby = $(this).val();
        console.log('[sort by: ' + sortby + ']');
        sortlistview(sortby);
    });

    function sortlistview(sortby) {
        var rows = $('.searchable li');
        console.log(rows);

        if (sortby === 'low-high') {
            rows.sort(function(a, b) {
                var priceA = a.getAttribute('data-sort-price');
                var priceB = b.getAttribute('data-sort-price');
                console.log(priceA + ' / ' + priceB);
                return priceA - priceB; // ascending order
            });
        }

        if (sortby === 'high-low') {
            rows.sort(function(a, b) {
                var priceA = a.getAttribute('data-sort-price');
                var priceB = b.getAttribute('data-sort-price');
                console.log(priceA + ' / ' + priceB);
                return priceB - priceA; // descending order
            });
        }

        var html = "";
        $.each(rows, function(index, value) {
            html += '<li class="' + value.getAttribute('class');
            html += '" data-sort-price="' + value.getAttribute('data-sort-price') + '">';
            html += value.innerHTML;
            html += '</li>';
        });

        $('#sortlist').empty().html(html).listview('refresh');
    }

});