<aside>
    <span class="close-menu"><i class="fa fa-times-circle"></i></span>
    {{--Profile With DropDown--}}
    @include('secured-layouts.user_avatar')
    <ul class="main-men">
        <li>
            <a href="{{ route(whoAmI().'.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="41.938" height="31.938" viewBox="0 0 41.938 31.938">
                    <path d="M40.841,30.877 C40.107,31.589 39.226,31.944 38.196,31.944 L3.742,31.944 C2.712,31.944 1.830,31.589 1.097,30.877 C0.363,30.166 -0.003,29.312 -0.003,28.313 L-0.003,3.627 C-0.003,2.628 0.363,1.774 1.097,1.062 C1.830,0.351 2.712,-0.004 3.742,-0.004 L38.196,-0.004 C39.226,-0.004 40.107,0.351 40.841,1.062 C41.574,1.773 41.941,2.628 41.941,3.627 L41.941,28.313 C41.941,29.312 41.574,30.166 40.841,30.877 ZM38.945,9.435 C38.945,9.238 38.870,9.068 38.722,8.924 C38.574,8.781 38.399,8.709 38.196,8.709 L3.742,8.709 C3.539,8.709 3.363,8.781 3.215,8.924 C3.067,9.068 2.993,9.238 2.993,9.435 L2.993,28.313 C2.993,28.510 3.067,28.680 3.215,28.823 C3.363,28.967 3.539,29.039 3.742,29.039 L38.196,29.039 C38.399,29.039 38.574,28.967 38.722,28.823 C38.870,28.680 38.945,28.510 38.945,28.313 L38.945,9.435 ZM35.200,26.134 L12.730,26.134 C12.527,26.134 12.351,26.063 12.203,25.919 C12.055,25.775 11.981,25.606 11.981,25.409 L11.981,23.956 C11.981,23.760 12.055,23.590 12.203,23.446 C12.351,23.302 12.527,23.231 12.730,23.231 L35.200,23.231 C35.403,23.231 35.578,23.302 35.727,23.446 C35.875,23.590 35.949,23.760 35.949,23.956 L35.949,25.409 C35.949,25.606 35.875,25.775 35.727,25.919 C35.578,26.063 35.403,26.134 35.200,26.134 ZM35.200,20.326 L12.730,20.326 C12.527,20.326 12.351,20.254 12.203,20.111 C12.055,19.967 11.981,19.797 11.981,19.600 L11.981,18.148 C11.981,17.951 12.055,17.781 12.203,17.637 C12.351,17.494 12.527,17.422 12.730,17.422 L35.200,17.422 C35.403,17.422 35.578,17.494 35.727,17.637 C35.875,17.781 35.949,17.951 35.949,18.148 L35.949,19.600 C35.949,19.797 35.875,19.967 35.727,20.111 C35.578,20.254 35.403,20.326 35.200,20.326 ZM35.200,14.518 L12.730,14.518 C12.527,14.518 12.351,14.445 12.203,14.302 C12.055,14.159 11.981,13.988 11.981,13.792 L11.981,12.339 C11.981,12.142 12.055,11.973 12.203,11.829 C12.351,11.685 12.527,11.613 12.730,11.613 L35.200,11.613 C35.403,11.613 35.578,11.685 35.727,11.829 C35.875,11.972 35.949,12.142 35.949,12.339 L35.949,13.792 C35.949,13.988 35.875,14.158 35.727,14.302 C35.579,14.446 35.403,14.518 35.200,14.518 ZM8.236,26.134 L6.738,26.134 C6.535,26.134 6.360,26.063 6.211,25.919 C6.063,25.775 5.989,25.606 5.989,25.409 L5.989,23.956 C5.989,23.760 6.063,23.590 6.211,23.446 C6.360,23.302 6.535,23.231 6.738,23.231 L8.236,23.231 C8.439,23.231 8.614,23.303 8.763,23.446 C8.911,23.590 8.985,23.760 8.985,23.956 L8.985,25.409 C8.985,25.606 8.911,25.775 8.763,25.919 C8.614,26.063 8.439,26.134 8.236,26.134 ZM8.236,20.326 L6.738,20.326 C6.535,20.326 6.360,20.254 6.211,20.111 C6.063,19.967 5.989,19.797 5.989,19.600 L5.989,18.148 C5.989,17.951 6.063,17.781 6.211,17.637 C6.360,17.494 6.535,17.422 6.738,17.422 L8.236,17.422 C8.439,17.422 8.614,17.494 8.763,17.637 C8.911,17.781 8.985,17.951 8.985,18.148 L8.985,19.600 C8.985,19.797 8.911,19.967 8.763,20.111 C8.614,20.254 8.439,20.326 8.236,20.326 ZM8.236,14.518 L6.738,14.518 C6.535,14.518 6.360,14.445 6.211,14.302 C6.063,14.158 5.989,13.988 5.989,13.792 L5.989,12.339 C5.989,12.142 6.063,11.973 6.211,11.829 C6.360,11.685 6.535,11.613 6.738,11.613 L8.236,11.613 C8.439,11.613 8.614,11.685 8.763,11.829 C8.911,11.972 8.985,12.142 8.985,12.339 L8.985,13.792 C8.985,13.988 8.911,14.158 8.763,14.302 C8.614,14.446 8.439,14.518 8.236,14.518 Z" class="cls-1"/>
                </svg>
                Listing
            </a>
        </li>
        <li>
            <a href="{{ route(whoAmI().'.conversations') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="42" height="28.406" viewBox="0 0 42 28.406">
                    <path d="M27.499,14.433 L41.995,2.497 L41.995,26.092 L27.499,14.433 ZM0.957,0.788 C1.497,0.308 2.224,0.013 3.024,0.013 L38.975,0.013 C39.781,0.013 40.507,0.306 41.046,0.782 L20.999,17.047 L0.957,0.788 ZM0.004,26.092 L0.004,2.506 L14.500,14.433 L0.004,26.092 ZM20.999,19.887 L26.195,15.582 L41.040,27.633 C40.501,28.110 39.775,28.404 38.975,28.404 L3.024,28.404 C2.220,28.404 1.492,28.110 0.951,27.633 L15.805,15.582 L20.999,19.887 Z" class="cls-1"/>
                </svg>
                Messages
            </a>
        </li>
        <li>
            <a href="{{ route(whoAmI().'.viewReviews') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="33" height="33" viewBox="0 0 33 33">
                    <path d="M32.287,14.949 C32.937,14.288 33.166,13.318 32.886,12.417 C32.605,11.516 31.873,10.873 30.974,10.736 L22.980,9.525 C22.640,9.473 22.346,9.250 22.194,8.928 L18.620,1.373 C18.219,0.525 17.404,-0.003 16.497,-0.003 C15.590,-0.003 14.775,0.525 14.374,1.373 L10.800,8.929 C10.648,9.251 10.353,9.474 10.012,9.525 L2.019,10.737 C1.120,10.873 0.388,11.517 0.107,12.418 C-0.173,13.319 0.056,14.289 0.706,14.949 L6.489,20.830 C6.736,21.081 6.849,21.442 6.791,21.795 L5.427,30.099 C5.306,30.830 5.490,31.541 5.943,32.101 C6.648,32.975 7.878,33.241 8.862,32.702 L16.010,28.781 C16.309,28.618 16.685,28.619 16.983,28.781 L24.133,32.702 C24.480,32.893 24.851,32.989 25.234,32.989 C25.933,32.989 26.595,32.665 27.051,32.101 C27.505,31.541 27.688,30.828 27.567,30.099 L26.202,21.795 C26.144,21.442 26.257,21.081 26.503,20.830 L32.287,14.949 Z" class="cls-1"/>
                </svg>
                Reviews
            </a>
        </li>
        <li>
            <a href="{{ route('owner.viewBuildings') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="45" height="45" viewBox="0 0 45 45">
                    <path d="M44.250,39.750 L42.682,39.750 C42.726,39.997 42.748,40.248 42.750,40.500 L42.750,44.250 C42.750,44.250 42.750,44.250 42.750,44.251 C42.749,44.665 42.414,45.000 42.000,45.000 L3.000,45.000 C3.000,45.000 3.000,45.000 2.999,45.000 C2.585,44.999 2.250,44.664 2.250,44.250 L2.250,40.500 C2.252,40.248 2.275,39.997 2.318,39.750 L0.750,39.750 C0.750,39.750 0.750,39.750 0.749,39.750 C0.335,39.750 0.000,39.414 0.000,39.000 L0.000,12.000 C0.000,12.000 0.000,12.000 0.000,11.999 C0.001,11.585 0.336,11.250 0.750,11.250 L12.000,11.250 L12.000,0.750 C12.000,0.750 12.000,0.750 12.000,0.749 C12.000,0.335 12.336,0.000 12.750,0.000 L32.250,0.000 C32.250,0.000 32.250,0.000 32.251,0.000 C32.665,0.001 33.000,0.336 33.000,0.750 L33.000,11.250 L44.250,11.250 C44.250,11.250 44.250,11.250 44.251,11.250 C44.665,11.250 45.000,11.586 45.000,12.000 L45.000,39.000 C45.000,39.000 45.000,39.000 45.000,39.001 C44.999,39.415 44.664,39.750 44.250,39.750 ZM35.250,43.500 L41.250,43.500 L41.250,40.500 C41.250,38.843 39.907,37.500 38.250,37.500 C36.593,37.500 35.250,38.843 35.250,40.500 L35.250,43.500 ZM39.750,34.500 C39.750,33.671 39.078,33.000 38.250,33.000 C37.421,33.000 36.750,33.671 36.750,34.500 C36.751,35.328 37.422,35.999 38.250,36.000 C39.078,36.000 39.750,35.328 39.750,34.500 ZM18.750,43.500 L26.250,43.500 L26.250,38.250 C26.250,36.179 24.571,34.500 22.500,34.500 C20.429,34.500 18.750,36.179 18.750,38.250 L18.750,43.500 ZM24.750,30.750 C24.750,29.507 23.743,28.500 22.500,28.500 C21.257,28.500 20.250,29.507 20.250,30.750 C20.251,31.992 21.258,32.999 22.500,33.000 C23.743,33.000 24.750,31.993 24.750,30.750 ZM3.750,43.500 L9.750,43.500 L9.750,40.500 C9.750,38.843 8.407,37.500 6.750,37.500 C5.093,37.500 3.750,38.843 3.750,40.500 L3.750,43.500 ZM8.250,34.500 C8.250,33.671 7.579,33.000 6.750,33.000 C5.922,33.000 5.250,33.671 5.250,34.500 C5.251,35.328 5.922,35.999 6.750,36.000 C7.579,36.000 8.250,35.328 8.250,34.500 ZM12.000,30.286 L12.000,12.750 L1.500,12.750 L1.500,38.250 L2.859,38.250 C3.269,37.541 3.864,36.957 4.580,36.560 C3.474,35.401 3.474,33.577 4.580,32.417 C5.724,31.219 7.623,31.175 8.822,32.319 C10.020,33.463 10.064,35.362 8.920,36.560 C9.264,36.751 9.581,36.986 9.864,37.258 C10.149,36.005 10.955,34.932 12.080,34.310 C11.005,33.196 10.970,31.442 12.000,30.286 ZM11.250,38.250 L11.250,43.500 L17.250,43.500 L17.250,38.250 C17.250,36.593 15.907,35.250 14.250,35.250 C12.593,35.250 11.250,36.593 11.250,38.250 ZM12.750,32.250 C12.750,33.078 13.422,33.750 14.250,33.750 C15.079,33.750 15.750,33.078 15.750,32.250 C15.750,31.421 15.079,30.750 14.250,30.750 C13.422,30.751 12.751,31.422 12.750,32.250 ZM31.500,1.500 L13.500,1.500 L13.500,29.356 C14.521,29.075 15.615,29.358 16.372,30.098 C17.549,31.248 17.570,33.134 16.420,34.310 C17.021,34.643 17.538,35.109 17.932,35.671 C18.435,34.786 19.182,34.064 20.084,33.594 C19.921,33.456 19.769,33.305 19.632,33.141 C18.298,31.557 18.500,29.192 20.084,27.857 C21.668,26.523 24.034,26.726 25.368,28.310 C26.702,29.894 26.500,32.260 24.916,33.594 C25.818,34.064 26.565,34.786 27.068,35.671 C27.462,35.109 27.979,34.643 28.580,34.310 C28.045,33.751 27.748,33.007 27.750,32.234 C27.754,30.582 29.097,29.246 30.750,29.250 C31.003,29.253 31.255,29.289 31.500,29.356 L31.500,1.500 ZM30.750,30.750 C29.921,30.750 29.250,31.421 29.250,32.250 C29.250,33.078 29.921,33.750 30.750,33.750 C31.578,33.750 32.250,33.078 32.250,32.250 C32.249,31.422 31.578,30.751 30.750,30.750 ZM30.750,35.250 C29.093,35.250 27.750,36.593 27.750,38.250 L27.750,43.500 L33.750,43.500 L33.750,40.500 L33.750,38.250 C33.750,36.593 32.407,35.250 30.750,35.250 ZM43.500,12.750 L33.000,12.750 L33.000,30.286 C34.030,31.442 33.995,33.196 32.920,34.310 C34.045,34.932 34.851,36.005 35.136,37.258 C35.419,36.986 35.736,36.751 36.080,36.560 C34.973,35.401 34.973,33.577 36.080,32.417 C37.224,31.219 39.123,31.175 40.321,32.319 C41.520,33.463 41.564,35.362 40.420,36.560 C41.136,36.957 41.731,37.541 42.141,38.250 L43.500,38.250 L43.500,38.250 L43.500,12.750 ZM39.750,17.250 L41.250,17.250 L41.250,29.250 L39.750,29.250 L39.750,17.250 ZM35.250,17.250 L36.750,17.250 L36.750,29.250 L35.250,29.250 L35.250,17.250 ZM27.750,24.000 L29.250,24.000 L29.250,25.500 L27.750,25.500 L27.750,24.000 ZM27.750,21.000 L29.250,21.000 L29.250,22.500 L27.750,22.500 L27.750,21.000 ZM27.750,18.000 L29.250,18.000 L29.250,19.500 L27.750,19.500 L27.750,18.000 ZM27.750,15.000 L29.250,15.000 L29.250,16.500 L27.750,16.500 L27.750,15.000 ZM27.000,10.500 L18.000,10.500 C18.000,10.500 17.999,10.500 17.999,10.500 C17.585,10.500 17.250,10.164 17.250,9.750 L17.250,3.750 C17.250,3.750 17.250,3.750 17.250,3.749 C17.250,3.335 17.586,3.000 18.000,3.000 L27.000,3.000 C27.000,3.000 27.001,3.000 27.001,3.000 C27.415,3.001 27.750,3.336 27.750,3.750 L27.750,9.750 C27.750,9.750 27.750,9.751 27.750,9.751 C27.750,10.165 27.414,10.500 27.000,10.500 ZM26.250,4.500 L18.750,4.500 L18.750,9.000 L26.250,9.000 L26.250,4.500 ZM17.250,16.500 L15.750,16.500 L15.750,15.000 L17.250,15.000 L17.250,16.500 ZM17.250,19.500 L15.750,19.500 L15.750,18.000 L17.250,18.000 L17.250,19.500 ZM17.250,22.500 L15.750,22.500 L15.750,21.000 L17.250,21.000 L17.250,22.500 ZM17.250,25.500 L15.750,25.500 L15.750,24.000 L17.250,24.000 L17.250,25.500 ZM20.250,13.500 L18.750,13.500 L18.750,12.000 L20.250,12.000 L20.250,13.500 ZM20.250,16.500 L18.750,16.500 L18.750,15.000 L20.250,15.000 L20.250,16.500 ZM20.250,19.500 L18.750,19.500 L18.750,18.000 L20.250,18.000 L20.250,19.500 ZM20.250,22.500 L18.750,22.500 L18.750,21.000 L20.250,21.000 L20.250,22.500 ZM20.250,25.500 L18.750,25.500 L18.750,24.000 L20.250,24.000 L20.250,25.500 ZM23.250,13.500 L21.750,13.500 L21.750,12.000 L23.250,12.000 L23.250,13.500 ZM23.250,16.500 L21.750,16.500 L21.750,15.000 L23.250,15.000 L23.250,16.500 ZM23.250,19.500 L21.750,19.500 L21.750,18.000 L23.250,18.000 L23.250,19.500 ZM23.250,22.500 L21.750,22.500 L21.750,21.000 L23.250,21.000 L23.250,22.500 ZM23.250,25.500 L21.750,25.500 L21.750,24.000 L23.250,24.000 L23.250,25.500 ZM26.250,13.500 L24.750,13.500 L24.750,12.000 L26.250,12.000 L26.250,13.500 ZM26.250,16.500 L24.750,16.500 L24.750,15.000 L26.250,15.000 L26.250,16.500 ZM26.250,19.500 L24.750,19.500 L24.750,18.000 L26.250,18.000 L26.250,19.500 ZM26.250,22.500 L24.750,22.500 L24.750,21.000 L26.250,21.000 L26.250,22.500 ZM26.250,25.500 L24.750,25.500 L24.750,24.000 L26.250,24.000 L26.250,25.500 ZM8.250,17.250 L9.750,17.250 L9.750,29.250 L8.250,29.250 L8.250,17.250 ZM3.750,17.250 L5.250,17.250 L5.250,29.250 L3.750,29.250 L3.750,17.250 Z" class="cls-1"/>
                </svg>
                Manage Buildings
            </a>
        </li>
        <li>
            <a href="{{ route(whoAmI().'.showCalendar') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="41.938" height="31.938" viewBox="0 0 41.938 31.938">
                    <path d="M40.841,30.877 C40.107,31.589 39.226,31.944 38.196,31.944 L3.742,31.944 C2.712,31.944 1.830,31.589 1.097,30.877 C0.363,30.166 -0.003,29.312 -0.003,28.313 L-0.003,3.627 C-0.003,2.628 0.363,1.774 1.097,1.062 C1.830,0.351 2.712,-0.004 3.742,-0.004 L38.196,-0.004 C39.226,-0.004 40.107,0.351 40.841,1.062 C41.574,1.773 41.941,2.628 41.941,3.627 L41.941,28.313 C41.941,29.312 41.574,30.166 40.841,30.877 ZM38.945,9.435 C38.945,9.238 38.870,9.068 38.722,8.924 C38.574,8.781 38.399,8.709 38.196,8.709 L3.742,8.709 C3.539,8.709 3.363,8.781 3.215,8.924 C3.067,9.068 2.993,9.238 2.993,9.435 L2.993,28.313 C2.993,28.510 3.067,28.680 3.215,28.823 C3.363,28.967 3.539,29.039 3.742,29.039 L38.196,29.039 C38.399,29.039 38.574,28.967 38.722,28.823 C38.870,28.680 38.945,28.510 38.945,28.313 L38.945,9.435 ZM35.200,26.134 L12.730,26.134 C12.527,26.134 12.351,26.063 12.203,25.919 C12.055,25.775 11.981,25.606 11.981,25.409 L11.981,23.956 C11.981,23.760 12.055,23.590 12.203,23.446 C12.351,23.302 12.527,23.231 12.730,23.231 L35.200,23.231 C35.403,23.231 35.578,23.302 35.727,23.446 C35.875,23.590 35.949,23.760 35.949,23.956 L35.949,25.409 C35.949,25.606 35.875,25.775 35.727,25.919 C35.578,26.063 35.403,26.134 35.200,26.134 ZM35.200,20.326 L12.730,20.326 C12.527,20.326 12.351,20.254 12.203,20.111 C12.055,19.967 11.981,19.797 11.981,19.600 L11.981,18.148 C11.981,17.951 12.055,17.781 12.203,17.637 C12.351,17.494 12.527,17.422 12.730,17.422 L35.200,17.422 C35.403,17.422 35.578,17.494 35.727,17.637 C35.875,17.781 35.949,17.951 35.949,18.148 L35.949,19.600 C35.949,19.797 35.875,19.967 35.727,20.111 C35.578,20.254 35.403,20.326 35.200,20.326 ZM35.200,14.518 L12.730,14.518 C12.527,14.518 12.351,14.445 12.203,14.302 C12.055,14.159 11.981,13.988 11.981,13.792 L11.981,12.339 C11.981,12.142 12.055,11.973 12.203,11.829 C12.351,11.685 12.527,11.613 12.730,11.613 L35.200,11.613 C35.403,11.613 35.578,11.685 35.727,11.829 C35.875,11.972 35.949,12.142 35.949,12.339 L35.949,13.792 C35.949,13.988 35.875,14.158 35.727,14.302 C35.579,14.446 35.403,14.518 35.200,14.518 ZM8.236,26.134 L6.738,26.134 C6.535,26.134 6.360,26.063 6.211,25.919 C6.063,25.775 5.989,25.606 5.989,25.409 L5.989,23.956 C5.989,23.760 6.063,23.590 6.211,23.446 C6.360,23.302 6.535,23.231 6.738,23.231 L8.236,23.231 C8.439,23.231 8.614,23.303 8.763,23.446 C8.911,23.590 8.985,23.760 8.985,23.956 L8.985,25.409 C8.985,25.606 8.911,25.775 8.763,25.919 C8.614,26.063 8.439,26.134 8.236,26.134 ZM8.236,20.326 L6.738,20.326 C6.535,20.326 6.360,20.254 6.211,20.111 C6.063,19.967 5.989,19.797 5.989,19.600 L5.989,18.148 C5.989,17.951 6.063,17.781 6.211,17.637 C6.360,17.494 6.535,17.422 6.738,17.422 L8.236,17.422 C8.439,17.422 8.614,17.494 8.763,17.637 C8.911,17.781 8.985,17.951 8.985,18.148 L8.985,19.600 C8.985,19.797 8.911,19.967 8.763,20.111 C8.614,20.254 8.439,20.326 8.236,20.326 ZM8.236,14.518 L6.738,14.518 C6.535,14.518 6.360,14.445 6.211,14.302 C6.063,14.158 5.989,13.988 5.989,13.792 L5.989,12.339 C5.989,12.142 6.063,11.973 6.211,11.829 C6.360,11.685 6.535,11.613 6.738,11.613 L8.236,11.613 C8.439,11.613 8.614,11.685 8.763,11.829 C8.911,11.972 8.985,12.142 8.985,12.339 L8.985,13.792 C8.985,13.988 8.911,14.158 8.763,14.302 C8.614,14.446 8.439,14.518 8.236,14.518 Z" class="cls-1"/>
                </svg>
                Calendar
            </a>
        </li>
    </ul>
</aside>
