<aside>
    <span class="close-menu"><i class="fa fa-times-circle"></i></span>
    {{--Profile With DropDown--}}
    @include('secured-layouts.user_avatar')
    <ul class="main-men">
        <li>
            <a href="{{ route('admin.index') }}">
                <svg height="40px" viewBox="-30 0 448 448.094" width="40px" xmlns="http://www.w3.org/2000/svg"><path d="m194.046875 177.050781c12.683594 0 22.964844-10.28125 22.964844-22.960937 0-12.683594-10.28125-22.964844-22.964844-22.964844s-22.964844 10.28125-22.964844 22.964844c.015625 12.675781 10.289063 22.949218 22.964844 22.960937zm0 0"/><path d="m238.046875 250.320312c-.023437-20.246093-16.433594-36.65625-36.683594-36.679687h-14.632812c-20.25.023437-36.660157 16.433594-36.683594 36.679687v25.4375h88zm0 0"/><path d="m68.804688 330.851562v-2.433593c0-3.3125 2.6875-6 6-6s6 2.6875 6 6v12.230469c0 1.058593-.28125 2.09375-.816407 3.007812 9.613281 10.035156 20.09375 19.199219 31.324219 27.382812 24.386719 17.703126 51.300781 31.632813 79.835938 41.320313 29.472656-9.644531 57.367187-23.582031 82.777343-41.359375 12.0625-8.488281 23.316407-18.066406 33.621094-28.617188-.167969-.5625-.253906-1.148437-.257813-1.734374v-12.230469c0-3.3125 2.6875-6 6-6 3.316407 0 6 2.6875 6 6v.757812c4.304688-5.285156 8.308594-10.804687 11.996094-16.535156 17.035156-26.398437 26.007813-57.1875 25.816406-88.605469v-94.125c-57.761718-25.082031-112.464843-56.679687-163.054687-94.179687-50.585937 37.5-105.292969 69.097656-163.054687 94.179687v94.125c0 32.101563 8.394531 61.9375 24.949218 88.675782 3.914063 6.300781 8.210938 12.359374 12.863282 18.140624zm91.5 9.796876c0 3.316406-2.6875 6-6 6s-6-2.683594-6-6v-12.226563c0-3.316406 2.6875-6 6-6s6 2.683594 6 6zm39.746093 0c0 3.316406-2.683593 6-6 6-3.3125 0-6-2.683594-6-6v-12.226563c0-3.316406 2.6875-6 6-6 3.316407 0 6 2.683594 6 6zm39.75 0c0 3.316406-2.6875 6-6 6-3.316406 0-6-2.683594-6-6v-12.226563c0-3.316406 2.683594-6 6-6 3.3125 0 6 2.683594 6 6zm27.746094-12.226563c0-3.316406 2.6875-6 6-6 3.316406 0 6 2.683594 6 6v12.226563c0 3.316406-2.683594 6-6 6-3.3125 0-6-2.683594-6-6zm-73.5-209.296875c19.308594 0 34.964844 15.652344 34.964844 34.964844 0 19.308594-15.65625 34.964844-34.964844 34.964844-19.3125-.003907-34.964844-15.65625-34.964844-34.964844.019531-19.304688 15.664063-34.945313 34.964844-34.964844zm-56 131.199219c.03125-26.875 21.808594-48.652344 48.683594-48.683594h14.632812c26.875.03125 48.652344 21.808594 48.683594 48.679687v31.4375c0 3.3125-2.6875 6-6 6h-100c-3.3125 0-6-2.6875-6-6zm-29.5 78.101562c0-3.316406 2.6875-6 6-6s6 2.683594 6 6v12.230469c0 3.3125-2.6875 6-6 6s-6-2.6875-6-6zm0 0"/><path d="m95.570312 398.988281c42.761719 31.375 86.128907 46.246094 95.039063 49.105469 9.117187-2.820312 54.132813-17.699219 98.519531-49.152344 28.832032-20.429687 51.773438-43.761718 68.183594-69.347656 20.28125-31.414062 30.960938-68.0625 30.734375-105.453125v-112.074219c-68.75-29.789062-133.84375-67.394531-194-112.066406-60.15625 44.671875-125.25 82.273438-194 112.066406v112.074219c0 38.199219 9.992187 73.699219 29.699219 105.515625 15.847656 25.585938 37.992187 48.910156 65.824218 69.332031zm-76.578124-273.023437c0-2.398438 1.429687-4.566406 3.628906-5.515625l1.113281-.476563c59.195313-25.46875 115.15625-57.875 166.710937-96.53125 2.136719-1.601562 5.066407-1.601562 7.203126 0 51.554687 38.65625 107.519531 71.058594 166.710937 96.53125l1.113281.476563c2.203125.945312 3.628906 3.113281 3.628906 5.511719v98.070312c.203126 33.785156-9.46875 66.894531-27.824218 95.253906-14.683594 22.851563-35.109375 43.609375-60.703125 61.703125-43.335938 30.640625-86.027344 42.90625-87.824219 43.414063-1.085938.308594-2.234375.300781-3.3125-.011719-1.738281-.507813-43.027344-12.792969-84.921875-43.460937-24.738281-18.101563-44.472656-38.875-58.660156-61.726563-17.824219-28.710937-26.859375-60.734375-26.859375-95.175781zm0 0"/></svg>
                Manage Accounts
            </a>
        </li>
        <li>
            <a href="{{ route('admin.viewListing') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="41.938" height="31.938" viewBox="0 0 41.938 31.938">
                    <path d="M40.841,30.877 C40.107,31.589 39.226,31.944 38.196,31.944 L3.742,31.944 C2.712,31.944 1.830,31.589 1.097,30.877 C0.363,30.166 -0.003,29.312 -0.003,28.313 L-0.003,3.627 C-0.003,2.628 0.363,1.774 1.097,1.062 C1.830,0.351 2.712,-0.004 3.742,-0.004 L38.196,-0.004 C39.226,-0.004 40.107,0.351 40.841,1.062 C41.574,1.773 41.941,2.628 41.941,3.627 L41.941,28.313 C41.941,29.312 41.574,30.166 40.841,30.877 ZM38.945,9.435 C38.945,9.238 38.870,9.068 38.722,8.924 C38.574,8.781 38.399,8.709 38.196,8.709 L3.742,8.709 C3.539,8.709 3.363,8.781 3.215,8.924 C3.067,9.068 2.993,9.238 2.993,9.435 L2.993,28.313 C2.993,28.510 3.067,28.680 3.215,28.823 C3.363,28.967 3.539,29.039 3.742,29.039 L38.196,29.039 C38.399,29.039 38.574,28.967 38.722,28.823 C38.870,28.680 38.945,28.510 38.945,28.313 L38.945,9.435 ZM35.200,26.134 L12.730,26.134 C12.527,26.134 12.351,26.063 12.203,25.919 C12.055,25.775 11.981,25.606 11.981,25.409 L11.981,23.956 C11.981,23.760 12.055,23.590 12.203,23.446 C12.351,23.302 12.527,23.231 12.730,23.231 L35.200,23.231 C35.403,23.231 35.578,23.302 35.727,23.446 C35.875,23.590 35.949,23.760 35.949,23.956 L35.949,25.409 C35.949,25.606 35.875,25.775 35.727,25.919 C35.578,26.063 35.403,26.134 35.200,26.134 ZM35.200,20.326 L12.730,20.326 C12.527,20.326 12.351,20.254 12.203,20.111 C12.055,19.967 11.981,19.797 11.981,19.600 L11.981,18.148 C11.981,17.951 12.055,17.781 12.203,17.637 C12.351,17.494 12.527,17.422 12.730,17.422 L35.200,17.422 C35.403,17.422 35.578,17.494 35.727,17.637 C35.875,17.781 35.949,17.951 35.949,18.148 L35.949,19.600 C35.949,19.797 35.875,19.967 35.727,20.111 C35.578,20.254 35.403,20.326 35.200,20.326 ZM35.200,14.518 L12.730,14.518 C12.527,14.518 12.351,14.445 12.203,14.302 C12.055,14.159 11.981,13.988 11.981,13.792 L11.981,12.339 C11.981,12.142 12.055,11.973 12.203,11.829 C12.351,11.685 12.527,11.613 12.730,11.613 L35.200,11.613 C35.403,11.613 35.578,11.685 35.727,11.829 C35.875,11.972 35.949,12.142 35.949,12.339 L35.949,13.792 C35.949,13.988 35.875,14.158 35.727,14.302 C35.579,14.446 35.403,14.518 35.200,14.518 ZM8.236,26.134 L6.738,26.134 C6.535,26.134 6.360,26.063 6.211,25.919 C6.063,25.775 5.989,25.606 5.989,25.409 L5.989,23.956 C5.989,23.760 6.063,23.590 6.211,23.446 C6.360,23.302 6.535,23.231 6.738,23.231 L8.236,23.231 C8.439,23.231 8.614,23.303 8.763,23.446 C8.911,23.590 8.985,23.760 8.985,23.956 L8.985,25.409 C8.985,25.606 8.911,25.775 8.763,25.919 C8.614,26.063 8.439,26.134 8.236,26.134 ZM8.236,20.326 L6.738,20.326 C6.535,20.326 6.360,20.254 6.211,20.111 C6.063,19.967 5.989,19.797 5.989,19.600 L5.989,18.148 C5.989,17.951 6.063,17.781 6.211,17.637 C6.360,17.494 6.535,17.422 6.738,17.422 L8.236,17.422 C8.439,17.422 8.614,17.494 8.763,17.637 C8.911,17.781 8.985,17.951 8.985,18.148 L8.985,19.600 C8.985,19.797 8.911,19.967 8.763,20.111 C8.614,20.254 8.439,20.326 8.236,20.326 ZM8.236,14.518 L6.738,14.518 C6.535,14.518 6.360,14.445 6.211,14.302 C6.063,14.158 5.989,13.988 5.989,13.792 L5.989,12.339 C5.989,12.142 6.063,11.973 6.211,11.829 C6.360,11.685 6.535,11.613 6.738,11.613 L8.236,11.613 C8.439,11.613 8.614,11.685 8.763,11.829 C8.911,11.972 8.985,12.142 8.985,12.339 L8.985,13.792 C8.985,13.988 8.911,14.158 8.763,14.302 C8.614,14.446 8.439,14.518 8.236,14.518 Z" class="cls-1"/>
                </svg>
                Manage Listing
            </a>
        </li>
        <li>
            <a href="{{ route('admin.featureListing') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="41.938" height="31.938" viewBox="0 0 41.938 31.938">
                    <path d="M40.841,30.877 C40.107,31.589 39.226,31.944 38.196,31.944 L3.742,31.944 C2.712,31.944 1.830,31.589 1.097,30.877 C0.363,30.166 -0.003,29.312 -0.003,28.313 L-0.003,3.627 C-0.003,2.628 0.363,1.774 1.097,1.062 C1.830,0.351 2.712,-0.004 3.742,-0.004 L38.196,-0.004 C39.226,-0.004 40.107,0.351 40.841,1.062 C41.574,1.773 41.941,2.628 41.941,3.627 L41.941,28.313 C41.941,29.312 41.574,30.166 40.841,30.877 ZM38.945,9.435 C38.945,9.238 38.870,9.068 38.722,8.924 C38.574,8.781 38.399,8.709 38.196,8.709 L3.742,8.709 C3.539,8.709 3.363,8.781 3.215,8.924 C3.067,9.068 2.993,9.238 2.993,9.435 L2.993,28.313 C2.993,28.510 3.067,28.680 3.215,28.823 C3.363,28.967 3.539,29.039 3.742,29.039 L38.196,29.039 C38.399,29.039 38.574,28.967 38.722,28.823 C38.870,28.680 38.945,28.510 38.945,28.313 L38.945,9.435 ZM35.200,26.134 L12.730,26.134 C12.527,26.134 12.351,26.063 12.203,25.919 C12.055,25.775 11.981,25.606 11.981,25.409 L11.981,23.956 C11.981,23.760 12.055,23.590 12.203,23.446 C12.351,23.302 12.527,23.231 12.730,23.231 L35.200,23.231 C35.403,23.231 35.578,23.302 35.727,23.446 C35.875,23.590 35.949,23.760 35.949,23.956 L35.949,25.409 C35.949,25.606 35.875,25.775 35.727,25.919 C35.578,26.063 35.403,26.134 35.200,26.134 ZM35.200,20.326 L12.730,20.326 C12.527,20.326 12.351,20.254 12.203,20.111 C12.055,19.967 11.981,19.797 11.981,19.600 L11.981,18.148 C11.981,17.951 12.055,17.781 12.203,17.637 C12.351,17.494 12.527,17.422 12.730,17.422 L35.200,17.422 C35.403,17.422 35.578,17.494 35.727,17.637 C35.875,17.781 35.949,17.951 35.949,18.148 L35.949,19.600 C35.949,19.797 35.875,19.967 35.727,20.111 C35.578,20.254 35.403,20.326 35.200,20.326 ZM35.200,14.518 L12.730,14.518 C12.527,14.518 12.351,14.445 12.203,14.302 C12.055,14.159 11.981,13.988 11.981,13.792 L11.981,12.339 C11.981,12.142 12.055,11.973 12.203,11.829 C12.351,11.685 12.527,11.613 12.730,11.613 L35.200,11.613 C35.403,11.613 35.578,11.685 35.727,11.829 C35.875,11.972 35.949,12.142 35.949,12.339 L35.949,13.792 C35.949,13.988 35.875,14.158 35.727,14.302 C35.579,14.446 35.403,14.518 35.200,14.518 ZM8.236,26.134 L6.738,26.134 C6.535,26.134 6.360,26.063 6.211,25.919 C6.063,25.775 5.989,25.606 5.989,25.409 L5.989,23.956 C5.989,23.760 6.063,23.590 6.211,23.446 C6.360,23.302 6.535,23.231 6.738,23.231 L8.236,23.231 C8.439,23.231 8.614,23.303 8.763,23.446 C8.911,23.590 8.985,23.760 8.985,23.956 L8.985,25.409 C8.985,25.606 8.911,25.775 8.763,25.919 C8.614,26.063 8.439,26.134 8.236,26.134 ZM8.236,20.326 L6.738,20.326 C6.535,20.326 6.360,20.254 6.211,20.111 C6.063,19.967 5.989,19.797 5.989,19.600 L5.989,18.148 C5.989,17.951 6.063,17.781 6.211,17.637 C6.360,17.494 6.535,17.422 6.738,17.422 L8.236,17.422 C8.439,17.422 8.614,17.494 8.763,17.637 C8.911,17.781 8.985,17.951 8.985,18.148 L8.985,19.600 C8.985,19.797 8.911,19.967 8.763,20.111 C8.614,20.254 8.439,20.326 8.236,20.326 ZM8.236,14.518 L6.738,14.518 C6.535,14.518 6.360,14.445 6.211,14.302 C6.063,14.158 5.989,13.988 5.989,13.792 L5.989,12.339 C5.989,12.142 6.063,11.973 6.211,11.829 C6.360,11.685 6.535,11.613 6.738,11.613 L8.236,11.613 C8.439,11.613 8.614,11.685 8.763,11.829 C8.911,11.972 8.985,12.142 8.985,12.339 L8.985,13.792 C8.985,13.988 8.911,14.158 8.763,14.302 C8.614,14.446 8.439,14.518 8.236,14.518 Z" class="cls-1"/>
                </svg>
                Featured Listing
            </a>
        </li>
        <li>
            <a href="javascript:void(0);">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="40" height="35" viewBox="0 0 40 35">
                    <path d="M35.900,8.495 C38.461,10.690 40.000,13.423 40.000,16.396 C40.000,20.909 36.493,24.888 31.160,27.236 C31.138,27.270 26.250,34.985 15.761,34.985 C18.428,33.603 20.173,31.029 20.096,29.455 C20.063,29.455 20.032,29.457 20.000,29.457 C8.952,29.457 0.000,23.606 0.000,16.396 C0.000,9.180 8.952,3.334 20.000,3.334 C22.133,3.334 24.182,3.556 26.107,3.959 L27.940,0.846 C29.048,-1.024 32.434,0.622 33.839,1.417 C35.242,2.211 38.391,4.260 37.292,6.133 L35.900,8.495 ZM9.036,16.544 C8.031,16.544 7.217,17.342 7.217,18.326 C7.217,19.310 8.032,20.108 9.036,20.108 C10.040,20.108 10.855,19.310 10.855,18.326 C10.855,17.342 10.041,16.544 9.036,16.544 ZM14.005,16.544 C13.000,16.544 12.187,17.342 12.187,18.326 C12.187,19.310 13.001,20.108 14.005,20.108 C15.010,20.108 15.824,19.310 15.824,18.326 C15.824,17.342 15.010,16.544 14.005,16.544 ZM18.976,16.544 C17.971,16.544 17.158,17.342 17.158,18.326 C17.158,19.310 17.972,20.108 18.976,20.108 C19.980,20.108 20.794,19.310 20.794,18.326 C20.794,17.342 19.981,16.544 18.976,16.544 ZM33.172,2.549 C31.228,1.449 29.401,0.983 29.094,1.501 L23.818,10.455 L23.846,14.774 L23.872,18.328 L27.026,16.572 L30.859,14.438 L36.135,5.484 C36.441,4.964 35.116,3.649 33.172,2.549 ZM24.518,15.152 L24.487,10.833 L30.190,14.057 L26.357,16.193 L24.518,15.152 Z" class="cls-1"/>
                </svg>
                Listing Reports
            </a>
        </li>
        <li>
            <a href="{{ route('admin.manageBuildingIndex') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="45" height="45" viewBox="0 0 45 45">
                    <path d="M44.250,39.750 L42.682,39.750 C42.726,39.997 42.748,40.248 42.750,40.500 L42.750,44.250 C42.750,44.250 42.750,44.250 42.750,44.251 C42.749,44.665 42.414,45.000 42.000,45.000 L3.000,45.000 C3.000,45.000 3.000,45.000 2.999,45.000 C2.585,44.999 2.250,44.664 2.250,44.250 L2.250,40.500 C2.252,40.248 2.275,39.997 2.318,39.750 L0.750,39.750 C0.750,39.750 0.750,39.750 0.749,39.750 C0.335,39.750 0.000,39.414 0.000,39.000 L0.000,12.000 C0.000,12.000 0.000,12.000 0.000,11.999 C0.001,11.585 0.336,11.250 0.750,11.250 L12.000,11.250 L12.000,0.750 C12.000,0.750 12.000,0.750 12.000,0.749 C12.000,0.335 12.336,0.000 12.750,0.000 L32.250,0.000 C32.250,0.000 32.250,0.000 32.251,0.000 C32.665,0.001 33.000,0.336 33.000,0.750 L33.000,11.250 L44.250,11.250 C44.250,11.250 44.250,11.250 44.251,11.250 C44.665,11.250 45.000,11.586 45.000,12.000 L45.000,39.000 C45.000,39.000 45.000,39.000 45.000,39.001 C44.999,39.415 44.664,39.750 44.250,39.750 ZM35.250,43.500 L41.250,43.500 L41.250,40.500 C41.250,38.843 39.907,37.500 38.250,37.500 C36.593,37.500 35.250,38.843 35.250,40.500 L35.250,43.500 ZM39.750,34.500 C39.750,33.671 39.078,33.000 38.250,33.000 C37.421,33.000 36.750,33.671 36.750,34.500 C36.751,35.328 37.422,35.999 38.250,36.000 C39.078,36.000 39.750,35.328 39.750,34.500 ZM18.750,43.500 L26.250,43.500 L26.250,38.250 C26.250,36.179 24.571,34.500 22.500,34.500 C20.429,34.500 18.750,36.179 18.750,38.250 L18.750,43.500 ZM24.750,30.750 C24.750,29.507 23.743,28.500 22.500,28.500 C21.257,28.500 20.250,29.507 20.250,30.750 C20.251,31.992 21.258,32.999 22.500,33.000 C23.743,33.000 24.750,31.993 24.750,30.750 ZM3.750,43.500 L9.750,43.500 L9.750,40.500 C9.750,38.843 8.407,37.500 6.750,37.500 C5.093,37.500 3.750,38.843 3.750,40.500 L3.750,43.500 ZM8.250,34.500 C8.250,33.671 7.579,33.000 6.750,33.000 C5.922,33.000 5.250,33.671 5.250,34.500 C5.251,35.328 5.922,35.999 6.750,36.000 C7.579,36.000 8.250,35.328 8.250,34.500 ZM12.000,30.286 L12.000,12.750 L1.500,12.750 L1.500,38.250 L2.859,38.250 C3.269,37.541 3.864,36.957 4.580,36.560 C3.474,35.401 3.474,33.577 4.580,32.417 C5.724,31.219 7.623,31.175 8.822,32.319 C10.020,33.463 10.064,35.362 8.920,36.560 C9.264,36.751 9.581,36.986 9.864,37.258 C10.149,36.005 10.955,34.932 12.080,34.310 C11.005,33.196 10.970,31.442 12.000,30.286 ZM11.250,38.250 L11.250,43.500 L17.250,43.500 L17.250,38.250 C17.250,36.593 15.907,35.250 14.250,35.250 C12.593,35.250 11.250,36.593 11.250,38.250 ZM12.750,32.250 C12.750,33.078 13.422,33.750 14.250,33.750 C15.079,33.750 15.750,33.078 15.750,32.250 C15.750,31.421 15.079,30.750 14.250,30.750 C13.422,30.751 12.751,31.422 12.750,32.250 ZM31.500,1.500 L13.500,1.500 L13.500,29.356 C14.521,29.075 15.615,29.358 16.372,30.098 C17.549,31.248 17.570,33.134 16.420,34.310 C17.021,34.643 17.538,35.109 17.932,35.671 C18.435,34.786 19.182,34.064 20.084,33.594 C19.921,33.456 19.769,33.305 19.632,33.141 C18.298,31.557 18.500,29.192 20.084,27.857 C21.668,26.523 24.034,26.726 25.368,28.310 C26.702,29.894 26.500,32.260 24.916,33.594 C25.818,34.064 26.565,34.786 27.068,35.671 C27.462,35.109 27.979,34.643 28.580,34.310 C28.045,33.751 27.748,33.007 27.750,32.234 C27.754,30.582 29.097,29.246 30.750,29.250 C31.003,29.253 31.255,29.289 31.500,29.356 L31.500,1.500 ZM30.750,30.750 C29.921,30.750 29.250,31.421 29.250,32.250 C29.250,33.078 29.921,33.750 30.750,33.750 C31.578,33.750 32.250,33.078 32.250,32.250 C32.249,31.422 31.578,30.751 30.750,30.750 ZM30.750,35.250 C29.093,35.250 27.750,36.593 27.750,38.250 L27.750,43.500 L33.750,43.500 L33.750,40.500 L33.750,38.250 C33.750,36.593 32.407,35.250 30.750,35.250 ZM43.500,12.750 L33.000,12.750 L33.000,30.286 C34.030,31.442 33.995,33.196 32.920,34.310 C34.045,34.932 34.851,36.005 35.136,37.258 C35.419,36.986 35.736,36.751 36.080,36.560 C34.973,35.401 34.973,33.577 36.080,32.417 C37.224,31.219 39.123,31.175 40.321,32.319 C41.520,33.463 41.564,35.362 40.420,36.560 C41.136,36.957 41.731,37.541 42.141,38.250 L43.500,38.250 L43.500,38.250 L43.500,12.750 ZM39.750,17.250 L41.250,17.250 L41.250,29.250 L39.750,29.250 L39.750,17.250 ZM35.250,17.250 L36.750,17.250 L36.750,29.250 L35.250,29.250 L35.250,17.250 ZM27.750,24.000 L29.250,24.000 L29.250,25.500 L27.750,25.500 L27.750,24.000 ZM27.750,21.000 L29.250,21.000 L29.250,22.500 L27.750,22.500 L27.750,21.000 ZM27.750,18.000 L29.250,18.000 L29.250,19.500 L27.750,19.500 L27.750,18.000 ZM27.750,15.000 L29.250,15.000 L29.250,16.500 L27.750,16.500 L27.750,15.000 ZM27.000,10.500 L18.000,10.500 C18.000,10.500 17.999,10.500 17.999,10.500 C17.585,10.500 17.250,10.164 17.250,9.750 L17.250,3.750 C17.250,3.750 17.250,3.750 17.250,3.749 C17.250,3.335 17.586,3.000 18.000,3.000 L27.000,3.000 C27.000,3.000 27.001,3.000 27.001,3.000 C27.415,3.001 27.750,3.336 27.750,3.750 L27.750,9.750 C27.750,9.750 27.750,9.751 27.750,9.751 C27.750,10.165 27.414,10.500 27.000,10.500 ZM26.250,4.500 L18.750,4.500 L18.750,9.000 L26.250,9.000 L26.250,4.500 ZM17.250,16.500 L15.750,16.500 L15.750,15.000 L17.250,15.000 L17.250,16.500 ZM17.250,19.500 L15.750,19.500 L15.750,18.000 L17.250,18.000 L17.250,19.500 ZM17.250,22.500 L15.750,22.500 L15.750,21.000 L17.250,21.000 L17.250,22.500 ZM17.250,25.500 L15.750,25.500 L15.750,24.000 L17.250,24.000 L17.250,25.500 ZM20.250,13.500 L18.750,13.500 L18.750,12.000 L20.250,12.000 L20.250,13.500 ZM20.250,16.500 L18.750,16.500 L18.750,15.000 L20.250,15.000 L20.250,16.500 ZM20.250,19.500 L18.750,19.500 L18.750,18.000 L20.250,18.000 L20.250,19.500 ZM20.250,22.500 L18.750,22.500 L18.750,21.000 L20.250,21.000 L20.250,22.500 ZM20.250,25.500 L18.750,25.500 L18.750,24.000 L20.250,24.000 L20.250,25.500 ZM23.250,13.500 L21.750,13.500 L21.750,12.000 L23.250,12.000 L23.250,13.500 ZM23.250,16.500 L21.750,16.500 L21.750,15.000 L23.250,15.000 L23.250,16.500 ZM23.250,19.500 L21.750,19.500 L21.750,18.000 L23.250,18.000 L23.250,19.500 ZM23.250,22.500 L21.750,22.500 L21.750,21.000 L23.250,21.000 L23.250,22.500 ZM23.250,25.500 L21.750,25.500 L21.750,24.000 L23.250,24.000 L23.250,25.500 ZM26.250,13.500 L24.750,13.500 L24.750,12.000 L26.250,12.000 L26.250,13.500 ZM26.250,16.500 L24.750,16.500 L24.750,15.000 L26.250,15.000 L26.250,16.500 ZM26.250,19.500 L24.750,19.500 L24.750,18.000 L26.250,18.000 L26.250,19.500 ZM26.250,22.500 L24.750,22.500 L24.750,21.000 L26.250,21.000 L26.250,22.500 ZM26.250,25.500 L24.750,25.500 L24.750,24.000 L26.250,24.000 L26.250,25.500 ZM8.250,17.250 L9.750,17.250 L9.750,29.250 L8.250,29.250 L8.250,17.250 ZM3.750,17.250 L5.250,17.250 L5.250,29.250 L3.750,29.250 L3.750,17.250 Z" class="cls-1"/>
                </svg>
                Manage Buildings
            </a>
        </li>
        <li>
            <a href="{{ route('neighborhoods') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="45" height="45" viewBox="0 0 45 45">
                    <path d="M44.250,39.750 L42.682,39.750 C42.726,39.997 42.748,40.248 42.750,40.500 L42.750,44.250 C42.750,44.250 42.750,44.250 42.750,44.251 C42.749,44.665 42.414,45.000 42.000,45.000 L3.000,45.000 C3.000,45.000 3.000,45.000 2.999,45.000 C2.585,44.999 2.250,44.664 2.250,44.250 L2.250,40.500 C2.252,40.248 2.275,39.997 2.318,39.750 L0.750,39.750 C0.750,39.750 0.750,39.750 0.749,39.750 C0.335,39.750 0.000,39.414 0.000,39.000 L0.000,12.000 C0.000,12.000 0.000,12.000 0.000,11.999 C0.001,11.585 0.336,11.250 0.750,11.250 L12.000,11.250 L12.000,0.750 C12.000,0.750 12.000,0.750 12.000,0.749 C12.000,0.335 12.336,0.000 12.750,0.000 L32.250,0.000 C32.250,0.000 32.250,0.000 32.251,0.000 C32.665,0.001 33.000,0.336 33.000,0.750 L33.000,11.250 L44.250,11.250 C44.250,11.250 44.250,11.250 44.251,11.250 C44.665,11.250 45.000,11.586 45.000,12.000 L45.000,39.000 C45.000,39.000 45.000,39.000 45.000,39.001 C44.999,39.415 44.664,39.750 44.250,39.750 ZM35.250,43.500 L41.250,43.500 L41.250,40.500 C41.250,38.843 39.907,37.500 38.250,37.500 C36.593,37.500 35.250,38.843 35.250,40.500 L35.250,43.500 ZM39.750,34.500 C39.750,33.671 39.078,33.000 38.250,33.000 C37.421,33.000 36.750,33.671 36.750,34.500 C36.751,35.328 37.422,35.999 38.250,36.000 C39.078,36.000 39.750,35.328 39.750,34.500 ZM18.750,43.500 L26.250,43.500 L26.250,38.250 C26.250,36.179 24.571,34.500 22.500,34.500 C20.429,34.500 18.750,36.179 18.750,38.250 L18.750,43.500 ZM24.750,30.750 C24.750,29.507 23.743,28.500 22.500,28.500 C21.257,28.500 20.250,29.507 20.250,30.750 C20.251,31.992 21.258,32.999 22.500,33.000 C23.743,33.000 24.750,31.993 24.750,30.750 ZM3.750,43.500 L9.750,43.500 L9.750,40.500 C9.750,38.843 8.407,37.500 6.750,37.500 C5.093,37.500 3.750,38.843 3.750,40.500 L3.750,43.500 ZM8.250,34.500 C8.250,33.671 7.579,33.000 6.750,33.000 C5.922,33.000 5.250,33.671 5.250,34.500 C5.251,35.328 5.922,35.999 6.750,36.000 C7.579,36.000 8.250,35.328 8.250,34.500 ZM12.000,30.286 L12.000,12.750 L1.500,12.750 L1.500,38.250 L2.859,38.250 C3.269,37.541 3.864,36.957 4.580,36.560 C3.474,35.401 3.474,33.577 4.580,32.417 C5.724,31.219 7.623,31.175 8.822,32.319 C10.020,33.463 10.064,35.362 8.920,36.560 C9.264,36.751 9.581,36.986 9.864,37.258 C10.149,36.005 10.955,34.932 12.080,34.310 C11.005,33.196 10.970,31.442 12.000,30.286 ZM11.250,38.250 L11.250,43.500 L17.250,43.500 L17.250,38.250 C17.250,36.593 15.907,35.250 14.250,35.250 C12.593,35.250 11.250,36.593 11.250,38.250 ZM12.750,32.250 C12.750,33.078 13.422,33.750 14.250,33.750 C15.079,33.750 15.750,33.078 15.750,32.250 C15.750,31.421 15.079,30.750 14.250,30.750 C13.422,30.751 12.751,31.422 12.750,32.250 ZM31.500,1.500 L13.500,1.500 L13.500,29.356 C14.521,29.075 15.615,29.358 16.372,30.098 C17.549,31.248 17.570,33.134 16.420,34.310 C17.021,34.643 17.538,35.109 17.932,35.671 C18.435,34.786 19.182,34.064 20.084,33.594 C19.921,33.456 19.769,33.305 19.632,33.141 C18.298,31.557 18.500,29.192 20.084,27.857 C21.668,26.523 24.034,26.726 25.368,28.310 C26.702,29.894 26.500,32.260 24.916,33.594 C25.818,34.064 26.565,34.786 27.068,35.671 C27.462,35.109 27.979,34.643 28.580,34.310 C28.045,33.751 27.748,33.007 27.750,32.234 C27.754,30.582 29.097,29.246 30.750,29.250 C31.003,29.253 31.255,29.289 31.500,29.356 L31.500,1.500 ZM30.750,30.750 C29.921,30.750 29.250,31.421 29.250,32.250 C29.250,33.078 29.921,33.750 30.750,33.750 C31.578,33.750 32.250,33.078 32.250,32.250 C32.249,31.422 31.578,30.751 30.750,30.750 ZM30.750,35.250 C29.093,35.250 27.750,36.593 27.750,38.250 L27.750,43.500 L33.750,43.500 L33.750,40.500 L33.750,38.250 C33.750,36.593 32.407,35.250 30.750,35.250 ZM43.500,12.750 L33.000,12.750 L33.000,30.286 C34.030,31.442 33.995,33.196 32.920,34.310 C34.045,34.932 34.851,36.005 35.136,37.258 C35.419,36.986 35.736,36.751 36.080,36.560 C34.973,35.401 34.973,33.577 36.080,32.417 C37.224,31.219 39.123,31.175 40.321,32.319 C41.520,33.463 41.564,35.362 40.420,36.560 C41.136,36.957 41.731,37.541 42.141,38.250 L43.500,38.250 L43.500,38.250 L43.500,12.750 ZM39.750,17.250 L41.250,17.250 L41.250,29.250 L39.750,29.250 L39.750,17.250 ZM35.250,17.250 L36.750,17.250 L36.750,29.250 L35.250,29.250 L35.250,17.250 ZM27.750,24.000 L29.250,24.000 L29.250,25.500 L27.750,25.500 L27.750,24.000 ZM27.750,21.000 L29.250,21.000 L29.250,22.500 L27.750,22.500 L27.750,21.000 ZM27.750,18.000 L29.250,18.000 L29.250,19.500 L27.750,19.500 L27.750,18.000 ZM27.750,15.000 L29.250,15.000 L29.250,16.500 L27.750,16.500 L27.750,15.000 ZM27.000,10.500 L18.000,10.500 C18.000,10.500 17.999,10.500 17.999,10.500 C17.585,10.500 17.250,10.164 17.250,9.750 L17.250,3.750 C17.250,3.750 17.250,3.750 17.250,3.749 C17.250,3.335 17.586,3.000 18.000,3.000 L27.000,3.000 C27.000,3.000 27.001,3.000 27.001,3.000 C27.415,3.001 27.750,3.336 27.750,3.750 L27.750,9.750 C27.750,9.750 27.750,9.751 27.750,9.751 C27.750,10.165 27.414,10.500 27.000,10.500 ZM26.250,4.500 L18.750,4.500 L18.750,9.000 L26.250,9.000 L26.250,4.500 ZM17.250,16.500 L15.750,16.500 L15.750,15.000 L17.250,15.000 L17.250,16.500 ZM17.250,19.500 L15.750,19.500 L15.750,18.000 L17.250,18.000 L17.250,19.500 ZM17.250,22.500 L15.750,22.500 L15.750,21.000 L17.250,21.000 L17.250,22.500 ZM17.250,25.500 L15.750,25.500 L15.750,24.000 L17.250,24.000 L17.250,25.500 ZM20.250,13.500 L18.750,13.500 L18.750,12.000 L20.250,12.000 L20.250,13.500 ZM20.250,16.500 L18.750,16.500 L18.750,15.000 L20.250,15.000 L20.250,16.500 ZM20.250,19.500 L18.750,19.500 L18.750,18.000 L20.250,18.000 L20.250,19.500 ZM20.250,22.500 L18.750,22.500 L18.750,21.000 L20.250,21.000 L20.250,22.500 ZM20.250,25.500 L18.750,25.500 L18.750,24.000 L20.250,24.000 L20.250,25.500 ZM23.250,13.500 L21.750,13.500 L21.750,12.000 L23.250,12.000 L23.250,13.500 ZM23.250,16.500 L21.750,16.500 L21.750,15.000 L23.250,15.000 L23.250,16.500 ZM23.250,19.500 L21.750,19.500 L21.750,18.000 L23.250,18.000 L23.250,19.500 ZM23.250,22.500 L21.750,22.500 L21.750,21.000 L23.250,21.000 L23.250,22.500 ZM23.250,25.500 L21.750,25.500 L21.750,24.000 L23.250,24.000 L23.250,25.500 ZM26.250,13.500 L24.750,13.500 L24.750,12.000 L26.250,12.000 L26.250,13.500 ZM26.250,16.500 L24.750,16.500 L24.750,15.000 L26.250,15.000 L26.250,16.500 ZM26.250,19.500 L24.750,19.500 L24.750,18.000 L26.250,18.000 L26.250,19.500 ZM26.250,22.500 L24.750,22.500 L24.750,21.000 L26.250,21.000 L26.250,22.500 ZM26.250,25.500 L24.750,25.500 L24.750,24.000 L26.250,24.000 L26.250,25.500 ZM8.250,17.250 L9.750,17.250 L9.750,29.250 L8.250,29.250 L8.250,17.250 ZM3.750,17.250 L5.250,17.250 L5.250,29.250 L3.750,29.250 L3.750,17.250 Z" class="cls-1"/>
                </svg>
                Neighborhood
            </a>
        </li>
    </ul>
</aside>
