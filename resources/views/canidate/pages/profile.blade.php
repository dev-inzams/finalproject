@extends('canidate.layout.app')
@section('title','User Dashboard')
@section('content')

<div class="container">
    <h2>Welcome to your Profile</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control">

                <label for="father_name">Father Name</label>
                <input type="text" id="father_name" class="form-control">

                <label for="mother_name">Mother Name</label>
                <input type="text" id="mother_name" class="form-control">
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" id="date_of_birth" class="form-control">

                <label for="blood_group">Blood Group</label>
                <input type="text" id="blood_group" class="form-control">
            </div>

            <div class="form-group">
                <label for="Social_id">Social Id</label>
                <span class="form-text text-muted">NID,Driving License</span>
                <input type="text" id="Social_id" class="form-control">

                <label for="Passport_id">Passport Id</label>
                <input type="text" id="Passport_id" class="form-control">
            </div>

            <div class="form-group">
                <label for="cell_no">Phone Number</label>
                <input type="text" id="cell_no" class="form-control">

                <label for="emergency_no">Emergency Number</label>
                <input type="text" id="emergency_no" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="linkedin">linkedin</label>
                <input type="text" id="linkedin" class="form-control">

                <label for="facebook">Facebook</label>
                <input type="text" id="facebook" class="form-control">

                <label for="github">Github</label>
                <input type="text" id="github" class="form-control">

                <label for="portfolio_link">Protfolio Link</label>
                <input type="text" id="portfolio_link" class="form-control">
            </div>

            <div class="form-group">
                <div class="show_img img-fluid rounded img-thumbnail">
                    <img src="{{ asset('img/default.png') }}" id="thumnail">
                </div>
                <label for="image">Profile Image</label>
                <input oninput="thumnail.src = window.URL.createObjectURL(this.files[0])" type="file" id="image" class="form-control">
            </div>
        </div>
    </div>
    <button onclick="updateOrcreate()" class="btn btn-primary text-center mt-3">Save</button>
</div>

<script>
    getcanidateProfile();
    async function getcanidateProfile(){
        showLoader();
        let res = await axios.post('/candidate-get-profile');
        hideLoader();
        let data = res.data;
        if(data['status'] == 'success'){
            $('#name').val(data['data']['name']);
            $('#father_name').val(data['data']['father_name']);
            $('#mother_name').val(data['data']['mother_name']);
            $('#date_of_birth').val(data['data']['date_of_birth']);
            $('#blood_group').val(data['data']['blood_group']);
            $('#Social_id').val(data['data']['Social_id']);
            $('#Passport_id').val(data['data']['Passport_id']);
            $('#cell_no').val(data['data']['cell_no']);
            $('#emergency_no').val(data['data']['emergency_no']);
            $('#linkedin').val(data['data']['linkedin']);
            $('#facebook').val(data['data']['facebook']);
            $('#github').val(data['data']['github']);
            $('#portfolio_link').val(data['data']['portfolio_link']);
            $('#thumnail').attr('src','{{ asset('') }}' +data['data']['image']);
        }
    }

    async function updateOrcreate(){
        var name = $('#name').val();
        var father_name = $('#father_name').val();
        var mother_name = $('#mother_name').val();
        var date_of_birth = $('#date_of_birth').val();
        var blood_group = $('#blood_group').val();
        var Social_id = $('#Social_id').val();
        var Passport_id = $('#Passport_id').val();
        var cell_no = $('#cell_no').val();
        var emergency_no = $('#emergency_no').val();
        var linkedin = $('#linkedin').val();
        var facebook = $('#facebook').val();
        var github = $('#github').val();
        var portfolio_link = $('#portfolio_link').val();
        var image = $('#image').prop('files')[0];
        let postdata = new FormData();
        postdata.append('name',name);
        postdata.append('father_name',father_name);
        postdata.append('mother_name',mother_name);
        postdata.append('date_of_birth',date_of_birth);
        postdata.append('blood_group',blood_group);
        postdata.append('Social_id',Social_id);
        postdata.append('Passport_id',Passport_id);
        postdata.append('cell_no',cell_no);
        postdata.append('emergency_no',emergency_no);
        postdata.append('linkedin',linkedin);
        postdata.append('facebook',facebook);
        postdata.append('github',github);
        postdata.append('portfolio_link',portfolio_link);
        postdata.append('image',image);
        postdata.append('_token','{{ csrf_token() }}');
        showLoader();
        let res = await axios.post('/candidate-updateOrCreate-profile',postdata,{
            headers:{
                'Content-Type':'multipart/form-data'
            }
        });
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getcanidateProfile();
        }else{
            errorToast(res.data['message']);
        }
    }
</script>
@endsection
