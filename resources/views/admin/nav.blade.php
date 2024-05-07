<!-- Main sidebar -->
<div class="sidebar sidebar-main ">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left">
                        <img src="" class="img-circle img-sm" alt="">
                    </a>

                    <div class="media-body">
                        <span class="media-heading text-semibold">{{Auth::user()->name}}</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> مدير الموقع
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">


                <ul class="navigation navigation-main navigation-accordion">
                    <!-- Main -->
                    <li class="navigation-header"><span>الاعدادات الرئيسية</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="active">
                        <a href="{{asset('dashboard')}}"><i
                                    class="icon-home4"></i> <span>الصفحة الرئيسية</span></a>
                    </li>
                    <li class="{{(Request::is('dashboard/contacts') ? 'active' : '')}}">
                        <a
                                href="{{asset('dashboard/contacts')}}"><i
                                    class="icon-envelop"></i> <span>الرسائل  </span></a>
                    </li>
                    <li class="navigation-header"><span>المناطق الجغرافيه </span> <i class="icon-menu" title="Main pages"></i></li>
                    <li>
                        <a href="#" class="kar-tab"><i class="icon-location4"></i> <span>الدول</span></a>
                        <ul class="hidden-ul">
                            <li class="{{(Request::is('dashboard/country') ? 'active' : '')}}"><a
                                        href="{{route('admin.country.index')}}"><i class="icon-list"></i> كل الدول</a>
                            </li>
                            <li class="{{ (Request::is('dashboard/country/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.country.create')}}"><i class="icon-add-to-list"></i> اضافة
                                    دولة جديدة</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="kar-tab"><i class="icon-location4"></i> <span>المدن</span></a>
                        <ul class="hidden-ul">
                            <li class="{{(Request::is('dashboard/cities') ? 'active' : '')}}"><a
                                        href="{{route('admin.cities.index')}}"><i class="icon-list"></i> كل المدن</a>
                            </li>
                            <li class="{{(Request::is('dashboard/cities/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.cities.create')}}"><i class="icon-add-to-list"></i> اضافة
                                    مدينة جديدة</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="kar-tab"><i class="icon-location4"></i> <span>الأحياء</span></a>
                        <ul class="hidden-ul">
                            <li class="{{ (Request::is('dashboard/regions') ? 'active' : '')}}"><a
                                        href="{{route('admin.regions.index')}}"><i class="icon-list"></i> كل الأحياء</a>
                            </li>
                            <li class="{{ (Request::is('dashboard/regions/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.regions.create')}}"><i class="icon-add-to-list"></i> اضافة
                                    حى ًجديد</a>
                            </li>
                        </ul>
                    </li>
                    <li class="navigation-header"><span>الأقسام  </span> <i class="icon-menu" title="Main pages"></i></li>
                    <li>
                        <a href="#" class="kar-tab"><i class=" icon-package"></i> <span>الأقسام الرئيسية</span></a>
                        <ul class="hidden-ul">
                            <li class="{{(Request::is('dashboard/categories/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.categories.create')}}"><i class="icon-list"></i> اضافه  </a>
                            </li> <li class="{{(Request::is('dashboard/categories') ? 'active' : '')}}"><a
                                        href="{{route('admin.categories.index')}}"><i class="icon-list"></i> كل الاقسام</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="kar-tab"><i class=" icon-package"></i> <span>الأقسام الفرعية</span></a>
                        <ul  class="hidden-ul">
                            <li class="{{(Request::is('dashboard/subcategories') ? 'active' : '')}}"><a
                                        href="{{route('admin.subcategories.index')}}"><i class="icon-list"></i> كل
                                    الاقسام</a>
                            </li>

                            <li class="{{ (Request::is('dashboard/subcategories/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.subcategories.create')}}"><i class="icon-add-to-list"></i>
                                    اضافة
                                    قسم فرعى جديد </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="kar-tab"><i class=" icon-package"></i> <span>أقسام الاعلانات  </span></a>
                        <ul  class="hidden-ul">
                            <li class="{{(Request::is('dashboard/adscategories') ? 'active' : '')}}"><a
                                    href="{{route('admin.adscategories.index')}}"><i class="icon-list"></i> كل
                                    الاقسام</a>
                            </li>

                            <li class="{{ (Request::is('dashboard/adscategories/create') ? 'active' : '')}}"><a
                                    href="{{route('admin.adscategories.create')}}"><i class="icon-add-to-list"></i>
                                    اضافة
                                    قسم   جديد </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="kar-tab"><i class=" icon-package"></i> <span>السلايدرز </span></a>
                        <ul class="hidden-ul">
                            <li class="{{(Request::is('dashboard/sliders') ? 'active' : '')}}"><a
                                        href="{{route('admin.sliders.index')}}"><i class="icon-list"></i>كل السلايدرز
                                     </a>
                            </li>
                            <li class="{{ (Request::is('dashboard/sliders/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.sliders.create')}}"><i class="icon-add-to-list"></i> اضافة
                                     سلايدرز جديد  </a>
                            </li>
                        </ul>
                    </li>
                    <li class="navigation-header"><span>المستخدمين  </span> <i class="icon-menu" title="Main pages"></i></li>
                    <li>
                        <a href="#" class="kar-tab"><i class="icon-users2"></i> <span>أعضاء الاداره</span></a>
                        <ul class="hidden-ul">
                            <li class="{{ (Request::is('dashboard/admin') ? 'active' : '')}}"><a
                                        href="{{route('admin.admin.index')}}"><i class="icon-list"></i> كل الاعضاء</a>
                            </li>
                            <li class="{{  (Request::is('dashboard/admin/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.admin.create')}}"><i class="icon-user-plus"></i> اضافة عضو
                                    جديد</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="kar-tab"><i class="icon-users2"></i> <span>العملاء</span></a>
                        <ul class="hidden-ul">

                            <li class="{{(Request::is('dashboard/client') ? 'active' : '')}}"><a
                                        href="{{route('admin.client.index')}}"><i class="icon-list"></i> كل العملاء</a>
                            </li>

                            <li class="{{ (Request::is('dashboard/client/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.client.create')}}"><i class="icon-user-plus"></i> اضافة
                                    عميل
                                    جديد</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#" class="kar-tab"><i class="icon-users2"></i> <span>مزود الخدمه</span></a>
                        <ul class="hidden-ul">
                            <li class="{{ (Request::is('dashboard/provider') ? 'active' : '')}}"><a
                                        href="{{route('admin.provider.index')}}"><i class="icon-list"></i>مزودين الخدمه</a>
                            </li>
                            <li class="{{ (Request::is('dashboard/provider/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.provider.create')}}"><i class="icon-user-plus"></i> اضافة
                                    مزود
                                    جديد</a></li>
                        </ul>
                    </li>
                    <li class="navigation-header"><span>المؤهلات   </span> <i class="icon-menu" title="Main pages"></i></li>
                    <li>
                        <a href="#" class="kar-tab"><i class="fa fa-graduation-cap"></i> <span>المؤهلات العلميه </span></a>
                        <ul class="hidden-ul">
                            <li class="{{ (Request::is('dashboard/qualification') ? 'active' : '')}}"><a
                                        href="{{route('admin.qualification.index')}}"><i class="icon-list"></i> كل
                                    المؤهلات العلميه </a>
                            </li>
                            <li class="{{  (Request::is('dashboard/qualification/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.qualification.create')}}"><i class="icon-user-plus"></i>
                                    اضافة مؤهل جديد</a></li>
                        </ul>
                    </li>
                    <li class="navigation-header"><span>الطلبات  </span> <i class="icon-menu" title="Main pages"></i></li>
                    <li>
                        <a href="#" class="kar-tab"><i class=" icon-cart-add2"></i> <span>الطلبات</span></a>
                        <ul class="hidden-ul">
                            <li class="{{ (Request::is('dashboard/order') ? 'active' : '')}}"><a
                                        href="{{route('admin.order.index')}}"><i class="icon-list"></i> كل الطلبات </a>
                            </li>
                        </ul>
                    </li>
                    <li class="navigation-header"><span>التقارير  </span> <i class="icon-menu" title="Main pages"></i> </li>
                    <li>
                        <a href="#" class="kar-tab"><i class="  icon-package"></i> <span>التقييمات</span></a>
                        <ul class="hidden-ul">
                            <li class="{{ (Request::is('dashboard/providers/report') ? 'active' : '')}}"><a
                                        href="{{route('admin.providers.report.index')}}"><i class="icon-list"></i>تقارير
                                    مزودين
                                    الخدمات </a>
                            </li>
                            <li class="{{  (Request::is('dashboard/orders/report') ? 'active' : '')}}"><a
                                        href="{{route('admin.orders.report.index')}}"><i class="icon-megaphone"></i>
                                    تقارير الطلبات
                                </a>
                            </li>
                        </ul>
                    </li>




                    <li>
                        <a href="#" class="kar-tab"><i class="fa fa-graduation-cap"></i> <span>البانر الخاص بالتطبيق</span></a>
                        <ul class="hidden-ul">
                            <li class="{{ (Request::is('dashboard/banners') ? 'active' : '')}}"><a
                                        href="{{route('admin.banners.index')}}"><i class="icon-list"></i> جميع البانرات</a>
                            </li>
                            <li class="{{  (Request::is('dashboard/banners/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.banners.create')}}"><i class="icon-user-plus"></i>
                                    اضافة  بانر</a></li>
                        </ul>
                    </li>





                    <li>
                        <a href="#" class="kar-tab"><i class="  icon-package"></i> <span>أدارة تصميم المناسبات</span></a>
                        <ul class="hidden-ul">
                            <li class="{{ (Request::is('dashboard/events-categories') ? 'active' : '')}}"><a
                                        href="{{route('admin.events-categories.index')}}"><i class="icon-list"></i> الاقسام الرئيسة</a>
                            </li>


                            <li class="{{ (Request::is('dashboard/events-categories/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.events-categories.create')}}"><i class="icon-list"></i>   اضافة قسم رئيسي</a>
                            </li>


                            <li class="{{ (Request::is('dashboard/events-sub-categories') ? 'active' : '')}}"><a
                                        href="{{route('admin.events-sub-categories.index')}}"><i class="icon-list"></i> الاقسام الفرعية</a>
                            </li>


                            <li class="{{ (Request::is('dashboard/events-sub-categories/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.events-sub-categories.create')}}"><i class="icon-list"></i>   اضافة قسم فرعي</a>
                            </li>


                            <li class="{{  (Request::is('dashboard/events') ? 'active' : '')}}"><a
                                        href="{{route('admin.events.index')}}"><i class="icon-megaphone"></i> كافة البطاقات
                                </a>
                            </li>



                            <li class="{{  (Request::is('dashboard/events/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.events.create')}}"><i class="icon-megaphone"></i> أضافة بطاقة
                                </a>
                            </li>
                        </ul>
                    </li>






                    <li class="{{  (Request::is('dashboard/reports') ? 'active' : '')}}"><a
                                href="{{route('admin.reports.index')}}">
                            <i class="icon-megaphone"></i>
                            تقارير المدفوعات
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="#" class="kar-tab"><i class=" icon-package"></i> <span>التقييمات </span></a>--}}
                        {{--<ul class="hidden-ul">--}}
                            {{--<li class="{{(Request::is('dashboard/rates/orders-rate') ? 'active' : '')}}"><a--}}
                                        {{--href="{{route('admin.OrdersRate')}}"><i class="icon-list"></i> تقييمات الطلبات</a>--}}
                            {{--</li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}
                    <li class="navigation-header"><span>المحادثات</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="{{ (Request::is('dashboard/chats') ? 'active' : '')}}"><a
                                href="{{route('admin.chats.index')}}"><i class="icon-list"></i> كل المحادثات </a>
                    </li>

                    <li>
                        <a href="#" class="kar-tab"><i class="icon-location4"></i> <span>الرسائل النصية</span></a>
                        <ul class="hidden-ul">
                            <li class="{{(Request::is('dashboard/sends/create') ? 'active' : '')}}"><a
                                        href="{{route('admin.sends.create')}}"><i class="icon-add-to-list"></i> ارسال رسالة نصية</a>
                            </li>
                        </ul>
                    </li>



                    <li class="navigation-header"><span>الاشعارات  </span> <i class="icon-menu" title="Main pages"></i></li>


                    <li>
                        <a href="#" class="kar-tab"><i class="icon-megaphone"></i> <span>الاشعارات</span></a>
                        <ul class="hidden-ul">

    {{--<li>--}}
        {{--<a href="#"><i class="icon-megaphone"></i> <span>الاشعارات</span></a>--}}
        {{--<ul>--}}
            {{--<li class="{{ (Request::is('dashboard/notifications') ? 'active' : '')}}"><a--}}
                        {{--href="{{route('admin.notifications.index')}}"><i class="icon-list"></i> كل  الاشعارات </a>--}}
            {{--</li>--}}
            <li class="{{  (Request::is('dashboard/notifications/create') ? 'active' : '')}}">
                <a href="{{route('admin.notifications.create')}}"><i class="icon-megaphone"></i> ارسال اشعار جديد</a>
            </li>
        {{--</ul>--}}
    {{--</li>--}}


<li class="navigation-header"><span>الاعدادات </span> <i class="icon-menu" title="Main pages"></i></li>
    <li class="{{(Request::is('dashboard/settings/general') ? 'active' : '')}}">
        <a href="{{route('admin.setting.index',['general'])}}"><i class="fas fa-cogs"></i> <span>الاعدادات</span></a></li>
</li>
                                <li class="{{  (Request::is('dashboard/notifications/create') ? 'active' : '')}}">
                                    <a href="{{route('admin.notifications.create')}}"><i class="icon-megaphone"></i> ارسال اشعار
                                        جديد</a>
                                </li>
                        </ul>
                    </li>
                    <li class="navigation-header"><span>الاعدادات </span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="{{(Request::is('dashboard/settings/general') ? 'active' : '')}}">
                        <a href="{{route('admin.setting.index',['general'])}}"><i class="fas fa-cogs"></i> <span>الاعدادات</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
