@extends('admin.layouts.app')

@section ('content')

<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
    <!-- start sidebar -->
    <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
        @include('admin.layouts.sidebar')
    </div>
  <!-- end sidbar -->

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16 grid grid-cols-8"> 
    @include('admin.all-mitra.menu')

<div class="col-span-6 card flex flex-col">
    <div class="px-3 border-b">
        <form action="" class="flex">
            <input class="p-3 flex-1" type="text" placeholder="search">
            <button type="submit" class="p-3">
                <i class="fad fa-search"></i>
            </button>
        </form>
    </div>

    <div class="flex-1 flex flex-col">
        <!-- mitra -->
            <div class="flex items-center shadow-xs transition-all duration-300 ease-in-out p-3 hover:shadow-md">
                <div class="overflow-hidden rounded-md">
                    <img class="img-responsive" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtcVumkCSwNqGsSy8d6036ebMxVvjzejnaeQ&s" alt="" width="100">
                </div>    
                <div class="title m-2 w-50">
                    <h1 class="font-bold ml-6">Pens Rental</h1>    
                    <p class="ml-6 text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat modi quas explicabo corporis aut iste</p>  
                </div>  
                <a href="" class="font-bold text-gray-900 ms-auto me-3">Cek <i class="fas fa-arrow-right"></i></a>
            </div>
        <!-- mitra -->
    
        <!-- mitra -->
            <div class="flex items-center shadow-xs transition-all duration-300 ease-in-out p-3 hover:shadow-md">
                <div class="overflow-hidden rounded-md">
                    <img class="img-responsive" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtcVumkCSwNqGsSy8d6036ebMxVvjzejnaeQ&s" alt="" width="100">
                </div>    
                <div class="title m-2 w-50">
                    <h1 class="font-bold ml-6">Pens Rental</h1>    
                    <p class="ml-6 text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat modi quas explicabo corporis aut iste</p>  
                </div>  
                <a href="" class="font-bold text-gray-900 ms-auto me-3">Cek <i class="fas fa-arrow-right"></i></a>
            </div>
        <!-- mitra -->
        </div>
</div>

  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->
@endsection