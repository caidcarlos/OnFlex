<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 bg-gray-700">
    <!--div>
        { { $logo }}
    </div-->
    <div class="h-1/2 my-auto w-5/6 md:w-1/2 lg:w-1/3 mx-auto">
        <div class = "w-full">
            <img src="{{asset('img/onflex-logo.png')}}" alt="OnFlex">
        </div>
    
        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            {{ $slot }}
        </div>
    
    </div>
</div>
