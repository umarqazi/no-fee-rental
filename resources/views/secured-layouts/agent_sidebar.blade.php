<aside>
    <span class="close-menu"><i class="fa fa-times-circle"></i></span>
    {{--Profile With DropDown--}}
    @include('secured-layouts.user_avatar')
    <ul class="main-men">
        <li>
            <a href="{{ route('agent.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="41.938" height="31.938" viewBox="0 0 41.938 31.938">
                    <path d="M40.841,30.877 C40.107,31.589 39.226,31.944 38.196,31.944 L3.742,31.944 C2.712,31.944 1.830,31.589 1.097,30.877 C0.363,30.166 -0.003,29.312 -0.003,28.313 L-0.003,3.627 C-0.003,2.628 0.363,1.774 1.097,1.062 C1.830,0.351 2.712,-0.004 3.742,-0.004 L38.196,-0.004 C39.226,-0.004 40.107,0.351 40.841,1.062 C41.574,1.773 41.941,2.628 41.941,3.627 L41.941,28.313 C41.941,29.312 41.574,30.166 40.841,30.877 ZM38.945,9.435 C38.945,9.238 38.870,9.068 38.722,8.924 C38.574,8.781 38.399,8.709 38.196,8.709 L3.742,8.709 C3.539,8.709 3.363,8.781 3.215,8.924 C3.067,9.068 2.993,9.238 2.993,9.435 L2.993,28.313 C2.993,28.510 3.067,28.680 3.215,28.823 C3.363,28.967 3.539,29.039 3.742,29.039 L38.196,29.039 C38.399,29.039 38.574,28.967 38.722,28.823 C38.870,28.680 38.945,28.510 38.945,28.313 L38.945,9.435 ZM35.200,26.134 L12.730,26.134 C12.527,26.134 12.351,26.063 12.203,25.919 C12.055,25.775 11.981,25.606 11.981,25.409 L11.981,23.956 C11.981,23.760 12.055,23.590 12.203,23.446 C12.351,23.302 12.527,23.231 12.730,23.231 L35.200,23.231 C35.403,23.231 35.578,23.302 35.727,23.446 C35.875,23.590 35.949,23.760 35.949,23.956 L35.949,25.409 C35.949,25.606 35.875,25.775 35.727,25.919 C35.578,26.063 35.403,26.134 35.200,26.134 ZM35.200,20.326 L12.730,20.326 C12.527,20.326 12.351,20.254 12.203,20.111 C12.055,19.967 11.981,19.797 11.981,19.600 L11.981,18.148 C11.981,17.951 12.055,17.781 12.203,17.637 C12.351,17.494 12.527,17.422 12.730,17.422 L35.200,17.422 C35.403,17.422 35.578,17.494 35.727,17.637 C35.875,17.781 35.949,17.951 35.949,18.148 L35.949,19.600 C35.949,19.797 35.875,19.967 35.727,20.111 C35.578,20.254 35.403,20.326 35.200,20.326 ZM35.200,14.518 L12.730,14.518 C12.527,14.518 12.351,14.445 12.203,14.302 C12.055,14.159 11.981,13.988 11.981,13.792 L11.981,12.339 C11.981,12.142 12.055,11.973 12.203,11.829 C12.351,11.685 12.527,11.613 12.730,11.613 L35.200,11.613 C35.403,11.613 35.578,11.685 35.727,11.829 C35.875,11.972 35.949,12.142 35.949,12.339 L35.949,13.792 C35.949,13.988 35.875,14.158 35.727,14.302 C35.579,14.446 35.403,14.518 35.200,14.518 ZM8.236,26.134 L6.738,26.134 C6.535,26.134 6.360,26.063 6.211,25.919 C6.063,25.775 5.989,25.606 5.989,25.409 L5.989,23.956 C5.989,23.760 6.063,23.590 6.211,23.446 C6.360,23.302 6.535,23.231 6.738,23.231 L8.236,23.231 C8.439,23.231 8.614,23.303 8.763,23.446 C8.911,23.590 8.985,23.760 8.985,23.956 L8.985,25.409 C8.985,25.606 8.911,25.775 8.763,25.919 C8.614,26.063 8.439,26.134 8.236,26.134 ZM8.236,20.326 L6.738,20.326 C6.535,20.326 6.360,20.254 6.211,20.111 C6.063,19.967 5.989,19.797 5.989,19.600 L5.989,18.148 C5.989,17.951 6.063,17.781 6.211,17.637 C6.360,17.494 6.535,17.422 6.738,17.422 L8.236,17.422 C8.439,17.422 8.614,17.494 8.763,17.637 C8.911,17.781 8.985,17.951 8.985,18.148 L8.985,19.600 C8.985,19.797 8.911,19.967 8.763,20.111 C8.614,20.254 8.439,20.326 8.236,20.326 ZM8.236,14.518 L6.738,14.518 C6.535,14.518 6.360,14.445 6.211,14.302 C6.063,14.158 5.989,13.988 5.989,13.792 L5.989,12.339 C5.989,12.142 6.063,11.973 6.211,11.829 C6.360,11.685 6.535,11.613 6.738,11.613 L8.236,11.613 C8.439,11.613 8.614,11.685 8.763,11.829 C8.911,11.972 8.985,12.142 8.985,12.339 L8.985,13.792 C8.985,13.988 8.911,14.158 8.763,14.302 C8.614,14.446 8.439,14.518 8.236,14.518 Z" class="cls-1"/>
                </svg>
                Listing
            </a>
        </li>
        <li>
            <a href="{{ route('agent.conversations') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="42" height="28.406" viewBox="0 0 42 28.406">
                    <path d="M27.499,14.433 L41.995,2.497 L41.995,26.092 L27.499,14.433 ZM0.957,0.788 C1.497,0.308 2.224,0.013 3.024,0.013 L38.975,0.013 C39.781,0.013 40.507,0.306 41.046,0.782 L20.999,17.047 L0.957,0.788 ZM0.004,26.092 L0.004,2.506 L14.500,14.433 L0.004,26.092 ZM20.999,19.887 L26.195,15.582 L41.040,27.633 C40.501,28.110 39.775,28.404 38.975,28.404 L3.024,28.404 C2.220,28.404 1.492,28.110 0.951,27.633 L15.805,15.582 L20.999,19.887 Z" class="cls-1"/>
                </svg>
                Messages
            </a>
        </li>
        <li>
            <a href="{{ route('agent.viewReviews') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="33" height="33" viewBox="0 0 33 33">
                    <path d="M32.287,14.949 C32.937,14.288 33.166,13.318 32.886,12.417 C32.605,11.516 31.873,10.873 30.974,10.736 L22.980,9.525 C22.640,9.473 22.346,9.250 22.194,8.928 L18.620,1.373 C18.219,0.525 17.404,-0.003 16.497,-0.003 C15.590,-0.003 14.775,0.525 14.374,1.373 L10.800,8.929 C10.648,9.251 10.353,9.474 10.012,9.525 L2.019,10.737 C1.120,10.873 0.388,11.517 0.107,12.418 C-0.173,13.319 0.056,14.289 0.706,14.949 L6.489,20.830 C6.736,21.081 6.849,21.442 6.791,21.795 L5.427,30.099 C5.306,30.830 5.490,31.541 5.943,32.101 C6.648,32.975 7.878,33.241 8.862,32.702 L16.010,28.781 C16.309,28.618 16.685,28.619 16.983,28.781 L24.133,32.702 C24.480,32.893 24.851,32.989 25.234,32.989 C25.933,32.989 26.595,32.665 27.051,32.101 C27.505,31.541 27.688,30.828 27.567,30.099 L26.202,21.795 C26.144,21.442 26.257,21.081 26.503,20.830 L32.287,14.949 Z" class="cls-1"/>
                </svg>
                Reviews
            </a>
        </li>
        <li>
            <a href="{{ route('agent.team') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="41" height="34" viewBox="0 0 41 34">
                    <path d="M24.742,5.833 C26.638,7.004 27.967,8.987 28.210,11.288 C28.983,11.644 29.841,11.849 30.750,11.849 C34.072,11.849 36.764,9.195 36.764,5.923 C36.764,2.649 34.072,-0.004 30.750,-0.004 C27.460,-0.003 24.792,2.602 24.742,5.833 ZM20.803,17.967 C24.124,17.967 26.816,15.314 26.816,12.041 C26.816,8.768 24.124,6.115 20.803,6.115 C17.482,6.115 14.788,8.768 14.788,12.041 C14.788,15.314 17.482,17.967 20.803,17.967 ZM23.353,18.371 L18.251,18.371 C14.005,18.371 10.552,21.776 10.552,25.960 L10.552,32.110 L10.567,32.206 L10.997,32.339 C15.049,33.586 18.569,34.003 21.466,34.003 C27.125,34.003 30.405,32.412 30.607,32.311 L31.009,32.110 L31.052,32.110 L31.052,25.960 C31.052,21.776 27.598,18.371 23.353,18.371 ZM33.302,12.253 L28.239,12.253 C28.184,14.250 27.320,16.047 25.952,17.340 C29.726,18.446 32.486,21.895 32.486,25.969 L32.486,27.864 C37.485,27.683 40.367,26.287 40.556,26.193 L40.958,25.992 L41.001,25.992 L41.001,19.841 C41.001,15.657 37.547,12.253 33.302,12.253 ZM10.251,11.849 C11.428,11.849 12.522,11.511 13.449,10.934 C13.744,9.040 14.774,7.384 16.247,6.257 C16.253,6.146 16.263,6.035 16.263,5.924 C16.263,2.650 13.571,-0.003 10.251,-0.003 C6.929,-0.003 4.238,2.650 4.238,5.924 C4.238,9.196 6.929,11.849 10.251,11.849 ZM15.651,17.340 C14.290,16.054 13.429,14.266 13.366,12.281 C13.178,12.268 12.992,12.253 12.801,12.253 L7.699,12.253 C3.453,12.253 -0.000,15.657 -0.000,19.841 L-0.000,25.992 L0.015,26.087 L0.445,26.220 C3.696,27.221 6.596,27.681 9.116,27.826 L9.116,25.969 C9.117,21.895 11.877,18.447 15.651,17.340 Z" class="cls-1"/>
                </svg>
                Team
            </a>
        </li>
        <li>
            @if(!isMRGAgent())
                <a href="{{ route('agent.creditPlan') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="39" height="31" viewBox="0 0 39 31">
                        <path d="M38.044,30.054 C37.408,30.686 36.643,31.002 35.749,31.002 L3.251,31.002 C2.357,31.002 1.592,30.686 0.955,30.054 C0.319,29.421 0.001,28.661 0.001,27.772 L0.001,3.227 C0.001,2.339 0.319,1.579 0.955,0.946 C1.592,0.314 2.357,-0.002 3.251,-0.002 L35.749,-0.002 C36.643,-0.002 37.408,0.314 38.044,0.946 C38.681,1.579 38.999,2.339 38.999,3.227 L38.999,27.772 C38.999,28.661 38.681,29.421 38.044,30.054 ZM36.399,3.227 C36.399,3.052 36.335,2.901 36.206,2.773 C36.077,2.645 35.925,2.581 35.749,2.581 L3.251,2.581 C3.075,2.581 2.922,2.645 2.794,2.773 C2.665,2.901 2.601,3.052 2.601,3.227 L2.601,7.749 L36.399,7.749 L36.399,3.227 ZM36.399,15.500 L2.601,15.500 L2.601,27.772 C2.601,27.948 2.665,28.099 2.794,28.227 C2.922,28.354 3.075,28.418 3.251,28.418 L35.749,28.418 C35.925,28.418 36.077,28.355 36.206,28.227 C36.335,28.099 36.399,27.948 36.399,27.773 L36.399,15.500 ZM13.000,23.251 L20.800,23.251 L20.800,25.835 L13.000,25.835 L13.000,23.251 ZM5.201,23.251 L10.400,23.251 L10.400,25.835 L5.201,25.835 L5.201,23.251 Z" class="cls-1"/>
                    </svg>
                    Credit Plans
                </a>
            @endif
        </li>
        <li>
            <a href="{{ route('agent.showCalendar') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="41.938" height="31.938" viewBox="0 0 41.938 31.938">
                    <path d="M40.841,30.877 C40.107,31.589 39.226,31.944 38.196,31.944 L3.742,31.944 C2.712,31.944 1.830,31.589 1.097,30.877 C0.363,30.166 -0.003,29.312 -0.003,28.313 L-0.003,3.627 C-0.003,2.628 0.363,1.774 1.097,1.062 C1.830,0.351 2.712,-0.004 3.742,-0.004 L38.196,-0.004 C39.226,-0.004 40.107,0.351 40.841,1.062 C41.574,1.773 41.941,2.628 41.941,3.627 L41.941,28.313 C41.941,29.312 41.574,30.166 40.841,30.877 ZM38.945,9.435 C38.945,9.238 38.870,9.068 38.722,8.924 C38.574,8.781 38.399,8.709 38.196,8.709 L3.742,8.709 C3.539,8.709 3.363,8.781 3.215,8.924 C3.067,9.068 2.993,9.238 2.993,9.435 L2.993,28.313 C2.993,28.510 3.067,28.680 3.215,28.823 C3.363,28.967 3.539,29.039 3.742,29.039 L38.196,29.039 C38.399,29.039 38.574,28.967 38.722,28.823 C38.870,28.680 38.945,28.510 38.945,28.313 L38.945,9.435 ZM35.200,26.134 L12.730,26.134 C12.527,26.134 12.351,26.063 12.203,25.919 C12.055,25.775 11.981,25.606 11.981,25.409 L11.981,23.956 C11.981,23.760 12.055,23.590 12.203,23.446 C12.351,23.302 12.527,23.231 12.730,23.231 L35.200,23.231 C35.403,23.231 35.578,23.302 35.727,23.446 C35.875,23.590 35.949,23.760 35.949,23.956 L35.949,25.409 C35.949,25.606 35.875,25.775 35.727,25.919 C35.578,26.063 35.403,26.134 35.200,26.134 ZM35.200,20.326 L12.730,20.326 C12.527,20.326 12.351,20.254 12.203,20.111 C12.055,19.967 11.981,19.797 11.981,19.600 L11.981,18.148 C11.981,17.951 12.055,17.781 12.203,17.637 C12.351,17.494 12.527,17.422 12.730,17.422 L35.200,17.422 C35.403,17.422 35.578,17.494 35.727,17.637 C35.875,17.781 35.949,17.951 35.949,18.148 L35.949,19.600 C35.949,19.797 35.875,19.967 35.727,20.111 C35.578,20.254 35.403,20.326 35.200,20.326 ZM35.200,14.518 L12.730,14.518 C12.527,14.518 12.351,14.445 12.203,14.302 C12.055,14.159 11.981,13.988 11.981,13.792 L11.981,12.339 C11.981,12.142 12.055,11.973 12.203,11.829 C12.351,11.685 12.527,11.613 12.730,11.613 L35.200,11.613 C35.403,11.613 35.578,11.685 35.727,11.829 C35.875,11.972 35.949,12.142 35.949,12.339 L35.949,13.792 C35.949,13.988 35.875,14.158 35.727,14.302 C35.579,14.446 35.403,14.518 35.200,14.518 ZM8.236,26.134 L6.738,26.134 C6.535,26.134 6.360,26.063 6.211,25.919 C6.063,25.775 5.989,25.606 5.989,25.409 L5.989,23.956 C5.989,23.760 6.063,23.590 6.211,23.446 C6.360,23.302 6.535,23.231 6.738,23.231 L8.236,23.231 C8.439,23.231 8.614,23.303 8.763,23.446 C8.911,23.590 8.985,23.760 8.985,23.956 L8.985,25.409 C8.985,25.606 8.911,25.775 8.763,25.919 C8.614,26.063 8.439,26.134 8.236,26.134 ZM8.236,20.326 L6.738,20.326 C6.535,20.326 6.360,20.254 6.211,20.111 C6.063,19.967 5.989,19.797 5.989,19.600 L5.989,18.148 C5.989,17.951 6.063,17.781 6.211,17.637 C6.360,17.494 6.535,17.422 6.738,17.422 L8.236,17.422 C8.439,17.422 8.614,17.494 8.763,17.637 C8.911,17.781 8.985,17.951 8.985,18.148 L8.985,19.600 C8.985,19.797 8.911,19.967 8.763,20.111 C8.614,20.254 8.439,20.326 8.236,20.326 ZM8.236,14.518 L6.738,14.518 C6.535,14.518 6.360,14.445 6.211,14.302 C6.063,14.158 5.989,13.988 5.989,13.792 L5.989,12.339 C5.989,12.142 6.063,11.973 6.211,11.829 C6.360,11.685 6.535,11.613 6.738,11.613 L8.236,11.613 C8.439,11.613 8.614,11.685 8.763,11.829 C8.911,11.972 8.985,12.142 8.985,12.339 L8.985,13.792 C8.985,13.988 8.911,14.158 8.763,14.302 C8.614,14.446 8.439,14.518 8.236,14.518 Z" class="cls-1"/>
                </svg>
                Calendar
            </a>
        </li>
    </ul>
</aside>
