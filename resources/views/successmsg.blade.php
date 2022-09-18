@if (\Session::has('successMsg'))
    <div id="successMsgTmp" class="alert alert-success">{{ \Session::get('successMsg') }}</div>

    <script type="text/javascript">
        setTimeout(function(){
            document.getElementById('successMsgTmp').remove();
        }, 3000);
    </script>
@endif
