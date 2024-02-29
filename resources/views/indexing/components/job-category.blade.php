<div class="container mt-5">
    <h2 class="text-light">Best Categories</h2>
    <div class="row" id="jobs_categories">

    </div>
</div>
<script>
    getJobs();
    async function getJobs(){
        let res = await axios.post('/get-jobs-category')
        let data = res.data['data'];
        let html = '';
        data.forEach(element => {
            html += `<div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset('')}}${element['image']}" class="card-img-top img-fluid job-img" alt="${element['title']}">
                            <div class="card-body">
                            <h5 class="card-title title-clamp">${element['title']}</h5>
                            </div>
                        </div>
                    </div>`
        });
        $('#jobs_categories').html(html);
    }
</script>
