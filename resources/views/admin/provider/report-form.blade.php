@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif


<div class="col-sm-4 col-xs-12">
    <label class="form-label">من</label>
    {!! Form::date("start",null,['class'=>'form-control','placeholder'=>'من','id'=>'example-date']) !!}
</div>

<div class="col-sm-4 col-xs-12">
    <label class="form-label">الى</label>
    {!! Form::date("end",null,['class'=>'form-control','placeholder'=>'الى','id'=>'example-date']) !!}
</div>

<button class="btn btn-primary waves-effect" type="submit">انشاء تقرير</button>
