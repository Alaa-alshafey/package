@extends('layouts.user')

@section('content')

    @push('style')

        <link href="https://sheari.com.sa/common/User/ar/bootstrap-3.3.4-dist/chat.css" rel="stylesheet" />
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>



    @endpush



     <div class="container-fluid">

         <div class="row">
             <div  id="app2" style= "width: 98%">


                 <private-chat :user="{{auth()->user()}}"   ></private-chat>

             </div>
         </div>

    </div>






@endsection
