<div class="header-bg">
    <div class="banner-wrapper wow fadeInUp " data-wow-delay="0.2s">
        <h1>NYC’s Premier Source For NO FEE Rentals</h1>
        <div class="advce-search-form-wrapper" style="position: relative">
            {!! Form::model(app('request')->all(), ['url' => route('web.indexSearch'), 'method' => 'get', 'id' => 'index-search-from']) !!}
            <div class="search-property">
                <div style="position:relative;">
                    <i class="fas fa-search"></i> {{-- {!! Form::text('neighborhood', null, ['id' => 'neigh', 'placeholder' => 'Enter Neighborhood', 'class' => 'search-fld']) !!}--}}
                    <label class="search-fld">Enter Neighborhood </label>
                </div>
                <div class="price-range-dropdown">
                    Price
                    <div class="price-range-ul">
                        <ul>
                            <li>
                                {!! Form::text('min_price', null, ['class' => 'form-control', 'placeholder' => 'min']) !!}
                            </li>
                            <li>To</li>
                            <li>
                                {!! Form::text('max_price', null, ['class' => 'form-control', 'placeholder' => 'max']) !!}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown-beds">
                    <label id="show-beds"><span class="placeholder-text">Beds</span></label>
                    <div id="advance-search-chkbox" class="beds-dropdown">
                        <div id="advance-search-beds" class="bed-advance-search">
                            {!! bedsDropDown() !!}
                        </div>
                    </div>
                </div>
                {!! Form::button('Search', ['class' => 'search-btn search', 'type' => 'submit']) !!}

            </div>
            <div class="neighborhood-search-advance">
            <div class="neighborhood-search-dropdown let-us-help-modal">
                <div class="modal-body">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#tab-0">Manhattan</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#tab-1">Brooklyn</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#tab-2">Queens</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#tab-3">Bronx</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#tab-4">Staten Island</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="QTo2IvzVJD" name="neighborhood" type="radio" value="Battery Park City">
                                                <label class="custom-control-label" for="QTo2IvzVJD">Battery Park City</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="AOZF7yET8h" name="neighborhood" type="radio" value="Bowery">
                                                <label class="custom-control-label" for="AOZF7yET8h">Bowery</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="2zhZlWCGze" name="neighborhood" type="radio" value="Chinatown">
                                                <label class="custom-control-label" for="2zhZlWCGze">Chinatown</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="9xcM9Di3A1" name="neighborhood" type="radio" value="Civic Center">
                                                <label class="custom-control-label" for="9xcM9Di3A1">Civic Center</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ekhoZEyw24" name="neighborhood" type="radio" value="East Village">
                                                <label class="custom-control-label" for="ekhoZEyw24">East Village</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="0P8PF8wJRM" name="neighborhood" type="radio" value="Financial District">
                                                <label class="custom-control-label" for="0P8PF8wJRM">Financial District</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="mGIhyiiHDR" name="neighborhood" type="radio" value="Greenwich Village">
                                                <label class="custom-control-label" for="mGIhyiiHDR">Greenwich Village</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="Tp2QqmCK4f" name="neighborhood" type="radio" value="Little Italy">
                                                <label class="custom-control-label" for="Tp2QqmCK4f">Little Italy</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="qoYIkorIFL" name="neighborhood" type="radio" value="Lower East Side">
                                                <label class="custom-control-label" for="qoYIkorIFL">Lower East Side</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="qEz4ucrmBC" name="neighborhood" type="radio" value="NoHo">
                                                <label class="custom-control-label" for="qEz4ucrmBC">NoHo</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="6QP5eBuyGE" name="neighborhood" type="radio" value="NoLita">
                                                <label class="custom-control-label" for="6QP5eBuyGE">NoLita</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="OrQZqV96Xr" name="neighborhood" type="radio" value="SoHo">
                                                <label class="custom-control-label" for="OrQZqV96Xr">SoHo</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="t486yggGGq" name="neighborhood" type="radio" value="Tribeca">
                                                <label class="custom-control-label" for="t486yggGGq">Tribeca</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="I0rAyzsf1t" name="neighborhood" type="radio" value="Two Bridges">
                                                <label class="custom-control-label" for="I0rAyzsf1t">Two Bridges</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="J2bU5StoQB" name="neighborhood" type="radio" value="West Village">
                                                <label class="custom-control-label" for="J2bU5StoQB">West Village</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="25k0DR90y2" name="neighborhood" type="radio" value="Chelsea">
                                                <label class="custom-control-label" for="25k0DR90y2">Chelsea</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="5PAtve831q" name="neighborhood" type="radio" value="Flatiron District">
                                                <label class="custom-control-label" for="5PAtve831q">Flatiron District</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="e2nghSX3I7" name="neighborhood" type="radio" value="Garment District">
                                                <label class="custom-control-label" for="e2nghSX3I7">Garment District</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="psNvWuozRW" name="neighborhood" type="radio" value="Gramercy Park">
                                                <label class="custom-control-label" for="psNvWuozRW">Gramercy Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="eD1uZbIomn" name="neighborhood" type="radio" value="Hell's Kitchen">
                                                <label class="custom-control-label" for="eD1uZbIomn">Hell's Kitchen</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="CSbp2sSQeg" name="neighborhood" type="radio" value="Kips Bay">
                                                <label class="custom-control-label" for="CSbp2sSQeg">Kips Bay</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="U1NthLD10E" name="neighborhood" type="radio" value="Koreatown">
                                                <label class="custom-control-label" for="U1NthLD10E">Koreatown</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="1lmUn1xbzK" name="neighborhood" type="radio" value="Midtown East">
                                                <label class="custom-control-label" for="1lmUn1xbzK">Midtown East</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="fvwUUJvMjE" name="neighborhood" type="radio" value="Murray Hill">
                                                <label class="custom-control-label" for="fvwUUJvMjE">Murray Hill</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="Jd72A3EGnE" name="neighborhood" type="radio" value="NoMad">
                                                <label class="custom-control-label" for="Jd72A3EGnE">NoMad</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="xgqMIeB3aj" name="neighborhood" type="radio" value="Stuyvesant Town - Peter Cooper Village">
                                                <label class="custom-control-label" for="xgqMIeB3aj">Stuyvesant Town - Peter Cooper Village</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ckVJOQ7DMS" name="neighborhood" type="radio" value="Theater District">
                                                <label class="custom-control-label" for="ckVJOQ7DMS">Theater District</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="vzQ3oIxetN" name="neighborhood" type="radio" value="Central Harlem">
                                                <label class="custom-control-label" for="vzQ3oIxetN">Central Harlem</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ntgIXncz3L" name="neighborhood" type="radio" value="Central Park">
                                                <label class="custom-control-label" for="ntgIXncz3L">Central Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="19P1ToFkgl" name="neighborhood" type="radio" value="East Harlem">
                                                <label class="custom-control-label" for="19P1ToFkgl">East Harlem</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="v4iUR0b1Th" name="neighborhood" type="radio" value="Inwood">
                                                <label class="custom-control-label" for="v4iUR0b1Th">Inwood</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="6I1zJk5LK6" name="neighborhood" type="radio" value="Upper East Side">
                                                <label class="custom-control-label" for="6I1zJk5LK6">Upper East Side</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="zNpCa1I1jO" name="neighborhood" type="radio" value="Upper West Side">
                                                <label class="custom-control-label" for="zNpCa1I1jO">Upper West Side</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="s2Cgb7iiJZ" name="neighborhood" type="radio" value="Washington Heights">
                                                <label class="custom-control-label" for="s2Cgb7iiJZ">Washington Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="JdtpTlIkZD" name="neighborhood" type="radio" value="West Harlem">
                                                <label class="custom-control-label" for="JdtpTlIkZD">West Harlem</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="Gr9ITAVqua" name="neighborhood" type="radio" value="Randalls-Wards Island">
                                                <label class="custom-control-label" for="Gr9ITAVqua">Randalls-Wards Island</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="JU8OkjvKMq" name="neighborhood" type="radio" value="Roosevelt Island">
                                                <label class="custom-control-label" for="JU8OkjvKMq">Roosevelt Island</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="7WFW7x3bDb" name="neighborhood" type="radio" value="Battery Park">
                                                <label class="custom-control-label" for="7WFW7x3bDb">Battery Park</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab-1">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="vg58PzNIiX" name="neighborhood" type="radio" value="Bedford-Stuyvesant">
                                                <label class="custom-control-label" for="vg58PzNIiX">Bedford-Stuyvesant</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="f44rRbGrE3" name="neighborhood" type="radio" value="Bushwick">
                                                <label class="custom-control-label" for="f44rRbGrE3">Bushwick</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="OSDe2seqJP" name="neighborhood" type="radio" value="Greenpoint">
                                                <label class="custom-control-label" for="OSDe2seqJP">Greenpoint</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="fifQhk4L9D" name="neighborhood" type="radio" value="Williamsburg">
                                                <label class="custom-control-label" for="fifQhk4L9D">Williamsburg</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="yJf5vVaJK3" name="neighborhood" type="radio" value="Boerum Hill">
                                                <label class="custom-control-label" for="yJf5vVaJK3">Boerum Hill</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="7yUxXS2WK5" name="neighborhood" type="radio" value="Carroll Gardens">
                                                <label class="custom-control-label" for="7yUxXS2WK5">Carroll Gardens</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="rxzD2L3CDC" name="neighborhood" type="radio" value="Cobble Hill">
                                                <label class="custom-control-label" for="rxzD2L3CDC">Cobble Hill</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="TRdMoAvUnj" name="neighborhood" type="radio" value="Gowanus">
                                                <label class="custom-control-label" for="TRdMoAvUnj">Gowanus</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="6dAu0EhYPb" name="neighborhood" type="radio" value="Greenwood Heights">
                                                <label class="custom-control-label" for="6dAu0EhYPb">Greenwood Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="5V1YqAlQ0t" name="neighborhood" type="radio" value="Park Slope">
                                                <label class="custom-control-label" for="5V1YqAlQ0t">Park Slope</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="22ppJ3SGUe" name="neighborhood" type="radio" value="Prospect Park">
                                                <label class="custom-control-label" for="22ppJ3SGUe">Prospect Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="U1WaB2nPkY" name="neighborhood" type="radio" value="Red Hook">
                                                <label class="custom-control-label" for="U1WaB2nPkY">Red Hook</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="fruWtAzsF6" name="neighborhood" type="radio" value="Sunset Park">
                                                <label class="custom-control-label" for="fruWtAzsF6">Sunset Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="5DLjKIKOQh" name="neighborhood" type="radio" value="Windsor Terrace">
                                                <label class="custom-control-label" for="5DLjKIKOQh">Windsor Terrace</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="KzhLnTaNW9" name="neighborhood" type="radio" value="Crown Heights">
                                                <label class="custom-control-label" for="KzhLnTaNW9">Crown Heights</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="V5NwPjB2RA" name="neighborhood" type="radio" value="East Flatbush">
                                                <label class="custom-control-label" for="V5NwPjB2RA">East Flatbush</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="pO7m4FBlfo" name="neighborhood" type="radio" value="Flatbush">
                                                <label class="custom-control-label" for="pO7m4FBlfo">Flatbush</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="va55znJm6f" name="neighborhood" type="radio" value="Kensington">
                                                <label class="custom-control-label" for="va55znJm6f">Kensington</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="HGqypqcYXS" name="neighborhood" type="radio" value="Midwood">
                                                <label class="custom-control-label" for="HGqypqcYXS">Midwood</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="aDBhpYN8se" name="neighborhood" type="radio" value="Ocean Hill">
                                                <label class="custom-control-label" for="aDBhpYN8se">Ocean Hill</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ZQjnyCAZT1" name="neighborhood" type="radio" value="Brooklyn Heights">
                                                <label class="custom-control-label" for="ZQjnyCAZT1">Brooklyn Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="Ufol3hb6K2" name="neighborhood" type="radio" value="Brooklyn Navy Yard">
                                                <label class="custom-control-label" for="Ufol3hb6K2">Brooklyn Navy Yard</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="kVbM0sfrwQ" name="neighborhood" type="radio" value="Clinton Hill">
                                                <label class="custom-control-label" for="kVbM0sfrwQ">Clinton Hill</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ZA7DhG3BDx" name="neighborhood" type="radio" value="DUMBO">
                                                <label class="custom-control-label" for="ZA7DhG3BDx">DUMBO</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="doTjDgsrOb" name="neighborhood" type="radio" value="Downtown Brooklyn">
                                                <label class="custom-control-label" for="doTjDgsrOb">Downtown Brooklyn</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="umsvjz3tIh" name="neighborhood" type="radio" value="Fort Greene">
                                                <label class="custom-control-label" for="umsvjz3tIh">Fort Greene</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="FdYtI9qM4V" name="neighborhood" type="radio" value="Prospect Heights">
                                                <label class="custom-control-label" for="FdYtI9qM4V">Prospect Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="M1cTi7xSBk" name="neighborhood" type="radio" value="Vinegar Hill">
                                                <label class="custom-control-label" for="M1cTi7xSBk">Vinegar Hill</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="R7uQGcG8hH" name="neighborhood" type="radio" value="Bath Beach">
                                                <label class="custom-control-label" for="R7uQGcG8hH">Bath Beach</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="k0SQCqhHZU" name="neighborhood" type="radio" value="Bay Ridge">
                                                <label class="custom-control-label" for="k0SQCqhHZU">Bay Ridge</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="QdRx4J9Qod" name="neighborhood" type="radio" value="Bensonhurst">
                                                <label class="custom-control-label" for="QdRx4J9Qod">Bensonhurst</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="4g7LVqFPhN" name="neighborhood" type="radio" value="Borough Park">
                                                <label class="custom-control-label" for="4g7LVqFPhN">Borough Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="BD68KqFVA4" name="neighborhood" type="radio" value="Dyker Heights">
                                                <label class="custom-control-label" for="BD68KqFVA4">Dyker Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="xY4NsKb36U" name="neighborhood" type="radio" value="Mapleton">
                                                <label class="custom-control-label" for="xY4NsKb36U">Mapleton</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="xbsnG56FEH" name="neighborhood" type="radio" value="Brighton Beach">
                                                <label class="custom-control-label" for="xbsnG56FEH">Brighton Beach</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="lVFSBw5rKS" name="neighborhood" type="radio" value="Coney Island">
                                                <label class="custom-control-label" for="lVFSBw5rKS">Coney Island</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="gESHVw4H62" name="neighborhood" type="radio" value="Gravesend">
                                                <label class="custom-control-label" for="gESHVw4H62">Gravesend</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="GIFXXJcXG2" name="neighborhood" type="radio" value="Sheepshead Bay">
                                                <label class="custom-control-label" for="GIFXXJcXG2">Sheepshead Bay</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="KvMopGdxPN" name="neighborhood" type="radio" value="Brownsville">
                                                <label class="custom-control-label" for="KvMopGdxPN">Brownsville</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="AiAEhGrL5H" name="neighborhood" type="radio" value="Canarsie">
                                                <label class="custom-control-label" for="AiAEhGrL5H">Canarsie</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="rK4RKHvZow" name="neighborhood" type="radio" value="Cypress Hills">
                                                <label class="custom-control-label" for="rK4RKHvZow">Cypress Hills</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="undHmriviw" name="neighborhood" type="radio" value="East New York">
                                                <label class="custom-control-label" for="undHmriviw">East New York</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="GEMi4pWucl" name="neighborhood" type="radio" value="Bergen Beach">
                                                <label class="custom-control-label" for="GEMi4pWucl">Bergen Beach</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="u6fsxEaWd4" name="neighborhood" type="radio" value="Flatlands">
                                                <label class="custom-control-label" for="u6fsxEaWd4">Flatlands</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ZFIdytNWSz" name="neighborhood" type="radio" value="Floyd Bennett Airfield">
                                                <label class="custom-control-label" for="ZFIdytNWSz">Floyd Bennett Airfield</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="0mBcGw8Kjb" name="neighborhood" type="radio" value="Marine Park">
                                                <label class="custom-control-label" for="0mBcGw8Kjb">Marine Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="Zh9UATq4J7" name="neighborhood" type="radio" value="Mill Basin">
                                                <label class="custom-control-label" for="Zh9UATq4J7">Mill Basin</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="bNBSOaIv45" name="neighborhood" type="radio" value="Astoria">
                                                <label class="custom-control-label" for="bNBSOaIv45">Astoria</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="nGFnr38smI" name="neighborhood" type="radio" value="Corona">
                                                <label class="custom-control-label" for="nGFnr38smI">Corona</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="PdsXyfDwvG" name="neighborhood" type="radio" value="East Elmhurst">
                                                <label class="custom-control-label" for="PdsXyfDwvG">East Elmhurst</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="wxq57kDhVD" name="neighborhood" type="radio" value="Elmhurst">
                                                <label class="custom-control-label" for="wxq57kDhVD">Elmhurst</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="EBua5DGUPO" name="neighborhood" type="radio" value="Forest Hills">
                                                <label class="custom-control-label" for="EBua5DGUPO">Forest Hills</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="nyJEMyGepm" name="neighborhood" type="radio" value="Glendale">
                                                <label class="custom-control-label" for="nyJEMyGepm">Glendale</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="iULFty1VwR" name="neighborhood" type="radio" value="Jackson Heights">
                                                <label class="custom-control-label" for="iULFty1VwR">Jackson Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="voj7yhZWWb" name="neighborhood" type="radio" value="Long Island City">
                                                <label class="custom-control-label" for="voj7yhZWWb">Long Island City</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="Urssg1tvgT" name="neighborhood" type="radio" value="Maspeth">
                                                <label class="custom-control-label" for="Urssg1tvgT">Maspeth</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="9qBrvsAaCp" name="neighborhood" type="radio" value="Middle Village">
                                                <label class="custom-control-label" for="9qBrvsAaCp">Middle Village</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="Br8E0I5CED" name="neighborhood" type="radio" value="Rego Park">
                                                <label class="custom-control-label" for="Br8E0I5CED">Rego Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="b37Clxs01c" name="neighborhood" type="radio" value="Ridgewood">
                                                <label class="custom-control-label" for="b37Clxs01c">Ridgewood</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="AtuoVBrADQ" name="neighborhood" type="radio" value="Sunnyside">
                                                <label class="custom-control-label" for="AtuoVBrADQ">Sunnyside</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ZBMRRnsZnw" name="neighborhood" type="radio" value="Woodside">
                                                <label class="custom-control-label" for="ZBMRRnsZnw">Woodside</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="OK3xvOBlor" name="neighborhood" type="radio" value="Auburndale">
                                                <label class="custom-control-label" for="OK3xvOBlor">Auburndale</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="qCnOi6JfnL" name="neighborhood" type="radio" value="Bayside">
                                                <label class="custom-control-label" for="qCnOi6JfnL">Bayside</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="X9X7uXyT1l" name="neighborhood" type="radio" value="College Point">
                                                <label class="custom-control-label" for="X9X7uXyT1l">College Point</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="f74L2XZX5l" name="neighborhood" type="radio" value="Flushing">
                                                <label class="custom-control-label" for="f74L2XZX5l">Flushing</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="gNNenwbmbZ" name="neighborhood" type="radio" value="Flushing Meadows-Corona Park">
                                                <label class="custom-control-label" for="gNNenwbmbZ">Flushing Meadows-Corona Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="PaSuB9AoWG" name="neighborhood" type="radio" value="Fresh Meadows">
                                                <label class="custom-control-label" for="PaSuB9AoWG">Fresh Meadows</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="2TQYFCW5dR" name="neighborhood" type="radio" value="Glen Oaks">
                                                <label class="custom-control-label" for="2TQYFCW5dR">Glen Oaks</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="BmwUYEcCMw" name="neighborhood" type="radio" value="Kew Gardens">
                                                <label class="custom-control-label" for="BmwUYEcCMw">Kew Gardens</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="gftho9ASTz" name="neighborhood" type="radio" value="Kew Gardens Hills">
                                                <label class="custom-control-label" for="gftho9ASTz">Kew Gardens Hills</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="MZGGbRLkXk" name="neighborhood" type="radio" value="Whitestone">
                                                <label class="custom-control-label" for="MZGGbRLkXk">Whitestone</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="3R7m48d3Xs" name="neighborhood" type="radio" value="Briarwood">
                                                <label class="custom-control-label" for="3R7m48d3Xs">Briarwood</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="v0DXVeUSE9" name="neighborhood" type="radio" value="Hollis">
                                                <label class="custom-control-label" for="v0DXVeUSE9">Hollis</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="xuMQYRcKVN" name="neighborhood" type="radio" value="Holliswood">
                                                <label class="custom-control-label" for="xuMQYRcKVN">Holliswood</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="mbbtyTssDB" name="neighborhood" type="radio" value="Jamaica">
                                                <label class="custom-control-label" for="mbbtyTssDB">Jamaica</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="rEy6ubf0Sn" name="neighborhood" type="radio" value="Jamaica Estates">
                                                <label class="custom-control-label" for="rEy6ubf0Sn">Jamaica Estates</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="C7D2ZFMgkm" name="neighborhood" type="radio" value="Jamaica Hills">
                                                <label class="custom-control-label" for="C7D2ZFMgkm">Jamaica Hills</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="DRz9NYaPDk" name="neighborhood" type="radio" value="South Jamaica">
                                                <label class="custom-control-label" for="DRz9NYaPDk">South Jamaica</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="vijX7qJBHs" name="neighborhood" type="radio" value="St. Albans">
                                                <label class="custom-control-label" for="vijX7qJBHs">St. Albans</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="n7LmLjeYbd" name="neighborhood" type="radio" value="Forest Park">
                                                <label class="custom-control-label" for="n7LmLjeYbd">Forest Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="gjURwshEbz" name="neighborhood" type="radio" value="Howard Beach">
                                                <label class="custom-control-label" for="gjURwshEbz">Howard Beach</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ztMjmBfeZS" name="neighborhood" type="radio" value="Ozone Park">
                                                <label class="custom-control-label" for="ztMjmBfeZS">Ozone Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="MqSQ1VK8QP" name="neighborhood" type="radio" value="Richmond Hill">
                                                <label class="custom-control-label" for="MqSQ1VK8QP">Richmond Hill</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="dCP31TYdiP" name="neighborhood" type="radio" value="South Ozone Park">
                                                <label class="custom-control-label" for="dCP31TYdiP">South Ozone Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="jTF0xpkOfD" name="neighborhood" type="radio" value="Woodhaven">
                                                <label class="custom-control-label" for="jTF0xpkOfD">Woodhaven</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="8qnDKuSIcc" name="neighborhood" type="radio" value="Far Rockaway">
                                                <label class="custom-control-label" for="8qnDKuSIcc">Far Rockaway</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ALh3Vy0XA9" name="neighborhood" type="radio" value="Rockaway Beac">
                                                <label class="custom-control-label" for="ALh3Vy0XA9">Rockaway Beac</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="GnhTnRYAqC" name="neighborhood" type="radio" value="Bedford Park">
                                                <label class="custom-control-label" for="GnhTnRYAqC">Bedford Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="8PHSyeqR5G" name="neighborhood" type="radio" value="Belmont">
                                                <label class="custom-control-label" for="8PHSyeqR5G">Belmont</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="WaNMPKPxI1" name="neighborhood" type="radio" value="Bronx Park">
                                                <label class="custom-control-label" for="WaNMPKPxI1">Bronx Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="jbZhRm41ka" name="neighborhood" type="radio" value="Concourse">
                                                <label class="custom-control-label" for="jbZhRm41ka">Concourse</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="8vXxfWGmie" name="neighborhood" type="radio" value="Concourse Village">
                                                <label class="custom-control-label" for="8vXxfWGmie">Concourse Village</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="BK2PZEhSra" name="neighborhood" type="radio" value="East Tremont">
                                                <label class="custom-control-label" for="BK2PZEhSra">East Tremont</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="Em2rWUIZlP" name="neighborhood" type="radio" value="Fordham Heights">
                                                <label class="custom-control-label" for="Em2rWUIZlP">Fordham Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="SXr2mn6QWr" name="neighborhood" type="radio" value="Fordham Manor">
                                                <label class="custom-control-label" for="SXr2mn6QWr">Fordham Manor</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="XWzI6o4YLv" name="neighborhood" type="radio" value="Highbridge">
                                                <label class="custom-control-label" for="XWzI6o4YLv">Highbridge</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="oWjaQ34wIf" name="neighborhood" type="radio" value="Hunts Point">
                                                <label class="custom-control-label" for="oWjaQ34wIf">Hunts Point</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="2aX2iPt3w9" name="neighborhood" type="radio" value="Kingsbridge">
                                                <label class="custom-control-label" for="2aX2iPt3w9">Kingsbridge</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="DCk20vrwsZ" name="neighborhood" type="radio" value="Longwood">
                                                <label class="custom-control-label" for="DCk20vrwsZ">Longwood</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="oxpoYAxZ9N" name="neighborhood" type="radio" value="Marble Hill">
                                                <label class="custom-control-label" for="oxpoYAxZ9N">Marble Hill</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="619owducDA" name="neighborhood" type="radio" value="Morris Heights">
                                                <label class="custom-control-label" for="619owducDA">Morris Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="sy94V05P3l" name="neighborhood" type="radio" value="Morrisania">
                                                <label class="custom-control-label" for="sy94V05P3l">Morrisania</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="OZzoZ5aevv" name="neighborhood" type="radio" value="Mott Haven">
                                                <label class="custom-control-label" for="OZzoZ5aevv">Mott Haven</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="AhMUvL8mtu" name="neighborhood" type="radio" value="Mount Eden">
                                                <label class="custom-control-label" for="AhMUvL8mtu">Mount Eden</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="1cWlREdO7z" name="neighborhood" type="radio" value="Mount Hope">
                                                <label class="custom-control-label" for="1cWlREdO7z">Mount Hope</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="WMJtQEGzUv" name="neighborhood" type="radio" value="Norwood">
                                                <label class="custom-control-label" for="WMJtQEGzUv">Norwood</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="3sLDAVKSYr" name="neighborhood" type="radio" value="Riverdale">
                                                <label class="custom-control-label" for="3sLDAVKSYr">Riverdale</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="tfulpR0mvt" name="neighborhood" type="radio" value="University Heights">
                                                <label class="custom-control-label" for="tfulpR0mvt">University Heights</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="QJF3WQ6TvZ" name="neighborhood" type="radio" value="Van Cortlandt Park">
                                                <label class="custom-control-label" for="QJF3WQ6TvZ">Van Cortlandt Park</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="jV0u0klygL" name="neighborhood" type="radio" value="West Farms">
                                                <label class="custom-control-label" for="jV0u0klygL">West Farms</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="thrwcREB4R" name="neighborhood" type="radio" value="Allerton">
                                                <label class="custom-control-label" for="thrwcREB4R">Allerton</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="woOxn9RXTv" name="neighborhood" type="radio" value="Clason Point">
                                                <label class="custom-control-label" for="woOxn9RXTv">Clason Point</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="84LCbJg5AR" name="neighborhood" type="radio" value="Morris Park">
                                                <label class="custom-control-label" for="84LCbJg5AR">Morris Park</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="WvPKH4rJWb" name="neighborhood" type="radio" value="Parkchester">
                                                <label class="custom-control-label" for="WvPKH4rJWb">Parkchester</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="K0HMIpMhsu" name="neighborhood" type="radio" value="Pelham Bay">
                                                <label class="custom-control-label" for="K0HMIpMhsu">Pelham Bay</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="BgbFD6VwTO" name="neighborhood" type="radio" value="Pelham Parkway">
                                                <label class="custom-control-label" for="BgbFD6VwTO">Pelham Parkway</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="op8eb082cJ" name="neighborhood" type="radio" value="Throgs Neck">
                                                <label class="custom-control-label" for="op8eb082cJ">Throgs Neck</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="LaOkpeaSlt" name="neighborhood" type="radio" value="Unionport">
                                                <label class="custom-control-label" for="LaOkpeaSlt">Unionport</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="iKpuO3nGUQ" name="neighborhood" type="radio" value="Van Nest">
                                                <label class="custom-control-label" for="iKpuO3nGUQ">Van Nest</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="G6dMkFjQlP" name="neighborhood" type="radio" value="Wakefield">
                                                <label class="custom-control-label" for="G6dMkFjQlP">Wakefield</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="pELGTbcCIg" name="neighborhood" type="radio" value="Westchester Village">
                                                <label class="custom-control-label" for="pELGTbcCIg">Westchester Village</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="L53hh3zIwb" name="neighborhood" type="radio" value="Williamsbridge">
                                                <label class="custom-control-label" for="L53hh3zIwb">Williamsbridge</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="MEJknRCRbJ" name="neighborhood" type="radio" value="Woodlawn Height">
                                                <label class="custom-control-label" for="MEJknRCRbJ">Woodlawn Height</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="2lABl6vOiO" name="neighborhood" type="radio" value="East Shore">
                                                <label class="custom-control-label" for="2lABl6vOiO">East Shore</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="oT2kHuVM8c" name="neighborhood" type="radio" value="Mid-Island">
                                                <label class="custom-control-label" for="oT2kHuVM8c">Mid-Island</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="YTePTwCJjK" name="neighborhood" type="radio" value="North Shore">
                                                <label class="custom-control-label" for="YTePTwCJjK">North Shore</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="neighborhood-list">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" id="ixsOQ9rdEY" name="neighborhood" type="radio" value="South Shor">
                                                <label class="custom-control-label" for="ixsOQ9rdEY">South Shor</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <span id="search-error-message"></span> {!! Form::close() !!}
        </div>
        </div>
        <a href="javascript:void(0);" class="advance-search" data-toggle="modal" data-target="#advance-search">+ Advanced Search</a>
    </div>
</div>
{{--Advance Search--}} @include('modals.advance_search')
