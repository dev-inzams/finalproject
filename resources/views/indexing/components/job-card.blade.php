<div class="container mt-5">
    <h2 class="text-light">Best Jobs</h2>
    <div class="row" id="best_jobs">

    </div>
</div>

<script>
    getjobs();
    async function getjobs(){
        let res = await axios.post('/get-jobs');
        let data = res.data['data'];
        let html = '';
        data.forEach(element => {
            html += `<div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('')}}${element['image']}" class="card-img-top img-fluid job-img" alt="${element['title']}">
                <div class="card-body">
                <h5 class="card-title title-clamp">${element['title']}</h5>
                <p class="card-text line-clamp">${element['description']}</p>
                <a href="{{asset('')}}get-job/${element['id']}" class="btn btn-primary">Apply Now</a>
                </div>
            </div>
        </div>`
        });
        $('#best_jobs').html(html);
    }
</script>
