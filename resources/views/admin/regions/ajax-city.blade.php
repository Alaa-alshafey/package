{!! Form::select("city_id",$cities,null,['class'=>'form-control select2','placeholder'=>'اختر المدينة ' ])!!}

<script>
    $(function() {

        $(document).ready(function() {
            $('.select2').select2({
                dir: "rtl"
            });
        });
    });
</script>

