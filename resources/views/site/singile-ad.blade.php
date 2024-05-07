@extends('layouts.app')

@section('content')


@push('style')
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBJEJYZ4EU2nWnOmjkkSaKw3TxUSO5lTMM&libraries=places&language=en-AU"></script>

@endpush

<div class="container mar-top">
    <div class="row" style="margin-top:30px">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <img src="{{getimg($ad->image)}}" alt="" height="540px">
            <h2>{{$ad->title}}  </h2>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <br>
            <b>التفاصيل:</b>
            <p>
                {{($ad->description)}}
            </p>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody><tr>
                        <td>
                            <small>الاسم:</small><br>
                            <b>{{$ad->user->name}}  </b>
                        </td>
                        <td colspan="2">
                            <small>البريد الإلكتروني:</small><br>
                            <b> {{$ad->user->email}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small>الجوال.:</small><br>
                            <b>{{$ad->user->phone}}</b>
                        </td>

                        <td>
                            <small>تاريخ التقديم:</small><br>
                            <b>{{$ad->user->created_at->diffForHumans()}}</b>
                        </td>
                    </tr>


                    </tbody></table>
            </div>
        </div>
    </div>
</div>

@endsection
