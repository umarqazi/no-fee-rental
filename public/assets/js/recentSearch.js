
$(() => {
    let $body = $('body');
    let queries = JSON.parse(localStorage.getItem('search-queries'));
    let bath = null, bed = null, square_feet_min = null, square_feet_max = null, neighborhood = null, price_min = null, price_max = null, open_house = null;
    let amenities = [];

    $('#baths').find('li').on('click', function() {
        bath = $(this).text();
        bath = bath.replace(/\s/g, '');
    });

    $('#beds').find('li').on('click', function() {
        bed = $(this).text();
        bed = bed.replace(/\s/g, '');
    });

    $('input[name=neighborhoods]').on('keydown', function(e) {
        neighborhood = $('input[name=neighborhoods]').val();
    });

    $body.on('min-price', function(e, res) {
        price_min = res;
    });

    $body.on('max-price', function(e, res) {
        price_max = res;
    });

    $body.on('square-min', function(e, res) {
        square_feet_min = res;
    });

    $body.on('square-max', function(e, res) {
        square_feet_max = res;
    });

    $body.on('submit', '#search', function(e) {
        neighborhood = $(this).find('#neigh').val();
        let searchQuery = {
            baths: bath,
            neighborhood: neighborhood,
            beds: bed,
            price_min: price_min,
            price_max: price_max,
            square_feet_min: square_feet_min,
            square_feet_max: square_feet_max
        };

        let query = [];
        query.push(searchQuery);

        if(!queries) {
            localStorage.setItem('search-queries', JSON.stringify(query));
            return;
        }

        if(queries.length < 5) {
            if(queries.length > 0) {
                queries.push(searchQuery);
                localStorage.setItem('search-queries', JSON.stringify(queries));
            } else {
                localStorage.setItem('search-queries', JSON.stringify(query));
            }
        } else {
            queries.shift();
            queries.push(searchQuery);
            localStorage.setItem('search-queries', JSON.stringify(queries));
        }
    });

    if(queries && queries.length > 0) {
        queries.forEach((v, i) => {
            let url = window.location.origin + `/search?neighborhoods=${v.neighborhood !== null ? v.neighborhood : ''}&beds=${(v.beds !== null) ? v.beds : ''}&baths=${(v.baths !== null) ? v.baths : ''}&priceRange%5Bmin_price%5D=${v.price_min}&priceRange%5Bmax_price%5D=${v.price_max}&priceRange%5Bmin_price_2%5D=${v.square_feet_min}&priceRange%5Bmax_price_2%5D=${v.square_feet_max}`;
            $('.dropDown').prepend(`
                <a href="${url}">
                    <img src="http://localhost:8000/assets/images/gallery-img.jpg" alt="">
                    <span>Nyc ${(v.neighborhood !== null) ? ' - ' + v.neighborhood : ''} ${(v.beds !== null) ? v.beds + ' bed' : ''} ${(v.baths !== null) ? v.baths + ' bath' : ''}</span>
                </a>
             `);
        });
    }
});
