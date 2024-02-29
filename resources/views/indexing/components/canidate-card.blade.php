<div class="container mt-5">
    <h2 class="text-light">Best Canidates</h2>
    <div class="row" id="best_canidates">

    </div>
</div>
<script>
    getcanidates();
    async function getcanidates(){
        let res = await axios.post('/get-canidates');
        if(res.data['status'] == 'success'){
            let data = res.data['data'];
            let html = '';
            data.forEach(element => {
                html += `<div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('')}}${element['image']}" class="card-img-top img-fluid job-img" alt="${element['title']}">
                    <div class="card-body">
                    <h5 class="card-title title-clamp">${element['name']}</h5>
                    <a href="{{asset('')}}canidate-profile/${element['id']}" class="btn btn-primary">View Profile</a>
                    </div>
                </div>
            </div>`
            });
            $('#best_canidates').html(html);
        }else{
            $('#best_canidates').html('No Data Found');
        }
    }
</script>
