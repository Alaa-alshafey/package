@extends('layouts.user')

@section('content')

    @push('style')

        <style>
            .form input, .form select{
                box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
                border-radius: 16px !important;
            }
            .form textarea{
                box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
                border-radius: 16px !important;
            }
            #snackbar {
                visibility: hidden;
                min-width: 250px;
                margin-left: -125px;
                background-color: #ef003b;
                color: #fff;
                text-align: center;
                border-radius: 2px;
                padding: 16px;
                position: fixed;
                z-index: 1;
                left: 50%;
                top: 30px;
                font-size: 17px;
            }

            #snackbar.show {
                visibility: visible;
                -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
                animation: fadein 0.5s, fadeout 0.5s 2.5s;
            }

            @-webkit-keyframes fadein {
                from {top: 0; opacity: 0;}
                to {top: 30px; opacity: 1;}
            }

            @keyframes fadein {
                from {top: 0; opacity: 0;}
                to {top: 30px; opacity: 1;}
            }

            @-webkit-keyframes fadeout {
                from {top: 30px; opacity: 1;}
                to {top: 0; opacity: 0;}
            }

            @keyframes fadeout {
                from {top: 30px; opacity: 1;}
                to {top: 0; opacity: 0;}
            }
        </style>


    @endpush


    <div class="container">
        <div class="row profile-bg">
            <div class="col-xs-12 col-sm-8 col-md-9">

                {!!Form::open( ['route' => ['user.saveNewProject'] ,'class'=>'form ', 'method' => 'Post','files' => true]) !!}



                    {{csrf_field()}}
                    <div class="profile-bar edit-input mar-bot">

                        <div class="regi-head">
                            <h2><span><i class="fa fa-briefcase"></i> اضافة عمل جديد </span></h2>


                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <span style="margin: 10px 0; display: inline-block" class="">نوع المشروع </span>
                            <select name="file_type" class="form-control">
                                <option value="">اختر نوع المشروع</option>
                                <option value="image">صورة</option>
                                <option value="video">فيديو</option>
                                <option value="audio">ملف صوتي</option>
                            </select>
                            <span style="margin: 10px 0; display: inline-block" class="">عنوان المشروع </span>
                            <input class="form-control" type="text"
                                   placeholder="عنوان المشروع "  name="title" />


                            <span style="margin: 10px 0; display: inline-block" class="">القيمة التقديريه للعمل SR</span>
                            <input class="form-control" type="number"
                                   placeholder="SR"  name="price" />




                            <span style="margin: 10px 0; display: inline-block" class="">  صورة المشروع الافتراضية ( يجب أن تكون الصورة لا تتعدي 300 بكسل عرض و 350 بكسل طول )</span>
                            <input class="form-control" type="file"
                                   name="file" />

                            <span style="margin: 10px 0; display: inline-block" class="">تفاصيل المشروع</span>
                            <textarea rows="5" class="form-control"
                                      name="description" placeholder="تفاصيل المشروع"></textarea>

                        </div>




                        <br />
                        <button type="submit" class="nexr-btn"><i class="fa fa-save"></i> حفظ</button>
                    </div>
                </form>
            </div>
            @include('layouts.side')
        </div>
    </div>

    <div id="snackbar">Feedback submitted successfully. </div>

@endsection
