{!! Form::select("city_id",$cities,null,['class'=>'form-control select2','placeholder'=>'اختر المدينة ','id'=>'city_id' ])!!}

<script>
        $(function() {

            $(document).ready(function() {
                $('.select2').select2({
                    dir: "rtl"
                });
            });
        });
</script>

