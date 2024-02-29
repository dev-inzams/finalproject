@extends('canidate.layout.app')
@section('title','Applied Jobs')
@section('content')

<div id="applied">

</div>




<script>
    getapply();
    async function getapply(){
        showLoader();
        let res = await axios.post('/canidate-get-applyed-jobs');
        hideLoader();
        if(res.data['status'] == 'success'){
            let data = res.data['data'];
            let html = '';
            data.forEach(element => {
                html += '<div class="card mb-3">'+
                    '<div class="row g-0">'+

                    '<div class="col-md-10">'+
                    '<div class="card-body">'+
                    '<h5 class="card-title">'+element['price']+'</h5>'+
                    '<p class="card-text">'+element['description']+'</p>'+
                    '<p class="card-text">'+element['status']+'</p>'+
                    '<p class="card-text"><small class="text-muted">'+element['updated_at']+'</small></p>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-md-2 mt-5">'+
                    '<button type="button" class="btn btn-danger">Delete</button>'+
                    '</div>'+
                    '</div>'+
                    '</div>'
            });
            document.getElementById('applied').innerHTML = html;
        }else{
            errorToast(res.data['message']);
        }

    }

</script>
@endsection
