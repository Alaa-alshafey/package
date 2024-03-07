@extends('admin.layout')
@section('title')
    {{$settings_page}}
@endsection

@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {!!Form::open( ['route' => 'admin.setting.store' , 'method' => 'post','files'=>true]) !!}
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">التحكم ب {{$settings_page}}</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    @foreach($settings as $setting)
                            @if($setting->type == 0)
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">{{$setting->title}}</label>
                                {!! Form::text($setting->name.'[]',$setting->ar_value,['class'=>'form-control'])!!}
                      </div>
                                {{--@if($setting->name=="site_meta")--}}
                                    {{--<br>--}}
                                    {{--<div class="alert alert-success">--}}
                                        {{--<strong>تنبيه :</strong> الكلمات الدلالية هي الكلمات التي يمكن من خلالها رؤية الموقع --}}
                                        {{--على محركات البحث مثل جوجل--}}
                                    {{--</div>--}}
                                {{--@elseif($setting->name=="site_description")--}}
                                    {{--<br>--}}
                                    {{--<div class="alert alert-info">--}}
                                        {{--<strong>تنبيه :</strong> أجعل وصف الموقع 170 كلمة على الأكثر طبقاً لمعايير جوجل للأرشفة--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            @elseif($setting->type == 1)
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="exampleInputEmail1">{{$setting->title}} <span>باللغة العربية</span></label>
                        {!! Form::textarea($setting->name.'[]',$setting->ar_value,['class'=>'ck img-lg img-rounded'])!!}
                       </div>
                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="exampleInputEmail1">{{$setting->title}} <span>باللغة بالانجليزية</span></label>
                        {!! Form::textarea($setting->name.'[]',$setting->en_value,['class'=>'ck img-lg img-rounded'])!!}
                         </div>
                            @elseif($setting->type == 2)
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">{{$setting->title}}</label>
                                <input type="file" id="input-file-now-custom-3" name="img" class="dropify" data-height="400"
                                       @if(isset($setting))
                                       @if($setting->value()!=null)
                                       data-default-file="{{getimg($setting->value())}}"
                                       @else
                                       data-default-file="/upload/infograph.jpg"
                                       @endif
                                       @else
                                       data-default-file="/upload/infograph.jpg"
                                        @endif
                                />
                            </div>
                            @elseif($setting->type == 3)
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::textarea($setting->name.'[]',$setting->value(),['class'=>'summernote form-control'])!!}
                            </div>
                            @elseif($setting->type == 4)
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::number($setting->name.'[]',$setting->value(),['class'=>'form-control'])!!}
                            </div>
                            @endif
                        <div class="clearfix"></div>
                        <br>
                    @endforeach
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
                    </div>
                    {!!Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="/admin/assets/js/pages/form_layouts.js"></script>
    {!! Html::script('admin/ckeditor/ckeditor.js') !!}
    <script>
        $(document).ready(function () {
            CKEDITOR.replaceClass = 'ck';
        });
    </script>
@endsection