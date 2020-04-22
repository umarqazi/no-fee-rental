
<div class="modal fade" id="plan_info">
    <div class="modal-dialog modal-dialog-centered" style="    width: 800px;max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Plans Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 35px;">
                <div class="plans-wrapper">
                    <div class="inner-plans-wrapper" style="display: flex">
                        <div class="current-plans platinum-plan" style="{{ isset($currentPlan) && $currentPlan->plan == BASICPLAN && !$currentPlan->is_cancel ? 'display:none' : '' }}">
                            <h3> Basic </h3>
                            <h2>$40</h2> <small>/Month</small>
                            <div class="text-with-tick-image">
                                <ul>
                                    <p style="text-align: center">Perfect for first-time listers.</p>
                                    <li>20 listing slots</li>
                                    <li>5 featured listing</li>
                                    <li>30 Reposts</li>
                                </ul>
                            </div>
                        </div>
                        <div class="current-plans platinum-plan" style="{{ isset($currentPlan) && $currentPlan->plan == GOLDPLAN && !$currentPlan->is_cancel ? 'display:none' : '' }}">
                            <h3> Gold </h3>
                            <h2>$70</h2> <small>/Month</small>
                            <div class="text-with-tick-image">
                                <ul>
                                    <p style="text-align: center">Get ahead with more client views.</p>
                                    <li>40 listing slots</li>
                                    <li>10 featured listings</li>
                                    <li>60 Reposts</li>
                                    <li>Premier reach to more potential clients.</li>
                                    <li>Featured listing in our weekly news letter</li>
                                </ul>
                            </div>
                        </div>
                        <div class="current-plans platinum-plan" style="{{ isset($currentPlan) && $currentPlan->plan == PLATINUMPLAN && !$currentPlan->is_cancel ? 'display:none' : '' }}">
                            <h3> Platinum </h3>
                            <h2>$100</h2> <small>/Month</small>
                            <div class="text-with-tick-image">
                                <ul>
                                    <p style="text-align: center">Ultimate Visibility</p>
                                    <li>70 listings slots</li>
                                    <li>25 featured listings</li>
                                    <li>100 Reposts</li>
                                    <li>Close more deals than ever before.</li>
                                    <li>Varified client leads based on your expertise</li>
                                    <li>Direct leads from our client questioner form</li>
                                    <li>Featured listing in our weekly news letter</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>