var LapanaWidget = {

    baseURL: '/widget/',    //'http://lapana.ru/widget/',

    init: function (params) {

        var url = this.baseURL + 'index';

        if(params.id != undefined) {
            //ajax();
            var r = new XMLHttpRequest();
            r.open('GET', url, true);
            r.onreadystatechange = function () {
                if (r.readyState != 4 || r.status != 200) return;
                //console.log(r.responseText);
                document.getElementById(params.id).innerHTML = r.responseText;
            };
            //r.send("a=1&b=2&c=3");
            r.send("");

        } else {
            alert('Идентификатор контейнера для загрузки виджета Lapana не указан');
        }

    },

    slideUp: function () {

    },

    slideDown: function () {

    },

    addToCart: function (id) {

    }
};