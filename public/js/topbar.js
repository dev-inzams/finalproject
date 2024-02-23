getuserdetails();
async function getuserdetails(){
    let res = await axios.post('/getuserdetails');
    if(res.data['status'] == 'success'){
        let user = res.data['user'];
        let employee = res.data['employee'];
        document.getElementById('topbar_email').innerHTML = user['email'];
    }
}
