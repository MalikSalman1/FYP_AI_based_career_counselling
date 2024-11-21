var form = document.getElementById('lobby__form')
var streamdata = ""

let displayName = '{{Auth::user()->name}}'

if(displayName){
    form.name.value = '{{Auth::user()->id}}'
}
console.log(displayName)

form.addEventListener('submit', (e) => {
    e.preventDefault()
  
   
    sessionStorage.setItem('display_name', e.target.name.value)
    let formData = new FormData(form)

    formData.append('room', e.target.room.value)
    formData.append('description', e.target.description.value)
    // image file
    let file = e.target.image.files[0]
    formData.append('image', file)
    formData.append('mentor_id', e.target.mentor_id.value)
    let stream_key = Math.floor(Math.random() * 100000000)
    formData.append('stream_key', stream_key)
    
        // if any of the fields are empty don't submit the form and show error message in for example room field is empty " <span id="room__error" class="error"></span>"
        
        if(e.target.room.value == ""){
            document.getElementById('room__error').innerHTML = "Stream Title is required"
            
        }
        if(e.target.description.value == ""){
            document.getElementById('description__error').innerHTML = "Description is required"
            
        }
        if(e.target.image.value == ""){
            document.getElementById('image__error').innerHTML = "Image is required"
            
        }
       
        
       
       
        

    fetch('http://127.0.0.1:8000/api/create/livestream', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            // Handle the response data
            console.log(data);
            streamdata = data;
            
        }).catch
        (error => {
            console.error('Error:', error);
        });
        

    
    
    // window.location = `room.html?room=${inviteCode}`
})