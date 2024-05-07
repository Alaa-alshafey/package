<div class="col-xs-12 col-sm-4 col-md-3 mob-none">
    <div class="profile-bar" >
        <a href="{{route('user.myAccount')}}"
           class="edit" data-toggle="tooltip" data-placement="left" title="إدارة حسابي"><i class="fa fa-edit"></i></a>
        <div class="prog" >

            <div class="mx-auto" data-value='80'>

                <!--
                    <span class="progress-left">
                                    <span class="progress-bar border-primary"></span>
                    </span>
                    <span class="progress-right">
                                    <span class="progress-bar border-primary"></span>
                    </span>
                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                <div class="h2 font-weight-bold">80<sup class="small">%</sup></div>
                    </div>
                 -->
                <img src="{{getimg(Auth::user()->image)}}" style="border-radius: 50%;
                border: 10px solid #bcc732; margin-right: 0" />
            </div>

        </div>
        <div class="name">{{Auth::user()->name}}</div>
        <ul>
            <li><a href="{{route('user.myAccount')}}"><i class="fa fa-user"></i>حسابي</a></li>
            <li><a href="{{route('user.pay')}}"><i class="fa fa-money"></i>الدفع</a></li>
            <li><a href="{{route('user.editMyAccount')}}"><i class="fa fa-image"></i>إدارة صفحتي</a></li>
            <li><a href="{{route('user.invite-friends')}}"><i class="fa fa-group"></i>مشاركة مع الأصدقاء</a></li>
            <li><a href="{{route('user.myProjects')}}"><i class="fa fa-group"></i> اضافة وعرض المشاريع</a></li>
            <li><a href="{{route('user.password')}}"><i class="fa fa-unlock"></i>تغيير الرقم السري</a></li>
        </ul>


    </div>

    <div class="clearfix"></div>
    @if(auth()->user()->role == "provider")
        <a href="/user/card" class="cardbt btn btn-primary btn-rounded btn-block">بطاقة العضوية</a>
    @endif


</div>
