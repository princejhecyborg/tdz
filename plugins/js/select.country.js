jQuery.fn.selectCountry = function(option){
    var defaults = {
        cityName: 'city_id',
        cityClass: '',
        cityId: 'city_id',
        defaultCity: '.defaultCity',
        city: [],
        appendWhere: $(this).parent('').find('.cityArea'),
        countryElement: '',
        style: '',
        callBack: function(e){

        }
    };
    // merge
    var options = $.extend({}, defaults, option);
    var city = options.city;
    var defaultCity = options.defaultCity;
    var apEl = options.appendWhere;
    var country = options.countryElement ? options.countryElement : $(this);
    var dCity;

    if(Object.keys(city).length != 0){
        var cClass = options.cityClass ? options.cityClass : options.cityName + ' required';

        if(country.val()){
            var firstCountry = city[country.val()];
            if(apEl.find(defaultCity).length != -1){
                dCity = apEl.find(defaultCity).html();
            }

            var el = $(this).cityElement({
                cityName: options.cityName,
                cityClass: cClass,
                cityId: options.cityId,
                firstCountry: firstCountry,
                defaultCity: dCity,
                style: options.style
            });
            apEl.html(el);
        }

        country
            .unbind('change')
            .live('change', function(e){
                var firstCountry = city[$(this).val()];

                el = $(this).cityElement({
                    cityName: options.cityName,
                    cityClass: cClass,
                    cityId: options.cityId,
                    firstCountry: firstCountry,
                    style: options.style
                });

                if(!firstCountry){
                    el = '';
                }

                apEl.html(el);
            });
    }

    options.callBack();
};

jQuery.fn.cityElement = function(option){
    var defaults = {
        cityName: 'city_id',
        cityClass: '',
        cityId: 'city_id',
        defaultCity: '',
        firstCountry: [],
        style: ''
    };
    // merge
    var options = $.extend({}, defaults, option);
    var firstCountry = options.firstCountry;
    var cClass = options.cityClass ? options.cityClass : options.cityName + ' required';

    var el = '';

    if(Object.keys(firstCountry).length != 0){
        el += '<select name="' + options.cityName + '" class="' + cClass + '" id="' + options.cityId + '" ';
        el += options.style ? 'style="' + options.style + '"' : '';
        el += '>' + "\r\n";

        var ref = 0;
        for(var this_id in firstCountry){
            var fc = firstCountry[this_id];
            for(var city_id in fc){
                el += "\t" + '<option value="' + city_id + '"';
                if(options.defaultCity){
                    el += options.defaultCity == city_id ? ' selected="selected"' : '';
                }
                else{
                    el += ref == 0 ? ' selected="selected"' : '';
                }
                el += '>' + fc[city_id] + '</option>' + "\r\n";
            }
            ref++;
        }
        el += '</select>' + "\r\n";
    }

    return el;
};