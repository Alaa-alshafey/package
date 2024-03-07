<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            @php
              if(!empty(Session::get('_previous')['url'])){
              
                    $url = Session::get('_previous')['url'];
              }else{
                    $url = '';
              }
            @endphp
            <h4><a href="{{ $url }}" ><i class="icon-arrow-right6 position-left"></i></a> <span class="text-semibold">لوحة تحكم موقع باكيج </span> - @yield('title')</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="{{asset('dashboard')}}" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>بعض الاحصائيات</span></a>
                <a href="{{asset('dashboard/admin')}}" class="btn btn-link btn-float has-text"><i class="icon-users text-primary"></i> <span>أعضاء الاداره</span></a>
            </div>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{asset('dashboard')}}"><i class="icon-home2 position-left"></i> لوحة التحكم</a></li>
            <li class="active">@yield('title')</li>
        </ul>
    </div>
</div>
<!-- /page header -->