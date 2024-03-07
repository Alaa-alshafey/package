@extends('layouts.user')

@section('content')

    @push('style')

        <style>
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

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!!Form::open( ['route' => ['user.saveProject',$project->id] ,'class'=>'form ', 'method' => 'Post','files' => true]) !!}
                    {{csrf_field()}}
                    <div class="profile-bar edit-input mar-bot">

                        <div class="regi-head">
                            <h2><span><i class="fa fa-briefcase"></i> تعديل العمل </span></h2>


                            <span style="margin: 10px 0; display: inline-block" class="">نوع المشروع </span>

                            <select name="file_type" class="form-control">
                                <option value="">اختر نوع المشروع</option>
                                <option value="image" {{($project->file_type == 'image')? "selected" : ""}}>صورة</option>
                                <option value="video" {{($project->file_type == 'video')? "selected" : ""}}>فيديو</option>
                                <option value="audio" {{($project->file_type == 'audio')? "selected" : ""}}>ملف صوتي</option>
                            </select>



                            <span style="margin: 10px 0; display: inline-block" class="">عنوان المشروع </span>

                            <input class="form-control" type="text" value="{{$project->title}}"  name="title" />



                            <span style="margin: 10px 0; display: inline-block" class="">القيمة التقديريه للعمل SR</span>
                            <input class="form-control" type="number"
                                   placeholder="SR"  name="price" value="{{$project->price}}" />



                            <span style="margin: 10px 0; display: inline-block" class=""> صورة المشروع الافتراضية ( يجب أن تكون الصورة لا تتعدي 300 بكسل عرض و 350 بكسل طول )</span>
                            <input class="form-control" type="file" name="file" />

                            <span style="margin: 10px 0; display: inline-block" class="">تفاصيل المشروع</span>
                            <textarea rows="5" class="form-control" name="description">{{$project->description}}</textarea>

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
